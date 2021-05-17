<?php
namespace backend\controllers;

use Yii;
use yii\helpers\Url;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\models\ExtractedDataNozzle;
use yii\web\Response;

/**
 * Site controller
 */
class ApiController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index','failuretotal', 'stationsummary', 'predictionreport', 'predictionreportbystation'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function beforeAction($action) {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {
        echo 'Salom';
    }


    public function actionFailuretotal()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        //id, case_id, station_id, business_partner_name, pump, gas_type, creation_date, completion_date, days_to_action, lifetime,
        // transaction_days, transaction_count, adjusted_transaction_count, total_volume, adjusted_total_volume

        $model = (new \yii\db\Query())
            ->select('station_id, COUNT(*) as num_failure')
            ->from('extracted_data_nozzle')
            //->where(['gas_type' => '95'])
            ->where(['>', 'lifetime', 0])
            ->groupBy(['station_id'])
            ->all();

        $my_data=[];
        foreach ($model as $key => $value) {
            $my_data['station_id'][$key] =$value['station_id'];
            $my_data['num_failure'][$key] =$value['num_failure'];
        }

        //$data=array_map(create_function('$m','return $m->getAttributes(array(\'pump\',\'lifetime\'));'),$my_data);

        echo json_encode($my_data);
    }

    public function actionStationsummary()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $station_id=$_POST['station_id'];
        $gas_type=$_POST['gas_type'];
//        SELECT e.pump, e.lifetime, p.lifetime_predicted
//        FROM extracted_data_nozzle e
//        left join data_nozzle_predicted as p on p.related_id=e.id
//        where e.lifetime>0 and station_id='RYB0715'
//        order by e.pump

        $model = (new \yii\db\Query())
            ->select('e.pump, e.lifetime, p.lifetime_predicted')
            ->from('extracted_data_nozzle as e')
            ->leftJoin('data_nozzle_predicted as p', 'p.related_id=e.id')
            ->where(['>', 'lifetime', 0])
            ->andWhere(['=', 'e.station_id', $station_id])
            ->andWhere(['=', 'e.gas_type', $gas_type])
            ->groupBy(['e.pump'])
            ->all();

        $my_data=[];
        foreach ($model as $key => $value) {
            $my_data['pump'][$key] =$value['pump'];
            $my_data['lifetime'][$key] =$value['lifetime'];
            $my_data['lifetime_predicted'][$key] =$value['lifetime_predicted'];
        }

        //$data=array_map(create_function('$m','return $m->getAttributes(array(\'pump\',\'lifetime\'));'),$my_data);

        echo json_encode($my_data);
    }


// To generate prediction report on predictions/index.php
    public function actionPredictionreport()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        //id, case_id, station_id, business_partner_name, pump, gas_type, creation_date, completion_date, days_to_action, lifetime,
        // transaction_days, transaction_count, adjusted_transaction_count, total_volume, adjusted_total_volume

        $model = (new \yii\db\Query())
            ->select('a.id, a.business_partner_name, a.pump, a.gas_type, b.lifetime_predicted, a.completion_date')
            ->from('extracted_data_nozzle as a')
            ->leftJoin('data_nozzle_predicted as b', 'b.related_id=a.id')
            //->where(['gas_type' => '95'])
            ->where(['>', 'lifetime', 0])
            // ->groupBy(['a.business_partner_name'])
            ->all();

        // $object=NULL;
        $my_data=[];
        foreach ($model as $key => $value) {

            $my_data['data'][$key]['id']=$value['id'];
            $my_data['data'][$key]['business_partner_name']=$value['business_partner_name'];
            $my_data['data'][$key]['pump']=$value['pump'];
            $my_data['data'][$key]['gas_type']=$value['gas_type'];
            $my_data['data'][$key]['lifetime_predicted']=$value['lifetime_predicted'];
            $my_data['data'][$key]['completion_date']=$value['completion_date'];
        }



        //$data=array_map(create_function('$m','return $m->getAttributes(array(\'pump\',\'lifetime\'));'),$my_data);

        echo json_encode($my_data);
        // echo json_encode($my_data);
    }

    // To generate prediction report on predictions/index.php
    public function actionPredictionreportbystation()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $station_id=$_POST['station_id'];
        $gas_type=$_POST['gas_type'];

            $model = (new \yii\db\Query())
            ->select('a.id, a.business_partner_name, a.pump, a.gas_type, b.lifetime_predicted, a.station_id, a.gas_type, a.completion_date')
            ->from('extracted_data_nozzle as a')
            ->leftJoin('data_nozzle_predicted as b', 'b.related_id=a.id')
            //->where(['gas_type' => '95'])
            ->where(['>', 'lifetime', 0])
            ->andWhere(['=', 'a.station_id', $station_id])
            ->andWhere(['=', 'a.gas_type', $gas_type])
            // ->groupBy(['a.business_partner_name'])
            ->all();

        // $gas_type="95";
        // $station_id="RYB0715";
        //id, case_id, station_id, business_partner_name, pump, gas_type, creation_date, completion_date, days_to_action, lifetime,
        // transaction_days, transaction_count, adjusted_transaction_count, total_volume, adjusted_total_volume

        // $object=NULL;
        $my_data=[];
        foreach ($model as $key => $value) {

            $my_data['data'][$key]['id']=$value['id'];
            $my_data['data'][$key]['business_partner_name']=$value['business_partner_name'];
            $my_data['data'][$key]['pump']=$value['pump'];
            $my_data['data'][$key]['gas_type']=$value['gas_type'];
            $my_data['data'][$key]['lifetime_predicted']=$value['lifetime_predicted'];
            $my_data['data'][$key]['completion_date']=$value['completion_date'];
        }



        //$data=array_map(create_function('$m','return $m->getAttributes(array(\'pump\',\'lifetime\'));'),$my_data);

        echo json_encode($my_data);
        // echo json_encode($my_data);
    }




}
