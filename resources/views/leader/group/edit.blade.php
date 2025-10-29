@extends('leader.layouts.main')

@section('title', 'Edit Group')

@section('content')
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0">Group Management</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="">Groups</a>
                                    </li>
                                    <li class="breadcrumb-item active">Edit Group</li>
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
                <!-- Group Summary Cards -->
                <div class="row mb-4">
                    <div class="col-md-4">
                        <div class="card group-stats-card border-start-primary">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="avatar bg-light-primary p-2 me-2">
                                        <i class="fas fa-users fa-lg text-primary"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-0 text-truncate">{{ $groups->name }}</h6>
                                        <small class="text-muted">Group Name</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card group-stats-card border-start-info">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="avatar bg-light-info p-2 me-2">
                                        <i class="fas fa-project-diagram fa-lg text-info"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-0 text-truncate">{{ $groups->project_name }}</h6>
                                        <small class="text-muted">Project Name</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card group-stats-card border-start-success">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="avatar bg-light-success p-2 me-2">
                                        <i class="fas fa-calendar-alt fa-lg text-success"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-0">{{ $groups->created_at->format('M d, Y') }}</h6>
                                        <small class="text-muted">Created Date</small>
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
                                        <i class="fas fa-edit me-2 text-primary"></i>
                                        Edit Group: {{ $groups->name }}
                                    </h4>
                                    <div>
                                        <span class="badge bg-info">Editing Mode</span>
                                        
                                    </div>
                                </div>
                                <div class="card-body">
                                    <form class="form form-horizontal" action="{{ route('leader.groups.update', $groups->id) }}"
                                        method="post" enctype="multipart/form-data">
                                        @csrf
                                        @method('put')
                                        
                                        <!-- Project Information Section -->
                                        <div class="form-section">
                                            <h5 class="section-title">
                                                <i class="fas fa-info-circle me-2 text-primary"></i>
                                                Project Information
                                            </h5>
                                            <div class="row">
                                                <!-- Project Name -->
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Project Name <span class="text-danger">*</span></label>
                                                    <div class="input-group">
                                                        <span class="input-group-text bg-light">
                                                            <i class="fas fa-tag text-primary"></i>
                                                        </span>
                                                        <input type="text" class="form-control" name="project_name" 
                                                               placeholder="Enter project name" 
                                                               value="{{ old('project_name', $groups->project_name) }}"
                                                               required>
                                                    </div>
                                                    <div class="form-text">Enter a descriptive name for your project</div>
                                                    @error('project_name') 
                                                        <div class="text-danger small mt-1">
                                                            <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                
                                                <!-- Project Description -->
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Project Description <span class="text-danger">*</span></label>
                                                    <div class="input-group">
                                                        <span class="input-group-text bg-light">
                                                            <i class="fas fa-align-left text-primary"></i>
                                                        </span>
                                                        <input type="text" class="form-control" name="project_description" 
                                                               placeholder="Enter project description" 
                                                               value="{{ old('project_description', $groups->project_description) }}"
                                                               required>
                                                    </div>
                                                    <div class="form-text">Brief description of your project goals</div>
                                                    @error('project_description') 
                                                        <div class="text-danger small mt-1">
                                                            <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-section">
                                            <h5 class="section-title">
                                                <i class="fas fa-images me-2 text-primary"></i>
                                                Media Assets
                                            </h5>
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Business Logo</label>
                                                    
                                                    @if($groups->logo_path)
                                                        <div class="current-media mb-3">
                                                            <label class="form-label d-block">Current Logo</label>
                                                            <div class="media-container position-relative d-inline-block">
                                                                <img src="{{ asset('uploads/'.$groups->logo_path) }}" 
                                                                     class="img-thumbnail current-logo" 
                                                                     style="width: 120px; height: 120px; object-fit: contain; background: #f8f9fa;"
                                                                     alt="Current Business Logo">
                                                                <div class="media-overlay position-absolute top-0 start-0 w-100 h-100 bg-dark bg-opacity-50 d-flex align-items-center justify-content-center rounded" 
                                                                     style="opacity: 0; transition: opacity 0.3s;">
                                                                    <span class="text-white small">Current Logo</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <div class="current-media mb-3">
                                                            <label class="form-label d-block">Current Logo</label>
                                                            <div class="media-container position-relative d-inline-block">
                                                                <div class="img-thumbnail d-flex align-items-center justify-content-center bg-light" 
                                                                     style="width: 120px; height: 120px;">
                                                                    <i class="fas fa-image fa-2x text-muted"></i>
                                                                </div>
                                                            </div>
                                                            <small class="text-muted mt-1 d-block">No logo uploaded</small>
                                                        </div>
                                                    @endif

                                                    <div class="file-upload-area">
                                                        <div class="input-group">
                                                            <span class="input-group-text bg-light">
                                                                <i class="fas fa-image text-primary"></i>
                                                            </span>
                                                            <input type="file" class="form-control" name="logo"
                                                                accept="image/*" id="logo">
                                                        </div>
                                                        <div class="form-text">
                                                            Recommended: Square logo, max 2MB, PNG format with transparent background
                                                        </div>
                                                        @error('logo')
                                                            <div class="text-danger small mt-1">
                                                                <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                                            </div>
                                                        @enderror
                                                        
                                                        <div class="media-preview mt-3 text-center" id="logo-preview" 
                                                             style="display: none;">
                                                            <label class="form-label d-block">New Logo Preview</label>
                                                            <img id="logo-preview-img" class="img-thumbnail" 
                                                                 style="width: 120px; height: 120px; object-fit: contain; background: #f8f9fa;">
                                                            <div class="mt-2">
                                                                <button type="button" class="btn btn-sm btn-outline-danger" 
                                                                        id="remove-logo">
                                                                    <i class="fas fa-times me-1"></i>Remove New Logo
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                

                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Business Video</label>
                                                    @if($groups->video_path)
                                                        <div class="current-media mb-3">
                                                            <label class="form-label d-block">Current Video</label>
                                                            <div class="media-container position-relative d-inline-block">
                                                                <div class="img-thumbnail d-flex align-items-center justify-content-center bg-light" 
                                                                     style="width: 120px; height: 120px;">
                                                                    <i class="fas fa-play-circle fa-2x text-primary"></i>
                                                                </div>
                                                                <div class="media-overlay position-absolute top-0 start-0 w-100 h-100 bg-dark bg-opacity-50 d-flex align-items-center justify-content-center rounded" 
                                                                     style="opacity: 0; transition: opacity 0.3s;">
                                                                    <span class="text-white small">Video Uploaded</span>
                                                                </div>
                                                            </div>
                                                            <small class="text-muted mt-1 d-block">Video file is uploaded</small>
                                                        </div>
                                                    @else
                                                        <div class="current-media mb-3">
                                                            <label class="form-label d-block">Current Video</label>
                                                            <div class="media-container position-relative d-inline-block">
                                                                <div class="img-thumbnail d-flex align-items-center justify-content-center bg-light" 
                                                                     style="width: 120px; height: 120px;">
                                                                    <i class="fas fa-video fa-2x text-muted"></i>
                                                                </div>
                                                            </div>
                                                            <small class="text-muted mt-1 d-block">No video uploaded</small>
                                                        </div>
                                                    @endif

                                                    <div class="file-upload-area">
                                                        <div class="input-group">
                                                            <span class="input-group-text bg-light">
                                                                <i class="fas fa-video text-primary"></i>
                                                            </span>
                                                            <input type="file" class="form-control" name="video"
                                                                accept="video/*" id="video">
                                                        </div>
                                                        <div class="form-text">
                                                            Recommended: MP4 format, max 50MB, short business presentation video
                                                        </div>
                                                        @error('video') 
                                                            <div class="text-danger small mt-1">
                                                                <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                                            </div>
                                                        @enderror
                                                        
                                                        <div class="video-info mt-3" id="video-info" style="display: none;">
                                                            <label class="form-label d-block">Selected Video</label>
                                                            <div class="d-flex align-items-center bg-light p-2 rounded">
                                                                <i class="fas fa-file-video text-primary me-2"></i>
                                                                <div class="flex-grow-1">
                                                                    <small class="d-block" id="video-name"></small>
                                                                    <small class="text-muted" id="video-size"></small>
                                                                </div>
                                                                <button type="button" class="btn btn-sm btn-outline-danger" 
                                                                        id="remove-video">
                                                                    <i class="fas fa-times"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mt-4">
                                            <div class="col-12">
                                                <div class="d-flex justify-content-between align-items-center">
                                                   
                                                    <div class="d-flex gap-2">
                                                        <button type="reset" class="btn btn-outline-warning">
                                                            <i class="fas fa-undo me-1"></i> Reset Changes
                                                        </button>
                                                        <button type="submit" class="btn btn-primary">
                                                            <i class="fas fa-save me-1"></i> Update Group
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
        
        .group-stats-card {
            border-left: 4px solid;
            transition: transform 0.3s ease;
            height: 100%;
        }
        
        .group-stats-card:hover {
            transform: translateY(-3px);
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
        
        .current-media, .media-preview {
            border-radius: 0.5rem;
            padding: 1rem 0;
        }
        
        .current-logo {
            transition: transform 0.3s ease;
        }
        
        .media-container:hover .current-logo {
            transform: scale(1.05);
        }
        
        .media-container:hover .media-overlay {
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
            
            .group-stats-card .avatar {
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

        document.getElementById('logo').addEventListener('change', function(e) {
            const file = e.target.files[0];
            const preview = document.getElementById('logo-preview-img');
            const logoPreview = document.getElementById('logo-preview');
            
            if (file) {
                if (file.size > 2 * 1024 * 1024) {
                    alert('Logo file size must be less than 2MB');
                    this.value = '';
                    return;
                }
                
                const validTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
                if (!validTypes.includes(file.type)) {
                    alert('Please select a valid image file (JPEG, PNG, GIF)');
                    this.value = '';
                    return;
                }
                
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    logoPreview.style.display = 'block';
                }
                
                reader.readAsDataURL(file);
            }
        });

        document.getElementById('remove-logo').addEventListener('click', function() {
            document.getElementById('logo').value = '';
            document.getElementById('logo-preview').style.display = 'none';
        });

        document.getElementById('video').addEventListener('change', function(e) {
            const file = e.target.files[0];
            const videoInfo = document.getElementById('video-info');
            const videoName = document.getElementById('video-name');
            const videoSize = document.getElementById('video-size');
            
            if (file) {
                if (file.size > 50 * 1024 * 1024) {
                    alert('Video file size must be less than 50MB');
                    this.value = '';
                    return;
                }
                
                const validTypes = ['video/mp4', 'video/avi', 'video/mov', 'video/wmv'];
                if (!validTypes.includes(file.type)) {
                    alert('Please select a valid video file (MP4, AVI, MOV, WMV)');
                    this.value = '';
                    return;
                }
                
                videoName.textContent = file.name;
                videoSize.textContent = formatFileSize(file.size);
                videoInfo.style.display = 'block';
            }
        });

        document.getElementById('remove-video').addEventListener('click', function() {
            document.getElementById('video').value = '';
            document.getElementById('video-info').style.display = 'none';
        });

        function formatFileSize(bytes) {
            if (bytes === 0) return '0 Bytes';
            const k = 1024;
            const sizes = ['Bytes', 'KB', 'MB', 'GB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
        }

        document.querySelector('button[type="reset"]').addEventListener('click', function(e) {
            if (!confirm('Are you sure you want to reset all changes? This will revert all fields to their current values.')) {
                e.preventDefault();
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            const inputs = document.querySelectorAll('input:not([type="file"])');
            
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.parentElement.classList.add('focused');
                });
                
                input.addEventListener('blur', function() {
                    this.parentElement.parentElement.classList.remove('focused');
                });
            });

            const currentLogo = document.querySelector('.current-logo');
            if (currentLogo) {
                const logoContainer = currentLogo.closest('.media-container');
                logoContainer.addEventListener('mouseenter', function() {
                    currentLogo.style.transform = 'scale(1.05)';
                });
                
                logoContainer.addEventListener('mouseleave', function() {
                    currentLogo.style.transform = 'scale(1)';
                });
            }
        });
    </script>
@endsection