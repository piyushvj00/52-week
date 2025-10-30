<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Join {{ $group->name }} - Financial Community</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .gradient-text {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .pulse-animation {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }

            100% {
                transform: scale(1);
            }
        }

        .hover-lift {
            transition: all 0.3s ease;
        }

        .hover-lift:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body class="flex items-center justify-center min-h-screen p-4">
    <div class="max-w-4xl w-full">
        <!-- Main Card -->
        <div class="glass-card rounded-3xl shadow-2xl overflow-hidden">
            <div class="grid lg:grid-cols-2 gap-0">
                <!-- Left Side - Welcome & Group Info -->
                <div class="p-8 lg:p-12 bg-gradient-to-br from-blue-600 to-purple-700 text-white">
                    <!-- Logo & Welcome -->
                    <div class="text-center mb-8">
                        @if($group->logo_path)
                            <img src="{{ asset('uploads/' . $group->logo_path) }}" alt="{{ $group->name }} Logo"
                                class="h-24 w-24 rounded-full object-cover border-4 border-white shadow-lg mx-auto mb-4">
                        @else
                            <div
                                class="h-24 w-24 rounded-full bg-gradient-to-r from-blue-400 to-purple-500 flex items-center justify-center border-4 border-white shadow-lg mx-auto mb-4">
                                <span class="text-white text-3xl font-bold">{{ substr($group->name, 0, 1) }}</span>
                            </div>
                        @endif
                        <h1 class="text-3xl lg:text-4xl font-bold mb-4">Welcome to {{ $group->name }}</h1>
                        <p class="text-xl text-blue-100 leading-relaxed">
                            "Welcome to a community of financial freedom where people grow together."
                        </p>
                    </div>

                    <!-- Share Price Highlight -->
                    <div class="bg-white bg-opacity-20 rounded-2xl p-6 mb-8 text-center">
                        <div class="flex items-center justify-center mb-3">
                            <i class="fas fa-chart-line text-2xl text-green-300 mr-3"></i>
                            <span class="text-blue-100 text-lg font-semibold">Share Price</span>
                        </div>
                        <div class="text-4xl font-bold text-white mb-2">
                            ${{ number_format($portalSet->share_price ?? 0) }}
                        </div>
                        <p class="text-blue-200 text-sm">Per share per week</p>
                    </div>

                    <!-- Quick Stats -->
                    <div class="space-y-4">
                        <div class="flex justify-between items-center p-4 bg-white bg-opacity-10 rounded-xl">
                            <div class="flex items-center">
                                <i class="fas fa-bullseye mr-3 text-blue-200"></i>
                                <span>Target Amount</span>
                            </div>
                            <span class="font-semibold text-lg">${{ number_format($group->target_amount, 2) }}</span>
                        </div>

                        <!-- <div class="flex justify-between items-center p-4 bg-white bg-opacity-10 rounded-xl">
                            <div class="flex items-center">
                                <i class="fas fa-users mr-3 text-blue-200"></i>
                                <span>Current Progress</span>
                            </div>
                            <span class="font-semibold text-lg">{{ number_format(($group->current_amount / $group->target_amount) * 100, 1) }}%</span>
                        </div> -->

                        <div class="flex justify-between items-center p-4 bg-white bg-opacity-10 rounded-xl">
                            <div class="flex items-center">
                                <i class="fas fa-calendar-alt mr-3 text-blue-200"></i>
                                <span>Duration</span>
                            </div>
                            <span class="font-semibold text-lg">52 Weeks</span>
                        </div>
                    </div>
                </div>

                <!-- Right Side - Details & Registration -->
                <div class="p-8 lg:p-12">
                    <!-- Project Information -->
                    <div class="mb-8">
                        <h2 class="text-2xl font-bold gradient-text mb-6 flex items-center">
                            <i class="fas fa-project-diagram mr-3"></i>
                            Project Overview
                        </h2>

                        <div class="space-y-4">
                            <div class="bg-gray-50 p-4 rounded-xl">
                                <h3 class="font-semibold text-gray-900 mb-2 flex items-center">
                                    <i class="fas fa-tag text-blue-600 mr-2"></i>
                                    Project Name
                                </h3>
                                <p class="text-gray-700 text-lg">{{ $group->project_name }}</p>
                            </div>

                            <div class="bg-gray-50 p-4 rounded-xl">
                                <h3 class="font-semibold text-gray-900 mb-2 flex items-center">
                                    <i class="fas fa-align-left text-blue-600 mr-2"></i>
                                    Project Description
                                </h3>
                                <p class="text-gray-700 leading-relaxed">{{ $group->project_description }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Timeline -->
                    <div class="mb-8">
                        <h3 class="text-xl font-bold text-gray-900 mb-4 flex items-center">
                            <i class="fas fa-clock text-blue-600 mr-2"></i>
                            Investment Timeline
                        </h3>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="bg-blue-50 p-4 rounded-xl text-center">
                                <div class="text-blue-600 font-semibold mb-1">Start Date</div>
                                <div class="text-gray-900 font-bold">
                                    {{ \Carbon\Carbon::parse($group->start_date)->format('M d, Y') }}</div>
                            </div>
                            <div class="bg-green-50 p-4 rounded-xl text-center">
                                <div class="text-green-600 font-semibold mb-1">End Date</div>
                                <div class="text-gray-900 font-bold">
                                    {{ \Carbon\Carbon::parse($group->end_date)->format('M d, Y') }}</div>
                            </div>
                        </div>
                    </div>

                    <!-- Progress Bar -->
                    <div class="mb-8">
                        <!-- <div class="flex justify-between text-sm mb-2">
                            <span class="text-gray-600 font-medium">Group Progress</span>
                            <span class="text-gray-900 font-semibold">
                                ${{ number_format($group->current_amount, 2) }} / ${{ number_format($group->target_amount, 2) }}
                            </span>
                        </div> -->
                        <!-- <div class="w-full bg-gray-200 rounded-full h-3">
                            <div class="bg-gradient-to-r from-green-400 to-blue-500 h-3 rounded-full transition-all duration-1000" 
                                 style="width: {{ ($group->current_amount / $group->target_amount) * 100 }}%">
                            </div>
                        </div>
                        <div class="text-center mt-2">
                            <span class="text-lg font-bold text-gray-900">
                                {{ number_format(($group->current_amount / $group->target_amount) * 100, 1) }}% Complete
                            </span>
                        </div> -->
                    </div>

                    <!-- Video Section -->
                    @if($group->video_path)
                        <div class="mb-8">
                            <h3 class="text-xl font-bold text-gray-900 mb-4 flex items-center">
                                <i class="fas fa-play-circle text-blue-600 mr-2"></i>
                                Project Introduction
                            </h3>
                            <div class="relative aspect-video bg-gray-100 rounded-xl overflow-hidden shadow-lg">
                                <video controls class="w-full h-full"
                                    poster="{{ $group->logo_path ? asset('uploads/' . $group->logo_path) : '' }}">
                                    <source src="{{ asset('uploads/' . $group->video_path) }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            </div>
                        </div>
                    @endif

                    <!-- Registration Button -->
                    <div class="text-center">
                        <button onclick="registerNow({{ $group->id }})"
                            class="w-full bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white font-bold py-4 px-8 rounded-2xl shadow-2xl hover-lift pulse-animation transition-all duration-300 text-lg">
                            <i class="fas fa-user-plus mr-2"></i>
                            Join This Financial Community
                        </button>
                        <p class="text-gray-600 text-sm mt-3">
                            Start your journey to financial freedom today
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Benefits Section -->
        <div class="grid md:grid-cols-3 gap-6 mt-8">
            <div class="glass-card p-6 rounded-2xl text-center hover-lift">
                <div class="w-16 h-16 bg-blue-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-shield-alt text-blue-600 text-2xl"></i>
                </div>
                <h3 class="font-bold text-gray-900 mb-2">Secure Investment</h3>
                <p class="text-gray-600 text-sm">Your investments are protected with transparent tracking</p>
            </div>

            <div class="glass-card p-6 rounded-2xl text-center hover-lift">
                <div class="w-16 h-16 bg-green-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-hand-holding-usd text-green-600 text-2xl"></i>
                </div>
                <h3 class="font-bold text-gray-900 mb-2">Weekly Growth</h3>
                <p class="text-gray-600 text-sm">Consistent weekly contributions build your wealth</p>
            </div>

            <div class="glass-card p-6 rounded-2xl text-center hover-lift">
                <div class="w-16 h-16 bg-purple-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-users text-purple-600 text-2xl"></i>
                </div>
                <h3 class="font-bold text-gray-900 mb-2">Community Support</h3>
                <p class="text-gray-600 text-sm">Learn and grow with a supportive community</p>
            </div>
        </div>

        <!-- Footer Note -->
        <div class="text-center mt-8">
            <p class="text-white text-opacity-80 text-sm">
                © {{ date('Y') }} {{ $group->name }} - Building Financial Freedom Together
            </p>
        </div>
    </div>

    <script>
        function registerNow(id) {
            let url = "{{ route('user.register', ':id') }}";
            url = url.replace(':id', id);
            window.location.href = url;
        }


        // Add some interactive effects
        document.addEventListener('DOMContentLoaded', function () {
            const progressBar = document.querySelector('.bg-gradient-to-r');
            const originalWidth = progressBar.style.width;
            progressBar.style.width = '0%';

            setTimeout(() => {
                progressBar.style.transition = 'width 2s ease-in-out';
                progressBar.style.width = originalWidth;
            }, 500);

            // Add hover effects to cards
            const cards = document.querySelectorAll('.glass-card');
            cards.forEach(card => {
                card.addEventListener('mouseenter', function () {
                    this.style.transform = 'translateY(-5px)';
                });
                card.addEventListener('mouseleave', function () {
                    this.style.transform = 'translateY(0)';
                });
            });
        });
    </script>
</body>

</html>