<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "thuoc_tinh_san_pham".
 *
 * @property int $id
 * @property string $ten
 * @property string $dien_giai
 * @property int $san_pham_id
 * @property int $thuoc_san_pham_id
 */
class ThuocTinhSanPham extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'thuoc_tinh_san_pham';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['san_pham_id', 'thuoc_san_pham_id'], 'integer'],
            [['ten'], 'string', 'max' => 256],
            [['dien_giai'], 'string',],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ten' => 'Tên',
            'dien_giai' => 'Diễ giải',
            'san_pham_id' => 'cấu thành từ sản phẩm',
            'thuoc_san_pham_id' => 'Thuộc sản phẩm',
        ];
    }
}
