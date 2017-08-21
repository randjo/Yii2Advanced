<?php

use yii\db\Migration;

/**
 * Handles the creation of table `auth_assignment`.
 */
class m170812_233528_create_auth_assignment_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('auth_assignment', [
            'item_name' => $this->string(64)->notNull(),
            'user_id' => $this->string(64)->notNull(),
            'created_at' => $this->integer(),
            'PRIMARY KEY(item_name, user_id)',
        ]);
        
        // creates index for column `parent`
        $this->createIndex(
            'idx-auth_assignment-item_name',
            'auth_assignment',
            'item_name'
        );

        // add foreign key for table `auth_item`
        $this->addForeignKey(
            'fk-auth_assignment-item_name',
            'auth_assignment',
            'item_name',
            'auth_item',
            'name',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `auth_item`
        $this->dropForeignKey(
            'fk-auth_assignment-item_name',
            'auth_assignment'
        );

        // drops index for column `child`
        $this->dropIndex(
            'idx-auth_assignment-item_name',
            'auth_assignment'
        );
        
        $this->dropTable('auth_assignment');
    }
}
