<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\SanPham */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="san-pham-form">
        <div class="panel-group">
                <div class="panel panel-primary">
                    <div class="panel-heading">* <i class="glyphicon glyphicon-sort-by-alphabet-alt"></i>Thông tin sản phẩm</div>
                    <div class="panel-body">
                        <?php \yii\widgets\Pjax::begin( ['enablePushState'=>false])?>
                        <?php $form = ActiveForm::begin(); ?>
                        <?php
                        if($model->isNewRecord){ ?>
                            <?= $form->field($model, 'ma')->textInput([
                                'readOnly' => true,
                                'value'=>\app\models\Dungchung::SinhMa('SP_'.date("Ymd").'_','san_pham'),
                            ]) ?>
                        <?php } else { ?>
                            <?= $form->field($model, 'ma')->textInput(['maxlength' => true,'readOnly'=>true]) ?>
                        <?php }
                        ?>

                        <?= $form->field($model, 'ten')->textInput(['maxlength' => true]) ?>


                        <?php
                        $nhomSP=\backend\models\NhomSanPham::find()->where(['trang_thai'=>\backend\models\NhomSanPham::NHOM_DA_DUYET])->all();
                        $listNhomSP=\yii\helpers\ArrayHelper::map($nhomSP,'id','ten');
                        ?>
                        <?= $form->field($model, 'nhom_san_pham_id')->widget(\kartik\select2\Select2::className(),[
                            'data'=>$listNhomSP,
                            'options'=>[
                                'placeholder'=>'Thuộc nhóm sản phẩm ....?',
                            ],
                            'pluginOptions'=>['allowClear'=>true],
                        ]) ?>




                        <?php
                        $doanhNghiep=\app\models\DoanhNghiep::find()->where(['trang_thai'=>\app\models\DoanhNghiep::DN_DUYET])->all();
                        $listDN=\yii\helpers\ArrayHelper::map($doanhNghiep,'id','ten');
                        ?>
                        <?= $form->field($model, 'doanh_nghiep_id')->widget(\kartik\select2\Select2::className(),[
                            'data'=>$listDN,
                            'options'=>['placeholder'=>'Thuộc doanh nghiệp .... ?'],
                            'pluginOptions'=>['allowClear'=>true],
                        ])?>

                        <?= $form->field($model, 'so_luong')->textInput() ?>

                        <?= $form->field($model, 'dvt')->textInput(['maxlength' => true]) ?>


                        <div class="form-group">
                            <?= Html::submitButton($model->isNewRecord ? '<span class="fa fa-check"></span> Hoàn thành' : '<span class="fa fa-check"></span> Hoàn thành', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-success']) ?>
                            <?php
                            if($model->trang_thai==\backend\models\SanPham::SP_DUYET){ ?>
                                <?= Html::a('<span class="fa fa-reply"></span> Quay lại',['da-duyet'],['class'=>'btn btn-default pull-right'])?>
                            <?php } else { ?>
                                <?= Html::a('<span class="fa fa-reply"></span> Quay lại',['index'],['class'=>'btn btn-default pull-right'])?>
                            <?php }
                            ?>
                        </div>

                        <?php ActiveForm::end(); ?>

                        <?php \yii\widgets\Pjax::end()?>
                    </div>
                </div>
            </div>

</div>
