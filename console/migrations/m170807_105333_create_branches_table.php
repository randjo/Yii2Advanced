<?php

use yii\db\Migration;

/**
 * Handles the creation of table `branches`.
 * Has foreign keys to the tables:
 *
 * - `companies`
 */
class m170807_105333_create_branches_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('branches', [
            'id' => $this->primaryKey(),
            'company_id' => $this->integer()->notNull(),
            'name' => $this->string(100),
            'adrress' => $this->string(255),
            'created_date' => $this->dateTime(),
//            'status' => $this->enum('active', 'inactive'),
        ]);

        // creates index for column `company_id`
        $this->createIndex(
            'idx-branches-company_id',
            'branches',
            'company_id'
        );

        // add foreign key for table `companies`
        $this->addForeignKey(
            'fk-branches-company_id',
            'branches',
            'company_id',
            'companies',
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
            'fk-branches-company_id',
            'branches'
        );

        // drops index for column `company_id`
        $this->dropIndex(
            'idx-branches-company_id',
            'branches'
        );

        $this->dropTable('branches');
    }
}
