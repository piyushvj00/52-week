@extends('user.layouts.main')
 
@section('title', 'Payment & reciepts')
<style>
    .payments-container {
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
    .week-badge {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
    .amount-cell {
        font-weight: 700;
        color: #2d3748;
        font-size: 1rem;
    }
    .date-cell {
        display: flex;
        align-items: center;
        gap: 8px;
        color: #718096;
    }
    .date-cell i {
        color: #667eea;
    }
    .action-buttons {
        display: flex;
        gap: 8px;
        align-items: center;
    }
    .btn-action {
        padding: 8px 16px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        transition: all 0.3s ease;
        border: none;
        text-decoration: none;
        font-size: 0.85rem;
        font-weight: 500;
    }
    .btn-view {
        background: rgba(102, 126, 234, 0.1);
        color: #667eea;
        border: 1px solid rgba(102, 126, 234, 0.2);
    }
    .btn-view:hover {
        background: #667eea;
        color: white;
        transform: translateY(-2px);
    }
    .btn-download {
        background: rgba(72, 187, 120, 0.1);
        color: #48bb78;
        border: 1px solid rgba(72, 187, 120, 0.2);
    }
    .btn-download:hover {
        background: #48bb78;
        color: white;
        transform: translateY(-2px);
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
    .payment-status {
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .status-completed {
        background: rgba(72, 187, 120, 0.1);
        color: #38a169;
    }
    .status-pending {
        background: rgba(245, 158, 11, 0.1);
        color: #d97706;
    }
    .status-failed {
        background: rgba(229, 62, 62, 0.1);
        color: #e53e3e;
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
    .payment-summary-card {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 25px;
        border-radius: 12px;
        margin-bottom: 20px;
    }
    .summary-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 20px;
    }
    .summary-text h3 {
        margin: 0 0 8px 0;
        font-weight: 700;
    }
    .summary-text p {
        margin: 0;
        opacity: 0.9;
    }
    .summary-stats {
        display: flex;
        gap: 30px;
        text-align: center;
    }
    .summary-stat .number {
        font-size: 1.5rem;
        font-weight: 700;
        display: block;
    }
    .summary-stat .label {
        font-size: 0.875rem;
        opacity: 0.8;
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
        .summary-content {
            flex-direction: column;
            text-align: center;
        }
        .summary-stats {
            justify-content: center;
        }
        .action-buttons {
            flex-direction: column;
            gap: 6px;
        }
        .btn-action {
            width: 100%;
            justify-content: center;
        }
    }
</style>
@section('content')
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-body">
            <!-- Payment Summary -->
            <div class="payment-summary-card">
                <div class="summary-content">
                    <div class="summary-text">
                        <h3>My Payment History</h3>
                        <p>Track all your contributions and payments in one place</p>
                    </div>
                    <div class="summary-stats">
                        <div class="summary-stat">
                            <span class="number">{{ $totalPayments ?? 0 }}</span>
                            <span class="label">Total Payments</span>
                        </div>
                        <div class="summary-stat">
                            <span class="number">${{ number_format($totalAmount ?? 0, 2) }}</span>
                            <span class="label">Total Amount</span>
                        </div>
                        <div class="summary-stat">
                            <span class="number">{{ $completedPayments ?? 0 }}</span>
                            <span class="label">Completed</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Stats -->
            <div class="stats-summary">
                <div class="stat-card">
                    <div class="stat-value">{{ $contributions->count() }}</div>
                    <div class="stat-label">Payments This Period</div>
                </div>
                <div class="stat-card">
                    <div class="stat-value">${{ number_format($contributions->sum('amount'), 2) }}</div>
                    <div class="stat-label">Total Contributed</div>
                </div>
                <div class="stat-card">
                    <div class="stat-value">Week {{ $currentWeek ?? 1 }}</div>
                    <div class="stat-label">Current Week</div>
                </div>
                <div class="stat-card">
                    <div class="stat-value">${{ number_format($weeklyCommitment ?? 0, 2) }}</div>
                    <div class="stat-label">Weekly Commitment</div>
                </div>
            </div>

            <!-- Payments Table -->
            <div class="payments-container">
                <div class="table-header-custom">
                    <h4><i class="bi bi-cash-coin me-2"></i>Payment History</h4>
                </div>

                <div class="table-responsive">
                    <table class="table table-custom table-hover">
                        <thead>
                            <tr>
                                <th width="80">#</th>
                                <th width="120">Week</th>
                                <th>Amount</th>
                                <th>Payment Date</th>
                                <!-- <th width="140">Status</th> -->
                                <th width="180">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($contributions as $index => $contribution)
                                <tr>
                                    <td class="fw-semibold">{{ $index + 1 }}</td>
                                    <td>
                                        <span class="week-badge">
                                            <i class="bi bi-calendar-week"></i>
                                            Week {{ $contribution->week_number }}
                                        </span>
                                    </td>
                                    <td class="amount-cell">
                                        ${{ number_format($contribution->amount, 2) }}
                                    </td>
                                    <td class="date-cell">
                                        <i class="bi bi-calendar"></i>
                                        {{ \Carbon\Carbon::parse($contribution->contribution_date)->format('M d, Y') }}
                                    </td>
                                    {{-- 
                                    <td>
                                        @php
                                            $statusClass = 'status-completed';
                                            $statusText = 'Completed';
                                            $statusIcon = 'bi-check-circle';
                                            
                                            if($contribution->status == 'pending') {
                                                $statusClass = 'status-pending';
                                                $statusText = 'Pending';
                                                $statusIcon = 'bi-clock';
                                            } elseif($contribution->status == 'failed') {
                                                $statusClass = 'status-failed';
                                                $statusText = 'Failed';
                                                $statusIcon = 'bi-x-circle';
                                            }
                                        @endphp
                                        <span class="payment-status {{ $statusClass }}">
                                            <i class="bi {{ $statusIcon }} me-1"></i>
                                            {{ $statusText }}
                                        </span>
                                    </td>
                                    --}}
                                    <td>
                                        <div class="action-buttons">
                                            <button class="btn-action btn-view" 
                                                    onclick="viewPaymentDetails({{ $contribution->id }})"
                                                    title="View Details">
                                                <i class="bi bi-eye"></i>
                                                View
                                            </button>
                                            <!-- <button class="btn-action btn-download" 
                                                    onclick="downloadReceipt({{ $contribution->id }})"
                                                    title="Download Receipt">
                                                <i class="bi bi-download"></i>
                                                Receipt
                                            </button> -->
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">
                                        <div class="empty-state">
                                            <i class="bi bi-cash-coin"></i>
                                            <h4>No Payments Found</h4>
                                            <p>You haven't made any payments yet.</p>
                                            <button class="btn btn-primary mt-2">
                                                <i class="bi bi-plus-circle me-1"></i> Make First Payment
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Additional Payment Information -->
                @if($contributions->count() > 0)
                <div class="p-4 border-top">
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="mb-3">Payment Summary</h6>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Total Payments Made:</span>
                                <strong>{{ $contributions->count() }}</strong>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Total Amount Paid:</span>
                                <strong>${{ number_format($contributions->sum('amount'), 2) }}</strong>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span>Average Payment:</span>
                                <strong>${{ number_format($contributions->avg('amount'), 2) }}</strong>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h6 class="mb-3">Recent Activity</h6>
                            @if($contributions->count() > 0)
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Last Payment:</span>
                                    <strong>Week {{ $contributions->first()->week_number }}</strong>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Last Amount:</span>
                                    <strong>${{ number_format($contributions->first()->amount, 2) }}</strong>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span>Payment Frequency:</span>
                                    <strong>Weekly</strong>
                                </div>
                            @endif
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

<!-- Payment Details Modal -->
<div class="modal fade" id="paymentDetailsModal" tabindex="-1" aria-labelledby="paymentDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="paymentDetailsModalLabel">Payment Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="paymentDetailsContent">
                <!-- Payment details will be loaded here -->
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="downloadReceipt(currentPaymentId)">
                    <i class="bi bi-download me-1"></i> Download Receipt

                </button>
            </div>
        </div>
    </div>
</div>
@endsection
 
@section('script')
<script src="{{ asset('admin/app-assets/vendors/js/vendors.min.js')}}"></script>
<script src="{{ asset('admin/app-assets/vendors/js/extensions/toastr.min.js')}}"></script>
<script src="{{ asset('admin/app-assets/js/core/app-menu.js')}}"></script>
<script src="{{ asset('admin/app-assets/js/core/app.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>


<script>
let currentPaymentId = null;

document.addEventListener("DOMContentLoaded", function() {
    if (feather) feather.replace({ width: 14, height: 14 });
});

function viewPaymentDetails(paymentId) {
    currentPaymentId = paymentId;
    // Here you would typically make an AJAX call to get payment details
    // For now, we'll show a mockup
    const modalContent = `
    <ul class="nav navbar-nav flex-row">
            <li class="nav-item ms-3 me-auto">
                <a class="navbar-brand" href="{{ route('user.dashboard') }}">
                    <img src="{{ asset('admin/icons/png.jpeg') }}" width="95px" height="60px" alt="">
                </a>
               <hr> 
            </li>
            <li class="nav-item nav-toggle">
               <div class="text-center mb-4">
        <h4 class="fw-bold mb-1 text-primary">Ekero Partners</h4>
        <p class="text-muted fst-italic">Building Wealth Together</p>
        <hr>
    </div>
            </li>
        </ul>
    
        <div class="row">
         
            <div class="col-md-6">
                <h6>Payment Information</h6>
                <div class="mb-3">
                    <strong>Week Numbers:</strong> Week ${paymentId}
                </div>
                <div class="mb-3">
                    <strong>Amount:</strong> $${(paymentId * 10).toFixed(2)}
                </div>
                <div class="mb-3">
                    <strong>Payment Date:</strong> ${new Date().toLocaleDateString()}
                </div>
                <div class="mb-3">
                    <strong>Status:</strong> <span class="badge bg-success">Completed</span>
                </div>
            </div>
            <div class="col-md-6">
                <h6>Transaction Details</h6>
                <div class="mb-3">
                    <strong>Transaction ID:</strong> TXN${paymentId.toString().padStart(6, '0')}
                </div>
                <div class="mb-3">
                    <strong>Payment Method:</strong> Bank Transfer
                </div>
                <div class="mb-3">
                    <strong>Reference:</strong> WEEK${paymentId}_PAYMENT
                </div>
            </div>
        </div>
        <div class="mt-4 p-3 bg-light rounded">
            <h6>Group Information</h6>
            <div class="row">
                <div class="col-md-6">
                    <strong>Group:</strong> Investment Group #${paymentId}
                </div>
                <div class="col-md-6">
                    <strong>Weekly Commitment:</strong> $${(paymentId * 10).toFixed(2)}
                </div>
            </div>
        </div>
    `;
    
    document.getElementById('paymentDetailsContent').innerHTML = modalContent;
     feather.replace(); // render icons
    new bootstrap.Modal(document.getElementById('paymentDetailsModal')).show();
}

function downloadReceipt(paymentId) {
    // Simulate receipt download
    showToast('Receipt download started', 'success');
    const element = document.getElementById('paymentDetailsContent');

    // Options for PDF
    const opt = {
        margin:       0.5,
        filename:     `Payment_Receipt_${paymentId}.pdf`,
        image:        { type: 'jpeg', quality: 0.98 },
        html2canvas:  { scale: 2 },
        jsPDF:        { unit: 'in', format: 'letter', orientation: 'portrait' }
    };

    // Generate PDF
    html2pdf().set(opt).from(element).save();
    console.log('Downloading receipt for payment:', paymentId);
}

function showToast(message, type = 'success') {
    // Simple toast notification
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

// Add some interactive effects
document.addEventListener('DOMContentLoaded', function() {
    const tableRows = document.querySelectorAll('.table-custom tbody tr');
    tableRows.forEach((row, index) => {
        row.style.animationDelay = `${index * 0.05}s`;
    });
});
</script>
@endsection