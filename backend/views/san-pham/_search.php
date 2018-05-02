<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SanPhamSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="san-pham-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'ma') ?>

    <?= $form->field($model, 'ten') ?>

    <?= $form->field($model, 'anh_qr') ?>

    <?= $form->field($model, 'nhom_san_pham_id') ?>

    <?php // echo $form->field($model, 'ngay_tao') ?>

    <?php // echo $form->field($model, 'nguoi_tao') ?>

    <?php // echo $form->field($model, 'doanh_nghiep_id') ?>

    <?php // echo $form->field($model, 'nguoi_cap_nhat') ?>

    <?php // echo $form->field($model, 'ngay_cap_nhat') ?>

    <?php // echo $form->field($model, 'trang_thai') ?>

    <?php // echo $form->field($model, 'so_luong') ?>

    <?php // echo $form->field($model, 'dvt') ?>

    <?php // echo $form->field($model, 'anh_dai_dien') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
