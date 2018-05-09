<?php

namespace backend\controllers;
use app\models\DoanhNghiep;
use app\models\Dungchung;
use app\models\ThuocTinhSanPham;
use app\models\ThuocTinhSanPhamSearch;
use Yii;
use backend\models\SanPham;
use backend\models\SanPhamSearch;
use backend\models\NhomSanPham;
use backend\models\NhomSanPhamSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
class KiemDuyetSanPhamController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'kiem-duyet' => ['POST'],
                    'khong-duyet'=>['POST'],
                ],
            ],
        ];
    }
    public function actionIndex()
    {
        $searchModel = new SanPhamSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andFilterWhere(['trang_thai'=>SanPham::SP_CHUYEN_DUYET]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        $model=$this->findModel($id);

        $searchThongTin=new ThuocTinhSanPhamSearch();
        $dataThongTin = $searchThongTin->search(Yii::$app->request->queryParams);
        $dataThongTin->query->andFilterWhere(['thuoc_san_pham_id'=>$model->id]);

        return $this->render('view', [
            'model' => $model,
            'searchThongTin'=>$searchThongTin,
            'dataThongTin'=>$dataThongTin,
        ]);
    }

    protected function findModel($id)
    {
        if (($model = SanPham::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('Không tồn tại sản phẩm này.');
    }

    public function actionKiemDuyet($id)
    {
        $model=$this->findModel($id);
        $model->ngay_cap_nhat=date("Y-m-d");
        $model->nguoi_cap_nhat=Yii::$app->user->id;
        $model->trang_thai=SanPham::SP_DUYET;
        if($model->save()){
            Yii::$app->session->setFlash('success','Kiểm duyệt sản phẩm thành công.');
            return $this->redirect('../san-pham/da-duyet');
        }
    }

    public function actionKhongDuyet($id)
    {
        $model=$this->findModel($id);
        $model->ngay_cap_nhat=date("Y-m-d");
        $model->nguoi_cap_nhat=Yii::$app->user->id;
        $model->trang_thai=SanPham::SP_KHONG_DUYET;
        if($model->save()){
            Yii::$app->session->setFlash('success','Không duyệt sản phẩm thành công.');
            return $this->redirect('../san-pham/index');
        }
    }
}
