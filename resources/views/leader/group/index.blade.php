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
    .groups-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(380px, 1fr));
        gap: 20px;
        padding: 25px;
    }
    .group-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        border: 1px solid #e8e8e8;
        transition: all 0.3s ease;
        overflow: hidden;
        position: relative;
    }
    .group-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    }
    .group-card-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 20px;
        position: relative;
    }
    .group-card-title {
        font-size: 1.2rem;
        font-weight: 700;
        margin-bottom: 5px;
        display: flex;
        align-items: center;
        justify-content: between;
    }
    .group-card-subtitle {
        font-size: 0.85rem;
        opacity: 0.9;
        margin-bottom: 0;
    }
    .group-number {
        background: rgba(255, 255, 255, 0.2);
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
    }
    .group-card-body {
        padding: 20px;
    }
    .group-info-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 8px 0;
        border-bottom: 1px solid #f1f3f4;
    }
    .group-info-item:last-child {
        border-bottom: none;
    }
    .info-label {
        font-weight: 600;
        color: #4a5568;
        font-size: 0.9rem;
    }
    .info-value {
        color: #2d3748;
        font-weight: 500;
    }
    .progress-container {
        margin: 15px 0;
    }
    .progress-info {
        display: flex;
        justify-content: space-between;
        margin-bottom: 8px;
    }
    .progress {
        height: 8px;
        border-radius: 4px;
        background: #e2e8f0;
        overflow: hidden;
    }
    .progress-bar {
        background: linear-gradient(135deg, #28c76f 0%, #48da89 100%);
        border-radius: 4px;
        transition: width 0.5s ease;
    }
    .group-card-footer {
        padding: 15px 20px;
        background: #f8f9fa;
        border-top: 1px solid #e8e8e8;
        display: flex;
        gap: 10px;
        justify-content: space-between;
    }
    .btn-action {
        padding: 8px 16px;
        border-radius: 8px;
        font-size: 0.85rem;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 6px;
        transition: all 0.3s ease;
        text-decoration: none;
        border: none;
    }
    .btn-edit {
        background: rgba(102, 126, 234, 0.1);
        color: #667eea;
        border: 1px solid rgba(102, 126, 234, 0.2);
    }
    .btn-edit:hover {
        background: #667eea;
        color: white;
        transform: translateY(-2px);
    }
    .btn-invite {
        background: rgba(40, 199, 111, 0.1);
        color: #28c76f;
        border: 1px solid rgba(40, 199, 111, 0.2);
    }
    .btn-invite:hover {
        background: #28c76f;
        color: white;
        transform: translateY(-2px);
    }
    .btn-view {
        background: rgba(255, 159, 67, 0.1);
        color: #ff9f43;
        border: 1px solid rgba(255, 159, 67, 0.2);
    }
    .btn-view:hover {
        background: #ff9f43;
        color: white;
        transform: translateY(-2px);
    }
    .status-badge {
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
    }
    .status-active {
        background: rgba(40, 199, 111, 0.1);
        color: #28c76f;
    }
    .status-inactive {
        background: rgba(108, 117, 125, 0.1);
        color: #6c757d;
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
    .invite-link-container {
        background: #f7fafc;
        border-radius: 8px;
        padding: 15px;
        margin-top: 15px;
        border: 1px solid #e2e8f0;
    }
    @media (max-width: 768px) {
        .groups-grid {
            grid-template-columns: 1fr;
            padding: 15px;
        }
        .stats-summary {
            flex-direction: column;
        }
        .stat-card {
            min-width: 100%;
        }
        .group-card-footer {
            flex-direction: column;
        }
        .btn-action {
            justify-content: center;
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
                <!-- Stats Summary -->
                <div class="stats-summary">
                    <div class="stat-card">
                        <div class="stat-value">{{ $groups->total() }}</div>
                        <div class="stat-label">Total Groups</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-value">{{ $groups->where('is_active', true)->count() }}</div>
                        <div class="stat-label">Active Groups</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-value">${{ number_format($groups->sum('target_amount'), 2) }}</div>
                        <div class="stat-label">Total Target</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-value">${{ number_format($groups->sum('current_amount'), 2) }}</div>
                        <div class="stat-label">Total Collected</div>
                    </div>
                </div>

                <!-- Groups Grid -->
                <div class="groups-container">
                    <div class="table-header-custom">
                        <h4><i class="bi bi-people-fill me-2"></i>Managed Groups</h4>
                    </div>

                    @if($groups->count() > 0)
                        <div class="groups-grid">
                            @foreach ($groups as $group)
                                <div class="group-card">
                                    <div class="group-card-header">
                                        <div class="group-card-title">
                                            <span>{{ $group->name ?? 'Unnamed Group' }}</span>
                                            <span class="group-number">#{{ $group->group_number }}</span>
                                        </div>
                                        @if($group->project_name)
                                            <p class="group-card-subtitle">{{ $group->project_name }}</p>
                                        @endif
                                    </div>
                                    
                                    <div class="group-card-body">
                                        <!-- Progress Section -->
                                        <div class="progress-container">
                                            <div class="progress-info">
                                                <span class="info-label">Progress</span>
                                                <span class="info-value">
                                                    @if($group->target_amount > 0)
                                                        {{ number_format(($group->current_amount / $group->target_amount) * 100, 1) }}%
                                                    @else
                                                        0%
                                                    @endif
                                                </span>
                                            </div>
                                            <div class="progress">
                                                <div class="progress-bar" style="width: {{ $group->target_amount > 0 ? ($group->current_amount / $group->target_amount) * 100 : 0 }}%"></div>
                                            </div>
                                            <div class="progress-info mt-2">
                                                <small class="text-muted">
                                                    ${{ number_format($group->current_amount, 2) }} of ${{ number_format($group->target_amount, 2) }}
                                                </small>
                                            </div>
                                        </div>

                                        <!-- Group Information -->
                                        <div class="group-info-list">
                                            <div class="group-info-item">
                                                <span class="info-label">Leader</span>
                                                <span class="info-value">{{ $group->leader->name ?? 'Not Assigned' }}</span>
                                            </div>
                                            <div class="group-info-item">
                                                <span class="info-label">Target Amount</span>
                                                <span class="info-value">${{ number_format($group->target_amount, 2) }}</span>
                                            </div>
                                            <div class="group-info-item">
                                                <span class="info-label">Status</span>
                                                <span class="status-badge {{ $group->is_active ? 'status-active' : 'status-inactive' }}">
                                                    {{ $group->is_active ? 'Active' : 'Inactive' }}
                                                </span>
                                            </div>
                                            <div class="group-info-item">
                                                <span class="info-label">Duration</span>
                                                <span class="info-value">
                                                    {{ date('M d, Y', strtotime($group->start_date)) }} - 
                                                    {{ date('M d, Y', strtotime($group->end_date)) }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="group-card-footer">
                                        <a href="{{ route('leader.groups.member', $group->id) }}" 
                                           class="btn-action btn-view">
                                            <i data-feather="users"></i> Members
                                        </a>
                                        <a href="{{ route('leader.groups.edit', $group->id) }}" 
                                           class="btn-action btn-edit">
                                            <i data-feather="edit"></i> Edit
                                        </a>
                                        <button class="btn-action btn-invite" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#inviteModal{{ $group->id }}">
                                            <i data-feather="user-plus"></i> Invite
                                        </button>
                                    </div>
                                </div>

                                <!-- Invite Modal for each group -->
                                <div class="modal fade" id="inviteModal{{ $group->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Invite Member to {{ $group->name }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Share this invitation link with new members to join your group:</p>
                                                <div class="invite-link-container">
                                                    <div class="input-group">
                                                        <input type="text" id="inviteLink{{ $group->id }}" 
                                                               class="form-control" readonly 
                                                               value="{{ route('user.register', $group->invite_link) }}">
                                                        <button class="btn btn-outline-primary copy-btn" 
                                                                data-target="inviteLink{{ $group->id }}">
                                                            <i data-feather="copy"></i> Copy
                                                        </button>
                                                    </div>
                                                    <small class="text-success mt-2 d-none copied-msg">Copied to clipboard!</small>
                                                </div>
                                                <div class="mt-3">
                                                    <p class="small text-muted mb-2">You can also share via:</p>
                                                    <div class="d-flex gap-2">
                                                        <button class="btn btn-sm btn-outline-success share-btn" 
                                                                data-link="{{ route('user.register', $group->invite_link) }}" 
                                                                data-platform="whatsapp">
                                                            <i data-feather="message-circle"></i> WhatsApp
                                                        </button>
                                                        <button class="btn btn-sm btn-outline-primary share-btn" 
                                                                data-link="{{ route('user.register', $group->invite_link) }}" 
                                                                data-platform="email">
                                                            <i data-feather="mail"></i> Email
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
                            @endforeach
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
                    @else
                        <div class="empty-state">
                            <i data-feather="users"></i>
                            <h4>No Groups Found</h4>
                            <p>You are not currently managing any groups.</p>
                            <a href="#" class="btn btn-primary mt-2">
                                <i data-feather="plus" class="me-1"></i> Create Your First Group
                            </a>
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

        // Copy invite link functionality
        document.addEventListener('DOMContentLoaded', function() {
            // Copy buttons
            document.querySelectorAll('.copy-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const targetId = this.getAttribute('data-target');
                    const linkInput = document.getElementById(targetId);
                    linkInput.select();
                    linkInput.setSelectionRange(0, 99999);
                    navigator.clipboard.writeText(linkInput.value);
                    
                    const copiedMsg = this.parentElement.parentElement.querySelector('.copied-msg');
                    copiedMsg.classList.remove('d-none');
                    setTimeout(() => copiedMsg.classList.add('d-none'), 2000);
                });
            });

            // Share buttons
            document.querySelectorAll('.share-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const link = this.getAttribute('data-link');
                    const platform = this.getAttribute('data-platform');
                    
                    let shareUrl = '';
                    switch(platform) {
                        case 'whatsapp':
                            shareUrl = `https://wa.me/?text=Join my investment group: ${encodeURIComponent(link)}`;
                            break;
                        case 'email':
                            shareUrl = `mailto:?subject=Join My Investment Group&body=Hello! I'd like to invite you to join my investment group. Click here to register: ${encodeURIComponent(link)}`;
                            break;
                    }
                    
                    if (shareUrl) {
                        window.open(shareUrl, '_blank');
                    }
                });
            });

            // Add animation to cards
            const cards = document.querySelectorAll('.group-card');
            cards.forEach((card, index) => {
                card.style.animationDelay = `${index * 0.1}s`;
            });
        });
    </script>
@endsection