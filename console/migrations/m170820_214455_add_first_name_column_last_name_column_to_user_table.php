<?php

use yii\db\Migration;

/**
 * Handles adding first_name_column_last_name to table `user`.
 */
class m170820_214455_add_first_name_column_last_name_column_to_user_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('user', 'first_name', $this->string(100));
        $this->addColumn('user', 'last_name', $this->string(100));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('user', 'first_name');
        $this->dropColumn('user', 'last_name');
    }
}
