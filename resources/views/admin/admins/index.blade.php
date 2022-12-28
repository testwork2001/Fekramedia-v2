@extends('admin.layouts.admin')
@section('title', 'All Admins')
@section('current_page', 'All Admins')
@section('css')
    @include('admin.layouts.datatable-styling')
@endsection
@section('content')
    @include('admin.layouts.success')
    @include('admin.layouts.worining')
    <div class="card">
        <div class="card-header row justify-content-between">
            <h3 class="card-title col-12 col-md-8 my-1">All Admins are Currently Available </h3>
            <div class="col-12 col-md-3 my-1 text-right">
                <a href="{{ route('admins.create') }}" class=" btn btn-success">Add New
                    <i class="fas fa-plus"></i></a>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th class="text-center">Name </th>
                        <th class="text-center">Picture</th>
                        <th class="text-center">Phone </th>
                        <th class="text-center">Email</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Email Verified</th>
                        <th class="text-center">Created Date</th>
                        <th class="text-center">Updated Date</th>
                        <th class="text-center">Opretions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($admins as $admin)
                        <tr>
                            <td class="text-center">{{ $admin->name }} </td>
                            <td class="text-center"><img
                                    src="{{ $admin->getFirstMediaUrl('admins')
                                        ? asset($admin->getFirstMediaUrl('admins'))
                                        : asset('admin/img/admin-def.png') }}"
                                    alt="{{ $admin->name }}" style="width: 50px;height:50px;border-radius:50%"></td>
                            <td class="text-center">{{ $admin->phone }} </td>
                            <td class="text-center">{{ $admin->email }}</td>
                            <td class="text-center "><label
                                    class="badge {{ $admin->status[0] }}">{{ $admin->status[1] }}</label></td>
                            <td class="text-center"><label
                                    class="badge {{ $admin->email_verified_at[0] }}">{{ $admin->email_verified_at[1] }}</td>
                            <td class="text-center">{{ $admin->created_at }}</td>
                            <td class="text-center">{{ $admin->updated_at }}</td>
                            <td class="text-center">
                                <a href="{{ route('admins.edit', $admin->id) }}" class='btn btn-warning mb-1'>Edit</a>
                                <form action="{{ route('admins.destroy', $admin->id) }}" method="post" class="d-inline ">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" value="Delete" class="btn btn-danger mb-1">
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
        <!-- /.card-body -->
    </div>
@endsection
@section('js')
    @include('admin.layouts.datatable-scripts')
@endsection
