@extends('admin.layouts.admin')
@section('title', "Edit for {$category->name}")
@section('current_page', 'Edit Category')
@section('css')
    @include('admin.layouts.summernote-style')
@endsection
@section('content')
    @include('admin.layouts.requesterrors')
    @include('admin.layouts.success')
    <div class="card ">
        <div class="card-header">
            <h2 class="text-center"> Category Data for {{ $category->name }} </h2>
        </div>
        <form action="{{ route('categories.update', $category->id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="form-group">
                    <label for="name">Category Name</label>
                    <input class="form-control form-control-lg" id="status"type="text" placeholder="Category Name"
                        name="name" value="{{ $category->name }}">
                </div>
                <div class="form-group">
                    <label for="icon">Category Icon</label>
                    <input class="form-control form-control-lg" id="icon" type="text" placeholder="Category Icone"
                        name="icon" value="{{ $category->icon }}">
                </div>
                <div class="from-group">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control form-control-lg">
                        @foreach ($statuses as $key => $value)
                            <option value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group my-3" style="min-height:300px ">
                    <label for="summernote">Details</label>
                    <textarea id="summernote" name="details">
                 {{ $category->details }} 
              </textarea>
                </div>
                <div class="row justify-content-center">
                    <div class="col-12 col-md-4 my-1">
                        <button type="submit" class="btn btn-success btn-block" name="create_return">Save Change</button>
                    </div>
                   
                </div>

            </div>
        </form>
    </div>
@endsection
@section('js')
    @include('admin.layouts.summernote-script')
@endsection
