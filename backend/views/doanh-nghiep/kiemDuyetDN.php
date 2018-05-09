<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use app\models\DoanhNghiep;
use app\models\LoaiHinh;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DoanhNghiepSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '';
$this->params['breadcrumbs'][] = "Danh mục doanh nghiệp đã duyệt";
?>
<br>
<div class="doanh-nghiep-index">

    <div class="panel panel-primary">
        <div class="panel-heading">
            <h4 class="panel-title">
                Danh mục doanh nghiệp
            </h4>
        </div>
        <div class="panel-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn','contentOptions'=>['style'=>['vertical-align'=>'middle']]],
                    ['attribute'=>'ma','contentOptions'=>['style'=>['vertical-align'=>'middle']]],
                    ['attribute'=>'ten','contentOptions'=>['style'=>['vertical-align'=>'middle']]],
                    [
                        'attribute'=>'logo_doanh_nghiep',
                        'format'=>'raw',
                        'value'=>function($data){
                            if($data->logo_doanh_nghiep!==''||$data->logo_doanh_nghiep!==null){
                                return Html::img(Yii::getAlias('@web').'/images/doanh-nghiep/'.$data->logo_doanh_nghiep,[
                                    'style'=>[
                                        'width'=>'120px',
                                        'height'=>'120px',
                                    ]
                                ]);
                            }
                        }
                    ],
                    [
                        'attribute'=>'dien_thoai',
                        'contentOptions'=>['style'=>['vertical-align'=>'middle']],
                    ],
                    [
                        'attribute'=>'nguoi_dai_dien',
                        'contentOptions'=>['style'=>['vertical-align'=>'middle']],
                    ],
                    [
                        'attribute'=>'ngay_tao',
                        'contentOptions'=>['style'=>['vertical-align'=>'middle']],
                        'filter'=>\kartik\date\DatePicker::widget([
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
                        'class' => 'yii\grid\ActionColumn',
                        'contentOptions'=>['style'=>['vertical-align'=>'middle']],
                        'template'=>'{view} {update}{delete}',
                    ],
                ],
            ]); ?>
        </div>
        <div class="panel-footer">

        </div>
    </div>

</div>
