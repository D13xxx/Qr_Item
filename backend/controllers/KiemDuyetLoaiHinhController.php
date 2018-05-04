<?php

namespace backend\controllers;
use app\models\Dungchung;
use Yii;
use app\models\LoaiHinh;
use app\models\LoaiHinhSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
class KiemDuyetLoaiHinhController extends \yii\web\Controller
{
    // public function actionView()
    // {
    //     return $this->render('view');
    // }
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }
    // public function beforeAction($action)
    // {
    //     if(Yii::$app->user->isGuest){
    //         return $this->redirect('/site/login');
    //     }
    //     return true;
    // }
    public function actionIndex()
    {
        $searchModel = new LoaiHinhSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andFilterWhere(['trang_thai'=>LoaiHinh::CHO_KIEM_DUYET]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);

    }

    public function actionKiemDuyetLoaiHinh($id){
        $model=$this->findModel($id);
        $model->trang_thai=LoaiHinh::DA_DUYET;
        $model->ngay_cap_nhat=date("Y-m-d");
        $model->nguoi_cap_nhat=Yii::$app->user->id;
        if($model->save())
        {
            Yii::$app->session->setFlash('success','Kiểm duyệt thành công');
            return $this->redirect('index.php?r=loai-hinh/kiem-duyet');
        }
    }



    public function actionKhongDuyet($id)
    {
        $model=$this->findModel($id);

        $model->trang_thai=LoaiHinh::KHONG_DUYET;
        $model->save();
        return $this->redirect('index.php?r=kiem-duyet-loai-hinh/index');
    }

    protected function findModel($id)
    {
        if (($model = LoaiHinh::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('Không tồn tại loại hình doanh nghiệp này.');
    }

}

