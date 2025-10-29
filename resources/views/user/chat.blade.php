@extends('user.layouts.main')

@section('title', 'Dashboard')

@section('content')
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row"></div>
        <div class="content-body">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-10 col-xl-11">
                        <div class="card chat-card">
                            <div class="card-header chat-header bg-primary text-white">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar bg-light-primary me-2">
                                            <div class="avatar-content">
                                                <i class="fas fa-users fa-lg"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <h4 class="mb-0">{{ $group->name }}</h4>
                                            <small class="text-white-50">
                                                <i class="fas fa-circle text-success me-1" style="font-size: 8px;"></i>
                                                Online
                                            </small>
                                        </div>
                                    </div>
                                    <div class="dropdown">
                                        <!-- <button class="btn btn-sm btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button> -->
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="#"><i class="fas fa-info-circle me-1"></i> Group Info</a></li>
                                            <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-1"></i> Settings</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="card-body chat-body p-0">
                                <div id="chat-box" class="chat-messages">
                                    <!-- Messages will appear here -->
                                    <div class="text-center empty-chat py-5">
                                        <div class="empty-chat-icon mb-3">
                                            <i class="fas fa-comments fa-3x text-muted"></i>
                                        </div>
                                        <p class="text-muted">No messages yet. Start the conversation!</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="card-footer chat-footer bg-white border-top">
                                <form id="chat-form" class="d-flex align-items-center">
                                    @csrf
                                    <div class="flex-grow-1 me-2">
                                        <input type="text" name="message" id="message" class="form-control chat-input" placeholder="Type your message...">
                                    </div>
                                    <button type="submit" class="btn btn-success send-btn">
                                        <img src="{{ asset('images/send-mail.png') }}" width="20px" alt="">
                                    </button>
                                </form>
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

<style>
    .chat-card {
        border: none;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        border-radius: 12px;
        overflow: hidden;
    }

    .chat-header {
        border-bottom: none;
        padding: 1rem 1.5rem;
        background: linear-gradient(135deg, #7367f0 0%, #5e50ee 100%);
    }

    .chat-header .avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .chat-body {
        height: 260px;
        background-color: #f8f9fa;
    }

    .chat-messages {
        height: 100%;
        overflow-y: auto;
        padding: 1rem;
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
    }

    .message {
        max-width: 70%;
        padding: 0.75rem 1rem;
        border-radius: 18px;
        position: relative;
        word-wrap: break-word;
        animation: fadeIn 0.3s ease;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .message-incoming {
        align-self: flex-start;
        background: white;
        border-bottom-left-radius: 5px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08);
        border: 1px solid #eaeaea;
    }

    .message-outgoing {
        align-self: flex-end;
        background: linear-gradient(135deg, #7367f0 0%, #5e50ee 100%);
        color: white;
        border-bottom-right-radius: 5px;
        box-shadow: 0 2px 8px rgba(115, 103, 240, 0.3);
    }

    .message-sender {
        font-weight: 600;
        font-size: 0.85rem;
        margin-bottom: 0.25rem;
    }

    .message-incoming .message-sender {
        color: #7367f0;
    }

    .message-outgoing .message-sender {
        color: rgba(255, 255, 255, 0.9);
    }

    .message-content {
        line-height: 1.4;
        margin-bottom: 0.25rem;
    }

    .message-time {
        font-size: 0.75rem;
        opacity: 0.7;
        text-align: right;
    }

    .message-outgoing .message-time {
        color: rgba(255, 255, 255, 0.8);
    }

    .message-incoming .message-time {
        color: #6c757d;
    }

    .chat-footer {
        padding: 1rem 1.5rem;
        border-top: 1px solid #eaeaea;
    }

    .chat-input {
        border-radius: 25px;
        padding: 0.75rem 1.25rem;
        border: 1px solid #ddd;
        transition: all 0.3s;
    }

    .chat-input:focus {
        border-color: #7367f0;
        box-shadow: 0 0 0 0.2rem rgba(115, 103, 240, 0.25);
    }

    .send-btn {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s;
    }

    .send-btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(115, 103, 240, 0.3);
    }

    .empty-chat {
        color: #6c757d;
    }

    .empty-chat-icon {
        opacity: 0.5;
    }

    /* Scrollbar Styling */
    .chat-messages::-webkit-scrollbar {
        width: 6px;
    }

    .chat-messages::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }

    .chat-messages::-webkit-scrollbar-thumb {
        background: #c5c5c5;
        border-radius: 10px;
    }

    .chat-messages::-webkit-scrollbar-thumb:hover {
        background: #a8a8a8;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .chat-body {
            height: 350px;
        }
        
        .message {
            max-width: 85%;
        }
        
        .chat-header, .chat-footer {
            padding: 1rem;
        }
    }

    @media (max-width: 576px) {
        .chat-body {
            height: 300px;
        }
        
        .message {
            max-width: 90%;
        }
    }
</style>
@endsection

@section('script')
<script src="{{ asset('admin/app-assets/vendors/js/vendors.min.js')}}"></script>
<script src="{{ asset('admin/app-assets/vendors/js/extensions/toastr.min.js')}}"></script>
<script src="{{ asset('admin/app-assets/js/core/app-menu.js')}}"></script>
<script src="{{ asset('admin/app-assets/js/core/app.js')}}"></script>

{{-- Remove dashboard-ecommerce.js if it conflicts --}}
{{-- <script src="{{ asset('admin/app-assets/js/scripts/pages/dashboard-ecommerce.js')}}"></script> --}}

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    $(window).on('load', function () {
        if (feather) {
            feather.replace({
                width: 14,
                height: 14
            });
        }
    });

    function fetchMessages() {
        $.get('{{ route("groups.chat.messages", $group->id) }}', function(data) {
            let html = '';
            console.log(data);

            if (Object.keys(data).length === 0) {
                html = `
                    <div class="text-center empty-chat py-5">
                        <div class="empty-chat-icon mb-3">
                            <i class="fas fa-comments fa-3x text-muted"></i>
                        </div>
                        <p class="text-muted">No messages yet. Start the conversation!</p>
                    </div>
                `;
            } else {
                // Convert object-with-numeric-keys into array
                Object.values(data).forEach(function(chat) {
                    let userName = chat.user ? chat.user.name : 'Unknown';
                    let isCurrentUser = chat.user_id === {{ Auth::id() }}; // Assuming you have auth
                    let messageClass = isCurrentUser ? 'message-outgoing' : 'message-incoming';
                    let displayName = isCurrentUser ? 'You' : userName;
                    
                    html += `
                        <div class="message ${messageClass}">
                            <div class="message-sender">${displayName}</div>
                            <div class="message-content">${chat.message}</div>
                            <div class="message-time">${formatTime(chat.created_at)}</div>
                        </div>
                    `;
                });
            }

            $('#chat-box').html(html);
            $('#chat-box').scrollTop($('#chat-box')[0].scrollHeight);
        });
    }

    function formatTime(dateString) {
        const date = new Date(dateString);
        const now = new Date();
        const diffMs = now - date;
        const diffMins = Math.floor(diffMs / 60000);
        const diffHours = Math.floor(diffMs / 3600000);
        
        if (diffMins < 1) return 'Just now';
        if (diffMins < 60) return `${diffMins}m ago`;
        if (diffHours < 24) return `${diffHours}h ago`;
        
        return date.toLocaleDateString() + ' ' + date.toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'});
    }

    $(document).ready(function() {
        fetchMessages();

        // Auto-refresh every 5 seconds
        setInterval(fetchMessages, 5000);

        $('#chat-form').submit(function(e) {
            e.preventDefault();
            let message = $('#message').val();
            if(message.trim() === '') return;

            $.post('{{ route("groups.chat.store", $group->id) }}', $(this).serialize(), function(data) {
                $('#message').val('');
                fetchMessages();
            });
        });

        // Auto-focus on message input
        $('#message').focus();
    });
</script>
@endsection