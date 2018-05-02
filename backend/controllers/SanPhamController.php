<?php

namespace backend\controllers;

use app\models\DoanhNghiep;
use app\models\Dungchung;
use app\models\ThuocTinhSanPham;
use app\models\ThuocTinhSanPhamSearch;
use Da\QrCode\QrCode;
use Yii;
use backend\models\NhomSanPham;
use backend\models\NhomSanPhamSearch;
use backend\models\SanPham;
use backend\models\SanPhamSearch;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * SanPhamController implements the CRUD actions for SanPham model.
 */
class SanPhamController extends Controller
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
                    'chuyen-duyet'=>['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all SanPham models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SanPhamSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andFilterWhere(['or',['trang_thai'=>SanPham::SP_MOI],['trang_thai'=>SanPham::SP_CHUYEN_DUYET],['trang_thai'=>SanPham::SP_KHONG_DUYET]]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SanPham model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
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

    /**
     * Creates a new SanPham model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new SanPham();

        if ($model->load(Yii::$app->request->post())) {
            $ngayTao=date("Ymd");
            $tienTo='SP_'.$ngayTao;
            $model->ma=Dungchung::SinhMa($tienTo.'_','san_pham');
            $model->ngay_tao=date("Y-m-d");
            $model->nguoi_tao=Yii::$app->user->id;
            $model->trang_thai=SanPham::SP_MOI;
            $model->anh_qr=$model->ma.'.png';
            if($model->save())
            {
                 $url=Yii::$app->urlManagerBackend->baseUrl .'?id='.$model->id;
//                 $url=Url::to(['/qr-code/view'],true).'?id='.$model->id;

                $pathFile=Yii::getAlias('@webroot').'/qr-code/';
                $qrCode=(new QrCode($model->ma))->setText($url);
                $qrCode->writeFile($pathFile.$model->ma.'.png');
//                 return print_r($url);
//                 die();
                Yii::$app->session->setFlash('success','Thêm sản phẩm mới thành công.');
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                Yii::$app->session->setFlash('error','Thêm sản phẩm mới thất bại');
                return $this->render('create',['model'=>$model]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing SanPham model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->nguoi_cap_nhat=Yii::$app->user->id;
            $model->ngay_cap_nhat=date("Y-m-d");
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
     * Deletes an existing SanPham model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        Yii::$app->session->setFlash('success','Xóa sản phẩm thành công.');
        return $this->redirect(['da-duyet']);
    }



    /**
     * Finds the SanPham model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SanPham the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SanPham::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    public function actionThongTinSanPham($id)
    {
        $model=$this->findModel($id);

        $searchThongTin=new ThuocTinhSanPhamSearch();
        $dataThongTin = $searchThongTin->search(Yii::$app->request->queryParams);
        $dataThongTin->query->andFilterWhere(['thuoc_san_pham_id'=>$model->id]);

        $modelThongTin=new ThuocTinhSanPham();

        if($modelThongTin->load(Yii::$app->request->post()))
        {
            if($modelThongTin->san_pham_id==''||$modelThongTin->san_pham_id==null)
            {
                $modelThongTin->san_pham_id=0;
            }
            $modelThongTin->thuoc_san_pham_id=$id;
            if($modelThongTin->save()){
                Yii::$app->session->setFlash('success','Thêm thông tin sản phẩm thành công.');
                return $this->redirect(['thong-tin-san-pham','id'=>$model->id]);
            } else {
                Yii::$app->session->setFlash('error','Thêm thông tin sản phẩm thất bại');
                return $this->render('thongTinSanPham',[
                    'model'=>$model,
                    'modelThongTin'=>$modelThongTin,
                    'searchThongTin'=>$searchThongTin,
                    'dataThongTin'=>$dataThongTin,
                ]);
            }
        }
        return $this->render('thongTinSanPham',[
            'model'=>$model,
            'modelThongTin'=>$modelThongTin,
            'searchThongTin'=>$searchThongTin,
            'dataThongTin'=>$dataThongTin,
        ]);
    }

    public function actionThongTinSanPhamUpdate($id){
        $model=$this->findChiTiet($id);

        $modelSP=$this->findModel($model->thuoc_san_pham_id);

        $searchThongTin=new ThuocTinhSanPhamSearch();
        $dataThongTin = $searchThongTin->search(Yii::$app->request->queryParams);
        $dataThongTin->query->andFilterWhere(['thuoc_san_pham_id'=>$modelSP->id]);

        if($model->load(Yii::$app->request->post()))
        {
            if($model->san_pham_id==''||$model->san_pham_id==null)
            {
                $model->san_pham_id=0;
            }
            $model->thuoc_san_pham_id=$modelSP->id;
            if($model->save()){
                Yii::$app->session->setFlash('success','Sửa thông tin sản phẩm thành công.');
                return $this->redirect(['view','id'=>$modelSP->id]);
            } else {
                Yii::$app->session->setFlash('error','Thêm thông tin sản phẩm thất bại');
                return $this->render('thongTinSanPhamUpdate',[
                    'model'=>$model,
                    'modelSP'=>$modelSP,
                    'searchThongTin'=>$searchThongTin,
                    'dataThongTin'=>$dataThongTin,
                ]);
            }
        }
        return $this->render('thongTinSanPhamUpdate',[
            'model'=>$model,
            'modelSP'=>$modelSP,
            'searchThongTin'=>$searchThongTin,
            'dataThongTin'=>$dataThongTin,
        ]);
    }

    protected function findChiTiet($id)
    {
        if(($model=ThuocTinhSanPham::findOne($id))!==null)
        {
            return $model;
        }
        throw new NotFoundHttpException('Không tìm thấy thông tin sản phẩm này');
    }
    public function actionChuyenDuyet($id)
    {
        $model=$this->findModel($id);
        $model->ngay_cap_nhat=date("Y-m-d");
        $model->nguoi_cap_nhat=Yii::$app->user->id;
        $model->trang_thai=SanPham::SP_CHUYEN_DUYET;
        if($model->save()){
            Yii::$app->session->setFlash('success','Chuyển duyệt thành công');
            return $this->redirect('index.php?r=kiem-duyet-san-pham/index');
        }
    }

    public function actionDaDuyet()
    {
        $searchModel = new SanPhamSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andFilterWhere(['trang_thai'=>SanPham::SP_DUYET]);

        return $this->render('daDuyet', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}
