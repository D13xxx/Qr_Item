<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\NhomSanPhamSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="nhom-san-pham-search">

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

    <?= $form->field($model, 'trang_thai') ?>

    <?= $form->field($model, 'nguoi_tao') ?>

    <?php // echo $form->field($model, 'ngay_tao') ?>

    <?php // echo $form->field($model, 'nguoi_cap_nhat') ?>

    <?php // echo $form->field($model, 'ngay_cap_nhat') ?>

    <?php // echo $form->field($model, 'anh_dai_dien') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
