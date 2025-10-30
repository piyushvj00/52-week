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
                $startDate = Carbon::parse($portal->start_date);
                $endDate = Carbon::parse($portal->end_date);
                $weekNumber = weekCount($startDate);                
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
                $totalWeeks = $startDate->diffInWeeks($endDate);
                $weeksCompleted = min($weekNumber, $totalWeeks);
                $progressPercentage = $totalWeeks > 0 ? ($weeksCompleted / $totalWeeks) * 100 : 0;
            @endphp
            <div class="progress-section">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h5 class="text-white mb-3">Portal Progress</h5>
                        <div class="d-flex align-items-center mb-2">
                            <span class="me-3">Week {{ $weekNumber }} of {{ $totalWeeks }}</span>
                            <span class="badge bg-light text-dark">{{ number_format($progressPercentage, 1) }}% Complete</span>
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
                                            <div class="stat-value">{{ $startDate->format('M j y') ?? 'N/A' }}</div>
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
                                            <div class="stat-value">{{ $endDate->format('M j y') ?? 'N/A' }}</div>
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
                <div class="row">
                    <!-- Contribution Trends -->
                    <div class="col-lg-8 mb-4">
                        <div class="card chart-card">
                            <div class="chart-card-header">
                                <h5 class="chart-card-title">Contribution Trends</h5>
                                <p class="chart-card-subtitle">Weekly contribution performance overview</p>
                            </div>
                            <div class="chart-container">
                                <canvas id="contributionTrendsChart" height="300"></canvas>
                            </div>
                        </div>
                    </div>

                    <!-- Group Distribution -->
                    <div class="col-lg-4 mb-4">
                        <div class="card chart-card">
                            <div class="chart-card-header">
                                <h5 class="chart-card-title">Payment Status</h5>
                                <p class="chart-card-subtitle">Your contribution distribution</p>
                            </div>
                            <div class="chart-container">
                                <canvas id="paymentStatusChart" height="300"></canvas>
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
                                        <div class="activity-description">A new member name {{  $groupMembers[0]->name}} joined the group</div>
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
                                        <div class="stat-value text-warning">${{ $portal->target_amount }}</div>
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

    fetch("{{ url('user/contribution-trends') }}")
        .then(response => response.json())
        .then(result => {
            const contributionCtx = document.getElementById('contributionTrendsChart').getContext('2d');
        });


    // Chart colors
    const colors = {
        primary: '#7367f0',
        success: '#28c76f',
        warning: '#ff9f43',
        danger: '#ea5455',
        info: '#00cfe8'
    };

    // Contribution Trends Chart
    // const contributionCtx = document.getElementById('contributionTrendsChart').getContext('2d');
    new Chart(contributionCtx, {
        type: 'line',
        data: {
            labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4', 'Week 5', 'Week 6', 'Week 7'],
            datasets: [{
                label: 'Your Contributions',
                data: [100, 150, 120, 200, 180, 220, 250],
                borderColor: colors.primary,
                backgroundColor: 'rgba(115, 103, 240, 0.1)',
                borderWidth: 3,
                fill: true,
                tension: 0.4
            }, {
                label: 'Group Average',
                data: [90, 130, 110, 180, 160, 200, 230],
                borderColor: colors.success,
                backgroundColor: 'rgba(40, 199, 111, 0.1)',
                borderWidth: 2,
                fill: true,
                tension: 0.4,
                borderDash: [5, 5]
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'top'
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        drawBorder: false
                    },
                    ticks: {
                        callback: function(value) {
                            return '$' + value;
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

    // Payment Status Chart
    const paymentCtx = document.getElementById('paymentStatusChart').getContext('2d');
    new Chart(paymentCtx, {
        type: 'doughnut',
        data: {
            labels: ['Paid', 'Pending', 'Upcoming'],
            datasets: [{
                data: [70, 20, 10],
                backgroundColor: [
                    colors.success,
                    colors.warning,
                    colors.info
                ],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '70%',
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });

    // Add animation to stat cards
    const statCards = document.querySelectorAll('.stat-card');
    statCards.forEach((card, index) => {
        card.style.animationDelay = `${index * 0.1}s`;
    });

    // Animate progress bar
    const progressFill = document.querySelector('.progress-fill');
    if (progressFill) {
        const width = progressFill.style.width;
        progressFill.style.width = '0%';
        setTimeout(() => {
            progressFill.style.width = width;
        }, 500);
    }
});
</script>

<script>
    $(window).on('load', function () {
        if (feather) {
            feather.replace({
                width: 14,
                height: 14
            });
        }
    })
</script>
@endsection