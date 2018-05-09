<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\LoaiHinhSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '';
$this->params['breadcrumbs'][] = "Danh mục loại hình doanh nghiệp";
?>
<br>
<div class="loai-hinh-index">
        <div class="panel-group">
                <div class="panel panel-primary">
                    <div class="panel-heading">* <i class="glyphicon glyphicon-sort-by-alphabet-alt"></i>Danh mục loại hình doanh nghiệp</div>
                    <div class="panel-body">
                        <?php \yii\widgets\Pjax::begin( ['enablePushState'=>false])?>
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
                            'attribute'=>'trang_thai',
                            'filter'=>array('0'=>'Loại hình mới','1'=>'Chờ xét duyệt','3'=>'Không duyệt'),
                            'value'=>function($data)
                            {
                                if($data->trang_thai==\app\models\LoaiHinh::LOAI_HINH_MOI){
                                    return 'Loại hình mới';
                                }
                                if($data->trang_thai==\app\models\LoaiHinh::CHO_KIEM_DUYET){
                                    return 'Chờ xét duyệt';
                                }
                                if($data->trang_thai==\app\models\LoaiHinh::KHONG_DUYET){
                                    return 'Không duyệt';
                                }
                            }
                        ],
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'template'=>'{view} {update} {chuyen-duyet}',
                            'visibleButtons'=>[
                                'chuyen-duyet'=> function($data){
                                    if($data->trang_thai==\app\models\LoaiHinh::KHONG_DUYET||$data->trang_thai==\app\models\LoaiHinh::LOAI_HINH_MOI){
                                        return true;
                                    }
                                }
                            ],
                            'buttons'=>[
                                'chuyen-duyet'=>function($url,$data){
                                    $url=\yii\helpers\Url::to(['chuyen-duyet','id'=>$data->id]);
                                    return Html::a('<span class="glyphicon glyphicon-share-alt"></span>',$url,[
                                        'title'=>'Chuyển duyệt loại hình doanh nghiệp',
                                        'data'=>['method'=>'post'],
                                        'class'=>'btn btn-default'
                                    ]);
                                }
                            ]
                        ],
                    ],
                ]); ?>
                <?php \yii\widgets\Pjax::end()?>
            </div>
            <div class="panel-footer">
                <div class="form-group">
                    <p>
                        <?= Html::a('<i class="glyphicon glyphicon-plus-sign"></i> Tạo mơi', ['create'], ['class' => 'btn btn-success']) ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
