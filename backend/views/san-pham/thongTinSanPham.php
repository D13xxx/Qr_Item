<?php
/**
 * Created by PhpStorm.
 * User: cauha
 * Date: 4/10/2018
 * Time: 4:48 PM
 */

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\ActiveForm;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model backend\models\SanPham */

$this->title ='Thông tin sản phẩm: ' .$model->ma;
$this->params['breadcrumbs'][] = ['label' => 'Sản phẩm', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="san-pham-view">

    <div class="panel panel-primary">
        <div class="panel-heading">
            <h4 class="panel-title">
                <?= Html::encode($this->title) ?>
            </h4>
        </div>
        <div class="panel-body">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    [
                        'label'=>'QR-CODE',
                        'format'=>'raw',
                        'value'=>function($data)
                        {
                            return Html::img(Yii::getAlias('@web').'/qr-code/'.$data->anh_qr,[
                                'style'=>[
                                    'width'=>'120px',
                                    'height'=>'120px',
                                ]
                            ]);
                        }
                    ],
                    'ma',
                    'ten',
                   [
                       'attribute'=>'nhom_san_pham_id',
                       'value'=>function($data)
                       {
                           $nhomSP=\backend\models\NhomSanPham::find()->where(['id'=>$data->nhom_san_pham_id])->one();
                           return $nhomSP->ten;
                       }
                   ],
                   [
                       'attribute'=>'doanh_nghiep_id',
                       'value'=>function($data)
                       {
                           $doanhNghiep=\app\models\DoanhNghiep::find()->where(['id'=>$data->doanh_nghiep_id])->one();
                           return $doanhNghiep->ten;
                       }
                   ],
                    [
                        'attribute'=>'ngay_tao',
                        'value'=>function($data)
                        {
                            return date("d/m/Y",strtotime($data->ngay_tao));
                        }
                    ],
                    [
                        'attribute'=>'nguoi_tao',
                        'value'=>function($data)
                        {
                            $nguoiTao=\common\models\User::find()->where(['id'=>$data->nguoi_tao])->one();
                            return $nguoiTao->username;
                        }
                    ],
                    [
                        'attribute'=>'ngay_cap_nhat',
                        'value'=>function($data)
                        {
                            if($data->ngay_cap_nhat!=''||$data->ngay_cap_nhat!=null){
                                return date("d/m/Y",strtotime($data->ngay_cap_nhat));
                            }
                        }
                    ],
                    [
                        'attribute'=>'nguoi_cap_nhat',
                        'value'=>function($data)
                        {
                            if(\common\models\User::find()->where(['id'=>$data->nguoi_cap_nhat])->count()>0){
                                $nguoiCapNhat=\common\models\User::find()->where(['id'=>$data->nguoi_cap_nhat])->one();
                                return $nguoiCapNhat->username;
                            }
                        }
                    ],
                ],
            ]) ?>
        </div>
        <h4 style="text-align: center">Thông tin sản phẩm</h4>
        <div class="panel-body">
            <?= \kartik\grid\GridView::widget([
                'summary'=>'',
                'dataProvider'=>$dataThongTin,
                'columns'=>[
                    ['class'=>'yii\grid\SerialColumn'],
                    [
                        'label'=>'Tên chi tiết',
                        'value'=>function($data)
                        {
                            return $data->ten;
                        }
                    ],
                    [
                        'label'=>'Diễn giải',
                        'value'=>function($data)
                        {
                            return $data->dien_giai;
                        }
                    ],
                    [
                        'label'=>'Từ sản phẩm (Mã)',
                        'value'=>function($data){
                            if($data->san_pham_id!=0){
                                $sanPham=\backend\models\SanPham::find()->where(['id'=>$data->san_pham_id])->one();
                                return $sanPham->ma;
                            } else {
                                return '';
                            }
                        }
                    ],
                    [
                        'label'=>'Từ sản phẩm (Tên)',
                        'value'=>function($data){
                            if($data->san_pham_id==0){
                                return 'Là sản phẩm gốc';
                            } else {
                                $sanPham=\backend\models\SanPham::find()->where(['id'=>$data->san_pham_id])->one();
                                return $sanPham->ten;
                            }
                        }
                    ],
                    [
                        'class'=>'yii\grid\ActionColumn',
                        'template'=>'{update}',
                        'buttons'=>[
                            'update'=>function($url,$data){
                                $url=\yii\helpers\Url::to(['thong-tin-san-pham-update','id'=>$data->id]);
                                return Html::a('<span class="glyphicon glyphicon-pencil"></span>',$url,['title'=>'Chỉnh sửa thông tin']);
                            }
                        ]
                    ]
                ]
            ])?>
        </div>
        <hr>
        <h4 style="text-align: center">Thêm chi tiết sản phẩm</h4>
        <?php $form = ActiveForm::begin([
            'layout'=>'horizontal',
        ]); ?>
        <div class="panel-body">
            <?= $form->field($modelThongTin,'ten')->textInput()?>

            <?= $form->field($modelThongTin,'dien_giai')->textInput()?>

            <?php
            $sanPham=\backend\models\SanPham::find()->where(['trang_thai'=>\backend\models\SanPham::SP_DUYET])->all();
            $listSanPham=\yii\helpers\ArrayHelper::map($sanPham,'id',function($data){
                $doanhNghiep=\app\models\DoanhNghiep::find()->where(['id'=>$data->doanh_nghiep_id])->one();
                return 'Tên SP:' .$data->ten . ' --- Thuộc DN ---: '. $doanhNghiep->ten;
            });
            ?>
            <?= $form->field($modelThongTin,'san_pham_id')->widget(\kartik\widgets\Select2::className(),[
                'data'=>$listSanPham,
                'options'=>['prompt'=>'Sản phẩm gốc là .... ?'],
                'pluginOptions'=>['allowClear'=>true],
            ])?>

        </div>
        <div class="panel-footer">
            <?= Html::submitButton('<span class="fa fa-check"></span> Thêm mới',['class'=>'btn btn-primary'])?>
            <?= Html::a('<span class="fa fa-reply"></span> Quay lại',['index'],['class'=>'btn btn-default pull-right'])?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>

</div>
