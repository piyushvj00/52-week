@extends('user.layouts.main')

@section('title', 'Dashboard')
<style>
    .dashboard-stats {
        margin-bottom: 30px;
    }
    .stat-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        border: none;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        height: 100%;
        overflow: hidden;
    }
    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    }
    .stat-card-primary {
        border-left: 4px solid #7367f0;
    }
    .stat-card-success {
        border-left: 4px solid #28c76f;
    }
    .stat-card-warning {
        border-left: 4px solid #ff9f43;
    }
    .stat-card-danger {
        border-left: 4px solid #ea5455;
    }
    .stat-icon {
        width: 60px;
        height: 60px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
    }
    .stat-icon-primary {
        background: linear-gradient(135deg, #7367f0, #9e95f5);
        color: white;
    }
    .stat-icon-success {
        background: linear-gradient(135deg, #28c76f, #48da89);
        color: white;
    }
    .stat-icon-warning {
        background: linear-gradient(135deg, #ff9f43, #ffb976);
        color: white;
    }
    .stat-icon-danger {
        background: linear-gradient(135deg, #ea5455, #ff6b6b);
        color: white;
    }
    .stat-value {
        font-size: 2rem;
        font-weight: 700;
        color: #2d3748;
        line-height: 1;
        margin-bottom: 5px;
    }
    .stat-label {
        font-size: 0.9rem;
        color: #718096;
        font-weight: 500;
    }
    .stat-trend {
        font-size: 0.75rem;
        font-weight: 600;
        padding: 2px 8px;
        border-radius: 12px;
        display: inline-flex;
        align-items: center;
        gap: 4px;
        margin-top: 5px;
    }
    .trend-up {
        background: rgba(40, 199, 111, 0.1);
        color: #28c76f;
    }
    .trend-down {
        background: rgba(234, 84, 85, 0.1);
        color: #ea5455;
    }
    .chart-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        border: none;
        margin-bottom: 30px;
        height: 100%;
    }
    .chart-card-header {
        padding: 20px 25px 0;
        border-bottom: none;
        background: transparent;
    }
    .chart-card-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: #2d3748;
        margin-bottom: 5px;
    }
    .chart-card-subtitle {
        font-size: 0.85rem;
        color: #718096;
    }
    .chart-container {
        position: relative;
        padding: 20px;
    }
    .welcome-banner {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-radius: 12px;
        padding: 25px;
        margin-bottom: 30px;
        position: relative;
        overflow: hidden;
    }
    .welcome-banner::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 100%;
        height: 200%;
        background: rgba(255, 255, 255, 0.1);
        transform: rotate(45deg);
    }
    .welcome-title {
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 8px;
    }
    .welcome-subtitle {
        font-size: 1rem;
        opacity: 0.9;
        margin-bottom: 0;
    }
    .group-header {
        background: white;
        border-radius: 12px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        padding: 20px;
        margin-bottom: 20px;
        border-left: 4px solid #667eea;
    }
    .group-name {
        font-size: 1.3rem;
        font-weight: 700;
        color: #2d3748;
        margin-bottom: 5px;
    }
    .group-date {
        font-size: 0.9rem;
        color: #718096;
    }
    .quick-actions {
        display: flex;
        gap: 12px;
        margin-top: 20px;
        flex-wrap: wrap;
    }
    .quick-action-btn {
        background: rgba(255, 255, 255, 0.2);
        border: 1px solid rgba(255, 255, 255, 0.3);
        color: white;
        padding: 8px 16px;
        border-radius: 8px;
        text-decoration: none;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 6px;
        font-weight: 500;
        font-size: 0.9rem;
    }
    .quick-action-btn:hover {
        background: rgba(255, 255, 255, 0.3);
        color: white;
        transform: translateY(-2px);
    }
    .progress-section {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 20px;
        border-radius: 12px;
        margin-bottom: 20px;
    }
    .progress-container {
        background: rgba(255, 255, 255, 0.2);
        border-radius: 10px;
        padding: 15px;
    }
    .progress-bar-custom {
        height: 10px;
        border-radius: 5px;
        background: rgba(255, 255, 255, 0.3);
        overflow: hidden;
    }
    .progress-fill {
        height: 100%;
        background: white;
        border-radius: 5px;
        transition: width 0.5s ease;
    }
    .recent-activity {
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        border: none;
        height: 100%;
    }
    .activity-item {
        display: flex;
        align-items: flex-start;
        gap: 15px;
        padding: 15px 0;
        border-bottom: 1px solid #f1f3f4;
    }
    .activity-item:last-child {
        border-bottom: none;
    }
    .activity-icon {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    .activity-content {
        flex: 1;
    }
    .activity-title {
        font-weight: 600;
        color: #2d3748;
        margin-bottom: 4px;
    }
    .activity-description {
        font-size: 0.85rem;
        color: #718096;
        margin-bottom: 4px;
    }
    .activity-time {
        font-size: 0.75rem;
        color: #a0aec0;
    }
    @media (max-width: 768px) {
        .welcome-title {
            font-size: 1.3rem;
        }
        .quick-actions {
            flex-direction: column;
        }
        .quick-action-btn {
            justify-content: center;
        }
    }
</style>
@section('content')
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row"></div>
        <div class="content-body">
            
                        @php
                    use Carbon\Carbon;

                    $startDate = $portal && $portal->start_date 
                        ? Carbon::parse($portal->start_date) 
                        : null;

                    $endDate = $portal && $portal->end_date 
                        ? Carbon::parse($portal->end_date) 
                        : null;

                    $weekNumber = $startDate ? weekCount($startDate) : '';
                @endphp


            <!-- Group Header -->
            <div class="group-header">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="group-name">{{ $group->name ?? 'Join a Group' }}</div>
                        <div class="group-date">Today: {{ now()->format('M j, Y') }}</div>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <div class="text-muted">
                            <small>Portal: {{ $portal->name ?? 'N/A' }}</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Progress Section -->
           @php
    // Defaults
                $totalWeeks = 0;
                $weeksCompleted = 0;
                $progressPercentage = 0;

                if ($startDate && $endDate) {
                    $totalWeeks = $startDate->diffInWeeks($endDate);

                    // Avoid week count 0 making division issues
                    $weekNumber = $weekNumber ?? 0;
                    $totalWeeks = max($totalWeeks, 1); 

                    $weeksCompleted = min($weekNumber, $totalWeeks);

                    $progressPercentage = ($weeksCompleted / $totalWeeks) * 100;
                }
            @endphp

            <div class="progress-section">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h5 class="text-white mb-3">Portal Progress</h5>
                        <div class="d-flex align-items-center mb-2">
                            <span class="me-3">Week {{ $weekNumber }} of {{ $totalWeeks }}</span>
                            <span class="badge bg-light text-dark">{{ number_format($progressPercentage) }}% Complete</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="progress-container">
                            <div class="progress-bar-custom">
                                <div class="progress-fill" style="width: {{ $progressPercentage }}%"></div>
                            </div>
                            <div class="text-white mt-2 text-center">
                                {{ $weeksCompleted }} / {{ $totalWeeks }} Weeks
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Statistics Cards -->
            <section id="dashboard-ecommerce">
                <div class="dashboard-stats">
                    <div class="row">
                        <!-- Total Members -->
                        <div class="col-lg-3 col-md-6 mb-4">
                            <div class="card stat-card stat-card-primary">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <div class="stat-value">{{ $groupMembers->count() ?? '0' }}</div>
                                            <div class="stat-label">Total Members</div>
                                            <div class="stat-trend trend-up">
                                                <i data-feather="users"></i> In Group
                                            </div>
                                        </div>
                                        <div class="stat-icon stat-icon-primary">
                                            <i data-feather="users"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Current Week -->
                        <div class="col-lg-3 col-md-6 mb-4">
                            <div class="card stat-card stat-card-success">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <div class="stat-value">{{ $weekNumber ?? '0' }}</div>
                                            <div class="stat-label">Current Week</div>
                                            <div class="stat-trend trend-up">
                                                <i data-feather="calendar"></i> Active
                                            </div>
                                        </div>
                                        <div class="stat-icon stat-icon-success">
                                            <i data-feather="calendar"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Start Date -->
                        <div class="col-lg-3 col-md-6 mb-4">
                            <div class="card stat-card stat-card-warning">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <div class="stat-value">{{ $startDate ? $startDate->format('M j y') : 'N/A' }}</div>
                                            <div class="stat-label">Start Date</div>
                                            <div class="stat-trend trend-up">
                                                <i data-feather="clock"></i> Portal Start
                                            </div>
                                        </div>
                                        <div class="stat-icon stat-icon-warning">
                                            <i data-feather="play-circle"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- End Date -->
                        <div class="col-lg-3 col-md-6 mb-4">
                            <div class="card stat-card stat-card-danger">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <div class="stat-value">{{ $endDate ? $endDate ->format('M j y') : 'N/A' }}</div>
                                            <div class="stat-label">End Date</div>
                                            <div class="stat-trend trend-down">
                                                <i data-feather="alert-circle"></i> Portal End
                                            </div>
                                        </div>
                                        <div class="stat-icon stat-icon-danger">
                                            <i data-feather="flag"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Charts and Analytics -->
              <!-- Charts and Analytics -->
<div class="row">
    <!-- Contribution Amount by Date (Bar Chart) -->
    <div class="col-lg-6 mb-4">
        <div class="card chart-card">
            <div class="chart-card-header">
                <h5 class="chart-card-title">Contribution Amount by Date</h5>
                <p class="chart-card-subtitle">Daily contribution amounts over time</p>
            </div>
            <div class="chart-container">
                <canvas id="contributionByDateChart" height="250"></canvas>
            </div>
        </div>
    </div>

    <!-- User vs Group Count (Pie Chart) -->
    <div class="col-lg-6 mb-4">
        <div class="card chart-card">
            <div class="chart-card-header">
                <h5 class="chart-card-title">Contributions & Members</h5>
                <p class="chart-card-subtitle">Your contributions vs group members</p>
            </div>
            <div class="chart-container">
                <canvas id="userVsGroupChart" height="250"></canvas>
            </div>
        </div>
    </div>
</div>
                <!-- Additional Content -->
                <div class="row">
                    <!-- Recent Activity -->
                    <div class="col-lg-6 mb-4">
                        <div class="card recent-activity">
                            <div class="chart-card-header">
                                <h5 class="chart-card-title">Recent Activity</h5>
                                <p class="chart-card-subtitle">Latest updates from your group</p>
                            </div>
                            <div class="card-body">
                                <div class="activity-item">
                                    <div class="activity-icon bg-light-primary">
                                        <i data-feather="dollar-sign" class="text-primary"></i>
                                    </div>
                                    <div class="activity-content">
                                        <div class="activity-title">Contribution Made</div>
                                        <div class="activity-description">Weekly payment submitted successfully</div>
                                        @if( count( $contributions)>0)
                                            <div class="activity-time">{{ \Carbon\Carbon::parse($contributions[0]->created_at)->diffForHumans()}}</div>
                                        @else
                                            <div class="activity-time">Not Contributed</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="activity-item">
                                    <div class="activity-icon bg-light-success">
                                        <i data-feather="user-check" class="text-success"></i>
                                    </div>
                                    <div class="activity-content">
                                        <div class="activity-title">New Member</div>
                                        <div class="activity-description">A new member name {{  $groupMembers[0]->name ?? ''}} joined the group</div>
                                        @if( count( $groupMembers)>0)
                                            <div class="activity-time">{{ \Carbon\Carbon::parse($groupMembers[0]->created_at)->diffForHumans()}}</div>
                                        @else
                                            <div class="activity-time text-danger">No Data Available</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="activity-item">
                                    <div class="activity-icon bg-light-warning">
                                        <i data-feather="target" class="text-warning"></i>
                                    </div>
                                    <div class="activity-content">
                                        <div class="activity-title">Target Update</div>
                                        <div class="activity-description">Group reached 75% of weekly target</div>
                                        <div class="activity-time">2 days ago</div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>

                    <!-- Quick Stats -->
                    <div class="col-lg-6 mb-4">
                        <div class="card chart-card">
                            <div class="chart-card-header">
                                <h5 class="chart-card-title">My Performance</h5>
                                <p class="chart-card-subtitle">Contribution metrics and achievements</p>
                            </div>
                            <div class="card-body">
                                <div class="row text-center">
                                    
                                        <div class="col-6 mb-4">
                                            <div class="stat-value text-success">{{ $weeklyCommitment }}</div>
                                            <div class="stat-label">Your Weekly Commitment</div>
                                        </div>
                                    
                                    <div class="col-6 mb-4">
                                        <div class="stat-value text-warning">${{ $userContribution??0.00 }}</div>
                                        <div class="stat-label">You Contributed</div>
                                    </div>
                                    <div class="col-6 mb-4">
                                        <div class="stat-value text-warning">${{ $portal->target_amount ?? '' }}</div>
                                        <div class="stat-label">Group's Week Target</div>
                                    </div>
                                    <div class="col-6 mb-4">
                                        <div class="stat-value text-warning">${{ $groupContribution??0.00 }}</div>
                                        <div class="stat-label">Group Contributed</div>
                                    </div>
                                    
                                </div>
                                <div class="mt-4">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <span class="text-muted">Weekly Commitment</span>
                                        <span class="fw-bold text-success">${{ number_format($userCommitment ?? 0, 2) }}</span>
                                    </div>
                                    <div class="progress" style="height: 8px;">
                                        <div class="progress-bar bg-success" style="width: 85%"></div>
                                    </div>
                                    <small class="text-muted mt-2 d-block">85% of your weekly target achieved</small>
                                </div>
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

@section('script')
<script src="{{ asset('admin/app-assets/vendors/js/vendors.min.js')}}"></script>
<script src="{{ asset('admin/app-assets/vendors/js/extensions/toastr.min.js')}}"></script>
<script src="{{ asset('admin/app-assets/js/core/app-menu.js')}}"></script>
<script src="{{ asset('admin/app-assets/js/core/app.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function() {
    if (feather) {
        feather.replace({
            width: 14,
            height: 14
        });
    }

    const colors = {
        primary: '#7367f0',
        success: '#28c76f',
        warning: '#ff9f43',
        danger: '#ea5455',
        info: '#00cfe8',
        light: '#e2e8f0'
    };

    // Contribution Amount by Date (Bar Chart)
    const contributionByDateCtx = document.getElementById('contributionByDateChart').getContext('2d');
    
    // Prepare data for bar chart
    const contributionDates = @json($contributionData->pluck('date'));
    const contributionAmounts = @json($contributionData->pluck('total_amount'));
    
    // Format dates for better display
    const formattedDates = contributionDates.map(date => {
        const d = new Date(date);
        return d.toLocaleDateString('en-US', { month: 'short', day: 'numeric' });
    });

    new Chart(contributionByDateCtx, {
        type: 'bar',
        data: {
            labels: formattedDates,
            datasets: [{
                label: 'Contribution Amount ($)',
                data: contributionAmounts,
                backgroundColor: colors.primary,
                borderRadius: 8,
                barPercentage: 0.7
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'top',
                    labels: {
                        usePointStyle: true,
                        padding: 15
                    }
                },
                tooltip: {
                    callbacks: {
                        label: function (context) {
                            let label = context.dataset.label || '';
                            if (label) {
                                label += ': ';
                            }
                            if (context.parsed.y !== null) {
                                label += new Intl.NumberFormat('en-US', {
                                    style: 'currency',
                                    currency: 'USD'
                                }).format(context.parsed.y);
                            }
                            return label;
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        drawBorder: false
                    },
                    ticks: {
                        callback: function (value) {
                            return '$' + value.toLocaleString();
                        }
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            }
        }
    });

    // User vs Group Count (Pie Chart)
    const userVsGroupCtx = document.getElementById('userVsGroupChart').getContext('2d');
    
    const userContributionsCount = {{ $userContributionsCount }};
    const groupMembersCount = {{ $groupMembersCount }};

    new Chart(userVsGroupCtx, {
        type: 'pie',
        data: {
            labels: ['Your Contributions', 'Group Members'],
            datasets: [{
                data: [userContributionsCount, groupMembersCount],
                backgroundColor: [
                    colors.success,
                    colors.primary
                ],
                borderWidth: 0,
                hoverOffset: 10
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        usePointStyle: true,
                        padding: 15
                    }
                },
                tooltip: {
                    callbacks: {
                        label: function (context) {
                            const label = context.label || '';
                            const value = context.parsed;
                            const total = context.dataset.data.reduce((a, b) => a + b, 0);
                            const percentage = total > 0 ? Math.round((value / total) * 100) : 0;
                            return `${label}: ${value} (${percentage}%)`;
                        }
                    }
                }
            }
        }
    });

    // Member Status Chart (Keep your existing doughnut chart)
    const memberCtx = document.getElementById('memberStatusChart');
    if (memberCtx) {
        new Chart(memberCtx.getContext('2d'), {
            type: 'doughnut',
            data: {
                labels: ['Active Members', 'Inactive Members', 'Pending Payout'],
                datasets: [{
                    data: [
                        {{ $activeMembers }},
                        {{ $inactiveMembers }},
                        {{ $pendingMembers }}
                    ],
                    backgroundColor: [
                        colors.success,
                        colors.danger,
                        colors.warning
                    ],
                    borderWidth: 0,
                    hoverOffset: 10
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '70%',
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            usePointStyle: true,
                            padding: 15
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function (context) {
                                const label = context.label || '';
                                const value = context.parsed;
                                const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                const percentage = total > 0 ? Math.round((value / total) * 100) : 0;
                                return `${label}: ${value} (${percentage}%)`;
                            }
                        }
                    }
                }
            }
        });
    }
});
</script>


@endsection