@extends('admin.admins.create')
@section('title', "Update for {$price->name}")
@section('current_page', 'Update Price')
@section('content')
    @include('admin.layouts.requesterrors')
    @include('admin.layouts.success')
    <div class="card ">
        <div class="card-header">
            <h2 class="text-center">Please Update for {{ $price->name }}</h2>
        </div>
        <form action="{{ route('pricing.update', ['pricing' => $price->id]) }}" method="post">
            @method('PUT')
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="name">Pricing Name</label>
                    <input class="form-control form-control-lg" id="status"type="text" placeholder="Pricing Name"
                        name="name" value="{{ $price->name }}">
                </div>
                <div class="form-group">
                    <label for="price">Price</label>
                    <input class="form-control form-control-lg" id="price"type="text" placeholder="Price"
                        name="price" value="{{ $price->price }}">
                </div>
                <div class="form-group">
                    <label for="icon">Pricing Icon</label>
                    <input class="form-control form-control-lg" id="icon" type="text" placeholder="Pricing Icone"
                        name="icon" value="{{ $price->icon }}">
                </div>
                <div class="from-group">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control form-control-lg">
                        @foreach ($statuses as $key => $value)
                            <option value="{{ $key }}" {{ $price->status[1] == $value ? 'selected' : '' }}>
                                {{ $value }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="old">
                    @foreach (json_decode($price->features) as $index => $feature)
                        <div>
                            <div class="form-group ">
                                <label>Pricing Feature</label>
                                <input class="form-control form-control-lg " type="text" placeholder="Feature Details"
                                    name="features[]" value="{{ $feature }}">
                            </div>
                            <button type="button" class="btn btn-danger btn-sm oldfeatures">
                                remove
                            </button>
                        </div>
                    @endforeach
                </div>
                <div class="repeater fvrduplicate">
                    <div class="entry">
                        <div class="form-group">
                            <label>Pricing Feature</label>
                            <input class="form-control form-control-lg features" type="text"
                                placeholder="Feature Details" name="features[]">
                        </div>

                        <button type="button" class="btn btn-primary btn-sm btn-add">
                            Add new Feature
                        </button>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-12 col-md-4 my-1">
                        <button type="submit" class="btn btn-outline-success btn-block">Update</button>
                    </div>

                </div>
            </div>
        </form>
    </div>
@endsection
@section('js')
    <script>
        $(function() {
            $(document).on('click', '.btn-add', function(e) {
                e.preventDefault();
                var controlForm = $('.fvrduplicate:first'),
                    currentEntry = $(this).parents('.entry:first'),
                    newEntry = $(currentEntry.clone()).appendTo(controlForm);
                newEntry.find('input').val('');
                controlForm.find('.entry:not(:last) .btn-add')
                    .removeClass('btn-add').addClass('btn-remove')
                    .removeClass('btn-success').addClass('btn-danger')
                    .html('remove');
            }).on('click', '.btn-remove', function(e) {
                e.preventDefault();
                $(this).parents('.entry:first').remove();
                return false;
            });
        });


        $(document).on('click', '.oldfeatures', function(e) {
            e.preventDefault();
            $(this).parent().remove()
        })
    </script>
@endsection
