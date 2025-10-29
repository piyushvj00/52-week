@extends('leader.layouts.main')
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
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0">Member</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">Member</a>
                                    </li>

                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
                    <div class="mb-1 breadcrumb-right">
                        <!-- <div class="dropdown">
                                    <a href="{{ route('leader.groups.create') }}" class=" btn btn-primary ">Add Group</a>

                                </div> -->
                    </div>
                </div>
            </div>
            <div class="content-body card">
                <section class="app-user-view-account">
                    <div class="row">
                        <!-- User Sidebar -->
                        <div class="col-xl-4 col-lg-5 col-md-5 order-1 order-md-0">
                            <!-- User Card -->
                            <div class="card">
                                <div class="card-body">
                                    <div class="user-avatar-section">
                                        <div class="d-flex align-items-center flex-column">
                                            <img class="img-fluid rounded mt-3 mb-2"
                                                src="{{ $user->profile_image ? asset('uploads/' . $user->profile_image) : asset('admin/icons/user.png') }}"
                                                height="110" width="110" alt="User avatar">

                                            <div class="user-info text-center">
                                                <h4>{{ $user->name ?? '' }}</h4>
                                                <span class="badge bg-light-secondary">Member</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-around my-2 pt-75">
                                        <div class="d-flex align-items-start me-2">
                                            <span class="badge bg-light-primary p-75 rounded">
                                                <i data-feather="check" class="font-medium-2"></i>
                                            </span>
                                            <div class="ms-75">
                                                <h4 class="mb-0">1.23k</h4>
                                                <small>Contribution</small>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-start">
                                            <span class="badge bg-light-primary p-75 rounded">
                                                <i data-feather="briefcase" class="font-medium-2"></i>
                                            </span>
                                            <div class="ms-75">
                                                <h4 class="mb-0">568</h4>
                                                <small>Payouts</small>
                                            </div>
                                        </div>
                                    </div>
                                    <h4 class="fw-bolder border-bottom pb-50 mb-1">Details</h4>
                                    <div class="info-container">
                                        <ul class="list-unstyled">
                                            <li class="mb-75">
                                                <span class="fw-bolder me-25">Username:</span>
                                                <span>{{ $user->name ?? '' }}</span>
                                            </li>
                                            <li class="mb-75">
                                                <span class="fw-bolder me-25"> Email:</span>
                                                <span>{{ $user->email ?? '' }}</span>
                                            </li>
                                            <li class="mb-75">
                                                <span class="fw-bolder me-25">Status:</span>
                                                <span class="badge bg-light-success">Active</span>
                                            </li>
                                            <li class="mb-75">
                                                <span class="fw-bolder me-25">Role:</span>
                                                <span>Member</span>
                                            </li>
                                            <li class="mb-75">
                                                <span class="fw-bolder me-25">Tax ID:</span>
                                                <span>Tax-8965</span>
                                            </li>
                                            <li class="mb-75">
                                                <span class="fw-bolder me-25">Contact:</span>
                                                <span>{{ $user->phone ?? '' }}</span>
                                            </li>
                                            <li class="mb-75">
                                                <span class="fw-bolder me-25">Language:</span>
                                                <span>English</span>
                                            </li>
                                            <li class="mb-75">
                                                <span class="fw-bolder me-25">Address:</span>
                                                <span>{{ $user->address ?? '' }}</span>
                                            </li>
                                        </ul>
                                        <div class="d-flex justify-content-center pt-2">
                                            <!-- <a href="javascript:;" class="btn btn-primary me-1" data-bs-target="#editUser" data-bs-toggle="modal">
                                                        Edit
                                                    </a> -->
                                            <a href="javascript:;" class="btn btn-outline-danger suspend-user">Remove From
                                                Group</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!--/ User Sidebar -->

                        <!-- User Content -->
                        <div class="col-xl-8 col-lg-7 col-md-7 order-0 order-md-1">
                            <!-- User Pills -->
                            <ul class="nav nav-pills mb-2">
                                <li class="nav-item">
                                    <a class="nav-link active" href="app-user-view-account.html">
                                        <i data-feather="user" class="font-medium-3 me-50"></i>
                                        <span class="fw-bold">Account</span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="app-user-view-security.html">
                                        <i data-feather="lock" class="font-medium-3 me-50"></i>
                                        <span class="fw-bold">Contribution</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="app-user-view-billing.html">
                                        <i data-feather="bookmark" class="font-medium-3 me-50"></i>
                                        <span class="fw-bold">Payouts</span>
                                    </a>
                                </li>
                                
                            </ul>
                            <!--/ User Pills -->

                            <!-- Project table -->
                            <div class="card">
                                <h4 class="card-header">Member's Group List</h4>
                                <div class="table-responsive">
                                    <table class="table datatable-project">
                                        <thead>
                                            <tr>
                                                <th>Sr No.</th>
                                                <th>Name</th>
                                                <th class="text-nowrap">Project Name</th>
                                                <th>Project Description</th>
                                                <th>Member</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($groups as $key=>$val)
                                            <td>{{ $key +1}}</td>
                                            <td>{{ $val->name ?? '' }}</td>
                                            <td>{{ $val->project_name ?? '' }}</td>
                                            <td>{{ $val->project_description ?? '' }}</td>
                                            <td>{{ $user->name ?? '' }}</td>
                                            @endforeach

                                        </tbody>
                                    </table>
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