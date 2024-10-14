@extends('layouts.master')

@section('content')
<div class="card ">
    <div class="card-header d-flex w-36 h-11 ">
        <div class="mx-5 mt-2">
        <a href="{{ url('/brands') }}" class=""><button type="button" class="btn btn-danger">Add Brand</button></a>
      </div>
        <div class="mx-5 mt-2 text-center display-6">
        Brand List
    </div>
    </div>
<table class="table table-striped table-responsive table-dark">
    <thead>
      <tr>
        <th scope="col">Id</th>
        <th scope="col">BrandName</th>
        <th scope="col">BrandImage</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($all as $row)
      <tr>
        <th scope="row">{{ $row['id'] }}</th>
        <td>{{ $row['brandName'] }}</td>
        <td>
            <img src="{{ asset('BrandImage/'.$row['brandImg']) }}" alt="img" width="50" height="50">
        </td>
        <td>
            <a class="btn btn-primary btn-sm," href="{{ url('/brands/edit' , $row -> id) }}"><i class="fa fa-pencil-alt"></i></a>
            <a class="btn btn-danger btn-lg" onclick="return confirm('Are You Sure Delete!')" href="{{ url('/delete', $row -> id)}}"><i class="fa fa-times"></i></a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>

  {{ $all->links() }}

@endsection

