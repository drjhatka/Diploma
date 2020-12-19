@extends('layouts.backend-master')
@section('title','Home >> Manage Tutorials')
@section('content')

@php
    $tutorial =Tutorial::find($id);
@endphp
<div class="col-md-12">
    <div class="row">
        <div class="col-md-12 card mt-2">
            <div class="card-header text-center">Title</div>
            <p class="text-center">{{  $tutorial->title}}</p>
        </div>

        <div class="col-md-12 card mt-2">
            <div class="card-header text-center">Tutorial Image</div>
            <p class="text-center"><img src="{{  $tutorial->post_image}}" alt="" width="250" height="250"></p>
        </div>

        <div class="col-md-12 card mt-2">
            <div class="card-header text-center">Short Description</div>
            <p class="text-center">{{  $tutorial->short_description}}</p>
        </div>

        <div class="col-md-12 card mt-2">
            <div class="card-header text-center">Content</div>

            <p class="text-center">@php echo $tutorial->content_bangla; @endphp</p>
        </div>

        <div class="col-md-12 card mt-2 py-2 bg-light">
            <div class="row">
                <div class="col-md-4 ">
                    <strong>Subject </strong><a href="#" style="font-size:14px" class="badge badge-primary">
                                            {{  BackendHelper::get_subject_fullname($tutorial->syllabus->subject)}}</a>
                </div>
                <div class="col-md-6">
                    <strong>Syllabus Module </strong><a href="#"  style="font-size:14px" class="badge badge-primary">
                        {{  $tutorial->syllabus->topic}}</a>
                </div>
            </div>
        </div>

        <div class="col-md-12 card mt-2">
                <div class="card-header"><strong>Resources</strong></div>
                {{-- check if this tutorial has any resources available --}}
                @if ($tutorial->resources !=null)
                @foreach ($tutorial->resources as $item)
                <div class="row mt-2"  style="border: 1px solid black">
                        <div class="col-md-4 offset-1 mt-2" >
                            <span class="badge badge-pill badge-primary col-md-4 offset-md-2">{{ $item->type }}</span>
                        </div>
                        <div class="col-md-7 mt-2 mb-2" >
                            <span class="badge badge-pill badge-primary col-md-6">{{ $item->link }}</span>

                        </div>
                    </div>
                    @endforeach
                @endif
            
        </div>
    </div>
</div>

@endsection
