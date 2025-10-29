@extends('admin.layouts.main')
@section('title', 'Dashboard')
<style>
    .portal-table-container {
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        overflow: hidden;
    }
    .table-header-custom {
        background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
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
        background-color: #f0fff4;
        transform: translateY(-1px);
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }
    .table-custom tbody td {
        padding: 16px 12px;
        vertical-align: middle;
        color: #4a5568;
        font-size: 0.9rem;
    }
    .portal-name {
        font-weight: 600;
        color: #2d3748;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .portal-name i {
        color: #11998e;
        font-size: 1.1rem;
    }
    .total-groups {
        background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
        color: white;
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
    .action-buttons {
        display: flex;
        gap: 8px;
        align-items: center;
    }
    .btn-action {
        width: 36px;
        height: 36px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
        border: none;
        text-decoration: none;
    }
    .btn-edit {
        background: rgba(17, 153, 142, 0.1);
        color: #11998e;
    }
    .btn-edit:hover {
        background: #11998e;
        color: white;
        transform: translateY(-2px);
    }
    .btn-delete {
        background: rgba(229, 62, 62, 0.1);
        color: #e53e3e;
    }
    .btn-delete:hover {
        background: #e53e3e;
        color: white;
        transform: translateY(-2px);
    }
    .pagination-container {
        background: white;
        padding: 20px;
        border-top: 1px solid #e9ecef;
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
        border-left: 4px solid #11998e;
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
    .portal-details {
        display: flex;
        gap: 15px;
        margin-top: 8px;
        flex-wrap: wrap;
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
    .detail-badge i {
        color: #11998e;
        font-size: 0.7rem;
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
        .portal-details {
            flex-direction: column;
            gap: 8px;
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
                            <h2 class="content-header-title float-start mb-0">Portals</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                                    <li class="breadcrumb-item active">Portals</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
                    <div class="mb-1 breadcrumb-right">
                        <a href="{{ route('portal.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus-circle me-1"></i> Add New Portal
                        </a>
                    </div>
                </div>
            </div>

            <div class="content-body">
                <!-- Stats Summary -->
                <div class="stats-summary">
                    <div class="stat-card">
                        <div class="stat-value">{{ $portal->total() }}</div>
                        <div class="stat-label">Total Portals</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-value">{{ $portal->sum('total_portals') }}</div>
                        <div class="stat-label">Total Groups</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-value">{{ $portal->where('is_active', 1)->count() }}</div>
                        <div class="stat-label">Active Portals</div>
                    </div>
                </div>

                <!-- Portals Table -->
                <div class="portal-table-container">
                    <div class="table-header-custom">
                        <h4><i class="bi bi-door-closed me-2"></i>Portal Management</h4>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-custom table-hover">
                            <thead>
                                <tr>
                                    <th width="80">#</th>
                                    <th>Portal Details</th>
                                    <th width="150">Total Groups</th>
                                    <th width="120">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($portal as $key => $val)
                                    <tr>
                                        <td class="fw-semibold">{{ $key + 1 + ($portal->currentPage() - 1) * $portal->perPage() }}</td>
                                        <td>
                                            <div class="portal-name">
                                                <i class="bi bi-door-open"></i>
                                                {{ $val->name ?? 'Unnamed Portal' }}
                                            </div>
                                            <div class="portal-details">
                                                @if($val->start_date)
                                                    <span class="detail-badge">
                                                        <i class="bi bi-calendar-check"></i>
                                                        Start: {{ \Carbon\Carbon::parse($val->start_date)->format('M d, Y') }}
                                                    </span>
                                                @endif
                                                @if($val->end_date)
                                                    <span class="detail-badge">
                                                        <i class="bi bi-calendar-x"></i>
                                                        End: {{ \Carbon\Carbon::parse($val->end_date)->format('M d, Y') }}
                                                    </span>
                                                @endif
                                                @if($val->target_amount)
                                                    <span class="detail-badge">
                                                        <i class="bi bi-currency-dollar"></i>
                                                        Target: ${{ number_format($val->target_amount, 2) }}
                                                    </span>
                                                @endif
                                                <span class="detail-badge">
                                                    <i class="bi bi-circle-fill {{ $val->is_active ? 'text-success' : 'text-danger' }}"></i>
                                                    {{ $val->is_active ? 'Active' : 'Inactive' }}
                                                </span>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="total-groups">
                                                <i class="bi bi-people-fill"></i>
                                                {{ $val->total_portals ?? 0 }} Groups
                                            </span>
                                        </td>
                                        <td>
                                            <div class="action-buttons">
                                                <a href="{{ route('portal.edit', $val->id) }}" 
                                                   class="btn-action btn-edit" 
                                                   title="Edit Portal">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                <form action="{{ route('portal.destroy', $val->id) }}" 
                                                      method="POST" 
                                                      style="display:inline;"
                                                      onsubmit="return confirm('Are you sure you want to delete this portal?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn-action btn-delete mt-1" title="Delete Portal">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4">
                                            <div class="empty-state">
                                                <i class="bi bi-door-closed"></i>
                                                <h4>No Portals Found</h4>
                                                <p>Get started by creating your first portal.</p>
                                                <a href="{{ route('portal.create') }}" class="btn btn-primary mt-2">
                                                    <i class="bi bi-plus-circle me-1"></i> Create Portal
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if($portal->hasPages())
                        <div class="pagination-container">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="text-muted">
                                    Showing {{ $portal->firstItem() }} to {{ $portal->lastItem() }} of {{ $portal->total() }} entries
                                </div>
                                <div>
                                    {{ $portal->links() }}
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

        // Add some interactive effects
        document.addEventListener('DOMContentLoaded', function() {
            // Add loading animation to table rows
            const tableRows = document.querySelectorAll('.table-custom tbody tr');
            tableRows.forEach((row, index) => {
                row.style.animationDelay = `${index * 0.05}s`;
            });

            // Add confirmation for delete actions
            const deleteForms = document.querySelectorAll('form[action*="destroy"]');
            deleteForms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    if (!confirm('Are you sure you want to delete this portal? This action cannot be undone.')) {
                        e.preventDefault();
                    }
                });
            });
        });
    </script>
@endsection