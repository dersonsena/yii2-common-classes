<?php
use yii\helpers\Html;
?>

<div class="btn-group pull-left">

    <?= Html::submitButton('<i class="glyphicon glyphicon-floppy-saved white"></i> Salvar', [
        'class' => 'btn btn-primary',
        'title' => 'Clique aqui para salvar o registro'
    ]) ?>

    <?= Html::submitButton('<i class="glyphicon glyphicon-floppy-saved white"></i> Salvar e Permanecer Aqui', [
        'name' => 'save-and-continue',
        'class' => 'btn btn-default',
        'title' => 'Clique aqui para salvar o registro e permanecer nesta tela'
    ]) ?>

</div>

<div class="btn-group pull-right">

    <?= Html::a('<i class="glyphicon glyphicon-list-alt"></i> Listagem de Dados', [$this->context->id . '/index'], [
        'class' => 'btn btn-link',
        'title' => 'Voltar para a Listagem de dados desse módulo'
    ]) ?>

    <?= Html::a('<i class="glyphicon glyphicon-chevron-left"></i> Página Anterior', 'javascript:;', [
        'class' => 'btn btn-link',
        'title' => 'Voltar uma página do seu histórico de navegação',
        'onclick' => 'history.back(-1)'
    ]) ?>

</div>