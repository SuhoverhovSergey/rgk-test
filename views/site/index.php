<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserNoticeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Notification System';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-notice-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => '_list',
    ]); ?>
</div>
