<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "penjualan".
 *
 * @property string $nomor_nota
 * @property string $tanggal
 * @property int $pelanggan_id
 * @property float $total
 * @property int $user_id
 *
 * @property Pelanggan $pelanggan
 * @property PenjualanDetail[] $penjualanDetails
 * @property User $user
 */
class Penjualan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'penjualan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nomor_nota', 'tanggal', 'pelanggan_id', 'total', 'user_id'], 'required'],
            [['tanggal'], 'safe'],
            [['pelanggan_id', 'user_id'], 'integer'],
            [['total'], 'number'],
            [['nomor_nota'], 'string', 'max' => 100],
            [['nomor_nota'], 'unique'],
            [['pelanggan_id'], 'exist', 'skipOnError' => true, 'targetClass' => Pelanggan::className(), 'targetAttribute' => ['pelanggan_id' => 'pelanggan_id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'user_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'nomor_nota' => 'Nomor Nota',
            'tanggal' => 'Tanggal',
            'pelanggan_id' => 'Pelanggan ID',
            'total' => 'Total',
            'user_id' => 'User ID',
        ];
    }

    /**
     * Gets query for [[Pelanggan]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPelanggan()
    {
        return $this->hasOne(Pelanggan::className(), ['pelanggan_id' => 'pelanggan_id']);
    }

    /**
     * Gets query for [[PenjualanDetails]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPenjualanDetails()
    {
        return $this->hasMany(PenjualanDetail::className(), ['nomor_nota' => 'nomor_nota']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['user_id' => 'user_id']);
    }
}
