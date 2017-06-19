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

    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->field($model, 'company_id')->dropDownList(
    ArrayHelper::map(Companies::find()->all(), 'id', 'name'), ['prompt' => 'Select Company']) ?>

    <?= $form->field($model, 'branch_id')->dropDownList(
    ArrayHelper::map(Branches::find()
            ->where(['company_id' => 1])->all(), 'id', 'name'), ['prompt' => 'Select Branch']) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>    

    <?= $form->field($model, 'status')->dropDownList([ 'active' => 'Active', 'inactive' => 'Inactive', ], ['prompt' => 'Status']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
