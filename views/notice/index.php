<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\NoticeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Уведомления';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="notice-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить уведомление', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'code',
            [
                'attribute' => 'from_user_id',
                'value' => 'fromUser.username',
            ],
            [
                'attribute' => 'to_user_id',
                'value' => function ($data) {
                    $value = $data->to_user_id;
                    if (!$value) {
                        $value = 'Всем';
                    } else {
                        $value = $data->toUser->username;
                    }
                    return $value;
                },
            ],
            // 'title',
            // 'text:ntext',
            // 'type',
            // 'created',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
