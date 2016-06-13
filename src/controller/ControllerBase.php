<?php

namespace dersonsena\commonClasses\controller;

use Yii;
use dersonsena\commonClasses\TranslationTrait;
use dersonsena\userModule\models\User;
use dersonsena\commonClasses\components\Formatter;
use OutOfBoundsException;
use yii\base\UserException;
use yii\bootstrap\Html;
use yii\helpers\Url;
use yii\web\Controller;

abstract class ControllerBase extends Controller
{
    use TranslationTrait;

    public $layout = '/main';

    /**
     * @var string
     */
    public $controllerDescription;

    /**
     * @var string
     */
    public $actionDescription;

    public function init()
    {
        $dir = Yii::getAlias('@vendor/dersonsena/yii2-common-classes/src');
        $this->initI18N($dir, 'common');
        $this->controllerDescription = Yii::t('common', 'NO CONTROLLER DESCRIPTION');
        $this->actionDescription = Yii::t('common', 'NO ACTION DESCRIPTION');

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
            throw new UserException(Yii::t('common', 'User not auth'));

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
            1 => Yii::t('common', 'Active'),
            0 => Yii::t('common', 'Inactive')
        ];

        if(!is_null($status) && !isset($list[$status]))
            throw new OutOfBoundsException(Yii::t('common', 'No status code was found {statusCode}', ['statusCode' => $status]));

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
            throw new OutOfBoundsException(Yii::t('common', 'No status code was found {statusCode}', ['statusCode' => $status]));

        if($status == 1) {

            $params = [
                'cssClass' => 'label-success',
                'label' => Yii::t('common', 'Yes'),
                'iconClass'=>'fa fa-check-circle'
            ];

        } else {

            $params = [
                'cssClass' => 'label-danger',
                'label' => Yii::t('common', 'No'),
                'iconClass'=>'glyphicon glyphicon-minus-sign'
            ];

        }

        return '<span class="label '. $params['cssClass'] .'">
            <i class="'. $params['iconClass'] .'"></i> '. $params['label'] .
        '</span>';
    }
}