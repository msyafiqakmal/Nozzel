<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * Services controller
 */
class CorporateController extends Controller
{
    public function beforeAction($action)
    {
        $this->layout = '@frontend/views/layouts/_base.php';
        return parent::beforeAction($action);
    }

    public function actionIndex(){
        return $this->render('index');
    }

    public function actionArticles(){
        return $this->render('articles');
    }

    public function actionEvents(){
        return $this->render('events');
    }

}
