<?php

use yii\db\Migration;

/**
 * Handles the creation of table `departments`.
 * Has foreign keys to the tables:
 *
 * - `companies`
 * - `branches`
 */
class m170807_105809_create_departments_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('departments', [
            'id' => $this->primaryKey(),
            'company_id' => $this->integer()->notNull(),
            'branch_id' => $this->integer()->notNull(),
            'name' => $this->string(100),
            'created_date' => $this->dateTime(),
        ]);

        $this->execute("ALTER TABLE `departments` 
            ADD `status` ENUM('active','inactive') NOT NULL AFTER `created_date`;");

        // creates index for column `company_id`
        $this->createIndex(
            'idx-departments-company_id',
            'departments',
            'company_id'
        );

        // add foreign key for table `companies`
        $this->addForeignKey(
            'fk-departments-company_id',
            'departments',
            'company_id',
            'companies',
            'id',
            'CASCADE'
        );

        // creates index for column `branch_id`
        $this->createIndex(
            'idx-departments-branch_id',
            'departments',
            'branch_id'
        );

        // add foreign key for table `branches`
        $this->addForeignKey(
            'fk-departments-branch_id',
            'departments',
            'branch_id',
            'branches',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `companies`
        $this->dropForeignKey(
            'fk-departments-company_id',
            'departments'
        );

        // drops index for column `company_id`
        $this->dropIndex(
            'idx-departments-company_id',
            'departments'
        );

        // drops foreign key for table `branches`
        $this->dropForeignKey(
            'fk-departments-branch_id',
            'departments'
        );

        // drops index for column `branch_id`
        $this->dropIndex(
            'idx-departments-branch_id',
            'departments'
        );

        $this->dropTable('departments');
    }
}
