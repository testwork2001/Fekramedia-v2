@extends('admin.layouts.admin')
@section('title', "Edit for Admin {$admin->name}")
@section('current_page', 'Edit Admin')
@section('content')
    <div class="col-11 col-lg-8 mx-auto">
        @include('admin.layouts.requesterrors')
        <div class="card card-outline card-primary">
            <div class="card-body">
                <h4 class="login-box-msg">Edit for {{ $admin->name }}</h4>

                <form method="POST" action="{{ route('admins.update' , $admin->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Full name" name="name"
                            value="{{ $admin->name }}">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" placeholder="Email" name="email"
                            value="{{ $admin->email }}">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Phone" name="phone"
                            value="{{ $admin->phone }}">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-phone"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <label for="status" class="col-12">Status</label>
                        <select class="form-control" name="status" id="status">
                            <option value="" disabled></option>
                            @foreach ($statuses as $key => $value)
                                <option value="{{ $key }}" {{$admin->status == $key ? 'selected' : '' }} >
                                    {{ $value }}</option>
                            @endforeach
                        </select>

                    </div>
                    <div class="input-group mb-3">
                        <label for="email_verified_at" class="col-12">Email verified </label>
                        <select class="form-control" name="email_verified_at" id="email_verified_at">
                            <option value="" disabled></option>
                            <option value="0" {{$admin->email_verified_at == null ? "selected": ""}}>Not Verified
                            </option>
                            <option value="1"{{$admin->email_verified_at != null ? "selected": ""}}>Verified</option>
                        </select>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Password" name="password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Confiram Password"
                            name="password_confirmation">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 text-center my-2">
                        <input type="file" class="d-none" name="image" oninput="UpdatePreview()" id="file-img">
                        <h4>Change Picture</h4>
                        <label for="file-img"><img style="width: 200px;height:200px;border-radius:50%;cursor:pointer"
                                src="{{ $admin->getFirstMediaUrl('admins')
                                    ? asset($admin->getFirstMediaUrl('admins'))
                                    : asset('admin/img/admin-def.png') }}"
                                alt="" id="image"></label>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-12 col-md-4 my-1">
                            <button type="submit" class="btn btn-success btn-block" name="create_return">Save Change</button>
                        </div>
                       
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        function UpdatePreview() {
            $('#image').attr('src', URL.createObjectURL(event.target.files[0]));
        };
    </script>
@endsection
