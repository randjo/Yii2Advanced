<?php

use yii\db\Migration;

/**
 * Handles the creation of table `test1`.
 */
class m170917_142900_change_number_column_test1_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->changeColumnType('test1', 'id', 'number', 'timestamp');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->changeColumnType('test1', 'id', 'number', 'integer');
    }

    /**
     * @param string $table
     * @param string $id
     * @param string $column
     * @param string $type
     */
    public function changeColumnType(string $table, string $id, string $column, string $type)
    {
        //get values from table before update
        $data = Yii::$app->db->createCommand("SELECT $id, $column FROM $table")->queryAll();

        //drop the column, which needs to change
        $this->dropColumn($table, $column);

        //add same column with new type
        $this->addColumn($table, $column, $type);

        //update column's values
        foreach ($data as $row) {
            if ($type === 'timestamp') {
                Yii::$app->db->createCommand()
                    ->update($table, [$column => date("Y-m-d H:i:s", $row[$column])], [$id => $row[$id]])
                    ->execute();
            } elseif ($type === 'integer') {
                Yii::$app->db->createCommand()
                    ->update($table, [$column => strtotime($row[$column])], [$id => $row[$id]])
                    ->execute();
            }
        }
    }
}
