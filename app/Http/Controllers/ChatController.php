<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Ebook;
use App\Models\Inquery;
use App\Models\Message;
use App\Models\OurService;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ChatController extends Controller
{
    public function index()
    {
        if (auth()->user()->role == 3) {
            $users = User::where('id', '!=', Auth::id())
                ->where(function ($q) {
                    $q->whereHas('messagesSent', function ($query) {
                        $query->where('receiver_id', Auth::id());
                    })->orWhereHas('messagesReceived', function ($query) {
                        $query->where('sender_id', Auth::id());
                    });
                })
                ->get();
        }else{
            $users = User::where('status',1)->where('role',3)->latest()->get();
        }

        return view('admin.chat.show', compact('users'));
    }

    // public function chatWith(User $user)
    // {
    //     $messages = Message::where(function ($q) use ($user) {
    //         $q->where('sender_id', Auth::id())
    //           ->where('receiver_id', $user->id);
    //     })->orWhere(function ($q) use ($user) {
    //         $q->where('sender_id', $user->id)
    //           ->where('receiver_id', Auth::id());
    //     })->orderBy('created_at')->get();

    //     return response()->json($messages);
    // }

    // public function send(Request $request)
    // {
    //     $request->validate([
    //         'receiver_id' => 'required|exists:users,id',
    //         'message' => 'required|string|max:1000',
    //     ]);

    //     $message = Message::create([
    //         'sender_id'   => Auth::id(),
    //         'receiver_id' => $request->receiver_id,
    //         'message'     => $request->message
    //     ]);

    //     return response()->json($message);
    // }
    public function chatWith(User $user)
    {
        $messages = Message::where(function ($q) use ($user) {
            $q->where('sender_id', Auth::id())->where('receiver_id', $user->id);
        })->orWhere(function ($q) use ($user) {
            $q->where('sender_id', $user->id)->where('receiver_id', Auth::id());
        })->orderBy('created_at')->get();

        // Map to include file_url etc (if you didn't use $appends)
        $mapped = $messages->map(function ($m) {
            return [
                'id' => $m->id,
                'sender_id' => $m->sender_id,
                'receiver_id' => $m->receiver_id,
                'message' => $m->message,
                'created_at' => $m->created_at,
                'file_url' => $m->file_path ? Storage::url($m->file_path) : null,
                'file_name' => $m->file_name,
                'file_type' => $m->file_type,
                'file_size' => $m->file_size,
            ];
        });

        return response()->json($mapped);
    }

    public function send(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'message' => 'nullable|string|max:1000',
            'file' => 'nullable|file|mimes:jpg,jpeg,png,gif,webp,pdf,doc,docx,xls,xlsx,csv,mp4,mov,avi,mp3,wav,zip,rar|max:10240' // max 10MB
        ]);

        if (empty($request->message) && !$request->hasFile('file')) {
            return response()->json(['error' => 'Message or file is required.'], 422);
        }

        $filePath = null;
        $fileName = null;
        $fileType = null;
        $fileSize = null;

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            // store on public disk inside storage/app/public/chat_files
            $filePath = $file->store('chat_files', 'public');
            $fileName = $file->getClientOriginalName();
            $fileType = $file->getClientMimeType();
            $fileSize = $file->getSize();
        }

        $message = Message::create([
            'sender_id'   => Auth::id(),
            'receiver_id' => $request->receiver_id,
            'message'     => $request->message,
            'file_path'   => $filePath,
            'file_name'   => $fileName,
            'file_type'   => $fileType,
            'file_size'   => $fileSize,
        ]);

        // Return message with file_url
        return response()->json([
            'message' => $message,
            'file_url' => $filePath ? Storage::url($filePath) : null
        ]);
    }
    public function inquery(){
        $inquery = Inquery::latest()->paginate(10);
        return view('admin.inquery.index', compact('inquery'));
    }
    
  public function changeStatus(Request $request){
        $user = User::find($request->id);
        $user->status = $user->status == 1 ? 0 : 1;
        $user->save();
        return response()->json($user->status);
    }
    public function changeStatusService(Request $request){
        $user = OurService::find($request->id);
        $user->status = $user->status == 1 ? 0 : 1;
        $user->save();
        return response()->json($user->status);
    }
     public function changeStatusBlogs(Request $request){
        $user = Blog::find($request->id);
        $user->status = $user->status == 1 ? 0 : 1;
        $user->save();
        return response()->json($user->status);
    }
        public function changeStatusebook(Request $request){
        $user = Ebook::find($request->id);
        $user->status = $user->status == 1 ? 0 : 1;
        $user->save();
        return response()->json($user->status);
    }
}
