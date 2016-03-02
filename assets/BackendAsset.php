<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class BackendAsset extends AssetBundle
{
    public $sourcePath = '@vendor/almasaeed2010';

    public $css = [
        'adminlte/bootstrap/css/bootstrap.min.css',
        'adminlte/dist/css/AdminLTE.min.css',
        'adminlte/dist/css/skins/_all-skins.min.css',
        'adminlte/plugins/iCheck/flat/blue.css',
        'adminlte/plugins/morris/morris.css',
        'adminlte/plugins/jvectormap/jquery-jvectormap-1.2.2.css',
        'adminlte/plugins/datepicker/datepicker3.css',
        'adminlte/plugins/daterangepicker/daterangepicker-bs3.css',
        'adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css',
    ];
    public $js = [
        //'adminlte/js/AdminLTE/app.js',
        //'adminlte/plugins/jQuery/jQuery-2.1.3.min.js',
        'http://code.jquery.com/ui/1.11.2/jquery-ui.min.js',
        //'adminlte/bootstrap/js/bootstrap.min.js',
        // Morris.js charts
        'http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js',
        'adminlte/plugins/morris/morris.min.js',
        'adminlte/plugins/sparkline/jquery.sparkline.min.js',
        'adminlte/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js',
        'adminlte/plugins/jvectormap/jquery-jvectormap-world-mill-en.js',
        'adminlte/plugins/knob/jquery.knob.js',
        'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js',
        'adminlte/plugins/daterangepicker/daterangepicker.js',
        'adminlte/plugins/datepicker/bootstrap-datepicker.js',
        'adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js',
        'adminlte/plugins/slimScroll/jquery.slimscroll.min.js',
        'adminlte/plugins/fastclick/fastclick.min.js',
        'adminlte/dist/js/app.min.js',
        //'adminlte/dist/js/pages/dashboard.js',
        'adminlte/dist/js/demo.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];
}