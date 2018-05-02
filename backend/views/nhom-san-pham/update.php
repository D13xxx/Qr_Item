<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\NhomSanPham */

//$this->title = 'Danh mục nhóm sản phẩm';
$this->params['breadcrumbs'][] = ['label' => 'Danh mục nhóm sản phẩm', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $model->ten;
?>
<div class="nhom-san-pham-update">

    <div class="panel-group">
            <p>
            <?= Html::a('<i class="glyphicon glyphicon-circle-arrow-left"></i> Quay trở lại', ['index'], ['class' => 'btn btn-default']) ?>
            </p>
            <div class="panel panel-primary">
                <div class="panel-heading">* <i class="glyphicon glyphicon-sort-by-alphabet-alt"></i>Tạo mới doanh nghiệp</div>
                <div class="panel-body">
                    <?= $this->render('_form', [
                        'model' => $model,
                    ]) ?>
                </div>
                <div class=" panel-footer">
                    <div class="form-group">
                        <br>
                    </div>
                </div>
            </div>
        </div>


</div>
