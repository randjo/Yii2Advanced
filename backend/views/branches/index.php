<?php

use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\BranchesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Branches';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="branches-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::button('Create Branch', ['id' => 'modal-button', 'value' => Url::to('/branches/create'), 'class' => 'btn btn-success']) ?>
    </p>

    <?php
        Modal::begin([
//            'header' => '<h4>Branches</h4>',
            'closeButton' => false,
            'id' => 'modal',
            'size' => 'modal-sm',
            'footer' => 'Copyright &copy ' . date('Y'),
            'clientOptions' => [
                'backdrop' => true,
                'keyboard' => false,
            ],
        ]);

        echo '<div id="modal-content"></div>';

        Modal::end();
    ?>
    <?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions' => function($model) {
            if ($model->status === 'active') {
                return ['class' => 'success'];
            } else {
                return ['class' => 'danger'];
            }
        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'company_id',
                'value' => 'company.name',
            ],
            'name',
            'address',
            'created_date',
             'status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
