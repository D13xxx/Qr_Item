<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "san_pham".
 *
 * @property int $id
 * @property string $ma
 * @property string $ten
 * @property string $anh_qr
 * @property int $nhom_san_pham_id
 * @property string $ngay_tao
 * @property int $nguoi_tao
 * @property int $doanh_nghiep_id
 * @property int $nguoi_cap_nhat
 * @property string $ngay_cap_nhat
 * @property int $trang_thai
 * @property int $so_luong
 * @property string $dvt
 * @property string $anh_dai_dien
 */
class SanPham extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    const SP_MOI=0;
    const SP_CHUYEN_DUYET=1;
    const SP_KHONG_DUYET=2;
    const SP_DUYET=3;
    public static function tableName()
    {
        return 'san_pham';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ten', 'nhom_san_pham_id', 'doanh_nghiep_id'], 'required'],
            [['anh_qr'], 'string'],
            [['nhom_san_pham_id', 'nguoi_tao', 'doanh_nghiep_id', 'nguoi_cap_nhat', 'trang_thai', 'so_luong'], 'integer'],
            [['ngay_tao', 'ngay_cap_nhat'], 'safe'],
            [['ma'], 'string', 'max' => 50],
            [['ten', 'dvt'], 'string', 'max' => 256],
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
            'anh_qr' => 'QR_Code',
            'nhom_san_pham_id' => 'Nhóm sản phẩm',
            'ngay_tao' => 'Ngày tạo',
            'nguoi_tao' => 'Người tạo',
            'doanh_nghiep_id' => 'Doanh nghiệp',
            'nguoi_cap_nhat' => 'Người cập nhật',
            'ngay_cap_nhat' => 'Ngày cập nhật',
            'trang_thai' => 'Trạng thái',
            'so_luong' => 'Số lượng',
            'dvt' => 'Đơn vị tinh',
        ];
    }
}

