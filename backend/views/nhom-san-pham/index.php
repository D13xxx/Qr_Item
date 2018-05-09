<?php

use yii\helpers\Html;
use kartik\grid\GridView;
//use yii\grid\GridView;
use backend\models\NhomSanPham;


/* @var $this yii\web\View */
/* @var $searchModel app\models\NhomSanPhamSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Nhóm sản phẩm';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="nhom-san-pham-index">

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
                        'attribute'=>'ma',
                        'contentOptions'=>['style'=>['vertical-align'=>'middle']]
                    ],
                    ['attribute'=>'ten','contentOptions'=>['style'=>['vertical-align'=>'middle']]],
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
                        'attribute'=>'trang_thai',
                        'contentOptions'=>['style'=>['vertical-align'=>'middle']],
                        'filter'=>array(NhomSanPham::NHOM_MOI=>'Nhóm sản phẩm mới',NhomSanPham::NHOM_CHUYEN_DUYET=>'Đang chờ duyệt',NhomSanPham::NHOM_KHONG_DUYET=>'Không Duyệt'),
                        'value'=>function($data)
                        {
                            if($data->trang_thai==NhomSanPham::NHOM_MOI)
                            {
                                return 'Nhóm sản phẩm mới';
                            }
                            if($data->trang_thai==NhomSanPham::NHOM_CHUYEN_DUYET)
                            {
                                return 'Đang chờ duyệt';
                            }
                            if($data->trang_thai==NhomSanPham::NHOM_KHONG_DUYET)
                            {
                                return 'Không duyệt';
                            }
                        }
                    ],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'contentOptions'=>['style'=>['vertical-align'=>'middle']],
                        'template'=>'{view} {update} {chuyen-duyet}',
                        'visibleButtons'=>[
                            'chuyen-duyet'=>function($data)
                            {
                                if($data->trang_thai==NhomSanPham::NHOM_MOI||$data->trang_thai==NhomSanPham::NHOM_KHONG_DUYET){
                                    return true;
                                }
                            }
                        ],
                        'buttons'=>[
                            'chuyen-duyet'=>function($url,$data){
                                $url=\yii\helpers\Url::to(['chuyen-duyet','id'=>$data->id]);
                                return Html::a('<span class="glyphicon glyphicon-share-alt"></span>',$url,[
                                    'title'=>'Chuyển duyệt',
                                    'data'=>['method'=>'post'],
                                    'class'=>'btn btn-default'
                                ]);
                            }
                        ]
                    ],
                ],
            ]); ?>
        </div>
        <div class="panel-footer">
            <?= Html::a('<span class="fa fa-plus"></span> Thêm mới', ['create'], ['class' => 'btn btn-success']) ?>
        </div>
    </div>

</div>
