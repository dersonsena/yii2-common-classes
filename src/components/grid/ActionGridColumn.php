<?php

namespace dersonsena\commonClasses\components\grid;

use Yii;
use yii\grid\ActionColumn;
use yii\helpers\Html;

class ActionGridColumn extends ActionColumn
{
    /**
     * @inheritdoc
     */
    public $header = 'Ações';

    /**
     * @inheritdoc
     */
    public $headerOptions = ['style' => 'width: 190px', 'class'=>'text-center'];

    /**
     * @inheritdoc
     */
    public $contentOptions = ['class' => 'text-center'];

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->template = '<div class="btn-group" role="group">'. $this->template .'</div>';
        parent::init();
    }

    /**
     * @inheritdoc
     */
    protected function initDefaultButtons()
    {
        if (!isset($this->buttons['view']))
            $this->createViewButton();

        if (!isset($this->buttons['update']))
            $this->createUpdateButton();

        if (!isset($this->buttons['delete']))
            $this->createDeleteButton();
    }

    /**
     * Metodo que cria o botao view nas acoes, caso ele nao exista
     * @return string
     */
    private function createViewButton()
    {
        $this->buttons['view'] = function ($url, $model, $key) {

            $options = array_merge([
                'title' => Yii::t('common', 'View'),
                'aria-label' => Yii::t('common', 'View'),
                'data-pjax' => '0',
                'class' => 'btn btn-default btn-sm'
            ], $this->buttonOptions);

            return Html::a('<span class="glyphicon glyphicon-eye-open"></span> ' . Yii::t('common', 'View Button'), $url, $options);
        };
    }

    /**
     * Metodo que cria o botao update nas acoes, caso ele nao exista
     * @return string
     */
    private function createUpdateButton()
    {
        $this->buttons['update'] = function ($url, $model, $key) {

            $options = array_merge([
                'title' => Yii::t('common', 'Update'),
                'aria-label' => Yii::t('common', 'Update'),
                'data-pjax' => '0',
                'class' => 'btn btn-default btn-sm'
            ], $this->buttonOptions);

            return Html::a('<span class="glyphicon glyphicon-pencil"></span> ' . Yii::t('common', 'Update Button'), $url, $options);
        };
    }

    /**
     * Metodo que cria o botao delete nas acoes, caso ele nao exista
     * @return string
     */
    private function createDeleteButton()
    {
        $this->buttons['delete'] = function ($url, $model, $key) {

            $options = array_merge([
                'title' => Yii::t('common', 'Delete'),
                'aria-label' => Yii::t('common', 'Delete'),
                'data-confirm' => Yii::t('common', 'Delete Confirm'),
                'data-method' => 'post',
                'data-pjax' => '0',
                'class' => 'btn btn-danger btn-sm'
            ], $this->buttonOptions);

            return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, $options);
        };
    }
}