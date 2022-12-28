@extends('admin.layouts.admin')
@section('title', 'All Categories')
@section('current_page', 'All Categories')
@section('css')
    @include('admin.layouts.datatable-styling')
@endsection
@section('content')
    @include('admin.layouts.success')
    @include('admin.layouts.worining')
    <div class="card">
        <div class="card-header row justify-content-between">
            <h3 class="card-title col-12 col-md-8 my-1">All Categories are Currently Available </h3>
            <div class="col-12 col-md-3 my-1 text-right">
                <a href="{{ route('categories.create') }}" class=" btn btn-success">Add New
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
                        <th class="text-center">Details </th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Created Date</th>
                        <th class="text-center">Updated Date</th>
                        <th class="text-center">Opretions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td class="text-center">{{ $category->name }} </td>
                            <td class="text-center"><span class="text-white"><?= $category->icon ?></span></td>
                            <td class="text-center">{{ $category->details }} </td>
                            <td class="text-center "><label
                                    class="badge {{ $category->status[0] }}">{{ $category->status[1] }}</label></td>
                            <td class="text-center">{{ $category->created_at }}</td>
                            <td class="text-center">{{ $category->updated_at }}</td>
                            <td class="text-center">
                                <a href="{{ route('categories.show', $category->id) }}" class="btn btn-success mb-1">View
                                    <i class="fas fa-folder">
                                    </i></a>
                                <a href="{{ route('categories.edit', $category->id) }}" class='btn btn-warning mb-1'>Edit <i
                                        class="fas fa-pencil-alt">
                                    </i></a>
                                <form action="{{ route('categories.destroy', $category->id) }}" method="post"
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
