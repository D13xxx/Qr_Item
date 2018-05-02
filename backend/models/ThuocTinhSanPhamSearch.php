<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ThuocTinhSanPham;

/**
 * ThuocTinhSanPhamSearch represents the model behind the search form of `app\models\ThuocTinhSanPham`.
 */
class ThuocTinhSanPhamSearch extends ThuocTinhSanPham
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'san_pham_id', 'thuoc_san_pham_id'], 'integer'],
            [['ten', 'dien_giai'], 'safe'],
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
        $query = ThuocTinhSanPham::find();

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
            'thuoc_san_pham_id' => $this->thuoc_san_pham_id,
        ]);

        $query->andFilterWhere(['like', 'ten', $this->ten])
            ->andFilterWhere(['like', 'dien_giai', $this->dien_giai]);

        return $dataProvider;
    }
}
