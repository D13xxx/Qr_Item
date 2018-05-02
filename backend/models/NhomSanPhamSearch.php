<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\NhomSanPham;

/**
 * NhomSanPhamSearch represents the model behind the search form of `app\models\NhomSanPham`.
 */
class NhomSanPhamSearch extends NhomSanPham
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'trang_thai', 'nguoi_tao', 'nguoi_cap_nhat'], 'integer'],
            [['ma', 'ten', 'ngay_tao', 'ngay_cap_nhat', 'anh_dai_dien'], 'safe'],
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
        $query = NhomSanPham::find();

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
            'trang_thai' => $this->trang_thai,
            'nguoi_tao' => $this->nguoi_tao,
            'ngay_tao' => $this->ngay_tao,
            'nguoi_cap_nhat' => $this->nguoi_cap_nhat,
            'ngay_cap_nhat' => $this->ngay_cap_nhat,
        ]);

        $query->andFilterWhere(['like', 'ma', $this->ma])
            ->andFilterWhere(['like', 'ten', $this->ten])
            ->andFilterWhere(['like', 'anh_dai_dien', $this->anh_dai_dien]);

        return $dataProvider;
    }
}
