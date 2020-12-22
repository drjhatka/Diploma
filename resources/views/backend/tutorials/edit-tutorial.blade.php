@extends('layouts.backend-master')
@section('title','Home >>Edit Tutorial')
    
@section('content')

@php
    $tutorial = Tutorial::find($id);

    $placeholder_array = ['title'=>'maximum 250 words','short_des'=>'Optional - maximum 3 lines', 'content'=>'enter content text'];    
    
    $attr_array_title = [ 'label_for'=>'title',
                          'label_text'=>'Title',
                          'label_options'=>['class'=>'labels-center'],
                          'input_name'=>'title',
                          'input_options'=>['class'=>'form-control']
                          ];
    $attr_array_short_des = [ 
                            'label_for'=>'short_description',
                            'label_text'=>'Short Description',
                            'label_options'=>['class'=>'labels-center'],
                            'input_name'=>'short_description',
                            'input_options'=>['class'=>'form-control']
                            ];
    $attr_array_content = [ 
                              'label_for'=>'content',
                              'label_text'=>'Content',
                              'label_options'=>['class'=>'labels-center'],
                              'input_name'=>'content',
                              'input_options'=>['class'=>'form-control']
                              ];

    $attr_array_select_subject =[
                                'label_for'=>'paper',
                                'label_text'=>'Select Subject',
                                'label_options'=>['class'=>'labels-center'],
                                'input_name'=>'paper',
                                'input_options'=>['class'=>'form-control','id'=>'subject']
    ];

    $attr_array_select_module =[
                                'label_for'=>'syllabus_module',
                                'label_text'=>'Syllabus Module',
                                'label_options'=>['class'=>'labels-center'],
                                'input_name'=>'syllabus_module',
                                'input_options'=>['class'=>'form-control col-md-5 offset-md-4','id'=>'syllabus_module']
    ];
    $attr_array_select_module_topic =[
                                'label_for'=>'syllabus_module_topic',
                                'label_text'=>'Syllabus_Topic',
                                'label_options'=>['class'=>'labels-center'],
                                'input_name'=>'syllabus_module_topic',
                                'input_options'=>['class'=>'form-control col-md-5 offset-md-4','id'=>'syllabus_module_topic']
    ];
@endphp

@if (!$errors->isEmpty())
            <div class="alert alert-danger text-center alert-dismissible fade show" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span class="sr-only">Close</span>
              </button>

              <strong>
                  Behold!!! The following errors occured!!
                </strong>
            </div>
            @foreach ($errors->all() as $item)

              <div class="alert alert-danger fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  <span class="sr-only">Close</span>
                </button>
                <strong>{{ $item }}</strong>
              </div>
              @endforeach
            @endif       
{{-- here is hidden modal for resource adding --}}

  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">New message</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form>
            <div class="form-group">
              <label for="type" class="col-form-label">Resource Type</label>
              <select name="type" class="form-control" id="resource_type">
                  <option value="book">Book</option>
                  <option value="youtube">Youtube</option>
                  <option value="torrent">Torrent</option>
                  <option value="article">Article</option>
                </select>
            </div>
            <div class="form-group">
              <label for="message-text" class="col-form-label">Link</label>
              <input class="form-control" id="resource_link">
            </div>
          </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="resource">Add Resource</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
{{-- start input form --}}
    <div class="row input-row" >
        <div class="col-md-12 mt-2">
            <h5 class="card-header bg-light">Edit tutorial</h5>
        </div>
        {!! Form::open(['route'=>'update.tutorial', 'class'=>'col-md-12', 'files'=>true]) !!}
          @php
            echo(HTMLGenerator::generate_form_text_block($tutorial->title,$attr_array_title,$placeholder_array['title']));
          @endphp
            
            {{-- lfm standalone button --}}
              <div class="col-md-12">
                <div class="input-group">
                {!! Form::label('thumbnail', 'Edit Post Image', ['class'=>'labels-center mr-3','style'=>'color:red']) !!}
                  <span class="input-group-btn">
                    <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                      <i class="fa fa-picture-o"></i> Choose
                    </a>
                  </span>
                  <input name="post_image" value="{{$tutorial->post_image }}"  id="thumbnail" class="form-control" type="text" name="filepath">
                </div>
                {{-- image preview --}}
                <div id="holder" class="img-thumbnail text-center mb-2" style="margin-top:15px;max-height:200px;"><img width="200" height="100" src="{{ $tutorial->post_image }}" alt=""></div>
              </div>
            {{-- lfm standalone button --}}

            @php
              echo(HTMLGenerator::generate_form_textarea_block($tutorial->short_description,
                                                                $attr_array_short_des,$placeholder_array['short_des'],4));

              echo(HTMLGenerator::generate_form_textarea_block(BackendHelper::insert_images_in_content($tutorial->content_bangla),
                                                                $attr_array_content,$placeholder_array['content'],4,));

              echo(HTMLGenerator::generate_dropdown_block(BackendHelper::get_form_subject_array(),
                                                                $attr_array_select_subject, $tutorial->paper));

              echo(HTMLGenerator::generate_dropdown_block(BackendHelper::categorize_syllabus_module(Syllabus::all())['eco'],
                                                                $attr_array_select_module, $tutorial->syllabus->module));

              echo(HTMLGenerator::generate_dropdown_block([], $attr_array_select_module_topic, true));
              
            @endphp


        <div class="col-md-12 card  py-2">
            <button type="button" class="btn btn-outline-danger" data-toggle="modal" 
                          data-target="#exampleModal" data-whatever="@getbootstrap">Edit Resource</button>
        </div>

        {{-- -resource preview --}}
        <div class="col-md-12" id="resource_preview">
            @if ($tutorial->resources!=null)
                @foreach ($tutorial->resources as $item)
                    <div class="alert alert-warning alert-dismissible fade show mt-2" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                        </button>
                        <strong>Resource Type:</strong> 
                                <input name='resource_type[]' style='font-weight:bold; color:red; text-align:center' 
                                                    readonly=true value="{{ $item->type }}">
                        <strong>Resource Link:</strong> 
                                <input name='resource_link[]' style='font-weight:bold; color:red;text-align:center'  readonly=true 
                                    value="{{ $item->link }}">
                    </div>
                @endforeach  
            @endif   
        </div>

        {!! Form::hidden('id', $tutorial->id) !!}

        <div class="col-md-12 mt-2 text-center">
            {!! Form::submit('Update Tutorial', ['class'=>'btn-primary col-md-4 mr-2']) !!}
        </div>

        {!! Form::close() !!}

        @if (session()->has('tutorial_update_success'))
          <script>
            alert("<?php echo session()->get('tutorial_update_success'); ?>");
          </script>   
        @endif
    </div>

    <script src="{{ asset('js/tutorial.js') }}"></script> 
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
@endsection

