@extends('admin.layouts.main')

@section('title', 'Create Leader')

@section('content')
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0">Leader Management</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="{{ route('leader.index') }}">Leaders</a>
                                    </li>
                                    <li class="breadcrumb-item active">Create New Leader</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
                    <div class="mb-1 breadcrumb-right">
                        <div class="dropdown">
                            <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" type="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i data-feather="grid"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="app-todo.html">
                                    <i class="me-1" data-feather="check-square"></i>
                                    <span class="align-middle">Todo</span>
                                </a>
                                <a class="dropdown-item" href="app-chat.html">
                                    <i class="me-1" data-feather="message-square"></i>
                                    <span class="align-middle">Chat</span>
                                </a>
                                <a class="dropdown-item" href="app-email.html">
                                    <i class="me-1" data-feather="mail"></i>
                                    <span class="align-middle">Email</span>
                                </a>
                                <a class="dropdown-item" href="app-calendar.html">
                                    <i class="me-1" data-feather="calendar"></i>
                                    <span class="align-middle">Calendar</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Information Cards -->
                <div class="row mb-4">
                    <div class="col-md-4">
                        <div class="info-box d-flex">
                            <div class="info-icon primary">
                                <i class="fas fa-user-shield"></i>
                            </div>
                            <div class="info-content">
                                <h6>Leader Information</h6>
                                <p>Enter basic details about the leader</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="info-box d-flex">
                            <div class="info-icon warning">
                                <i class="fas fa-lock"></i>
                            </div>
                            <div class="info-content">
                                <h6>Security Settings</h6>
                                <p>Set up login credentials</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="info-box d-flex">
                            <div class="info-icon success">
                                <i class="fas fa-image"></i>
                            </div>
                            <div class="info-content">
                                <h6>Profile Image</h6>
                                <p>Upload a professional photo</p>
                            </div>
                        </div>
                    </div>
                </div>

                <section id="basic-horizontal-layouts">
                    <div class="row">
                        <div class="col-md-12 col-12">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h4 class="card-title">
                                        <i class="fas fa-user-plus me-2 text-primary"></i>
                                        Create New Leader
                                    </h4>
                                    <span class="badge bg-primary">New Leader</span>
                                </div>
                                <div class="card-body">
                                    <form class="form form-horizontal" action="{{ route('leader.store') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        
                                        <!-- Personal Information Section -->
                                        <div class="form-section">
                                            <h5 class="section-title">
                                                <i class="fas fa-user-circle me-2 text-primary"></i>
                                                Personal Information
                                            </h5>
                                            <div class="row">
                                                {{-- Name --}}
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Full Name <span class="text-danger">*</span></label>
                                                    <div class="input-group">
                                                        <span class="input-group-text bg-light">
                                                            <i class="fas fa-user text-primary"></i>
                                                        </span>
                                                        <input type="text" class="form-control" name="name"
                                                            placeholder="Enter full name" value="{{ old('name') }}"
                                                            required>
                                                    </div>
                                                    <div class="form-text">Enter the leader's full legal name</div>
                                                    @error('name') 
                                                        <div class="text-danger small mt-1">
                                                            <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>

                                                {{-- Email --}}
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Email Address <span class="text-danger">*</span></label>
                                                    <div class="input-group">
                                                        <span class="input-group-text bg-light">
                                                            <i class="fas fa-envelope text-primary"></i>
                                                        </span>
                                                        <input type="email" class="form-control" name="email"
                                                            placeholder="john.doe@example.com" value="{{ old('email') }}"
                                                            required>
                                                    </div>
                                                    <div class="form-text">This will be used for login and notifications</div>
                                                    @error('email') 
                                                        <div class="text-danger small mt-1">
                                                            <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>

                                                {{-- Phone Number --}}
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Phone Number <span class="text-danger">*</span></label>
                                                    <div class="input-group">
                                                        <span class="input-group-text bg-light">
                                                            <i class="fas fa-phone text-primary"></i>
                                                        </span>
                                                        <input type="text" class="form-control" name="phone"
                                                            placeholder="0909090909" value="{{ old('phone') }}"
                                                            required>
                                                    </div>
                                                    <div class="form-text">Include country code if international</div>
                                                    @error('phone') 
                                                        <div class="text-danger small mt-1">
                                                            <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Security Section -->
                                        <div class="form-section">
                                            <h5 class="section-title">
                                                <i class="fas fa-shield-alt me-2 text-primary"></i>
                                                Security Settings
                                            </h5>
                                            <div class="row">
                                                {{-- Password --}}
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Password <span class="text-danger">*</span></label>
                                                    <div class="input-group">
                                                        <span class="input-group-text bg-light">
                                                            <i class="fas fa-key text-primary"></i>
                                                        </span>
                                                        <input type="password" class="form-control" name="password"
                                                            placeholder="Create secure password" required
                                                            id="password">
                                                        <button type="button" class="btn btn-outline-secondary toggle-password" 
                                                                data-target="password">
                                                            <i class="fas fa-eye"></i>
                                                        </button>
                                                    </div>
                                                    <div class="form-text">Minimum 8 characters with letters and numbers</div>
                                                    @error('password') 
                                                        <div class="text-danger small mt-1">
                                                            <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>

                                                {{-- Confirm Password --}}
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Confirm Password <span class="text-danger">*</span></label>
                                                    <div class="input-group">
                                                        <span class="input-group-text bg-light">
                                                            <i class="fas fa-key text-primary"></i>
                                                        </span>
                                                        <input type="password" class="form-control"
                                                            name="password_confirmation" placeholder="Confirm your password"
                                                            required id="password_confirmation">
                                                        <button type="button" class="btn btn-outline-secondary toggle-password" 
                                                                data-target="password_confirmation">
                                                            <i class="fas fa-eye"></i>
                                                        </button>
                                                    </div>
                                                    <div class="form-text">Re-enter the password to confirm</div>
                                                </div>
                                            </div>
                                            
                                            <!-- Password Strength Indicator -->
                                            <div class="row mt-2">
                                                <div class="col-12">
                                                    <div class="password-strength mt-2">
                                                        <div class="progress" style="height: 5px;">
                                                            <div class="progress-bar" id="password-strength-bar" 
                                                                 role="progressbar" style="width: 0%"></div>
                                                        </div>
                                                        <small class="text-muted" id="password-strength-text">
                                                            Password strength: Very Weak
                                                        </small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Profile Image Section -->
                                        <div class="form-section">
                                            <h5 class="section-title">
                                                <i class="fas fa-camera me-2 text-primary"></i>
                                                Profile Image
                                            </h5>
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Profile Photo</label>
                                                    <div class="file-upload-area">
                                                        <div class="input-group">
                                                            <span class="input-group-text bg-light">
                                                                <i class="fas fa-image text-primary"></i>
                                                            </span>
                                                            <input type="file" class="form-control" name="profile_image"
                                                                accept="image/*" id="profile_image">
                                                        </div>
                                                        <div class="form-text">
                                                            Recommended: Square image, max 2MB, JPG/PNG format
                                                        </div>
                                                        @error('profile_image') 
                                                            <div class="text-danger small mt-1">
                                                                <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                                            </div>
                                                        @enderror
                                                        
                                                        <!-- Image Preview -->
                                                        <div class="image-preview mt-3 text-center" id="image-preview" 
                                                             style="display: none;">
                                                            <img id="preview" class="img-thumbnail" 
                                                                 style="max-width: 200px; max-height: 200px;">
                                                            <div class="mt-2">
                                                                <button type="button" class="btn btn-sm btn-outline-danger" 
                                                                        id="remove-image">
                                                                    <i class="fas fa-times me-1"></i>Remove Image
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Action Buttons -->
                                        <div class="row mt-4">
                                            <div class="col-12">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <a href="{{ route('leader.index') }}" class="btn btn-outline-secondary">
                                                        <i class="fas fa-arrow-left me-1"></i> Back to Leaders
                                                    </a>
                                                    <div class="d-flex gap-2">
                                                        <button type="reset" class="btn btn-outline-warning">
                                                            <i class="fas fa-undo me-1"></i> Reset Form
                                                        </button>
                                                        <button type="submit" class="btn btn-primary">
                                                            <i class="fas fa-user-plus me-1"></i> Create Leader
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>
@endsection

@section('styles')
    <style>
        :root {
            --primary: #7367f0;
            --primary-dark: #5e50ee;
            --success: #28c76f;
            --danger: #ea5455;
            --warning: #ff9f43;
            --info: #00cfe8;
            --dark: #1e1e2d;
            --light: #f8f8f8;
            --gray: #6e6b7b;
            --border: #d8d6de;
        }
        
        .card {
            border: none;
            border-radius: 0.5rem;
            box-shadow: 0 4px 24px 0 rgba(34, 41, 47, 0.1);
            transition: all 0.3s ease;
        }
        
        .card:hover {
            box-shadow: 0 4px 25px 0 rgba(34, 41, 47, 0.15);
        }
        
        .card-header {
            background-color: white;
            border-bottom: 1px solid var(--border);
            padding: 1.5rem;
            border-radius: 0.5rem 0.5rem 0 0 !important;
        }
        
        .card-title {
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 0;
            font-size: 1.25rem;
        }
        
        .form-label {
            font-weight: 500;
            color: var(--dark);
            margin-bottom: 0.5rem;
        }
        
        .form-control, .form-select {
            border: 1px solid var(--border);
            border-radius: 0.357rem;
            padding: 0.75rem 1rem;
            transition: all 0.3s;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 3px 10px 0 rgba(34, 41, 47, 0.1);
        }
        
        .input-group-text {
            background-color: #f8f8f8;
            border: 1px solid var(--border);
            color: var(--gray);
        }
        
        .btn-primary {
            background-color: var(--primary);
            border-color: var(--primary);
            padding: 0.786rem 1.5rem;
            font-weight: 500;
            border-radius: 0.357rem;
            transition: all 0.3s;
        }
        
        .btn-primary:hover {
            background-color: var(--primary-dark);
            border-color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px 0 rgba(115, 103, 240, 0.4);
        }
        
        .text-danger {
            color: var(--danger) !important;
        }
        
        .form-section {
            margin-bottom: 1.5rem;
            padding: 1.5rem;
            background: white;
            border-radius: 0.5rem;
            box-shadow: 0 2px 8px 0 rgba(34, 41, 47, 0.05);
            border: 1px solid var(--border);
        }
        
        .section-title {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 1rem;
            padding-bottom: 0.75rem;
            border-bottom: 1px solid var(--border);
            color: var(--dark);
        }
        
        .info-box {
            background: #f0f2f5;
            border-radius: 0.5rem;
            padding: 1rem;
            margin-bottom: 1.5rem;
        }
        
        .info-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
            flex-shrink: 0;
        }
        
        .info-icon.primary {
            background-color: rgba(115, 103, 240, 0.12);
            color: var(--primary);
        }
        
        .info-icon.warning {
            background-color: rgba(255, 159, 67, 0.12);
            color: var(--warning);
        }
        
        .info-icon.success {
            background-color: rgba(40, 199, 111, 0.12);
            color: var(--success);
        }
        
        .info-content h6 {
            margin-bottom: 0.25rem;
            font-weight: 600;
        }
        
        .info-content p {
            margin-bottom: 0;
            color: var(--gray);
            font-size: 0.875rem;
        }
        
        .form-text {
            font-size: 0.75rem;
            color: var(--gray);
            margin-top: 0.25rem;
        }
        
        .password-strength .progress {
            background-color: #e9ecef;
        }
        
        .file-upload-area {
            position: relative;
        }
        
        .image-preview {
            border: 2px dashed var(--border);
            border-radius: 0.5rem;
            padding: 1rem;
            background-color: #f8f9fa;
        }
        
        .toggle-password {
            border-left: none;
        }
        
        @media (max-width: 768px) {
            .card-body {
                padding: 1rem;
            }
            
            .form-section {
                padding: 1rem;
            }
            
            .info-box {
                text-align: center;
            }
            
            .info-icon {
                margin: 0 auto 0.5rem;
            }
        }
    </style>
@endsection

@section('script')
    <script src="{{ asset('admin/app-assets/vendors/js/vendors.min.js')}}"></script>
    <script src="{{ asset('admin/app-assets/vendors/js/charts/apexcharts.min.js')}}"></script>
    <script src="{{ asset('admin/app-assets/vendors/js/extensions/toastr.min.js')}}"></script>
    <script src="{{ asset('admin/app-assets/js/core/app-menu.js')}}"></script>
    <script src="{{ asset('admin/app-assets/js/core/app.js')}}"></script>
    <script src="{{ asset('admin/app-assets/js/scripts/pages/dashboard-ecommerce.js')}}"></script>
    
    <!-- Font Awesome for icons -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
    
    <script>
        $(window).on('load', function () {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        });

        // Password visibility toggle
        document.querySelectorAll('.toggle-password').forEach(button => {
            button.addEventListener('click', function() {
                const target = this.getAttribute('data-target');
                const input = document.getElementById(target);
                const icon = this.querySelector('i');
                
                if (input.type === 'password') {
                    input.type = 'text';
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                } else {
                    input.type = 'password';
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                }
            });
        });

        // Password strength indicator
        document.getElementById('password').addEventListener('input', function() {
            const password = this.value;
            const strengthBar = document.getElementById('password-strength-bar');
            const strengthText = document.getElementById('password-strength-text');
            
            let strength = 0;
            let text = 'Very Weak';
            let color = '#ea5455';
            
            // Check password length
            if (password.length >= 8) strength += 25;
            
            // Check for lowercase letters
            if (/[a-z]/.test(password)) strength += 25;
            
            // Check for uppercase letters
            if (/[A-Z]/.test(password)) strength += 25;
            
            // Check for numbers
            if (/[0-9]/.test(password)) strength += 25;
            
            // Update strength indicator
            strengthBar.style.width = strength + '%';
            
            if (strength >= 75) {
                text = 'Strong';
                color = '#28c76f';
            } else if (strength >= 50) {
                text = 'Medium';
                color = '#ff9f43';
            } else if (strength >= 25) {
                text = 'Weak';
                color = '#ff9f43';
            } else {
                text = 'Very Weak';
                color = '#ea5455';
            }
            
            strengthBar.style.backgroundColor = color;
            strengthText.textContent = 'Password strength: ' + text;
            strengthText.style.color = color;
        });

        // Image preview functionality
        document.getElementById('profile_image').addEventListener('change', function(e) {
            const file = e.target.files[0];
            const preview = document.getElementById('preview');
            const imagePreview = document.getElementById('image-preview');
            
            if (file) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    imagePreview.style.display = 'block';
                }
                
                reader.readAsDataURL(file);
            }
        });

        // Remove image functionality
        document.getElementById('remove-image').addEventListener('click', function() {
            document.getElementById('profile_image').value = '';
            document.getElementById('image-preview').style.display = 'none';
        });

        // Form validation
        document.querySelector('form').addEventListener('submit', function(e) {
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('password_confirmation').value;
            
            if (password !== confirmPassword) {
                e.preventDefault();
                alert('Passwords do not match!');
                document.getElementById('password').focus();
            }
        });
    </script>
@endsection