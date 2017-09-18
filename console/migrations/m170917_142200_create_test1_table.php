<?php

use yii\db\Migration;

/**
 * Handles the creation of table `test1`.
 */
class m170917_142200_create_test1_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('test1', [
            'id' => $this->primaryKey(),
            'number' => $this->integer(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('test1');
    }
}
