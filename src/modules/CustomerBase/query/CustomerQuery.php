<?php

namespace thienhungho\CustomerManagement\modules\CustomerBase\query;

/**
 * This is the ActiveQuery class for [[\thienhungho\CustomerManagement\modules\CustomerBase\query\Customer]].
 *
 * @see \thienhungho\CustomerManagement\modules\CustomerBase\query\Customer
 */
class CustomerQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return \thienhungho\CustomerManagement\modules\CustomerBase\query\Customer[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \thienhungho\CustomerManagement\modules\CustomerBase\query\Customer|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
