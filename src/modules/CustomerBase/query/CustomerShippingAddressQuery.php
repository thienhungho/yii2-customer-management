<?php

namespace thienhungho\CustomerManagement\modules\CustomerBase\query;

/**
 * This is the ActiveQuery class for [[\thienhungho\CustomerManagement\modules\CustomerBase\query\CustomerShippingAddress]].
 *
 * @see \thienhungho\CustomerManagement\modules\CustomerBase\query\CustomerShippingAddress
 */
class CustomerShippingAddressQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return \thienhungho\CustomerManagement\modules\CustomerBase\query\CustomerShippingAddress[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \thienhungho\CustomerManagement\modules\CustomerBase\query\CustomerShippingAddress|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
