<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\LoaiHinhSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="loai-hinh-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'ma') ?>

    <?= $form->field($model, 'ten') ?>

    <?= $form->field($model, 'nguoi_tao') ?>

    <?= $form->field($model, 'ngay_tao') ?>

    <?php // echo $form->field($model, 'nguoi_cap_nhat') ?>

    <?php // echo $form->field($model, 'ngay_cap_nhat') ?>

    <?php // echo $form->field($model, 'trang_thai') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
