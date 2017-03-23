<?php

use yii\widgets\DetailView;

use yii\bootstrap\Html;
use yii\bootstrap\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;

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
            'created_at:datetime',
            'created_by',
            'updated_at:datetime',
            'updated_by',
        ],
    ]) ?>
    


<div class="learning-center-form">

    <?php $form = ActiveForm::begin([
            'layout' => 'horizontal',
            'fieldConfig' => [
                'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
                'horizontalCssClasses' => [
                    'label' => 'col-sm-3',
                    'offset' => 'col-sm-offset-4',
                    'wrapper' => 'col-sm-9',
                    'error' => '',
                    'hint' => '',
                ],
            ],
            'id' => 'dynamic-form'
    ]); ?>

    <?= Html::errorSummary($modelsRange) ?>
    
    <?= $form->field($model, 'id')->hiddenInput()->label(false) ?>
    
    <div class="form-group ">
        <?=Html::activeLabel($modelsRange[0],'time',['class'=>'control-label col-sm-3'])?>
        
        <div class="col-sm-9" style="padding:0 10px;">
            <?= $this->render('_formRange',[
                'form' => $form,
                'model' => $model,
                'modelsRange' => $modelsRange
            ])?>
       </div>
    </div>
   
   

    <div class="form-group ">
        <div class="col-sm-offset-3">
        <?= Html::submitButton(Yii::t('culture/learning', 'Save'), ['class' => 'btn btn-success']) ?>
        </div>
    </div>
    

    <?php ActiveForm::end(); ?>

</div>


</div>
