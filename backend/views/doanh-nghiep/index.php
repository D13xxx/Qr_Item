<?php
use yii\grid\ActionColumn;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\models\DoanhNghiep;
/* @var $this yii\web\View */
/* @var $searchModel app\models\DoanhNghiepSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Doanh Nghiệp';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="doanh-nghiep-index">
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
        <div class="panel-group">
                <div class="panel panel-primary">
                    <div class="panel-heading">* <i class="glyphicon glyphicon-sort-by-alphabet-alt"></i>Thông tin nhóm sản phẩm</div>
                    <div class="panel-body">
                        <?php \yii\widgets\Pjax::begin( ['enablePushState'=>false])?>
                        <?= GridView::widget([
                            'dataProvider' => $dataProvider,
                            'filterModel' => $searchModel,
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn','contentOptions'=>['style'=>['vertical-align'=>'middle']]],
                                ['attribute'=>'ma','contentOptions'=>['style'=>['vertical-align'=>'middle']]],
                                ['attribute'=>'ten','contentOptions'=>['style'=>['vertical-align'=>'middle']]],
                                // 'ten_giao_dich',
                                //'dia_chi:ntext',
                                // 'nguoi_dai_dien',
                                //'so_dang_ky_kinh_doanh',
                                // 'dien_thoai',
                                [
                                   'attribute'=>'loai_hinh_id',
                                   'contentOptions'=>['style'=>['vertical-align'=>'middle']],
                                   'filter'=>\yii\helpers\ArrayHelper::map(\app\models\LoaiHinh::find()->all(),'id','ten'),
                                   'value'=>function($data){
                                       $loaiHinh=\app\models\LoaiHinh::find()->where(['id'=>$data->loai_hinh_id])->one();
                                       return $loaiHinh->ten;
                                   }
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
                                    'attribute'=>'trang_thai',
                                    'contentOptions'=>['style'=>['vertical-align'=>'middle']],
                                    'filter'=>array(DoanhNghiep::DN_MOI=>'Mới tạo',DoanhNghiep::DN_KHONG_DUYET=>'Không duyệt',DoanhNghiep::DN_CHO_DUYET=>'Chờ kiểm duyệt'),
                                    'value'=>function($data)
                                    {
                                        if($data->trang_thai==DoanhNghiep::DN_MOI){
                                            return 'Mới tạo';
                                        }
                                        if($data->trang_thai==DoanhNghiep::DN_KHONG_DUYET) {
                                            return 'Không duyệt';
                                        }
                                        if($data->trang_thai==DoanhNghiep::DN_CHO_DUYET)
                                        {
                                            return 'Chờ kiểm duyệt';
                                        }
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

//                                'nguoi_cap_nhat',
                                //'ngay_cap_nhat',
                                'loai_hinh_id',

                                [
                                    'class' => 'yii\grid\ActionColumn',
                                    'contentOptions'=>['style'=>['vertical-align'=>'middle']],
                                    'template'=>'{view} {update} {chuyen-duyet}',
                                    'visibleButtons'=>[
                                        'chuyen-duyet'=>function($data){
                                            if($data->trang_thai==\app\models\DoanhNghiep::DN_MOI||$data->trang_thai==\app\models\DoanhNghiep::DN_KHONG_DUYET){
                                                return true;
                                            }
                                        }
                                    ],
                                    'buttons'=>[
                                        'chuyen-duyet'=>function($url,$data)
                                        {
                                            $url=\yii\helpers\Url::to(['chuyen-duyet','id'=>$data->id]);
                                            return Html::a('<span class="glyphicon glyphicon-share-alt"></span>',$url,[
                                                'title'=>'Chuyển duyệt phiếu',
                                                'data'=>['method'=>'post']
                                            ]);
                                        }
                                    ],
                                ],
                            ],
                        ]); ?>
                        <?php \yii\widgets\Pjax::end()?>
                    </div>
                    <div class="panel-footer">
                        <div class="form-group">
                            <p>
                                <?= Html::a('<i class="glyphicon glyphicon-plus-sign"></i> Tạo mới doanh nghiệp', ['create'], ['class' => 'btn btn-success']) ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

    <?php Pjax::end(); ?>
</div>
