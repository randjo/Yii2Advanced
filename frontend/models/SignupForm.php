<?php
namespace frontend\models;

use backend\models\AuthAssignment;
use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $first_name;
    public $last_name;
    public $username;
    public $email;
    public $password;
    public $permissions;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['first_name', 'last_name', 'username', 'email'], 'trim'],
            [['first_name', 'last_name', 'username', 'email', 'password'], 'required'],
            
            [['first_name', 'last_name'], 'string', 'min' => 2, 'max' => 100],
            ['username', 'string', 'min' => 2, 'max' => 255],
            ['password', 'string', 'min' => 6],
            ['email', 'string', 'max' => 255],

            ['email', 'email'],
            
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],    
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new User();
        $user->first_name = $this->first_name;
        $user->last_name = $this->last_name;
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();

        $permissionList = $_POST['SignupForm']['permissions'];
        if ($user->save()) {
            foreach ($permissionList as $permission) {
                $newPermission = new AuthAssignment();
                $newPermission->item_name = $permission;
                $newPermission->user_id = $user->id;
                $newPermission->created_at = strtotime('now');
                $newPermission->save();
            }
            return $user;
        } else {
            return null;
        }
    }
}
