<?php
/**
 * Created by PhpStorm.
 * User: cauha
 * Date: 4/10/2018
 * Time: 4:48 PM
 */

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SanPhamSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sản phẩm';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="san-pham-index">

    <div class="panel panel-primary">
        <div class="panel-heading">
            <h4 class="panel-title">
                <?= Html::encode($this->title)?>
            </h4>
        </div>
        <div class="panel-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn','contentOptions'=>['style'=>['vertical-align'=>'middle']]],
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
                    ['attribute'=>'ma','contentOptions'=>['style'=>['vertical-align'=>'middle']]],
                    ['attribute'=>'ten','contentOptions'=>['style'=>['vertical-align'=>'middle']]],
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
                    // 'nhom_san_pham_id',
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
                        //'filter'=>\yii\helpers\ArrayHelper::map(\app\models\DoanhNghiep::find()->where(['trang_thai'=>\app\models\DoanhNghiep::DN_DUYET])->all(),'id','ten'),
                        'value'=>function($data)
                        {
                            $doanhNghiep=\app\models\DoanhNghiep::find()->where(['id'=>$data->doanh_nghiep_id])->one();
                            return $doanhNghiep->ten;
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
//                    [
//                        'attribute'=>'nguoi_cap_nhat',
//                        'contentOptions'=>['style'=>['vertical-align'=>'middle']],
//                        'filter'=>\yii\helpers\ArrayHelper::map(\common\models\User::find()->all(),'id','username'),
//                        'value'=>function($data)
//                        {
//                            $nguoiTao=\common\models\User::find()->where(['id'=>$data->nguoi_cap_nhat])->one();
//                            return $nguoiTao->username;
//                        }
//                    ],
//                    [
//                        'attribute'=>'ngay_cap_nhat',
//                        'contentOptions'=>['style'=>['vertical-align'=>'middle']],
//                        'filter'=>\kartik\widgets\DatePicker::widget([
//                            'model'=>$searchModel,
//                            'attribute'=>'ngay_cap_nhat',
//                            'pluginOptions' => [
//                                'autoclose'=>true,
//                                'format'=>'dd/mm/yyyy',
//                                'todayHighlight' => true,
//                            ]
//                        ]),
//                        'value'=>function($data)
//                        {
//                            return date("d/m/Y",strtotime($data->ngay_cap_nhat));
//                        }
//                    ],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'contentOptions'=>['style'=>['vertical-align'=>'middle']],
                        'template'=>'{view} {update} {delete}',

                    ],
                ],
            ]); ?>
        </div>
        <div class="panel-footer">
            <?= Html::a('<span class="fa fa-plus"></span> Thêm mới', ['create'], ['class' => 'btn btn-success']) ?>
        </div>
    </div>

</div>
