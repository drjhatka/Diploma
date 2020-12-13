@extends('layouts.backend-master')

@section('content')
    <div class="col-md-12 mt-4 card py-2" >
        <div id="accordion">
        {{-- create a multiple collapsible buttons for each functionality --}}

            {{-- syllabus menus --}}
            <div class="card text-center">
                    <div class="card-header" id="headingOne">
                        <h5 class="mb-0">
                            <button class="btn display-block" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    <span style="font-weight: bold; color:blue;"> Manage Syllabus </span>  <i class="fas fa-arrow-alt-circle-down"></i>

                            </button>
                        </h5>
                    </div>

                    <div id="collapseOne" class="collapse show py-2 px-2" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-body text-center px-2">
                            <a href="{{ route('add.syllabus') }}" class="btn btn-outline-danger mr-2"> <i class="fas fa-plus-square"></i> Add Syllabus Topic</a>
                            <a href="" class="btn btn-outline-danger mr-2"> <i class="fas fa-edit    "></i> Edit Syllabus Topic</a>
                            <a href="" class="btn btn-outline-danger"> <i class="fas fa-trash-alt"></i> Delete Syllabus topic</a>
                        </div>
                    </div>
            </div>


            {{-- tutorial menus --}}
            <div class="card">
                    <div class="card-header text-center" id="headingTwo">
                        <h5 class="mb-0">
                            <button class="btn" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseOne">
                                <span style="font-weight: bold;color:blue;"> Manage Tutorial </span>  <i class="fas fa-arrow-alt-circle-down"></i>

                            </button>
                        </h5>
                    </div>

                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                        <div class="card-body text-center px-2">
                            <a href="{{ route('add.tutorial') }}" class="btn btn-outline-danger mr-2"> <i class="fas fa-plus-square"></i> Add Tutorial</a>
                            <a href="" class="btn btn-outline-danger mr-2"> <i class="fas fa-edit    "></i> Edit Tutorial</a>
                            <a href="" class="btn btn-outline-danger"> <i class="fas fa-trash-alt"></i> Delete Tutorial</a>
                        </div>
                    </div>
            </div>


            {{-- news menu --}}
            <div class="card">
              <div class="card-header  text-center" id="headingThree">
                <h5 class="mb-0">
                    <button class="btn" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseOne">
                       <span style="font-weight: bold;color:blue;"> Manage News </span>  <i class="fas fa-plus" style="color: blue"></i>
                    </button>
                </h5>
              </div>
              <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                    <div class="card-body text-center px-2">
                        <a href="" class="btn btn-outline-danger mr-2"> <i class="fas fa-plus-square"></i> Add Tutorial</a>
                        <a href="" class="btn btn-outline-danger mr-2"> <i class="fas fa-edit    "></i> Edit Tutorial</a>
                        <a href="" class="btn btn-outline-danger"> <i class="fas fa-trash-alt"></i> Delete Tutorial</a>
                    </div>

              </div>
            </div>
          </div>




    </div>
@endsection
