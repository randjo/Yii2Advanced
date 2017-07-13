<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Companies;
use backend\models\Branches;

/* @var $this yii\web\View */
/* @var $model backend\models\Departments */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="departments-form">

    <?php yii\widgets\Pjax::begin(['timeout' => 5000]); $form = ActiveForm::begin(); ?>
    
    <?= $form->field($model, 'company_id')->dropDownList(
        ArrayHelper::map(Companies::find()->all(), 'id', 'name'),
            [
                'prompt' => 'Select Company',
                'onChange' =>
                '$.post("/backend/web/branches/lists?id='.'"+$(this).val(), function(data){'
                . '$("select#departments-branch_id").html(data);'
                . '});'
            ]) ?>
    
    <?= $form->field($model, 'branch_id')->dropDownList(
<<<<<<< HEAD
    ArrayHelper::map(Branches::find()->all(), 'id', 'name'), ['prompt' => 'Select Branch']) ?>
=======
    ArrayHelper::map(Branches::find()
            ->where(['company_id' => 1])->all(), 'id', 'name'), ['prompt' => 'Select Branch']) ?>
>>>>>>> 63962f19473c176eb02083090eb276e12cd4fde6

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>    

    <?= $form->field($model, 'status')->dropDownList([ 'active' => 'Active', 'inactive' => 'Inactive', ], ['prompt' => 'Status']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); yii\widgets\Pjax::end(); ?>

</div>
