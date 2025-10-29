@extends('admin.layouts.main')

@section('title', 'Dashboard')
<style>
    .group-details-card {
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        border: none;
        overflow: hidden;
        margin-bottom: 20px;
    }
    .card-header-custom {
        background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
        color: white;
        padding: 20px;
        border-bottom: none;
    }
    .info-box {
        background-color: #f8f9fa;
        border-radius: 8px;
        padding: 15px;
        margin-bottom: 15px;
        border-left: 4px solid #2575fc;
    }
    .info-box h6 {
        color: #495057;
        font-weight: 600;
        margin-bottom: 5px;
    }
    .info-box p {
        color: #6c757d;
        margin-bottom: 0;
        font-size: 0.95rem;
    }
    .progress-container {
        margin: 20px 0;
    }
    .progress {
        height: 10px;
        border-radius: 5px;
    }
    .stats-card {
        background: white;
        border-radius: 8px;
        padding: 15px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        text-align: center;
        height: 100%;
    }
    .stats-card .stats-value {
        font-size: 1.5rem;
        font-weight: 700;
        color: #2575fc;
        margin-bottom: 5px;
    }
    .stats-card .stats-label {
        font-size: 0.85rem;
        color: #6c757d;
    }
    .action-buttons {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }
    .invite-link-container {
        background-color: #e7f1ff;
        border-radius: 8px;
        padding: 15px;
        margin-top: 15px;
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
                            <h2 class="content-header-title float-start mb-0">Group Details</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">Groups</a>
                                    </li>
                                    <li class="breadcrumb-item active">Group Details</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Group Information Card -->
                <div class="card group-details-card">
                    <div class="card-header card-header-custom" style="margin-bottom:12px">
                        <h4 class="card-title text-white mb-0">{{ $group->name ?? 'Group Name' }}</h4>
                        <p class="text-white-50 mb-0">Group #{{ $group->group_number ?? 'N/A' }}</p>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <!-- Project Information -->
                                <div class="info-box">
                                    <h6>Project Information</h6>
                                    <p><strong>Name:</strong> {{ $group->project_name ?? 'N/A' }}</p>
                                    <p><strong>Description:</strong> {{ $group->project_description ?? 'N/A' }}</p>
                                </div>
                                
                                <!-- Financial Information -->
                                <div class="info-box">
                                    <h6>Financial Information</h6>
                                    <p><strong>Target Amount:</strong> ${{ number_format($group->target_amount ?? 0, 2) }}</p>
                                    <p><strong>Current Amount:</strong> ${{ number_format($group->current_amount ?? 0, 2) }}</p>
                                    
                                    <!-- Progress Bar -->
                                    <div class="progress-container">
                                        <div class="d-flex justify-content-between mb-1">
                                            <span>Progress</span>
                                            <span>{{ $group->target_amount > 0 ? round(($group->current_amount / $group->target_amount) * 100, 2) : 0 }}%</span>
                                        </div>
                                        <div class="progress">
                                            <div class="progress-bar bg-success" role="progressbar" 
                                                 style="width: {{ $group->target_amount > 0 ? ($group->current_amount / $group->target_amount) * 100 : 0 }}%" 
                                                 aria-valuenow="{{ $group->target_amount > 0 ? ($group->current_amount / $group->target_amount) * 100 : 0 }}" 
                                                 aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Portal Set Information -->
                                <div class="info-box">
                                    <h6>Portal Set Information</h6>
                                    <p><strong>Portal Set:</strong> {{ $portalSet->name ?? 'N/A' }}</p>
                                    <p><strong>Start Date:</strong> {{ $portalSet->start_date ?? 'N/A' }}</p>
                                    <p><strong>End Date:</strong> {{ $portalSet->end_date ?? 'N/A' }}</p>
                                    <p><strong>Total Cycles:</strong> {{ $portalSet->total_portals ?? 'N/A' }}</p>
                                </div>
                                
                                <!-- Status Information -->
                                <div class="info-box">
                                    <h6>Status</h6>
                                    <p>
                                        <strong>Group Status:</strong> 
                                        <span class="badge {{ $group->is_active ? 'bg-success' : 'bg-danger' }}">
                                            {{ $group->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </p>
                                    <p>
                                        <strong>Portal Set Status:</strong> 
                                        <span class="badge {{ $portalSet->is_active ?? false ? 'bg-success' : 'bg-danger' }}">
                                            {{ $portalSet->is_active ?? false ? 'Active' : 'Inactive' }}
                                        </span>
                                    </p>
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <!-- Quick Stats -->
                                <div class="row mb-3">
                                    <div class="col-6">
                                        <div class="stats-card">
                                            <div class="stats-value">{{ $portalSet->total_portals ?? 0 }}</div>
                                            <div class="stats-label">Total Cycles</div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="stats-card">
                                            <div class="stats-value">${{ number_format($group->target_amount ?? 0, 0) }}</div>
                                            <div class="stats-label">Target Amount</div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row mb-3">
                                    <div class="col-6">
                                        <div class="stats-card">
                                            <div class="stats-value">${{ number_format($group->current_amount ?? 0, 0) }}</div>
                                            <div class="stats-label">Current Amount</div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="stats-card">
                                            <div class="stats-value">{{ $group->members_count ?? 0 }}</div>
                                            <div class="stats-label">Members</div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Action Buttons -->
                                <div class="action-buttons mt-4">
                                    <a href="{{ route('groups.assign.member', $group->id) }}" class="btn btn-primary">
                                        <i class="bi bi-people-fill me-1"></i> Manage Members
                                    </a>
                                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#inviteModal">
                                        <i class="bi bi-send-plus me-1"></i> Invite Member
                                    </button>
                                </div>
                                
                                <!-- Quick Links -->
                                <div class="mt-4">
                                    <h6 class="mb-3">Quick Actions</h6>
                                    <div class="d-grid gap-2">
                                        <a href="#" class="btn btn-outline-primary">
                                            <i class="bi bi-graph-up me-1"></i> View Reports
                                        </a>
                                        <a href="#" class="btn btn-outline-secondary">
                                            <i class="bi bi-pencil-square me-1"></i> Edit Group
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Additional Information Section -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="card group-details-card">
                            <div class="card-header" style="background-color: #20c997; color: white;margin-bottom:12px">
                                <h5 class="card-title mb-0">Group Leader</h5>
                            </div>
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="avatar bg-light-primary rounded">
                                            <div class="avatar-content">
                                                <i class="bi bi-person-fill fs-4"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="mb-0">{{ $group->leader->name ?? 'Not Assigned' }}</h6>
                                        <small class="text-muted">Group Leader</small>
                                    </div>
                                </div>
                                @if($group->leader)
                                    <div class="mt-3">
                                        <p class="mb-1"><strong>Email:</strong> {{ $group->leader->email ?? 'N/A' }}</p>
                                        <p class="mb-0"><strong>Phone:</strong> {{ $group->leader->phone ?? 'N/A' }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="card group-details-card">
                            <div class="card-header" style="background-color: #fd7e14; color: white;">
                                <h5 class="card-title mb-0">Recent Activity</h5>
                            </div>
                            <div class="card-body">
                                <p class="text-muted mb-0">No recent activity to display.</p>
                                <!-- You can add actual activity logs here when available -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Invite Modal -->
    <div class="modal fade" id="inviteModal" tabindex="-1" aria-labelledby="inviteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content rounded-3">
                <div class="modal-header">
                    <h5 class="modal-title" id="inviteModalLabel">Invite Member to {{ $group->name ?? 'Group' }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Share this link to invite a new member to your group:</p>
                    <div class="invite-link-container">
                        <div class="input-group">
                            <input type="text" id="inviteLink" class="form-control" readonly 
                                   value="{{ route('user.register', $group->invite_link) }}">
                            <button class="btn btn-outline-primary" id="copyBtn">
                                <i class="bi bi-clipboard"></i> Copy
                            </button>
                        </div>
                        <small class="text-success mt-2 d-none" id="copiedMsg">Copied to clipboard!</small>
                    </div>
                    <div class="mt-3">
                        <p class="small text-muted mb-1">You can also share via:</p>
                        <div class="d-flex gap-2">
                            <button class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-whatsapp"></i> WhatsApp
                            </button>
                            <button class="btn btn-sm btn-outline-info">
                                <i class="bi bi-telegram"></i> Telegram
                            </button>
                            <button class="btn btn-sm btn-outline-secondary">
                                <i class="bi bi-envelope"></i> Email
                            </button>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
        
        // Copy invite link functionality
        document.getElementById('copyBtn').addEventListener('click', function() {
            const linkInput = document.getElementById('inviteLink');
            linkInput.select();
            linkInput.setSelectionRange(0, 99999); // for mobile
            navigator.clipboard.writeText(linkInput.value);
            
            const copiedMsg = document.getElementById('copiedMsg');
            copiedMsg.classList.remove('d-none');
            setTimeout(() => copiedMsg.classList.add('d-none'), 2000);
        });
    </script>
@endsection