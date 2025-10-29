@extends('user.layouts.main')

@section('title', 'Group Details')

@section('content')
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row"></div>
        <div class="content-body">

            <!-- 🟢 Group & Portal Info -->
            <section class="mb-4">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h4 class="card-title mb-0">Your Group Details</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <!-- Portal Info -->
                            <div class="col-md-4 mb-3">
                                <div class="info-card">
                                    <div class="info-header">
                                        <i data-feather="globe" class="text-primary"></i>
                                        <h5 class="mb-1">Portal Information</h5>
                                    </div>
                                    <div class="info-content">
                                        <div class="info-item">
                                            <span class="info-label">Portal Name:</span>
                                            <span class="info-value">{{ $portal->name }}</span>
                                        </div>
                                        <div class="info-item">
                                            <span class="info-label">Start Date:</span>
                                            <span class="info-value">{{ \Carbon\Carbon::parse($portal->start_date)->format('d M Y') }}</span>
                                        </div>
                                        <div class="info-item">
                                            <span class="info-label">End Date:</span>
                                            <span class="info-value">{{ \Carbon\Carbon::parse($portal->end_date)->format('d M Y') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Group Info -->
                            <div class="col-md-4 mb-3">
                                <div class="info-card">
                                    <div class="info-header">
                                        <i data-feather="users" class="text-success"></i>
                                        <h5 class="mb-1">Group Information</h5>
                                    </div>
                                    <div class="info-content">
                                        <div class="info-item">
                                            <span class="info-label">Group Name:</span>
                                            <span class="info-value">{{ $group->name }}</span>
                                        </div>
                                        <div class="info-item">
                                            <span class="info-label">Group Number:</span>
                                            <span class="info-value">{{ $group->group_number }}</span>
                                        </div>
                                        <div class="info-item">
                                            <span class="info-label">Total Members:</span>
                                            <span class="info-value">{{ $groupMembers->count() ?? 0 }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Leader Info -->
                            <div class="col-md-4 mb-3">
                                <div class="info-card">
                                    <div class="info-header">
                                        <i data-feather="award" class="text-warning"></i>
                                        <h5 class="mb-1">Leader Information</h5>
                                    </div>
                                    <div class="info-content">
                                        <div class="info-item">
                                            <span class="info-label">Leader Name:</span>
                                            <span class="info-value">{{ $leader->name }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        <!-- 🟢 Current Week Payment -->
                        @php
                            use Carbon\Carbon;

                            $currentDate = Carbon::now(); // Current date
                            $startDate = Carbon::parse($portal->start_date);
                            $endDate   = Carbon::parse($portal->end_date);
                            $diffInDays = $startDate->diffInDays($endDate);
                            $diffInDays = $startDate->diffInDays($currentDate);
                            $numberOfWeeks = floor($diffInDays / 7);
                            $currentWeek = ceil(($diffInDays + 1) / 7);
                        @endphp

                        <div class="payment-card bg-light p-4 rounded">
                            <div class="row align-items-center">
                                <div class="col-md-3">
                                    <div class="payment-info">
                                        <h6 class="text-muted mb-1">Current Date</h6>
                                        <h4 class="text-primary">{{ \Carbon\Carbon::now()->format('d M Y') }}</h4>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="payment-info">
                                        <h6 class="text-muted mb-1">Week {{ $currentWeek }} Amount</h6>
                                        <h4 class="text-success">${{ number_format($weekAmount ?? 0, 2) }}</h4>
                                    </div>
                                </div>
                                <div class="col-md-6 text-md-end">
                                    <div class="payment-action">
                                        <form action="{{ route('user.my.contribution.pay')}}" method="POST" class="d-inline-block">
                                            @csrf
                                            <input type="hidden" name="group_id" value="{{$group->id}}">
                                            <input type="hidden" name="user_id" value="{{$user->id}}">
                                            <input type="hidden" name="amount" value="{{ $weeklyCommitment }}">
                                            <input type="hidden" name="transaction_id" value="1123456">
                                            <input type="hidden" name="week_number" value="{{ $currentWeek }}">
                                            <button type="submit" class="btn btn-primary btn-lg px-4">
                                                <i data-feather="credit-card" class="me-1"></i> Pay Week {{ $currentWeek }}
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- 🟢 Weekly Stats Cards -->
            <section class="row mb-4">
                <!-- Weekly Current Amount -->
                <div class="col-lg-3 col-sm-6 mb-3">
                    <div class="card stat-card h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h3 class="fw-bolder text-primary">${{ number_format($group->current_amount, 2) }}</h3>
                                    <span class="text-muted">Weekly Current Amount</span>
                                </div>
                                <div class="avatar bg-light-primary p-50">
                                    <i data-feather="target" class="font-medium-4 text-primary"></i>
                                </div>
                            </div>
                            <div class="progress mt-2" style="height: 6px;">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: {{ $group->target_amount > 0 ? ($group->current_amount / $group->target_amount) * 100 : 0 }}%" 
                                    aria-valuenow="{{ $group->target_amount > 0 ? ($group->current_amount / $group->target_amount) * 100 : 0 }}" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Weekly Target -->
                <div class="col-lg-3 col-sm-6 mb-3">
                    <div class="card stat-card h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h3 class="fw-bolder text-info">${{ number_format($group->target_amount, 2) }}</h3>
                                    <span class="text-muted">Weekly Target</span>
                                </div>
                                <div class="avatar bg-light-info p-50">
                                    <i data-feather="trending-up" class="font-medium-4 text-info"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Current Amount -->
                <div class="col-lg-3 col-sm-6 mb-3">
                    <div class="card stat-card h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h3 class="fw-bolder text-success">${{ number_format($group->current_amount, 2) }}</h3>
                                    <span class="text-muted">Total Current Amount</span>
                                </div>
                                <div class="avatar bg-light-success p-50">
                                    <i data-feather="dollar-sign" class="font-medium-4 text-success"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Target (All Weeks) -->
                <div class="col-lg-3 col-sm-6 mb-3">
                    <div class="card stat-card h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h3 class="fw-bolder text-warning">${{ number_format($group->target_amount * $numberOfWeeks, 2) }}</h3>
                                    <span class="text-muted">Total Target ({{ $numberOfWeeks }} Weeks)</span>
                                </div>
                                <div class="avatar bg-light-warning p-50">
                                    <i data-feather="calendar" class="font-medium-4 text-warning"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- 🟢 Contributions Table -->
            <section class="mb-4">
                <div class="card">
                    <div class="card-header bg-secondary text-white">
                        <h4 class="card-title mb-0">My Contribution History</h4>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th class="ps-4">Sr No.</th>
                                        <th>Week No.</th>
                                        <th>Amount</th>
                                        <th>Date</th>
                                        <th>Txn Id</th>
                                        <th class="pe-4">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i=1;
                                    @endphp
                                    @foreach ($contributions as $contribution)
                                        <tr>
                                            <td class="ps-4">{{ $i++ }}</td>
                                            <td>
                                                <span class="badge bg-light-primary">Week {{ $contribution->week_number }}</span>
                                            </td>
                                            <td class="fw-bold">${{ number_format($contribution->amount, 2) }}</td>
                                            <td>{{ \Carbon\Carbon::parse($contribution->contribution_date)->format('d M Y') }}</td>
                                            <td>
                                                <span class="font-small-2">{{ $contribution->transaction_id }}</span>
                                            </td>
                                            <td class="pe-4">
                                                <span class="badge bg-light-success">Paid</span>
                                            </td>
                                        </tr>
                                    @endforeach
                                    @if($contributions->count() == 0)
                                        <tr>
                                            <td colspan="6" class="text-center py-4">
                                                <div class="d-flex flex-column align-items-center">
                                                    <i data-feather="file-text" class="font-large-2 text-muted mb-2"></i>
                                                    <p class="text-muted mb-0">No contributions found</p>
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>

        </div>
    </div>
</div>

<div class="sidenav-overlay"></div>
<div class="drag-target"></div>

<style>
    .info-card {
        border-left: 4px solid #7367f0;
        padding-left: 1rem;
        height: 100%;
    }
    
    .info-header {
        display: flex;
        align-items: center;
        margin-bottom: 1rem;
    }
    
    .info-header i {
        margin-right: 0.5rem;
    }
    
    .info-header h5 {
        font-weight: 600;
        color: #5e5873;
    }
    
    .info-item {
        display: flex;
        justify-content: space-between;
        margin-bottom: 0.5rem;
        padding-bottom: 0.5rem;
        border-bottom: 1px solid #f0f0f0;
    }
    
    .info-item:last-child {
        border-bottom: none;
        margin-bottom: 0;
        padding-bottom: 0;
    }
    
    .info-label {
        font-weight: 500;
        color: #6e6b7b;
    }
    
    .info-value {
        font-weight: 600;
        color: #5e5873;
    }
    
    .payment-card {
        border: 1px solid #e0e0e0;
        background: linear-gradient(135deg, #f8f8f8 0%, #ffffff 100%);
    }
    
    .payment-info h6 {
        font-size: 0.875rem;
    }
    
    .payment-info h4 {
        font-weight: 700;
    }
    
    .stat-card {
        transition: transform 0.3s, box-shadow 0.3s;
        border: none;
        box-shadow: 0 2px 8px 0 rgba(0, 0, 0, 0.1);
    }
    
    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 15px 0 rgba(0, 0, 0, 0.15);
    }
    
    .table th {
        border-top: none;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.5px;
        color: #6e6b7b;
    }
    
    .table td {
        vertical-align: middle;
        padding: 1rem 0.75rem;
    }
    
    .badge {
        font-size: 0.7rem;
        padding: 0.35em 0.6em;
    }
    
    @media (max-width: 768px) {
        .info-card {
            border-left: none;
            border-top: 4px solid #7367f0;
            padding-left: 0;
            padding-top: 1rem;
            margin-bottom: 1.5rem;
        }
        
        .payment-action {
            margin-top: 1rem;
            text-align: center !important;
        }
    }
</style>
@endsection

@section('script')
<script src="{{ asset('admin/app-assets/vendors/js/vendors.min.js')}}"></script>
<script src="{{ asset('admin/app-assets/vendors/js/extensions/toastr.min.js')}}"></script>
<script src="{{ asset('admin/app-assets/js/core/app-menu.js')}}"></script>
<script src="{{ asset('admin/app-assets/js/core/app.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    if (feather) feather.replace({ width: 14, height: 14 });
});
</script>
@endsection