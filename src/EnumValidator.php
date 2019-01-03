<?php

namespace nzz\validators;

use yii\db\Query;
use yii\validators\Validator;

/**
 * Validate attributes that are of type enum
 */
class EnumValidator extends Validator
{
    /**
     * Validate the value of an attribute that is of type enum
     * Add something like this to your rules to use this validator:
     *      ['status', '\nzz\validators\EnumValidator'],
     */
    public function validateAttribute($model, $attribute)
    {
        $enumValues = $model->getTableSchema()->columns[$attribute]->enumValues;
        if (!in_array($model->$attribute, $enumValues)) {
            $this->addError($model, $attribute, \Yii::t('app', 'Illegal value'));
        }
    }
}

