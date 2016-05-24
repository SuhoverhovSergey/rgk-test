<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Notice */
/* @var $codes array */
/* @var $codeParams array */
/* @var $types array */
/* @var $users array */

$this->title = 'Новое уведомление';
$this->params['breadcrumbs'][] = ['label' => 'Уведомления', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="notice-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'codes' => $codes,
        'codeParams' => $codeParams,
        'types' => $types,
        'users' => $users,
    ]) ?>

</div>
