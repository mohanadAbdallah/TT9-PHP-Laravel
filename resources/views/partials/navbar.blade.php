<nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Classrooms
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{route('classrooms.index')}}">View All</a></li>
                        <li><a class="dropdown-item" href="{{route('classrooms.create')}}">Create</a></li>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Topics
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{route('topics.index')}}">View All</a></li>
                        <li><a class="dropdown-item" href="{{route('topics.create')}}">Create</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
