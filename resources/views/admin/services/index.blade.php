@extends('admin.layouts.admin')
@section('title', 'All Services')
@section('current_page', 'All Services')
@section('css')
    @include('admin.layouts.datatable-styling')
@endsection
@section('content')
    @include('admin.layouts.success')
    @include('admin.layouts.worining')
    <div class="card">
        <div class="card-header row justify-content-between">
            <h3 class="card-title col-12 col-md-8 my-1">All Services are Currently Available </h3>
            <div class="col-12 col-md-3 my-1 text-right">
                <a href="{{ route('services.create') }}" class=" btn btn-success">Add New
                    <i class="fas fa-plus"></i></a>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th class="text-center">Name </th>
                        <th class="text-center">Slug </th>
                        <th class="text-center">Picture</th>
                        <th class="text-center">Details </th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Category Name </th>
                        <th class="text-center">Created Date</th>
                        <th class="text-center">Updated Date</th>
                        <th class="text-center">Opretions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($services as $service)
                        <tr>
                            <td class="text-center">{{ $service->name }} </td>
                            <td class="text-center">{{ $service->slug }} </td>
                            <td class="text-center"><span class="text-white"><?= $service->icon ?></span></td>
                            <td class="text-center">{{ $service->details }} </td>
                            <td class="text-center "><label
                                    class="badge {{ $service->status[0] }}">{{ $service->status[1] }}</label></td>
                            <td class="text-center">{{ $service->category->name }} </td>
                            <td class="text-center">{{ $service->created_at }}</td>
                            <td class="text-center">{{ $service->updated_at }}</td>
                            <td class="text-center">
                                <a href="{{ route('services.show', $service->id) }}" class="btn btn-success mb-1">View
                                    <i class="fas fa-folder">
                                    </i></a>
                                <a href="{{ route('services.edit', $service->id) }}" class='btn btn-warning mb-1'>Edit <i
                                        class="fas fa-pencil-alt">
                                    </i></a>
                                <form action="{{ route('services.destroy', $service->id) }}" method="post"
                                    class="d-inline ">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger mb-1">Delete <i class="fas fa-trash">
                                        </i></button>
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
