<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LeaderController;
use App\Http\Controllers\Admin\MemberController;
use App\Http\Controllers\Admin\PortalController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\User\GroupController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Leader\AuthController as LeaderAuthController;
use App\Http\Controllers\Leader\DashBoardController as LeaderDashBoardController;
use App\Http\Controllers\User\AuthController as UserAuthController;
use App\Http\Controllers\User\DashBoardController as UserDashBoardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('admin.auth.login');
// });

Route::post('admin/login', [AuthController::class, 'login'])->name('login');
Route::get('admin/login', [AuthController::class, 'loginGet']);
Route::get('/admin', [AuthController::class, 'loginGet']);

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
  Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
  Route::get('/logout', [DashboardController::class, 'logout'])->name('logout');
  Route::resource('portal', PortalController::class, );
  Route::resource('groups', AdminController::class, );
  Route::resource('leader', LeaderController::class, );
  Route::resource('member', MemberController::class, );
  Route::get('/group/assign/{id}', [AdminController::class, 'assignMember'])->name('groups.assign.member');
  Route::get('/group/link/{id}', [LeaderController::class, 'groupLink'])->name('user.group.link');
  Route::get('/group/links/{id}', [MemberController::class, 'groupLink'])->name('member.group.link');
  Route::post('/group/member', [AdminController::class, 'assignMemberAdd'])->name('group.member.assign');
  Route::post('/leader/toggle-status', [LeaderController::class, 'toggleStatus'])->name('leader.toggle_user_status');
  Route::post('/leader/toggle-statuss', [MemberController::class, 'toggleStatus'])->name('member.toggle_user_status');
  Route::post('/view-all/notification', [MemberController::class, 'viewAllNotification'])->name('notifications.markAllRead');
  Route::get('/contribution/list', [MemberController::class, 'contributionList'])->name('contribution.list');
  Route::get('/contribution-list/{id}', [MemberController::class, 'contributionListByID'])->name('contribution.listt');
  Route::post('/contribution/status', [MemberController::class, 'contributionStatus'])->name('contribution.status');
  Route::post('/proceed/payment', [MemberController::class, 'proceedPayment'])->name('proceed.payment');
});

// All routes for the leader(role - 2) -------------------------------------------------------------
Route::prefix('leader')->group(function () {
  // register and login Routes for leader
  Route::get('/register', [LeaderAuthController::class, 'register'])->name('leader.register');
  Route::post('/register', [LeaderAuthController::class, 'registerStore'])->name('register.store');
  Route::post('/send-otp', [LeaderAuthController::class, 'sendOtp'])->name('leader.send.otp');
  Route::post('/verify-otp', [LeaderAuthController::class, 'verifyOtp'])->name('leader.verify.otp');
  Route::get('/login', [LeaderAuthController::class, 'login'])->name('leader.login');
  Route::post('/login', [LeaderAuthController::class, 'loginStore'])->name('leader.login.store');
  Route::get('/forget-password', [LeaderAuthController::class, 'forgetPass'])->name('leader.forget.password');
  Route::post('/send-otp-password', [LeaderAuthController::class, 'sendOtpPassword'])->name('leader.send.otp.pass');
  Route::post('/forget-password', [LeaderAuthController::class, 'forgetPassStore'])->name('leader.forget.password.store');

  // middle ware applied routes for the leader
  Route::middleware('leader')->group(function () {
    Route::get('/dashboard', [LeaderDashBoardController::class, 'dashboard'])->name('leader.dashboard');
    Route::get('/group', [LeaderDashBoardController::class, 'group'])->name('leader.group');
    Route::get('/group/assign/{id}', [LeaderDashBoardController::class, 'assignMember'])->name('leader.groups.assign.member');
    Route::get('/group/create', [LeaderDashBoardController::class, 'groupCreate'])->name('leader.groups.create');
    Route::post('/group/assign/member', [LeaderDashBoardController::class, 'assignMembers'])->name('leader.group.member.assign');
    Route::get('/group/member/{id}', [LeaderDashBoardController::class, 'groupMember'])->name('leader.groups.member');
    Route::delete('/portal/{portal}/member/{user}', [LeaderDashBoardController::class, 'destroyMember'])->name('portal.members.remove');
    Route::get('/group/member/details/{id}', [LeaderDashBoardController::class, 'memberDetails'])->name('leader.member.details');
    Route::get('/update/profile', [LeaderDashBoardController::class, 'leaderUpdateProfile'])->name('leader.update.profile');
    Route::post('/update/profile', [LeaderDashBoardController::class, 'leaderProfile'])->name('leader.update.profilePost');
    Route::get('/group/edit/{id}', [LeaderDashBoardController::class, 'editGroup'])->name('leader.groups.edit');
    Route::put('/group/update/{id}', [LeaderDashBoardController::class, 'updateGroup'])->name('leader.groups.update');
    Route::get('/contribution', [LeaderDashBoardController::class, 'contribution'])->name('leader.contribution');
    Route::post('/real-all', [LeaderDashBoardController::class, 'readAllNotification'])->name('leader.notifications.markAllRead');
  Route::get('/contribution/list/{id}', [LeaderDashBoardController::class, 'contributionList'])->name('leader.contribution.list');
  Route::post('/contribution/status', [MemberController::class, 'contributionStatus'])->name('leader.contribution.status');
  Route::get('/logout', [MemberController::class, 'logout'])->name('leader.logout');





  });
});


// All routes for the user(role - 3) -------------------------------------------------
Route::prefix('user')->group(function () {
    // register and login Routes for user
    Route::get('/register', [UserAuthController::class, 'register'])->name('user.register');
    Route::post('/register', [UserAuthController::class, 'registerStore'])->name('user.store');
    Route::post('/send-otp', [UserAuthController::class, 'sendOtp'])->name('user.send.otp');
    Route::post('/verify-otp', [UserAuthController::class, 'verifyOtp'])->name('user.verify.otp');
    Route::get('/login', [UserAuthController::class, 'login'])->name('user.login');
    Route::post('/login', [UserAuthController::class, 'loginStore'])->name('user.login.store');
    Route::post('/send-otp-password', [UserAuthController::class, 'sendOtpPassword'])->name('user.send.otp.pass');
    Route::get('/forget-password',[UserAuthController::class,'forgetPass'])->name('user.forget.password');
    Route::post('/forget-password',[UserAuthController::class,'forgetPassStore'])->name('user.forget.password.store');
    
    // middle ware applied routes for the user
    Route::middleware('user')->group(function () {
      Route::get('/dashboard', [UserDashBoardController::class, 'dashboard'])->name('user.dashboard');
      Route::get('/profile', [UserDashBoardController::class, 'userProfile'])->name('user.profile');
      Route::post('/profile', [UserDashBoardController::class, 'userUpdateProfile'])->name('user.update.profile');
      Route::post('/read-all', [UserDashBoardController::class, 'readAllNotification'])->name('user.notifications.markAllRead');


      // Group & Details routes
      Route::get('/group', [GroupController::class, 'group'])->name('user.group');
      Route::get('/contribution', [GroupController::class, 'group'])->name('user.group.contribution');
      Route::get('/group-details', [GroupController::class, 'groupDetails'])->name('user.group.details');
      Route::get('/group-member', [GroupController::class,'groupMember'])->name('user.group.member');

      // contribution & payment
      Route::get('/my-contribution',[UserDashBoardController::class,'myContribution'])->name('user.my.contribution');
      Route::post('/my-contribution/payment',[UserDashBoardController::class,'myContributionPay'])->name('user.my.contribution.pay');
      Route::get('/payment-reciept',[UserDashBoardController::class,'PaymentRecieptDownload'])->name('user.payment.reciept');

   
      // group char for user
      Route::get('groups/{group}/chat', [GroupController::class, 'index'])->name('groups.chat');
      Route::post('groups/{group}/chat', [GroupController::class, 'store'])->name('groups.chat.store');
      Route::get('groups/{group}/chat/messages', [GroupController::class, 'messages'])->name('groups.chat.messages');
      Route::get('/logout', [GroupController::class, 'logout'])->name('user.logout');


  });

}); 