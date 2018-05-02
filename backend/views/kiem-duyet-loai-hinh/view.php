<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\LoaiHinh */

$this->title = 'Loại hình DN: '.$model->ma;
$this->params['breadcrumbs'][] = ['label' => 'Loại hình', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="loai-hinh-view">

    <div class="panel panel-primary">
        <div class="panel-heading">
            <h4 class="panel-title">
                <?= Html::encode($this->title) ?>
            </h4>
        </div>
        <div class="panel-body">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'ma',
                    'ten',
                    [
                        'attribute'=>'nguoi_tao',
                        'value'=>function($data)
                        {
                            if(\common\models\User::find()->where(['id'=>$data->nguoi_tao])->count()>0){
                                $nguoiTao=\common\models\User::find()->where(['id'=>$data->nguoi_tao])->one();
                                return $nguoiTao->username;
                            }
                        }
                    ],
                    [
                        'attribute'=>'ngay_tao',
                        'value'=>function($data){
                            return date("d/m/Y",strtotime($data->ngay_tao));
                        }
                    ],
                    [
                        'attribute'=>'nguoi_cap_nhat',
                        'filter'=>\yii\helpers\ArrayHelper::map(\common\models\User::find()->all(),'id','username'),
                        'value'=>function($data)
                        {
                            if(\common\models\User::find()->where(['id'=>$data->nguoi_cap_nhat])->count()>0){
                                $nguoiCapNhat=\common\models\User::find()->where(['id'=>$data->nguoi_cap_nhat])->one();
                                return $nguoiCapNhat->username;
                            } else {
                                return '';
                            }
                        }
                    ],
                    [
                        'attribute'=>'ngay_cap_nhat',
                        'value'=>function($data){
                            if($data->ngay_cap_nhat==''||$data->ngay_cap_nhat==null){
                                return '';
                            }
                            return date("d/m/Y",strtotime($data->ngay_cap_nhat));
                        }
                    ],
                ],
            ]) ?>
        </div>
        <div class="panel-footer">
            <?= Html::a('<span class="fa fa-plus"></span> Duyệt loại hình', ['kiem-duyet-loai-hinh','id'=>$model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('<span class="fa fa-edit"></span> Không duyệt', ['khong-duyet', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
            <?= Html::a('<span class="fa fa-reply"></span> Quay lại',['index'],['class'=>'btn btn-default pull-right'])?>
        </div>
    </div>

</div>
