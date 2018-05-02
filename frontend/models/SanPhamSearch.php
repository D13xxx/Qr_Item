<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\SanPham;

/**
 * SanPhamSearch represents the model behind the search form of `bakend\models\SanPham`.
 */
class SanPhamSearch extends SanPham
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'nhom_san_pham_id', 'nguoi_tao', 'doanh_nghiep_id', 'nguoi_cap_nhat', 'trang_thai', 'so_luong'], 'integer'],
            [['ma', 'ten', 'anh_qr', 'ngay_tao', 'ngay_cap_nhat', 'dvt', 'anh_dai_dien'], 'safe'],
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
        $query = SanPham::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' =>[
                'pageSize' => '3'
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
            'nhom_san_pham_id' => $this->nhom_san_pham_id,
            'ngay_tao' => $this->ngay_tao,
            'nguoi_tao' => $this->nguoi_tao,
            'doanh_nghiep_id' => $this->doanh_nghiep_id,
            'nguoi_cap_nhat' => $this->nguoi_cap_nhat,
            'ngay_cap_nhat' => $this->ngay_cap_nhat,
            'trang_thai' => $this->trang_thai,
            'so_luong' => $this->so_luong,
        ]);

        $query->andFilterWhere(['like', 'ma', $this->ma])
            ->andFilterWhere(['like', 'ten', $this->ten])
            ->andFilterWhere(['like', 'anh_qr', $this->anh_qr])
            ->andFilterWhere(['like', 'dvt', $this->dvt])
            ->andFilterWhere(['like', 'anh_dai_dien', $this->anh_dai_dien]);

        return $dataProvider;
    }
}
