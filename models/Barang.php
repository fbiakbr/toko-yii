<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "barang".
 *
 * @property int $barang_id
 * @property string $nama_barang
 * @property float $harga_satuan
 * @property int $stok
 *
 * @property PenjualanDetail[] $penjualanDetails
 */
class Barang extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'barang';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama_barang', 'harga_satuan', 'stok'], 'required'],
            [['harga_satuan'], 'number'],
            [['stok'], 'integer'],
            [['nama_barang'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'barang_id' => 'Barang ID',
            'nama_barang' => 'Nama Barang',
            'harga_satuan' => 'Harga Satuan',
            'stok' => 'Stok',
        ];
    }

    /**
     * Gets query for [[PenjualanDetails]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPenjualanDetails()
    {
        return $this->hasMany(PenjualanDetail::className(), ['barang_id' => 'barang_id']);
    }
}
