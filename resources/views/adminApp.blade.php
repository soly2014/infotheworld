<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>{{ $title }}</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.4 -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.3/jquery.min.js"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons 2.0.0 -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{{asset('assets/plugins/select2/select2.min.css')}}">

    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets/dist/css/AdminLTE.min.css') }}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{ asset('assets/dist/css/skins/_all-skins.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/lightbox/css/lightbox.css') }}">

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/custom.css') }}">


    <!-- iCheck -->

<!-- Morris chart -->

<!-- jvectormap -->

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/dist/fonts/fonts-fa.css') }}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/dist/css/bootstrap-rtl.min.css')}}">


<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script lightbox="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script lightbox="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- jQuery 2.1.4 -->
  
</head>
<body class="skin-blue sidebar-mini">
<div class="wrapper">
    <header class="main-header">
        <!-- Logo -->
        <a href="{{ action('AdminController@home') }}" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>I</b>fo</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg">Info the world</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- User Account: style can be found in dropdown.less -->
                    @if(Auth::user())
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="{{ asset("assets/images/user.png" )}}" class="user-image" alt="User Image">
                                <span class="hidden-xs">{{ Auth::user()->username }}</span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header">

                                    <img src="{{ asset("assets/images/user.png" )}}" class="img-circle"
                                         alt="User Image">

                                    <p>
                                        {{ Auth::user()->name }}
                                        <small>Member since {{ Auth::user()->created_at }}</small>
                                    </p>
                                </li>
                                <li class="user-footer">
                                    {{--<div class="pull-right">--}}
                                    {{--<a href="###########"--}}
                                    {{--class="btn btn-default btn-flat">Profile</a>--}}
                                    {{--</div>--}}
                                    <div class="pull-left">
                                        <a href="{{ action('AdminLogin@logout') }}"
                                           class="btn btn-default btn-flat">Sign
                                            out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                @endif
                <!-- Control Sidebar Toggle Button -->
                    <li>
                        <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- sidebar menu: : style can be found in sidebar.less -->

            <ul class="sidebar-menu">
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-paragraph"></i>
                        <span>المقالات </span>
                        <i class="fa fa-angle-left pull-left"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{ action('AdminController@getArticles') }}"><i
                                        class="fa fa-paragraph"></i>جميع المقالات</a></li>
                        <li><a href="{{ action('AdminController@addArticle') }}"><i
                                        class="fa fa-paragraph"></i>اضافة مقاله جديده</a></li>
                    </ul>
                </li>
                @if(\Illuminate\Support\Facades\Auth::user()->type == 1)
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-globe"></i>
                            <span>الدول والمدن </span>
                            <i class="fa fa-angle-left pull-left"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="{{ action('AdminController@getCountriesData') }}"><i
                                            class="fa fa-globe"></i>رؤية الجميع</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-info-circle"></i>
                            <span>قسم متقلب فى الرئيسيه</span>
                            <i class="fa fa-angle-left pull-left"></i>
                        </a>
                        <ul class="treeview-menu">


                            {{--<li><a href="#"><i--}}
                            {{--class="fa fa-info-circle"></i>البيانات الموجوده حالياً</a></li>--}}
                            <li><a href="{{ action('AdminController@addHometext') }}"><i class="fa fa-info-circle"></i>تحديث
                                    القسم</a></li>

                        </ul>
                    </li>

                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-info-circle"></i>
                            <span>قسم من نحن</span>
                            <i class="fa fa-angle-left pull-left"></i>
                        </a>
                        <ul class="treeview-menu">


                            {{--<li><a href="#"><i--}}
                            {{--class="fa fa-info-circle"></i>البيانات الموجوده حالياً</a></li>--}}
                            <li><a href="{{ action('AdminController@addAbout') }}"><i
                                            class="fa fa-info-circle"></i>تحديث البيانات</a></li>

                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-envelope-o"></i>
                            <span>البريد</span>
                            <i class="fa fa-angle-left pull-left"></i>
                        </a>
                        <ul class="treeview-menu">


                            {{--<li><a href="#"><i--}}
                            {{--class="fa fa-info-circle"></i>البيانات الموجوده حالياً</a></li>--}}
                            <li><a href="{{ action('AdminController@getContacts') }}"><i
                                            class="fa fa-envelope-o"></i>رؤية الجميع</a></li>

                        </ul>
                    </li>

                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-cogs"></i>
                            <span> الاعدادات</span>
                            <i class="fa fa-angle-left pull-left"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="{{ action('AdminController@editTitleEmail') }}"><i
                                            class="fa fa-cogs"></i>تحديث عنوان وبريد الموقع</a></li>
                            <li><a href="{{ action('AdminController@editMetaDesc') }}"><i
                                            class="fa fa-cogs"></i>ال meta description للرئيسيه</a></li>
                            <li><a href="{{ action('AdminController@editMetaKeywords') }}"><i
                                            class="fa fa-cogs"></i>ال meta keywords للرئيسيه</a></li>
                            <li><a href="{{ action('AdminController@countryMetaDesc') }}"><i
                                            class="fa fa-cogs"></i>ال meta description للدول والمدن</a></li>
                            <li><a href="{{ action('AdminController@countryMetaKey') }}"><i
                                            class="fa fa-cogs"></i>ال meta keywords للدول والمدن</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-picture-o"></i>
                            <span> الاعلانات</span>
                            <i class="fa fa-angle-left pull-left"></i>
                        </a>
                        <ul class="treeview-menu">
                            {{--<li><a href="#"><i--}}
                            {{--class="fa fa-picture-o"></i>رؤية جميع الاعلانات</a></li>--}}
                            <li><a href="{{ action('AdminController@getAdsRows') }}"><i
                                            class="fa fa-picture-o"></i>الموجود فى قاعدة البيانات</a></li>
                            <li><a href="{{ action('AdminController@addAd') }}"><i
                                            class="fa fa-picture-o"></i>اضافة كود جديد</a></li>

                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-terminal"></i>
                            <span>شروط الاستخدام</span>
                            <i class="fa fa-angle-left pull-left"></i>
                        </a>
                        <ul class="treeview-menu">
                            {{--<li><a href="#"><i--}}
                            {{--class="fa fa-picture-o"></i>رؤية جميع الاعلانات</a></li>--}}
                            <li><a href="{{ action('AdminController@getTerms') }}"><i
                                            class="fa fa-terminal"></i>الموجود فى قاعدة البيانات</a></li>
                            <li><a href="{{ action('AdminController@addTerms') }}"><i
                                            class="fa fa-terminal"></i>اضافة شروط استخدام جديده</a></li>

                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-archive"></i>
                            <span>الارشفه</span>
                            <i class="fa fa-angle-left pull-left"></i>
                        </a>
                        <ul class="treeview-menu">
                            

                            <li><a href="{{ url('admin/archive') }}"><i
                                            class="fa fa-archive"></i>ارشف الان</a></li>
                            <li><a href="{{ url('admin/archive/seearchives') }}"><i
                                            class="fa fa-archive"></i> رؤيه المؤرشف حديثا </a></li>

                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-users"></i>
                            <span>المشرفين</span>
                            <i class="fa fa-angle-left pull-left"></i>
                        </a>
                        <ul class="treeview-menu">
                            {{--<li><a href="#"><i--}}
                            {{--class="fa fa-picture-o"></i>رؤية جميع الاعلانات</a></li>--}}
                            <li><a href="{{ action('AdminController@getAllUsers') }}"><i
                                            class="fa fa-users"></i>رؤية الجميع</a></li>
                            <li><a href="{{ action('AdminController@addNewUser') }}"><i
                                            class="fa fa-user-plus"></i>اضافة مشرف جديد</a></li>

                        </ul>
                    </li>
                @endif

            </ul>


        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <br/><br/><br/>
        <div id="content-wrapper">
            @yield('adminContent')
        </div>
    </div>


    <!-- right col (We are only adding the ID to make the widgets sortable)-->
    <section class="col-lg-5 connectedSortable">


    </section><!-- right col -->
</div><!-- /.row (main row) -->

</section><!-- /.content -->
</div><!-- /.content-wrapper -->
<footer class="main-footer">
    <strong> IeaSoft&copy;</strong> All rights
    reserved.
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
        <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
        <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
        <!-- Home tab content -->
        <div class="tab-pane" id="control-sidebar-home-tab">
            <h3 class="control-sidebar-heading">Recent Activity</h3>
            <ul class="control-sidebar-menu">
                <li>
                    <a href="javascript::;">
                        <i class="menu-icon fa fa-birthday-cake bg-red"></i>

                        <div class="menu-info">
                            <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                            <p>Will be 23 on April 24th</p>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="javascript::;">
                        <i class="menu-icon fa fa-user bg-yellow"></i>

                        <div class="menu-info">
                            <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                            <p>New phone +1(800)555-1234</p>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="javascript::;">
                        <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

                        <div class="menu-info">
                            <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                            <p>nora@example.com</p>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="javascript::;">
                        <i class="menu-icon fa fa-file-code-o bg-green"></i>

                        <div class="menu-info">
                            <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                            <p>Execution time 5 seconds</p>
                        </div>
                    </a>
                </li>
            </ul><!-- /.control-sidebar-menu -->

            <h3 class="control-sidebar-heading">Tasks Progress</h3>
            <ul class="control-sidebar-menu">
                <li>
                    <a href="javascript::;">
                        <h4 class="control-sidebar-subheading">
                            Custom Template Design
                            <span class="label label-danger pull-left">70%</span>
                        </h4>

                        <div class="progress progress-xxs">
                            <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="javascript::;">
                        <h4 class="control-sidebar-subheading">
                            Update Resume
                            <span class="label label-success pull-left">95%</span>
                        </h4>

                        <div class="progress progress-xxs">
                            <div class="progress-bar progress-bar-success" style="width: 95%"></div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="javascript::;">
                        <h4 class="control-sidebar-subheading">
                            Laravel Integration
                            <span class="label label-warning pull-left">50%</span>
                        </h4>

                        <div class="progress progress-xxs">
                            <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="javascript::;">
                        <h4 class="control-sidebar-subheading">
                            Back End Framework
                            <span class="label label-primary pull-left">68%</span>
                        </h4>

                        <div class="progress progress-xxs">
                            <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
                        </div>
                    </a>
                </li>
            </ul><!-- /.control-sidebar-menu -->

        </div><!-- /.tab-pane -->
        <!-- Stats tab content -->
        <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div><!-- /.tab-pane -->
        <!-- Settings tab content -->
        <div class="tab-pane" id="control-sidebar-settings-tab">
            <form method="post">
                <h3 class="control-sidebar-heading">General Settings</h3>

                <div class="form-group">
                    <label class="control-sidebar-subheading">
                        Report panel usage
                        <input type="checkbox" class="pull-left" checked>
                    </label>

                    <p>
                        Some information about this general settings option
                    </p>
                </div><!-- /.form-group -->

                <div class="form-group">
                    <label class="control-sidebar-subheading">
                        Allow mail redirect
                        <input type="checkbox" class="pull-left" checked>
                    </label>

                    <p>
                        Other sets of options are available
                    </p>
                </div><!-- /.form-group -->

                <div class="form-group">
                    <label class="control-sidebar-subheading">
                        Expose author name in posts
                        <input type="checkbox" class="pull-left" checked>
                    </label>

                    <p>
                        Allow the user to show his name in blog posts
                    </p>
                </div><!-- /.form-group -->

                <h3 class="control-sidebar-heading">Chat Settings</h3>

                <div class="form-group">
                    <label class="control-sidebar-subheading">
                        Show me as online
                        <input type="checkbox" class="pull-left" checked>
                    </label>
                </div><!-- /.form-group -->

                <div class="form-group">
                    <label class="control-sidebar-subheading">
                        Turn off notifications
                        <input type="checkbox" class="pull-left">
                    </label>
                </div><!-- /.form-group -->

                <div class="form-group">
                    <label class="control-sidebar-subheading">
                        Delete chat history
                        <a href="javascript::;" class="text-red pull-left"><i class="fa fa-trash-o"></i></a>
                    </label>
                </div><!-- /.form-group -->
            </form>
        </div><!-- /.tab-pane -->
    </div>
</aside><!-- /.control-sidebar -->
<!-- Add the sidebar's background. This div must be placed
     immediately after the control sidebar -->
<div class="control-sidebar-bg"></div>
</div><!-- ./wrapper -->

<!-- Bootstrap 3.3.4 -->
<script src="{{asset('assets/bootstrap/js/bootstrap.min.js')}}"></script>

<!-- Bootstrap 3.3.4 -->
<script src="{{asset('assets/plugins/select2/select2.full.min.js')}}"></script>


{{--<script lightbox="{{asset('plugins/js/script.js')}}"></script>--}}


<script src="{{ asset('assets/lightbox/js/lightbox.js') }}"></script>


<!-- dataTables -->
<script src="{{ url('/') }}/assets/plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="{{ url('/') }}/assets/plugins/datatables/dataTables.bootstrap.min.js"
        type="text/javascript"></script>

<link href="{{ url('/') }}/assets/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript">   $(function () {
        $("#table").dataTable();
    });
</script>

<script src="{{ asset('assets/plugins/ckeditor/ckeditor.js') }}"></script>
<script>
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('editor1');

</script>
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button);
</script>

<!-- AdminLTE App -->
<script src="{{ asset('assets/dist/js/app.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('assets/dist/js/demo.js') }}"></script>
<!-- Page script -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $(".select2").select2();

  });
</script>
</body>
</html>
