<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model culturePnPsu\learningCenter\models\LearningCenter */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('culture/learning', 'Learning Centers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
// echo "<pre>";
// print_r($model->history);
// exit();
?>
<div class="learning-center-view">


    

    <?= DetailView::widget([
        'model' => $model,
        'template' => "<tr><th class='text-right' width='20%'>{label}</th><td>{value}</td></tr>",
        'attributes' => [
            //'id',
            'title',
            [
                'attribute'=>'status',
                'format' => 'raw',
                'value' => $model->statusLabel
            ],
            [
                'attribute'=>'history',
                'format' => 'raw',
                'value' => $model->historyDisplay
            ],
            [
                'attribute'=>'learningCenterRange',
                'format' => 'raw',
                'value' => $model->learningCenterRangeDisplay.
                Html::a(Yii::t('culture/learning', 'Manage Range'), ['range', 'id' => $model->id], ['class' => 'btn btn-primary'])
            ],
            'created_at:datetime',
            'created_by',
            'updated_at:datetime',
            'updated_by',
        ],
    ]) ?>
    
    <p>
        <?= Html::a(Yii::t('culture/learning', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('culture/learning', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('culture/learning', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

</div>
