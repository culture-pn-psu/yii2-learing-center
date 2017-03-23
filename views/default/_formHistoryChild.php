<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;
use culturePnPsu\learningCenter\models\LearningCenterHistory;

$modelsHistory = [new LearningCenterHistory];

/* @var $this yii\web\View */
/* @var $model culturePnPsu\learningCenter\models\LearningCenter */
/* @var $form yii\widgets\ActiveForm */
?>


   <?php DynamicFormWidget::begin([
        'widgetContainer' => 'dynamicform_wrapper',
        'widgetBody' => '.container-items',
        'widgetItem' => '.house-item',
        'limit' => 10,
        'min' => 1,
        'insertButton' => '.add-house',
        'deleteButton' => '.remove-house',
        'model' => $modelsHistory[0],
        'formId' => 'dynamic-form',
        'formFields' => [
            'description',
        ],
    ]); ?>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Houses</th>
                <th style="width: 450px;">Rooms</th>
                <th class="text-center" style="width: 90px;">
                    <button type="button" class="add-house btn btn-success btn-xs"><span class="fa fa-plus"></span></button>
                </th>
            </tr>
        </thead>
        <tbody class="container-items">
        <?php foreach ($modelsHistory as $indexHouse => $modelHouse): ?>
            <tr class="house-item">
                <td class="vcenter">
                    <?php
                        
                    ?>
                    <?= $form->field($modelHouse, "[{$indexHouse}]key")->label(false)->textInput(['maxlength' => true]) ?>
                </td>
                <td>
                   <?= $form->field($modelHouse, "[{$indexHouse}]value")->label(false)->textInput(['maxlength' => true]) ?>
                </td>
                <td class="text-center vcenter" style="width: 90px; verti">
                    <button type="button" class="remove-house btn btn-danger btn-xs"><span class="fa fa-minus"></span></button>
                </td>
            </tr>
         <?php endforeach; ?>
        </tbody>
    </table>
    <?php DynamicFormWidget::end(); ?>
   
   
