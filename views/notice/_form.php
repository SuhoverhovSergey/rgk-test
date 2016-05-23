<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Notice */
/* @var $form yii\widgets\ActiveForm */
/* @var $codes array */
/* @var $types array */
/* @var $users array */
?>

<div class="notice-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'code')->dropDownList($codes, ['prompt' => 'Выберите событие']) ?>

    <?= $form->field($model, 'from_user_id')->dropDownList(ArrayHelper::map($users, 'id', 'username'), ['prompt' => 'Выберите пользователя']) ?>

    <?= $form->field($model, 'to_user_id')->dropDownList(ArrayHelper::map($users, 'id', 'username'), ['prompt' => 'Все пользователи']) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'text')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'types')->dropDownList(ArrayHelper::map($types, 'id', 'name'), ['multiple' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
