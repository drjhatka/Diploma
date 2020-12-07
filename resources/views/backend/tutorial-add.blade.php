@extends('layouts.backend-master')
@section('content')
    <div class="row input-row">

        <div class="col-md-12 mt-2">        
            <h5 class="card-header">Add tutorials</h5>            
        </div>

        {!! Form::open(['route'=>'tutorial.post', 'class'=>'col-md-12']) !!}
            <div class="col-md-12 mt-3">
                    <div class="form-group col-md-12 card input-div">
                        {!! Form::label('title', 'Title', ['class'=>'labels-center']) !!}
                        {!! Form::text('title', '', ['class'=>'form-control','placeholder'=>'Add title here (maximum 50 words)']) !!}      
                    </div>
            </div>

        <div class="col-md-12">
            <div class="form-group col-md-12 card input-div">
                {!! Form::label('short_description', 'Short Description', ['class'=>'labels-center']) !!}
                {!! Form::textarea('short-description', '', ['class'=>'form-control','rows'=>3,'placeholder'=>'Add Description (Maximum 3 lines)']) !!}
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
                    true,['class'=>'form-control']) !!}
            </div>
        </div>


        <div class="col-md-6">
            {!! Form::label('syllabus_topic', 'Syllabus Topic', ['class'=>'labels']) !!}

            {!! Form::select('category', ['eco'=>'Economics','accnt'=>'Accounting'], true,['class'=>'form-control']) !!}
        </div>
       
        <div class="col-md-12 mt-2 text-center">

            {!! Form::submit('Preview', ['class'=>'btn-primary col-md-4 mr-2']) !!}
            {!! Form::submit('Add Tutorial', ['class'=>'btn-primary col-md-4 mr-2']) !!}
        </div>

        {!! Form::close() !!}
    
    </div>
@endsection