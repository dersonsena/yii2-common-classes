<?php

namespace dersonsena\commonClasses\controller;

use Yii;
use dersonsena\userModule\models\User;
use dersonsena\commonClasses\components\Formatter;
use OutOfBoundsException;
use yii\base\UserException;
use yii\bootstrap\Html;
use yii\helpers\Url;
use yii\web\Controller;

abstract class ControllerBase extends Controller
{
    public $layout = '/main';

    /**
     * @var string
     */
    public $controllerDescription = 'NO CONTROLLER DESCRIPTION';

    /**
     * @var string
     */
    public $actionDescription = 'NO ACTION DESCRIPTION';

    public function init()
    {
        parent::init();
        Yii::setAlias('@common-classes', '@vendor/dersonsena/yii2-common-classes');

        Yii::$app->params['pagination']['pageSize'] = 25;

        Yii::$app->params['maskMoneyOptions'] = [
            'prefix' => 'R$ ',
            'suffix' => '',
            'affixesStay' => true,
            'thousands' => '.',
            'decimal' => ',',
            'precision' => 2,
            'allowZero' => false,
            'allowNegative' => false,
        ];

        Yii::$app->params['defaultAddons'] = [
            'money' => [
                'prepend' => ['content' => '<i class="fa fa-money" aria-hidden="true"></i>']
            ],
            'url' => [
                'prepend' => ['content' => 'http://']
            ],
            'email' => [
                'prepend' => ['content' => Html::icon('envelope')]
            ],
            'phone' => [
                'prepend' => ['content' => Html::icon('phone-alt')]
            ],
            'date' => [
                'prepend' => ['content' => Html::icon('calendar')]
            ],
            'time' => [
                'prepend' => ['content' => Html::icon('time')]
            ]
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Metodo que retorna o object Request
     * @return \yii\console\Request|\yii\web\Request
     */
    public function getRequest()
    {
        return Yii::$app->getRequest();
    }

    /**
     * Metodo que retora a instancia da sessao
     * @return \yii\web\Session
     */
    public function getSession()
    {
        return Yii::$app->getSession();
    }

    /**
     * Metodo que retorna a instancia do usuario logado ou nao da aplicacao
     * @return \yii\web\User
     */
    public function getUser()
    {
        return Yii::$app->getUser();
    }

    /**
     * Metodo que retorna o Objeto do usuario atualmente logado
     * @return User
     * @throws UserException
     */
    public function getUserIdentity()
    {
        if($this->getUser()->isGuest)
            throw new UserException('Não foi possível pegar informações do Usuário. Usuário não autenticado.');

        return $this->getUser()->getIdentity();
    }

    /**
     * Metodo que captura o post
     * @param string $name
     * @param string $defaultValue
     * @return array|mixed
     */
    public function getPost($name=null, $defaultValue=null)
    {
        return $this->getRequest()->post($name, $defaultValue);
    }

    /**
     * Metodo que captura parametros GET
     * @param string $name
     * @param mixed $defaultValue
     * @return array|mixed
     */
    public function getQuery($name, $defaultValue=null)
    {
        return $this->getRequest()->get($name, $defaultValue);
    }

    /**
     * Metodo que retorna a URL base da Aplicacao
     * @param string $url Caso seja necessario concatenar uma URL com
     * o baseUrl, base informar este parametro
     * @return string
     */
    public function getBaseUrl($url=null)
    {
        if(is_null($url))
            return Url::base(true);

        return Url::base(true) . '/' . $url;
    }

    /**
     * Metodo que retorna o formatter para utilizacao nos controllers
     * @return Formatter
     */
    public function getFormatter()
    {
        return Yii::$app->formatter;
    }

    /**
     * Metodo que retorna uma lista de status ou um status especifico
     * @param int $status
     * @return array|int
     */
    public static function getStatus($status=null)
    {
        $list = [
            1 => 'Ativo',
            0 => 'Inativo'
        ];

        if(!is_null($status) && !isset($list[$status]))
            throw new OutOfBoundsException("Não foi encontrado código do status '{$status}'.");

        return (is_null($status) ? $list : $list[$status]);
    }

    /**
     * Metodo que poe um icone do de um status do registro para grid
     * @param integer $status Status do registro
     * @return string HTML com a classe dependendo do status enviado
     */
    public static function getYesNoLabel($status)
    {
        $list = self::getStatus();

        if(!isset($list[$status]))
            throw new OutOfBoundsException("Não foi encontrado código do status '{$status}'.");

        if($status == 1) {

            $params = [
                'cssClass' => 'label-success',
                'label' => 'Sim',
                'iconClass'=>'fa fa-check-circle'
            ];

        } else {

            $params = [
                'cssClass' => 'label-danger',
                'label' => 'Não',
                'iconClass'=>'glyphicon glyphicon-minus-sign'
            ];

        }

        return '<span class="label '. $params['cssClass'] .'">
            <i class="'. $params['iconClass'] .'"></i> '. $params['label'] .
        '</span>';
    }
}