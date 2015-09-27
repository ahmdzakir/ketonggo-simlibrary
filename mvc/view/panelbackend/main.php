<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?=Config::Title($page_title)?></title>

    <!-- Bootstrap Core CSS -->
    <link href="<?=URL::Base()?>assets/template/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    .page-header {
    padding-bottom: 9px;
    margin: 20px 0 20px;
    border-bottom: 1px solid #eee;
    }
    </style>
    <!-- MetisMenu CSS -->
    <link href="<?=URL::Base()?>assets/template/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="<?=URL::Base()?>assets/template/dist/css/timeline.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?=URL::Base()?>assets/template/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="<?=URL::Base()?>assets/template/bower_components/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?=URL::Base()?>assets/template/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- jQuery -->
    <script src="<?=URL::Base()?>assets/template/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?=URL::Base()?>assets/template/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?=URL::Base()?>assets/template/bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?=URL::Base()?>assets/template/dist/js/sb-admin-2.js"></script>

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
          <a class="navbar-brand" href="<?=URL::Base()?>"><?=Config::Title()?></a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="login.html"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <!-- EDIT MENU -->
            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                    <li>
                        <a href="<?=URL::Base("panelbackend/home")?>"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-sitemap fa-fw"></i> Halaman-halaman<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <?php $this->auth->GetMenuCms();?>
                        </ul>
                    </li>
                    <li><a href="<?=URL::Base("panelbackend/testimoni")?>"><i class="fa fa-dashboard fa-fw"></i> Testimoni</a></li>
                    <li>
                        <a href="#"><i class="fa fa-sitemap fa-fw"></i>Seting<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="<?=URL::Base("panelbackend/template_contents")?>">Template Contents</a></li>
                            <li><a href="<?=URL::Base("panelbackend/sponsor")?>">Sponsor</a></li>
                        </ul>
                    </li>
                    </ul>
                </div><!--/.nav-collapse -->
            </div>
            <!-- END EDIT MENU -->
        </nav>

  <?php echo $content;?>

    </div>
    <!-- /#wrapper -->

</body>

</html>
