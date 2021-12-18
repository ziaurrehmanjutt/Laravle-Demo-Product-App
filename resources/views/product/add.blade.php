@extends('layouts.app')

@section('content')
<div class="container">
  <br>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2>Add Product</h2>
        </div>
        <div class="col-md-6">
            <!-- <div class="float-right"> -->
                <a style="float: right;" href="{{ route('product.index') }}" class="btn btn-primary">Back</a>
            <!-- </div> -->
        </div>
        <br>
        <div class="col-md-12">
            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-error" role="alert">
                    {{ session('error') }}
                </div>
            @endif
      <form action="{{ route('product.store') }}" method="POST">
        @csrf
        <div class="form-group">
          <label for="title">Title:</label>
          <input required type="text" class="form-control" id="title" name="title">
        </div>
        <div class="form-group">
          <label for="description">Description:</label>
          <textarea required name="description" class="form-control" id="description" rows="5"></textarea>
        </div>
        <div class="form-group">
        <label for="status">Price</label>
        <input required class="form-control" type="number" step="0.01" min="0" id="status" name="price"/>
        <!-- <select class="form-control" id="status" name="status">
          <option value="pending">Pending</option>
          <option value="completed">Completed</option>
        </select> -->
        </div>
        <button type="submit" class="btn btn-secondary float-right">Submit</button>
      </form>
        </div>
    </div>
</div>
@endsection