@extends('user.layouts.main')

@section('title', 'My Profile')
<style>
    .profile-card {
        border-radius: 12px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        border: 1px solid #e0e0e0;
        overflow: hidden;
        transition: all 0.3s ease;
    }
    .profile-card:hover {
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.08);
    }
    .profile-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 1.5rem;
        border-radius: 12px 12px 0 0;
    }
    .profile-avatar {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        border: 4px solid rgba(255, 255, 255, 0.3);
        object-fit: cover;
        margin: 0 auto 1rem;
        display: block;
        background-color: #f8f9fa;
    }
    .form-control:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
    }
    .section-title {
        position: relative;
        padding-bottom: 10px;
        margin-bottom: 20px;
        font-weight: 600;
    }
    .section-title:after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 50px;
        height: 3px;
        background: linear-gradient(to right, #667eea, #764ba2);
        border-radius: 3px;
    }
    .input-icon {
        position: relative;
    }
    .input-icon .form-control {
        padding-left: 40px;
    }
    .input-icon i {
        position: absolute;
        left: 15px;
        top: 12px;
        color: #6c757d;
        z-index: 10;
    }
    .btn-gradient {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        color: white;
        padding: 10px 25px;
        border-radius: 8px;
        font-weight: 500;
        transition: all 0.3s ease;
    }
    .btn-gradient:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        color: white;
    }
    .profile-image-container {
        position: relative;
        display: inline-block;
        margin-bottom: 1rem;
    }
    .profile-image-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s ease;
        cursor: pointer;
    }
    .profile-image-container:hover .profile-image-overlay {
        opacity: 1;
    }
    .breadcrumb-item a {
        color: #667eea;
        text-decoration: none;
    }
    .breadcrumb-item.active {
        color: #6c757d;
    }
    .info-card {
        background: #f8f9fa;
        border-radius: 8px;
        padding: 1rem;
        margin-bottom: 1rem;
    }
    .info-card i {
        color: #667eea;
    }
    .form-label {
        font-weight: 500;
        margin-bottom: 0.5rem;
        color: #495057;
    }
</style>
@section('content')
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0">My Profile</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}">Home</a></li>
                                    <li class="breadcrumb-item active">Profile</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="content-body">
                <div class="row">
                    <!-- Profile Summary Card -->
                    <div class="col-md-4 mb-4">
                        <div class="card profile-card h-100">
                            <div class="profile-header text-center">
                                <div class="profile-image-container mx-auto">
                                    @if($user->profile_image)
                                        <img src="{{ asset('storage/' . $user->profile_image) }}" class="profile-avatar" alt="Profile Image" id="profile-avatar">
                                    @else
                                        <div class="profile-avatar d-flex align-items-center justify-content-center bg-light" id="profile-avatar">
                                            <i data-feather="user" class="text-muted" style="width: 50px; height: 50px;"></i>
                                        </div>
                                    @endif
                                    <div class="profile-image-overlay" onclick="document.getElementById('profile-image-input').click()">
                                        <i data-feather="camera" class="text-white" style="width: 24px; height: 24px;"></i>
                                    </div>
                                </div>
                                <h4 class="mb-0">{{ $user->name }}</h4>
                                <p class="text-light mb-0">{{ $user->email }}</p>
                                <span class="badge bg-light mt-2 text-dark">User</span>
                            </div>
                            <div class="card-body">
                                <div class="d-grid">
                                    <button type="button" class="btn btn-outline-primary mb-3" onclick="document.getElementById('profile-image-input').click()">
                                        <i data-feather="upload" style="width: 16px; height: 16px;"></i> Change Photo
                                    </button>
                                </div>
                                
                                <div class="user-info">
                                    <div class="info-card">
                                        <div class="d-flex align-items-center">
                                            <i data-feather="mail" class="me-2" style="width: 16px; height: 16px;"></i>
                                            <div>
                                                <small class="text-muted">Email</small>
                                                <div class="fw-medium">{{ $user->email }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="info-card">
                                        <div class="d-flex align-items-center">
                                            <i data-feather="map-pin" class="me-2" style="width: 16px; height: 16px;"></i>
                                            <div>
                                                <small class="text-muted">Address</small>
                                                <div class="fw-medium">{{ $user->address ?? 'Not provided' }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="info-card">
                                        <div class="d-flex align-items-center">
                                            <i data-feather="calendar" class="me-2" style="width: 16px; height: 16px;"></i>
                                            <div>
                                                <small class="text-muted">Member Since</small>
                                                <div class="fw-medium">{{ $user->created_at->format('M d, Y') }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Edit Profile Form -->
                    <div class="col-md-8">
                        <div class="card profile-card">
                            <div class="card-header border-bottom">
                                <h4 class="card-title section-title">Edit Profile Information</h4>
                                <p class="mb-0 text-muted">Update your personal details and preferences</p>
                            </div>
                            <div class="card-body">
                                <form class="form form-vertical" action="{{ route('user.update.profile') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="file" id="profile-image-input" name="profile_image" class="d-none" accept="image/*">
                                    
                                    <div class="row">
                                        <!-- Name Field -->
                                        <div class="col-12 mb-3">
                                            <i data-feather="user"></i>
                                            <label class="form-label">Full Name <span class="text-danger">*</span></label>
                                            <div class="input-icon">
                                                
                                                <input type="text" class="form-control" name="name" value="{{ old('name', $user->name) }}" placeholder="Enter your full name">
                                            </div>
                                            @error('name') 
                                                <div class="text-danger small mt-1">
                                                    <i data-feather="alert-circle" style="width: 14px; height: 14px;"></i> {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        
                                        <!-- Email Field -->
                                        <div class="col-12 mb-3">
                                                <i data-feather="mail"></i>
                                            <label class="form-label">Email Address <span class="text-danger">*</span></label>
                                            <div class="input-icon">
                                                <input type="email" class="form-control bg-light" name="email" value="{{ $user->email }}" readonly>
                                            </div>
                                            <small class="text-muted">
                                                <i data-feather="info" style="width: 14px; height: 14px;"></i> Email address cannot be changed
                                            </small>
                                        </div>
                                        
                                        <!-- Profile Picture Field -->
                                        <div class="col-12 mb-3">
                                            <label class="form-label">Profile Picture</label>
                                            <div class="input-group">
                                                <input type="file" class="form-control" name="profile_image" id="profile-image-text" accept="image/*">
                                                <button class="btn btn-outline-secondary" type="button" onclick="document.getElementById('profile-image-input').click()">
                                                    <i data-feather="upload" style="width: 16px; height: 16px;"></i> Browse
                                                </button>
                                            </div>
                                            <small class="text-muted">Supported formats: JPG, PNG, GIF. Max size: 2MB</small>
                                            @error('profile_image') 
                                                <div class="text-danger small mt-1">
                                                    <i data-feather="alert-circle" style="width: 14px; height: 14px;"></i> {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        
                                        <!-- Address Field -->
                                        <div class="col-12 mb-4">
                                                <i data-feather="home"></i>
                                            <label class="form-label">Address <span class="text-danger">*</span></label>
                                            <div class="input-icon">
                                                <input type="text" class="form-control" name="address" value="{{ old('address', $user->address) }}" placeholder="Enter your complete address">
                                            </div>
                                            @error('address') 
                                                <div class="text-danger small mt-1">
                                                    <i data-feather="alert-circle" style="width: 14px; height: 14px;"></i> {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        
                                        <!-- Action Buttons -->
                                        <div class="col-12 mt-4 pt-3 border-top">
                                            <button type="submit" class="btn btn-gradient">
                                                <i data-feather="save" style="width: 16px; height: 16px;"></i> Save Changes
                                            </button>
                                            <a href="{{ route('user.dashboard') }}" class="btn btn-outline-secondary ms-2">
                                                <i data-feather="arrow-left" style="width: 16px; height: 16px;"></i> Back to Dashboard
                                            </a>
                                            <button type="reset" class="btn btn-outline-danger ms-2">
                                                <i data-feather="refresh-cw" style="width: 16px; height: 16px;"></i> Reset
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>
@endsection

@section('script')
    <script src="{{ asset('admin/app-assets/vendors/js/vendors.min.js')}}"></script>
    <script src="{{ asset('admin/app-assets/vendors/js/charts/apexcharts.min.js')}}"></script>
    <script src="{{ asset('admin/app-assets/vendors/js/extensions/toastr.min.js')}}"></script>
    <script src="{{ asset('admin/app-assets/js/core/app-menu.js')}}"></script>
    <script src="{{ asset('admin/app-assets/js/core/app.js')}}"></script>
    <script src="{{ asset('admin/app-assets/js/scripts/pages/dashboard-ecommerce.js')}}"></script>
    <script>
        $(window).on('load', function () {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        });

        // Profile image preview functionality
        document.getElementById('profile-image-input').addEventListener('change', function(e) {
            if (e.target.files && e.target.files[0]) {
                const file = e.target.files[0];
                const reader = new FileReader();
                
                // Update file input text
                document.getElementById('profile-image-text').value = file.name;
                
                // Preview image
                reader.onload = function(e) {
                    const profileAvatar = document.getElementById('profile-avatar');
                    if (profileAvatar.tagName === 'IMG') {
                        profileAvatar.src = e.target.result;
                    } else {
                        // Replace the placeholder with actual image
                        const newImg = document.createElement('img');
                        newImg.src = e.target.result;
                        newImg.className = 'profile-avatar';
                        newImg.id = 'profile-avatar';
                        newImg.alt = 'Profile Image';
                        profileAvatar.parentNode.replaceChild(newImg, profileAvatar);
                    }
                }
                reader.readAsDataURL(file);
            }
        });

        // Sync both file inputs
        document.getElementById('profile-image-input').addEventListener('change', function() {
            document.getElementById('profile-image-text').value = this.files[0]?.name || '';
        });

        document.getElementById('profile-image-text').addEventListener('click', function() {
            document.getElementById('profile-image-input').click();
        });

        // Show success/error messages
        @if(session('success'))
            toastr.success('{{ session('success') }}', 'Success', {
                closeButton: true,
                progressBar: true,
                positionClass: 'toast-top-right',
                timeOut: 5000
            });
        @endif

        @if(session('error'))
            toastr.error('{{ session('error') }}', 'Error', {
                closeButton: true,
                progressBar: true,
                positionClass: 'toast-top-right',
                timeOut: 5000
            });
        @endif

        // Form reset functionality
        document.querySelector('button[type="reset"]').addEventListener('click', function() {
            // Reset profile image preview to original
            const originalImage = "{{ $user->profile_image ? asset('storage/' . $user->profile_image) : '' }}";
            if (originalImage) {
                document.getElementById('profile-avatar').src = originalImage;
            }
            document.getElementById('profile-image-text').value = '';
        });
    </script>
@endsection


