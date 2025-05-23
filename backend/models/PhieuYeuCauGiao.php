<?php

namespace backend\models;

use common\models\User;
use Yii;

/**
 * This is the model class for table "{{%phieu_yeu_cau_giao}}".
 *
 * @property int $id
 * @property string|null $field_danh_sach_don_hang
 * @property string|null $field_ma_van_don
 * @property string|null $field_hinh_thuc_nhan_hang
 * @property string|null $field_so_dien_thoai_nha_xe
 * @property int|null $field_active
 * @property int|null $field_dia_chi_nhan_hang_id
 * @property int|null $phi_dong_goi
 * @property string|null $field_phan_loai
 * @property string|null $field_ds_ma_van_don_ky_gui
 * @property float|null $field_phi_giao_hang_den_nha_xe
 * @property float|null $field_tong_tien
 * @property float|null $field_thanh_tien
 * @property float|null $field_so_tien_hoan_lai
 * @property float|null $field_so_tien_da_thanh_toan
 * @property string|null $created
 * @property string|null $title
 * @property int|null $user_id
 * @property int|null $phieu_yeu_cau_giao_old_id
 *
 * @property ChiTietPhieuYeuCauGiaoHang[] $chiTietPhieuYeuCauGiaoHangs
 * @property DiaChiNhanHang $fieldDiaChiNhanHang
 * @property User $user
 */
class PhieuYeuCauGiao extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%phieu_yeu_cau_giao}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['field_danh_sach_don_hang', 'field_hinh_thuc_nhan_hang', 'field_phan_loai', 'field_ds_ma_van_don_ky_gui'], 'string'],
            [['field_active', 'field_dia_chi_nhan_hang_id', 'user_id', 'phieu_yeu_cau_giao_old_id'], 'integer'],
            [['field_phi_giao_hang_den_nha_xe', 'field_tong_tien', 'field_thanh_tien', 'field_so_tien_hoan_lai', 'field_so_tien_da_thanh_toan'], 'number'],
            [['created', 'title', 'phi_dong_goi'], 'safe'],
            [['field_ma_van_don', 'field_so_dien_thoai_nha_xe'], 'string', 'max' => 100],
            [['field_dia_chi_nhan_hang_id'], 'exist', 'skipOnError' => true, 'targetClass' => DiaChiNhanHang::className(), 'targetAttribute' => ['field_dia_chi_nhan_hang_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'field_danh_sach_don_hang' => 'Field Danh Sach Don Hang',
            'field_ma_van_don' => 'Field Ma Van Don',
            'field_hinh_thuc_nhan_hang' => 'Field Hinh Thuc Nhan Hang',
            'field_so_dien_thoai_nha_xe' => 'Field So Dien Thoai Nha Xe',
            'field_active' => 'Field Active',
            'field_dia_chi_nhan_hang_id' => 'Field Dia Chi Nhan Hang ID',
            'field_phan_loai' => 'Field Phan Loai',
            'field_ds_ma_van_don_ky_gui' => 'Field Ds Ma Van Don Ky Gui',
            'field_phi_giao_hang_den_nha_xe' => 'Field Phi Giao Hang Den Nha Xe',
            'field_tong_tien' => 'Field Tong Tien',
            'field_thanh_tien' => 'Field Thanh Tien',
            'field_so_tien_hoan_lai' => 'Field So Tien Hoan Lai',
            'field_so_tien_da_thanh_toan' => 'Field So Tien Da Thanh Toan',
            'created' => 'Created',
            'user_id' => 'User ID',
        ];
    }

    /**
     * Gets query for [[ChiTietPhieuYeuCauGiaoHangs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getChiTietPhieuYeuCauGiaoHangs()
    {
        return $this->hasMany(ChiTietPhieuYeuCauGiaoHang::className(), ['field_phieu_yeu_cau_giao_id' => 'id']);
    }

    /**
     * Gets query for [[FieldDiaChiNhanHang]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFieldDiaChiNhanHang()
    {
        return $this->hasOne(DiaChiNhanHang::className(), ['id' => 'field_dia_chi_nhan_hang_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function beforeSave($insert)
    {
        if($insert && ($this->created == '' || is_null($this->created)))
            $this->created = date("Y-m-d H:i:s");
        return parent::beforeSave($insert); // TODO: Change the autogenerated stub
    }
}
