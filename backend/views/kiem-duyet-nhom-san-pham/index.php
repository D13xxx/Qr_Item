<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use backend\models\NhomSanPham;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\NhomSanPhamSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '';
$this->params['breadcrumbs'][] = "Danh mục kiểm duyệt nhóm sản phẩm";
?>
<br>
<div class="nhom-san-pham-index">

    <div class="panel panel-primary">
        <div class="panel-heading">
            <h4 class="panel-title">
               <p>Danh mục kiểm duyệt nhóm sản phẩm</p>
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
                            $nguoiTao=\common\models\User::find()->where(['id'=>$data->nguoi_tao])->one();
                            return $nguoiTao->username;
                        }
                    ],
                    [
                        'attribute'=>'ngay_tao',
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

                        'template'=>'{view} {kiem-duyet} {khong-duyet}',
                        'buttons'=>[
                            'kiem-duyet'=>function($url,$data){
                                $url=\yii\helpers\Url::to(['kiem-duyet','id'=>$data->id]);
                                return Html::a('<span class="glyphicon glyphicon-ok"></span>',$url,[
                                    'title'=>'Duyệt nhóm sản phẩm',
                                    'class'=>'btn btn-success'
                                ]);
                            },
                            'khong-duyet'=>function($url,$data){
                                $url=\yii\helpers\Url::to(['khong-duyet-nhom-san-pham','id'=>$data->id]);
                                return Html::a('<span class="glyphicon glyphicon-remove"></span>',$url,[
                                    'title'=>'Không duyệt nhóm sản phẩm',
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
