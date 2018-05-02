<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\DoanhNghiep;

/**
 * DoanhNghiepSearch represents the model behind the search form of `app\models\DoanhNghiep`.
 */
class DoanhNghiepSearch extends DoanhNghiep
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'loai_hinh_id', 'trang_thai', 'nguoi_tao', 'nguoi_cap_nhat'], 'integer'],
            [['ma', 'ten', 'ten_giao_dich', 'dia_chi', 'nguoi_dai_dien', 'so_dang_ky_kinh_doanh', 'dien_thoai', 'ngay_tao', 'ngay_cap_nhat', 'logo_doanh_nghiep'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = DoanhNghiep::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' =>[
                'pageSize' => '5'
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'loai_hinh_id' => $this->loai_hinh_id,
            'trang_thai' => $this->trang_thai,
            'nguoi_tao' => $this->nguoi_tao,
            'ngay_tao' => $this->ngay_tao,
            'nguoi_cap_nhat' => $this->nguoi_cap_nhat,
            'ngay_cap_nhat' => $this->ngay_cap_nhat,
        ]);

        $query->andFilterWhere(['like', 'ma', $this->ma])
            ->andFilterWhere(['like', 'ten', $this->ten])
            ->andFilterWhere(['like', 'ten_giao_dich', $this->ten_giao_dich])
            ->andFilterWhere(['like', 'dia_chi', $this->dia_chi])
            ->andFilterWhere(['like', 'nguoi_dai_dien', $this->nguoi_dai_dien])
            ->andFilterWhere(['like', 'so_dang_ky_kinh_doanh', $this->so_dang_ky_kinh_doanh])
            ->andFilterWhere(['like', 'dien_thoai', $this->dien_thoai])
            ->andFilterWhere(['like', 'logo_doanh_nghiep', $this->logo_doanh_nghiep]);

        return $dataProvider;
    }
}
