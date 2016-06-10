<?php
use yii\helpers\Html;
?>

<div class="btn-group">
    <?= Html::a('<i class="fa fa-plus-circle"></i> Novo Registro', ["{$this->context->id}/create"], [
        'class' => 'btn btn-primary',
        'title' => 'Inserir um novo registro'
    ]) ?>
</div>