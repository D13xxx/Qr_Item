<?php

namespace backend\controllers;

use app\models\Dungchung;
use Yii;
use backend\models\LoaiHinh;
use backend\models\LoaiHinhSearch;
use app\models\DoanhNghiep;
use app\models\DoanhNghiepSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


class KiemDuyetDoanhNghiepController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $searchModel = new DoanhNghiepSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andFilterWhere(['trang_thai'=>DoanhNghiep::DN_CHO_DUYET]);

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

    public function actionDuyetDn($id)
    {
        $model=$this->findModel($id);
        $model->trang_thai=DoanhNghiep::DN_DUYET;
        $model->nguoi_cap_nhat=Yii::$app->user->id;
        $model->ngay_cap_nhat=date("Y-m-d");
        if($model->save())
        {
            Yii::$app->session->setFlash('success','Đã kiểm duyệt thành công.');
            return $this->redirect('index.php?r=doanh-nghiep/kiem-duyet');
        }


    }

    // public function beforeAction($action)
    // {
    //     if(Yii::$app->user->isGuest){
    //         return $this->redirect('/site/login');
    //     }
    //     return true;
    // }

    public function actionKhongDuyetDn($id)
    {
        $model=$this->findModel($id);
        $model->trang_thai=DoanhNghiep::DN_KHONG_DUYET;
        $model->nguoi_cap_nhat=Yii::$app->user->id;
        $model->ngay_cap_nhat=date("Y-m-d");
        if($model->save())
        {
            Yii::$app->session->setFlash('success','Chuyển lại đề nghị thành công.');
            return $this->redirect('index.php?r=doanh-nghiep/index');
        }
    }

    protected function findModel($id)
    {
        if (($model = DoanhNghiep::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
