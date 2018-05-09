<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\SanPham */

$this->title ='';
$this->params['breadcrumbs'][] = ['label' => 'Sản phẩm', 'url' => ['index']];
$this->params['breadcrumbs'][] = "Danh mục chi tiết sản phẩm";
?>
<br>
<div class="san-pham-view">

    <div class="panel panel-primary">
        <div class="panel-heading">
            <h4 class="panel-title">
                Chi tiết sản phẩm
            </h4>
        </div>
        <div class="panel-body">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
//                    'id',
                    [
                        'attribute'=>'anh_qr',
                        'format'=>'raw',
                        'value'=>function($data)
                        {
                            return Html::img(Yii::getAlias('@web').'/qr-code/'.$data->anh_qr,[
                                'style'=>[
                                    'width'=>'120px',
                                    'height'=>'120px',
                                ]
                            ]);
                        }
                    ],
                    'ma',
                    'ten',
//                    [
//                        'attribute'=>'nhom_san_pham_id',
//                        'value'=>function($data)
//                        {
//                            $nhomSP=\app\models\NhomSanPham::find()->where(['id'=>$data->nhom_san_pham_id])->one();
//                            return $nhomSP->ten;
//                        }
//                    ],
//                    [
//                        'attribute'=>'doanh_nghiep_id',
//                        'value'=>function($data)
//                        {
//                            $doanhNghiep=\app\models\DoanhNghiep::find()->where(['id'=>$data->doanh_nghiep_id])->one();
//                            return $doanhNghiep->ten;
//                        }
//                    ],
                    'so_luong',
                    'dvt',
                    [
                        'attribute'=>'ngay_tao',
                        'value'=>function($data)
                        {
                            return date("d/m/Y",strtotime($data->ngay_tao));
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
                                $nguoiCapNhat=\common\models\User::find()->where(['id'=>$data->nguoi_cap_nhat])->one();
                                return $nguoiCapNhat->username;
                            }
                        }
                    ],
                ],
            ]) ?>
        </div>
        <h4 style="text-align: center">Thông tin sản phẩm</h4>
        <div class="panel-body">
            <?= \yii\grid\GridView::widget([
                'summary'=>'',
                'dataProvider'=>$dataThongTin,
                'columns'=>[
                    ['class'=>'yii\grid\SerialColumn','contentOptions'=>['style'=>['vertical-align'=>'middle']],],
                    [
                        'label'=>'Tên chi tiết',
                        'contentOptions'=>['style'=>['vertical-align'=>'middle']],
                        'value'=>function($data)
                        {
                            return $data->ten;
                        }
                    ],
                    [
                        'label'=>'Diễn giải',
                        'contentOptions'=>['style'=>['vertical-align'=>'middle']],
                        'value'=>function($data)
                        {
                            return $data->dien_giai;
                        }
                    ],
                    [
                        'label'=>'Từ sản phẩm (Mã)',
                        'format'=>'raw',
                        'value'=>function($data){
                            if($data->san_pham_id!=0){
                                $sanPham=\backend\models\SanPham::find()->where(['id'=>$data->san_pham_id])->one();
                                return Html::img(Yii::getAlias('@web').'/qr-code/'.$sanPham->anh_qr,[
                                    'style'=>[
                                        'width'=>'100px',
                                        'height'=>'100px',
                                    ]
                                ]);
                            } else {
                                return '';
                            }
                        }
                    ],
                    [
                        'label'=>'Từ sản phẩm (Tên)',
                        'contentOptions'=>['style'=>['vertical-align'=>'middle']],
                        'value'=>function($data){
                            if($data->san_pham_id==0){
                                return 'Là sản phẩm gốc';
                            } else {
                                $sanPham=\backend\models\SanPham::find()->where(['id'=>$data->san_pham_id])->one();
                                return $sanPham->ten;
                            }
                        }
                    ],
                ]
            ])?>
        </div>
        <div class="panel-footer">
            <?= Html::a('<span class="fa fa-close"></span> Duyệt sản phẩm', ['kiem-duyet', 'id' => $model->id], [
                'class' => 'btn btn-primary',
                'data'=>['method'=>'post'],
            ]) ?>
            <?= Html::a('<span class="fa fa-close"></span> Không duyệt', ['khong-duyet', 'id' => $model->id], [
                'class' => 'btn btn-warning',
                'data'=>['method'=>'post'],
            ]) ?>
            <?= Html::a('<span class="fa fa-reply"></span> Quay lại',['index'],['class'=>'btn btn-default pull-right'])?>
        </div>
    </div>

</div>
