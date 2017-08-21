<?php

use yii\db\Migration;

/**
 * Handles the creation of table `auth_item`.
 * Has foreign keys to the tables:
 *
 * - `auth_rule`
 */
class m170812_225219_create_auth_item_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('auth_item', [
            'name' => $this->string(64)->notNull(),
            'type' => $this->integer()->notNull(),
            'description' => $this->text(),
            'rule_name' => $this->string(64),
            'data' => $this->text(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'PRIMARY KEY(name)',
        ]);
        
        // creates index for column `type`
        $this->createIndex(
            'idx-auth_item-type',
            'auth_item',
            'type'
        );

        // creates index for column `rule_name`
        $this->createIndex(
            'idx-auth_item-rule_name',
            'auth_item',
            'rule_name'
        );

        // add foreign key for table `auth_rule`
        $this->addForeignKey(
            'fk-auth_item-rule_name',
            'auth_item',
            'rule_name',
            'auth_rule',
            'name',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `auth_rule`
        $this->dropForeignKey(
            'fk-auth_item-rule_name',
            'auth_item'
        );

        // drops index for column `rule_name`
        $this->dropIndex(
            'idx-auth_item-rule_name',
            'auth_item'
        );
        
        // drops index for column `type`
        $this->dropIndex(
            'idx-auth_item-type',
            'auth_item'
        );

        $this->dropTable('auth_item');
    }
}
