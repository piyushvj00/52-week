@extends('leader.layouts.main')
@section('title', 'Dashboard')
<style>
    .groups-container {
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
    .table-custom {
        margin: 0;
        border-collapse: separate;
        border-spacing: 0;
        width: 100%;
    }
    .table-custom thead {
        background-color: #f8f9fa;
    }
    .table-custom thead th {
        border-bottom: 2px solid #e9ecef;
        padding: 15px 12px;
        font-weight: 600;
        color: #495057;
        font-size: 0.875rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        text-align: center;
    }
    .table-custom tbody tr {
        transition: all 0.3s ease;
        border-bottom: 1px solid #f1f3f4;
    }
    .table-custom tbody tr:hover {
        background-color: #f8f9ff;
        transform: translateY(-1px);
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }
    .table-custom tbody td {
        padding: 16px 12px;
        vertical-align: middle;
        color: #4a5568;
        font-size: 0.9rem;
        text-align: center;
    }
    .group-link {
        color: #2d3748;
        text-decoration: none;
        font-weight: 600;
        transition: color 0.3s ease;
        display: block;
    }
    .group-link:hover {
        color: #667eea;
    }
    .group-subtitle {
        font-size: 0.8rem;
        color: #718096;
        margin-top: 4px;
        display: block;
    }
    .leader-info {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }
    .leader-avatar {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 600;
        font-size: 0.8rem;
    }
    .group-number {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        display: inline-block;
    }
    .amount-cell {
        font-weight: 700;
        color: #2d3748;
        font-size: 1rem;
    }
    .progress-container {
        max-width: 120px;
        margin: 0 auto;
    }
    .progress {
        height: 8px;
        border-radius: 4px;
        background: #e2e8f0;
        overflow: hidden;
        margin-bottom: 4px;
    }
    .progress-bar {
        background: linear-gradient(135deg, #28c76f 0%, #48da89 100%);
        border-radius: 4px;
        transition: width 0.5s ease;
    }
    .progress-text {
        font-size: 0.75rem;
        color: #718096;
        font-weight: 500;
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
    .performance-indicator {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        margin-top: 4px;
    }
    .performance-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
    }
    .performance-excellent {
        background: #28c76f;
    }
    .performance-good {
        background: #ff9f43;
    }
    .performance-poor {
        background: #ea5455;
    }
    .group-details {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
        justify-content: center;
        margin-top: 8px;
    }
    .detail-badge {
        background: #f7fafc;
        border: 1px solid #e2e8f0;
        padding: 4px 8px;
        border-radius: 6px;
        font-size: 0.7rem;
        color: #4a5568;
        display: flex;
        align-items: center;
        gap: 4px;
    }
    @media (max-width: 768px) {
        .table-responsive {
            border: 1px solid #e9ecef;
            border-radius: 8px;
        }
        .stats-summary {
            flex-direction: column;
        }
        .stat-card {
            min-width: 100%;
        }
        .table-custom thead {
            display: none;
        }
        .table-custom tbody tr {
            display: block;
            margin-bottom: 15px;
            border: 1px solid #e9ecef;
            border-radius: 8px;
            padding: 15px;
        }
        .table-custom tbody td {
            display: block;
            text-align: left;
            padding: 8px 0;
            border: none;
        }
        .table-custom tbody td::before {
            content: attr(data-label);
            font-weight: 600;
            color: #495057;
            display: block;
            font-size: 0.8rem;
            text-transform: uppercase;
            margin-bottom: 4px;
        }
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
                            <h2 class="content-header-title float-start mb-0">My Groups</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('leader.dashboard') }}">Home</a></li>
                                    <li class="breadcrumb-item active">Groups</li>
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
                        <div class="stat-value">{{ $groups->total() }}</div>
                        <div class="stat-label">Total Groups</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-value">${{ number_format($groups->sum('target_amount'), 2) }}</div>
                        <div class="stat-label">Total Target</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-value">${{ number_format($groups->sum('current_amount'), 2) }}</div>
                        <div class="stat-label">Total Collected</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-value">{{ number_format($groups->avg('current_amount') / max($groups->avg('target_amount'), 1) * 100, 1) }}%</div>
                        <div class="stat-label">Avg. Progress</div>
                    </div>
                </div>

                <!-- Groups Table -->
                <div class="groups-container">
                    <div class="table-header-custom">
                        <h4><i class="bi bi-people-fill me-2"></i>Managed Groups Overview</h4>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-custom table-hover">
                            <thead>
                                <tr>
                                    <th width="60">#</th>
                                    <th>Group Details</th>
                                    <th width="140">Leader</th>
                                    <th width="120">Target Amount</th>
                                    <th width="100">Group #</th>
                                    <th width="150">Current Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($groups as $key => $val)
                                    <tr>
                                        <td data-label="Sr No.">{{ $key + 1 + ($groups->currentPage() - 1) * $groups->perPage() }}</td>
                                        <td data-label="Group Details">
                                            <a href="{{ route('leader.contribution.list', $val->id) }}" class="group-link">
                                                {{ $val->name ?? 'Unnamed Group' }}
                                            </a>
                                            @if($val->project_name)
                                                <span class="group-subtitle">{{ $val->project_name }}</span>
                                            @endif
                                            <div class="group-details">
                                                @if($val->start_date && $val->end_date)
                                                <span class="detail-badge">
                                                    <i class="bi bi-calendar"></i>
                                                    {{ date('M d, Y', strtotime($val->start_date)) }} - {{ date('M d, Y', strtotime($val->end_date)) }}
                                                </span>
                                                @endif
                                                <span class="detail-badge">
                                                    <i class="bi bi-{{ $val->is_active ? 'check-circle text-success' : 'x-circle text-danger' }}"></i>
                                                    {{ $val->is_active ? 'Active' : 'Inactive' }}
                                                </span>
                                            </div>
                                        </td>
                                        <td data-label="Leader">
                                            <div class="leader-info">
                                                <div class="leader-avatar">
                                                    {{ substr($val->leader->name ?? 'L', 0, 1) }}
                                                </div>
                                                <span>{{ $val->leader->name ?? 'Not Assigned' }}</span>
                                            </div>
                                        </td>
                                        <td data-label="Target Amount" class="amount-cell">
                                            ${{ number_format($val->target_amount, 2) }}
                                        </td>
                                        <td data-label="Group Number">
                                            <span class="group-number">#{{ $val->group_number }}</span>
                                        </td>
                                        <td data-label="Current Amount">
                                            <div class="amount-cell">${{ number_format($val->current_amount, 2) }}</div>
                                            @if($val->target_amount > 0)
                                                <div class="progress-container">
                                                    <div class="progress">
                                                        <div class="progress-bar" 
                                                             style="width: {{ ($val->current_amount / $val->target_amount) * 100 }}%"
                                                             title="{{ number_format(($val->current_amount / $val->target_amount) * 100, 1) }}%">
                                                        </div>
                                                    </div>
                                                    <div class="progress-text">
                                                        {{ number_format(($val->current_amount / $val->target_amount) * 100, 1) }}%
                                                    </div>
                                                </div>
                                                <div class="performance-indicator">
                                                    @php
                                                        $progress = ($val->current_amount / $val->target_amount) * 100;
                                                        $performanceClass = $progress >= 75 ? 'performance-excellent' : 
                                                                           ($progress >= 50 ? 'performance-good' : 'performance-poor');
                                                    @endphp
                                                    <div class="performance-dot {{ $performanceClass }}"></div>
                                                    <small class="text-muted">
                                                        @if($progress >= 75) Excellent
                                                        @elseif($progress >= 50) Good
                                                        @else Needs Attention
                                                        @endif
                                                    </small>
                                                </div>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6">
                                            <div class="empty-state">
                                                <i class="bi bi-people"></i>
                                                <h4>No Groups Found</h4>
                                                <p>You are not currently managing any groups.</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if($groups->hasPages())
                        <div class="pagination-container p-4 border-top">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="text-muted">
                                    Showing {{ $groups->firstItem() }} to {{ $groups->lastItem() }} of {{ $groups->total() }} groups
                                </div>
                                <div>
                                    {{ $groups->links() }}
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Quick Tips -->
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="card-title mb-3">
                                    <i class="bi bi-lightbulb text-warning me-2"></i>Quick Tips
                                </h6>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="d-flex align-items-center mb-2">
                                            <i class="bi bi-arrow-right-circle text-primary me-2"></i>
                                            <small>Click on group name to view contributions</small>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="d-flex align-items-center mb-2">
                                            <i class="bi bi-graph-up text-success me-2"></i>
                                            <small>Monitor progress with color-coded indicators</small>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="d-flex align-items-center mb-2">
                                            <i class="bi bi-calendar-check text-info me-2"></i>
                                            <small>Track group duration and status</small>
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

        // Add animation to table rows
        document.addEventListener('DOMContentLoaded', function() {
            const tableRows = document.querySelectorAll('.table-custom tbody tr');
            tableRows.forEach((row, index) => {
                row.style.animationDelay = `${index * 0.05}s`;
            });

            // Add click effects to group links
            const groupLinks = document.querySelectorAll('.group-link');
            groupLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    // Add loading indicator
                    const originalText = this.innerHTML;
                    this.innerHTML = '<i class="bi bi-arrow-repeat spinner-border spinner-border-sm me-2"></i>Loading...';
                    
                    setTimeout(() => {
                        this.innerHTML = originalText;
                    }, 1000);
                });
            });
        });
    </script>
@endsection