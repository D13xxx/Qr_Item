<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\DoanhNghiep */

$this->title = '';
$this->params['breadcrumbs'][] = ['label' => 'Doanh nghiệp', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->ten;
?>
<br>
<div class="doanh-nghiep-update">
    <div class="panel-group">
        <div class="panel panel-primary">
            <div class="panel-heading">* <i class="glyphicon glyphicon-sort-by-alphabet-alt"></i>Sửa đổi thông tin doanh nghiệp : Tên <?= $model->ten?> - Mã : <?= $model->ma?> </div>
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
