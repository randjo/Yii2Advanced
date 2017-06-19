<?php

use yii\db\Migration;

/**
 * Handles the creation of table `companies`.
 */
class m170618_175229_create_companies_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('companies', [
            'id' => $this->primaryKey(),
            'name' => $this->string(100)->notNull(),
            'email' => $this->string(100)->notNull(),
            'address' => $this->string(255)->notNull(),
            'created_date' => $this->dateTime()->notNull(),
//            'status' => $this->enum('active', 'inactive'), //not support in Yii migrate tool
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
