<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use app\models\DoanhNghiep;
use app\models\LoaiHinh;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DoanhNghiepSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Doanh nghiệp';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="doanh-nghiep-index">

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
                    // 'id',
                    ['attribute'=>'ma','contentOptions'=>['style'=>['vertical-align'=>'middle']]],
                    ['attribute'=>'ten','contentOptions'=>['style'=>['vertical-align'=>'middle']]],
                    // 'ten_giao_dich',
                    'dia_chi:ntext',
                    'nguoi_dai_dien',
                    // 'so_dang_ky_kinh_doanh',
                    'dien_thoai',
                    // [
                    //    'attribute'=>'loai_hinh_id',
                    //    'contentOptions'=>['style'=>['vertical-align'=>'middle']],
                    //    'filter'=>\yii\helpers\ArrayHelper::map(\app\models\LoaiHinh::find()->all(),'id','ten'),
                    //    'value'=>function($data){
                    //        $loaiHinh=\app\models\LoaiHinh::find()->where(['id'=>$data->loai_hinh_id])->one();
                    //        return $loaiHinh->ten;
                    //    }
                    // ],
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
                    // [
                    //     'attribute'=>'ngay_cap_nhat',
                    //     'contentOptions'=>['style'=>['vertical-align'=>'middle']],
                    //     'filter'=>\kartik\widgets\DatePicker::widget([
                    //         'model'=>$searchModel,
                    //         'attribute'=>'ngay_cap_nhat',
                    //         'pluginOptions' => [
                    //             'autoclose'=>true,
                    //             'format'=>'dd/mm/yyyy',
                    //             'todayHighlight' => true,
                    //         ]
                    //     ]),
                    //     'value'=>function($data)
                    //     {
                    //         return date("d/m/Y",strtotime($data->ngay_cap_nhat));
                    //     }
                    // ],

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
