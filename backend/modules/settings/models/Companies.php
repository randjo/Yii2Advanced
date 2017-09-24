<?php

namespace backend\modules\settings\models;

use backend\models\Branches;
use backend\models\Departments;
/**
 * This is the model class for table "companies".
 *
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $address
 * @property string $logo
 * @property string $created_date
 * @property string $start_date
 * @property string $status
 *
 * @property Branches[] $branches
 * @property Departments[] $departments
 */
class Companies extends \yii\db\ActiveRecord
{
    public $file;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'companies';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_date'], 'safe'],
            ['start_date', 'checkDate'],
            [['status'], 'required'],
            [['status'], 'string'],
            [['file'], 'file'],
            [['name', 'email'], 'string', 'max' => 100],
            [['logo'], 'string', 'max' => 200],
            [['address'], 'string', 'max' => 255],
        ];
    }

    public function checkDate($attribute)
    {
        $today = date('Y-m-d');
        $selectedDate = $this->start_date;
        if ($selectedDate > $today) {
            $this->addError($attribute, 'Company Start Date must be smaller.');
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Company Name',
            'email' => 'Email',
            'address' => 'Address',
            'created_date' => 'Created Date',
            'status' => 'Status',
            'file' => 'Logo',
            'logo' => 'Logo',
            'start_date' => 'Start Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBranches()
    {
        return $this->hasMany(Branches::className(), ['company_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDepartments()
    {
        return $this->hasMany(Departments::className(), ['company_id' => 'id']);
    }
}