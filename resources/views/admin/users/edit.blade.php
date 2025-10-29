@extends('admin.layouts.main')

@section('title', 'Edit User')

@section('content')
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0">User Management</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="{{ route('leader.index') }}">Users</a>
                                    </li>
                                    <li class="breadcrumb-item active">Edit User</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
                    <div class="mb-1 breadcrumb-right">
                        <div class="dropdown">
                            <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
                <!-- User Summary Cards -->
                <div class="row mb-4">
                    <div class="col-md-3">
                        <div class="card stats-card border-start-primary">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="avatar bg-light-primary p-2 me-2">
                                        <i class="fas fa-user fa-2x text-primary"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-0 text-truncate">{{ $user->name }}</h6>
                                        <small class="text-muted">User Name</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card stats-card border-start-info">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="avatar bg-light-info p-2 me-2">
                                        <i class="fas fa-envelope fa-2x text-info"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-0 text-truncate">{{ $user->email }}</h6>
                                        <small class="text-muted">Email Address</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card stats-card border-start-warning">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="avatar bg-light-warning p-2 me-2">
                                        <i class="fas fa-phone fa-2x text-warning"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-0">{{ $user->phone }}</h6>
                                        <small class="text-muted">Phone Number</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card stats-card border-start-success">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="avatar bg-light-success p-2 me-2">
                                        <i class="fas fa-calendar-alt fa-2x text-success"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-0">{{ $user->created_at->format('M d, Y') }}</h6>
                                        <small class="text-muted">Member Since</small>
                                    </div>
                                </div>
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
                                        <i class="fas fa-user-edit me-2 text-primary"></i>
                                        Edit User: {{ $user->name }}
                                    </h4>
                                    <div>
                                        <span class="badge bg-info">Editing Mode</span>
                                        <a href="{{ route('leader.index') }}" class="btn btn-outline-secondary btn-sm ms-2">
                                            <i class="fas fa-arrow-left me-1"></i> Back to List
                                        </a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <form class="form form-horizontal" action="{{ route('leader.update', $user->id) }}" enctype="multipart/form-data" method="post">
                                        @csrf
                                        @method('put')
                                        
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
                                                            placeholder="Enter full name" value="{{ old('name', $user->name) }}"
                                                            required>
                                                    </div>
                                                    <div class="form-text">User's full legal name</div>
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
                                                            placeholder="john.doe@example.com" value="{{ old('email', $user->email) }}"
                                                            required>
                                                    </div>
                                                    <div class="form-text">Used for login and notifications</div>
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
                                                            placeholder="0909090909" value="{{ old('phone', $user->phone) }}"
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
                                                        <!-- Current Image Preview -->
                                                        @if($user->profile_image)
                                                            <div class="current-image mb-3">
                                                                <label class="form-label d-block">Current Profile Image</label>
                                                                <div class="image-container position-relative d-inline-block">
                                                                    <img src="{{ asset('uploads/'.$user->profile_image) }}" 
                                                                         class="img-thumbnail current-profile-image" 
                                                                         style="width: 150px; height: 150px; object-fit: cover;"
                                                                         alt="Current Profile Image">
                                                                    <div class="image-overlay position-absolute top-0 start-0 w-100 h-100 bg-dark bg-opacity-50 d-flex align-items-center justify-content-center rounded" style="opacity: 0; transition: opacity 0.3s;">
                                                                        <span class="text-white">Current Image</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif

                                                        <div class="input-group">
                                                            <span class="input-group-text bg-light">
                                                                <i class="fas fa-image text-primary"></i>
                                                            </span>
                                                            <input type="file" class="form-control" name="profile_image"
                                                                accept="image/*" id="profile_image">
                                                        </div>
                                                        <div class="form-text">
                                                            Recommended: Square image, max 2MB, JPG/PNG format. Leave empty to keep current image.
                                                        </div>
                                                        @error('profile_image') 
                                                            <div class="text-danger small mt-1">
                                                                <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                                            </div>
                                                        @enderror
                                                        
                                                        <!-- New Image Preview -->
                                                        <div class="image-preview mt-3 text-center" id="image-preview" 
                                                             style="display: none;">
                                                            <label class="form-label d-block">New Image Preview</label>
                                                            <img id="preview" class="img-thumbnail" 
                                                                 style="max-width: 150px; max-height: 150px; object-fit: cover;">
                                                            <div class="mt-2">
                                                                <button type="button" class="btn btn-sm btn-outline-danger" 
                                                                        id="remove-image">
                                                                    <i class="fas fa-times me-1"></i>Remove New Image
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
                                                        <i class="fas fa-arrow-left me-1"></i> Cancel
                                                    </a>
                                                    <div class="d-flex gap-2">
                                                        <button type="reset" class="btn btn-outline-warning">
                                                            <i class="fas fa-undo me-1"></i> Reset Changes
                                                        </button>
                                                        <button type="submit" class="btn btn-primary">
                                                            <i class="fas fa-save me-1"></i> Update User
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
        
        .stats-card {
            border-left: 4px solid;
            transition: transform 0.3s ease;
            height: 100%;
        }
        
        .stats-card:hover {
            transform: translateY(-5px);
        }
        
        .border-start-primary { border-left-color: var(--primary) !important; }
        .border-start-warning { border-left-color: var(--warning) !important; }
        .border-start-info { border-left-color: var(--info) !important; }
        .border-start-success { border-left-color: var(--success) !important; }
        
        .bg-light-primary { background-color: rgba(115, 103, 240, 0.12) !important; }
        .bg-light-warning { background-color: rgba(255, 159, 67, 0.12) !important; }
        .bg-light-info { background-color: rgba(0, 207, 232, 0.12) !important; }
        .bg-light-success { background-color: rgba(40, 199, 111, 0.12) !important; }
        
        .form-text {
            font-size: 0.75rem;
            color: var(--gray);
            margin-top: 0.25rem;
        }
        
        .file-upload-area {
            position: relative;
        }
        
        .image-preview, .current-image {
            border: 2px dashed var(--border);
            border-radius: 0.5rem;
            padding: 1rem;
            background-color: #f8f9fa;
        }
        
        .current-profile-image {
            transition: transform 0.3s ease;
        }
        
        .image-container:hover .current-profile-image {
            transform: scale(1.05);
        }
        
        .image-container:hover .image-overlay {
            opacity: 1 !important;
        }
        
        .img-thumbnail {
            border: 2px solid var(--border);
            border-radius: 0.5rem;
        }
        
        @media (max-width: 768px) {
            .card-body {
                padding: 1rem;
            }
            
            .form-section {
                padding: 1rem;
            }
            
            .stats-card .avatar {
                display: none;
            }
            
            .d-flex.justify-content-between {
                flex-direction: column;
                gap: 1rem;
            }
            
            .d-flex.gap-2 {
                justify-content: space-between;
                width: 100%;
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

        // Image preview functionality for new image
        document.getElementById('profile_image').addEventListener('change', function(e) {
            const file = e.target.files[0];
            const preview = document.getElementById('preview');
            const imagePreview = document.getElementById('image-preview');
            
            if (file) {
                // Validate file size (2MB)
                if (file.size > 2 * 1024 * 1024) {
                    alert('File size must be less than 2MB');
                    this.value = '';
                    return;
                }
                
                // Validate file type
                const validTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
                if (!validTypes.includes(file.type)) {
                    alert('Please select a valid image file (JPEG, PNG, GIF)');
                    this.value = '';
                    return;
                }
                
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    imagePreview.style.display = 'block';
                }
                
                reader.readAsDataURL(file);
            }
        });

        // Remove new image functionality
        document.getElementById('remove-image').addEventListener('click', function() {
            document.getElementById('profile_image').value = '';
            document.getElementById('image-preview').style.display = 'none';
        });

        // Form reset confirmation
        document.querySelector('button[type="reset"]').addEventListener('click', function(e) {
            if (!confirm('Are you sure you want to reset all changes? This will revert all fields to their current values.')) {
                e.preventDefault();
            }
        });

        // Add visual feedback for form interactions
        document.addEventListener('DOMContentLoaded', function() {
            const inputs = document.querySelectorAll('input:not([type="file"])');
            
            inputs.forEach(input => {
                // Add focus effect
                input.addEventListener('focus', function() {
                    this.parentElement.classList.add('focused');
                });
                
                input.addEventListener('blur', function() {
                    this.parentElement.classList.remove('focused');
                });
                
                // Show current value on focus for better UX
                input.addEventListener('focus', function() {
                    this.setAttribute('data-original-value', this.value);
                });
            });

            // Enhance current image hover effect
            const currentImage = document.querySelector('.current-profile-image');
            if (currentImage) {
                currentImage.addEventListener('mouseenter', function() {
                    this.style.transform = 'scale(1.05)';
                });
                
                currentImage.addEventListener('mouseleave', function() {
                    this.style.transform = 'scale(1)';
                });
            }
        });

        // Auto-format phone number (optional)
        document.querySelector('input[name="phone"]').addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length > 10) {
                value = value.substring(0, 10);
            }
            e.target.value = value;
        });
    </script>
@endsection