
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
                <div class="panel-heading d-flex align-items-center">
                    @can('category-create')
                    <a href="/category" class="btn btn-sm btn-primary me-5 mt-3 mb-3"><i class="fa fa-plus-circle"></i> Add New</a>
                    @endcan
                    <h2 class="mb-0 mx-5 me-5 mt-3">List Category</h2>
                    @can('category-create')
                    <a href="{{ url('/category-export1') }}" class="btn btn-success display-4 me-2 mt-3">Excel</a>
                    <a href="{{ url('/category-export2') }}" class="btn btn-success display-4 me-2 mt-3">CSV</a>
                    <a href="{{ url('/category-export3') }}" class="btn btn-success display-4 mt-3">PDF</a>
                    @endcan
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
                                    <ul class="action-list d-flex gap-2">
                                        <!-- Edit Button -->
                                        <li>
                                            <a href="{{ url('/category/edit', $category->id) }}" class="btn btn-primary btn-sm">
                                                <i class="fa fa-pencil-alt"></i>
                                            </a>
                                        </li>

                                        <!-- View Button -->
                                        <li>
                                            <a href="{{ route('category.dataShow', $category->id) }}" class="btn btn-info btn-sm">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                        </li>

                                        <!-- Delete Button -->
                                        <li>
                                            <a onclick="return confirm('Are You Sure Delete!')" href="{{ url('/delete/category', $category->id) }}" class="btn btn-danger btn-sm">
                                                <i class="fa fa-times"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </td>
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

