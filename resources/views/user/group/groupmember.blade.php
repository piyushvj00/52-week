@extends('user.layouts.main')

@section('title', 'Group Members')
<style>
    .members-container {
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        overflow: hidden;
    }
    .table-header-custom {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 20px 25px;
        border-bottom: none;
    }
    .table-header-custom h4 {
        margin: 0;
        font-weight: 600;
    }
    .members-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 20px;
        padding: 25px;
    }
    .member-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        border: 1px solid #e8e8e8;
        transition: all 0.3s ease;
        overflow: hidden;
        position: relative;
    }
    .member-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    }
    .member-card-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 20px;
        position: relative;
    }
    .member-avatar {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.2);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 15px;
        border: 3px solid rgba(255, 255, 255, 0.3);
    }
    .member-name {
        font-size: 1.3rem;
        font-weight: 700;
        margin-bottom: 5px;
    }
    .member-role {
        background: rgba(255, 255, 255, 0.2);
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        display: inline-block;
    }
    .member-card-body {
        padding: 20px;
    }
    .member-info-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 10px 0;
        border-bottom: 1px solid #f1f3f4;
    }
    .member-info-item:last-child {
        border-bottom: none;
    }
    .info-icon {
        width: 32px;
        height: 32px;
        border-radius: 8px;
        background: rgba(102, 126, 234, 0.1);
        color: #667eea;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    .info-content {
        flex: 1;
    }
    .info-label {
        font-size: 0.8rem;
        color: #718096;
        font-weight: 500;
        display: block;
    }
    .info-value {
        font-size: 0.95rem;
        color: #2d3748;
        font-weight: 600;
        display: block;
    }
    .contribution-progress {
        margin: 15px 0;
        padding: 15px;
        background: #f8f9fa;
        border-radius: 8px;
    }
    .progress-info {
        display: flex;
        justify-content: space-between;
        margin-bottom: 8px;
    }
    .progress {
        height: 6px;
        border-radius: 3px;
        background: #e2e8f0;
        overflow: hidden;
    }
    .progress-bar {
        background: linear-gradient(135deg, #28c76f 0%, #48da89 100%);
        border-radius: 3px;
        transition: width 0.5s ease;
    }
    .member-status {
        position: absolute;
        top: 15px;
        right: 15px;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
    }
    .status-active {
        background: rgba(40, 199, 111, 0.1);
        color: #28c76f;
        border: 1px solid rgba(40, 199, 111, 0.2);
    }
    .status-inactive {
        background: rgba(108, 117, 125, 0.1);
        color: #6c757d;
        border: 1px solid rgba(108, 117, 125, 0.2);
    }
    .stats-summary {
        display: flex;
        gap: 15px;
        margin-bottom: 20px;
        flex-wrap: wrap;
    }
    .stat-card {
        flex: 1;
        min-width: 200px;
        background: white;
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        border-left: 4px solid #667eea;
        text-align: center;
    }
    .stat-value {
        font-size: 2rem;
        font-weight: 700;
        color: #2d3748;
        line-height: 1;
    }
    .stat-label {
        font-size: 0.875rem;
        color: #718096;
        margin-top: 8px;
    }
    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: #a0aec0;
    }
    .empty-state i {
        font-size: 4rem;
        margin-bottom: 16px;
        color: #cbd5e0;
    }
    .performance-badge {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 4px 8px;
        border-radius: 12px;
        font-size: 0.7rem;
        font-weight: 600;
        margin-top: 4px;
    }
    .performance-excellent {
        background: rgba(40, 199, 111, 0.1);
        color: #28c76f;
    }
    .performance-good {
        background: rgba(255, 159, 67, 0.1);
        color: #ff9f43;
    }
    .performance-average {
        background: rgba(108, 117, 125, 0.1);
        color: #6c757d;
    }
    @media (max-width: 768px) {
        .members-grid {
            grid-template-columns: 1fr;
            padding: 15px;
        }
        .stats-summary {
            flex-direction: column;
        }
        .stat-card {
            min-width: 100%;
        }
    }
</style>
@section('content')
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0">My Group Members</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}">Home</a></li>
                                    <li class="breadcrumb-item active">Group Members</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="content-body">
                <!-- Statistics Summary -->
                <div class="stats-summary">
                    <div class="stat-card">
                        <div class="stat-value">{{ $groupMembers->count() }}</div>
                        <div class="stat-label">Total Members</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-value">${{ number_format($groupMembers->sum('weekly_commitment'), 2) }}</div>
                        <div class="stat-label">Total Weekly Commitment</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-value">${{ number_format($groupMembers->sum('total_contributed'), 2) }}</div>
                        <div class="stat-label">Total Contributed</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-value">{{ $groupMembers->where('is_active', true)->count() }}</div>
                        <div class="stat-label">Active Members</div>
                    </div>
                </div>

                <!-- Members Grid -->
                <div class="members-container">
                    <div class="table-header-custom">
                        <h4><i class="bi bi-people-fill me-2"></i>Group Members Overview</h4>
                    </div>

                    @if($groupMembers->count() > 0)
                        <div class="members-grid">
                            @foreach ($groupMembers as $groupMember)
                                @php
                                    $user = \App\Models\User::where('id', $groupMember->user_id)->first();
                                    $progressPercentage = $groupMember->weekly_commitment > 0 ? 
                                        min(100, ($groupMember->total_contributed / $groupMember->weekly_commitment) * 100) : 0;
                                    
                                    // Determine performance level
                                    if ($progressPercentage >= 90) {
                                        $performanceClass = 'performance-excellent';
                                        $performanceText = 'Excellent';
                                    } elseif ($progressPercentage >= 70) {
                                        $performanceClass = 'performance-good';
                                        $performanceText = 'Good';
                                    } else {
                                        $performanceClass = 'performance-average';
                                        $performanceText = 'Average';
                                    }
                                @endphp

                                <div class="member-card">
                                    <div class="member-card-header">
                                        <div class="member-avatar">
                                            {{ substr($user->name ?? 'U', 0, 1) }}
                                        </div>
                                        <div class="member-name">{{ $user->name ?? 'Unknown Member' }}</div>
                                        <span class="member-role">Group Member</span>
                                        <span class="member-status {{ $groupMember->is_active ? 'status-active' : 'status-inactive' }}">
                                            {{ $groupMember->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </div>
                                    
                                    <div class="member-card-body">
                                        <!-- Member Information -->
                                        <div class="member-info-list">
                                            <div class="member-info-item">
                                                <div class="info-icon">
                                                    <i data-feather="dollar-sign"></i>
                                                </div>
                                                <div class="info-content">
                                                    <span class="info-label">Weekly Commitment</span>
                                                    <span class="info-value">${{ number_format($groupMember->weekly_commitment, 2) }}</span>
                                                </div>
                                            </div>
                                            <div class="member-info-item">
                                                <div class="info-icon">
                                                    <i data-feather="target"></i>
                                                </div>
                                                <div class="info-content">
                                                    <span class="info-label">Total Contributed</span>
                                                    <span class="info-value">${{ number_format($groupMember->total_contributed, 2) }}</span>
                                                </div>
                                            </div>
                                            <div class="member-info-item">
                                                <div class="info-icon">
                                                    <i data-feather="calendar"></i>
                                                </div>
                                                <div class="info-content">
                                                    <span class="info-label">Member Since</span>
                                                    <span class="info-value">{{ \Carbon\Carbon::parse($groupMember->created_at)->format('M d, Y') }}</span>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Contribution Progress -->
                                        @if($groupMember->weekly_commitment > 0)
                                        <div class="contribution-progress">
                                            <div class="progress-info">
                                                <span class="info-label">Contribution Progress</span>
                                                <span class="info-value">
                                                    {{ number_format($progressPercentage, 1) }}%
                                                </span>
                                            </div>
                                            <div class="progress">
                                                <div class="progress-bar" style="width: {{ $progressPercentage }}%"></div>
                                            </div>
                                            <div class="progress-info mt-2">
                                                <small class="text-muted">
                                                    ${{ number_format($groupMember->total_contributed, 2) }} of ${{ number_format($groupMember->weekly_commitment, 2) }}
                                                </small>
                                                <span class="performance-badge {{ $performanceClass }}">
                                                    <i data-feather="{{ $progressPercentage >= 90 ? 'star' : ($progressPercentage >= 70 ? 'check-circle' : 'clock') }}"></i>
                                                    {{ $performanceText }}
                                                </span>
                                            </div>
                                        </div>
                                        @endif

                                        <!-- Additional Info -->
                                        @if($groupMember->group_sare > 0)
                                        <div class="member-info-item">
                                            <div class="info-icon">
                                                <i data-feather="pie-chart"></i>
                                            </div>
                                            <div class="info-content">
                                                <span class="info-label">Group Share</span>
                                                <span class="info-value">${{ number_format($groupMember->group_sare, 2) }}</span>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Group Performance Summary -->
                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h6 class="card-title mb-3">
                                            <i class="bi bi-graph-up text-primary me-2"></i>Group Performance Summary
                                        </h6>
                                        <div class="row text-center">
                                            <div class="col-md-3 mb-3">
                                                <div class="stat-value text-primary">{{ number_format($groupMembers->avg('total_contributed') / max($groupMembers->avg('weekly_commitment'), 1) * 100, 1) }}%</div>
                                                <div class="stat-label">Average Completion</div>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <div class="stat-value text-success">{{ $groupMembers->where('total_contributed', '>=', \DB::raw('weekly_commitment'))->count() }}</div>
                                                <div class="stat-label">Target Achievers</div>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <div class="stat-value text-warning">{{ $groupMembers->where('total_contributed', '>', 0)->where('total_contributed', '<', \DB::raw('weekly_commitment'))->count() }}</div>
                                                <div class="stat-label">In Progress</div>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <div class="stat-value text-info">{{ $groupMembers->where('total_contributed', 0)->count() }}</div>
                                                <div class="stat-label">Yet to Start</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="empty-state">
                            <i data-feather="users"></i>
                            <h4>No Members Found</h4>
                            <p>There are no members in your group yet.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>
@endsection

@section('script')
    <script src="{{ asset('admin/app-assets/vendors/js/vendors.min.js')}}"></script>
    <script src="{{ asset('admin/app-assets/vendors/js/charts/apexcharts.min.js')}}"></script>
    <script src="{{ asset('admin/app-assets/vendors/js/extensions/toastr.min.js')}}"></script>
    <script src="{{ asset('admin/app-assets/js/core/app-menu.js')}}"></script>
    <script src="{{ asset('admin/app-assets/js/core/app.js')}}"></script>
    <script src="{{ asset('admin/app-assets/js/scripts/pages/dashboard-ecommerce.js')}}"></script>
    
    <script>
        $(window).on('load', function () {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        });

        // Add animation to cards
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.member-card');
            cards.forEach((card, index) => {
                card.style.animationDelay = `${index * 0.1}s`;
            });

            // Add progress bar animation
            const progressBars = document.querySelectorAll('.progress-bar');
            progressBars.forEach(bar => {
                const width = bar.style.width;
                bar.style.width = '0%';
                setTimeout(() => {
                    bar.style.width = width;
                }, 500);
            });
        });

        function showToast(message, type = 'success') {
            // Simple toast implementation
            const toast = document.createElement('div');
            toast.className = `alert alert-${type} alert-dismissible fade show position-fixed`;
            toast.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
            toast.innerHTML = `
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            `;
            document.body.appendChild(toast);
            
            setTimeout(() => {
                toast.remove();
            }, 3000);
        }
    </script>
@endsection