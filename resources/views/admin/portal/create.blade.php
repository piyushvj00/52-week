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
                            <h2 class="content-header-title float-start mb-0">portal</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">portal</a>
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
                                    <h4 class="card-title">portal</h4>
                                </div>
                                <div class="card-body">
                                    <form class="form form-horizontal" action="{{ route('portal.store') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="mb-1 row">
                                                    <label class="col-form-label">Name <span class="text-danger">*</span></label>
                                                    <div class="col-md-12">
                                                        <input type="text" class="form-control" name="name" placeholder="Name" value="{{ old('name') }}">
                                                        @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                                                    </div>
                                                </div>
                                            </div>
                                             
                                            <div class="col-6">
                                                <div class="mb-1 row">
                                                    <label class="col-form-label">Total portal <span class="text-danger">*</span></label>
                                                    <div class="col-md-12">
                                                        <input type="number" class="form-control" name="total_portals" placeholder="Total portal" readonly value="52">
                                                        @error('total_portals') <small class="text-danger">{{ $message }}</small> @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="mb-1 row">
                                                    <label class="col-form-label">Target Amount <span
                                                            class="text-danger">*</span></label>
                                                    <div class="col-md-12">
                                                        <input type="number" step="0.01" class="form-control"
                                                            name="target_amount" placeholder="Weekly target amount"
                                                            value="{{ old('target_amount') }}">
                                                        @error('target_amount') <small
                                                        class="text-danger">{{ $message }}</small> @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
    <div class="mb-1 row">
        <label class="col-form-label">Start Date <span class="text-danger">*</span></label>
        <div class="col-md-12">
            <input type="date" class="form-control" id="start_date" name="start_date" value="{{ old('start_date') }}">
            @error('start_date')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>
</div>

<div class="col-6">
    <div class="mb-1 row">
        <label class="col-form-label">End Date <span class="text-danger">*</span></label>
        <div class="col-md-12">
            <input type="date" class="form-control" id="end_date" name="end_date" value="{{ old('end_date') }}">
            @error('end_date')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>
</div>


                                           
                                            
                                            
                                            <div class="col-md-12 ">
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
    
<script>
document.getElementById('start_date').addEventListener('change', function () {
    const startDate = new Date(this.value);

    if (isNaN(startDate)) return; // if invalid date

    // Add 1 year
    const endDate = new Date(startDate);
    endDate.setFullYear(endDate.getFullYear() + 1);

    // Format date to YYYY-MM-DD
    const formatted = endDate.toISOString().split('T')[0];

    document.getElementById('end_date').value = formatted;
});
</script>
@endsection