<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\NhomSanPham;
/* @var $this yii\web\View */
/* @var $model app\models\NhomSanPham */

$this->title ='';
//$this->params['breadcrumbs'][] = ['label' => 'Nhóm sản phẩm', 'url' => ['index']];
$this->params['breadcrumbs'][] = "Kiểm duyệt nhóm sản phẩm";
?>
<br>
<div class="nhom-san-pham-view">

    <div class="panel panel-primary">
        <div class="panel-heading">
           * <i class="glyphicon glyphicon-sort-by-alphabet-alt"></i> Thông tin chi tiết doanh nghiệp
          Tên : <?= $model->ten?> -- Mã : <?= $model->ma?>
                      
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
                    [
                        'attribute'=>'trang_thai',
                        'value'=>function($data)
                        {
                            if($data->trang_thai==NhomSanPham::NHOM_MOI)
                            {
                                return 'Nhóm sản phẩm mới';
                            }
                            if($data->trang_thai==NhomSanPham::NHOM_CHUYEN_DUYET)
                            {
                                return 'Đang chờ duyệt';
                            }
                            if($data->trang_thai==NhomSanPham::NHOM_KHONG_DUYET)
                            {
                                return 'Không duyệt';
                            }
                        }
                    ],
                ],
            ]) ?>
        </div>
        <div class="panel-footer">
            <?= Html::a('<span class="fa fa-edit"></span> Duyệt', ['duyet-nhom-sp', 'id' => $model->id], [
                'class' => 'btn btn-success',
                'data'=>['method'=>'post'],
            ]) ?>
            <?= Html::a('<span class="fa fa-reply"></span> Không duyệt',['khong-duyet','id'=>$model->id],[
                'class'=>'btn btn-warning',
                'data'=>['method'=>'post'],
            ])?>

            <?= Html::a('<span class="fa fa-reply"></span> Quay lại',['index'],['class'=>'btn btn-default pull-right'])?>
        </div>
    </div>

</div>
