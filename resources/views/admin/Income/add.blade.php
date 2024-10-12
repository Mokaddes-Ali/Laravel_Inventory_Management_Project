@extends('layouts.master')

@section('content')
<div class="card ">
    <div class="card-header w-36 h-11">
        Add Project Description
    </div>
    @if(session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
     @endif
        <form method = "POST" action = "{{ url('/income/submit') }}"  enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              <label for="exampleInputEmail1">Client Name</label>
              <select class="form-select" name="project_id" aria-label="Default select example">
                <option selected>Select Project Name</option>
                @foreach ($all as $row )
                <option value="{{$row->id}}">{{$row['project_name']}}</option>
                @endforeach
              </select>
            </div>

            <div class="form-group">
                <label for="exampleInputAddress1">Date</label>
                <input type="date"  name = "date"  class="form-control" id="exampleInputAddress1" placeholder="Choose Date">
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                   const today = new Date().toISOString().split('T')[0];
                   document.querySelector('input[name="date"]').value = today;
                   });
                </script>
            </div>

            <div class="form-group">
                <label for="exampleInputproject_name">Income Amount</label>
                <input type="text"  name = "income_amount" class="form-control" id="exampleInputproject_name" aria-describedby="emailHelp" placeholder="Enter Income Amount">
              </div>
              <div class="form-group">
                <label for="exampleInputAddress1">Transition Acount</label>
                <input type="text"  name = "bank_account_id" value="CASH"  class="form-control" id="exampleInputAddress1" placeholder=" Enter Bank Account Id">
              </div>

            <div class="form-group">
                <label>Note</label>
                <textarea class="form-control" name="note" id="" cols="30" rows="6" required autocomplete="off">
                </textarea>
              </div>
            <button type="submit" class="btn btn-primary mt-3">Add</button>
          </form>
  </div>



@endsection
