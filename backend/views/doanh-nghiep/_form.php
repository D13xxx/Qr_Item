<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\widgets\FileInput;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model app\models\DoanhNghiep */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="doanh-nghiep-form">
    
    <?php $form = ActiveForm::begin(

    ); ?>
    		<p>
    	    <?= Html::a('<i class="glyphicon glyphicon-arrow-left"></i> Quay lại trang hiện thị', ['index'], ['class' => 'btn btn-default']
    	    ) ?>
    	    </p>
    	    <div class="panel-group">
    	        <div class="panel panel-primary">
    	            <div class="panel-heading">* <i class="glyphicon glyphicon-sort-by-alphabet-alt"></i> Thông tin chi tiết doanh nghiệp</div>
    	            <div class="panel-body">
    	                
    	            </div>
    	            <div class="panel-footer">
    	                <div class="form-group">
    	                    <p>
    	                        <?= Html::a('<i class="glyphicon glyphicon-plus-sign"></i> Thêm mới doanh nghiệp', ['create', 'id' => ->id], ['class' => 'btn btn-success']) ?> 
    	                        <?= Html::a('<i class="glyphicon glyphicon-edit"></i> Sửa thông tin', ['update', 'id' => ->id], ['class' => 'btn btn-primary']) ?>
    	                        <?= Html::a('<i class="glyphicon glyphicon-remove"></i> Xóa thông tin', ['delete', 'id' => ->id], [
    	                            'class' => 'btn btn-danger ',
    	                            'data' => [
    	                                'confirm' => 'Bạn muốn xóa bài viết này ..?',
    	                                'method' => 'post',
    	                            ],
    	                        ]) ?>
    	                        <br>
    	                    </p>
    	                </div>
    	            </div>
    	        </div>
    	    </div>
    	    
        <?php
        if($model->isNewRecord){ ?>
            <?= $form->field($model,'ma')->textInput([
                'value'=>\app\models\Dungchung::SinhMa('DN-','doanh_nghiep'),
                'readOnly'=>true,
            ]);?>
        <?php } else { ?>
            <?= $form->field($model, 'ma')->textInput(['maxlength' => true,'readOnly'=>true]) ?>
        <?php }
        ?>

        <?= $form->field($model, 'ten')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'ten_giao_dich')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'dia_chi')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'nguoi_dai_dien')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'so_dang_ky_kinh_doanh')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'dien_thoai')->textInput(['maxlength' => true]) ?>

        <?php
        $loaiHinh=\backend\models\LoaiHinh::find()->all();
        $listLoaiHinh=\yii\helpers\ArrayHelper::map($loaiHinh,'id','ten');
        ?>
        <?= $form->field($model, 'loai_hinh_id')->dropDownList($listLoaiHinh,['prompt'=>'Chọn loại hình doanh nghiệp ....']) ?>
        
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '<span class="fa fa-check"></span> Hoàn thành' : '<span class="fa fa-check"></span> Hoàn thành', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-success']) ?>
        <?= Html::a('<span class="fa fa-reply"></span> Quay lại',['index'],['class'=>'btn btn-default pull-right'])?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
