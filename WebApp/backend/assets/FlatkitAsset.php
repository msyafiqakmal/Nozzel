<?php

namespace backend\assets;

use yii\web\AssetBundle;

class FlatkitAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/animate.css/animate.min.css',
        'css/glyphicons/glyphicons.css',
        'css/font-awesome/css/font-awesome.min.css',
        'css/material-design-icons/material-design-icons.css',
        'css/devicon-master/devicon.min.css',
        'css/devicon-master/devicon-colors.css',
        'css/bootstrap/dist/css/bootstrap.css',
        'css/app.min.css',
        'css/font.css',

        'js/jquery/plugins/integration/bootstrap/3/dataTables.bootstrap.js',
        'js/jquery/plugins/integration/bootstrap/3/dataTables.bootstrap.css',

        'js/libs/OwlCarousel/assets/owl.carousel.min.css',
        'js/libs/OwlCarousel/assets/owl.theme.default.min.css',

        'js/jquery/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css',
        'js/jquery/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.dark.css',

        'css/style.css',

    ];
    public $js = [
        'js/jquery/jquery/dist/jquery.js',
        'js/jquery/tether/dist/js/tether.min.js',
        'js/jquery/bootstrap/dist/js/bootstrap.js',
        'js/jquery/underscore/underscore-min.js',
        'js/jquery/jQuery-Storage-API/jquery.storageapi.min.js',
        'js/jquery/PACE/pace.min.js',
        'js/scripts/config.lazyload.js',
        'js/scripts/palette.js',
        'js/scripts/ui-load.js',
        'js/scripts/ui-jp.js',
        'js/scripts/ui-include.js',
        'js/scripts/ui-device.js',
        'js/scripts/ui-form.js',
        'js/scripts/ui-nav.js',
        //'js/scripts/ui-screenfull.js',

        'js/scripts/ui-scroll-to.js',
        'js/scripts/ui-toggle-class.js',

        'js/app.js',

        'js/jquery/jquery-pjax/jquery.pjax.js',
        'js/scripts/ajax.js',

        'js/libs/typedjs/typed.min.js',
        'js/libs/OwlCarousel/owl.carousel.min.js',

        'js/libs/chart.js/dist/Chart.min.js',

        'js/jquery/datatables/media/js/jquery.dataTables.min.js',

        
        'js/jquery/moment/moment.js',
        'js/jquery/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js'




    ];
    public $depends = [
       'yii\web\YiiAsset',
    //  'yii\bootstrap\BootstrapPluginAsset',
        'depends' => 'yii\web\JqueryAsset'
    ];

    public $jsOptions = [ 'position' => \yii\web\View::POS_HEAD ];

}