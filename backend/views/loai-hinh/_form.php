<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\LoaiHinh */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="loai-hinh-form">
    <?php $form = ActiveForm::begin(); ?>
        <?php
        if($model->isNewRecord){ ?>
            <?= $form->field($model,'ma')->textInput([
                'value'=>\app\models\Dungchung::SinhMa('LH-','loai_hinh'),
                'readOnly'=>true,
            ]);?>
        <?php } else { ?>
            <?= $form->field($model, 'ma')->textInput(['maxlength' => true,'readOnly'=>true]) ?>
        <?php }
        ?>
        <?= $form->field($model, 'ten')->textInput(['maxlength' => true]) ?>

        <?= Html::submitButton($model->isNewRecord ? '<span class="fa fa-check"></span> Hoàn thành' : '<span class="fa fa-check"></span> Hoàn thành', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-success']) ?>
        <?= Html::a('<span class="fa fa-reply"></span> Quay lại',['index'],['class'=>'btn btn-default pull-right'])?>

    <?php ActiveForm::end(); ?>

</div>
