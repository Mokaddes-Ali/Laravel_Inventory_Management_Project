
 @extends('layouts.master')

@section('content')
     <style>
         .panel {
             font-family: 'Raleway', sans-serif;
             padding: 0;
             border: none;

         }
         .panel .panel-heading {

             padding: 15px;
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
             margin-right: 10px;
         }
         .panel .panel-heading .form-horizontal .form-control {
             display: inline-block;
             width: 80px;
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
             font-size: 17px;
             font-weight: 700;
             position: relative;
             padding: 12px;
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
             padding: 10px;
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
         .panel .panel-body .table tbody .action-list li a:hover { box-shadow: 0 0 5px #ddd; }
         .panel .panel-footer {
             color: #fff;
             background: #535353;
             font-size: 16px;
             line-height: 33px;
             padding: 25px 15px;
             border-radius: 0;
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
                             <a href="#" class="btn btn-sm btn-primary pull-left"><i class="fa fa-plus-circle"></i> Add New</a>
                         </div>
                     </div>
                 </div>
                 <div class="panel-body table-responsive">
                     <table class="table">
                         <thead>
                             <tr>
                                <tr>
                                    <th class="border">ID</th>
                                    <th class="border px-2 py-1">Name</th>
                                    <th class="border px-2 py-1">Remarks</th>
                                    <th class="border  px-2 py-1">Status</th>
                                    <th class="border px-2 py-1">Actions</th>
                                    <th class="border px-2 py-1">View</th>
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
                                        <li><a href="#" class="btn btn-primary"><i class="fa fa-pencil-alt"></i></a></li>
                                        <li><a href="#" class="btn btn-danger"><i class="fa fa-times"></i></a></li>
                                    </ul>
                                </td>
                                 <td><a href="#" class="btn btn-sm btn-success"><i class="fa fa-eye"></i></a></td>
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

