<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Reo 管理画面</title>

    <!-- Bootstrap Core CSS -->
    <link href="/css/admin/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="/css/admin/sb-admin.css" rel="stylesheet">

    <link href="/css/admin/admin.css?<?= date('YmdHis'); ?>" rel="stylesheet">

    <link href="/css/admin/modal.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="/css/admin/plugins/morris.css" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

    <script type="text/javascript" src="/js/admin/admin-init.js?<?= date('YmdHis'); ?>"></script>

    <link rel="shortcut icon" href="/img/favicon.ico">

    <!-- Custom Fonts -->
    <link href="https://netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/board-admin/">Reo 管理画面</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?= $currentUser['username']; ?><b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="/admin/users/logout"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <?= $this->element('admin_menu'); ?>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper" class="my-page-margin">

            <div class="container-fluid">

            <?= $this->fetch('content'); ?>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <!--<script src="/js/admin/jquery.js"></script>-->

    <!-- Bootstrap Core JavaScript -->
    <script src="/js/admin/bootstrap.min.js"></script>

</body>

</html>
