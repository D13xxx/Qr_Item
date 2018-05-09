<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\DoanhNghiep */

$this->title = '';
$this->params['breadcrumbs'][] = ['label' => 'Danh mục doanh nghiệp', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?><br>
<div class="doanh-nghiep-create">

    <div class="panel-group">

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
