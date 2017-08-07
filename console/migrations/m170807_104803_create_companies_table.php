<?php

use yii\db\Migration;

/**
 * Handles the creation of table `companies`.
 */
class m170807_104803_create_companies_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('companies', [
            'id' => $this->primaryKey(),
            'name' => $this->string(100),
            'email' => $this->string(100),
            'address' => $this->string(255),
            'created_date' => $this->dateTime(),
//            'status' => $this->enum('active','inactive'),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('companies');
    }
}
