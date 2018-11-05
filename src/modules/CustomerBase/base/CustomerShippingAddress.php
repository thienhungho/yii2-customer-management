<?php

namespace thienhungho\CustomerManagement\modules\CustomerBase\base;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the base model class for table "customer_shipping_address".
 *
 * @property integer $id
 * @property integer $customer_id
 * @property string $country
 * @property string $city
 * @property string $state
 * @property string $zip_code
 * @property string $phone
 * @property string $created_at
 * @property string $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 *
 * @property \thienhungho\CustomerManagement\modules\CustomerBase\Customer $customer
 */
class CustomerShippingAddress extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;


    /**
    * This function helps \mootensai\relation\RelationTrait runs faster
    * @return array relation names of this model
    */
    public function relationNames()
    {
        return [
            'customer'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customer_id', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['country', 'city', 'state', 'zip_code', 'phone'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'customer_shipping_address';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'customer_id' => Yii::t('app', 'Customer ID'),
            'country' => Yii::t('app', 'Country'),
            'city' => Yii::t('app', 'City'),
            'state' => Yii::t('app', 'State'),
            'zip_code' => Yii::t('app', 'Zip Code'),
            'phone' => Yii::t('app', 'Phone'),
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(\thienhungho\CustomerManagement\modules\CustomerBase\Customer::className(), ['id' => 'customer_id']);
    }
    
    /**
     * @inheritdoc
     * @return array mixed
     */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new \yii\db\Expression('NOW()'),
            ],
            'blameable' => [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
            ],
        ];
    }


    /**
     * @inheritdoc
     * @return \thienhungho\CustomerManagement\modules\CustomerBase\query\CustomerShippingAddressQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \thienhungho\CustomerManagement\modules\CustomerBase\query\CustomerShippingAddressQuery(get_called_class());
    }
}
