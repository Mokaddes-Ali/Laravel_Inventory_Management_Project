@extends('layouts.master')

@section('content')
<div class="card ">

    <div class="card-header d-flex w-36 h-11 ">
        <div class="mx-5 mt-2">
        <a href="{{ url('/brands/show') }}" class=""><button type="button" class="btn btn-info display-4">Go To List</button></a>
      </div>
        <div class="mx-5 mt-2 text-center display-6">
        Add Brand
    </div>
    </div>
       <div class="mx-5 mb-3 mt-3 col-md-10">

        <form method = "POST" action = "{{ url('/brands/submit') }}"  enctype="multipart/form-data">
            @csrf
            <div class="form-group col-md-8">
              <label for="exampleInputEmail1 " class="mb-2">BrandName</label>
              <input type="text" name = "brandName" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Brand Name">
            </div>

            <div class="form-group col-md-8">
                <label for="exampleInputPassword1" class="mb-2 mt-3">BrandImg</label>
                <input type="file"  name ="brandImg"  class="form-control" id="exampleInputPassword1" placeholder="Input a Image">
              </div>
            <button type="submit" class="btn btn-primary mt-3">Submit</button>
          </form>
        </div>
  </div>

@endsection
