<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\SanPham */

$this->title = 'Danh mục chi tiết sản phẩm';
$this->params['breadcrumbs'][] = ['label' => 'San Phams', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->ten;
?>
<div class="san-pham-view">

    <div class="panel-group">
        <div class="panel panel-primary">
            <div class="panel-heading">* <i class="glyphicon glyphicon-sort-by-alphabet-alt"></i> Thông tin chi tiết
                doanh nghiệp <?= $model->ten?>  --  <?=$model ->ma?>
            </div>
            <div class="panel-body">
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'id',
                        'ma',
                        'ten',
                        [
                            'label'=>'QR-CODE',
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
                        [
                            'attribute'=>'nhom_san_pham_id',
                            'value'=>function($data)
                            {
                                $nhomSP=\backend\models\NhomSanPham::find()->where(['id'=>$data->nhom_san_pham_id])->one();
                                return $nhomSP->ten;
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
                            'attribute'=>'nguoi_tao',
                            'value'=>function($data)
                            {
                                $nguoiTao=\common\models\User::find()->where(['id'=>$data->nguoi_tao])->one();
                                return $nguoiTao->username;
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
                        [
                            'attribute'=>'ngay_cap_nhat',
                            'value'=>function($data)
                            {
                                if($data->ngay_cap_nhat!=''||$data->ngay_cap_nhat!=null){
                                    return date("d/m/Y",strtotime($data->ngay_cap_nhat));
                                }
                            }
                        ],
                        'so_luong',
                        'dvt',
                    ],
                ]) ?>
            </div>
            <div class="panel-body">
                <?= \kartik\grid\GridView::widget([
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
                        [
                            'class'=>'yii\grid\ActionColumn',
                            'contentOptions'=>['style'=>['vertical-align'=>'middle']],
                            'template'=>'{update}',
                            'buttons'=>[
                                'update'=>function($url,$data){
                                    $url=\yii\helpers\Url::to(['thong-tin-san-pham-update','id'=>$data->id]);
                                    return Html::a('<span class="glyphicon glyphicon-pencil"></span>',$url,['title'=>'Chỉnh sửa thông tin']);
                                }
                            ]
                        ]
                    ]
                ])?>
            </div>
            <div class="panel-footer">
                <div class="form-group">
                    <?php
                    if($model->trang_thai==\backend\models\SanPham::SP_DUYET){ ?>
                        <?= Html::a('<span class="fa fa-edit"></span> Chỉnh sửa', ['update', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
                        <?= Html::a('<span class="fa fa-close"></span> Thông tin sản phẩm', ['thong-tin-san-pham', 'id' => $model->id], ['class' => 'btn btn-info']) ?>
                        <?= Html::a('<span class="fa fa-reply"></span> Quay lại',['da-duyet'],['class'=>'btn btn-default pull-right'])?>
                    <?php } else { ?>
                        <?= Html::a('<span class="fa fa-plus"></span> Thêm mới', ['create'], ['class' => 'btn btn-primary']) ?>
                        <?= Html::a('<span class="fa fa-edit"></span> Chỉnh sửa', ['update', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
                        <?= Html::a('<span class="fa fa-close"></span> Thông tin sản phẩm', ['thong-tin-san-pham', 'id' => $model->id], ['class' => 'btn btn-info']) ?>
                        <?= Html::a('<span class="fa fa-close"></span> Chuyển kiểm duyệt', ['chuyen-duyet', 'id' => $model->id], [
                            'class' => 'btn btn-warning',
                            'data'=>['method'=>'post'],
                        ]) ?>
                        <?= Html::a('<span class="fa fa-reply"></span> Quay lại',['index'],['class'=>'btn btn-default pull-right'])?>
                    <?php }
                    ?>
                </div>
            </div>
        </div>
    </div>


</div>
