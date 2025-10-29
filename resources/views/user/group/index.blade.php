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
                            <h2 class="content-header-title float-start mb-0">Groups</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">Groups</a>
                                    </li>

                                </ol>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="content-header-right text-md-end col-md-6 col-12 d-md-block d-none">
                    <div class="mb-1 breadcrumb-right">
                        <!-- <div class="dropdown">
                            <a href="{{ route('leader.create') }}" class=" btn btn-primary ">Add leader</a>

                        </div> -->
                    </div>
                </div>
            </div>
            <div class="content-body card ">
                <section id="basic-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Sr No.</th>
                                                <th>Name</th>
                                                <th>contribution_amount</th>
                                                <th>start_date</th>
                                                <th>total_members</th>
                                                <th>total_cycles</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($group as $key => $val)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td><a href="">{{ $val->name ?? '' }}</a></td>
                                                    <td>{{ $val->contribution_amount ?? '' }}</td>
                                                    <td>{{ $val->start_date ?? '' }}</td>
                                                    <td>{{ $val->total_members ?? '' }}</td>
                                                    <td>{{ $val->total_cycles ?? '' }}</td>
                                                    
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>


                                <!-- Pagination links -->
                                <div class="d-flex justify-content-center">
                                    {{ $group->links() }}
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
        function toggleButton(id) {
            $.ajax({
                url: "{{ route('leader.toggle_user_status') }}",
                type: "POST",
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    id: id,
                },
                success: function (response) {
                    if (response == 1) {
                        showToast('status changes to active', 'success'); 
                        setTimeout(() => {
                            window.location.reload();
                        }, 1000);
                    } else {
                        showToast('status changes to inactive', 'success'); // success toast
                        setTimeout(() => {
                            window.location.reload();
                        }, 1000);
                    }
                },
                error: function (xhr) {
                    alert("Something went wrong!");
                }
            });
        }
    </script>
@endsection