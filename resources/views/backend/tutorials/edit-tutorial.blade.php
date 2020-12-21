@extends('layouts.backend-master')
@section('title','Home >>Edit Tutorial')
    
@section('content')


@php
    $tutorial = Tutorial::find($id);
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
                <strong>
                  {{ $item }}
                  </strong>

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
{{-- here is hidden modal for resource adding --}}



    <div class="row input-row" >
        <div class="col-md-12 mt-2">
            <h5 class="card-header">Edit tutorial</h5>
        </div>

        {!! Form::open(['route'=>'update.tutorial', 'class'=>'col-md-12', 'files'=>true]) !!}
        @php
          echo(HTMLGenerator::generate_form_text_block($tutorial->title,['title','Title',['class'=>'labels-center']],['title']));
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

            @php
              echo(HTMLGenerator::generate_form_textarea_block($tutorial->short_description,['short_description','Short Description',
                                                          ['class'=>'labels-center']],['short_description']));
            @endphp

        <div class="col-md-12">
            <div class="form-group col-md-12 card input-div">
                {!! Form::label('content', 'Content', ['class'=>'labels-center']) !!}
                {!! Form::textarea('content', BackendHelper::insert_images_in_content($tutorial->content_bangla), ['class'=>'form-control']) !!}
            </div>
        </div>
        
        <div class="col-md-12">
            <div class="form-group col-md-12 input-div">
                {!! Form::label('paper', 'Select Paper', ['class'=>'labels-center']) !!}

                {!! Form::select('paper', BackendHelper::get_form_subject_array(),
                    $tutorial->paper,['class'=>'form-control','id'=>'subject']) !!}
            </div>
        </div>

        <div class="col-md-12 py-3  mt-3 mb-3" style="border-bottom: 5px solid red; ">
            {!! Form::label('syllabus_module', 'Syllabus Module', ['class'=>'labels text-center']) !!}

            {!! Form::select('syllabus_module', [BackendHelper::categorize_syllabus_module(Syllabus::all())['eco']], $tutorial->syllabus->module,['class'=>'form-control col-md-5 offset-md-4','id'=>'syllabus_module']) !!}
        </div>


        {{-- syllabus topic select --}}
        <div class="col-md-12 py-3  mt-3 mb-3" style="border-bottom: 5px solid red; ">
          {!! Form::label('syllabus_module_topic', 'Syllabus Topic Details', ['class'=>'labels text-center']) !!}

          {!! Form::select('syllabus_module_topic', [], true,['class'=>'form-control col-md-5 offset-md-4','id'=>'syllabus_module_topic']) !!}
      </div>

        <div class="col-md-12 card  py-2">
            <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap">Add Resource</button>
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

    <script>
        $(document).ready(function(){
            $('#subject').change(function(){
                $.ajax({
                    type: "get",
                    url: "/syllabus_modules",
                    data: $('#subject').val(),
                    //dataType: "dataType",
                    success: function (response) {
                        var keys = Object.keys(response);
                        var values = Object.values(response);
                        //console.log(response) 
                        var syllabus_module = null;
                        for (let [key, value] of Object.entries(response)) {
                            if(key === $('#subject').val()){
                                   syllabus_module = value;
                                    break;
                                }
                            }
                        
                       $("#syllabus_module").empty()
                        $.each(syllabus_module, function(key,value) {
                            $("#syllabus_module").append($("<option></option>")
                            .attr("value", value).text(value));
                            $("#syllabus_module").trigger('change')
                        });
                    }
                });
            })
//set default value for syllabus topic

          $.ajax({
              type: "get",
              url: "/syllabus_module_topics/"+$("#subject").val()+"/"+$("#syllabus_module").val(), 
              success: function (response) {
                //console.log(response);
                  var keys = Object.keys(response);
                  var values = Object.values(response);
                  var syllabus_module_topics = response;
                  $.each(syllabus_module_topics, function(key,value) {
                      $("#syllabus_module_topic").append($("<option></option>")
                      .attr("value", key).text(value));
                  });
              }
          })

//change event 
          $('#syllabus_module').on('change',(function(){
            $.ajax({
                type: "get",
                url: "/syllabus_module_topics/"+$("#subject").val()+"/"+$("#syllabus_module").val(),
                
                success: function (response) {
                    var keys = Object.keys(response);
                    var values = Object.values(response);
                    //console.log(response) 
                    
                    var syllabus_module_topic = response
                    $("#syllabus_module_topic").empty()
                  
                    
                    $.each(syllabus_module_topic, function(key,value) {
                      console.log(value)
//                      console.log(syllabus_module_topic)
                        $("#syllabus_module_topic").append($("<option></option>")
                        .attr("value", key).text(value));
                        
                      });
                    }
                  });
        })).trigger('change')
            

            $("#resource").click(function (e) {
                e.preventDefault()
                //perform error check

                //add element to the original dom
                $("#resource_preview").append(
                    '<div class="alert alert-warning alert-dismissible fade show mt-2" role="alert">'+
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
                    '<span aria-hidden="true">&times;</span>'+
                "</button>"+
                "<strong>Resource Type:</strong> <input name='resource_type[]' style='font-weight:bold; color:red; text-align:center' readonly=true value="+$("#resource_type").val()+">"+
                "<strong>Resource Link:</strong> <input name='resource_link[]' style='font-weight:bold; color:red;text-align:center'  readonly=true value='"+$('#resource_link').val()+"'>")+
                "</div>"
                
                
                    $('.modal').modal('hide')

                    
            })
        })
    </script>
     
     <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>

    <script>
          
        CKEDITOR.replace('content',{
            filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
          filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
          filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
          filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
        });

        //lfm standalone
       // $('#lfm').filemanager('image');
        var route_prefix = "/laravel-filemanager";
        $('#lfm').filemanager('image', {prefix: route_prefix});
    </script>
    
    

@endsection

