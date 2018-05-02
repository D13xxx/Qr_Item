<?php

namespace backend\controllers;


use app\models\Dungchung;
use Yii;
use backend\models\NhomSanPham;
use backend\models\NhomSanPhamSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;


/**
 * NhomSanPhamController implements the CRUD actions for NhomSanPham model.
 */
class NhomSanPhamController extends Controller
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
     * Lists all NhomSanPham models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new NhomSanPhamSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andFilterWhere(['or',['trang_thai'=>NhomSanPham::NHOM_MOI],['trang_thai'=>NhomSanPham::NHOM_CHUYEN_DUYET],['trang_thai'=>NhomSanPham::NHOM_KHONG_DUYET]]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single NhomSanPham model.
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
     * Creates a new NhomSanPham model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new NhomSanPham();

        if ($model->load(Yii::$app->request->post())) {
            $model->ma=Dungchung::SinhMa('NhomSP-','nhom_san_pham');
            $model->trang_thai=NhomSanPham::NHOM_MOI;
            $model->nguoi_tao=Yii::$app->user->id;
            $model->ngay_tao=date("Y-m-d");
            // $fileUpload=UploadedFile::getInstance($model,'anh_dai_dien');
            // if(!is_null($fileUpload)){
            //     $fileTam=$fileUpload->name;
            //     Yii::$app->params['uploadPath']=Yii::$app->basePath .'/web/images/nhom-san-pham/';
            //     $path=Yii::$app->params['uploadPath'].$fileTam;
            //     $model->anh_dai_dien=$fileTam;
            //     $fileUpload->saveAs($path);

            // }
            if($model->save())
            {
                Yii::$app->session->setFlash('success','Thêm nhóm sản phẩm mới thành công');
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                Yii::$app->session->setFlash('error','Thêm nhóm sản phẩm mới thất bại');
                return $this->render('create',['model'=>$model]);
            }

        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing NhomSanPham model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $anhCu=$model->anh_dai_dien;

        if ($model->load(Yii::$app->request->post())) {
            $model->nguoi_cap_nhat=Yii::$app->user->id;
            $model->ngay_cap_nhat=date("Y-m-d");
            $fileUpload=UploadedFile::getInstance($model,'anh_dai_dien');
            if(!is_null($fileUpload)){
                $fileTam=$fileUpload->name;
                Yii::$app->params['uploadPath']=Yii::$app->basePath .'/web/images/nhom-san-pham/';
                $path=Yii::$app->params['uploadPath'].$fileTam;
                $model->anh_dai_dien=$fileTam;
                $fileUpload->saveAs($path);

            } else {
                $model->anh_dai_dien=$anhCu;
            }
            if($model->save()){
                Yii::$app->session->setFlash('success','Cập nhật thông tin nhóm sản phẩm thành công.');
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                Yii::$app->session->setFlash('error','Cập nhật thông tin nhóm sản phẩm thất bại');
                return $this->render('update',['model'=>$model]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing NhomSanPham model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['da-duyet']);
    }

    /**
     * Finds the NhomSanPham model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return NhomSanPham the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = NhomSanPham::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    public function actionChuyenDuyet($id)
    {
        $model=$this->findModel($id);
        $model->trang_thai=NhomSanPham::NHOM_CHUYEN_DUYET;
        if($model->save())
        {
            Yii::$app->session->setFlash('success','Chuyển duyệt thành công.');
            return $this->redirect('index.php?r=kiem-duyet-nhom-san-pham%2Findex');
        }
    }

    public function actionDaDuyet()
    {
        $searchModel = new NhomSanPhamSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andFilterWhere(['trang_thai'=>NhomSanPham::NHOM_DA_DUYET]);

        return $this->render('daDuyet', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}
