<?php
use backend\assets\AppAsset;
use yii\helpers\Html;
use tez\theme\widgets\Header;
use tez\theme\widgets\Nav;
use tez\theme\widgets\NavBar;
use tez\theme\widgets\NavBarUser;
use tez\theme\widgets\NavBarMessage;
use tez\theme\widgets\NavBarNotification;
use tez\theme\widgets\NavBarTask;
use tez\theme\widgets\Breadcrumbs;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
$this->beginBlock('header');
    Header::begin([
        'brandLabel' => 'My Company',
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'tag'   => 'header',
            'class' => 'main-header',
        ],
    ]);
    NavBar::begin([
        'options' => [
            'class' => 'navbar-static-top',
        ],
        'breadCrumbs' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    ]);

    $menuItems = [];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['content'=> NavBarUser::Widget(),'options'=>['class'=>'']];
    } else {
        $menuItems[] = ['content'=> NavBarMessage::Widget(),'options'=>['class'=>'dropdown messages-menu']];
        $menuItems[] = ['content'=> NavBarNotification::Widget(),'options'=>['class'=>'dropdown notifications-menu']];
        $menuItems[] = ['content'=> NavBarTask::Widget(),'options'=>['class'=>'dropdown tasks-menu']];
        $menuItems[] = ['content'=> NavBarUser::Widget(),'options'=>['class'=>'dropdown user user-menu']];
    }

    echo Nav::widget([
        'options' => ['class' => 'nav navbar-nav'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    Header::end();
$this->endBlock();

$this->beginContent('@theme/views/layouts/main.php');
    echo $content;
$this->endContent();
?>