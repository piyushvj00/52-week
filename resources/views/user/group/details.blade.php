@extends('user.layouts.main')
 
@section('title', 'Group Details')
<style>
    .dashboard-card {
        border-radius: 12px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        border: none;
        margin-bottom: 20px;
    }
    .card-header-custom {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 20px;
        border-bottom: none;
        border-radius: 12px 12px 0 0 !important;
    }
    .stats-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        border: none;
        transition: transform 0.3s ease;
        height: 100%;
    }
    .stats-card:hover {
        transform: translateY(-5px);
    }
    .stats-icon {
        width: 60px;
        height: 60px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
    }
    .stats-value {
        font-size: 1.8rem;
        font-weight: 700;
        color: #2d3748;
        line-height: 1;
    }
    .stats-label {
        font-size: 0.9rem;
        color: #718096;
        margin-top: 8px;
    }
    .info-section {
        background: #f8f9fa;
        border-radius: 8px;
        padding: 20px;
        margin-bottom: 20px;
    }
    .info-item {
        margin-bottom: 15px;
        padding-bottom: 15px;
        border-bottom: 1px solid #e9ecef;
    }
    .info-item:last-child {
        margin-bottom: 0;
        padding-bottom: 0;
        border-bottom: none;
    }
    .info-label {
        font-weight: 600;
        color: #4a5568;
        margin-bottom: 5px;
    }
    .info-value {
        color: #2d3748;
        font-size: 1.1rem;
    }
    .pay-button {
        background: linear-gradient(135deg, #48bb78 0%, #38a169 100%);
        border: none;
        padding: 12px 30px;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    .pay-button:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(72, 187, 120, 0.3);
    }
    .table-custom {
        border-radius: 8px;
        overflow: hidden;
    }
    .table-custom thead {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }
    .table-custom thead th {
        border: none;
        padding: 15px 12px;
        font-weight: 600;
        font-size: 0.9rem;
    }
    .table-custom tbody tr {
        transition: background-color 0.3s ease;
    }
    .table-custom tbody tr:hover {
        background-color: #f8f9ff;
    }
    .table-custom tbody td {
        padding: 15px 12px;
        vertical-align: middle;
        border-color: #f1f3f4;
    }
    .week-badge {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
    }
    .amount-cell {
        font-weight: 700;
        color: #2d3748;
        font-size: 1rem;
    }
    .progress-section {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 25px;
        border-radius: 12px;
        margin-bottom: 20px;
    }
    .progress-container {
        background: rgba(255, 255, 255, 0.2);
        border-radius: 10px;
        padding: 20px;
    }
    .progress-bar-custom {
        height: 12px;
        border-radius: 6px;
        background: rgba(255, 255, 255, 0.3);
        overflow: hidden;
    }
    .progress-fill {
        height: 100%;
        background: white;
        border-radius: 6px;
        transition: width 0.5s ease;
    }
    .current-week {
        background: #ffd700;
        color: #2d3748;
        padding: 8px 16px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.9rem;
    }
    @media (max-width: 768px) {
        .stats-card {
            margin-bottom: 15px;
        }
        .info-section {
            padding: 15px;
        }
    }
</style>
@section('content')
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row"></div>
        <div class="content-body">
            @php
                $currentWeek  = WeekCount($portal->start_date);
            @endphp


            <!-- Progress Section -->
            <div class="progress-section">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h3 class="text-white mb-3">Group Progress</h3>
                        <div class="d-flex align-items-center mb-3">
                            <span class="current-week me-3">
                                <i class="bi bi-calendar-week me-1"></i>Week {{ $currentWeek }}
                            </span>
                            <span class="text-white-50">
                                {{ \Carbon\Carbon::now()->format('M d, Y') }}
                            </span>
                        </div>
                    </div>
                    <div class="col-md-4 text-end">
                        <div class="progress-container">
                            <div class="d-flex justify-content-between text-white mb-2">
                                <span>Progress</span>
                                <span>{{ $group->target_amount > 0 ? round(($group->current_amount / $group->target_amount) * 100, 1) : 0 }}%</span>
                            </div>
                            <div class="progress-bar-custom">
                                <div class="progress-fill" style="width: {{ $group->target_amount > 0 ? ($group->current_amount / $group->target_amount) * 100 : 0 }}%"></div>
                            </div>
                            <div class="text-white mt-2 text-center">
                                ${{ number_format($group->current_amount, 2) }} / ${{ number_format($group->target_amount, 2) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions & Payment Section -->
            <div class="row mb-4">
                <div class="col-md-8">
                    <div class="card dashboard-card">
                        <div class="card-header-custom">
                            <h4 class="card-title text-white mb-0">Quick Payment</h4>
                        </div>
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <div class="info-item">
                                        <div class="info-label">Weekly Commitment</div>
                                        <div class="info-value">${{ number_format($weeklyCommitment ?? 0, 2) }}</div>
                                    </div>
                                    <div class="info-item">
                                        <div class="info-label">Current Week</div>
                                        <div class="info-value">Week {{ $currentWeek }}</div>
                                    </div>
                                </div>
                                <div class="col-md-6 text-center">
                                    <form action="{{ route('user.my.contribution.pay')}}" method="POST">
                                        @csrf
                                        <input type="hidden" name="group_id" value="{{$group->id}}">
                                        <input type="hidden" name="user_id" value="{{$user->id}}">
                                        <input type="hidden" name="amount" value="123">
                                        <input type="hidden" name="transaction_id" value="1123456">
                                        <input type="hidden" name="week_number" value="{{ $currentWeek }}">
                                        <button type="submit" class="pay-button text-white">
                                            <i class="bi bi-credit-card me-2"></i>Pay Now
                                        </button>
                                    </form>
                                    <small class="text-muted mt-2 d-block">Make your weekly contribution</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @php
                use Carbon\Carbon;

// Example
$start = Carbon::parse($portal->start_date)->startOfDay();
$end   = Carbon::parse($portal->end_date)->startOfDay();

// Difference in days
$diffDays = $start->diffInDays($end);

// Total weeks (rounded up)
$totalWeeks = ceil(($diffDays + 1) / 7);


                @endphp
                <div class="col-md-4">
                    <div class="card dashboard-card">
                        <div class="card-header-custom">
                            <h4 class="card-title text-white mb-0">Portal Timeline</h4>
                        </div>
                        <div class="card-body">
                            <div class="info-item">
                                <div class="info-label">Start Date</div>
                                <div class="info-value">{{ \Carbon\Carbon::parse($portal->start_date)->format('d M Y') }}</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">End Date</div>
                                <div class="info-value">{{ \Carbon\Carbon::parse($portal->end_date)->format('d M Y') }}</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Total Weeks</div>
                                <div class="info-value">{{ $totalWeeks }} Weeks</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Statistics Cards -->
            <section class="row mb-4">
                <div class="col-lg-3 col-md-6">
                    <div class="card stats-card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="stats-value">${{ number_format($group->current_amount, 2) }}</div>
                                    <div class="stats-label">Weekly Current</div>
                                </div>
                                <div class="stats-icon bg-light-primary">
                                    <i class="bi bi-cash text-primary"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="card stats-card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="stats-value">${{ number_format($group->target_amount, 2) }}</div>
                                    <div class="stats-label">Weekly Target</div>
                                </div>
                                <div class="stats-icon bg-light-success">
                                    <i class="bi bi-target text-success"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="card stats-card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="stats-value">${{ number_format($group->current_amount, 2) }}</div>
                                    <div class="stats-label">Total Collected</div>
                                </div>
                                <div class="stats-icon bg-light-info">
                                    <i class="bi bi-wallet2 text-info"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="card stats-card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="stats-value">${{ number_format($group->target_amount * $totalWeeks, 2) }}</div>
                                    <div class="stats-label">Total Target</div>
                                </div>
                                <div class="stats-icon bg-light-warning">
                                    <i class="bi bi-graph-up text-warning"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Group Information -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="card dashboard-card">
                        <div class="card-header-custom">
                            <h4 class="card-title text-white mb-0">Group Information</h4>
                        </div>
                        <div class="card-body">
                            <div class="info-item">
                                <div class="info-label">Group Name</div>
                                <div class="info-value">{{ $group->name }}</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Group Number</div>
                                <div class="info-value">{{ $group->group_number }}</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Total Members</div>
                                <div class="info-value">{{ $groupMembers->count() ?? 0 }} Members</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Project</div>
                                <div class="info-value">{{ $group->project_name }}</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card dashboard-card">
                        <div class="card-header-custom">
                            <h4 class="card-title text-white mb-0">Leadership & Portal</h4>
                        </div>
                        <div class="card-body">
                            <div class="info-item">
                                <div class="info-label">Group Leader</div>
                                <div class="info-value">{{ $leader->name ?? 'Not Assigned' }}</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Portal Name</div>
                                <div class="info-value">{{ $portal->name }}</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Portal Status</div>
                                <div class="info-value">
                                    <span class="badge bg-success">Active</span>
                                </div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Weeks Remaining</div>
                                <div class="info-value">{{ $totalWeeks - $currentWeek }} Weeks</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contributions History -->
            <div class="card dashboard-card">
                <div class="card-header-custom">
                    <h4 class="card-title text-white mb-0">My Contribution History</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-custom">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Week</th>
                                    <th>Amount</th>
                                    <th>Payment Date</th>
                                    <th>Transaction ID</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreLSE ($contributions as $index => $contribution)
                                    <tr>
                                        <td class="fw-semibold">{{ $index + 1 }}</td>
                                        <td>
                                            <span class="week-badge">
                                                Week {{ $contribution->week_number }}
                                            </span>
                                        </td>
                                        <td class="amount-cell">
                                            ${{ number_format($contribution->amount, 2) }}
                                        </td>
                                        <td>
                                            {{ \Carbon\Carbon::parse($contribution->contribution_date)->format('M d, Y') }}
                                        </td>
                                        <td>
                                            <code>{{ $contribution->transaction_id }}</code>
                                        </td>
                                        <td>
                                            @if($contribution->status == 'completed')
                                                <span class="badge bg-success">Completed</span>
                                            @elseif($contribution->status == 'pending')
                                                <span class="badge bg-warning">Pending</span>
                                            @else
                                                <span class="badge bg-danger">Failed</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-4">
                                            <div class="text-muted">
                                                <i class="bi bi-cash-coin display-4 d-block mb-3"></i>
                                                <h5>No Contributions Yet</h5>
                                                <p>Make your first contribution to get started</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
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
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    if (feather) feather.replace({ width: 14, height: 14 });
    
    // Add some interactive effects
    const statsCards = document.querySelectorAll('.stats-card');
    statsCards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-5px)';
        });
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });
});
</script>
@endsection