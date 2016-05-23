<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Notice */
/* @var $codes array */
/* @var $types array */
/* @var $users array */

$this->title = 'Create Notice';
$this->params['breadcrumbs'][] = ['label' => 'Notices', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="notice-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'codes' => $codes,
        'types' => $types,
        'users' => $users,
    ]) ?>

</div>
