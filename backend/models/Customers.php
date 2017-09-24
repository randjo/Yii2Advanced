<?php

namespace backend\models;

/**
 * This is the model class for table "customers".
 *
 * @property integer $id
 * @property string $name
 * @property string $zip_code
 * @property string $city
 * @property string $province
 */
class Customers extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'customers';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'zip_code', 'city', 'province'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'zip_code' => 'Zip Code',
            'city' => 'City',
            'province' => 'Province',
        ];
    }
}
