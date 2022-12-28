@extends('admin.layouts.admin')
@section('title', "Show data for {$category->name}")
@section('current_page', 'Show Category')
@section('content')
    <div class="card">
        <div class="card-header">
            <h2 class="text-center my-2">Category Ditails</h2>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12  order-2 order-md-1">
                    <div class="row">
                        <div class="col-12 col-sm-4">
                            <div class="info-box bg-light ">
                                <div class="info-box-content">
                                    <span class="info-box-text text-center text-white">Category Name</span>
                                    <span class="info-box-number text-center text-white mb-0">{{ $category->name }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-4">
                            <div class="info-box bg-light ">
                                <div class="info-box-content ">
                                    <span class="info-box-text text-center text-white">Category Status</span>
                                    <span class="info-box-number text-center text-white mb-0"><label
                                            class="badge {{ $category->status[0] }}">{{ $category->status[1] }}</label></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-4">
                            <div class="info-box bg-light ">
                                <div class="info-box-content ">
                                    <span class="info-box-text text-center text-white">Category Icon</span>
                                    <span class="info-box-number text-center text-white mb-0"><?= $category->icon ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-4">
                            <div class="info-box bg-light ">
                                <div class="info-box-content ">
                                    <span class="info-box-text text-center text-white">Created Date</span>
                                    <span
                                        class="info-box-number text-center text-white mb-0">{{ $category->created_at }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-4">
                            <div class="info-box bg-light ">
                                <div class="info-box-content ">
                                    <span class="info-box-text text-center text-white">Update Date</span>
                                    <span
                                        class="info-box-number text-center text-white mb-0">{{ $category->updated_at }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <h4>Category Details</h4>
                            <div class="post">
                                <p>{{ $category->details }}</p>


                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- /.card-body -->
        </div>
    @endsection
