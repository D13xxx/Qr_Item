<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SanPham */

$this->title = 'Thông tin chi tiết sản phẩm';
$this->params['breadcrumbs'][] = ['label' => 'Danh mục sản phẩm', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Sửa đổi thông tin sản phẩm ' .$model->ten;
?>
<div class="san-pham-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
