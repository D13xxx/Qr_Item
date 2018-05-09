<?php

namespace backend\controllers;
use app\models\Dungchung;
use Yii;
use backend\models\NhomSanPham;
use backend\models\NhomSanPhamSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class KiemDuyetNhomSanPhamController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'duyet-nhom-sp'=>['POST'],
                    'khong-duyet'=>['POST'],
                ],
            ],
        ];
    }
    
    public function actionIndex()
    {
        $searchModel = new NhomSanPhamSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andFilterWhere(['trang_thai'=>NhomSanPham::NHOM_CHUYEN_DUYET]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    protected function findModel($id)
    {
        if (($model = NhomSanPham::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionKiemDuyet($id)
    {
        $model=$this->findModel($id);
        $model->nguoi_cap_nhat=Yii::$app->user->id;
        $model->ngay_cap_nhat=date("Y-m-d");
        $model->trang_thai=NhomSanPham::NHOM_DA_DUYET;
        if($model->save())
        {
            Yii::$app->session->setFlash('success','Đã duyệt nhóm sản phẩm thành công.');
            return $this->redirect('../nhom-san-pham/da-duyet');
        }
    }

    public function actionKhongDuyetNhomSanPham($id)
    {
        $model=$this->findModel($id);
        $model->nguoi_cap_nhat=Yii::$app->user->id;
        $model->ngay_cap_nhat=date("Y-m-d");
        $model->trang_thai=NhomSanPham::NHOM_KHONG_DUYET;
        if($model->save())
        {
            Yii::$app->session->setFlash('success','Không duyệt nhóm sản phẩm thành công.');
            return $this->redirect('../nhom-san-pham/index');
        }
    }

}
