<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="description" content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>Register Page - ekero - Bootstrap HTML admin template</title>
    <link rel="apple-touch-icon" href="{{ asset('admin/app-assets/images/ico/apple-icon-120.png')}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('admin/app-assets/images/ico/favicon.ico')}}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/app-assets/vendors/css/vendors.min.css')}}">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/app-assets/css/bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/app-assets/css/bootstrap-extended.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/app-assets/css/colors.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/app-assets/css/components.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/app-assets/css/themes/dark-layout.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/app-assets/css/themes/bordered-layout.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/app-assets/css/themes/semi-dark-layout.css')}}">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/app-assets/css/core/menu/menu-types/vertical-menu.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/app-assets/css/plugins/forms/form-validation.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/app-assets/css/pages/authentication.css')}}">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/assets/css/style.css')}}">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern blank-page navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="blank-page">
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <div class="auth-wrapper auth-cover">
                    <div class="auth-inner row m-0">
                     
                        <!-- Left Text-->
                        <div class="d-none d-lg-flex col-lg-6 align-items-center p-5">

                            <div class="w-100 d-lg-flex align-items-center justify-content-center px-5">
                        <a class="brand-logo" href="index.html">
                            <img src="{{ asset('images/newlogo.png') }}" alt="Ekero Logo" style="height: 120px; width:auto; position: static !important;">
                        </a>
                                <img class="img-fluid" src="{{ asset('admin/app-assets/images/pages/register-v2.svg')}}" alt="Register V2" /></div>
                        </div>
                        <!-- /Left Text-->
                        <!-- Register-->
                        <div class="d-flex col-lg-6 align-items-center auth-bg px-2 p-lg-5">
                            <div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto">
                                <h2 class="card-title fw-bold mb-1">Reset Your Password</h2>
                                <!-- <p class="card-text mb-2">Make your app management easy and fun!</p> -->
                                <form class="mt-2 row" action="{{ route('user.forget.password.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf

                                    <!-- Email -->
                                    <div class="mb-1 col-md-6">
                                        <label class="form-label" for="email">Email</label>
                                        <input class="form-control" id="email" type="email" name="email" placeholder="john@example.com" aria-describedby="email" tabindex="2" />
                                        <small class="text-danger" id="email-error"></small>
                                    </div>

                                    <!-- OTP Verification -->
                                    <div class="mb-1 col-md-12 d-flex gap-2 align-items-center justify-content-start">
                                        <div>
                                            <label class="form-label" for="otp">OTP Verification</label>
                                            <div class="input-group">
                                                <input class="form-control" id="otp" type="text" name="otp" placeholder="Enter OTP" aria-describedby="otp" tabindex="5" />
                                                <button class="btn btn-outline-secondary" type="button" id="send-otp">Send OTP</button>
                                            </div>
                                            <small class="text-success" id="otp-success"></small>
                                        </div>
                                     <div>
                                        <!-- Verify OTP Button -->
                                        <button class="btn btn-success w-100 mt-2" type="button" id="verify-otp-btn">Verify OTP</button>
                                        
                                        <small class="text-success" id="otp-success"></small>
                                        <small class="text-danger" id="otp-error"></small>
                                     </div>
                                       
                                    </div>

                                    <!-- Password -->
                                    <div class="mb-1 col-md-6">
                                        <label class="form-label" for="register-password">Enter New Password</label>
                                        <div class="input-group input-group-merge form-password-toggle">
                                            <input class="form-control form-control-merge" id="register-password" type="password" name="password" placeholder="············" aria-describedby="password" tabindex="3" />
                                            <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                                        @error('password')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                        </div>
                                    </div>

                                    <!-- Submit -->
                                    <button class="btn btn-primary w-100" type="submit" tabindex="8" id="signup-btn" disabled>Submit</button>
                                </form>

                                <p class="text-center mt-2"><a href="{{ route('user.login') }}"><span>&nbsp;Back to Login</span></a></p>
                                
                            </div>
                        </div>
                        <!-- /Register-->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- END: Content-->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function() {
    $('#send-otp').on('click', function() {
        let email = $('#email').val();
        $('#email-error').text('');
        $('#otp-success').text('');

        if (!email) {
            $('#email-error').text('Please enter your email first.');
            return;
        }

        // Disable button during sending
        $('#send-otp').prop('disabled', true).text('Sending...');

        $.ajax({
            url: "{{ route('user.send.otp.pass') }}",  // backend route
            type: "POST",
            data: {
                email: email,
                _token: "{{ csrf_token() }}"
            },
            success: function(response) {
                $('#otp-success').text(response.message);
                $('#send-otp').prop('disabled', false).text('Resend OTP');
            },
            error: function(xhr) {
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    $('#email-error').text(xhr.responseJSON.message);
                } else {
                    $('#email-error').text('Something went wrong. Please try again.');
                }
                $('#send-otp').prop('disabled', false).text('Send OTP');
            }
        });
    });
});
</script>
<script>
$(document).ready(function() {

    // Verify OTP button
    $('#verify-otp-btn').on('click', function() {
        let email = $('#email').val();
        let otp = $('#otp').val();

        // Clear previous messages
        $('#otp-success').text('');
        $('#otp-error').text('');

        if (!email) {
            $('#email-error').text('Please enter your email first.');
            return;
        }

        if (!otp) {
            $('#otp-error').text('Please enter the OTP.');
            return;
        }

        // Disable button while verifying
        $(this).prop('disabled', true).text('Verifying...');

        $.ajax({
            url: "{{ route('user.verify.otp') }}",
            type: "POST",
            data: {
                email: email,
                otp: otp,
                _token: "{{ csrf_token() }}"
            },
            success: function(response) {
                if (response.status) {
                    $('#otp-success').text(response.message);
                    $('#otp-error').text('');
                } else {
                    $('#otp-error').text(response.message);
                    $('#otp-success').text('');
                }
                $('#verify-otp-btn').prop('disabled', false).text('Verify OTP');
            },
            error: function(xhr) {
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    $('#otp-error').text(xhr.responseJSON.message);
                } else if (xhr.responseJSON && xhr.responseJSON.errors) {
                    // Show first error
                    let firstKey = Object.keys(xhr.responseJSON.errors)[0];
                    $('#otp-error').text(xhr.responseJSON.errors[firstKey][0]);
                } else {
                    $('#otp-error').text('Something went wrong. Please try again.');
                }
                $('#verify-otp-btn').prop('disabled', false).text('Verify OTP');
            }
        });
    });

});
</script>
<script>
    $('#verify-otp-btn').on('click', function() {
    let email = $('#email').val();
    let otp = $('#otp').val();

    // Clear previous messages
    $('#otp-success').text('');
    $('#otp-error').text('');

    if (!email) { AnimationPlaybackEvent
        $('#email-error').text('Please enter your email first.');
        return;
    }

    if (!otp) {
        $('#otp-error').text('Please enter the OTP.');
        return;
    }

    // Disable verify button while verifying
    $(this).prop('disabled', true).text('Verifying...');

    $.ajax({
        url: "{{ route('user.verify.otp') }}",
        type: "POST",
        data: {
            email: email,
            otp: otp,
            _token: "{{ csrf_token() }}"
        },
        success: function(response) {
            if (response.status) {
                $('#otp-success').text(response.message);
                $('#otp-error').text('');
                // Enable Sign Up button
                $('#signup-btn').prop('disabled', false);
            } else {
                $('#otp-error').text(response.message);
                $('#otp-success').text('');
            }
            $('#verify-otp-btn').prop('disabled', false).text('Verify OTP');
        },
        error: function(xhr) {
            if (xhr.responseJSON && xhr.responseJSON.message) {
                $('#otp-error').text(xhr.responseJSON.message);
            } else if (xhr.responseJSON && xhr.responseJSON.errors) {
                let firstKey = Object.keys(xhr.responseJSON.errors)[0];
                $('#otp-error').text(xhr.responseJSON.errors[firstKey][0]);
            } else {
                $('#otp-error').text('Something went wrong. Please try again.');
            }
            $('#verify-otp-btn').prop('disabled', false).text('Verify OTP');
        }
    });
});

</script>



    <!-- BEGIN: Vendor JS-->
    <script src="{{ asset('admin/app-assets/vendors/js/vendors.min.js')}}"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="{{ asset('admin/app-assets/vendors/js/forms/validation/jquery.validate.min.js')}}"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{ asset('admin/app-assets/js/core/app-menu.js')}}"></script>
    <script src="{{ asset('admin/app-assets/js/core/app.js')}}"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="{{ asset('admin/app-assets/js/scripts/pages/auth-register.js')}}"></script>
    <!-- END: Page JS-->

    <script>
        $(window).on('load', function() {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        })
    </script>

</body>
<!-- END: Body-->

</html>