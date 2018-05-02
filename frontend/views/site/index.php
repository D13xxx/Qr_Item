
<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>
<?php $form = ActiveForm::begin([
    'action'  => ['search'],
    'method'  => 'get',
    'options' => ['class' => 'form-inline'],
]);?>
<div class="container">
    <div class="row">
        <div  style="margin: 0 auto ; width: 300px;">
            <div class="form-group">
                <input id="search" name="search" placeholder="Search Here" class="form-control input-md" required value="" type="text">
            </div>
            <div class="form-group">
                <?=Html::submitButton('Search', ['class' => 'btn btn-primary'])?>
            </div>
            <br>
            <br>
            <span class="text-danger">Sản phẩm có dạng SP_xxxxxx_xxxxx</span>
            <?php ActiveForm::end();?>
        </div>
    </div>
</div>

