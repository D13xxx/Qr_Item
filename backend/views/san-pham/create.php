<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model backend\models\SanPham */

$this->title = 'Tạo mới sản phẩm';
$this->params['breadcrumbs'][] = ['label' => 'Danh mục sản phẩm', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="san-pham-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
