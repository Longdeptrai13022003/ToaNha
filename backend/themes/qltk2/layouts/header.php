<?php
/** @var $this View */
/** @var $dataCVToiHan */

use yii\helpers\Html;
use yii\web\View;
use common\models\User;
?>

<!-- BEGIN HEADER -->
<div class="page-header -i navbar navbar-fixed-top">
    <!-- BEGIN HEADER INNER -->
    <div class="page-header-inner">
        <!-- BEGIN LOGO -->
        <div class="page-logo">
            <a href="<?=Yii::$app->urlManager->createUrl('site/index')?>" class="text-default">
                <?=Html::img('img/logo-sao-do.png', ['width' => '70px'])?>
            </a>
        </div>
        <!-- END LOGO -->

        <!-- BEGIN HORIZANTAL MENU -->
        <div class="hor-menu hidden-sm hidden-xs">
            <?=$this->render('_menu'); ?>
        </div>
        <!-- END HORIZANTAL MENU -->

        <!-- BEGIN RESPONSIVE MENU TOGGLER -->
        <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"></a>
        <!-- END RESPONSIVE MENU TOGGLER -->
        <!-- BEGIN TOP NAVIGATION MENU -->
        <div class="top-menu">
            <ul class="nav navbar-nav pull-right">
                <!-- BEGIN USER LOGIN DROPDOWN -->
                <li class="dropdown dropdown-user">
                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                        <img alt="" class="img-circle" src="http://localhost/quanlytoanha/hinh-anh/<?=Yii::$app->user->isGuest ? '' : Yii::$app->user->identity->anhdaidien; ?>"/>
                        <span class="username username-hide-on-mobile">
                            <?=Yii::$app->user->isGuest ? '' : Yii::$app->user->identity->hoten; ?>
                        </span>
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-default">
                        <li>
                            <?=Html::a('<i class="fa fa-user"></i> Thông tin cá nhân', '#', ['class' => 'btn-updateProfile'])?>
                        </li>

                        <li>
                            <?=Html::a('<i class="icon-key"></i> Đổi mật khẩu', '#', ['class' => 'btn-doimatkhau'])?>
                        </li>

                        <li>
                            <?=Html::a('<i class="icon-key"></i> Đăng xuất', Yii::$app->urlManager->createUrl('site/logout'))?>
                        </li>
                    </ul>
                </li>
                <!-- END USER LOGIN DROPDOWN -->
            </ul>
        </div>
        <!-- END TOP NAVIGATION MENU -->
    </div>
    <!-- END HEADER INNER -->
</div>
<!-- END HEADER -->
<div class="clearfix"></div>
