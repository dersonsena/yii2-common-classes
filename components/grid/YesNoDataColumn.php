<?php

namespace app\common\components;

use app\common\controller\ControllerBase;
use app\common\model\ModelBase;
use yii\grid\DataColumn;

class YesNoDataColumn extends DataColumn
{
    public function init()
    {
        $this->headerOptions = ['class' => 'text-center', 'style' => 'width: 115px'];
        $this->contentOptions = ['class' => 'text-center'];

        parent::init();

        $this->content = function(ModelBase $model, $key, $index, DataColumn $column) {
            return ControllerBase::getYesNoLabel($model->{$column->attribute});
        };
    }
}