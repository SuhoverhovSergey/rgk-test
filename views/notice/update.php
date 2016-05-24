<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Notice */
/* @var $codes array */
/* @var $codeParams array */
/* @var $types array */
/* @var $users array */

$this->title = 'Редактирование уведомления: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Уведомления', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Обновить';
?>
<div class="notice-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'codes' => $codes,
        'codeParams' => $codeParams,
        'types' => $types,
        'users' => $users,
    ]) ?>

</div>
