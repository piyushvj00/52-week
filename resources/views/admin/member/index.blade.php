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
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0">Member</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">member</a>
                                    </li>

                                </ol>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="content-header-right text-md-end col-md-6 col-12 d-md-block d-none">
                    <div class="mb-1 breadcrumb-right">
                        <div class="dropdown">
                            <a href="{{ route('member.create') }}" class=" btn btn-primary ">Add member</a>

                        </div>
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
                                                <th>Email</th>
                                                <th>phone</th>
                                                <th>Created At</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($member as $key => $val)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td><a href="{{route( 'member.group.link',$val->id) }}">{{ $val->name ?? '' }}</a></td>
                                                    <td>{{ $val->email ?? '' }}</td>
                                                    <td>{{ $val->phone ?? '' }}</td>
                                                    <td>{{ $val->created_at ?? '' }}</td>
                                                    <td>
                                                        <div class="d-flex flex-column">
                                                            <div class="form-check form-switch form-check-primary">
                                                                <input type="checkbox" onchange="toggleButton({{ $val->id }})"
                                                                    class="form-check-input" id="customSwitch10"
                                                                    @if($val->status == 1) checked @endif />

                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div>
                                                            <a href="{{ route('member.edit',$val->id) }}"><img width="20px" src="{{ asset('admin/icons/edit.png') }}" alt=""></a>
                                                            <form action="{{ route('member.destroy', $val->id) }}" method="POST"
                                                                style="display:inline;"
                                                                onsubmit="return confirm('Are you sure you want to delete this member?')">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    style="border: none; background: transparent; padding: 0;">
                                                                    <img width="20px"
                                                                        src="{{ asset('admin/icons/delete.png') }}"
                                                                        alt="Delete">
                                                                </button>
                                                            </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>


                                <!-- Pagination links -->
                                <div class="d-flex justify-content-center">
                                    {{ $member->links() }}
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
                url: "{{ route('member.toggle_user_status') }}",
                type: "POST",
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    id: id,
                },
                success: function (response) {
                    if (response == 1) {
                        showToast('status changes to active', 'success'); // success toast
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