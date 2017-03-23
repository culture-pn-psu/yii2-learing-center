<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model culturePnPsu\learningCenter\models\LearningCenter */

$this->title = Yii::t('culture/learning', 'Update {modelClass}: ', [
    'modelClass' => 'Learning Center',
]) . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('culture/learning', 'Learning Centers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('culture/learning', 'Update');
?>
<div class="learning-center-update">


    <?= $this->render('_form', [
        'model' => $model,
        'modelsHistory' => $modelsHistory
    ]) ?>

</div>
