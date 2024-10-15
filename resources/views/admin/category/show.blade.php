
 @extends('layouts.master')

@section('content')
     <style>
         .panel {
             font-family: 'Raleway', sans-serif;
             padding: 0;
             border: none;

         }
         .panel .panel-heading {

             padding: 5px;
             border-radius: 0;
         }
         .panel .panel-heading .btn {
             color: #fff;
             background-color: #000;
             font-size: 14px;
             font-weight: 600;
             padding: 7px 15px;
             border: none;
             border-radius: 0;
             transition: all 0.3s ease 0s;
         }
         .panel .panel-heading .btn:hover {
             box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
         }
         .panel .panel-heading .form-horizontal .form-group {
             margin: 0;
         }
         .panel .panel-heading .form-horizontal label {
             color: #fff;
             margin-right: 4px;
         }
         .panel .panel-heading .form-horizontal .form-control {
             display: inline-block;
             width: 20px;
             border: none;
             border-radius: 0;
         }
         .panel .panel-heading .form-horizontal .form-control:focus {
             box-shadow: none;
             border: none;
         }


         .panel .panel-body {
             padding: 0;
             border-radius: 0;
         }
         .panel .panel-body .table thead tr th {
             color: #fff;
             background: #8D8D8D;
             font-size: 15px;
             font-weight: 600;
             border-bottom:cadetblue;
         }
         .panel .panel-body .table thead tr th:nth-of-type(1) { width: 50px; }
         .panel .panel-body .table thead tr th:nth-of-type(2) { width: 20%; }
         .panel .panel-body .table thead tr th:nth-of-type(3) { width: 40%; }
         .panel .panel-body .table tbody tr td {
             color: #555;
             background: #fff;
             font-size: 15px;
             font-weight: 500;
             padding: 4px;
             vertical-align: middle;
             border-color: #e7e7e7;
         }
         .panel .panel-body .table tbody tr:nth-child(odd) td { background: #f5f5f5; }
         .panel .panel-body .table tbody .action-list {
             padding: 0;
             margin: 0;
             list-style: none;
         }
         .panel .panel-body .table tbody .action-list li { display: inline-block; }
         .panel .panel-body .table tbody .action-list li a {
             color: #fff;
             font-size: 20px;
             line-height: 28px;
             height: 28px;
             width: 32px;
             border-radius: 100%;
             padding: 0;
             border-radius: 0;
             transition: all 0.3s ease 0s;
         }


    .pagination {
        display: flex;
        justify-content: center;
        padding: 1rem 0;
        height: 10px;
    }



     </style>

 <div class="">
     <div class="row">
         <div class="col-md-offset-1 col-md-11">
             <div class="panel">
                 <div class="panel-heading">
                     <div class="row">
                         <div class="col-sm-12 col-xs-12">
                             <a href="#" class="btn mt-3 mb-3  btn-sm btn-primary pull-left"><i class="fa fa-plus-circle"></i> Add New</a>
                         </div>
                     </div>
                 </div>
                 <div class="panel-body ">
                     <table class="table">
                         <thead>
                             <tr>
                                <tr>
                                    <th class="border">ID</th>
                                    <th class="border">Name</th>
                                    <th class="border ">Remarks</th>
                                    <th class="border  ">Status</th>
                                    <th class="border ">Actions</th>
                                    {{-- <th class="border ">View</th> --}}
                                </tr>
                             </tr>
                         </thead>
                         <tbody>
                            @foreach ($all as $category)
                             <tr>

                                 <td class="border ">{{ $category->id }}</td>
                                 <td class="border  px-2 py-1">{{ $category->name }}</td>
                                 <td class="border  px-2 py-1">{{ $category->remarks }}</td>
                                 <td class="border border-gray-300 px-2 py-1">{{ $category->status ? 'Active' : 'Inactive' }}</td>
                                 <td>
                                    <ul class="action-list">
                                        <li><a href="{{ url('/categories/edit' , $category-> id) }}" class="btn btn-primary"><i class="fa fa-pencil-alt"></i></a></li>
                                        <li><a onclick="return confirm('Are You Sure Delete!')" href="{{ url('/delete', $category -> id)}}"  class="btn btn-danger" ><i class="fa fa-times"></i></a></li>
                                    </ul>
                                </td>
                                 {{-- <td><a href="#" class="btn btn-sm btn-success"><i class="fa fa-eye"></i></a></td> --}}
                             </tr>
                                @endforeach
                             <tr>
                         </tbody>
                     </table>


                        {{ $all->links() }}

                 </div>
                 </div>
             </div>
         </div>
     </div>
 </div>

@endsection

