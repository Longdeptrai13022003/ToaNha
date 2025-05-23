<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%chuc_nang}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $nhom
 * @property string $controller_action
 *
 * @property PhanQuyen[] $phanQuyens
 */
class ChucNang extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'qlcvsd_chuc_nang';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'nhom', 'controller_action'], 'required'],
            [['name', 'nhom', 'controller_action'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Tên',
            'nhom' => 'Nhóm',
            'controller_action' => 'Tên controller_action',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhanQuyens()
    {
        return $this->hasMany(PhanQuyen::className(), ['chuc_nang_id' => 'id']);
    }
}
