<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\LoaiHinh */

$this->title = 'Tạo mới loại hình doanh nghiệp';
$this->params['breadcrumbs'][] = ['label' => 'Danh mục loại hình', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="loai-hinh-create">
    <div class="panel-group">
        <div class="panel panel-primary">
            <div class="panel-heading">* <i class="glyphicon glyphicon-sort-by-alphabet-alt"></i>Tạo mới loại hình doanh nghiệp</div>
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
