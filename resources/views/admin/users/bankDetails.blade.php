@extends('admin.layouts.main')

@section('title', 'Bank Account Details - ' . ($bankAccount->leader->name ?? 'N/A'))
@section('content')
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0">Bank Account Details</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                                    <li class="breadcrumb-item"><a href="{{ route('leader.index') }}">Leaders</a></li>
                                    <li class="breadcrumb-item"><a href="#">Bank Accounts</a></li>
                                    <li class="breadcrumb-item active">Details</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-md-end col-md-6 col-12 d-md-block d-none">
                    <div class="mb-1 breadcrumb-right">
                        <a href="{{ route('admin.account.details') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left me-1"></i> Back to List
                        </a>
                    </div>
                </div>
            </div>

            <div class="content-body">
                <div class="row">
                    <!-- Leader Information -->
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
                                <h4 class="card-title mb-0"><i class="bi bi-person me-2"></i>Leader Information</h4>
                            </div>
                            <div class="card-body">
                                <div class="text-center mb-3">
                                    @if($bankAccount->leader->profile_image)
                                        <img src="{{ asset('storage/' . $bankAccount->leader->profile_image) }}" 
                                             class="rounded-circle mb-2" 
                                             width="80" 
                                             height="80" 
                                             alt="Profile">
                                    @else
                                        <div class="rounded-circle bg-light d-inline-flex align-items-center justify-content-center mb-2" 
                                             style="width: 80px; height: 80px;">
                                            <i class="bi bi-person" style="font-size: 2rem; color: #6c757d;"></i>
                                        </div>
                                    @endif
                                    <h5 class="mb-1">{{ $bankAccount->leader->name ?? 'N/A' }}</h5>
                                    <p class="text-muted mb-2">{{ $bankAccount->leader->email ?? 'N/A' }}</p>
                                    <span class="status-badge {{ $bankAccount->leader->status == 1 ? 'status-active' : 'status-inactive' }}">
                                        {{ $bankAccount->leader->status == 1 ? 'Active' : 'Inactive' }}
                                    </span>
                                </div>
                                <hr>
                                <div class="leader-info">
                                    <div class="d-flex justify-content-between py-2">
                                        <span class="text-muted">Phone:</span>
                                        <span class="fw-semibold">{{ $bankAccount->leader->phone ?? 'N/A' }}</span>
                                    </div>
                                    <div class="d-flex justify-content-between py-2">
                                        <span class="text-muted">Joined:</span>
                                        <span class="fw-semibold">{{ $bankAccount->leader->created_at ? $bankAccount->leader->created_at->format('M d, Y') : 'N/A' }}</span>
                                    </div>
                                    <div class="d-flex justify-content-between py-2">
                                        <span class="text-muted">Group:</span>
                                        <span class="fw-semibold">
                                            @if($bankAccount->group && $bankAccount->group->name)
                                                <span class="group-name">{{ $bankAccount->group->name }}</span>
                                            @else
                                                <span class="text-muted">No Group</span>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Bank Account Details -->
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
                                <h4 class="card-title mb-0"><i class="bi bi-bank me-2"></i>Bank Account Details</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label text-muted small">Bank Holder Name</label>
                                        <p class="fw-semibold mb-0">{{ $bankAccount->bank_holder_name ?? 'N/A' }}</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label text-muted small">Bank Name</label>
                                        <p class="fw-semibold mb-0">{{ $bankAccount->bank_name ?? 'N/A' }}</p>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label text-muted small">Bank Address</label>
                                        <p class="fw-semibold mb-0">{{ $bankAccount->bank_address ?? 'N/A' }}</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label text-muted small">Account Number</label>
                                        <p class="fw-semibold mb-0">
                                            <code style="font-size: 1.1rem;">{{ $bankAccount->account_number ?? 'N/A' }}</code>
                                        </p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label text-muted small">Routing Number</label>
                                        <p class="fw-semibold mb-0">{{ $bankAccount->routing_number ?? 'N/A' }}</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label text-muted small">SWIFT Code</label>
                                        <p class="fw-semibold mb-0">{{ $bankAccount->swift_code ?? 'N/A' }}</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label text-muted small">Account Type</label>
                                        <p class="fw-semibold mb-0">
                                            <span class="status-badge {{ $bankAccount->account_type == 'business' ? 'status-active' : 'status-inactive' }}">
                                                {{ ucfirst($bankAccount->account_type) }}
                                            </span>
                                        </p>
                                    </div>
                                    @if($bankAccount->payment_details)
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label text-muted small">Payment Details</label>
                                        <p class="fw-semibold mb-0">{{ $bankAccount->payment_details }}</p>
                                    </div>
                                    @endif
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label text-muted small">Portal Set ID</label>
                                        <p class="fw-semibold mb-0">{{ $bankAccount->portal_set_id ?? 'N/A' }}</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label text-muted small">Created On</label>
                                        <p class="fw-semibold mb-0">{{ $bankAccount->created_at ? $bankAccount->created_at->format('M d, Y') : 'N/A' }}</p>
                                    </div>
                                </div>
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
    <script src="{{ asset('admin/app-assets/js/core/app-menu.js')}}"></script>
    <script src="{{ asset('admin/app-assets/js/core/app.js')}}"></script>
@endsection