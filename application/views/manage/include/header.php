<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Comparison Tool</title>

    <link href="<?= ASSETSPATH ?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= ASSETSPATH ?>css/backend/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <!-- <link href="<?= ASSETSPATH ?>css/backend/plugins/morris.css" rel="stylesheet"> -->
    <link href="<?= ASSETSPATH ?>css/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/fixedheader/3.1.2/css/fixedHeader.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.bootstrap.min.css">
    <link href="<?= ASSETSPATH ?>css/backend/style.css" rel="stylesheet" type="text/css">

	<script src="<?= ASSETSPATH ?>js/jquery.js"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/manage/categories">Comparison Tool Admin</a>
            </div>

            <?php
            $is_user_loggedin = $this->session->userdata('userAccess');
            if (sizeof($is_user_loggedin) > 0)
            {
            ?>
                <ul class="nav navbar-right top-nav">
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $is_user_loggedin['username']; ?> <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="/manage/login/logout"><i class="fa fa-fw fa-power-off"></i> Log Out</a></li>
                        </ul>
                    </li>
                </ul>

                <div class="collapse navbar-collapse navbar-ex1-collapse">
                    <ul class="nav navbar-nav side-nav">
                        <li class="active">
                            <a href="index.html"><i class="fa fa-fw fa-camera"></i>&nbsp;Background</a>
                        </li>

                        <li class="active">
                            <a href="/manage/categories"><i class="fa fa-fw fa-th-list"></i>&nbsp;Manage Categories</a>
                        </li>
                    </ul>
                </div>
            <?php
            }
            else
            {
            ?>
                <style type="text/css">
                    #wrapper{
                        padding-left: 0px;
                    }
                </style>
            <?php
            }
            ?>
        </nav>
        <div class="col-lg-12 inner_wrapper">