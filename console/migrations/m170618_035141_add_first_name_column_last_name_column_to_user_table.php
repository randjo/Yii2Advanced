<?php

use yii\db\Migration;

/**
 * Handles adding first_name_column_last_name to table `user`.
 */
class m170618_035141_add_first_name_column_last_name_column_to_user_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('user', 'first_name', $this->string(100)->notNull());
        $this->addColumn('user', 'last_name', $this->string(100)->notNull());
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
