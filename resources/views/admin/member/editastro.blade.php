@extends('admin.layouts.main')

@section('title', 'Dashboard')

@section('content')
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0">User</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">user</a>
                                    </li>
                                    
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
                    <div class="mb-1 breadcrumb-right">
                        <div class="dropdown">
                            <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i data-feather="grid"></i></button>
                            <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="app-todo.html"><i class="me-1" data-feather="check-square"></i><span class="align-middle">Todo</span></a><a class="dropdown-item" href="app-chat.html"><i class="me-1" data-feather="message-square"></i><span class="align-middle">Chat</span></a><a class="dropdown-item" href="app-email.html"><i class="me-1" data-feather="mail"></i><span class="align-middle">Email</span></a><a class="dropdown-item" href="app-calendar.html"><i class="me-1" data-feather="calendar"></i><span class="align-middle">Calendar</span></a></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <section id="basic-horizontal-layouts">
                    <div class="row">
                        <div class="col-md-12 col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">User</h4>
                                </div>
                                <div class="card-body">
                                    <form class="form form-horizontal" action="{{ route('users.update',$users->id) }}" enctype="multipart/form-data" method="post">
                                        @csrf
                                        @method('put')
                                        <div class="row">

        {{-- Name --}}
        <div class="col-6">
            <div class="mb-1 row">
                <label class="col-form-label">Name <span class="text-danger">*</span></label>
                <div class="col-md-12">
                    <input type="text" class="form-control" name="name" placeholder="Full Name" value="{{ $users->name ?? '' }}">
                    @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
            </div>
        </div>

        {{-- Email --}}
        <div class="col-6">
            <div class="mb-1 row">
                <label class="col-form-label">Email <span class="text-danger">*</span></label>
                <div class="col-md-12">
                    <input type="email" class="form-control" name="email" placeholder="john@gmail.com" value="{{ $users->email ?? ''  }}">
                    @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
            </div>
        </div>

        {{-- Phone Number --}}
        <div class="col-6">
            <div class="mb-1 row">
                <label class="col-form-label">Phone Number <span class="text-danger">*</span></label>
                <div class="col-md-12">
                    <input type="text" class="form-control" name="phone_number" placeholder="0909090909" value="{{ $users->phone_number ?? '' }}">
                    @error('phone_number') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
            </div>
        </div>

        {{-- Password --}}
       
         <div class="col-6">
            <div class="mb-1 row">  
                <label class="col-form-label">Experiance <span class="text-danger">*</span></label>
                <div class="col-md-12">
                    <input type="number" required value="{{ $users->experiance ?? '' }}" class="form-control" name="experiance" placeholder="Experiance">
                </div>
                    @error('experiance') <small class="text-danger">{{ $message }}</small> @enderror

            </div>
        </div>

         <div class="col-6">
            <div class="mb-1 row">
                <label class="col-form-label">State <span class="text-danger">*</span></label>
                <div class="col-md-12">
                    <input type="text" class="form-control" name="state" placeholder="State" value="{{ $users->state ?? '' }}">
                    @error('state') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="mb-1 row">
                <label class="col-form-label">City <span class="text-danger">*</span></label>
                <div class="col-md-12">
                    <input type="text" class="form-control" name="city" placeholder="city" value="{{ $users->city ?? '' }}">
                    @error('city') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
            </div>
        </div>

        {{-- Gender --}}
        <div class="col-6">
            <div class="mb-1 row">
                <label class="col-form-label">Gender <span class="text-danger">*</span></label>
                <div class="col-md-12">
                    <select name="gender" required class="form-control">
                        <option value="">-- Select Gender --</option>
                        <option value="male" {{ $users->gender == 'male' ? 'selected' : '' }}>Male</option>
                        <option value="female" {{ $users->gender == 'female' ? 'selected' : '' }}>Female</option>
                        <option value="other" {{ $users->gender == 'other' ? 'selected' : '' }}>Other</option>
                    </select>
                    @error('gender') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
            </div>
        </div>
          <div class="col-6">
            <div class="mb-1 row">
                <label class="col-form-label">Rating <span class="text-danger">*</span></label>
                <div class="col-md-12">
                    <select name="rating" class="form-control">
                        <option value="">-- Select Rating --</option>
                        <option value="1" {{ $users->rating == '1' ? 'selected' : '' }}>1</option>
                        <option value="fe2male" {{ $users->rating == '2' ? 'selected' : '' }}>2</option>
                        <option value="3" {{ $users->rating == '3' ? 'selected' : '' }}>3</option>
                        <option value="4" {{ $users->rating == '4' ? 'selected' : '' }}>4</option>
                        <option value="5" {{ $users->rating == '5' ? 'selected' : '' }}>5</option>
                    </select>
                    @error('rating') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
            </div>
        </div>

        {{-- Marital Status --}}
        <div class="col-6">
            <div class="mb-1 row">
                <label class="col-form-label">Marital Status <span class="text-danger">*</span></label>
                <div class="col-md-12">
                    <select name="merital_status" class="form-control">
                        <option value="">-- Select Status --</option>
                        <option value="single" {{ $users->merital_status == 'single' ? 'selected' : '' }}>Single</option>
                        <option value="married" {{ $users->merital_status == 'married' ? 'selected' : '' }}>Married</option>
                        <option value="divorced" {{ $users->merital_status == 'divorced' ? 'selected' : '' }}>Divorced</option>
                        <option value="widowed" {{ $users->merital_status == 'widowed' ? 'selected' : '' }}>Widowed</option>
                    </select>
                    @error('merital_status') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
            </div>
        </div>

        {{-- Profile Image --}}
        <div class="col-6">
            <div class="mb-1 row">
                <label class="col-form-label">Profile Image</label>
                <div class="col-md-12">
                    <input type="file" class="form-control" name="profile"  accept="image/*">
                    @error('profile') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
            </div>
             @if ($users->profile)
                                                    
                                                    <img src="{{ asset('uploads/'.$users->profile) }}" width="100px" alt="">
                                                    @endif
        </div>

        {{-- DOB --}}
        <div class="col-6">
            <div class="mb-1 row">
                <label class="col-form-label">Date of Birth <span class="text-danger">*</span></label>
                <div class="col-md-12">
                    <input type="date" class="form-control" name="dob" value="{{ $users->dob ?? '' }}">
                    @error('dob') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
            </div>
        </div>

        {{-- Language --}}
        <div class="col-6">
            <div class="mb-1 row">
                <label class="col-form-label">Language <span class="text-danger">*</span></label>
                <div class="col-md-12">
                    <input type="text" class="form-control" name="language" placeholder="English, Hindi" value="{{ $users->language ?? '' }}">
                    @error('language') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
            </div>
        </div>
         <div class="col-6">
            <div class="mb-1 row">
                <label class="col-form-label">Amount per Minute <span class="text-danger">*</span></label>
                <div class="col-md-12">
                    <input type="number" class="form-control" name="amount_per_minute" placeholder="Amount per Minute" required value="{{ $users->amount_per_minute ?? '' }}">
                    @error('amount_per_minute') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
            </div>
        </div>
         <div class="col-6">
            <div class="mb-1 row">
                <label class="col-form-label">Time<span class="text-danger">*</span></label>
                <div class="col-md-12">
                    <input type="time" class="form-control" name="time" placeholder="English, Hindi" required value="{{ $users->time ?? '' }}">
                    @error('time') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
            </div>
        </div>

        {{-- Bio --}}
        <div class="col-12">
            <div class="mb-1 row">
                <label class="col-form-label">Bio <span class="text-danger">*</span></label>
                <div class="col-md-12">
                    <textarea class="form-control" name="bio" rows="3" placeholder="Write something about yourself...">{{ $users->bio ?? ''}}</textarea>
                    @error('bio') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
            </div>
        </div>

        

        {{-- Submit --}}
        <div class="col-md-12 mt-2">
            <button type="submit" class="btn btn-primary me-1">Submit</button>
        </div>

    </div>
</form>
                                </div>
                            </div>
                        </div>
                     
                    </div>
                </section>
            </div>
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
        })
    </script>
@endsection