<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>SOF</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="hold-transition skin-blue sidebar-collapse sidebar-mini">
    <div class="wrapper">
        <header class="main-header">
            <a href="javascript:" class="logo">
                <span class="logo-mini"><b>SOF</b></span>
                <span class="logo-lg"><b>SOF</b></span>
            </a>
            <nav class="navbar navbar-static-top">
                <a href="javascript:" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <li class="dropdown user user-menu">
                            <a href="javascript:" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="{{ asset('images/user2-160x160.jpg') }}" class="user-image" alt="User Image">
                                <span class="hidden-xs">{{Auth::user()->name}}</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="user-header">
                                    <img src="{{ asset('images/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
                                </li>
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="javascript:" class="btn btn-default btn-flat">Profile</a>
                                    </div>
                                    <div class="pull-right">
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                        <a href="{{ route('logout') }}" 
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();" 
                                            class="btn btn-default btn-flat">Sign out
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript:" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        
        <aside class="main-sidebar">
            <section class="sidebar">
                <div class="user-panel">
                    <div class="pull-left image">
                        <img src="{{ asset('images/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
                    </div>
                    <div class="pull-left info">
                        <p>SOF</p>
                        <a href="javascript:"><i class="fa fa-circle text-success"></i> Online</a>
                    </div>
                </div>
                <form action="javascript:" method="get" class="sidebar-form">
                    <div class="input-group">
                        <input type="text" name="q" class="form-control" placeholder="Search...">
                        <span class="input-group-btn">
                     <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                     </button>
                     </span>
                    </div>
                </form>
                <ul class="sidebar-menu" data-widget="tree">
                    <li class="header">MAIN NAVIGATION</li>
                    @hasanyrole('admin|ministry|province')
                        <li class="reports treeview">
                            <a href="javascript:">
                                <i class="fa fa-pie-chart"></i> <span>{{ trans('menu.report') }}</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <!-- 
                                <li class="school-report">
                                    <a href="{{ url('/') }}/report/school">
                                        <i class="fa fa-circle-o"></i> {{ trans('menu.report.schools') }}
                                    </a>
                                </li>
                                -->
                                <li class="effectivenes-report">
                                    <a href="{{ url('/') }}/report/effectiveness">
                                        <i class="fa fa-circle-o"></i> {{ trans('menu.report.effectivenes') }}
                                    </a>
                                </li>
                                <li class="total-report">
                                    <a href="{{ url('/') }}/report/total">
                                        <i class="fa fa-circle-o"></i> {{ trans('menu.report.totals') }}
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endrole
                    <li class="evaluation">
                        <a href="{{ route('evaluation.index') }}">
                            <i class="fa fa-th"></i> <span>{{ trans('menu.evaluation') }}</span>
                        </a>
                    </li>
                    @role('admin')
                    <li class="settings treeview">
                        <a href="javascript:">
                            <i class="fa fa-industry"></i> <span>{{ trans('menu.settings') }}</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="schools">
                                <a href="{{ route('school.index') }}">
                                    <i class="fa fa-circle-o"></i> {{ trans('menu.schools') }}
                                </a>
                            </li>
                            <li class="questions">
                                <a href="{{ route('question.index') }}">
                                    <i class="fa fa-circle-o"></i> {{ trans('menu.questions') }}
                                </a>
                            </li>
                            <li class="villages">
                                <a href="{{ route('village.index') }}">
                                    <i class="fa fa-circle-o"></i> {{ trans('menu.villages') }}
                                </a>
                            </li>
                            <li class="communes">
                                <a href="{{ route('commune.index') }}">
                                    <i class="fa fa-circle-o"></i> {{ trans('menu.communes') }}
                                </a>
                            </li>
                            <li class="districts">
                                <a href="{{ route('district.index') }}">
                                    <i class="fa fa-circle-o"></i> {{ trans('menu.districts') }}
                                </a>
                            </li>
                            <li class="provinces">
                                <a href="{{ route('province.index') }}">
                                    <i class="fa fa-circle-o"></i> {{ trans('menu.provinces') }}
                                </a>
                            </li>
                            <li class="zones">
                                <a href="{{ route('zone.index') }}">
                                    <i class="fa fa-circle-o"></i> {{ trans('menu.zones') }}
                                </a>
                            </li>
                            <li class="levels">
                                <a href="{{ route('level.index') }}">
                                    <i class="fa fa-circle-o"></i> {{ trans('menu.levels') }}
                                </a>
                            </li>
                        </ul>
                    </li>
                    @endrole

                    @role('admin|ministry|province|district|commune')
                        <li class="securities treeview">
                            <a href="javascript:">
                                <i class="fa fa-users"></i> <span>{{ trans('menu.securities') }}</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li class="users">
                                    <a href="{{ route('user.index') }}"><i class="fa fa-circle-o"></i> {{ trans('menu.users') }}</a>
                                </li>
                                @role('admin')
                                <li class="roles">
                                    <a href="{{ route('role.index') }}"><i class="fa fa-circle-o"></i> {{ trans('menu.roles') }}</a>
                                </li>
                                <li class="permissions">
                                    <a href="{{ route('permission.index') }}"><i class="fa fa-circle-o"></i> {{ trans('menu.permissions') }}</a>
                                </li>
                                @endrole
                            </ul>
                        </li>
                    @endrole
                </ul>
            </section>
        </aside>

        <div class="content-wrapper">
            @yield('content')
        </div>
        @include('layouts.partial.modal')
        <footer class="main-footer">
            <div class="pull-right hidden-xs">
                <b>Version</b> 1.0.1
            </div>
            <strong>Copyright &copy; 2020 <a href="javascript:">SOF</a>.</strong> All rights reserved.
        </footer>
    </div>
    <script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>