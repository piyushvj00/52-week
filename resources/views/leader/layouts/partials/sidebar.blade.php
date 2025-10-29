<style>
    

.main-menu .navbar-header .navbar-brand {
    display: flex
;
    align-items: center;
    margin-top: 0rem !important;
    font-size: inherit;
}

.nav-item a {
    padding: 12px 20px;
    border-radius: 8px;
    margin: 0 !important;
    transition: all 0.3s 
ease;
    position: relative;
    overflow: hidden;
}
</style>
<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item  me-auto">
                <a class="navbar-brand" href="{{ route('leader.dashboard') }}">
                    <div class="brand-logo">
                        <img src="{{ asset('admin/icons/png.jpeg') }}"  alt="Ekero Partners" class="brand-image">
                        <span class="brand-text">Leader Portal</span>
                    </div>
                </a>
            </li>
            <li class="nav-item nav-toggle">
                <a class="nav-link modern-nav-toggle pe-0" data-bs-toggle="collapse">
                    <i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i>
                    <i class="d-none d-xl-block collapse-toggle-icon font-medium-4 text-primary" data-feather="disc"></i>
                </a>
            </li>
        </ul>
    </div>

    <div class="shadow-bottom"></div>

    <div class="main-menu-content mt-2">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <!-- Dashboard -->
            <li class="nav-item">
                <a class="d-flex align-items-center {{ request()->routeIs('leader.dashboard') ? 'active' : '' }}"
                   href="{{ route('leader.dashboard') }}">
                    <div class="menu-icon-wrapper">
                        <i data-feather="home" class="menu-icon ms-1"></i>
                    </div>
                    <span class="menu-title text-truncate">Dashboard</span>
                    <span class="menu-badge badge bg-light-primary">Home</span>
                </a>
            </li>

            <!-- Modules Header -->
            <li class="navigation-header">
                <span class="navigation-header-text">Management</span>
                <i data-feather="more-horizontal" class="navigation-header-icon"></i>
            </li>

            <!-- Group Management -->
            <li class="nav-item">
                <a class="d-flex align-items-center {{ request()->routeIs('leader.group.*') ? 'active' : '' }}"
                   href="{{ route('leader.group') }}">
                    <div class="menu-icon-wrapper">
                        <i data-feather="users" class="menu-icon ms-1"></i>
                    </div>
                    <span class="menu-title text-truncate">My Group</span>
                    <span class="menu-badge badge bg-light-success">Team</span>
                </a>
            </li>

            <!-- Contribution Management -->
            <li class="nav-item">
                <a class="d-flex align-items-center {{ request()->routeIs('leader.contribution.*') ? 'active' : '' }}"
                   href="{{ route('leader.contribution') }}">
                    <div class="menu-icon-wrapper">
                        <i data-feather="dollar-sign" class="menu-icon ms-1"></i>
                    </div>
                    <span class="menu-title text-truncate">Contributions</span>
                    <span class="menu-badge badge bg-light-warning">Payments</span>
                </a>
            </li>

            <!-- Quick Stats Section -->
            <li class="navigation-header mt-4">
                <span class="navigation-header-text">Group Stats</span>
                <i data-feather="bar-chart-2" class="navigation-header-icon"></i>
            </li>

            <li class="nav-item quick-stats">
                <div class="quick-stats-container">
                    <div class="stat-item">
                        <div class="stat-icon bg-primary">
                            <i data-feather="users"></i>
                        </div>
                        <div class="stat-info">
                            <span class="stat-number">{{ \App\Models\GroupMember::where('group_id', auth()->user()->group_id ?? 0)->count() }}</span>
                            <span class="stat-label">Members</span>
                        </div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-icon bg-success">
                            <i data-feather="dollar-sign"></i>
                        </div>
                        <div class="stat-info">
                            <span class="stat-number">${{ number_format(\App\Models\Contribution::where('group_id', auth()->user()->group_id ?? 0)->sum('amount'), 0) }}</span>
                            <span class="stat-label">Collected</span>
                        </div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-icon bg-info">
                            <i data-feather="target"></i>
                        </div>
                        <div class="stat-info">
                            <span class="stat-number">{{ \App\Models\Contribution::where('group_id', auth()->user()->group_id ?? 0)->where('status', 'completed')->count() }}</span>
                            <span class="stat-label">Contributions</span>
                        </div>
                    </div>
                </div>
            </li>

            <!-- Support Section -->
            <li class="navigation-header mt-4">
                <span class="navigation-header-text">Support</span>
                <i data-feather="help-circle" class="navigation-header-icon"></i>
            </li>

            <li class="nav-item">
                <a class="d-flex align-items-center" href="#" data-bs-toggle="modal" data-bs-target="#helpModal">
                    <div class="menu-icon-wrapper">
                        <i data-feather="help-circle" class="menu-icon "></i>
                    </div>
                    <span class="menu-title text-truncate">Help & Support</span>
                </a>
            </li>
        </ul>
    </div>
</div>

<!-- Help Modal -->
<div class="modal fade" id="helpModal" tabindex="-1" aria-labelledby="helpModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="helpModalLabel">Help & Support</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="support-info">
                    <div class="support-item">
                        <i data-feather="mail" class="support-icon"></i>
                        <div>
                            <strong>Email Support</strong>
                            <p>support@ekeropartners.com</p>
                        </div>
                    </div>
                    <div class="support-item">
                        <i data-feather="phone" class="support-icon"></i>
                        <div>
                            <strong>Phone Support</strong>
                            <p>+1 (555) 123-4567</p>
                        </div>
                    </div>
                    <div class="support-item">
                        <i data-feather="clock" class="support-icon"></i>
                        <div>
                            <strong>Support Hours</strong>
                            <p>Mon - Fri: 9:00 AM - 6:00 PM</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <a href="mailto:support@ekeropartners.com" class="btn btn-primary">Contact Support</a>
            </div>
        </div>
    </div>
</div>

<style>
    .brand-logo {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 10px 0;
    }

    .brand-text {
        font-size: 1.1rem;
        font-weight: 700;
        color: #7367f0;
        white-space: nowrap;
    }

    .brand-image {
        border-radius: 8px;
        transition: transform 0.3s ease;
    }

    .brand-image:hover {
        transform: scale(1.05);
    }

    .menu-icon-wrapper {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        background: rgba(115, 103, 240, 0.1);
        margin-right: 12px;
        transition: all 0.3s ease;
    }

    .nav-item.active .menu-icon-wrapper {
        background: linear-gradient(135deg, #7367f0 0%, #9e95f5 100%);
    }

    .menu-icon {
        width: 18px;
        height: 18px;
        color: #6e6b7b;
    }

    .nav-item.active .menu-icon {
        color: white;
    }

    .menu-title {
        font-weight: 500;
        font-size: 0.95rem;
        flex: 1;
    }

    .menu-badge {
        font-size: 0.7rem;
        padding: 4px 8px;
        margin-left: 8px;
    }

    .navigation-header {
        padding: 20px 20px 8px 20px;
        border-bottom: 1px solid #e8e8e8;
        margin-bottom: 8px;
    }

    .navigation-header-text {
        font-size: 0.8rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #b9b9c3;
    }

    .navigation-header-icon {
        width: 14px;
        height: 14px;
        color: #b9b9c3;
    }

    .quick-stats {
        padding: 15px 20px;
    }

    .quick-stats-container {
        background: linear-gradient(135deg, #f8f8f8 0%, #f0f0f0 100%);
        border-radius: 12px;
        padding: 15px;
    }

    .stat-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 8px 0;
    }

    .stat-item:not(:last-child) {
        border-bottom: 1px solid #e8e8e8;
    }

    .stat-icon {
        width: 36px;
        height: 36px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
    }

    .stat-info {
        flex: 1;
    }

    .stat-number {
        display: block;
        font-size: 1.1rem;
        font-weight: 700;
        color: #5e5873;
        line-height: 1;
    }

    .stat-label {
        font-size: 0.75rem;
        color: #b9b9c3;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .nav-item {
        margin-bottom: 4px;
    }

    .nav-item a {
        padding: 12px 20px;
        border-radius: 8px;
        margin: 0 8px;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .nav-item a::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        height: 100%;
        width: 3px;
        background: linear-gradient(135deg, #7367f0 0%, #9e95f5 100%);
        transform: scaleY(0);
        transition: transform 0.3s ease;
    }

    .nav-item.active a::before {
        transform: scaleY(1);
    }

    .nav-item a:hover {
        background: rgba(115, 103, 240, 0.08);
    }

    .nav-item.active a {
        background: rgba(115, 103, 240, 0.12);
        color: #7367f0;
    }

    /* Support Modal Styles */
    .support-info {
        padding: 10px 0;
    }

    .support-item {
        display: flex;
        align-items: center;
        gap: 15px;
        padding: 15px 0;
        border-bottom: 1px solid #f1f3f4;
    }

    .support-item:last-child {
        border-bottom: none;
    }

    .support-icon {
        width: 40px;
        height: 40px;
        border-radius: 8px;
        background: rgba(115, 103, 240, 0.1);
        color: #7367f0;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    /* Scrollbar Styling */
    .main-menu-content::-webkit-scrollbar {
        width: 4px;
    }

    .main-menu-content::-webkit-scrollbar-track {
        background: #f1f1f1;
    }

    .main-menu-content::-webkit-scrollbar-thumb {
        background: #c1c1c1;
        border-radius: 10px;
    }

    .main-menu-content::-webkit-scrollbar-thumb:hover {
        background: #a8a8a8;
    }

    /* Animation for menu items */
    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateX(-10px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    .navigation-main .nav-item {
        animation: slideIn 0.3s ease forwards;
    }

    .navigation-main .nav-item:nth-child(1) { animation-delay: 0.1s; }
    .navigation-main .nav-item:nth-child(2) { animation-delay: 0.2s; }
    .navigation-main .nav-item:nth-child(3) { animation-delay: 0.3s; }
    .navigation-main .nav-item:nth-child(4) { animation-delay: 0.4s; }
    .navigation-main .nav-item:nth-child(5) { animation-delay: 0.5s; }
    .navigation-main .nav-item:nth-child(6) { animation-delay: 0.6s; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize Feather Icons
    if (typeof feather !== 'undefined') {
        feather.replace();
    }

    // Add click animation to menu items
    const menuItems = document.querySelectorAll('.nav-item a');
    menuItems.forEach(item => {
        item.addEventListener('click', function() {
            // Add ripple effect
            const ripple = document.createElement('span');
            const rect = this.getBoundingClientRect();
            const size = Math.max(rect.width, rect.height);
            const x = event.clientX - rect.left - size / 2;
            const y = event.clientY - rect.top - size / 2;
            
            ripple.style.cssText = `
                position: absolute;
                border-radius: 50%;
                background: rgba(115, 103, 240, 0.3);
                transform: scale(0);
                animation: ripple 0.6s linear;
                width: ${size}px;
                height: ${size}px;
                left: ${x}px;
                top: ${y}px;
            `;
            
            this.appendChild(ripple);
            
            setTimeout(() => {
                ripple.remove();
            }, 600);
        });
    });

    // Add keyboard navigation
    document.addEventListener('keydown', function(event) {
        if (event.altKey) {
            switch(event.key) {
                case '1':
                    window.location.href = "{{ route('leader.dashboard') }}";
                    break;
                case '2':
                    window.location.href = "{{ route('leader.group') }}";
                    break;
                case '3':
                    window.location.href = "{{ route('leader.contribution') }}";
                    break;
            }
        }
    });
});

// Add CSS for ripple animation
const style = document.createElement('style');
style.textContent = `
    @keyframes ripple {
        to {
            transform: scale(4);
            opacity: 0;
        }
    }
`;
document.head.appendChild(style);
</script>   