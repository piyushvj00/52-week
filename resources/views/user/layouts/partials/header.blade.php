<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="description" content="Ekero Partners - Group Investment Management System">
    <meta name="keywords" content="investment, groups, management, portal, admin">
    <meta name="author" content="Ekero Partners">
    <title>Ekero Partners - Admin Dashboard</title>
    
    <!-- Favicon -->
    <link rel="apple-touch-icon" href="{{ asset('admin/app-assets/images/ico/apple-icon-120.png')}}">
    <link rel="icon" type="image/x-icon" href="{{ asset('web/fabb.ico') }}">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" />

    <!-- Theme CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/app-assets/css/themes/dark-layout.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/app-assets/css/themes/bordered-layout.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/app-assets/css/themes/semi-dark-layout.css')}}">

    <!-- Vendor CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/app-assets/vendors/css/vendors.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/app-assets/vendors/css/charts/apexcharts.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/app-assets/vendors/css/extensions/toastr.min.css')}}">

    <!-- Core CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/app-assets/css/bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/app-assets/css/bootstrap-extended.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/app-assets/css/colors.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/app-assets/css/components.css')}}">

    <!-- Page CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/app-assets/css/core/menu/menu-types/vertical-menu.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/app-assets/css/pages/dashboard-ecommerce.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/app-assets/css/plugins/charts/chart-apex.css')}}">
    
    <!-- External CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/assets/css/style.css')}}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        :root {
            --primary-color: #7367f0;
            --success-color: #28c76f;
            --danger-color: #ea5455;
            --warning-color: #ff9f43;
            --info-color: #00cfe8;
        }

        .notification-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background: linear-gradient(135deg, var(--danger-color), #ff6b6b);
            color: white;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            font-size: 0.7rem;
            display: flex;
            align-items: center;
            justify-content: center;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }

        .custom-alert {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 15px 20px;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
            z-index: 9999;
            opacity: 1;
            transition: all 0.5s ease-in-out;
            display: flex;
            align-items: center;
            gap: 12px;
            max-width: 400px;
            backdrop-filter: blur(10px);
        }

        .custom-success-alert {
            background: linear-gradient(135deg, var(--success-color), #48da89);
            color: white;
            border-left: 4px solid #1f9d55;
        }

        .custom-danger-alert {
            background: linear-gradient(135deg, var(--danger-color), #ff6b6b);
            color: white;
            border-left: 4px solid #d63031;
        }

        .alert-icon {
            width: 20px;
            height: 20px;
            flex-shrink: 0;
        }

        .user-avatar {
            border: 2px solid #e8e8e8;
            transition: all 0.3s ease;
        }

        .user-avatar:hover {
            border-color: var(--primary-color);
            transform: scale(1.05);
        }

        .dropdown-user-link {
            padding: 8px 12px;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .dropdown-user-link:hover {
            background: rgba(115, 103, 240, 0.1);
        }

        .notification-dropdown {
            min-width: 320px;
            border-radius: 12px;
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.15);
            border: none;
        }

        .notification-item {
            padding: 12px 16px;
            border-bottom: 1px solid #f1f1f1;
            transition: background 0.3s ease;
            cursor: pointer;
        }

        .notification-item:hover {
            background: #f8f9fa;
        }

        .notification-item.unread {
            background: rgba(115, 103, 240, 0.05);
            border-left: 3px solid var(--primary-color);
        }

        .notification-time {
            font-size: 0.75rem;
            color: #b9b9c3;
        }

        .header-navbar {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.95);
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body class="vertical-layout vertical-menu-modern navbar-floating footer-static" data-open="click" data-menu="vertical-menu-modern" data-col="">

    <!-- Success/Error Alerts -->
    @if(Session::has('success'))
        <div id="success-alert" class="custom-alert custom-success-alert">
            <img class="alert-icon" src="{{ asset('admin/icons/success.gif') }}" alt="Success">
            <span>{{ Session::get('success') }}</span>
        </div>
    @endif

    @if(Session::has('error'))
        <div id="error-alert" class="custom-alert custom-danger-alert">
            <i class="bi bi-exclamation-triangle-fill alert-icon"></i>
            <span>{{ Session::get('error') }}</span>
        </div>
    @endif

    <!-- Flash Messages Container -->
    <div id="flash-message" class="position-fixed top-0 end-0 p-3" style="z-index: 9999;"></div>

    <!-- BEGIN: Header -->
    <nav class="header-navbar navbar navbar-expand-lg align-items-center floating-nav navbar-light navbar-shadow container-xxl">
        <div class="navbar-container d-flex content">
            <ul class="nav navbar-nav align-items-center ms-auto">

                <!-- Notifications -->
                @php
                    $notifications = App\Models\Notification::where('is_read', 0)
                        ->where('receiver_id', auth()->user()->id)
                        ->orderBy('created_at', 'desc')
                        ->get();
                    $unreadCount = $notifications->where('is_read', 0)->count();
                @endphp

                <li class="nav-item dropdown dropdown-notification me-25">
                    <a class="nav-link position-relative" href="#" data-bs-toggle="dropdown">
                        <i class="ficon me-2 mt-1" data-feather="bell"></i>
                        @if($unreadCount > 0)
                            <span class="notification-badge me-2 mt-1">{{ $unreadCount }}</span>
                        @endif
                    </a>

                    <ul class="dropdown-menu dropdown-menu-media dropdown-menu-end notification-dropdown">
                        <li class="dropdown-menu-header">
                            <div class="dropdown-header d-flex justify-content-between align-items-center">
                                <h5 class="notification-title mb-0">Notifications</h5>
                                @if($unreadCount > 0)
                                    <form action="{{ route('notifications.markAllRead') }}" method="POST" class="m-0 p-0">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-outline-primary">Mark all read</button>
                                    </form>
                                @endif
                            </div>
                        </li>

                        <li class="scrollable-container media-list">
                            @forelse($notifications as $notif)
                                <a class="d-flex dropdown-item notification-item {{ $notif->is_read ? '' : 'unread' }}"
                                   href="{{ route('user.member.details', $notif->user_id) }}">
                                    <div class="me-2">
                                        <div class="avatar bg-light-primary">
                                            <i data-feather="bell" class="avatar-icon"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="media-heading mb-1">{{ $notif->title }}</h6>
                                        <p class="notification-text mb-0">{{ $notif->message ?? 'New notification' }}</p>
                                        <small class="notification-time">
                                            <i class="bi bi-clock me-1"></i>
                                            {{ $notif->created_at->diffForHumans() }}
                                        </small>
                                    </div>
                                </a>
                            @empty
                                <div class="dropdown-item text-center py-4">
                                    <i class="bi bi-bell-slash display-4 text-muted d-block mb-2"></i>
                                    <span class="text-muted">No notifications</span>
                                </div>
                            @endforelse
                        </li>
                    </ul>
                </li>

                <!-- User Profile -->
                <li class="nav-item dropdown dropdown-user">
                    <a class="nav-link dropdown-user-link dropdown-toggle" id="dropdown-user" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="user-nav d-sm-flex d-none">
                            <span class="user-name fw-bolder">{{ auth()->user()->name ?? 'John Doe' }}</span>
                            <span class="user-status">
                                @if(auth()->user()->role == 1)
                                    <span class="badge bg-primary">Admin</span>
                                @elseif(auth()->user()->role == 2)
                                    <span class="badge bg-success">Leader</span>
                                @else
                                    <span class="badge bg-secondary">User</span>
                                @endif
                            </span>
                        </div>
                        <span class="avatar">
                            <img class="round user-avatar" src="{{ asset('admin/app-assets/images/portrait/small/avatar-s-11.jpg')}}" alt="avatar" height="40" width="40">
                            <span class="avatar-status-online bg-success"></span>
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-user">
                        <a class="dropdown-item" href="{{ route('user.profile') }}">
                            <i class="me-50" data-feather="user"></i>
                            <span>Profile</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('user.logout') }}">
                            <i class="me-50" data-feather="power"></i>
                            <span>Logout</span>
                        </a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <script>
        // Auto-hide alerts
        setTimeout(function () {
            const successAlert = document.getElementById('success-alert');
            const errorAlert = document.getElementById('error-alert');
            
            if (successAlert) {
                successAlert.style.opacity = '0';
                setTimeout(() => successAlert.remove(), 500);
            }
            if (errorAlert) {
                errorAlert.style.opacity = '0';
                setTimeout(() => errorAlert.remove(), 500);
            }
        }, 5000);

        // Toast notification function
        function showToast(message, type = 'success') {
            const toastHTML = `
                <div class="toast align-items-center text-white bg-${type} border-0 mb-2" role="alert">
                    <div class="d-flex">
                        <div class="toast-body">
                            <i class="bi bi-${type === 'success' ? 'check-circle' : 'exclamation-triangle'} me-2"></i>
                            ${message}
                        </div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                    </div>
                </div>
            `;
            
            const flashContainer = document.getElementById('flash-message');
            flashContainer.insertAdjacentHTML('beforeend', toastHTML);

            const toastElList = flashContainer.querySelectorAll('.toast');
            toastElList.forEach(toastEl => {
                const toast = new bootstrap.Toast(toastEl, { delay: 4000 });
                toast.show();
                toastEl.addEventListener('hidden.bs.toast', () => toastEl.remove());
            });
        }
    </script>