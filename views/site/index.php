<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserNoticeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Notification System';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-notice-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            [
                'attribute' => 'text',
                'format' => 'raw',
            ],
            'fromUser.username',
            [
                'attribute' => 'created',
                'format' => ['date', 'php:d.m.Y'],
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'contentOptions' => ['style' => 'width: 100px;text-align: center;'],
            ],
        ],
    ]); ?>
</div>
