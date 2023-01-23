@extends('admin.layouts.admin')
@section('current_page', 'Create a new Service')
@section('title', 'Create a new Service')
@section('css')
    @include('admin.layouts.summernote-style')
@endsection
@section('content')
    @include('admin.layouts.requesterrors')
    @include('admin.layouts.success')
    <div class="card ">
        <div class="card-header">
            <h2 class="text-center">Please Enter Service Data</h2>
        </div>
        <form action="{{ route('services.store') }}" method="post">
            @csrf
            <div class="card-body form_page" id="page1">
                <div class="form-group">
                    <label for="name">Service Name</label>
                    <input class="form-control form-control-lg" id="status"type="text" placeholder="Service Name"
                        name="service[name]" value="{{ old('service.name') }}">
                </div>
                <div class="form-group">
                    <label for="icon">Service Icon</label>
                    <input class="form-control form-control-lg" id="icon" type="text" placeholder="Service Icone"
                        name="service[icon]" value="{{ old('service.icon') }}">
                </div>
                <div class="from-group">
                    <label for="category_id">Category Name</label>
                    <select name="category_id" id="category_id" class="form-control form-control-lg">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{old('service.category_id') == $category->id ? 'selected' : ''}}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="from-group">
                    <label for="status">Status</label>
                    <select name="service[status]" id="status" class="form-control form-control-lg">
                        @foreach ($statuses as $key => $value)
                            <option value="{{ $key }}" {{old('service.status') == $key ? 'selected' : ''}}>{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group my-3">
                    <label for="summernote">Details</label>
                    <textarea id="summernote" name="details">
                      {{ old('service.details') ?? 'Service is Very Good' }}
                    </textarea>
                </div>
                <div class="from-group my-2">
                    <div class="col-12 text-center">
                        <input type="file" class="d-none" name="image" oninput="UpdatePreview()" id="file-img">
                        <h4>Upload Picture</h4>
                        <label for="file-img"><img style="width: 200px;height:200px;border-radius:50%;cursor:pointer"
                                src="{{ asset('admin/img/img-def.png') }}" alt="" id="image"></label>
                    </div>
                </div>
            </div>
            <div class="card-body form_page d-none " id="page2">
                <h5 class="text-center alert alert-success">Please Enter the sepcial Processes of the Service </h5>
                <div class="repeater fvrduplicate">
                    <div class="entry">
                        <div class="form-group">
                            <label for="name">Process Name</label>
                            <input class="form-control form-control-lg" type="text" placeholder="Process Name"
                                name="processes[0][name]">
                        </div>
                        <div class="form-group">
                            <label for="icon">Process Icon</label>
                            <input class="form-control form-control-lg" type="text" placeholder="Process Icone"
                                name="processes[0][icon]">
                        </div>
                        <div class="from-group">
                            <label>Process Status</label>
                            <select name="processes[0][status]" class="form-control form-control-lg">
                                @foreach ($statuses as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group my-3">
                            <label>Details</label>
                            <textarea name="processes[0][details]" class="form-control " rows="10">procces is very good
                         </textarea>
                        </div>
                        <div class="form-group">
                            <label>Upload Image</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="processes[0][image]"> 
                                    <label class="custom-file-label">Choose image</label>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary btn-sm btn-add" >
                            Add new Process
                        </button>
                    </div>
                </div>
                <div class="from-group my-2 row justify-content-center">
                    <div class="col-12 col-md-4 my-1">
                        <button type="submit" class="btn btn-outline-success btn-block" name="create_return">Create &
                            Return</button>
                    </div>
                    <div class="col-12 col-md-4 my-1">
                        <button type="submit" class="btn btn-success btn-block" name="create">Create</button>
                    </div>
                </div>


            </div>
            <div class="row mx-3">
                <input type="button" value="prev" class="btn btn-primary m-1 disabled" id="perv">
                <input type="button" value="next" class="btn btn-primary m-1" id="next">
            </div>
        </form>
    </div>
@endsection
@section('js')
    @include('admin.layouts.summernote-script')
    @include('admin.layouts.imgperview-script')
    @include('admin.layouts.formrepeater-script')
    <script>
        $('#next').on('click', function() {
            $('#page1').addClass('d-none')
            $('#page2').removeClass('d-none')
            $(this).addClass('disabled')
            $('#perv').removeClass('disabled')
        })

        $('#perv').on('click', function() {
            $('#page2').addClass('d-none')
            $('#page1').removeClass('d-none')
            $(this).addClass('disabled')
            $('#next').removeClass('disabled')
        })
    </script>
@endsection
