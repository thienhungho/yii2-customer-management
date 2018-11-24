<?php

namespace thienhungho\CustomerManagement\modules\CustomerBase\query;

/**
 * This is the ActiveQuery class for [[\thienhungho\CustomerManagement\modules\CustomerBase\query\CustomerNote]].
 *
 * @see \thienhungho\CustomerManagement\modules\CustomerBase\query\CustomerNote
 */
class CustomerNoteQuery extends \thienhungho\ActiveQuery\models\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return \thienhungho\CustomerManagement\modules\CustomerBase\query\CustomerNote[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \thienhungho\CustomerManagement\modules\CustomerBase\query\CustomerNote|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
