<?php

namespace thienhungho\CustomerManagement\migrations;

use yii\db\Schema;

class m181105_080101_customer_shipping_address extends \yii\db\Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%customer_shipping_address}}', [
            'id'          => $this->primaryKey(),
            'customer_id' => $this->integer(19),
            'country'     => $this->string(255),
            'city'        => $this->string(255),
            'state'       => $this->string(255),
            'zip_code'    => $this->string(255),
            'phone'       => $this->string(255),
            'created_at'  => $this->timestamp()->notNull()->defaultValue(CURRENT_TIMESTAMP),
            'updated_at'  => $this->timestamp()->notNull()->defaultValue('0000-00-00 00:00:00'),
            'created_by'  => $this->integer(19),
            'updated_by'  => $this->integer(19),
            'FOREIGN KEY ([[customer_id]]) REFERENCES {{%customer}} ([[id]]) ON DELETE CASCADE ON UPDATE CASCADE',
        ], $tableOptions);

    }

    public function safeDown()
    {
        $this->dropTable('{{%customer_shipping_address}}');
    }
}
