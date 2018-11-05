<?php

namespace thienhungho\CustomerManagement\modules\CustomerBase;

use Yii;
use \thienhungho\CustomerManagement\modules\CustomerBase\base\CustomerNote as BaseCustomerNote;

/**
 * This is the model class for table "customer_note".
 */
class CustomerNote extends BaseCustomerNote
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
            [['content', 'type'], 'string', 'max' => 255]
        ]);
    }
	
}
