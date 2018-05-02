<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\NhomSanPham */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="nhom-san-pham-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php
    if($model->isNewRecord) { ?>
        <?= $form->field($model, 'ma')->textInput([
            'value'=> \app\models\Dungchung::SinhMa('NhomSP-','nhom_san_pham'),
            'readOnly'=>true,
        ]) ?>
    <?php } else { ?>
        <?= $form->field($model, 'ma')->textInput(['maxlength' => true,'readOnly'=>true]) ?>
    <?php }
    ?>

    <?= $form->field($model, 'ten')->textInput(['maxlength' => true]) ?>



    <div class="form-group">
        <?= Html::submitButton('<i class="glyphicon glyphicon-plus-sign"></i> Cập nhật', ['class' => 'btn btn-success']) ?>

        <?= Html::a('<i class="glyphicon glyphicon-circle-arrow-left"></i> Quay trở lại', ['index'], ['class' => 'btn btn-default pull-right']) ?>

    </div>

    <?php ActiveForm::end(); ?>

</div>
