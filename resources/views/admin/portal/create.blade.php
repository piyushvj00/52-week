@extends('admin.layouts.main')

@section('title', 'Create Portal')

@section('content')
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0">Portal Management</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">Portal</a>
                                    </li>
                                    <li class="breadcrumb-item active">Create New Portal</li>
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
                <!-- Info Boxes -->
                <div class="row mb-4">
                    <div class="col-md-4">
                        <div class="info-box d-flex">
                            <div class="info-icon primary">
                                <i class="fas fa-info"></i>
                            </div>
                            <div class="info-content">
                                <h6>Portal Information</h6>
                                <p>Enter basic details about your portal</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="info-box d-flex">
                            <div class="info-icon warning">
                                <i class="fas fa-calendar-alt"></i>
                            </div>
                            <div class="info-content">
                                <h6>Date Range</h6>
                                <p>Set start and end dates for the portal</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="info-box d-flex">
                            <div class="info-icon primary">
                                <i class="fas fa-bullseye"></i>
                            </div>
                            <div class="info-content">
                                <h6>Target Settings</h6>
                                <p>Define your financial goals</p>
                            </div>
                        </div>
                    </div>
                </div>

                <section id="basic-horizontal-layouts">
                    <div class="row">
                        <div class="col-md-12 col-12">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h4 class="card-title">Create New Portal</h4>
                                    <span class="badge bg-primary">Step 1 of 1</span>
                                </div>
                                <div class="card-body">
                                    <form class="form form-horizontal" action="{{ route('portal.store') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        
                                        <!-- Basic Information Section -->
                                        <div class="form-section">
                                            <h5 class="section-title">
                                                <i class="fas fa-info-circle me-2 text-primary"></i>
                                                Basic Information
                                            </h5>
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Portal Name <span class="text-danger">*</span></label>
                                                    <div class="input-group">
                                                        <span class="input-group-text"><i class="fas fa-font"></i></span>
                                                        <input type="text" class="form-control" name="name" placeholder="Enter portal name" value="{{ old('name') }}">
                                                    </div>
                                                    <div class="form-text">Choose a descriptive name for your portal</div>
                                                    @error('name') 
                                                        <small class="text-danger">{{ $message }}</small> 
                                                    @enderror
                                                </div>
                                                
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Total Portals <span class="text-danger">*</span></label>
                                                    <div class="input-group">
                                                        <span class="input-group-text"><i class="fas fa-hashtag"></i></span>
                                                        <input type="number" class="form-control" name="total_portals" placeholder="Total portal" readonly value="52">
                                                    </div>
                                                    <div class="form-text">This value is automatically calculated</div>
                                                    @error('total_portals') 
                                                        <small class="text-danger">{{ $message }}</small> 
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- Financial Target Section -->
                                        <div class="form-section">
                                            <h5 class="section-title">
                                                <i class="fas fa-bullseye me-2 text-primary"></i>
                                                Financial Target
                                            </h5>
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Target Amount <span class="text-danger">*</span></label>
                                                    <div class="input-group">
                                                        <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                                        <input type="number" step="0.01" class="form-control" name="target_amount" placeholder="Enter target amount" value="{{ old('target_amount') }}">
                                                    </div>
                                                    <div class="form-text">Set your financial goal for this portal</div>
                                                    @error('target_amount') 
                                                        <small class="text-danger">{{ $message }}</small> 
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- Date Range Section -->
                                        <div class="form-section">
                                            <h5 class="section-title">
                                                <i class="fas fa-calendar me-2 text-primary"></i>
                                                Date Range
                                            </h5>
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Start Date <span class="text-danger">*</span></label>
                                                    <div class="input-group">
                                                        <span class="input-group-text"><i class="fas fa-calendar-plus"></i></span>
                                                        <input type="date" class="form-control" id="start_date" name="start_date" value="{{ old('start_date') }}">
                                                    </div>
                                                    @error('start_date')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                                
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">End Date <span class="text-danger">*</span></label>
                                                    <div class="input-group">
                                                        <span class="input-group-text"><i class="fas fa-calendar-minus"></i></span>
                                                        <input type="date" class="form-control" id="end_date" name="end_date" value="{{ old('end_date') }}">
                                                    </div>
                                                    @error('end_date')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="alert alert-info mt-2">
                                                <small>
                                                    <i class="fas fa-info-circle me-1"></i>
                                                    The end date will be automatically set to one year after the start date.
                                                </small>
                                            </div>
                                        </div>
                                        
                                        <!-- Submit Button -->
                                        <div class="row mt-4">
                                            <div class="col-12">
                                                <div class="d-flex justify-content-end gap-2">
                                                    <button type="reset" class="btn btn-outline-secondary">
                                                        <i class="fas fa-redo me-1"></i> Reset
                                                    </button>
                                                    <button type="submit" class="btn btn-primary">
                                                        <i class="fas fa-plus-circle me-1"></i> Create Portal
                                                    </button>
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
        
        .info-content h6 {
            margin-bottom: 0.25rem;
            font-weight: 600;
        }
        
        .info-content p {
            margin-bottom: 0;
            color: var(--gray);
            font-size: 0.875rem;
        }
        
        .form-control:read-only {
            background-color: #f8f8f8;
        }
        
        @media (max-width: 768px) {
            .card-body {
                padding: 1rem;
            }
            
            .form-section {
                padding: 1rem;
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

        // Auto-set end date when start date changes
        document.getElementById('start_date').addEventListener('change', function () {
            const startDate = new Date(this.value);

            if (isNaN(startDate)) return; // if invalid date

            // Add 1 year
            const endDate = new Date(startDate);
            endDate.setFullYear(endDate.getFullYear() + 1);

            // Format date to YYYY-MM-DD
            const formatted = endDate.toISOString().split('T')[0];

            document.getElementById('end_date').value = formatted;
        });

        // Add visual feedback for form interactions
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.form-control').forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.classList.add('focused');
                });
                
                input.addEventListener('blur', function() {
                    if (this.value === '') {
                        this.parentElement.classList.remove('focused');
                    }
                });
            });
        });
    </script>
@endsection