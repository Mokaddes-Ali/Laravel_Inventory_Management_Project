@extends('layouts.master')

@section('content')
<div class="card ">
    <div class="card-header d-flex w-36 h-11 ">
        <div class="mx-5 mt-2">
        <a href="{{ url('/customer/show') }}" class=""><button type="button" class="btn btn-info display-4">Go To List</button></a>
      </div>
        <div class="mx-5 mt-2 text-center display-6">
        Add Cuitomer
    </div>
    </div>

        <form method = "POST" action = "{{ url('/customer/submit') }}"  enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              <label for="exampleInputEmail1">Name</label>
              <input type="text" name = "name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Name">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Email</label>
                <input type="email"  name = "email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Email">
              </div>

              <div class="form-group">
                <label for="exampleInputEmail1">Mobile</label>
                <input type="Number"  name = "number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Mobile Number">
              </div>

            <div class="form-group">
              <label for="exampleInputAddress1">Address</label>
              <input type="text"  name = "address"  class="form-control" id="exampleInputAddress1" placeholder="Address">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Image</label>
                <input type="file"  name = "pic"  class="form-control" id="exampleInputPassword1" placeholder="Input a Image">
              </div>
            <button type="submit" class="btn btn-primary mt-3">Submit</button>
          </form>
  </div>

@endsection
