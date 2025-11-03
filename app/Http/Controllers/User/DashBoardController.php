<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\HelpSupport;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\Group;
use App\Models\GroupMember;
use App\Models\PortalSet;
use App\Models\Leader;
use App\Models\User;
use App\Models\Contribution;
use Carbon\Carbon;
use App\Models\Notification;

use Stripe\Stripe;
use Stripe\Checkout\Session;
use Illuminate\Support\Facades\Session as LSession;
use Stripe\PaymentIntent;

class DashBoardController extends Controller
{

    public function dashboard()
    {
        $user = Auth::user();

        $groupId = GroupMember::where('user_id', $user->id)->value('group_id');

        if ($groupId) {
            $group = Group::find($groupId);
            $groupMembers = GroupMember::where('group_id', $groupId)->get();
        } else {
            $group = null;
            $groupMembers = collect();
        }

        $portal = $group ? PortalSet::find($group->portal_set_id) : null;
        $leader = $group ? User::find($group->leader_id) : null;

        $weeklyCommitment = GroupMember::where('user_id', $user->id)->value('weekly_commitment') ?? 0;

        $contributions = Contribution::where('user_id', $user->id)->latest()->get();
        $userContribution = Contribution::where('user_id', $user->id)->sum('amount');

        $groupContribution = Contribution::where('group_id', $groupId ?? 0)->sum('amount');
        $supportDetails = HelpSupport::first() ?? null;

        return view("user.dashboard", compact('user', "group", "portal", "leader", "groupMembers", "contributions", 'weeklyCommitment', 'supportDetails', 'userContribution', 'groupContribution'));

    }

    public function readAllNotification(Request $request)
    {

        Notification::where('receiver_id', Auth::id())
            ->where('is_read', false)
            ->update(['is_read' => true]);


        return redirect()->back(); // or return JSON if using AJAX

    }

    public function userProfile(Request $request)
    {
        $user = Auth::user();
        return view("user.profile", compact("user"));
    }

    public function userUpdateProfile(Request $request)
    {
        $user = Auth::user();
        $file = $request->file('profile_image');

        if ($file) {
            $destinationPath = public_path('uploads');
            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0775, true);
            }

            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move($destinationPath, $fileName);
            chmod($destinationPath . '/' . $fileName, 0775);

            $user->profile_image = $fileName;
        }
        $user->name = $request->name;
        $user->address = $request->address;
        $user->save();

        return redirect()->route("user.dashboard")->with('success', 'Profile Updated successsfully');

    }

    public function myContribution()
    {
        $user = Auth::user();
        $groupId = GroupMember::where('user_id', $user->id)->pluck('group_id');
        $group = Group::where('id', $groupId)->first();
        $groupMembers = GroupMember::where('group_id', $groupId)->get();
        $portal = PortalSet::where('id', $group->portal_set_id)->first();
        $leader = User::where('id', $group->leader_id)->first();
        $contributions = Contribution::where('user_id', $user->id)->latest()->get();
        $weeklyCommitment = GroupMember::where('user_id', $user->id)->first()->weekly_commitment;

        return view('user.contribution', compact('user', "group", "portal", "leader", "groupMembers", "contributions", 'weeklyCommitment'));
    }


    public function PaymentRecieptDownload()
    {
        $user = auth()->user();
        $contributions = Contribution::with('group')
            ->where('user_id', $user->id)
            ->orderBy('week_number', 'desc')
            ->get();

        // Calculate statistics
        $totalPayments = $contributions->count();
        $totalAmount = $contributions->sum('amount');
        $completedPayments = $contributions->where('status', 'completed')->count();
        // Get user's weekly commitment from group_members table
        $weeklyCommitment = GroupMember::where('user_id', $user->id)
            ->value('weekly_commitment') ?? 0;

        // Calculate current week (you might have your own logic for this)
        $currentWeek = 1; // Replace with your week calculation

        return view('user.payment_reciepts', compact(
            'contributions',
            'totalPayments',
            'totalAmount',
            'completedPayments',
            'weeklyCommitment',
            'currentWeek'
        ));
    }

    public function getContributionTrends()
    {
        $userId = Auth::id();

        $contributions = Contribution::where('user_id', $userId)
            ->selectRaw('MONTH(paid_date) as month, SUM(amount) as total')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Format data for Chart.js
        $labels = [];
        $data = [];

        foreach ($contributions as $row) {
            $labels[] = date("M", mktime(0, 0, 0, $row->month, 1)); // e.g., Jan, Feb
            $data[] = $row->total;
        }
        dd($data, $labels);

        return response()->json([
            'labels' => $labels,
            'data' => $data
        ]);
    }

    public function myContributionPay(Request $request)
    {
        $request->validate([
            'group_id' => 'required|exists:groups,id',
            'user_id' => 'required|exists:users,id',
            'amount' => 'required|numeric|min:1',
            'week_number' => 'required|integer|min:1',
        ]);

        LSession::put('contribution_data', $request->only(['group_id', 'user_id', 'amount', 'week_number']));

        Stripe::setApiKey(config('services.stripe.secret'));

        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'inr',
                        'product_data' => [
                            'name' => "Contribution for Week " . $request->week_number,
                        ],
                        'unit_amount' => $request->amount * 100,
                    ],
                    'quantity' => 1,
                ]
            ],
            'mode' => 'payment',
            'success_url' => route('admin.stripe.success') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('admin.stripe.cancel'),
        ]);
        return redirect()->away($session->url);
    }

    public function stripeSuccess(Request $request)
    {
        $user = auth()->user();
        $data = session('contribution_data');

        if (!$data) {
            return redirect()->route('user.my.contribution')
                ->with('error', 'Payment data missing!');
        }

        $session_id = $request->get('session_id');

        if (!$session_id) {
            return redirect()->route('user.my.contribution')
                ->with('error', 'Missing Stripe session ID.');
        }

        Stripe::setApiKey(config('services.stripe.secret'));
        $checkoutSession = Session::retrieve($session_id);

        $paymentIntentId = $checkoutSession->payment_intent;

        $paymentIntent = PaymentIntent::retrieve($paymentIntentId);

        $contribution = new Contribution();
        $contribution->group_id = $data['group_id'];
        $contribution->user_id = $data['user_id'];
        $contribution->week_number = $data['week_number'];
        $contribution->amount = $data['amount'];
        $contribution->transaction_id = $paymentIntentId;
        $contribution->contribution_date = now();
        $contribution->status = 'completed';
        $contribution->payment_method = 'stripe';
        $contribution->save();

        $this->createNotification(
            "Week {$data['week_number']} contribution paid via Stripe (Txn: {$paymentIntentId})",
            $user->id,
            $user->id
        );

        session()->forget('contribution_data');

        return redirect()->route('user.my.contribution')
            ->with('success', 'Payment successful & contribution saved. Transaction ID: ' . $paymentIntentId);
    }

    public function stripeCancel()
    {
        session()->forget('contribution_data');

        return redirect()->route('user.my.contribution')
            ->with('error', 'Payment cancelled.');
    }
}


