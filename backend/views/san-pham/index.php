<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SanPhamSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Danh mục sản phẩm';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="san-pham-index">

        <div class="panel-group">
                <div class="panel panel-primary">
                    <div class="panel-heading">* <i class="glyphicon glyphicon-sort-by-alphabet-alt"></i>Thông tin nhóm sản phẩm</div>
                    <div class="panel-body">
                        <?php \yii\widgets\Pjax::begin( ['enablePushState'=>false])?>
                        <?= GridView::widget([
                            'dataProvider' => $dataProvider,
                            'filterModel' => $searchModel,
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],
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
                                    'attribute'=>'ma',
                                    'contentOptions'=>['style'=>['vertical-align'=>'middle']],
                                ],
                                [
                                    'attribute'=>'ten',
                                    'contentOptions'=>['style'=>['vertical-align'=>'middle']],
                                ],
                                [
                                    'attribute'=>'nguoi_tao',
                                    'contentOptions'=>['style'=>['vertical-align'=>'middle']],
                                    'filter'=>\yii\helpers\ArrayHelper::map(\common\models\User::find()->all(),'id','username'),
                                    'value'=>function($data)
                                    {
                                        $nguoiTao=\common\models\User::find()->where(['id'=>$data->nguoi_tao])->one();
                                        return $nguoiTao->username;
                                    }
                                ],
                                [
                                    'attribute'=>'doanh_nghiep_id',
                                    'contentOptions'=>['style'=>['vertical-align'=>'middle']],
                                    'filter'=>\kartik\widgets\Select2::widget([
                                        'model'=>$searchModel,
                                        'attribute'=>'doanh_nghiep_id',
                                        'data'=>\yii\helpers\ArrayHelper::map(\app\models\DoanhNghiep::find()->where(['trang_thai'=>\app\models\DoanhNghiep::DN_DUYET])->all(),'id','ten'),
                                        'pluginOptions'=>['allowClear'=>true],
                                        'options'=>['placeholder'=>''],
                                    ]),
                                    'value'=>function($data)
                                    {
                                        $doanhNghiep=\app\models\DoanhNghiep::find()->where(['id'=>$data->doanh_nghiep_id])->one();
                                        return $doanhNghiep->ten;
                                    }
                                ],
                                [
                                    'attribute'=>'nhom_san_pham_id',
                                    'contentOptions'=>['style'=>['vertical-align'=>'middle']],
                                    'filter'=>\kartik\widgets\Select2::widget([
                                        'model'=>$searchModel,
                                        'attribute'=>'nhom_san_pham_id',
                                        'data'=>\yii\helpers\ArrayHelper::map(\backend\models\NhomSanPham::find()->where(['trang_thai'=>\backend\models\NhomSanPham::NHOM_DA_DUYET])->all(),'id','ten'),
                                        'pluginOptions'=>['allowClear'=>true],
                                        'options'=>['placeholder'=>''],
                                    ]),
                                    'value'=>function($data)
                                    {
                                        $nhomSP=\backend\models\NhomSanPham::find()->where(['id'=>$data->nhom_san_pham_id])->one();
                                        return $nhomSP->ten;
                                    }
                                ],
                                [
                                    'attribute'=>'ngay_tao',
                                    'contentOptions'=>['style'=>['vertical-align'=>'middle']],
                                    'filter'=>\kartik\widgets\DatePicker::widget([
                                        'model'=>$searchModel,
                                        'attribute'=>'ngay_tao',
                                        'pluginOptions'=>[
                                            'format'=>'dd/mm/yyyy',
                                            'autoclose'=>true,
                                            'todayHighlight'=>true,
                                        ],
                                    ]),
                                    'value'=>function($data)
                                    {
                                        return date("d/m/Y",strtotime($data->ngay_tao));
                                    }
                                ],
                                [
                                    'attribute'=>'trang_thai',
                                    'contentOptions'=>['style'=>['vertical-align'=>'middle']],
                                    'filter'=>array(\backend\models\SanPham::SP_MOI=>'Sản phẩm mới',\backend\models\SanPham::SP_CHUYEN_DUYET=>'Chờ duyệt',\backend\models\SanPham::SP_KHONG_DUYET=>'Không duyệt'),
                                    'value'=>function($data)
                                    {
                                        if($data->trang_thai==\backend\models\SanPham::SP_MOI){
                                            return 'Sản phẩm mới';
                                        }
                                        if($data->trang_thai==\backend\models\SanPham::SP_CHUYEN_DUYET){
                                            return 'Chờ kiểm duyệt';
                                        }
                                        if($data->trang_thai==\backend\models\SanPham::SP_KHONG_DUYET)
                                        {
                                            return 'Không duyệt';
                                        }
                                    }
                                ],
                                [
                                    'class' => 'yii\grid\ActionColumn',
                                    'contentOptions'=>['style'=>['vertical-align'=>'middle']],
                                    'template'=>'{view} {update} {chuyen-duyet}',
                                    'buttons'=>[
                                        'chuyen-duyet'=>function($url,$data){
                                            $url=\yii\helpers\Url::to(['chuyen-duyet','id'=>$data->id]);
                                            return Html::a('<span class="glyphicon glyphicon-share-alt"></span>',$url,[
                                                'title'=>'Chuyển kiểm duyệt',
                                                'data'=>['method'=>'post'],
                                                'class'=>'btn btn-default',
                                            ]);
                                        }
                                    ],
                                    'visibleButtons'=>[
                                        'chuyen-duyet'=>function($data)
                                        {
                                            if($data->trang_thai==\backend\models\SanPham::SP_MOI||$data->trang_thai==\backend\models\SanPham::SP_KHONG_DUYET){
                                                return true;
                                            }
                                        }
                                    ],
                                ],
                            ],
                        ]); ?>
                        <?php \yii\widgets\Pjax::end()?>
                    </div>
                    <div class="panel-footer">
                        <div class="form-group">
                            <p>
                                <?= Html::a('<i class="glyphicon glyphicon-plus-sign"></i> Tạo mới sản phẩm', ['create'], ['class' => 'btn btn-success']) ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
</div>
