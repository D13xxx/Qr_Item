<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "nhat_ky_san_pham".
 *
 * @property int $id
 * @property int $san_pham_id
 * @property int $doanh_nghiep_id
 * @property string $ngay_tao
 * @property int $nguoi_tao
 * @property int $thu_tu
 * @property int $nguoi_cap_nhat
 * @property string $ngay_cap_nhat
 */
class NhatKySanPham extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'nhat_ky_san_pham';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['san_pham_id', 'doanh_nghiep_id', 'nguoi_tao', 'thu_tu', 'nguoi_cap_nhat'], 'integer'],
            [['ngay_tao', 'ngay_cap_nhat'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'san_pham_id' => 'San Pham ID',
            'doanh_nghiep_id' => 'Doanh Nghiep ID',
            'ngay_tao' => 'Ngay Tao',
            'nguoi_tao' => 'Nguoi Tao',
            'thu_tu' => 'Thu Tu',
            'nguoi_cap_nhat' => 'Nguoi Cap Nhat',
            'ngay_cap_nhat' => 'Ngay Cap Nhat',
        ];
    }
}
