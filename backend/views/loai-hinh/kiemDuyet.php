<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;
use kartik\date;

/* @var $this yii\web\View */
/* @var $searchModel app\models\LoaiHinhSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '';
$this->params['breadcrumbs'][] = "Danh mục loại hình đã duyệt";
?>
<br>
<div class="loai-hinh-index">

    <div class="panel panel-primary">
        <div class="panel-heading">
            <h4 class="panel-title">
                Danh mục loại hình đã duyệt
            </h4>
        </div>
        <div class="panel-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'ma',
                    'ten',
                    [
                        'attribute'=>'nguoi_tao',
                        'filter'=>\yii\helpers\ArrayHelper::map(\common\models\User::find()->all(),'id','username'),
                        'value'=>function($data)
                        {
                            if(\common\models\User::find()->where(['id'=>$data->nguoi_tao])->count()>0){
                                $nguoiTao=\common\models\User::find()->where(['id'=>$data->nguoi_tao])->one();
                                return $nguoiTao->username;
                            }
                        }
                    ],
                    [
                        'attribute'=>'ngay_tao',
                        'filter'=>\kartik\widgets\DatePicker::widget([
                            'model' => $searchModel,
                            'attribute' => 'ngay_tao',
                            //'type'=>date\DatePicker::TYPE_INPUT,
                            'pluginOptions' => [
                                'autoclose'=>true,
                                'format'=>'dd/mm/yyyy',
                                'todayHighlight' => true,
                            ]
                        ]),
                        'value'=>function($data){
                            return date("d/m/Y",strtotime($data->ngay_tao));
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
                        'template'=>'{view} {update} {delete}',
//                        'buttons'=>[
//                            'view'=>function($url,$data){
//                                $url=\yii\helpers\Url::to(['/loai-hinh/xem-kiem-duyet','id'=>$data->id]);
//                                return Html::a('<span class="glyphicon glyphicon-eye-open"></span>',$url,[
//                                    'title'=>'Thông tin chi tiết loại hình',
//                                ]);
//
//                            }
//                        ]
                    ],
                ],
            ]); ?>
        </div>
        <div class="panel-footer">

        </div>
    </div>

</div>
