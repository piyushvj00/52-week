@extends('user.layouts.main')

@section('title', 'Dashboard')
<style>
    .card {
        padding: 10px !important;
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
                            <h2 class="content-header-title float-start mb-0">Profile</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">My Profile</a>
                                    </li>

                                </ol>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="content-header-right text-md-end col-md-6 col-12 d-md-block d-none">
                    <div class="mb-1 breadcrumb-right">
                      
                    </div>
                </div>
            </div>
            <div class="content-body card ">
                <section id="basic-datatable">
                    <div class="row">
                        <div class="col-md-12 col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Profile</h4>
                                </div>
                                <div class="card-body">
                                    <form class="form form-horizontal" action="{{ route('user.update.profile') }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <!-- name -->
                                            <div class="col-6">
                                                <div class="mb-1 row">
                                                    <label class="col-form-label">Name <span
                                                            class="text-danger">*</span></label>
                                                    <div class="col-md-12">
                                                        <input type="text" class="form-control" name="name"
                                                            value="{{ $user->name }}">
                                                        @error('name') <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- email -->
                                            <div class="col-6">
                                                <div class="mb-1 row">
                                                    <label class="col-form-label">Email<span
                                                            class="text-danger">*</span></label>
                                                    <div class="col-md-12">
                                                        <input type="text" class="form-control" name="email"
                                                            value="{{ $user->email }}" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Profile Picture -->
                                             <div class="col-6">
                                                <div class="mb-1 row">
                                                    <label class="col-form-label">Profile Picture<span
                                                            class="text-danger">*</span></label>
                                                    <div class="col-md-12">
                                                        <input type="file" class="form-control" name="profile_image"
                                                            placeholder="select a Profile Picture"
                                                            value="{{ $user->address }}">
                                                        @error('profile_image') <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- address -->
                                             <div class="col-6">
                                                <div class="mb-1 row">
                                                    <label class="col-form-label">Address<span
                                                            class="text-danger">*</span></label>
                                                    <div class="col-md-12">
                                                        <input type="text" class="form-control" name="address"
                                                            placeholder="Enter your address"
                                                            value="{{ $user->address }}">
                                                        @error('address') <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12 mt-2">
                                                <button type="submit" class="btn btn-primary me-1">Save</button>
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