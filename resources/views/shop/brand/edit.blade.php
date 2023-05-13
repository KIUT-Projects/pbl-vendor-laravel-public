@extends('layouts.admin')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <h5 class="card-header">Edit Brand</h5>
                <form method="POST" action="{{ route('brand.update', $brand->id) }}">
                    <input type="hidden" name="_method" value="PUT">
                    @csrf
                    <div class="card-body">

                        @include('layouts.admin.inc.form_error')

                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Brand Image</label>
                            <input type="text" class="form-control" placeholder="Brand image" name="image" value="{{$brand->image }}">
                        </div>

                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Brand Name</label>
                            <input type="text" class="form-control" placeholder="Brand Name" name="name" value="{{ $brand->name }}">
                        </div>
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Import image</label>
                            <input class="form-control" type="file" id="image" name="image" />
                        </div>

                        <div>
                            <button type="submit" class="btn btn-lg btn-success my-3">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
