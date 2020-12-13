@extends('layouts.backend-master')

@section('content')
{{-- validaton error display --}}

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif


{{-- title --}}
    <div class="col-md-12 card bg-info mt-2 text-center" style="color: white" >
        <h4>Add Syllabus Topic</h4>
    </div>
    <div class="col-md-12 mt-4 card py-2" >


        {!! Form::open(['route'=>'store.syllabus', 'class'=>' card py-2 px-2',
                                            'style'=>'background-color:lightgreen']) !!}

        <div class="row">
            <div class="col-md-2 text-right">
                <div class="form-group">
                    {!! Form::label('subject', 'Subject',['class'=>'labels']) !!}
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group ">
                    {!! Form::select('subject', ['eco'=>'Economics & BD','acct'=>'Accounting','bc'=>'Business Communication',
                                    'mkt'=>'Marketing','law'=>'Banking Law & Practice','om'=>'Organizational Management'], 'eco',['class'=>'form-control']) !!}
                </div>
            </div>
        </div>{{-- end row --}}

        <div class="row">
            <div class="col-md-2 text-right">
                <div class="form-group">
                    {!! Form::label('topic', 'Topic',['class'=>'labels']) !!}
                </div>
            </div>

            <div class="col-md-8">
                <div class="form-group ">
                    {!! Form::text('topic', '', ['class'=>'form-control']) !!}
                </div>
            </div>
        </div>{{-- end row --}}

        <div class="row">
            <div class="col-md-2 text-right">
                <div class="form-group">
                    {!! Form::label('module', 'Module',['class'=>'labels']) !!}
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group ">
                    @php
                        $module_array = array();
                        foreach (range('A','Z') as $key => $value) {
                            $module_array[$value]=$value;
                        }

                    @endphp
                    {!! Form::select('module', $module_array, 'A', ['class'=>'form-control']) !!}
                </div>
            </div>
        </div>{{-- end row --}}

        <div class="row">
            <div class="col-md-10 offset-2">
                <div class="form-group">
                    {!! Form::submit('Add Topic', ['class'=>'btn btn-primary col-md-4']) !!}
                </div>

            </div>
        </div>



        {!! Form::close() !!}

        {{-- syllabus view --}}

        @if (session()->has('success'))
        <script>
            alert('<?php echo(session()->get("success")); ?>');
        </script>
        @endif

    </div>

@endsection
