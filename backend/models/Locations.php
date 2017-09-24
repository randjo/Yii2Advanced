<?php

namespace backend\models;

/**
 * This is the model class for table "locations".
 *
 * @property integer $id
 * @property string $zip_code
 * @property string $city
 * @property string $province
 */
class Locations extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'locations';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['zip_code'], 'string', 'max' => 10],
            [['city', 'province'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'zip_code' => 'Zip Code',
            'city' => 'City',
            'province' => 'Province',
        ];
    }
}
