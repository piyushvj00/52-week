<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="description"
        content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords"
        content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>Ekero Partners</title>
    <link rel="apple-touch-icon" href="{{ asset('admin/app-assets/images/ico/apple-icon-120.png')}}">
    <link rel="icon" type="image/x-icon" href="{{ asset('web/fabb.ico') }}">

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" />

    <link rel="stylesheet" type="text/css" href="{{ asset('admin/app-assets/css/themes/dark-layout.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/app-assets/css/themes/bordered-layout.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/app-assets/css/themes/semi-dark-layout.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/app-assets/css/themes/semi-dark-layout.css')}}">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('admin/app-assets/css/core/menu/menu-types/vertical-menu.css')}}">
    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/app-assets/vendors/css/vendors.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/app-assets/vendors/css/charts/apexcharts.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/app-assets/vendors/css/extensions/toastr.min.css')}}">
    <!-- END: Vendor CSS-->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/app-assets/css/bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/app-assets/css/bootstrap-extended.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/app-assets/css/colors.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/app-assets/css/components.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/app-assets/css/themes/dark-layout.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/app-assets/css/themes/bordered-layout.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/app-assets/css/themes/semi-dark-layout.css')}}">

    <link rel="stylesheet" type="text/css" href="{{ asset('admin/app-assets/css/pages/app-chat.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/app-assets/css/pages/app-chat-list.css')}}">
    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('admin/app-assets/css/core/menu/menu-types/vertical-menu.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/app-assets/css/pages/dashboard-ecommerce.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/app-assets/css/plugins/charts/chart-apex.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <!-- END: Page CSS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/assets/css/style.css')}}">
    <!-- <link rel="stylesheet" type="text/css" href="{{ asset('admin/assets/css/core.css')}}"> -->
    <!-- END: Custom CSS-->
    <style>
        .custom-success-alert {
            position: fixed;
            top: 20px;
            right: 20px;
            background-color: #28a745;
            /* Bootstrap success green */
            color: white;
            padding: 15px 20px;
            border-radius: 5px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            z-index: 9999;
            opacity: 1;
            transition: opacity 0.5s ease-in-out;
            width: fit-content;
        }

        .custom-danger-alert {
            position: fixed;
            top: 20px;
            right: 20px;
            background-color: #a73128ff;
            /* Bootstrap success green */
            color: white;
            padding: 15px 20px;
            border-radius: 5px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            z-index: 9999;
            opacity: 1;
            transition: opacity 0.5s ease-in-out;
            width: fit-content;
        }
    </style>
</head>

<body class="vertical-layout vertical-menu-modern  navbar-floating footer-static  " data-open="click"
    data-menu="vertical-menu-modern" data-col="">
    @if(Session::has('success'))
        <div id="success-alert" class="custom-success-alert">
            <img width="20px" src="{{ asset('admin/icons/success.gif') }}" alt=""> {{ Session::get('success') }}
        </div>
    @endif
    @if(Session::has('error'))
        <div id="success-alert" class="custom-danger-alert">
            {{ Session::get('error') }}
        </div>
    @endif
    <!-- BEGIN: Header-->
    <nav
        class="header-navbar navbar navbar-expand-lg align-items-center floating-nav navbar-light navbar-shadow container-xxl">
        <div class="navbar-container d-flex content">

            <ul class="nav navbar-nav align-items-center ms-auto">

                <div id="flash-message" class="position-fixed top-0 end-0 p-3" style="z-index: 9999;"></div>
                @php
                    $notifications = App\Models\Notification::where('is_read', 0)->where('receiver_id', auth()->user()->id)
                        ->orderBy('created_at', 'desc')
                        ->get();
                    $unreadCount = $notifications->where('is_read', 0)->count();
                @endphp

                <li class="nav-item dropdown dropdown-notification me-25">
                    <a class="nav-link" href="#" data-bs-toggle="dropdown">
                        <i class="ficon" data-feather="bell"></i>
                        @if($unreadCount > 0)
                            <span class="badge rounded-pill bg-danger badge-up">{{ $unreadCount }}</span>
                        @endif
                    </a>

                    <ul class="dropdown-menu dropdown-menu-media dropdown-menu-end">
                        <li class="dropdown-menu-header d-flex justify-content-between align-items-center">
                            <h4 class="notification-title mb-0">Notifications</h4>
                            @if($unreadCount > 0)
                                <form action="{{ route('leader.notifications.markAllRead') }}" method="POST" class="m-0 p-0">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-link">Mark all read</button>
                                </form>
                            @endif
                        </li>

                        @forelse($notifications as $notif)
                            <li class="scrollable-container media-list">
                                <a class="d-flex dropdown-item {{ $notif->is_read ? '' : 'fw-bold' }}"
                                    href="{{ route('leader.member.details', $notif->user_id) }}">
                                    <div class="me-1">
                                        <div class="avatar bg-light-primary">
                                            <i data-feather="bell" class="avatar-icon"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="media-heading">{{ $notif->title }}</h6>
                                        <small class="notification-text">{{ $notif->created_at->diffForHumans() }}</small>
                                    </div>
                                </a>
                            </li>
                        @empty
                            <li class="dropdown-item text-center">
                                No notifications
                            </li>
                        @endforelse
                    </ul>
                </li>

                <li class="nav-item dropdown dropdown-user"><a class="nav-link dropdown-toggle dropdown-user-link"
                        id="dropdown-user" href="#" data-bs-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        <div class="user-nav d-sm-flex d-none"><span
                                class="user-name fw-bolder">{{ auth()->user()->name ?? 'John Doe' }}</span><span
                                class="user-status">Leader</span></div><span class="avatar"><img class="round"
                                src="{{ asset('admin/app-assets/images/portrait/small/avatar-s-11.jpg')}}" alt="avatar"
                                height="40" width="40"><span class="avatar-status-online"></span></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-user"><a
                            class="dropdown-item" href="{{ route('leader.update.profile') }}"><i class="me-50"
                                data-feather="user"></i>
                            Profile</a><a class="dropdown-item" href="{{ route('leader.logout') }}"><i class="me-50"
                                data-feather="power"></i> Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <script>
        setTimeout(function () {
            const alert = document.getElementById('success-alert');
            if (alert) {
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 500); // Remove after fade
            }
        }, 3000); // 3 seconds
    </script>

    <script>

        function showToast(message, type = 'success') {
            // type can be 'success', 'danger', 'warning', 'info'
            let toastHTML = `
        <div class="toast align-items-center text-white bg-${type} border-0 mb-2" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    ${message}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    `;
            let flashContainer = document.getElementById('flash-message');
            flashContainer.insertAdjacentHTML('beforeend', toastHTML);

            // Initialize Bootstrap toast
            let toastElList = [].slice.call(flashContainer.querySelectorAll('.toast'));
            let toastList = toastElList.map(function (toastEl) {
                let toast = new bootstrap.Toast(toastEl, { delay: 3000 });
                toast.show();
                toastEl.addEventListener('hidden.bs.toast', () => toastEl.remove());
                return toast;
            });
        }
    </script>

    <!-- END: Header-->