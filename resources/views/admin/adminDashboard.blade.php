<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="{{ asset("css/sb-admin-2.css")}}" rel="stylesheet">
    <link href="{{ asset("css/style.css")}}" rel="stylesheet">
</head>



<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">


    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-laugh-wink"></i>
            </div>
            <div class="sidebar-brand-text mx-3">Dashboard <sup>2</sup></div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item active">
            <a class="nav-link" href="index.html">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>


        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">

            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Custom Components:</h6>
                    <a class="collapse-item" href="buttons.html">Buttons</a>
                    <a class="collapse-item" href="cards.html">Cards</a>
                </div>
            </div>
        </li>

        <!-- Nav Item - Utilities Collapse Menu -->
        <li class="nav-item">

            <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                 data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Custom Utilities:</h6>
                    <a class="collapse-item" href="utilities-color.html">Colors</a>
                    <a class="collapse-item" href="utilities-border.html">Borders</a>
                    <a class="collapse-item" href="utilities-animation.html">Animations</a>
                    <a class="collapse-item" href="utilities-other.html">Other</a>
                </div>
            </div>
        </li>



        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="http://127.0.0.1:8000//dashboard/admin/user" >
                <i class="fas fa-fw fa-folder"></i>
                <span>users</span>
            </a>

        </li>

        <!-- Nav Item - Charts -->
        <li class="nav-item">
            <a class="nav-link" href="http://127.0.0.1:8000/dashboard/admin/skill">
                <i class="fas fa-fw fa-chart-area"></i>
                <span>skills</span></a>
        </li>

        <!-- Nav Item - Tables -->
        <li class="nav-item">
            <a class="nav-link" href="http://127.0.0.1:8000//dashboard/admin/city">
                <i class="fas fa-fw fa-table"></i>
                <span>Cities</span></a>
        </li>


        <li class="nav-item">
            <a class="nav-link" href="http://127.0.0.1:8000//dashboard/admin/company">
                <i class="fas fa-fw fa-table"></i>
                <span>Company</span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="http://127.0.0.1:8000/formation">
                <i class="fas fa-fw fa-table"></i>
                <span>Formation</span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="http://127.0.0.1:8000/jobs">
                <i class="fas fa-fw fa-table"></i>
                <span>Jobs</span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="http://127.0.0.1:8000/jobs">
                <i class="fas fa-fw fa-table"></i>
                <span>Representer Request</span></a>
        </li>



    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            @include('components.Navbar')

            <div class="container-fluid">

                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                    @foreach($users as $user)
                        <a data-toggle="modal" data-target="#addUserModal-{{ $user->id }}" class="btn btn-sm btn-outline-success">Add</a>
                    @endforeach
                </div>

                <div class="row">

                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            Total of users</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"></div>
                                    </div>

                                    <div class="col-auto">
                                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                    </div>

                                </div>
                                <h4>{{$usercount}}</h4>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                            Earnings (Annual)</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"></div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-info shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Tasks
                                        </div>
                                        <div class="row no-gutters align-items-center">
                                            <div class="col-auto">
                                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"></div>
                                            </div>
                                            <div class="col">
                                                <div class="progress progress-sm mr-2">
                                                    <div class="progress-bar bg-info" role="progressbar"
                                                         style="width: 20%" aria-valuenow="50" aria-valuemin="0"
                                                         aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Pending Requests Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                            Pending Requests</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-comments fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row">

                    <div class="row container-fluid">

                        <div class="custom-table container-fluid">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>avatar</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{$user->id}}</td>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>
                                            <div class="d-flex align-items-center gap-2">
                                                <form action="{{ route('user.destroy', ['user' => $user]) }}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="btn btn-danger" type="submit">Delete</button>
                                                </form>
                                                <a href="#" class="btn btn-warning" data-toggle="modal" data-target="#editUserModal-{{ $user->id }}">Update</a>
                                            </div>
                                        </td>

                                    </tr>
                                @endforeach


                            </table>

                        </div>
                        {{--                        {{$user->links()}}--}}



                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>


        </div>
        <!-- End of Content Wrapper -->

    </div>


    <!-- Bootstrap core JavaScript-->
    <script src="{{asset("jquery/jquery.min.js")}}"></script>
    <script src="{{asset("bootstrap/js/bootstrap.bundle.min.js")}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{asset("jquery-easing/jquery.easing.min.js")}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{asset("js/sb-admin-2.js")}}"></script>

    <!-- Page level plugins -->
    <script src="{{asset("/chart.js/Chart.min.js")}}"></script>

    <!-- Page level custom scripts -->
    <script src="{{asset("js/demo/chart-area-demo.js")}}"></script>
    <script src="{{asset("js/demo/chart-pie-demo.js")}}"></script>
</div>
</body>

</html>

@foreach($users as $user)
    <div class="modal fade" id="editUserModal-{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="editUserModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProjectModalLabel">Edit User id - {{$user->id}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('user.update', ['user' => $user->id]) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="projectName">Name : </label>
                            <input type="text" class="form-control" id="projectName" name="name" value="{{ $user->name }}" required>
                        </div>
                        <div class="form-group">
                            <label for="projectDescription">Email : </label>
                            <input type="email" class="form-control" id="projectDescription" name="email" value="{{ $user->email }}"  required  >
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach

@foreach($users as $user)
    <div class="modal fade" id="editUserModal-{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="addUserModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProjectModalLabel">Edit User id - {{$user->id}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('user.store', ['user' => $user->id]) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="projectName">Name : </label>
                            <input type="text" class="form-control" id="projectName" name="name" value="{{ $user->name }}" required>
                        </div>
                        <div class="form-group">
                            <label for="projectDescription">Email : </label>
                            <input type="email" class="form-control" id="projectDescription" name="email" value="{{ $user->email }}"  required  >
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach
