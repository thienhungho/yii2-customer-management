<?php

namespace thienhungho\CustomerManagement\modules\CustomerBase;

use \thienhungho\CustomerManagement\modules\CustomerBase\base\Customer as BaseCustomer;

/**
 * This is the model class for table "customer".
 */
class Customer extends BaseCustomer
{
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
            [['email'], 'unique'],
            [['avatar'], 'default', 'value' => DEFAULT_AVATAR],
            [['updated_by'], 'default', 'value' => get_current_user_id()]
        ];
    }

    /**
     * @param bool $insert
     *
     * @return bool
     * @throws \yii\base\Exception
     * @throws \yii\base\InvalidConfigException
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $img = upload_img('Customer[avatar]');
            if (!empty($img)) {
                $this->avatar = $img;
            } elseif(empty($img) && !$this->isNewRecord) {
                $model = static::findOne(['id' => $this->id]);
                if ($model) {
                    $this->avatar = $model->avatar;
                }
            }

            return true;
        }

        return false;
    }

}
