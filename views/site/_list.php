<?php

use yii\helpers\Url;

/** @var $model app\models\UserNotice */

$typeClass = 'alert-success';
if ($model->viewed) {
    $typeClass = 'alert-info';
}
?>
<div class="alert <?= $typeClass ?> alert-dismissible" role="alert">
    <?php if (!$model->viewed) { ?>
        <a href="<?= Url::to(['/site/viewed', 'id' => $model->id]) ?>" class="pull-right btn btn-primary btn-xs">Прочитано</a>
    <?php } ?>
    <div>
        <div>
            <strong><?= $model->title ?></strong> от <ins><?= $model->fromUser->username ?></ins>
            <small><?= date('d.m.Y', strtotime($model->created)) ?></small>
        </div>
        <div><?= $model->text ?></div>
    </div>
</div>
