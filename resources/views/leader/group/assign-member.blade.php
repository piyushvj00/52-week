@extends('leader.layouts.main')
@section('title', 'Dashboard')
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
        grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
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
    .member-card-footer {
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
    .btn-remove {
        background: rgba(234, 84, 85, 0.1);
        color: #ea5455;
        border: 1px solid rgba(234, 84, 85, 0.2);
    }
    .btn-remove:hover {
        background: #ea5455;
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
        .member-card-footer {
            flex-direction: column;
        }
        .btn-action {
            justify-content: center;
        }
    }
</style>
@section('content')
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        
        <!-- Header Section -->
        <div class="content-header row">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <h2 class="content-header-title float-start mb-0">{{ $group->name }} Members</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('leader.dashboard') }}">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('leader.group') }}">Groups</a></li>
                                <li class="breadcrumb-item active">Members</li>
                            </ol>
                        </div>
                    </div>
                    <a href="{{ route('leader.group') }}" class="btn btn-outline-primary">
                        <i data-feather="arrow-left" class="me-1"></i> Back to Groups
                    </a>
                </div>
            </div>
        </div>

        <div class="content-body">
            <!-- Statistics Summary -->
            <div class="stats-summary">
                <div class="stat-card">
                    <div class="stat-value">{{ $groupMember->total() }}</div>
                    <div class="stat-label">Total Members</div>
                </div>
                <div class="stat-card">
                    <div class="stat-value">${{ number_format($groupMember->sum('weekly_commitment'), 2) }}</div>
                    <div class="stat-label">Weekly Commitment</div>
                </div>
                <div class="stat-card">
                    <div class="stat-value">${{ number_format($groupMember->sum('total_contributed'), 2) }}</div>
                    <div class="stat-label">Total Contributed</div>
                </div>
                <div class="stat-card">
                    <div class="stat-value">{{ $groupMember->where('is_active', true)->count() }}</div>
                    <div class="stat-label">Active Members</div>
                </div>
            </div>

            <!-- Members Grid -->
            <div class="members-container">
                <div class="table-header-custom">
                    <h4><i class="bi bi-people-fill me-2"></i>Group Members Overview</h4>
                </div>

                @if($groupMember->count() > 0)
                    <div class="members-grid">
                        @foreach ($groupMember as $member)
                            <div class="member-card">
                                <div class="member-card-header">
                                    <div class="member-avatar">
                                        {{ substr($member->member->name ?? 'U', 0, 1) }}
                                    </div>
                                    <div class="member-name">{{ $member->member->name ?? 'Unknown Member' }}</div>
                                    <span class="member-role">Member</span>
                                    <span class="member-status {{ $member->is_active ? 'status-active' : 'status-inactive' }}">
                                        {{ $member->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </div>
                                
                                <div class="member-card-body">
                                    <!-- Member Information -->
                                    <div class="member-info-list">
                                        <div class="member-info-item">
                                            <div class="info-icon">
                                                <i data-feather="phone"></i>
                                            </div>
                                            <div class="info-content">
                                                <span class="info-label">Phone</span>
                                                <span class="info-value">{{ $member->member->phone ?? 'N/A' }}</span>
                                            </div>
                                        </div>
                                        <div class="member-info-item">
                                            <div class="info-icon">
                                                <i data-feather="mail"></i>
                                            </div>
                                            <div class="info-content">
                                                <span class="info-label">Email</span>
                                                <span class="info-value">{{ $member->member->email ?? 'N/A' }}</span>
                                            </div>
                                        </div>
                                        <div class="member-info-item">
                                            <div class="info-icon">
                                                <i data-feather="dollar-sign"></i>
                                            </div>
                                            <div class="info-content">
                                                <span class="info-label">Weekly Commitment</span>
                                                <span class="info-value">${{ number_format($member->weekly_commitment, 2) }}</span>
                                            </div>
                                        </div>
                                        <div class="member-info-item">
                                            <div class="info-icon">
                                                <i data-feather="target"></i>
                                            </div>
                                            <div class="info-content">
                                                <span class="info-label">Total Contributed</span>
                                                <span class="info-value">${{ number_format($member->total_contributed, 2) }}</span>
                                            </div>
                                        </div>
                                        <div class="member-info-item">
                                            <div class="info-icon">
                                                <i data-feather="pie-chart"></i>
                                            </div>
                                            <div class="info-content">
                                                <span class="info-label">Group Share</span>
                                                <span class="info-value">${{ number_format($member->group_sare, 2) }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Contribution Progress -->
                                    @if($member->weekly_commitment > 0)
                                    <div class="contribution-progress">
                                        <div class="progress-info">
                                            <span class="info-label">Contribution Progress</span>
                                            <span class="info-value">
                                                {{ number_format(($member->total_contributed / $member->weekly_commitment) * 100, 1) }}%
                                            </span>
                                        </div>
                                        <div class="progress">
                                            <div class="progress-bar" style="width: {{ ($member->total_contributed / $member->weekly_commitment) * 100 }}%"></div>
                                        </div>
                                        <div class="progress-info mt-2">
                                            <small class="text-muted">
                                                ${{ number_format($member->total_contributed, 2) }} of ${{ number_format($member->weekly_commitment, 2) }}
                                            </small>
                                        </div>
                                    </div>
                                    @endif
                                </div>

                                <div class="member-card-footer">
                                    <a href="{{ route('leader.member.details', $member->user_id) }}" 
                                       class="btn-action btn-view">
                                        <i data-feather="eye"></i> View Details
                                    </a>
                                    <form action="{{ route('portal.members.remove', [$member->user_id, $member->group_id]) }}" 
                                          method="POST" 
                                          onsubmit="return confirm('Are you sure you want to remove {{ $member->member->name }} from this group?');"
                                          class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-action btn-remove">
                                            <i data-feather="trash-2"></i> Remove
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    @if($groupMember->hasPages())
                        <div class="pagination-container p-4 border-top">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="text-muted">
                                    Showing {{ $groupMember->firstItem() }} to {{ $groupMember->lastItem() }} of {{ $groupMember->total() }} members
                                </div>
                                <div>
                                    {{ $groupMember->links() }}
                                </div>
                            </div>
                        </div>
                    @endif
                @else
                    <div class="empty-state">
                        <i data-feather="users"></i>
                        <h4>No Members Found</h4>
                        <p>There are no members in this group yet.</p>
                        <button class="btn btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#inviteModal">
                            <i data-feather="user-plus" class="me-1"></i> Invite Members
                        </button>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="sidenav-overlay"></div>
<div class="drag-target"></div>

<!-- Invite Modal -->
<div class="modal fade" id="inviteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Invite Members to {{ $group->name }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Share the invitation link with potential members:</p>
                <div class="invite-link-container">
                    <div class="input-group">
                        <input type="text" id="inviteLink" class="form-control" readonly 
                               value="{{ route('user.register', $group->invite_link) }}">
                        <button class="btn btn-outline-primary" id="copyBtn">
                            <i data-feather="copy"></i> Copy
                        </button>
                    </div>
                    <small class="text-success mt-2 d-none" id="copiedMsg">Copied to clipboard!</small>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
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
            feather.replace({ width: 14, height: 14 });
        }
    });

    // Copy invite link functionality
    document.addEventListener('DOMContentLoaded', function() {
        const copyBtn = document.getElementById('copyBtn');
        if (copyBtn) {
            copyBtn.addEventListener('click', function() {
                const linkInput = document.getElementById('inviteLink');
                linkInput.select();
                linkInput.setSelectionRange(0, 99999);
                navigator.clipboard.writeText(linkInput.value);
                
                const copiedMsg = document.getElementById('copiedMsg');
                copiedMsg.classList.remove('d-none');
                setTimeout(() => copiedMsg.classList.add('d-none'), 2000);
            });
        }

        // Add animation to cards
        const cards = document.querySelectorAll('.member-card');
        cards.forEach((card, index) => {
            card.style.animationDelay = `${index * 0.1}s`;
        });
    });
</script>
@endsection