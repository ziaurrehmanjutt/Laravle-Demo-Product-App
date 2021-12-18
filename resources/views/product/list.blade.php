
@extends('layouts.app')

@section('content')
<div class="container">
  <br>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2>Product List</h2>
        </div>
        <div class="col-md-6">
            <!-- <div class="float-right"> -->
                <a href="{{ route('product.create') }}" class="btn btn-primary float-right" style="float: right;"><i class="fa fa-plus"></i> Add new Product</a>
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
                <div class="alert alert-danger" role="alert">
                    {{ session('error') }}
                </div>
            @endif
            <table class="table table-bordered">
        <thead class="thead-light">
          <tr>
            <th width="5%">#</th>
            <th>Product Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($todos as $todo)
              <tr>
              <th>{{ $todo->id }}</th>
              <td>{{ $todo->title }}</td>
              <td>{{ $todo->description }}</td>
              <td>{{ $todo->price }}</td>
              <td>
                <div class="action_btn" style="text-align: right;">
                 
                  <div class="action_btn margin-left-10">
                    <form action="{{ route('product.destroy', $todo->id)}}" method="post">
                      @csrf
                      @method('DELETE')
                      <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                      <a href="{{ route('product.edit', $todo->id)}}" class="btn btn-warning btn-sm">Edit</a>
                      <a href="{{ route('product.show', $todo->id)}}" class="btn btn-primary btn-sm">View</a>
                    </form>
                  </div>
                </div>
              </td>
            </tr>
          @empty
              <tr>
              <td colspan="4"><center>No data found</center></td>
            </tr>
          @endforelse
        </tbody>
      </table>
        </div>
    </div>
</div>
@endsection