@extends('layouts.backend-master')

@section('content')
    <div class="col-md-12 mt-4 card py-2" >

        @php
            $syllabus = Syllabus::paginate(10);
        @endphp


        {!! Form::open(['route'=>'syllabus.add', 'class'=>' card py-2 px-2', 'style'=>'background-color:lightgreen']) !!}
        
        <div class="row">
            <div class="col-md-2 text-right">
                <div class="form-group">
                    {!! Form::label('subject', 'Subject',['class'=>'labels']) !!}
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group ">
                    {!! Form::select('subject', ['eco'=>'Economics & BD','acct'=>'Accounting'], 'eco',['class'=>'form-control']) !!}
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

    </div>

    <div class="col-md-12 card mt-3 py-2 px-2">
        <table class="table table-dark table-bordered table-striped">
            <tbody>
                <th>Subject</th>
                <th>Topic</th>
                <th>Module</th>

                @php
                    if ($syllabus!=null) {
                        foreach ($syllabus as $topic) {
                            echo "<tr>".
                                "<td>".$topic->subject."</td>".
                                "<td>".$topic->topic."</td>".
                                "<td>".$topic->module."</td>".

                                "</tr>";
                        }
                    }
                @endphp
                    

            </tbody>
        </table>
    </div>
@endsection