<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
use culturePnPsu\learningCenter\models\LearningCenter;
use culturePnPsu\learningCenter\models\LearningCenterRange;
/* @var $this yii\web\View */
/* @var $searchModel culturePnPsu\learningCenter\models\LearningCenterSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('culture/learning', 'Learning Centers');
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="learning-center-index">

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('culture/learning', 'Create Learning Center'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'title',
            [
                'attribute'=>'status',
                'value' => 'statusLabel'
            ],
            [
                'attribute'=>'history',
                'format' => 'html',
                'value' => function($model){
                    return $model->historyDisplay;
                }
            ],
            [
                'attribute'=>'learningCenterRange',
                'format' => 'html',
                'filter' => LearningCenterRange::getList(),
                'contentOptions' => ['nowrap'=>'nowrap'],
                'value' => function($model){
                   $result = ArrayHelper::getColumn($model->learningCenterRange, function ($element) {
                        return '<b>'.$element->title." :</b>".Yii::$app->formatter->asTime($element->time,"php:H:i")." น.";
                    });
                return implode('<br/>',$result);
                }
            ],
            'created_at:date',
            // [
            //     'attribute'=>'created_by',
            //     'value'=>'createdBy',
            // ],
            // 'created_by',
            // 'updated_at',
            // 'updated_by',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
