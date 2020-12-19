<nav class="navbar navbar-expand-sm navbar-light bg-light">
    <a class="navbar-brand" href="{{ route('backend.dashboard') }}">Home</a>
    <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId"
        aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavId">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Manage Syllabus</a>
                        <div class="dropdown-menu" aria-labelledby="dropdownId">
                            <a class="dropdown-item" href="{{ route('add.syllabus') }}"> <i class="fas fa-plus-circle"></i>    Add</a>
                            <a class="dropdown-item" href=""> <i class="fas fa-edit"></i>           Edit</a>
                            <a class="dropdown-item" href=""> <i class="fas fa-minus-circle"></i>   Delete</a>
                        </div>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="dropdownId"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Manage Tutorial</a>

                        <div class="dropdown-menu" aria-labelledby="dropdownId">
                            <a class="dropdown-item" href="{{ route('add.tutorial') }}"> <i class="fas fa-plus-square    "></i>  Add         </a>
                            <a class="dropdown-item" href="{{ route('manage.tutorial') }}"> <i class="fas fa-wrench    "></i>  Edit        </a>
                            <a class="dropdown-item" href="{{ route('delete.tutorial') }}"> <i class="fas fa-trash-alt    "></i>   Delete      </a>
                        </div>
            </li>

        </ul>
        <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="text" placeholder="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
    </div>
</nav>
