<?php

use yii\db\Migration;

/**
 * Handles the creation of table `customers`.
 */
class m170923_232007_create_customers_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('customers', [
            'id' => $this->primaryKey(),
            'name' => $this->string(100),
            'zip_code' => $this->string(100),
            'city' => $this->string(100),
            'province' => $this->string(100),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('customers');
    }
}
