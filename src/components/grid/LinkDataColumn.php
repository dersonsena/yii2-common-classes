<?php

namespace dersonsena\commonClasses\components\grid;

use dersonsena\commonClasses\ModelBase;
use Yii;
use yii\grid\DataColumn;
use yii\helpers\Html;

class LinkDataColumn extends DataColumn
{
    public function init()
    {
        parent::init();

        $this->content = function(ModelBase $model, $key, $index, DataColumn $column) {
            return Html::a($model->{$column->attribute}, ['view', 'id'=>$model->primaryKey], [
                'title' => Yii::t('common', 'View')
            ]);
        };
    }
}