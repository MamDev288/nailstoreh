<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%product_detail}}".
 *
 * @property int $id
 * @property string|null $name
 * @property float|null $price
 * @property int|null $unit
 * @property int|null $parent_id
 * @property int|null $product_id
 *
 * @property ProductDetail $parent
 * @property ProductDetail[] $productDetails
 * @property Product $product
 */
class ProductDetail extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%product_detail}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['price'], 'number'],
            [['unit', 'parent_id', 'product_id'], 'integer'],
            [['name'], 'string', 'max' => 35],
            [['parent_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProductDetail::className(), 'targetAttribute' => ['parent_id' => 'id']],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'price' => Yii::t('app', 'Price'),
            'unit' => Yii::t('app', 'Unit'),
            'parent_id' => Yii::t('app', 'Parent ID'),
            'product_id' => Yii::t('app', 'Product ID'),
        ];
    }

    /**
     * Gets query for [[Parent]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(ProductDetail::className(), ['id' => 'parent_id']);
    }

    /**
     * Gets query for [[ProductDetails]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProductDetails()
    {
        return $this->hasMany(ProductDetail::className(), ['parent_id' => 'id']);
    }

    /**
     * Gets query for [[Product]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }
}
