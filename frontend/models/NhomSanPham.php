<?php

namespace backend\models;

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/**
 * This is the model class for table "nhom_san_pham".
 *
 * @property int $id
 * @property string $ma
 * @property string $ten
 * @property int $trang_thai
 * @property int $nguoi_tao
 * @property string $ngay_tao
 * @property int $nguoi_cap_nhat
 * @property string $ngay_cap_nhat
 * @property string $anh_dai_dien
 */
class NhomSanPham extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    const NHOM_MOI=0;
    const NHOM_CHUYEN_DUYET=1;
    const NHOM_KHONG_DUYET=2;
    const NHOM_DA_DUYET=3;


    public static function tableName()
    {
        return 'nhom_san_pham';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['trang_thai', 'nguoi_tao', 'nguoi_cap_nhat'], 'integer'],
            [['ngay_tao', 'ngay_cap_nhat'], 'safe'],
            [['ma'], 'string', 'max' => 50],
            [['ten'], 'string', 'max' => 256],
            [['anh_dai_dien'], 'string', 'max' => 500],

            ];

    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ma' => 'Mã',
            'ten' => 'Tên',
            'trang_thai' => 'Trạng thái',
            'nguoi_tao' => 'Người tạo',
            'ngay_tao' => 'Ngày tạo',
            'nguoi_cap_nhat' => 'Người cập nhật',

            'ngay_cap_nhat' => 'Ngày cập nhật',
//            'anh_dai_dien' => 'Ảnh đại diện',
        ];
    }

}

