@extends('layouts.master')

@section('content')
<div class="card ">
    <div class="card-header d-flex w-36 h-11 ">
        <div class="mx-5 mt-2">
            @can('brand-create')
        <a href="{{ url('/brands') }}" class=""><button type="button" class="btn btn-danger">Add Brand</button></a>
        @endcan
      </div>

        <div class="mx-5 mt-2 text-center display-6">
        Brand List
    </div>

           <a href="{{ url('/brand-export1') }}" class="mx-2 mt-3"><button type="button" class="btn btn-success display-4">Excel</button></a>
            <a href="{{ url('/brand-export2') }}" class="mt-3 mx-2"><button type="button" class="btn btn-success display-4">CSV</button></a>
            <a href="{{ url('/brand-export3') }}" class="mt-3 mx-2"><button type="button" class="btn btn-success display-4">PDF</button></a>

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
            <!-- View Button -->
            <a href="{{ route('brands.dataShow', $row->id) }}" class="btn btn-info btn-sm" title="View">
                <i class="bi bi-eye"></i>
            </a>
            @can('brand-edit')

            <!-- Edit Button -->
            <a class="btn btn-primary btn-sm" href="{{ url('/brands/edit', $row->id) }}" title="Edit">
                <i class="fa fa-pencil-alt"></i>
            </a>
            @endcan

            @can('brand-delete')

            <!-- Delete Button -->
            <a class="btn btn-danger btn-sm" onclick="return confirm('Are You Sure Delete!')" href="{{ url('/delete', $row->id) }}" title="Delete">
                <i class="fa fa-times"></i>
            </a>
            @endcan
        </td>

      </tr>
      @endforeach
    </tbody>
  </table>

  {{ $all->links() }}

@endsection

