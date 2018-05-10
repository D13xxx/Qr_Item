<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\NhomSanPham */

$this->title = '';
//$this->params['breadcrumbs'][] = ['label' => 'Danh mục nhóm sản phẩm', 'url' => ['index']];
$this->params['breadcrumbs'][] = "Danh mục tạo mới nhóm sản phẩm";
?>
<br>
<div class="nhom-san-pham-create">
	<div class="panel-group">
	    
	    <div class="panel panel-primary">
	        <div class="panel-heading">* <i class="glyphicon glyphicon-sort-by-alphabet-alt"></i>Tạo mới nhóm sản phẩm</div>
	        <div class="panel-body">
				<?= $this->render('_form', [
			        'model' => $model,
			    ]) ?>
	        </div>
	        <div class=" panel-footer">
	            <div class="form-group">
	            
	            </div>
	        </div>
	    </div>
	</div>
    

</div>
