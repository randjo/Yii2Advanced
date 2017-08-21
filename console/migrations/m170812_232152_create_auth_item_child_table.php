<?php

use yii\db\Migration;

/**
 * Handles the creation of table `auth_item_child`.
 */
class m170812_232152_create_auth_item_child_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('auth_item_child', [
            'parent' => $this->string(64)->notNull(),
            'child' => $this->string(64)->notNull(),
            'PRIMARY KEY(parent, child)',
        ]);
        
        // creates index for column `parent`
        $this->createIndex(
            'idx-auth_item_child-parent',
            'auth_item_child',
            'parent'
        );

        // add foreign key for table `auth_item`
        $this->addForeignKey(
            'fk-auth_item_child-parent',
            'auth_item_child',
            'parent',
            'auth_item',
            'name',
            'CASCADE'
        );
        
        // creates index for column `child`
        $this->createIndex(
            'idx-auth_item_child-child',
            'auth_item_child',
            'child'
        );

        // add foreign key for table `auth_item`
        $this->addForeignKey(
            'fk-auth_item_child-child',
            'auth_item_child',
            'child',
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
            'fk-auth_item_child-child',
            'auth_item_child'
        );

        // drops index for column `child`
        $this->dropIndex(
            'idx-auth_item_child-child',
            'auth_item_child'
        );
        
        // drops foreign key for table `auth_item`
        $this->dropForeignKey(
            'fk-auth_item_child-parent',
            'auth_item_child'
        );

        // drops index for column `parent`
        $this->dropIndex(
            'idx-auth_item_child-parent',
            'auth_item_child'
        );
        
        $this->dropTable('auth_item_child');
    }
}
