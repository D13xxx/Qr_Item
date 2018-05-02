<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\LoaiHinh;
/* @var $this yii\web\View */
/* @var $model app\models\LoaiHinh */

// $this->title = 'Loại hình DN: '.$model->ma;
$this->params['breadcrumbs'][] = ['label' => 'Loại hình', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="loai-hinh-view">

    <div class="panel panel-primary">
        <div class="panel-heading">* <i class="glyphicon glyphicon-sort-by-alphabet-alt"></i> Thông tin chi tiết : Tên <?= $model->ten?> - Mã : <?= $model->ma?>
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
                        'label'=>'Người duyệt',
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
                        'label'=>'Ngày duyệt',
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
            <?= Html::a('<span class="fa fa-reply"></span> Quay lại',['/loai-hinh/kiem-duyet'],['class'=>'btn btn-default'])?>
        </div>
    </div>

</div>
