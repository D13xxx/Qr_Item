<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\DoanhNghiep */
$this->title='';
//$this->params['breadcrumbs'][] = ['label' => 'Doanh nghiệp', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Chi tiết doanh nghiệp';
?>
<br>
<div class="doanh-nghiep-view">
    <div class="panel-group">
        <div class="panel panel-primary">
            <div class="panel-heading">* <i class="glyphicon glyphicon-sort-by-alphabet-alt"></i> Thông tin chi tiết doanh nghiệp
            </div>
            <div class="panel-body">
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'id',
                        'ma',
                        'ten',
                        [
                            'attribute'=>'logo_doanh_nghiep',
                            'format'=>'raw',
                            'value'=>function($data){
                                if($data->logo_doanh_nghiep!==''||$data->logo_doanh_nghiep!==null){
                                    return Html::img(Yii::getAlias('@web').'/images/doanh-nghiep/'.$data->logo_doanh_nghiep,[
                                        'style'=>[
                                            'width'=>'120px',
                                            'height'=>'120px',
                                        ]
                                    ]);
                                }
                            }
                        ],
                        'ten_giao_dich',
                        'dia_chi',
                        'nguoi_dai_dien',
                        'so_dang_ky_kinh_doanh',
                        'dien_thoai',
                        // 'loai_hinh_id',
                        [
                           'attribute'=>'loai_hinh_id',
                           'contentOptions'=>['style'=>['vertical-align'=>'middle']],
                           'filter'=>\yii\helpers\ArrayHelper::map(\app\models\LoaiHinh::find()->all(),'id','ten'),
                           'value'=>function($data){
                               $loaiHinh=\app\models\LoaiHinh::find()->where(['id'=>$data->loai_hinh_id])->one();
                               return $loaiHinh->ten;
                           }
                        ],
                        
                         [
                            'attribute'=>'nguoi_tao',
                            'value'=>function($data)
                            {
                                $nguoiTao=\common\models\User::find()->where(['id'=>$data->nguoi_tao])->one();
                                return $nguoiTao->username;
                            }
                        ],
                         [
                            'attribute'=>'ngay_tao',
                            'value'=>function($data)
                            {
                                return date("d/m/Y",strtotime($data->ngay_tao));
                            }
                        ],
                        [
                            'attribute'=>'nguoi_cap_nhat',
                            'value'=>function($data)
                            {
                                if(\common\models\User::find()->where(['id'=>$data->nguoi_cap_nhat])->count()>0){
                                    $nguoiTao=\common\models\User::find()->where(['id'=>$data->nguoi_cap_nhat])->one();
                                    return $nguoiTao->username;
                                }
                            }
                        ],
                        [
                            'attribute'=>'trang_thai',
                            'value'=>function($data){
                                if($data->trang_thai==\app\models\DoanhNghiep::DN_MOI){
                                    return 'Doanh nghiệp mới';
                                }
                                if($data->trang_thai==\app\models\DoanhNghiep::DN_CHO_DUYET)
                                {
                                    return 'Chờ kiểm duyệt';
                                }
                                if($data->trang_thai==\app\models\DoanhNghiep::DN_KHONG_DUYET)
                                {
                                    return 'Không duyệt';
                                }
                                if($data->trang_thai==\app\models\DoanhNghiep::DN_DUYET)
                                {
                                    return 'Đã được kiểm duyệt';
                                }
                            }
                        ],
                        [
                        'attribute'=>'ngay_cap_nhat',
                        'value'=>function($data)
                        {
                            if($data->ngay_cap_nhat!=''||$data->ngay_cap_nhat!=null){
                                return date("d/m/Y",strtotime($data->ngay_cap_nhat));
                            }
                        }
                    ],
                    
                    ],
                ]) ?>
            </div>
            <div class="panel-footer">
                <?php
                if($model->trang_thai==\app\models\DoanhNghiep::DN_DUYET){ ?>
                    <?= Html::a('<span class="fa fa-edit"></span> Chỉnh sửa', ['update', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
                    <?= Html::a('<span class="fa fa-reply"></span> Quay lại',['kiem-duyet'],['class'=>'btn btn-default pull-right'])?>
                <?php } else { ?>
                    <?= Html::a('<span class="fa fa-plus"></span> Thêm mới', ['create'], ['class' => 'btn btn-primary']) ?>
                    <?= Html::a('<span class="fa fa-edit"></span> Chỉnh sửa', ['update', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
                    <?= Html::a('<span class="fa fa-share-alt"></span>Chuyển duyệt',['chuyen-duyet','id'=>$model->id],[
                        'class'=>'btn btn-info',
                        'data'=>['method'=>'post']
                    ])?>
                    <?= Html::a('<span class="fa fa-reply"></span> Quay lại',['index'],['class'=>'btn btn-default pull-right'])?>
                <?php }
            ?>
            </div>
        </div>
    </div>
</div>
