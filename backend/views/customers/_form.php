<?php

use backend\models\Locations;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Customers */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="customers-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'zip_code')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Locations::find()->all(), 'id', 'zip_code'),
        'language' => 'en',
        'options' => [
            'placeholder' => 'Select Location'
        ],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]) ?>

    <?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'province')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$script = <<< JS
$('#customers-zip_code').change(function() {
    $.get('/locations/get-city-province', {zipId: $(this).val()}, function(data) {
        var location = $.parseJSON(data);
        $('#customers-city').attr('value', location.city);
        $('#customers-province').attr('value', location.province);
    });
});
JS;
$this->registerJs($script);
?>

