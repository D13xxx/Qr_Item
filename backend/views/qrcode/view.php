<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\SanPham */

$this->title ='Thông tin sản phẩm: ' .$model->ma;
$this->params['breadcrumbs'][] = ['label' => 'Sản phẩm', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="san-pham-view">

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
                        'attribute'=>'anh_dai_dien',
                        'format'=>'raw',
                        'value'=>function($data){
                            if($data->anh_dai_dien!==''||$data->anh_dai_dien!==null){
                                return Html::img(Yii::getAlias('@web').'/images/san-pham/'.$data->anh_dai_dien,[
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
                    [
                        'attribute'=>'nhom_san_pham_id',
                        'value'=>function($data)
                        {
                            $nhomSP=\backend\models\NhomSanPham::find()->where(['id'=>$data->nhom_san_pham_id])->one();
                            return $nhomSP->ten;
                        }
                    ],
                    [
                        'attribute'=>'doanh_nghiep_id',
                        'value'=>function($data)
                        {
                            $doanhNghiep=\app\models\DoanhNghiep::find()->where(['id'=>$data->doanh_nghiep_id])->one();
                            return $doanhNghiep->ten;
                        }
                    ],
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
                        'contentOptions'=>['style'=>['vertical-align'=>'middle']],
                        'filter'=>\yii\helpers\ArrayHelper::map(\common\models\User::find()->all(),'id','username'),
                        'value'=>function($data)
                        {
                            $nguoiTao=\common\models\User::find()->where(['id'=>$data->nguoi_tao])->one();
                            return $nguoiTao->username;
                        }
                    ],
                     [
                        'attribute'=>'nguoi_cap_nhat',
                        'contentOptions'=>['style'=>['vertical-align'=>'middle']],
                        'filter'=>\yii\helpers\ArrayHelper::map(\common\models\User::find()->all(),'id','username'),
                        'value'=>function($data)
                        {
                            $nguoiTao=\common\models\User::find()->where(['id'=>$data->nguoi_cap_nhat])->one();
                            return $nguoiTao->username;
                        }
                     ],
                    'ngay_cap_nhat',
//                     [
//                         'attribute'=>'ngay_cap_nhat',
//                         'contentOptions'=>['style'=>['vertical-align'=>'middle']],
//                         'filter'=>\kartik\widgets\DatePicker::widget([
//                             'model'=>$searchModel,
//                             'attribute'=>'ngay_cap_nhat',
//                             'pluginOptions' => [
//                                 'autoclose'=>true,
//                                 'format'=>'dd/mm/yyyy',
//                                 'todayHighlight' => true,
//                             ]
//                         ]),
//                         'value'=>function($data)
//                         {
//                             return date("d/m/Y",strtotime($data->ngay_cap_nhat));
//                         }
//                     ],
                ],
            ]) ?>
        </div>
        <h4 style="text-align: center">Chi tiết sản phẩm</h4>
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
                        'format'=>'html',
                        'contentOptions'=>['style'=>['vertical-align'=>'middle']],
                        'value'=>function($data){
                            if($data->san_pham_id==0){
                                return 'Là sản phẩm gốc';
                            } else {
                                $sanPham=\backend\models\SanPham::find()->where(['id'=>$data->san_pham_id])->one();
                                return Html::a($sanPham->ten,['view','id'=>$data->san_pham_id]);
                            }
                        }
                    ],
                ]
            ])?>
        </div>
        <div class="panel-footer">
            <?= Html::a('Quay lại',['index'],['class'=>'btn btn-default'])?>
        </div>
    </div>

</div>
