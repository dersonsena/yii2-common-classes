<?php
/* @var $this yii\web\View */
/* @var $model \dersonsena\commonClasses\ModelBase */

$this->params['breadcrumbs'][] = [
    'label' => $this->context->controllerDescription,
    'url' => [$this->context->id . '/index']
];

$this->params['breadcrumbs'][] = $this->context->actionDescription;
?>

<div class="user-create">
    <?= $this->render("@frontend/views/{$this->context->id}/_form", [
        'model' => $model,
    ]) ?>
</div>