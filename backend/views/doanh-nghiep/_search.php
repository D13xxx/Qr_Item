<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DoanhNghiepSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="doanh-nghiep-search">

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

    <?= $form->field($model, 'ten_giao_dich') ?>

    <?= $form->field($model, 'dia_chi') ?>

    <?php // echo $form->field($model, 'nguoi_dai_dien') ?>

    <?php // echo $form->field($model, 'so_dang_ky_kinh_doanh') ?>

    <?php // echo $form->field($model, 'dien_thoai') ?>

    <?php // echo $form->field($model, 'loai_hinh_id') ?>

    <?php // echo $form->field($model, 'trang_thai') ?>

    <?php // echo $form->field($model, 'nguoi_tao') ?>

    <?php // echo $form->field($model, 'ngay_tao') ?>

    <?php // echo $form->field($model, 'nguoi_cap_nhat') ?>

    <?php // echo $form->field($model, 'ngay_cap_nhat') ?>

    <?php // echo $form->field($model, 'logo_doanh_nghiep') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
