<?php
use yii\helpers\Html;
?>

<div class="btn-group pull-left">

    <?= Html::submitButton('<i class="glyphicon glyphicon-floppy-saved white"></i> ' . Yii::t('common', 'Save'), [
        'class' => 'btn btn-primary',
        'title' => Yii::t('common', 'Click here to save this record')
    ]) ?>

    <?= Html::submitButton('<i class="glyphicon glyphicon-floppy-saved white"></i> ' . Yii::t('common', 'Save and Stay Here'), [
        'name' => 'save-and-continue',
        'class' => 'btn btn-default',
        'title' => Yii::t('common', 'Click here to save the entry and stay on this screen')
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