<?php

namespace thienhungho\CustomerManagement\modules\CustomerBase\base;

use thienhungho\UserManagement\models\User;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the base model class for table "customer".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $avatar
 * @property string $first_name
 * @property string $last_name
 * @property string $company
 * @property string $phone
 * @property string $email
 * @property string $website
 * @property string $vat_number
 * @property string $language
 * @property string $address
 * @property string $country
 * @property string $city
 * @property string $state
 * @property string $zip_code
 * @property string $currency
 * @property string $type
 * @property string $status
 * @property string $created_at
 * @property string $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 *
 * @property \thienhungho\CustomerManagement\modules\CustomerBase\User $user
 * @property \thienhungho\CustomerManagement\modules\CustomerBase\CustomerBillingAddress[] $customerBillingAddresses
 * @property \thienhungho\CustomerManagement\modules\CustomerBase\CustomerNote[] $customerNotes
 * @property \thienhungho\CustomerManagement\modules\CustomerBase\CustomerReminders[] $customerReminders
 * @property \thienhungho\CustomerManagement\modules\CustomerBase\CustomerShippingAddress[] $customerShippingAddresses
 */
class Customer extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;


    /**
    * This function helps \mootensai\relation\RelationTrait runs faster
    * @return array relation names of this model
    */
    public function relationNames()
    {
        return [
            'user',
            'customerBillingAddresses',
            'customerNotes',
            'customerReminders',
            'customerShippingAddresses'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'created_by', 'updated_by'], 'integer'],
            [['first_name', 'last_name', 'phone', 'email'], 'required'],
            [['address'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['avatar', 'first_name', 'last_name', 'company', 'phone', 'email', 'website', 'vat_number', 'language', 'country', 'city', 'state', 'zip_code', 'currency', 'type', 'status'], 'string', 'max' => 255],
            [['phone'], 'unique'],
            [['email'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'customer';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'avatar' => Yii::t('app', 'Avatar'),
            'first_name' => Yii::t('app', 'First Name'),
            'last_name' => Yii::t('app', 'Last Name'),
            'company' => Yii::t('app', 'Company'),
            'phone' => Yii::t('app', 'Phone'),
            'email' => Yii::t('app', 'Email'),
            'website' => Yii::t('app', 'Website'),
            'vat_number' => Yii::t('app', 'Vat Number'),
            'language' => Yii::t('app', 'Language'),
            'address' => Yii::t('app', 'Address'),
            'country' => Yii::t('app', 'Country'),
            'city' => Yii::t('app', 'City'),
            'state' => Yii::t('app', 'State'),
            'zip_code' => Yii::t('app', 'Zip Code'),
            'currency' => Yii::t('app', 'Currency'),
            'type' => Yii::t('app', 'Type'),
            'status' => Yii::t('app', 'Status'),
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerBillingAddresses()
    {
        return $this->hasMany(\thienhungho\CustomerManagement\modules\CustomerBase\CustomerBillingAddress::className(), ['customer_id' => 'id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerNotes()
    {
        return $this->hasMany(\thienhungho\CustomerManagement\modules\CustomerBase\CustomerNote::className(), ['customer_id' => 'id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerReminders()
    {
        return $this->hasMany(\thienhungho\CustomerManagement\modules\CustomerBase\CustomerReminders::className(), ['customer_id' => 'id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerShippingAddresses()
    {
        return $this->hasMany(\thienhungho\CustomerManagement\modules\CustomerBase\CustomerShippingAddress::className(), ['customer_id' => 'id']);
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
     * @return \thienhungho\CustomerManagement\modules\CustomerBase\query\CustomerQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \thienhungho\CustomerManagement\modules\CustomerBase\query\CustomerQuery(get_called_class());
    }
}
