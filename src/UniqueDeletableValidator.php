<?php

namespace nzz\validators;

use yii\db\Query;
use yii\validators\UniqueValidator;

/**
 * A unique validator for models that have an is_deleted attribute.
 * Extends the yii UniqueValidator so all of its features still apply.
 */
class UniqueDeletableValidator extends UniqueValidator
{
    /**
     * @param $deletableAttributeName string The name of the attribute to check for is_deleted
     */
    public $deletableAttributeName = 'is_deleted';

    public function init()
    {
        parent::init();

        $oldFilter = $this->filter;
        $this->filter = function(Query $query) use ($oldFilter) {
            // Apply old filter
            if ($oldFilter !== null) {
                if ($oldFilter instanceof \Closure) {
                    call_user_func($oldFilter, $query);
                } elseif (oldFilter !== null) {
                    $query->andWhere($oldFilter);
                }
            }

            // Check is_deleted field
            $query->andWhere([$this->deletableAttributeName => 0]);

            //echo $query->createCommand()->getRawSql();die;
        };
    }
}

