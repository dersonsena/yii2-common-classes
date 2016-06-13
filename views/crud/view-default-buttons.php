<?php
/** @var \yii\web\View $this */
use yii\helpers\Html;
?>

<div class="btn-group pull-left">
    <?= Html::a('<i class="fa fa-plus-circle"></i> ' . Yii::t('common', 'New Record'), [$this->context->id . '/create'], [
        'class'=>'btn btn-primary',
        'title' => Yii::t('common', 'Click here to Registering a new record')
    ]) ?>

    <?= Html::a('<i class="glyphicon glyphicon-pencil"></i> ' . Yii::t('common', 'Update Button') ,[$this->context->id . '/update', 'id'=>Yii::$app->getRequest()->getQueryParam('id')], [
        'class'=>'btn btn-default',
        'title' => Yii::t('common', 'Click here to update this record')
    ]) ?>

    <?= Html::a('<i class="glyphicon glyphicon-trash"></i> ' . Yii::t('common', 'Delete Button'),[$this->context->id . '/delete', 'id'=>Yii::$app->getRequest()->getQueryParam('id')], [
        'class'=>'btn btn-danger',
        'title' => Yii::t('common', 'Click here to delete this record'),
        'data-confirm' => Yii::t('common', 'Delete Confirm'),
        'data-method' => 'post',
        'data-pjax' => '0',
    ]) ?>
</div>

<div class="btn-group pull-right">

    <?= Html::a('<i class="glyphicon glyphicon-list-alt"></i> ' . Yii::t('common', 'Index Action Description'), [$this->context->id . '/index'], [
        'class' => 'btn btn-link',
        'title' => Yii::t('common', 'Back to this listing database module')
    ]) ?>

    <?= Html::a('<i class="glyphicon glyphicon-chevron-left"></i> ' . Yii::t('common', 'Previous page'), 'javascript:;', [
        'class' => 'btn btn-link',
        'title' => Yii::t('common', 'Back a page of your browsing history'),
        'onclick' => 'history.back(-1)'
    ]) ?>

</div>