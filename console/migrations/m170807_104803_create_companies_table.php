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
        ]);

        $this->execute("ALTER TABLE `companies` 
            ADD `status` ENUM('active','inactive') NOT NULL AFTER `created_date`;");
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('companies');
    }
}
