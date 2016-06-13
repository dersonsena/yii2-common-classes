<?php

namespace dersonsena\commonClasses\controller;

use Yii;
use dersonsena\commonClasses\ModelBase;
use yii\base\Exception;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

abstract class CrudController extends ControllerBase
{
    /**
     * @var ModelBase
     */
    protected $model;

    /**
     * @var ModelBase
     */
    protected $modelSearch;

    public $layout = '/main';

    /**
     * Atributo que armazena o caminha para a view padrao para a acao create
     * @var string
     */
    protected $createViewFile = '@common-classes/views/crud/default-create';

    /**
     * Scenario para a acao create
     * @var string
     */
    protected $createScenario = 'default';

    /**
     * Atributo que armazena o caminha para a view padrao para a acao update
     * @var string
     */
    protected $updateViewFile = '@common-classes/views/crud/default-update';

    /**
     * Scenario para a acao update
     * @var string
     */
    protected $updateScenario = 'default';

    /**
     * Atributo que guarda a descricao padrao para action index
     * @var string
     */
    protected $indexActionDescription;

    /**
     * Atributo que guarda a descricao padrao para action view
     * @var string
     */
    protected $viewActionDescription;

    /**
     * Atributo que guarda a descricao padrao para action create
     * @var string
     */
    protected $createActionDescription;

    /**
     * Atributo que guarda a descricao padrao para action update
     * @var string
     */
    protected $updateActionDescription;

    /**
     * @var string Nome do atributo para caso a action precise fazer
     * upload de arquivos
     */
    protected $uploadField;

    /**
     * Metodo que deve retornar uma instancia do model utilizado para as acoes
     * base do backend
     * @return ModelBase
     */
    abstract protected function getModel();

    /**
     * Metodo que deve retornar uma instancia do model search utilizado para as acoes
     * base do backend
     * @return mixed
     */
    abstract protected function getModelSearch();

    public function init()
    {
        $this->model = $this->getModel();
        $this->modelSearch = $this->getModelSearch();
        $this->indexActionDescription = Yii::t('common', 'Index Action Description');
        $this->viewActionDescription = Yii::t('common', 'View Action Description');
        $this->createActionDescription = Yii::t('common', 'Create Action Description');
        $this->updateActionDescription = Yii::t('common', 'Update Action Description');

        parent::init();
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->actionDescription = $this->indexActionDescription;

        $dataProvider = $this->modelSearch->search($this->getRequest()->queryParams);

        return $this->render('index', [
            'searchModel' => $this->modelSearch,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $this->actionDescription = $this->viewActionDescription;

        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $this->actionDescription = $this->createActionDescription;
        $this->model->scenario = $this->createScenario;

        if ($this->model->load($this->getRequest()->post())) {

            if (!is_null($this->uploadField))
                $this->model->{$this->uploadField} = UploadedFile::getInstance($this->model, $this->uploadField);

            if ($this->model->validate())
                return $this->saveFormData();

        }

        return $this->render($this->createViewFile, [
            'model' => $this->model,
        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $this->actionDescription = $this->updateActionDescription;
        $this->model = $this->findModel($id);
        $this->model->scenario = $this->updateScenario;

        if ($this->model->load($this->getRequest()->post())) {

            if (!is_null($this->uploadField))
                $this->model->{$this->uploadField} = UploadedFile::getInstance($this->model, $this->uploadField);

            if ($this->model->validate())
                return $this->saveFormData();

        }

        return $this->render($this->updateViewFile, [
            'model' => $this->model,
        ]);
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        /** @var ModelBase $model */
        $model = $this->findModel($id);
        $model->deleted = 1;
        $model->save(true, ['deleted']);

        $this->getSession()->setFlash('growl', [
            'type' => 'success',
            'title' => Yii::t('common', 'All right!'),
            'message' => Yii::t('common', 'The record was successfully removed!')
        ]);

        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ModelBase the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = $this->model->findOne($id)) !== null)
            return $model;
        else
            throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * Metodo que faz o processo de cadastro ou atualizacao de dados
     * @return \yii\web\Response
     */
    protected function saveFormData()
    {
        try {

            if (!$this->model->save()) {
                throw new Exception(Yii::t('common', 'There was an error saving the record. Details: {error}', [
                    'error' => $this->model->getErrorsToString()
                ]));
            }

            $this->getSession()->setFlash('growl', [
                'type' => 'success',
                'title' => Yii::t('common', 'All right!'),
                'message' => Yii::t('common', 'Your data has been successfully saved!')
            ]);

            if (!is_null($this->getRequest()->post('save-and-continue')))
                return $this->refresh();
            else
                return $this->redirect(['index']);

        } catch(Exception $e) {
            $errorText = Yii::t('common', 'Oppss... Error!');
            $this->getSession()->setFlash('error', '<strong style="font-size: 1.5em">'. $errorText .'</strong>' . $e->getMessage());
            return $this->redirect([$this->action->id]);
        }
    }
}