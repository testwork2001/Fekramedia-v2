@extends('admin.layouts.admin')
@section('title', 'Add New Admin')
@section('current_page', 'New Admin')
@section('content')
    @include('admin.layouts.success')
    @include('admin.layouts.worining')
    <div class="col-11 col-lg-8 mx-auto">
        @include('admin.layouts.requesterrors')
        <div class="card card-outline card-primary">
            <div class="card-body">
                <h4 class="login-box-msg">Create a New Admin</h4>

                <form method="POST" action="{{ route('admins.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Full name" name="name"
                            value="{{ old('name') }}">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" placeholder="Email" name="email"
                            value="{{ old('email') }}">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Phone" name="phone"
                            value="{{ old('phone') }}">
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
                                <option value="{{ $key }}" {{ old('status') == $key ? 'selected' : '' }}>
                                    {{ $value }}</option>
                            @endforeach
                        </select>

                    </div>
                    <div class="input-group mb-3">
                        <label for="email_verified_at" class="col-12">Email verified </label>
                        <select class="form-control" name="email_verified_at" id="email_verified_at">
                            <option value="" disabled></option>
                            <option value="0" {{ old('email_verified_at') == '0' ? 'selected' : '' }}>Not Verified
                            </option>
                            <option value="1" {{ old('email_verified_at') == '1' ? 'selected' : '' }}>Verified</option>
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
                        <h4>Upload Picture</h4>
                        <label for="file-img"><img style="width: 200px;height:200px;border-radius:50%;cursor:pointer"
                                src="{{ asset('admin/img/admin-def.png') }}" alt="" id="image"></label>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-12 col-md-4 my-1">
                            <button type="submit" class="btn btn-outline-success btn-block" name="create_return">Create &
                                Return</button>
                        </div>
                        <div class="col-12 col-md-4 my-1">
                            <button type="submit" class="btn btn-success btn-block" name="create">Create</button>
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
