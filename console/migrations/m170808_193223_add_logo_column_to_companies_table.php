<?php

use yii\db\Migration;

/**
 * Handles adding logo to table `companies`.
 */
class m170808_193223_add_logo_column_to_companies_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('companies', 'logo', $this->string(200));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('companies', 'logo');
    }
}
