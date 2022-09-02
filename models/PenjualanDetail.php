<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "penjualan_detail".
 *
 * @property int $penjualan_detail_id
 * @property string $nomor_nota
 * @property int $barang_id
 * @property float $harga
 * @property float $jumlah
 * @property float $subtotal
 *
 * @property Barang $barang
 * @property Penjualan $nomorNota
 */
class PenjualanDetail extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'penjualan_detail';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nomor_nota', 'barang_id', 'harga', 'jumlah', 'subtotal'], 'required'],
            [['barang_id'], 'integer'],
            [['harga', 'jumlah', 'subtotal'], 'number'],
            [['nomor_nota'], 'string', 'max' => 100],
            [['nomor_nota'], 'exist', 'skipOnError' => true, 'targetClass' => Penjualan::className(), 'targetAttribute' => ['nomor_nota' => 'nomor_nota']],
            [['barang_id'], 'exist', 'skipOnError' => true, 'targetClass' => Barang::className(), 'targetAttribute' => ['barang_id' => 'barang_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'penjualan_detail_id' => 'Penjualan Detail ID',
            'nomor_nota' => 'Nomor Nota',
            'barang_id' => 'Barang ID',
            'harga' => 'Harga',
            'jumlah' => 'Jumlah',
            'subtotal' => 'Subtotal',
        ];
    }

    /**
     * Gets query for [[Barang]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBarang()
    {
        return $this->hasOne(Barang::className(), ['barang_id' => 'barang_id']);
    }

    /**
     * Gets query for [[NomorNota]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNomorNota()
    {
        return $this->hasOne(Penjualan::className(), ['nomor_nota' => 'nomor_nota']);
    }
}
