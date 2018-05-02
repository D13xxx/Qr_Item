<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "loai_hinh".
 *
 * @property int $id
 * @property string $ma
 * @property string $ten
 * @property int $nguoi_tao
 * @property string $ngay_tao
 * @property int $nguoi_cap_nhat
 * @property string $ngay_cap_nhat
 * @property int $trang_thai
 */
class LoaiHinh extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    const LOAI_HINH_MOI=0;
    const CHO_KIEM_DUYET=1;
    const DA_DUYET=2;
    const KHONG_DUYET=3;
    public static function tableName()
    {
        return 'loai_hinh';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nguoi_tao', 'nguoi_cap_nhat', 'trang_thai'], 'integer'],
            [['ngay_tao', 'ngay_cap_nhat'], 'safe'],
            [['ma', 'ten'], 'string', 'max' => 256],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            // 'id' => 'ID',
            'ma' => 'Mã',
            'ten' => 'Tên loại hình',
            'nguoi_tao' => 'Người tạo',
            'ngay_tao' => 'Ngày tạo',
            'nguoi_cap_nhat' => 'Người cập nhật',
            'ngay_cap_nhat' => 'Ngày cập nhật',
            'trang_thai' => 'Trạng thái',
        ];
    }
}
