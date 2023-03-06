<?php

namespace backend\components;

use Yii;
use backend\components\ActiveField;

class ActiveForm extends \yii\widgets\ActiveForm
{

    public $options = [
        'class' => 'form-horizontal my-form'
    ];

    public $fieldClass = 'backend\components\ActiveField';


    /**
     *
     * @param array $options
     * @return string
     */

//    public function defaultButtons(array $options = [])
//    {
//        $options['size'] = isset($options['size']) ? $options['size'] : 4;
//        return '<div class="form-group">
//                    <div class="col-sm-' . $options['size'] . ' col-sm-offset-2">
//                        <button class="btn btn-primary" type="submit">' . Yii::t('app', 'Save') . '</button>
//                        <button class="btn btn-white" type="reset">' . Yii::t('app', 'Reset') . '</button>
//                    </div>
//                </div>';
//    }

    /**
     * Generates a form field.
     * @param $model
     * @param $attribute
     * @param array $options
     * @return ActiveField the created ActiveField object.
     * @see fieldConfig
     */
    public function field($model, $attribute, $options = [])
    {
        $activeField = parent::field($model, $attribute, $options);
        /** @var $activeField ActiveField */
        return $activeField;
    }

}