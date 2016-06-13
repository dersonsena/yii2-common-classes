<?php
use yii\helpers\Html;
?>

<div class="btn-group">
    <?= Html::a('<i class="fa fa-plus-circle"></i> ' . Yii::t('common', 'New Record'), ["{$this->context->id}/create"], [
        'class' => 'btn btn-primary',
        'title' => Yii::t('common', 'Registering a new record')
    ]) ?>
</div>