<?php

namespace api\models;

use Yii;

/**
 * This is the model class for table "vh_trang_thai_nghi_phep".
 *
 * @property int $id
 * @property int|null $nghi_phep_id
 * @property string|null $trang_thai
 * @property string|null $created
 * @property int|null $user_id
 * @property int|null $user_duyet_id
 * @property string|null $ghi_chu
 *
 * @property NghiPhep $nghiPhep
 * @property User $user
 * @property User $userDuyet
 */
class TrangThaiNghiPhep extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'vh_trang_thai_nghi_phep';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nghi_phep_id', 'user_id', 'user_duyet_id'], 'integer'],
            [['trang_thai', 'ghi_chu'], 'string'],
            [['created'], 'safe'],
            [['nghi_phep_id'], 'exist', 'skipOnError' => true, 'targetClass' => NghiPhep::className(), 'targetAttribute' => ['nghi_phep_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['user_duyet_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_duyet_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nghi_phep_id' => 'Nghi Phep ID',
            'trang_thai' => 'Trang Thai',
            'created' => 'Created',
            'user_id' => 'User ID',
            'user_duyet_id' => 'User Duyet ID',
            'ghi_chu' => 'Ghi Chu',
        ];
    }

    /**
     * Gets query for [[NghiPhep]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNghiPhep()
    {
        return $this->hasOne(NghiPhep::className(), ['id' => 'nghi_phep_id']);
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

    /**
     * Gets query for [[UserDuyet]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserDuyet()
    {
        return $this->hasOne(User::className(), ['id' => 'user_duyet_id']);
    }
    public function beforeSave($insert)
    {
        $this->created = date('Y-m-d H:i:s');
        return parent::beforeSave($insert); // TODO: Change the autogenerated stub
    }

    public function afterSave($insert, $changedAttributes)
    {
        $this->nghiPhep->updateAttributes([
            'trang_thai'=>$this->trang_thai,
            'updated'=>date('Y-m-d H:i:s')
        ]);
        parent::afterSave($insert, $changedAttributes); // TODO: Change the autogenerated stub
    }
}