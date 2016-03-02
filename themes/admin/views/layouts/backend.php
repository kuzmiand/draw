<?php
use yii\helpers\Html;
use app\assets\BackendAsset;
use yii\helpers\Url;
use webvimark\modules\UserManagement\components\GhostMenu;
use webvimark\modules\UserManagement\UserManagementModule;


/* @var $this \yii\web\View */
/* @var $content string */

BackendAsset::register($this);
$controller_name = Yii::$app->controller->id;
$action_name = Yii::$app->controller->action->id;

?>

<?php $this->beginPage() ?>

<!DOCTYPE html>

<html lang="<?= Yii::$app->language ?>">

    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>

        <?php $this->head() ?>

        <!-- FontAwesome 4.3.0 -->
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons 2.0.0 -->
        <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo Url::base() ?>/css/backend.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>

    <body class="skin-blue sidebar-mini">

        <?php $this->beginBody() ?>

             <div class="wrapper">

                <header class="main-header">
                    <!-- Logo -->
                    <a href="index2.html" class="logo">
                        <!-- mini logo for sidebar mini 50x50 pixels -->
                        <span class="logo-mini"><b>EAV</b></span>
                        <!-- logo for regular state and mobile devices -->
                        <span class="logo-lg"><b>Admin</b> DRAW</span>
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
                                <li class="dropdown user user-menu">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <span class="glyphicon glyphicon-user"></span>
                                        <span class="hidden-xs">
                                            <?//= Yii::$app->user->identity->username ?>
                                        </span>
                                    </a>

                                    <ul class="dropdown-menu">
                                        <!-- User image -->
                                        <li class="user-header">
                                            <p>
                                                <?//= Yii::$app->user->identity->username ?>
                                                <small>Member since Nov. 2012</small>
                                            </p>
                                        </li>
                                        <!-- Menu Body -->
                                        <li class="user-body">
                                            <div class="col-xs-4 text-center">
                                                <a href="#">Followers</a>
                                            </div>
                                            <div class="col-xs-4 text-center">
                                                <a href="#">Sales</a>
                                            </div>
                                            <div class="col-xs-4 text-center">
                                                <a href="#">Friends</a>
                                            </div>
                                        </li>
                                        <!-- Menu Footer-->
                                        <li class="user-footer">
                                            <div class="pull-left">
                                                <a href="#" class="btn btn-default btn-flat">Profile</a>
                                            </div>
                                            <div class="pull-right">
                                                <a href="#" class="btn btn-default btn-flat">Sign out</a>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <!-- Control Sidebar Toggle Button -->
                                <!--<li>
                                    <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                                </li>-->
                            </ul>
                        </div>
                    </nav>
                </header>
                <!-- Left side column. contains the logo and sidebar -->
                <aside class="main-sidebar">
                    <!-- sidebar: style can be found in sidebar.less -->
                    <section class="sidebar">

                        <ul class="sidebar-menu">
                            <li class="treeview <?= in_array($controller_name, ['backend/draw-country', 'backend/draw-league', 'backend/draw-season', 'backend/draw-team', 'backend/draw-game'])? 'active':'';?>">
                                <a href="#">
                                    <i class="fa fa-gears"></i><span><?= Yii::t('app', 'Settings') ?></span><i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <li class="<?= $controller_name=='backend/draw-country' ? 'active':'';?>"><a href="<?= Url::toRoute('/backend/draw-country') ?>"><i class="fa fa-circle-o"></i> <?= Yii::t('app', 'Countries') ?></a></li>
                                    <li class="<?= $controller_name=='backend/draw-league'? 'active':'';?>"><a href="<?= Url::toRoute('/backend/draw-league') ?>"><i class="fa fa-circle-o"></i> <?= Yii::t('app', 'Leagues') ?></a></li>
                                    <li class="<?= $controller_name=='backend/draw-season'? 'active':'';?>"><a href="<?= Url::toRoute('/backend/draw-season') ?>"><i class="fa fa-circle-o"></i> <?= Yii::t('app', 'Seasons') ?></a></li>
                                    <li class="<?= $controller_name=='backend/draw-team'? 'active':'';?>"><a href="<?= Url::toRoute('backend/draw-team') ?>"><i class="fa fa-circle-o"></i> <?= Yii::t('app', 'Teams') ?></a></li>
                                    <li class="<?= $controller_name=='backend/draw-game'? 'active':'';?>"><a href="<?= Url::toRoute('backend/draw-game') ?>"><i class="fa fa-circle-o"></i> <?= Yii::t('app', 'Games') ?></a></li>
                                </ul>
                            </li>
                            <li class="treeview <?= $controller_name=='backend/draw-chart' ? 'active':'';?>">
                                <a href="#">
                                    <i class="fa fa-pie-chart"></i><span><?= Yii::t('app', 'Charts') ?></span><i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu ">
                                    <li class="<?= $controller_name=='backend/draw-chart' ? 'active':'';?>"><a href="<?= Url::toRoute('backend/draw-chart') ?>"><i class="fa fa-circle-o"></i> <?= Yii::t('app', 'Charts Season') ?></a></li>
                                    <li class="<?= $controller_name=='backend/draw-chart' ? 'active':'';?>"><a href="<?= Url::toRoute('backend/draw-chart') ?>"><i class="fa fa-circle-o"></i> <?= Yii::t('app', 'Charts Team') ?></a></li>
                                </ul>
                            </li>
                        </ul>

                    </section>
                    <!-- /.sidebar -->
                </aside>

                <!-- Content Wrapper. Contains page content -->
                <div class="content-wrapper" style="  padding: 15px 20px; background-color: white;">

                    <?= $content ?>

                </div><!-- /.content-wrapper -->

                <footer class="main-footer">
                    <div class="pull-right hidden-xs">
                        <b>Version</b> 2.0
                    </div>
                    <strong>Draw &copy; 2016 </strong> All rights reserved.
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
                            <ul class='control-sidebar-menu'>
                                <li>
                                    <a href='javascript::;'>
                                        <i class="menu-icon fa fa-birthday-cake bg-red"></i>
                                        <div class="menu-info">
                                            <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>
                                            <p>Will be 23 on April 24th</p>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href='javascript::;'>
                                        <i class="menu-icon fa fa-user bg-yellow"></i>
                                        <div class="menu-info">
                                            <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>
                                            <p>New phone +1(800)555-1234</p>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href='javascript::;'>
                                        <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>
                                        <div class="menu-info">
                                            <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>
                                            <p>nora@example.com</p>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href='javascript::;'>
                                        <i class="menu-icon fa fa-file-code-o bg-green"></i>
                                        <div class="menu-info">
                                            <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>
                                            <p>Execution time 5 seconds</p>
                                        </div>
                                    </a>
                                </li>
                            </ul><!-- /.control-sidebar-menu -->

                            <h3 class="control-sidebar-heading">Tasks Progress</h3>
                            <ul class='control-sidebar-menu'>
                                <li>
                                    <a href='javascript::;'>
                                        <h4 class="control-sidebar-subheading">
                                            Custom Template Design
                                            <span class="label label-danger pull-right">70%</span>
                                        </h4>
                                        <div class="progress progress-xxs">
                                            <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href='javascript::;'>
                                        <h4 class="control-sidebar-subheading">
                                            Update Resume
                                            <span class="label label-success pull-right">95%</span>
                                        </h4>
                                        <div class="progress progress-xxs">
                                            <div class="progress-bar progress-bar-success" style="width: 95%"></div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href='javascript::;'>
                                        <h4 class="control-sidebar-subheading">
                                            Laravel Integration
                                            <span class="label label-waring pull-right">50%</span>
                                        </h4>
                                        <div class="progress progress-xxs">
                                            <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href='javascript::;'>
                                        <h4 class="control-sidebar-subheading">
                                            Back End Framework
                                            <span class="label label-primary pull-right">68%</span>
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
                                        <input type="checkbox" class="pull-right" checked />
                                    </label>
                                    <p>
                                        Some information about this general settings option
                                    </p>
                                </div><!-- /.form-group -->

                                <div class="form-group">
                                    <label class="control-sidebar-subheading">
                                        Allow mail redirect
                                        <input type="checkbox" class="pull-right" checked />
                                    </label>
                                    <p>
                                        Other sets of options are available
                                    </p>
                                </div><!-- /.form-group -->

                                <div class="form-group">
                                    <label class="control-sidebar-subheading">
                                        Expose author name in posts
                                        <input type="checkbox" class="pull-right" checked />
                                    </label>
                                    <p>
                                        Allow the user to show his name in blog posts
                                    </p>
                                </div><!-- /.form-group -->

                                <h3 class="control-sidebar-heading">Chat Settings</h3>

                                <div class="form-group">
                                    <label class="control-sidebar-subheading">
                                        Show me as online
                                        <input type="checkbox" class="pull-right" checked />
                                    </label>
                                </div><!-- /.form-group -->

                                <div class="form-group">
                                    <label class="control-sidebar-subheading">
                                        Turn off notifications
                                        <input type="checkbox" class="pull-right" />
                                    </label>
                                </div><!-- /.form-group -->

                                <div class="form-group">
                                    <label class="control-sidebar-subheading">
                                        Delete chat history
                                        <a href="javascript::;" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
                                    </label>
                                </div><!-- /.form-group -->
                            </form>
                        </div><!-- /.tab-pane -->
                    </div>
                </aside><!-- /.control-sidebar -->
                <!-- Add the sidebar's background. This div must be placed
                     immediately after the control sidebar -->
                <div class='control-sidebar-bg'></div>

        </div><!-- ./wrapper -->

        <?php $this->endBody() ?>

        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>
            $.widget.bridge('uibutton', $.ui.button);
        </script>

        <script src="<?php echo Url::base() ?>/js/backend.js"></script>

    </body>

</html>

<?php $this->endPage() ?>



