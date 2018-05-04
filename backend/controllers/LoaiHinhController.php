<?php

namespace backend\controllers;
use app\models\Dungchung;
use Yii;
use app\models\LoaiHinh;
use app\models\LoaiHinhSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * LoaiHinhController implements the CRUD actions for LoaiHinh model.
 */
class LoaiHinhController extends Controller
{
    /**
     * @inheritdoc
     */
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

    /**
     * Lists all LoaiHinh models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new LoaiHinhSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andFilterWhere(['or',['trang_thai'=>LoaiHinh::LOAI_HINH_MOI],['trang_thai'=>LoaiHinh::CHO_KIEM_DUYET],['trang_thai'=>LoaiHinh::KHONG_DUYET]]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single LoaiHinh model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new LoaiHinh model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new LoaiHinh();

        if ($model->load(Yii::$app->request->post())) {
             $model->ma=Dungchung::SinhMa('LH-','loai_hinh');
            $model->ngay_tao=date("Y-m-d");
            $model->nguoi_tao=Yii::$app->user->id;
            $model->trang_thai=LoaiHinh::LOAI_HINH_MOI;
            if($model->save()){
                Yii::$app->session->setFlash('success','Thêm loại hình doanh nghiệp thành công !');
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                Yii::$app->session->setFlash('error','Thêm loại hình doanh nghiệp thất bại, kiểm tra lại dữ liệu');
                return $this->render('create',['model'=>$model]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing LoaiHinh model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
       $model = $this->findModel($id);
        $maCu=$model->ma;
        if ($model->load(Yii::$app->request->post())) {
            $maMoi=$model->ma;
            if($maCu!==$maMoi){
                if($this->checkMa($maMoi)==true) {
                    Yii::$app->session->setFlash('error','Mã loại hình doanh nghiệp đã tồn tại, vui lòng chọn mã khác');
                    return $this->render('update',['model'=>$model]);
                }
                $model->ma=$maMoi;
            } else {
                $model->ma=$maCu;
            }
            $model->nguoi_cap_nhat=Yii::$app->user->id;
            $model->ngay_cap_nhat=date("Y-m-d");
            if($model->save()){
                Yii::$app->session->setFlash('success','Cập nhật loại hình doanh nghiệp thành công.');
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                Yii::$app->session->setFlash('error','Cập nhật loại hình doanh nghiệp thất bại');
                return $this->render('update',['model'=>$model]);
            }
        }
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing LoaiHinh model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        Yii::$app->session->setFlash('success','Xóa doanh nghiệp thành công!');
        return $this->redirect(['kiem-duyet']);
    }

    /**
     * Finds the LoaiHinh model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return LoaiHinh the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = LoaiHinh::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    protected function checkMa($str)
    {
        if(LoaiHinh::find()->where(['ma'=>$str])->count()>0)
        {
            return true;
        }
        return false;
    }

    public function actionChuyenDuyet($id)
    {
        $model=$this->findModel($id);
        if($model->trang_thai==LoaiHinh::KHONG_DUYET){
            $model->nguoi_cap_nhat=Yii::$app->user->id;
            $model->ngay_cap_nhat=date("Y-m-d");
        }
        $model->trang_thai=LoaiHinh::CHO_KIEM_DUYET;
        if($model->save()){
            Yii::$app->session->setFlash('success','Chuyển duyệt loại hình thành công');
            return $this->redirect('index.php?r=kiem-duyet-loai-hinh/index');
        }
    }

    public function actionKiemDuyet()
    {
        $searchModel = new LoaiHinhSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andFilterWhere(['trang_thai'=>LoaiHinh::DA_DUYET]);

        return $this->render('kiemDuyet', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionXemKiemDuyet($id)
    {
        return $this->render('xemKiemDuyet', [
            'model' => $this->findModel($id),
        ]);
    }
}
