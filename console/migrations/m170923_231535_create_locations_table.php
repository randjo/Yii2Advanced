<?php

use yii\db\Migration;

/**
 * Handles the creation of table `locations`.
 */
class m170923_231535_create_locations_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('locations', [
            'id' => $this->primaryKey(),
            'zip_code' => $this->string(10),
            'city' => $this->string(100),
            'province' => $this->string(100),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('locations');
    }
}
