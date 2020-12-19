@extends('layouts.backend-master')
@section('title','Home >> Manage Tutorials')
    
@section('content')

    @php
        $tutorials = \App\Models\Tutorial::paginate(10);

    @endphp

    <div class="col-md-12 mt-3">
        <table class="table table-striped table-inverse table-responsive">
            <thead class="thead-inverse">
                <tr>
                    <th>Serial</th>
                    <th>Title</th>
                    <th>Short Description</th>
                    <th colspan="3" class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tutorials as $tutorial)
                        <tr>
                                <td scope="row"> {{ $tutorial->id }}</td>
                                <td>{{ $tutorial->title }}</td>
                                <td>@php echo substr($tutorial->short_description,0,200); @endphp.....</td>
                                <td><a href="{{ route('view.tutorial',$tutorial->id) }}" class="btn btn-default"><span class="badge badge-pill badge-success py-2 px-2">View</span></a></td>
                                <td><a href="{{ route('edit.tutorial',$tutorial->id) }}" class="btn btn-default"><span class="badge badge-pill badge-warning py-2 px-2">Edit</span></a></td>
                                <td><a href="{{ route('delete.tutorial',$tutorial->id) }}" class="btn btn-default"><span class="badge badge-pill badge-danger py-2 px-2">Delete</span></a></td>
                        </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    

@endsection
