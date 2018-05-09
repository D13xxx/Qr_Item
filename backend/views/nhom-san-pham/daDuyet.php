<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;
use app\models\NhomSanPham;

/* @var $this yii\web\View */
/* @var $searchModel app\models\NhomSanPhamSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '';
$this->params['breadcrumbs'][] = "Danh mục nhóm sản phẩm đã duyệt";
?>
<br>
<div class="nhom-san-pham-index">

    <div class="panel panel-primary">
        <div class="panel-heading">
            <h4 class="panel-title">
                <p>Danh mục nhóm sản phẩm đã duyệt</p>
            </h4>
        </div>
        <div class="panel-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn','contentOptions'=>['style'=>['vertical-align'=>'middle']]],

                    [
                        'attribute'=>'ma',
                        'contentOptions'=>['style'=>['vertical-align'=>'middle']]
                    ],
                    [
                        'attribute'=>'ten',
                        'contentOptions'=>['style'=>['vertical-align'=>'middle']]
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
                        'attribute'=>'ngay_tao',
                        'contentOptions'=>['style'=>['vertical-align'=>'middle']],
                        'filter'=>\kartik\widgets\DatePicker::widget([
                            'model'=>$searchModel,
                            'attribute'=>'ngay_tao',
                            'pluginOptions' => [
                                'autoclose'=>true,
                                'format'=>'dd/mm/yyyy',
                                'todayHighlight' => true,
                            ]
                        ]),
                        'value'=>function($data)
                        {
                            return date("d/m/Y",strtotime($data->ngay_tao));
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
                    [
                        'attribute'=>'ngay_cap_nhat',
                        'contentOptions'=>['style'=>['vertical-align'=>'middle']],
                        'filter'=>\kartik\widgets\DatePicker::widget([
                            'model'=>$searchModel,
                            'attribute'=>'ngay_cap_nhat',
                            'pluginOptions' => [
                                'autoclose'=>true,
                                'format'=>'dd/mm/yyyy',
                                'todayHighlight' => true,
                            ]
                        ]),
                        'value'=>function($data)
                        {
                            return date("d/m/Y",strtotime($data->ngay_cap_nhat));
                        }
                    ],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'contentOptions'=>['style'=>['vertical-align'=>'middle']],
                        'template'=>'{view} {update} {delete}',
                    ],
                ],
            ]); ?>
        </div>
        <div class="panel-footer">

        </div>
    </div>

</div>
