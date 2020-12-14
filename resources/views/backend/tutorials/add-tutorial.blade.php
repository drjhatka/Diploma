@extends('layouts.backend-master')
@section('content')

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


    <div class="row input-row">

        <div class="col-md-12 mt-2">
            <h5 class="card-header">Add tutorials</h5>
        </div>

        {!! Form::open(['route'=>'store.tutorial', 'class'=>'col-md-12', 'files'=>true]) !!}
            <div class="col-md-12 mt-3">
                    <div class="form-group col-md-12 card input-div">
                        {!! Form::label('title', 'Title', ['class'=>'labels-center']) !!}
                        {!! Form::text('title', '', ['class'=>'form-control','placeholder'=>'Add title here (maximum 50 words)']) !!}
                    </div>
            </div>


            {{-- lfm standalone button --}}
            <div class="col-md-12">
              
              <div class="input-group">
              {!! Form::label('thumbnail', 'Add Post Image', ['class'=>'labels-center mr-3','style'=>'color:red']) !!}
                <span class="input-group-btn">
                  <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                    <i class="fa fa-picture-o"></i> Choose
                  </a>
                </span>
                <input id="thumbnail" class="form-control" type="text" name="filepath">
              </div>
              {{-- image preview --}}
              <div id="holder" class="img-thumbnail text-center mb-2" style="margin-top:15px;max-height:200px;"></div>
            </div>

        <div class="col-md-12">
            <div class="form-group col-md-12 card input-div">
                {!! Form::label('short_description', 'Short Description', ['class'=>'labels-center']) !!}
                {!! Form::textarea('short_description', '', ['class'=>'form-control','rows'=>3,'placeholder'=>'Add Description (Maximum 3 lines)']) !!}
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group col-md-12 card input-div">
                {!! Form::label('content', 'Content', ['class'=>'labels-center']) !!}
                {!! Form::textarea('content', '', ['class'=>'form-control']) !!}
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group col-md-12 input-div">
                {!! Form::label('paper', 'Select Paper', ['class'=>'labels-center']) !!}

                {!! Form::select('category', ['eco'=>'Economics','acct'=>'Accounting',
                    'bc'=>'Business Communication','om'=>'Organizational Management',
                    'law'=>'Law & Practice of Banking', 'mkt'=>"Marketing"],
                    true,['class'=>'form-control','id'=>'subject']) !!}
            </div>
        </div>


        <div class="col-md-12 py-3  mt-3 mb-3" style="border-bottom: 5px solid red; ">
            {!! Form::label('syllabus_topic', 'Syllabus Topic', ['class'=>'labels text-center']) !!}

            {!! Form::select('syllabus_topic', [BackendHelper::categorize_syllabus_topic(Syllabus::all())['eco']], true,['class'=>'form-control col-md-5 offset-md-4','id'=>'syllabus-topic']) !!}
        </div>

        <div class="col-md-12 card  py-2">
            <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap">Add Resource</button>
        </div>

        {{-- -resource preview --}}
        <div class="col-md-12" id="resource_preview">
            
        </div>

        <div class="col-md-12 mt-2 text-center">

            {!! Form::submit('Add Tutorial', ['class'=>'btn-primary col-md-4 mr-2']) !!}
        </div>

        {!! Form::close() !!}

    </div>

    <script>
        $(document).ready(function(){
            $('#subject').change(function(){
                $.ajax({
                    type: "get",
                    url: "/syllabus-topics",
                    data: $('#subject').val(),
                    //dataType: "dataType",
                    success: function (response) {
                        var keys = Object.keys(response);
                        var values = Object.values(response);
                        //console.log(response) 
                        var syllabus_topic = null;
                        for (let [key, value] of Object.entries(response)) {
                            if(key === $('#subject').val()){
                                   syllabus_topic = value;
                                    break;
                                }
                            }
                        
                       $("#syllabus-topic").empty()
                        $.each(syllabus_topic, function(key,value) {
                            $("#syllabus-topic").append($("<option></option>")
                            .attr("value", value).text(value));
                        });
                    }
                });
            })

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
