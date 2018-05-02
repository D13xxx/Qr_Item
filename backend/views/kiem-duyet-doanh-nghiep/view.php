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
                    'ma',
                    'ten',
                    'ten_giao_dich',
                    'dia_chi:ntext',
                    'nguoi_dai_dien',
                    'so_dang_ky_kinh_doanh',
                    'dien_thoai',
                    [
                        'attribute'=>'loai_hinh_id',
                        'value'=>function($data)
                        {
                            $loaiHinh=\backend\models\LoaiHinh::find()->where(['id'=>$data->loai_hinh_id])->one();
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
                        'attribute'=>'ngay_cap_nhat',
                        'value'=>function($data)
                        {
                            if($data->ngay_cap_nhat!=''||$data->ngay_cap_nhat!=null){
                                return date("d/m/Y",strtotime($data->ngay_cap_nhat));
                            }
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
                ],
            ]) ?>
        </div>
        <div class="panel-footer">
            <?= Html::a('<span class="fa fa-plus"></span> Duyệt doanh nghiệp', ['duyet-dn','id'=>$model->id], [
                    'class' => 'btn btn-primary',
                'data'=>['method'=>'post'],
            ]) ?>
            <?= Html::a('<span class="fa fa-edit"></span> Không duyệt', ['khong-duyet-dn', 'id' => $model->id], [
                    'class' => 'btn btn-success','data'=>['method'=>'post'],
                ]) ?>
            <?= Html::a('<span class="fa fa-reply"></span> Quay lại',['index'],['class'=>'btn btn-default pull-right'])?>
        </div>
    </div>

</div>
