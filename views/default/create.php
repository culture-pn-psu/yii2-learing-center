<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model culturePnPsu\learningCenter\models\LearningCenter */

$this->title = Yii::t('culture/learning', 'Create Learning Center');
$this->params['breadcrumbs'][] = ['label' => Yii::t('culture/learning', 'Learning Centers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="learning-center-create">

    <?= $this->render('_form', [
        'model' => $model,
        'modelsHistory' => $modelsHistory
    ]) ?>

</div>
