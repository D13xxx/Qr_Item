<?php

namespace frontend\controllers;
use backend\models\SanPhamSearch;
use Yii;
use backend\models\SanPham;
use app\models\ThuocTinhSanPhamSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;


class QrcodeController extends \yii\web\Controller
{
    public function actionIndex()
    {
         $searchModel = new SanPhamSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andFilterWhere(['trang_thai'=>SanPham::SP_DUYET]);
        $dataProvider->pagination->pageSize=10;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
     public function actionView($id)
    {

        $model=$this->findModel($id);
        if($model->trang_thai!==SanPham::SP_DUYET){
            throw new NotFoundHttpException('Sản phẩm này chưa được kiểm duyệt');
        }

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
        if(($model=SanPham::findOne($id))!==null)
        {
            return $model;
        }

        throw new NotFoundHttpException('Không tìm thấy sản phẩm này');
    }

}
