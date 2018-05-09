<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\LoaiHinh */
$this->title = '';
$this->params['breadcrumbs'][] = ['label' => 'Loại Hình', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->ten;
?>
<br>
<div class="loai-hinh-view">
        <div class="panel panel-primary">
        <div class="panel-heading">
            <h4 class="panel-title">
                Thông tin chi tiết loại hình doanh nghiệp
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
            <?= Html::a('<span class="fa fa-plus"></span> Thêm mới', ['create'], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('<span class="fa fa-edit"></span> Chỉnh sửa', ['update', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
            <?php
            if($model->trang_thai==\app\models\LoaiHinh::LOAI_HINH_MOI || $model->trang_thai==\app\models\LoaiHinh::KHONG_DUYET){
                echo Html::a('<span class="fa fa-share-alt">Chuyển duyệt</span>',['chuyen-duyet','id'=>$model->id],[
                        'class'=>'btn btn-info',
                        'data'=>['method'=>'post']
                ]);
            }
            ?>
            <?= Html::a('<span class="fa fa-reply"></span> Quay lại',['index'],['class'=>'btn btn-default pull-right'])?>
        </div>
    </div>

</div>
