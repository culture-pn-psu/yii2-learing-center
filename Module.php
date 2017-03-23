<?php

namespace culturePnPsu\learningCenter;

/**
 * learningCenter module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'culturePnPsu\learningCenter\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->layout = 'main';
        parent::init();

        // custom initialization code goes here
    }
}
