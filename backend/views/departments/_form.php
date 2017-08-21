<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Companies;
use backend\models\Branches;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\Departments */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="departments-form">

    <?php $form = ActiveForm::begin(); ?>
    <?php $url = Yii::$app->urlManager->createUrl(['branches/lists']); ?>
    
    <?= $form->field($model, 'company_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Companies::find()->all(), 'id', 'name'),
        'language' => 'en',
        'options' => [
            'placeholder' => 'Select Company',
            'onChange' => '$.post("' . Yii::$app->homeUrl . 'branches/lists?id="+$(this).val(),'
            . 'function(data) {$("select#departments-branch_id").html(data)})',
        ],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]) ?>
    
    <?= $form->field($model, 'branch_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Branches::find()->all(), 'id', 'name'),
        'language' => 'en',
        'options' => ['placeholder' => 'Select Branch'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropDownList([ 'active' => 'Active', 'inactive' => 'Inactive', ], ['prompt' => 'Status']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
