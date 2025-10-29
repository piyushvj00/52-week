@extends('admin.layouts.main')

@section('title', 'Edit Portal')

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
                                    <li class="breadcrumb-item"><a href="{{ route('portal.index') }}">Portals</a>
                                    </li>
                                    <li class="breadcrumb-item active">Edit Portal</li>
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
                <!-- Portal Status Summary -->
                <div class="row mb-4">
                    <div class="col-md-3">
                        <div class="card stats-card border-start-primary">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="avatar bg-light-primary p-2 me-2">
                                        <i class="fas fa-portal fa-2x text-primary"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h4 class="mb-0">{{ $portal->total_portals }}</h4>
                                        <small class="text-muted">Total Portals</small>
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
                                        <i class="fas fa-bullseye fa-2x text-warning"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h4 class="mb-0">${{ number_format($portal->target_amount, 2) }}</h4>
                                        <small class="text-muted">Target Amount</small>
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
                                        <i class="fas fa-calendar-day fa-2x text-info"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-0">{{ \Carbon\Carbon::parse($portal->start_date)->format('M d, Y') }}</h6>
                                        <small class="text-muted">Start Date</small>
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
                                        <i class="fas fa-calendar-check fa-2x text-success"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-0">{{ \Carbon\Carbon::parse($portal->end_date)->format('M d, Y') }}</h6>
                                        <small class="text-muted">End Date</small>
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
                                        Edit Portal: {{ $portal->name }}
                                    </h4>
                                    <div>
                                        <span class="badge bg-info">Editing Mode</span>
                                        <a href="{{ route('portal.index') }}" class="btn btn-outline-secondary btn-sm ms-2">
                                            <i class="fas fa-arrow-left me-1"></i> Back to List
                                        </a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <form class="form form-horizontal" action="{{ route('portal.update', $portal->id) }}"
                                        method="post" enctype="multipart/form-data">
                                        @csrf
                                        @method('put')
                                        
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
                                                        <span class="input-group-text bg-light">
                                                            <i class="fas fa-font text-primary"></i>
                                                        </span>
                                                        <input type="text" class="form-control" name="name" 
                                                               placeholder="Enter portal name" value="{{ old('name', $portal->name) }}"
                                                               required>
                                                    </div>
                                                    <div class="form-text">Enter a descriptive name for your portal</div>
                                                    @error('name') 
                                                        <div class="text-danger small mt-1">
                                                            <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Total Portals <span class="text-danger">*</span></label>
                                                    <div class="input-group">
                                                        <span class="input-group-text bg-light">
                                                            <i class="fas fa-hashtag text-primary"></i>
                                                        </span>
                                                        <input type="number" readonly class="form-control bg-light" 
                                                               name="total_portals" value="{{ old('total_portals', $portal->total_portals) }}">
                                                    </div>
                                                    <div class="form-text">This value is automatically calculated and cannot be modified</div>
                                                    @error('total_portals') 
                                                        <div class="text-danger small mt-1">
                                                            <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- Financial Information Section -->
                                        <div class="form-section">
                                            <h5 class="section-title">
                                                <i class="fas fa-chart-line me-2 text-primary"></i>
                                                Financial Information
                                            </h5>
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Target Amount <span class="text-danger">*</span></label>
                                                    <div class="input-group">
                                                        <span class="input-group-text bg-light">
                                                            <i class="fas fa-dollar-sign text-primary"></i>
                                                        </span>
                                                        <input type="number" readonly step="0.01" class="form-control bg-light"
                                                            name="target_amount" placeholder="Target amount"
                                                            value="{{ old('target_amount', $portal->target_amount) }}">
                                                    </div>
                                                    <div class="form-text">Target amount is set during creation and cannot be modified</div>
                                                    @error('target_amount') 
                                                        <div class="text-danger small mt-1">
                                                            <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- Date Information Section -->
                                        <div class="form-section">
                                            <h5 class="section-title">
                                                <i class="fas fa-calendar-alt me-2 text-primary"></i>
                                                Date Information
                                            </h5>
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Start Date <span class="text-danger">*</span></label>
                                                    <div class="input-group">
                                                        <span class="input-group-text bg-light">
                                                            <i class="fas fa-calendar-plus text-primary"></i>
                                                        </span>
                                                        <input readonly type="date" class="form-control bg-light" name="start_date"
                                                            value="{{ old('start_date', $portal->start_date) }}">
                                                    </div>
                                                    <div class="form-text">Start date cannot be modified after creation</div>
                                                    @error('start_date') 
                                                        <div class="text-danger small mt-1">
                                                            <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">End Date <span class="text-danger">*</span></label>
                                                    <div class="input-group">
                                                        <span class="input-group-text bg-light">
                                                            <i class="fas fa-calendar-minus text-primary"></i>
                                                        </span>
                                                        <input readonly type="date" class="form-control bg-light" name="end_date"
                                                            value="{{ old('end_date', $portal->end_date) }}">
                                                    </div>
                                                    <div class="form-text">End date is automatically calculated and cannot be modified</div>
                                                    @error('end_date') 
                                                        <div class="text-danger small mt-1">
                                                            <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="alert alert-info mt-3">
                                                <div class="d-flex align-items-center">
                                                    <i class="fas fa-info-circle me-2 fa-lg"></i>
                                                    <div>
                                                        <strong>Note:</strong> Some fields are read-only as they are set during portal creation 
                                                        and cannot be modified to maintain data integrity.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- Action Buttons -->
                                        <div class="row mt-4">
                                            <div class="col-12">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <a href="{{ route('portal.index') }}" class="btn btn-outline-secondary">
                                                        <i class="fas fa-arrow-left me-1"></i> Cancel
                                                    </a>
                                                    <div class="d-flex gap-2">
                                                        <button type="reset" class="btn btn-outline-warning">
                                                            <i class="fas fa-undo me-1"></i> Reset
                                                        </button>
                                                        <button type="submit" class="btn btn-primary">
                                                            <i class="fas fa-save me-1"></i> Update Portal
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
        
        .form-control:read-only, .form-control[readonly] {
            background-color: #f8f8f8;
            color: var(--gray);
        }
        
        .form-text {
            font-size: 0.75rem;
            color: var(--gray);
            margin-top: 0.25rem;
        }
        
        .alert-info {
            background-color: rgba(0, 207, 232, 0.1);
            border-color: rgba(0, 207, 232, 0.2);
            color: #055160;
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

        // Add visual feedback for form interactions
        document.addEventListener('DOMContentLoaded', function() {
            const editableInputs = document.querySelectorAll('input:not([readonly])');
            
            editableInputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.classList.add('focused');
                });
                
                input.addEventListener('blur', function() {
                    this.parentElement.classList.remove('focused');
                });
            });

            // Show confirmation before reset
            document.querySelector('button[type="reset"]').addEventListener('click', function(e) {
                if (!confirm('Are you sure you want to reset all changes?')) {
                    e.preventDefault();
                }
            });
        });
    </script>
@endsection