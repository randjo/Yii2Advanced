<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;
use dosamigos\datepicker\DatePicker;
use kartik\datetime\DateTimePicker;
use yii\widgets\Pjax;
use backend\models\Companies;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\settings\models\CompaniesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Companies';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="companies-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Companies', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'name',
            [
                'attribute' => 'name',
                'format' => 'raw',
                'value' => function($model) {
                    return $model->name . ' ' . Html::img(Yii::$app->request->baseUrl . '/' . $model->logo,
                            ['alt' => 'logo', 'width' => '20', 'height' => '20']);
                },
            ],
            'email:email',
            'address',
            [
                'attribute' => 'created_date',
                'value' => 'created_date',
                'format' => 'raw',
                'filter' => DateTimePicker::widget([
                    'type' => DateTimePicker::TYPE_INPUT,
                    'model' => $searchModel,
                    'attribute' => 'created_date',
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => 'yyyy-mm-dd hh:ii:ss'
                    ]
                ]),
            ],
            [
                'attribute' => 'start_date',
                'value' => 'start_date',
                'format' => 'raw',
                'filter' => DatePicker::widget([
                    'model' => $searchModel,
                    'attribute' => 'start_date',
                    'clientOptions' => [
                        'autoclose' => true,
                        'format' => 'yyyy-mm-dd'
                    ]
                ]),
            ],
            [
                'attribute' => 'status',
                'headerOptions' => ['width' => '10%'],
                'format' => 'raw',
                'filter' => ['active' => 'Active', 'inactive' => 'Inactive'],
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
