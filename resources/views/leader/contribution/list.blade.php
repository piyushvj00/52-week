@extends('leader.layouts.main')
@section('title', 'Dashboard')
<style>
    .contributions-container {
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
    .group-name {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 500;
        display: inline-block;
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
    .action-buttons {
        display: flex;
        gap: 8px;
        align-items: center;
    }
    .btn-action {
        padding: 6px 12px;
        border-radius: 6px;
        font-size: 0.8rem;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 4px;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
    }
    .btn-approve {
        background: rgba(72, 187, 120, 0.1);
        color: #38a169;
        border: 1px solid rgba(72, 187, 120, 0.2);
    }
    .btn-approve:hover {
        background: #38a169;
        color: white;
        transform: translateY(-1px);
    }
    .btn-reject {
        background: rgba(229, 62, 62, 0.1);
        color: #e53e3e;
        border: 1px solid rgba(229, 62, 62, 0.2);
    }
    .btn-reject:hover {
        background: #e53e3e;
        color: white;
        transform: translateY(-1px);
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
        padding: 40px 20px;
        color: #a0aec0;
    }
    .empty-state i {
        font-size: 3rem;
        margin-bottom: 16px;
        color: #cbd5e0;
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
    .filter-section {
        background: white;
        border-radius: 12px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        padding: 20px;
        margin-bottom: 20px;
    }
    .filter-buttons {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }
    .filter-btn {
        padding: 8px 16px;
        border-radius: 8px;
        border: 1px solid #e2e8f0;
        background: white;
        color: #4a5568;
        font-size: 0.85rem;
        font-weight: 500;
        transition: all 0.3s ease;
        cursor: pointer;
    }
    .filter-btn.active {
        background: #667eea;
        color: white;
        border-color: #667eea;
    }
    .filter-btn:hover:not(.active) {
        background: #f7fafc;
        border-color: #cbd5e0;
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
        .action-buttons {
            flex-direction: column;
            gap: 6px;
        }
        .btn-action {
            width: 100%;
            justify-content: center;
        }
        .filter-buttons {
            flex-direction: column;
        }
        .filter-btn {
            width: 100%;
            text-align: center;
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
                            <h2 class="content-header-title float-start mb-0">Contributions Management</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('leader.dashboard') }}">Home</a></li>
                                    <li class="breadcrumb-item active">Contributions</li>
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
                        <div class="stat-value">{{ $contribution->total() }}</div>
                        <div class="stat-label">Total Contributions</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-value">{{ $contribution->where('status', 'completed')->count() }}</div>
                        <div class="stat-label">Approved</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-value">{{ $contribution->where('status', 'pending')->count() }}</div>
                        <div class="stat-label">Pending</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-value">{{ $contribution->where('status', 'failed')->count() }}</div>
                        <div class="stat-label">Rejected</div>
                    </div>
                </div>

                <!-- Filter Section -->
                <div class="filter-section">
                    <h6 class="mb-3">Filter by Status</h6>
                    <div class="filter-buttons">
                        <button class="filter-btn active" data-filter="all">All Contributions</button>
                        <button class="filter-btn" data-filter="pending">Pending</button>
                        <button class="filter-btn" data-filter="completed">Approved</button>
                        <button class="filter-btn" data-filter="failed">Rejected</button>
                    </div>
                </div>

                <!-- Contributions Table -->
                <div class="contributions-container">
                    <div class="table-header-custom">
                        <h4><i class="bi bi-cash-coin me-2"></i>Member Contributions</h4>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-custom table-hover">
                            <thead>
                                <tr>
                                    <th width="60">#</th>
                                    <th>Member</th>
                                    <th>Group</th>
                                    <th width="150">Amount</th>
                                    <th width="120">Status</th>
                                    <th width="180">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($contribution as $key => $val)
                                    <tr class="contribution-row" data-status="{{ $val->status }}">
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
                                            <span class="group-name">{{ $val->group->name ?? 'N/A' }}</span>
                                        </td>
                                        <td class="amount-cell">
                                            ${{ number_format($val->contributionamount ?? 0, 2) }}
                                        </td>
                                        <td>
                                            @if ($val->status == 'pending')
                                                <span class="status-badge status-pending">
                                                    <i class="bi bi-clock me-1"></i> Pending
                                                </span>
                                            @elseif ($val->status == 'completed')
                                                <span class="status-badge status-completed">
                                                    <i class="bi bi-check-circle me-1"></i> Approved
                                                </span>
                                            @elseif ($val->status == 'failed')
                                                <span class="status-badge status-failed">
                                                    <i class="bi bi-x-circle me-1"></i> Rejected
                                                </span>
                                            @else
                                                <span class="status-badge bg-secondary">Unknown</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($val->status == 'pending')
                                                <div class="action-buttons">
                                                    <button onclick="confirmStatusChange('completed', {{ $val->id }})"
                                                            class="btn-action btn-approve"
                                                            title="Approve Contribution">
                                                        <i data-feather="check"></i> Approve
                                                    </button>
                                                    <button onclick="confirmStatusChange('failed', {{ $val->id }})"
                                                            class="btn-action btn-reject"
                                                            title="Reject Contribution">
                                                        <i data-feather="x"></i> Reject
                                                    </button>
                                                </div>
                                            @else
                                                <span class="text-muted">No actions available</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <!-- Additional details row -->
                                    <tr class="contribution-details-row" data-status="{{ $val->status }}">
                                        <td colspan="6" style="padding-top: 0; border-top: none;">
                                            <div class="contribution-details">
                                                <span class="detail-badge">
                                                    <i class="bi bi-calendar"></i>
                                                    Submitted: {{ $val->created_at->format('M d, Y h:i A') }}
                                                </span>
                                                @if($val->transaction_id)
                                                <span class="detail-badge">
                                                    <i class="bi bi-receipt"></i>
                                                    Transaction: {{ $val->transaction_id }}
                                                </span>
                                                @endif
                                                @if($val->week_number)
                                                <span class="detail-badge">
                                                    <i class="bi bi-calendar-week"></i>
                                                    Week: {{ $val->week_number }}
                                                </span>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6">
                                            <div class="empty-state">
                                                <i class="bi bi-cash-coin"></i>
                                                <h4>No Contributions Found</h4>
                                                <p>There are no contributions to display at the moment.</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if($contribution->hasPages())
                        <div class="pagination-container p-4 border-top">
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
            const memberName = document.querySelector(`[onclick*="${id}"]`).closest('tr').querySelector('.member-name').textContent;
            
            if (confirm(`Are you sure you want to ${action} the contribution from ${memberName}?`)) {
                changeStatus(status, id);
            }
        }

        function changeStatus(status, id) {
            $.ajax({
                url: "{{ route('leader.contribution.status') }}",
                type: "POST",
                data: {
                    _token: '{{ csrf_token() }}',
                    id: id,
                    status: status,
                },
                success: function (response) {
                    const message = response == 'completed' ? 'Contribution approved successfully' : 'Contribution rejected successfully';
                    showToast(message, 'success');
                    setTimeout(() => {
                        window.location.reload();
                    }, 1500);
                },
                error: function (xhr) {
                    showToast('Something went wrong! Please try again.', 'error');
                }
            });
        }

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

        // Filter functionality
        document.addEventListener('DOMContentLoaded', function() {
            const filterButtons = document.querySelectorAll('.filter-btn');
            const contributionRows = document.querySelectorAll('.contribution-row, .contribution-details-row');
            
            filterButtons.forEach(button => {
                button.addEventListener('click', function() {
                    // Remove active class from all buttons
                    filterButtons.forEach(btn => btn.classList.remove('active'));
                    // Add active class to clicked button
                    this.classList.add('active');
                    
                    const filter = this.getAttribute('data-filter');
                    
                    contributionRows.forEach(row => {
                        if (filter === 'all') {
                            row.style.display = '';
                        } else {
                            const status = row.getAttribute('data-status');
                            if (status === filter) {
                                row.style.display = '';
                            } else {
                                row.style.display = 'none';
                            }
                        }
                    });
                });
            });

            // Add loading animation to table rows
            const tableRows = document.querySelectorAll('.table-custom tbody tr');
            tableRows.forEach((row, index) => {
                row.style.animationDelay = `${index * 0.05}s`;
            });
        });
    </script>
@endsection