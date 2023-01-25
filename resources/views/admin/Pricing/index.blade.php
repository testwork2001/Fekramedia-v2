@extends('admin.layouts.admin')
@section('title', 'All Pricing')
@section('current_page', 'All Pricing')
@section('css')
    @include('admin.layouts.datatable-styling')
@endsection
@section('content')
    @include('admin.layouts.success')
    @include('admin.layouts.worining')
    <div class="card-header row justify-content-between">
        <h3 class="card-title col-12 col-md-8 my-1">All Pricing are Currently Available </h3>
        <div class="col-12 col-md-3 my-1 text-right">
            <a href="{{ route('pricing.create') }}" class=" btn btn-success">Add New
                <i class="fas fa-plus"></i></a>
        </div>
    </div>
    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th class="text-center">Pricing Name </th>
                    <th class="text-center">Icon</th>
                    <th class="text-center">Features</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Created Date</th>
                    <th class="text-center">Updated Date</th>
                    <th class="text-center">Opretions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($allPricing as $plan)
                    <tr>
                        <td class="text-center">{{ $plan->name }} </td>
                        <td class="text-center"><span class="text-white"><?= $plan->icon ?></span></td>
                        <td>
                            <ul>
                                @foreach (json_decode($plan->features) as $feature)
                                    <li>{{ $feature }}</li>
                                @endforeach
                            </ul>
                        </td>

                        <td class="text-center "><label class="badge {{ $plan->status[0] }}">{{ $plan->status[1] }}</label>
                        </td>
                        <td class="text-center">{{ $plan->created_at }}</td>
                        <td class="text-center">{{ $plan->updated_at }}</td>
                        <td class="text-center">
                            <a href="{{ route('pricing.edit', $plan->id) }}" class='btn btn-warning mb-1'>Edit <i
                                    class="fas fa-pencil-alt">
                                </i></a>
                            <form action="{{ route('pricing.destroy', $plan->id) }}" method="post" class="d-inline ">
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
@endsection
@section('js')
    @include('admin.layouts.datatable-scripts')
@endsection
