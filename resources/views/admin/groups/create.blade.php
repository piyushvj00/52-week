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
                            <h2 class="content-header-title float-start mb-0">Group</h2>
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
                        <div class="dropdown">
                            <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" type="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                    data-feather="grid"></i></button>
                            <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="app-todo.html"><i
                                        class="me-1" data-feather="check-square"></i><span
                                        class="align-middle">Todo</span></a><a class="dropdown-item" href="app-chat.html"><i
                                        class="me-1" data-feather="message-square"></i><span
                                        class="align-middle">Chat</span></a><a class="dropdown-item"
                                    href="app-email.html"><i class="me-1" data-feather="mail"></i><span
                                        class="align-middle">Email</span></a><a class="dropdown-item"
                                    href="app-calendar.html"><i class="me-1" data-feather="calendar"></i><span
                                        class="align-middle">Calendar</span></a></div>
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
                                    <h4 class="card-title">Group</h4>
                                </div>
                                <div class="card-body">
                                    <form class="form form-horizontal" action="{{ route('groups.store') }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="mb-1 row">
                                                    <label class="col-form-label">Portal Name <span
                                                            class="text-danger">*</span></label>
                                                    <div class="col-md-12">
                                                        <input type="text" class="form-control" name="name"
                                                            placeholder="e.g., Earth, Venus, Mars"
                                                            value="{{ old('name') }}">
                                                        @error('name') <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="mb-1 mt-1">
                                                    <label class="form-label" for="basicSelect">Leader <span
                                                            class="text-danger">*</span></label>
                                                    <select class="form-select" name="leader_id" id="basicSelect">
                                                        <option value="">Select Leader</option>
                                                        @foreach ($leader as $val)
                                                            <option value="{{ $val->id }}">{{ $val->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('leader_id')<div class="text text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            

                                            <div class="col-6">
                                                <div class="mb-1 mt-1">
                                                    <label class="form-label" for="portalSetSelect">Portal Set <span
                                                            class="text-danger">*</span></label>
                                                    <select class="form-select" name="portal_set_id" id="portalSetSelect">
                                                        <option value="">Select Portal Set</option>
                                                        @foreach ($portalSets as $set)
                                                            <option value="{{ $set->id }}">{{ $set->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('portal_set_id')<div class="text text-danger">{{ $message }}
                                                    </div> @enderror
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="mb-1 row">
                                                    <label class="col-form-label">Group Number <span
                                                            class="text-danger">*</span></label>
                                                    <div class="col-md-12">
                                                        <input type="number" class="form-control" name="group_number"
                                                            placeholder="Position 1-52" value="{{ old('group_number') }}"
                                                            min="1" max="52">
                                                        @error('group_number') <small
                                                        class="text-danger">{{ $message }}</small> @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="mb-1 row">
                                                    <label class="col-form-label">Project Name <span
                                                            class="text-danger">*</span></label>
                                                    <div class="col-md-12">
                                                        <input type="text" class="form-control" name="project_name"
                                                            placeholder="Business project name"
                                                            value="{{ old('project_name') }}">
                                                        @error('project_name') <small
                                                        class="text-danger">{{ $message }}</small> @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="mb-1 row">
                                                    <label class="col-form-label">Project Description</label>
                                                    <div class="col-md-12">
                                                        <textarea class="form-control" name="project_description"
                                                            placeholder="Describe the business project"
                                                            rows="3">{{ old('project_description') }}</textarea>
                                                        @error('project_description') <small
                                                        class="text-danger">{{ $message }}</small> @enderror
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
                                                            value="{{ $portalSets->target_amount ?? '' }}">
                                                        @error('target_amount') <small
                                                        class="text-danger">{{ $message }}</small> @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            

                                            <div class="col-6">
                                                <div class="mb-1 row">
                                                    <label class="col-form-label">Business Logo</label>
                                                    <div class="col-md-12">
                                                        <input type="file" class="form-control" name="logo"
                                                            accept="image/*">
                                                        @error('logo') <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="mb-1 row">
                                                    <label class="col-form-label">Business Video</label>
                                                    <div class="col-md-12">
                                                        <input type="file" class="form-control" name="video"
                                                            accept="video/*">
                                                        @error('video') <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12 ">
                                                <button type="submit" class="btn btn-primary me-1">Create Portal</button>
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