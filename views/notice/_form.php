<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Notice */
/* @var $form yii\widgets\ActiveForm */
/* @var $codes array */
/* @var $codeParams array */
/* @var $types array */
/* @var $users array */

$this->registerJs("
    $('#notice-code').on('change', function () {
        console.log('ss');
        var value = $(this).val();
        $('#notice-text').closest('.form-group').find('.hint-block div').addClass('hide');
        $('#code-param-' + value).removeClass('hide');
    });
");
?>

<div class="notice-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'code')->dropDownList($codes, ['prompt' => 'Выберите событие']) ?>

    <?= $form->field($model, 'from_user_id')->dropDownList(ArrayHelper::map($users, 'id', 'username'), ['prompt' => 'Выберите пользователя']) ?>

    <?= $form->field($model, 'to_user_id')->dropDownList(ArrayHelper::map($users, 'id', 'username'), ['prompt' => 'Все пользователи']) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?php $textHints = ''; ?>
    <?php foreach ($codeParams as $paramName => $params) {
        $class = 'hide';
        if ($paramName == $model->code) {
            $class = '';
        }
        $textHints .= "<div id='code-param-$paramName' class='$class'>Параметры: {" . implode('} {', $params) . "}</div>";
    } ?>
    <?= $form->field($model, 'text')->textarea(['rows' => 6])->hint($textHints) ?>

    <?= $form->field($model, 'types')->dropDownList(ArrayHelper::map($types, 'id', 'name'), ['multiple' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>