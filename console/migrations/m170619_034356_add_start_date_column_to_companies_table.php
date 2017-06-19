<?php

use yii\db\Migration;

/**
 * Handles adding start_date to table `companies`.
 */
class m170619_034356_add_start_date_column_to_companies_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('companies', 'start_date', $this->date()->notNull()->defaultValue(date('Y-m-d')));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('companies', 'start_date');
    }
}
