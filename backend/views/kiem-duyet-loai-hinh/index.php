<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;
use kartik\date;

/* @var $this yii\web\View */
/* @var $searchModel app\models\LoaiHinhSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Loại hình doanh nghiệp';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="loai-hinh-index">

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
                        'attribute'=>'ngay_cap_nhat',
                        'filter'=>\kartik\widgets\DatePicker::widget([
                            'model' => $searchModel,
                            'attribute' => 'ngay_cap_nhat',
                            //'type'=>date\DatePicker::TYPE_INPU,
                            'pluginOptions' => [
                                'autoclose'=>true,
                                'format'=>'dd/mm/yyyy',
                                'todayHighlight' => true,
                            ]
                        ]),
                        'value'=>function($data){
                            if($data->ngay_cap_nhat==''||$data->ngay_cap_nhat==null){
                                return '';
                            }
                            return date("d/m/Y",strtotime($data->ngay_cap_nhat));
                        }
                    ],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template'=>'{view} {kiem-duyet} {khong-duyet}',
                        'buttons'=>[
                            'kiem-duyet'=>function($url,$data){
                                $url=\yii\helpers\Url::to(['kiem-duyet-loai-hinh','id'=>$data->id]);
                                return Html::a('<span class="glyphicon glyphicon-ok"></span>',$url,[
                                    'title'=>'Duyệt loại hình doanh nghiệp',
                                    'class'=>'btn btn-success'
                                ]);
                            },
                            'khong-duyet'=>function($url,$data){
                                $url=\yii\helpers\Url::to(['khong-duyet','id'=>$data->id]);
                                return Html::a('<span class="glyphicon glyphicon-remove"></span>',$url,[
                                    'title'=>'Không duyệt loại hình kinh doanh',
                                    'class'=>'btn btn-danger'
                                ]);
                            }
                        ],
                    ],
                ],
            ]); ?>
        </div>
        <div class="panel-footer">

        </div>
    </div>

</div>
