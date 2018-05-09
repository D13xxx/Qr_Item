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

    <div class="panel panel-primary">
        <div class="panel-heading">
            <h4 class="panel-title">
                * <i class="glyphicon glyphicon-sort-by-alphabet-alt"></i> Danh sách sản phẩm
            </h4>
        </div>
        <div class="panel-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'tableOptions' => [
                    'class'=>'table table-striped table-bordered'
                ],
                'pager' => [
                    'options'=>['class'=>'pagination pull-right'],
                ],
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'label'=>'QR-CODE',
                        'format'=>'raw',
                        'value'=>function($data)
                        {
                            {
                             return Html::img('@FakeLink/'. $data->anh_qr,[
                                    'style'=>[
                                        'width'=>'120px',
                                        'height'=>'120px',
                                    ]
                                ]);
                            }
                        }
                    ],
                    [
                        'label'=>'Ảnh đại diện',
                        'format'=>'raw',
                        'value'=>function($data)
                        {
                            {
                             return Html::img('@FakeLinkSanPham/'. $data->anh_dai_dien,[
                                    'style'=>[
                                        'width'=>'120px',
                                        'height'=>'120px',
                                    ]
                                ]);
                            }
                        }
                    ],
                    [
                        'label'=>'Mã sản phẩm',
                        'attribute'=>'ma',
                        'contentOptions'=>['style'=>['vertical-align'=>'middle']],
                        'format'=>'html',
                        'value'=>function($data){
                            return Html::a($data->ma,['view','id'=>$data->id]);
                        }
                    ],
                    [
                        'label'=>'Tên sản phẩm',
                        'attribute'=>'ten',
                        'contentOptions'=>['style'=>['vertical-align'=>'middle']],
                        'format'=>'html',
                        'value'=>function($data){
                            return Html::a($data->ten,['view','id'=>$data->id]);
                        }
                    ],
                    [
                        'label'=>'Nhóm sản phẩm',
                        'attribute'=>'nhom_san_pham_id',
                        'format'=>'html',
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
                            // return Html::a($nhomSP->ten,['view','id'=>$data->id]);
                            return $nhomSP->ten;
                        }
                    ],
                     [
                         'label'=>'Doanh nghiệp',
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
                        'label'=>'Người tạo',
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
                ],
            ]); ?>
        </div>
        <div class="panel-footer">

        </div>
    </div>

</div>
