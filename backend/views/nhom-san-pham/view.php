<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\NhomSanPham;
/* @var $this yii\web\View */
/* @var $model app\models\NhomSanPham */

$this->title = "";
$this->params['breadcrumbs'][] = ['label' => 'Danh mục nhóm sản phẩm', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->ten;
?>
<br>
<div class="nhom-san-pham-view">
    <div class="panel-group">
        <div class="panel panel-primary">
            <div class="panel-heading">* <i class="glyphicon glyphicon-sort-by-alphabet-alt"></i> Thông tin chi tiết : Tên <?=$model->ten?> -- <?=$model->ma?>
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
                <div class="form-group">
                    <?php
                        if($model->trang_thai==\backend\models\NhomSanPham::NHOM_DA_DUYET){ ?>
                            <?= Html::a('<span class="fa fa-edit"></span> Chỉnh sửa', ['update', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
                            <?= Html::a('<span class="fa fa-reply"></span> Quay lại',['/nhom-san-pham/da-duyet'],['class'=>'btn btn-default pull-right'])?>
                        <?php } else { ?>
                            <?= Html::a('<span class="fa fa-plus"></span> Thêm mới', ['create'], ['class' => 'btn btn-primary']) ?>
                            <?= Html::a('<span class="fa fa-edit"></span> Chỉnh sửa', ['update', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
                            <?= Html::a('<span class="fa fa-close"></span> Xóa', ['delete', 'id' => $model->id], [
                                'class' => 'btn btn-danger',
                                'data' => [
                                    'confirm' => 'Are you sure you want to delete this item?',
                                    'method' => 'post',
                                ],
                            ]) ?>
                            <?= Html::a('<span class="fa fa-reply"></span> Quay lại',['index'],['class'=>'btn btn-default pull-right'])?>
                        <?php }
                    ?>
                </div>
            </div>
        </div>
    </div>


</div>
