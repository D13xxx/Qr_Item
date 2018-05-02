<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "doanh_nghiep".
 *
 * @property int $id
 * @property string $ma
 * @property string $ten
 * @property string $ten_giao_dich
 * @property string $dia_chi
 * @property string $nguoi_dai_dien
 * @property string $so_dang_ky_kinh_doanh
 * @property string $dien_thoai
 * @property int $loai_hinh_id
 * @property int $trang_thai
 * @property int $nguoi_tao
 * @property string $ngay_tao
 * @property int $nguoi_cap_nhat
 * @property string $ngay_cap_nhat
 * @property string $logo_doanh_nghiep
 */
class DoanhNghiep extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    const DN_MOI=0;
    const DN_CHO_DUYET=1;
    const DN_KHONG_DUYET=2;
    const DN_DUYET=3;

    public static function tableName()
    {
        return 'doanh_nghiep';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
             [['loai_hinh_id','ten','dia_chi'],'required'],
            [['dia_chi'], 'string'],
            [['loai_hinh_id', 'trang_thai', 'nguoi_tao', 'nguoi_cap_nhat'], 'integer'],
            [['ngay_tao', 'ngay_cap_nhat'], 'safe'],
            [['ma', 'ten', 'ten_giao_dich', 'nguoi_dai_dien'], 'string', 'max' => 256],
            [['so_dang_ky_kinh_doanh'], 'string', 'max' => 100],
            [['dien_thoai'], 'string', 'max' => 50],
            [['logo_doanh_nghiep'],'string'],
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
            'ten' => 'Tên doanh nghiệp',
            'ten_giao_dich' => 'Tên giao dịch',
            'dia_chi' => 'Địa chỉ',
            'nguoi_dai_dien' => 'Người đại diện',
            'so_dang_ky_kinh_doanh' => 'Số đăng kí kinh doanh',
            'dien_thoai' => 'Điện thoại',
            'loai_hinh_id' => 'Loại hình doanh nghiệp',
            'trang_thai' => 'Trang thái',
            'nguoi_tao' => 'Người tạo',
            'ngay_tao' => 'Ngày tạo',
            'nguoi_cap_nhat' => 'Người cập nhật',
            'ngay_cap_nhat' => 'Ngày cập nhật',
            'logo_doanh_nghiep' => 'Logo doanh nghiệp',
        ];
    }
}
