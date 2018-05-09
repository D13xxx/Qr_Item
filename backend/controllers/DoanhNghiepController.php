<?php

namespace backend\controllers;

use app\models\Dungchung;
use Yii;
use app\models\DoanhNghiep;
use app\models\DoanhNghiepSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;


/**
 * DoanhNghiepController implements the CRUD actions for DoanhNghiep model.
 */
class DoanhNghiepController extends Controller
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
     * Lists all DoanhNghiep models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DoanhNghiepSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andFilterWhere(['or',['trang_thai'=>DoanhNghiep::DN_MOI],['trang_thai'=>DoanhNghiep::DN_CHO_DUYET],['trang_thai'=>DoanhNghiep::DN_KHONG_DUYET]]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single DoanhNghiep model.
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
     * Creates a new DoanhNghiep model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new DoanhNghiep();
        if ($model->load(Yii::$app->request->post())) {
            $model->ma=Dungchung::SinhMa('DN-','doanh_nghiep');
            $model->nguoi_tao=Yii::$app->user->id;
            $model->ngay_tao=date("Y-m-d");
            $model->trang_thai=DoanhNghiep::DN_MOI;
            $fileUpload=UploadedFile::getInstance($model,'logo_doanh_nghiep');
            if(!is_null($fileUpload)){
                $fileTam=$fileUpload->name;
                Yii::$app->params['uploadPath']=Yii::$app->basePath .'/web/images/doanh-nghiep/';
                $path=Yii::$app->params['uploadPath'].$fileTam;
                $model->logo_doanh_nghiep=$fileTam;
                $fileUpload->saveAs($path);

            }
            //return print_r($model);
            if($model->save())
            {
                Yii::$app->session->setFlash('success','Thêm doanh nghiệp mới thành công');
                return $this->redirect(['view', 'id' => $model->id]);
            }
            else {
                Yii::$app->session->setFlash('error','Thêm doanh nghiệp mới thất bại');
                return $this->render('create',['model'=>$model]);
            }
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing DoanhNghiep model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $anhCu=$model->logo_doanh_nghiep;
        if ($model->load(Yii::$app->request->post())) {
            $model->nguoi_cap_nhat=Yii::$app->user->id;
            $model->ngay_cap_nhat=date("Y-m-d");
            $fileUpload=UploadedFile::getInstance($model,'logo_doanh_nghiep');
            if(!is_null($fileUpload)){
                $fileTam=$fileUpload->name;
                Yii::$app->params['uploadPath']=Yii::$app->basePath .'/web/images/doanh-nghiep/';
                $path=Yii::$app->params['uploadPath'].$fileTam;
                $model->logo_doanh_nghiep=$fileTam;
                $fileUpload->saveAs($path);

            } else {
                $model->logo_doanh_nghiep=$anhCu;
            }
            if($model->save()){
                Yii::$app->session->setFlash('success','Cập nhật thông tin doanh nghiệp thành công');
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                Yii::$app->session->setFlash('error','Cập nhật thông tin doanh nghiệp thất bại');
                return $this->render('update',['model'=>$model]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }


    /**
     * Deletes an existing DoanhNghiep model.
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
     * Finds the DoanhNghiep model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return DoanhNghiep the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DoanhNghiep::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionChuyenDuyet($id)
    {
        $model=$this->findModel($id);
        $model->trang_thai=DoanhNghiep::DN_CHO_DUYET;
        if($model->save()){
            Yii::$app->session->setFlash('success','Chuyển duyệt thành công!');
            // return $this->redirect('index.php?r=index');
            return $this->redirect('../kiem-duyet-doanh-nghiep/index');
        }
    }

    public function actionKiemDuyet()
    {
        $searchModel = new DoanhNghiepSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andFilterWhere(['trang_thai'=>DoanhNghiep::DN_DUYET]);

        return $this->render('kiemDuyetDN', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionXemKiemDuyet($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
}
