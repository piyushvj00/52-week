@extends('admin.layouts.main')
@section('title', 'Dashboard')
<style>
    .contribution-table-container {
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
    }
    .member-info {
        display: flex;
        align-items: center;
        gap: 12px;
    }
    .member-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 600;
        font-size: 0.9rem;
    }
    .member-details {
        display: flex;
        flex-direction: column;
    }
    .member-name {
        font-weight: 600;
        color: #2d3748;
    }
    .member-phone {
        font-size: 0.8rem;
        color: #718096;
    }
    .amount-cell {
        font-weight: 700;
        color: #2d3748;
        font-size: 1rem;
    }
    .status-badge {
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .status-pending {
        background: rgba(245, 158, 11, 0.1);
        color: #d97706;
    }
    .status-completed {
        background: rgba(72, 187, 120, 0.1);
        color: #38a169;
    }
    .status-failed {
        background: rgba(229, 62, 62, 0.1);
        color: #e53e3e;
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
    .group-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 25px;
        border-radius: 12px;
        margin-bottom: 20px;
    }
    .group-info {
        display: flex;
        justify-content: between;
        align-items: center;
        flex-wrap: wrap;
        gap: 20px;
    }
    .group-details {
        flex: 1;
    }
    .group-title {
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 8px;
    }
    .group-meta {
        display: flex;
        gap: 20px;
        flex-wrap: wrap;
    }
    .meta-item {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 0.9rem;
    }
    .progress-container {
        flex: 1;
        min-width: 300px;
        max-width: 400px;
    }
    .progress-info {
        display: flex;
        justify-content: between;
        margin-bottom: 8px;
    }
    .progress {
        height: 10px;
        border-radius: 5px;
        background: rgba(255, 255, 255, 0.3);
    }
    .progress-bar {
        background: white;
        border-radius: 5px;
    }
    .contribution-details {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
        margin-top: 8px;
    }
    .detail-badge {
        background: #f7fafc;
        border: 1px solid #e2e8f0;
        padding: 4px 10px;
        border-radius: 6px;
        font-size: 0.75rem;
        color: #4a5568;
        display: flex;
        align-items: center;
        gap: 4px;
    }
    .empty-state {
        text-align: center;
        padding: 40px 20px;
        color: #a0aec0;
    }
    .empty-state i {
        font-size: 3rem;
        margin-bottom: 16px;
        color: #cbd5e0;
    }
    .pagination-container {
        background: white;
        padding: 20px;
        border-top: 1px solid #e9ecef;
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
        .group-info {
            flex-direction: column;
            text-align: center;
        }
        .progress-container {
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
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0">Group Contributions</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                                    <li class="breadcrumb-item"><a href="#">Groups</a></li>
                                    <li class="breadcrumb-item active">{{ $group->name ?? 'Group' }} Contributions</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="content-body">
                <!-- Group Header -->
                <div class="group-header">
                    <div class="group-info">
                        <div class="group-details">
                            <h1 class="group-title">{{ $group->name ?? 'Group Name' }}</h1>
                            <div class="group-meta">
                                <div class="meta-item">
                                    <i class="bi bi-people-fill"></i>
                                    <span>{{ $group->members_count ?? 0 }} Members</span>
                                </div>
                                <div class="meta-item">
                                    <i class="bi bi-calendar-week"></i>
                                    <span>Week {{ $currentWeek ?? 1 }}</span>
                                </div>
                                <div class="meta-item">
                                    <i class="bi bi-cash-stack"></i>
                                    <span>${{ number_format($group->target_amount ?? 0, 2) }} Target</span>
                                </div>
                            </div>
                        </div>
                        <div class="progress-container">
                            <div class="progress-info text-white">
                                <span>Progress</span>
                                <span>{{ $progressPercentage ?? 0 }}%</span>
                            </div>
                            <div class="progress">
                                <div class="progress-bar" style="width: {{ $progressPercentage ?? 0 }}%"></div>
                            </div>
                            <div class="text-white mt-2">
                                ${{ number_format($group->current_amount ?? 0, 2) }} of ${{ number_format($group->target_amount ?? 0, 2) }}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Stats Summary -->
                <div class="stats-summary">
                    <div class="stat-card">
                        <div class="stat-value">{{ $totalContributions ?? 0 }}</div>
                        <div class="stat-label">Total Contributions</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-value">${{ number_format($totalAmount ?? 0, 2) }}</div>
                        <div class="stat-label">Total Amount</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-value">{{ $completedContributions ?? 0 }}</div>
                        <div class="stat-label">Approved</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-value">{{ $pendingContributions ?? 0 }}</div>
                        <div class="stat-label">Pending</div>
                    </div>
                </div>

                <!-- Contributions Table -->
                <div class="contribution-table-container">
                    <div class="table-header-custom">
                        <h4><i class="bi bi-cash-coin me-2"></i>Member Contributions</h4>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-custom table-hover">
                            <thead>
                                <tr>
                                    <th width="60">#</th>
                                    <th>Member</th>
                                    <th width="120">Week</th>
                                    <th width="150">Amount</th>
                                    <th width="120">Weekly Commitment</th>
                                    <th width="150">Contribution Date</th>
                                    <th width="120">Status</th>
                                    <th width="100">Payment Method</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($contribution as $key => $val)
                                    <tr>
                                        <td class="fw-semibold">{{ $key + 1 + ($contribution->currentPage() - 1) * $contribution->perPage() }}</td>
                                        <td>
                                            <div class="member-info">
                                                <div class="member-avatar">
                                                    {{ substr($val->user->name ?? 'U', 0, 1) }}
                                                </div>
                                                <div class="member-details">
                                                    <div class="member-name">{{ $val->user->name ?? 'Unknown User' }}</div>
                                                    <div class="member-phone">{{ $val->user->phone ?? 'N/A' }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge bg-primary">Week {{ $val->week_number ?? 'N/A' }}</span>
                                        </td>
                                        <td class="amount-cell">
                                            ${{ number_format($val->amount ?? 0, 2) }}
                                        </td>
                                        <td>
                                            ${{ number_format($val->contributionamount ?? 0, 2) }}
                                        </td>
                                        <td>
                                            {{ $val->contribution_date ? \Carbon\Carbon::parse($val->contribution_date)->format('M d, Y') : 'N/A' }}
                                        </td>
                                        <td>
                                            @if ($val->status == 'pending')
                                                <span class="status-badge status-pending">
                                                    <i class="bi bi-clock"></i> Pending
                                                </span>
                                            @elseif ($val->status == 'completed')
                                                <span class="status-badge status-completed">
                                                    <i class="bi bi-check-circle"></i> Approved
                                                </span>
                                            @elseif ($val->status == 'failed')
                                                <span class="status-badge status-failed">
                                                    <i class="bi bi-x-circle"></i> Rejected
                                                </span>
                                            @else
                                                <span class="status-badge bg-secondary">Unknown</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($val->payment_method)
                                                <span class="badge bg-info">{{ ucfirst($val->payment_method) }}</span>
                                            @else
                                                <span class="text-muted">N/A</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @if($val->transaction_id)
                                    <tr>
                                        <td colspan="8" style="padding-top: 0; border-top: none;">
                                            <div class="contribution-details">
                                                <span class="detail-badge">
                                                    <i class="bi bi-receipt"></i>
                                                    Transaction: {{ $val->transaction_id }}
                                                </span>
                                                <span class="detail-badge">
                                                    <i class="bi bi-calendar"></i>
                                                    Submitted: {{ $val->created_at->format('M d, Y h:i A') }}
                                                </span>
                                            </div>
                                        </td>
                                    </tr>
                                    @endif
                                @empty
                                    <tr>
                                        <td colspan="8">
                                            <div class="empty-state">
                                                <i class="bi bi-cash-coin"></i>
                                                <h4>No Contributions Found</h4>
                                                <p>No contributions have been made to this group yet.</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if($contribution->hasPages())
                        <div class="pagination-container">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="text-muted">
                                    Showing {{ $contribution->firstItem() }} to {{ $contribution->lastItem() }} of {{ $contribution->total() }} contributions
                                </div>
                                <div>
                                    {{ $contribution->links() }}
                                </div>
                            </div>
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

        function confirmStatusChange(status, id) {
            const action = status === 'completed' ? 'approve' : 'reject';
            if (confirm(`Are you sure you want to ${action} this contribution?`)) {
                changeStatus(status, id);
            }
        }

        function changeStatus(status, id) {
            $.ajax({
                url: "{{ route('contribution.status') }}",
                type: "POST",
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    id: id,
                    status: status,
                },
                success: function (response) {
                    if (response == 'completed') {
                        showToast('Contribution approved successfully', 'success');
                        setTimeout(() => {
                            window.location.reload();
                        }, 1000);
                    } else {
                        showToast('Contribution rejected successfully', 'success');
                        setTimeout(() => {
                            window.location.reload();
                        }, 1000);
                    }
                },
                error: function (xhr) {
                    alert("Something went wrong!");
                }
            });
        }

        // Add some interactive effects
        document.addEventListener('DOMContentLoaded', function() {
            // Add loading animation to table rows
            const tableRows = document.querySelectorAll('.table-custom tbody tr');
            tableRows.forEach((row, index) => {
                row.style.animationDelay = `${index * 0.05}s`;
            });
        });
    </script>
@endsection