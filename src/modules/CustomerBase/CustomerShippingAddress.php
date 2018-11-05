<?php

namespace thienhungho\CustomerManagement\modules\CustomerBase;

use Yii;
use \thienhungho\CustomerManagement\modules\CustomerBase\base\CustomerShippingAddress as BaseCustomerShippingAddress;

/**
 * This is the model class for table "customer_shipping_address".
 */
class CustomerShippingAddress extends BaseCustomerShippingAddress
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['customer_id', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['country', 'city', 'state', 'zip_code', 'phone'], 'string', 'max' => 255]
        ]);
    }
	
}
