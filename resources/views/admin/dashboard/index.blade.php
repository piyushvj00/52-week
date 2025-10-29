@extends('admin.layouts.main')
 
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
    .stat-card-info {
        border-left: 4px solid #00cfe8;
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
    .progress-ring {
        position: relative;
        width: 80px;
        height: 80px;
    }
    .progress-ring-circle {
        transform: rotate(-90deg);
        transform-origin: 50% 50%;
    }
    .progress-ring-text {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
    }
    .progress-value {
        font-size: 1.2rem;
        font-weight: 700;
        color: #2d3748;
        display: block;
        line-height: 1;
    }
    .progress-label {
        font-size: 0.7rem;
        color: #718096;
        display: block;
    }
    .welcome-banner {
        background: linear-gradient(135deg, #7367f0 0%, #9e95f5 100%);
        color: white;
        border-radius: 12px;
        padding: 30px;
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
        font-size: 1.8rem;
        font-weight: 700;
        margin-bottom: 10px;
    }
    .welcome-subtitle {
        font-size: 1rem;
        opacity: 0.9;
        margin-bottom: 0;
    }
    .quick-actions {
        display: flex;
        gap: 15px;
        margin-top: 20px;
        flex-wrap: wrap;
    }
    .quick-action-btn {
        background: rgba(255, 255, 255, 0.2);
        border: 1px solid rgba(255, 255, 255, 0.3);
        color: white;
        padding: 10px 20px;
        border-radius: 8px;
        text-decoration: none;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 8px;
        font-weight: 500;
    }
    .quick-action-btn:hover {
        background: rgba(255, 255, 255, 0.3);
        color: white;
        transform: translateY(-2px);
    }
    @media (max-width: 768px) {
        .welcome-title {
            font-size: 1.4rem;
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
            <!-- Welcome Banner -->
            <div class="welcome-banner">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h1 class="welcome-title">Welcome back, Admin! 👋</h1>
                        <p class="welcome-subtitle">Here's what's happening with your groups and members today.</p>
                    </div>
                    <div class="col-md-4 text-md-end">
                        <div class="quick-actions">
                            <a href="{{ route('portal.index') }}" class="quick-action-btn">
                                <i data-feather="plus"></i> Add Portal
                            </a>
                            <a href="{{ route('leader.index') }}" class="quick-action-btn">
                                <i data-feather="user-plus"></i> Add Leader
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Statistics Cards -->
            <div class="dashboard-stats">
                <div class="row">
                    <!-- Total Groups -->
                    <div class="col-lg-3 col-md-6 mb-4">
                        <div class="card stat-card stat-card-primary">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <div class="stat-value">{{ $groupCount ?? '0' }}</div>
                                        <div class="stat-label">Total Groups</div>
                                        <div class="stat-trend trend-up">
                                            <i data-feather="trending-up"></i> 12% increase
                                        </div>
                                    </div>
                                    <div class="stat-icon stat-icon-primary">
                                        <i data-feather="users"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Total Members -->
                    <div class="col-lg-3 col-md-6 mb-4">
                        <div class="card stat-card stat-card-success">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <div class="stat-value">{{ $groupMember ?? '0' }}</div>
                                        <div class="stat-label">Total Members</div>
                                        <div class="stat-trend trend-up">
                                            <i data-feather="trending-up"></i> 8% increase
                                        </div>
                                    </div>
                                    <div class="stat-icon stat-icon-success">
                                        <i data-feather="user-check"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Total Contributions -->
                    <div class="col-lg-3 col-md-6 mb-4">
                        <div class="card stat-card stat-card-warning">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <div class="stat-value">{{ $contribution ?? '0' }}</div>
                                        <div class="stat-label">Contributions</div>
                                        <div class="stat-trend trend-up">
                                            <i data-feather="trending-up"></i> 15% increase
                                        </div>
                                    </div>
                                    <div class="stat-icon stat-icon-warning">
                                        <i data-feather="dollar-sign"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Portal End Date -->
                    <div class="col-lg-3 col-md-6 mb-4">
                        <div class="card stat-card stat-card-danger">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <div class="stat-value">
                                            {{ $portalSet && $portalSet->end_date ? \Carbon\Carbon::parse($portalSet->end_date)->format('M j') : 'N/A' }}
                                        </div>
                                        <div class="stat-label">Portal End Date</div>
                                        <div class="stat-trend trend-down">
                                            <i data-feather="clock"></i> Ending soon
                                        </div>
                                    </div>
                                    <div class="stat-icon stat-icon-danger">
                                        <i data-feather="calendar"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

          

            <!-- Additional Charts -->
            <div class="row">
                <!-- Monthly Performance -->
                <div class="col-lg-6 mb-4">
                    <div class="card chart-card">
                        <div class="chart-card-header">
                            <h5 class="chart-card-title">Monthly Performance</h5>
                            <p class="chart-card-subtitle">Revenue and contributions this month</p>
                        </div>
                        <div class="chart-container">
                            <canvas id="monthlyPerformanceChart" height="250"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Member Status -->
                <div class="col-lg-6 mb-4">
                    <div class="card chart-card">
                        <div class="chart-card-header">
                            <h5 class="chart-card-title">Member Status</h5>
                            <p class="chart-card-subtitle">Active vs inactive members overview</p>
                        </div>
                        <div class="chart-container">
                            <canvas id="memberStatusChart" height="250"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Activity & Quick Stats -->
            <div class="row">
                <!-- Recent Activity -->
                <div class="col-lg-8 mb-4">
                    <div class="card recent-activity">
                        <div class="chart-card-header">
                            <h5 class="chart-card-title">Recent Activity</h5>
                            <p class="chart-card-subtitle">Latest updates and actions</p>
                        </div>
                        <div class="card-body">
                            <div class="activity-item">
                                <div class="activity-icon bg-light-primary">
                                    <i data-feather="user-plus" class="text-primary"></i>
                                </div>
                                <div class="activity-content">
                                    <div class="activity-title">New Member Joined</div>
                                    <div class="activity-description">John Doe joined Group A</div>
                                    <div class="activity-time">2 hours ago</div>
                                </div>
                            </div>
                            <div class="activity-item">
                                <div class="activity-icon bg-light-success">
                                    <i data-feather="dollar-sign" class="text-success"></i>
                                </div>
                                <div class="activity-content">
                                    <div class="activity-title">Contribution Received</div>
                                    <div class="activity-description">$500 contribution from Jane Smith</div>
                                    <div class="activity-time">5 hours ago</div>
                                </div>
                            </div>
                            <div class="activity-item">
                                <div class="activity-icon bg-light-warning">
                                    <i data-feather="users" class="text-warning"></i>
                                </div>
                                <div class="activity-content">
                                    <div class="activity-title">New Group Created</div>
                                    <div class="activity-description">Investment Group #5 started</div>
                                    <div class="activity-time">1 day ago</div>
                                </div>
                            </div>
                            <div class="activity-item">
                                <div class="activity-icon bg-light-info">
                                    <i data-feather="target" class="text-info"></i>
                                </div>
                                <div class="activity-content">
                                    <div class="activity-title">Target Achieved</div>
                                    <div class="activity-description">Group B reached weekly target</div>
                                    <div class="activity-time">2 days ago</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Stats -->
                <div class="col-lg-4 mb-4">
                    <div class="card chart-card">
                        <div class="chart-card-header">
                            <h5 class="chart-card-title">Quick Stats</h5>
                            <p class="chart-card-subtitle">Performance metrics</p>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <div>
                                    <div class="stat-value">85%</div>
                                    <div class="stat-label">Collection Rate</div>
                                </div>
                                <div class="progress-ring">
                                    <svg width="80" height="80" viewBox="0 0 80 80">
                                        <circle cx="40" cy="40" r="35" stroke="#e2e8f0" stroke-width="8" fill="none"/>
                                        <circle class="progress-ring-circle" cx="40" cy="40" r="35" stroke="#28c76f" stroke-width="8" fill="none" stroke-dasharray="220" stroke-dashoffset="33"/>
                                    </svg>
                                    <div class="progress-ring-text">
                                        <span class="progress-value">85%</span>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <div>
                                    <div class="stat-value">92%</div>
                                    <div class="stat-label">Active Members</div>
                                </div>
                                <div class="progress-ring">
                                    <svg width="80" height="80" viewBox="0 0 80 80">
                                        <circle cx="40" cy="40" r="35" stroke="#e2e8f0" stroke-width="8" fill="none"/>
                                        <circle class="progress-ring-circle" cx="40" cy="40" r="35" stroke="#7367f0" stroke-width="8" fill="none" stroke-dasharray="220" stroke-dashoffset="17.6"/>
                                    </svg>
                                    <div class="progress-ring-text">
                                        <span class="progress-value">92%</span>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="stat-value">78%</div>
                                    <div class="stat-label">Target Completion</div>
                                </div>
                                <div class="progress-ring">
                                    <svg width="80" height="80" viewBox="0 0 80 80">
                                        <circle cx="40" cy="40" r="35" stroke="#e2e8f0" stroke-width="8" fill="none"/>
                                        <circle class="progress-ring-circle" cx="40" cy="40" r="35" stroke="#ff9f43" stroke-width="8" fill="none" stroke-dasharray="220" stroke-dashoffset="48.4"/>
                                    </svg>
                                    <div class="progress-ring-text">
                                        <span class="progress-value">78%</span>
                                    </div>
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
<script src="{{ asset('admin/app-assets/vendors/js/extensions/toastr.min.js')}}"></script>
<script src="{{ asset('admin/app-assets/js/core/app-menu.js')}}"></script>
<script src="{{ asset('admin/app-assets/js/core/app.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    
document.addEventListener('DOMContentLoaded', function() {
    if (feather) {
        feather.replace({ width: 14, height: 14 });
    }

    // Chart colors
    const colors = {
        primary: '#7367f0',
        success: '#28c76f',
        warning: '#ff9f43',
        danger: '#ea5455',
        info: '#00cfe8',
        light: '#e2e8f0'
    };

    // Contribution Trends Chart
    const contributionCtx = document.getElementById('contributionTrendsChart').getContext('2d');
    new Chart(contributionCtx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            datasets: [{
                label: 'Contributions',
                data: [12000, 19000, 15000, 25000, 22000, 30000, 28000, 35000, 32000, 40000, 38000, 45000],
                borderColor: colors.primary,
                backgroundColor: 'rgba(115, 103, 240, 0.1)',
                borderWidth: 3,
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
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

    // Group Distribution Chart
    const groupDistCtx = document.getElementById('groupDistributionChart').getContext('2d');
    new Chart(groupDistCtx, {
        type: 'doughnut',
        data: {
            labels: ['Group A', 'Group B', 'Group C', 'Group D', 'Others'],
            datasets: [{
                data: [30, 25, 20, 15, 10],
                backgroundColor: [
                    colors.primary,
                    colors.success,
                    colors.warning,
                    colors.danger,
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

    // Monthly Performance Chart
    const monthlyCtx = document.getElementById('monthlyPerformanceChart').getContext('2d');
    new Chart(monthlyCtx, {
        type: 'bar',
        data: {
            labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4'],
            datasets: [{
                label: 'Revenue',
                data: [12000, 19000, 15000, 22000],
                backgroundColor: colors.primary,
                borderRadius: 8
            }, {
                label: 'Contributions',
                data: [8000, 12000, 10000, 15000],
                backgroundColor: colors.success,
                borderRadius: 8
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

    // Member Status Chart
    const memberCtx = document.getElementById('memberStatusChart').getContext('2d');
    new Chart(memberCtx, {
        type: 'pie',
        data: {
            labels: ['Active', 'Inactive', 'Pending'],
            datasets: [{
                data: [75, 15, 10],
                backgroundColor: [
                    colors.success,
                    colors.danger,
                    colors.warning
                ],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });

    // Animate progress rings
    const progressRings = document.querySelectorAll('.progress-ring-circle');
    progressRings.forEach(ring => {
        const circumference = 2 * Math.PI * 35;
        const offset = circumference - (parseFloat(ring.getAttribute('stroke-dashoffset')) / 100 * circumference);
        ring.style.strokeDasharray = circumference + ' ' + circumference;
        ring.style.strokeDashoffset = circumference;
        
        setTimeout(() => {
            ring.style.transition = 'stroke-dashoffset 1s ease-in-out';
            ring.style.strokeDashoffset = offset;
        }, 500);
    });
});
</script>
@endsection