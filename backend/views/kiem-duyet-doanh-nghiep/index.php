<?php
use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\date;
use app\models\DoanhNghiep;


/* @var $this yii\web\View */
/* @var $searchModel app\models\LoaiHinhSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Danh sách doanh nghiệp';
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
                    ['class' => 'yii\grid\SerialColumn','contentOptions'=>['style'=>['vertical-align'=>'middle']]],
//                    [
//                        'label'=>'Logo',
//                        'format'=>'raw',
//                        'value'=>function($data){
//                            if($data->logo_doanh_nghiep!==''||$data->logo_doanh_nghiep!==null){
//                                return Html::img(Yii::getAlias('@web').'/images/doanh-nghiep/'.$data->logo_doanh_nghiep,[
//                                    'style'=>[
//                                        'width'=>'120px',
//                                        'height'=>'120px',
//                                    ]
//                                ]);
//                            }
//                        }
//                    ],
                    ['attribute'=>'ma','contentOptions'=>['style'=>['vertical-align'=>'middle']]],
                    ['attribute'=>'ten','contentOptions'=>['style'=>['vertical-align'=>'middle']]],
                    //'ten_giao_dich',
                    //'dia_chi:ntext',
                    //'nguoi_dai_dien',
                    //'so_dang_ky_kinh_doanh',
                    //'dien_thoai',
//                     [
//                         'attribute'=>'loai_hinh_id',
//                         'contentOptions'=>['style'=>['vertical-align'=>'middle']],
//                         'filter'=>\yii\helpers\ArrayHelper::map(\app\models\LoaiHinh::find()->all(),'id','ten'),
//                         'value'=>function($data){
//                             $loaiHinh=\app\models\LoaiHinh::find()->where(['id'=>$data->loai_hinh_id])->one();
//                             return $loaiHinh->ten;
//                         }
//                     ],
                    'loai_hinh_id',
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


                    //'nguoi_cap_nhat',
                    //'ngay_cap_nhat',

                    [
                        'class' => 'yii\grid\ActionColumn',
                        'contentOptions'=>['style'=>['vertical-align'=>'middle']],
                        'template'=>'{view} {kiem-duyet} {khong-duyet}',
                        'buttons'=>[
                            'kiem-duyet'=>function($url,$data){
                                $url=\yii\helpers\Url::to(['duyet-dn','id'=>$data->id]);
                                return Html::a('<span class="glyphicon glyphicon-ok"></span>',$url,[
                                    'title'=>'Duyệt doanh nghiệp',
                                    'data'=>['method'=>'post'],
                                    'class'=>'btn btn-success'
                                ]);
                            },
                            'khong-duyet'=>function($url,$data){
                                $url=\yii\helpers\Url::to(['khong-duyet-dn','id'=>$data->id]);
                                return Html::a('<span class="glyphicon glyphicon-remove"></span>',$url,[
                                    'title'=>'Không duyệt doanh nghiệp',
                                    'data'=>['method'=>'post'],
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
