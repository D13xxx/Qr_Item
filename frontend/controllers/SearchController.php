<?php
/**
 * Created by PhpStorm.
 * User: cauha
 * Date: 4/18/2018
 * Time: 3:56 PM
 */

namespace frontend\controllers;
use yii\base\Model;
use yii\db\ActiveRecord;

class SearchController extends ActiveRecord
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                //'only'=>['index','search'],
                'rules'=>[
                    [
                        'allow'=>TRUE,
                        'actions'=>['index','search'],
                        'roles'=>['?','@'],
                    ]
                ]
            ]
        ];
    }
    public function actionIndex()
    {
        return $this->render('index');
    }
    public function actionSearch()
    {
        $question = \Yii::$app->request->queryParams['search'];
        if (!$question)
        {
            return \Yii::$app->response->redirect('site/index');
        }
        $result = Search::findBySql("SELECT * FROM `san_pham` WHERE `ma` LIKE '%".$question."%' OR 'ten' LIKE '%".$question."%' ")->all();
        if (!$result)
        {
            echo 'Không có dữ liệu';
        }
        else
        {
            foreach ($result as $key =>$value)
            {
                echo $value['title'];
            }
        }
    }
}
// chưa xong