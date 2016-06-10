<?php

namespace app\common\components;

use app\common\model\ModelBase;
use yii\grid\DataColumn;
use yii\helpers\Html;

class LinkDataColumn extends DataColumn
{
    public function init()
    {
        parent::init();

        $this->content = function(ModelBase $model, $key, $index, DataColumn $column) {
            return Html::a($model->{$column->attribute}, ['view', 'id'=>$model->primaryKey], [
                'title' => 'Visualizar este registro'
            ]);
        };
    }
}