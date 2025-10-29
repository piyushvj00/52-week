@extends('admin.layouts.main')
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
                            <h2 class="content-header-title float-start mb-0">{{ $group->name }} Groups</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">Group</a>
                                    </li>

                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
                    <div class="mb-1 breadcrumb-right">

                    </div>
                </div>
            </div>
            <div class="content-body card ">

                <!-- Basic table -->
                <section id="basic-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Sr No.</th>
                                            <th>Name</th>
                                            <th>Number</th>
                                            <th>Email</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($groupMember as $key => $val)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $val->member->name ?? '' }}</td>
                                                <td>{{ $val->member->phone ?? '' }}</td>
                                                <td>{{ $val->member->email ?? '' }}
                                                <td>
                                                    <button @if($val->user_id == 0) data-bs-toggle="modal" data-bs-target="#addNewCard{{ $val->id }}"
                                                     @endif   class="btn btn-primary">Assign Member</button>
                                                </td>
                                            </tr>
                                            <div class="modal fade" id="addNewCard{{ $val->id }}" tabindex="-1"
                                                aria-labelledby="addNewCardTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-transparent">
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body px-sm-5 mx-50 pb-5">
                                                            <h1 class="text-center mb-1" id="addNewCardTitle">Assign Member</h1>
                                                            <p class="text-center">Add member in group</p>

                                                            <form method="post" action="{{ route('group.member.assign') }}"
                                                                class="row gy-1 gx-2 mt-75">
                                                                @csrf
                                                                <div class="row">
                                                                         <input type="hidden" name="group_member_id"
                                                                        value="{{ $val->id }}">
                                                                         <input type="hidden" name="group_id"
                                                                        value="{{ $val->group_id }}">
                                                                    <div class="col-12">
                                                                        <div class="mb-1 mt-1">
                                                                            <label class="form-label" for="basicSelect">
                                                                                Member</label>
                                                                            <select required class="form-select" name="user_id"
                                                                                id="basicSelect">
                                                                                <option value="">Select Member</option>
                                                                                @foreach ($member as $val)
                                                                                    <option value="{{ $val->id }}">{{ $val->name }}
                                                                                    </option>
                                                                                @endforeach
                                                                            </select>
                                                                            @error('leader_id')<div class="text text-danger">
                                                                                {{ $message }}
                                                                            </div> @enderror
                                                                        </div>
                                                                    </div>
                                                                </div>


                                                                <div class="col-12 text-center">
                                                                    <button type="submit"
                                                                        class="btn btn-primary me-1 mt-1">Submit</button>
                                                                    <button type="reset" class="btn btn-outline-secondary mt-1"
                                                                        data-bs-dismiss="modal" aria-label="Close">
                                                                        Cancel
                                                                    </button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </tbody>
                                </table>

                                <!-- Pagination links -->
                                <div class="d-flex justify-content-center">
                                    {{ $groupMember->links() }}
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