@extends('admin.layouts.main')

@section('title', 'Support Settings')
<style>
    .support-card {
        border-radius: 12px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        border: 1px solid #e0e0e0;
        overflow: hidden;
        transition: all 0.3s ease;
    }
    .support-card:hover {
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.08);
    }
    .support-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 1.5rem;
        border-radius: 12px 12px 0 0;
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
    .input-icon .form-control,
    .input-icon .form-select {
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
    .time-range-container {
        background: #f8f9fa;
        border-radius: 8px;
        padding: 1.5rem;
        margin-bottom: 1rem;
    }
    .time-input-group {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .time-separator {
        font-weight: bold;
        color: #6c757d;
    }
    .support-info-card {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        color: white;
        border-radius: 8px;
        padding: 1rem;
        margin-bottom: 1.5rem;
    }
    .form-control:focus,
    .form-select:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
    }
    .days-format-hint {
        background: #e7f1ff;
        border: 1px solid #b3d4fc;
        border-radius: 6px;
        padding: 0.75rem;
        margin-top: 0.5rem;
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
                            <h2 class="content-header-title float-start mb-0">Support Settings</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                                    <li class="breadcrumb-item"><a href="#">Settings</a></li>
                                    <li class="breadcrumb-item active">Support</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="content-body">
                <div class="row justify-content-center">
                    <div class="col-md-10">
                        <div class="card support-card">
                            <div class="support-header">
                                <h4 class="text-white mb-0">
                                    <i data-feather="lifebuoy" style="width: 24px; height: 24px;" class="me-2"></i>
                                    Support Availability Settings
                                </h4>
                                <p class="text-light mb-0 mt-1">Configure support contact details and availability hours</p>
                            </div>
                            <div class="card-body">
                                <!-- Support Information Card -->
                                <div class="support-info-card">
                                    <div class="d-flex align-items-center">
                                        <i data-feather="info" style="width: 20px; height: 20px;" class="me-2"></i>
                                        <div>
                                            <h6 class="mb-0">Support Configuration</h6>
                                            <small>Set up your support contact information and working hours for better customer service.</small>
                                        </div>
                                    </div>
                                </div>

                                <form class="form form-vertical" action="{{ route('admin.support.settings.update') }}" method="post">
                                    @csrf
                                    
                                    <div class="row">
                                        <!-- Support Email -->
                                        <div class="col-12 mb-4">
                                            <label class="form-label">Support Email Address <span class="text-danger">*</span></label>
                                            <div class="input-icon">
                                                <i data-feather="mail"></i>
                                                <input type="email" class="form-control" name="support_email" 
                                                       value="{{ $helpSupport->email  ?? '' }}" 
                                                       placeholder="Enter support email address" required>
                                            </div>
                                            @error('support_email') 
                                                <div class="text-danger small mt-1">
                                                    <i data-feather="alert-circle" style="width: 14px; height: 14px;"></i> {{ $message }}
                                                </div>
                                            @enderror
                                            <small class="text-muted">This email will be used for all support-related communications</small>
                                        </div>
                                        
                                        <!-- Support Phone -->
                                        <div class="col-12 mb-4">
                                            <label class="form-label">Support Phone Number <span class="text-danger">*</span></label>
                                            <div class="input-icon">
                                                <i data-feather="phone"></i>
                                                <input type="tel" class="form-control" name="support_phone" 
                                                       value="{{ $helpSupport->phone ?? '' }}" 
                                                       placeholder="Enter support phone number" required>
                                            </div>
                                            @error('support_phone') 
                                                <div class="text-danger small mt-1">
                                                    <i data-feather="alert-circle" style="width: 14px; height: 14px;"></i> {{ $message }}
                                                </div>
                                            @enderror
                                            <small class="text-muted">Include country code (e.g., +1 234 567 8900)</small>
                                        </div>

                                        <!-- Days Range as String Input -->
                                        <div class="col-12 mb-4">
                                            <label class="form-label">Support Available Days <span class="text-danger">*</span></label>
                                            <div class="input-icon">
                                                <i data-feather="calendar"></i>
                                                <input type="text" class="form-control" name="support_days" 
                                                       value="{{ $helpSupport->day ?? '' }}" 
                                                       placeholder="e.g., Mon - Fri, Monday to Friday, Weekdays" required>
                                            </div>
                                            @error('support_days') 
                                                <div class="text-danger small mt-1">
                                                    <i data-feather="alert-circle" style="width: 14px; height: 14px;"></i> {{ $message }}
                                                </div>
                                            @enderror
                                            <div class="days-format-hint">
                                                <small class="text-primary">
                                                    <i data-feather="help-circle" style="width: 14px; height: 14px;"></i>
                                                    <strong>Examples:</strong> "Mon - Fri", "Monday to Friday", "Weekdays", "Mon, Wed, Fri", "Everyday"
                                                </small>
                                            </div>
                                        </div>

                                        <!-- Time Range -->
                                        <div class="col-12 mb-4">
                                            <label class="form-label">Support Hours <span class="text-danger">*</span></label>
                                            <div class="time-range-container">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label class="form-label small">Start Time</label>
                                                        <div class="input-icon">
                                                            <i data-feather="clock"></i>
                                                            <input type="time" class="form-control" name="support_start_time" 
                                                                   value="{{ old('support_start_time', $settings->support_start_time ?? '09:00') }}" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label small">End Time</label>
                                                        <div class="input-icon">
                                                            <i data-feather="clock"></i>
                                                            <input type="time" class="form-control" name="support_end_time" 
                                                                   value="{{ old('support_end_time', $settings->support_end_time ?? '18:00') }}" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                @error('support_start_time') 
                                                    <div class="text-danger small mt-1">
                                                        <i data-feather="alert-circle" style="width: 14px; height: 14px;"></i> {{ $message }}
                                                    </div>
                                                @enderror
                                                @error('support_end_time') 
                                                    <div class="text-danger small mt-1">
                                                        <i data-feather="alert-circle" style="width: 14px; height: 14px;"></i> {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <small class="text-muted">Set the daily support availability time range</small>
                                        </div>

                                        <!-- Action Buttons -->
                                        <div class="col-12 mt-4 pt-3 border-top">
                                            <button type="submit" style=";color:white !important" class="btn btn-gradient">
                                                <i data-feather="save" style="width: 16px; height: 16px"></i> Save Support Settings
                                            </button>
                                            <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary ms-2">
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
    <script src="{{ asset('admin/app-assets/vendors/js/extensions/toastr.min.js')}}"></script>
    <script src="{{ asset('admin/app-assets/js/core/app-menu.js')}}"></script>
    <script src="{{ asset('admin/app-assets/js/core/app.js')}}"></script>
    <script>
        $(window).on('load', function () {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        });

        // Form validation for time range
        document.querySelector('form').addEventListener('submit', function(e) {
            const startTime = document.querySelector('input[name="support_start_time"]').value;
            const endTime = document.querySelector('input[name="support_end_time"]').value;
            
            if (startTime && endTime && startTime >= endTime) {
                e.preventDefault();
                toastr.error('End time must be after start time', 'Validation Error', {
                    closeButton: true,
                    progressBar: true,
                    positionClass: 'toast-top-right',
                    timeOut: 5000
                });
            }
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

        // Quick fill examples for days input
        document.addEventListener('DOMContentLoaded', function() {
            const daysInput = document.querySelector('input[name="support_days"]');
            const examples = ['Mon - Fri', 'Monday to Friday', 'Weekdays', 'Mon, Wed, Fri', 'Everyday'];
            let exampleIndex = 0;
            
            // Cycle through examples on placeholder (optional feature)
            setInterval(() => {
                daysInput.placeholder = `e.g., ${examples[exampleIndex]}`;
                exampleIndex = (exampleIndex + 1) % examples.length;
            }, 3000);
        });
    </script>
@endsection