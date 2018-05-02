<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\NhatKySanPham;

/**
 * NhatKySanPhamSearch represents the model behind the search form of `app\models\NhatKySanPham`.
 */
class NhatKySanPhamSearch extends NhatKySanPham
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'san_pham_id', 'doanh_nghiep_id', 'nguoi_tao', 'thu_tu', 'nguoi_cap_nhat'], 'integer'],
            [['ngay_tao', 'ngay_cap_nhat'], 'safe'],
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
        $query = NhatKySanPham::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
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
            'san_pham_id' => $this->san_pham_id,
            'doanh_nghiep_id' => $this->doanh_nghiep_id,
            'ngay_tao' => $this->ngay_tao,
            'nguoi_tao' => $this->nguoi_tao,
            'thu_tu' => $this->thu_tu,
            'nguoi_cap_nhat' => $this->nguoi_cap_nhat,
            'ngay_cap_nhat' => $this->ngay_cap_nhat,
        ]);

        return $dataProvider;
    }
}
