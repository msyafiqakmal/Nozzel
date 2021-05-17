<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;

/**
 * Site controller
 */
class DashboardController extends Controller
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
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['index', 'petrol'],
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

    public function beforeAction($action) {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $model_failures_all = (new \yii\db\Query())
            ->select('e.pump, e.lifetime')
            ->from('extracted_data_nozzle as e')
            ->all();

        $model_failures_notnull = (new \yii\db\Query())
            ->select('e.pump, e.lifetime')
            ->from('extracted_data_nozzle as e')
            ->where(['>', 'lifetime', 0])
            ->all();

        $model_transactions_sum_all = (new \yii\db\Query())
            ->select('sum(e.transaction_count) as total_transactions')
            ->from('extracted_data_nozzle as e')
            ->one();

        $model_transactions_sum_failured_pump = (new \yii\db\Query())
            ->select('sum(e.transaction_count) as total_transactions')
            ->from('extracted_data_nozzle as e')
            ->where(['>', 'lifetime', 0])
            ->one();

        $model_parts_all = (new \yii\db\Query())
            ->select('SUM(I1_1012+I1_1026+I1_105+I1_109+I1_1123+I1_113+I1_1141+I1_1142+I1_1143+I1_1183+I1_136+I1_1469+I1_1475+I1_1487+I1_1516+I1_153+I1_1628+I1_1653+I1_169+I1_1702+I1_171+I1_1737+I1_1739+I1_1740+I1_175+I1_176+I1_1785+I1_1819+I1_1820+I1_1874+I1_1900+I1_1902+I1_1937+I1_1938+I1_1960+I1_1961+I1_1962+I1_1967+I1_2058+I1_2060+I1_2061+I1_208+I1_2131+I1_2132+I1_2133+I1_2158+I1_2281+I1_2329+I1_245+I1_25+I1_250+I1_2516+I1_2517+I1_2518+I1_2519+I1_2520+I1_2521+I1_256+I1_2566+I1_2567+I1_2569+I1_2571+I1_2591+I1_2617+I1_2629+I1_2631+I1_2713+I1_2749+I1_2758+I1_2769+I1_279+I1_2796+I1_2800+I1_2871+I1_3053+I1_3054+I1_364+I1_369+I1_415+I1_425+I1_436+I1_449+I1_456+I1_471+I1_473+I1_475+I1_478+I1_486+I1_491+I1_495+I1_513+I1_517+I1_552+I1_556+I1_557+I1_559+I1_569+I1_570+I1_599+I1_60+I1_607+I1_624+I1_627+I1_628+I1_629+I1_645+I1_646+I1_647+I1_650+I1_651+I1_656+I1_660+I1_668+I1_670+I1_671+I1_673+I1_675+I1_676+I1_677+I1_678+I1_679+I1_767+I1_82+I1_918) as total_parts')
            ->from('parts_encode_nozzle as p')
            ->leftJoin('data_nozzle_predicted as d', 'd.related_id=p.id')
            ->one();

        $model_parts_notnull = (new \yii\db\Query())
            ->select('e.lifetime, SUM(I1_1012+I1_1026+I1_105+I1_109+I1_1123+I1_113+I1_1141+I1_1142+I1_1143+I1_1183+I1_136+I1_1469+I1_1475+I1_1487+I1_1516+I1_153+I1_1628+I1_1653+I1_169+I1_1702+I1_171+I1_1737+I1_1739+I1_1740+I1_175+I1_176+I1_1785+I1_1819+I1_1820+I1_1874+I1_1900+I1_1902+I1_1937+I1_1938+I1_1960+I1_1961+I1_1962+I1_1967+I1_2058+I1_2060+I1_2061+I1_208+I1_2131+I1_2132+I1_2133+I1_2158+I1_2281+I1_2329+I1_245+I1_25+I1_250+I1_2516+I1_2517+I1_2518+I1_2519+I1_2520+I1_2521+I1_256+I1_2566+I1_2567+I1_2569+I1_2571+I1_2591+I1_2617+I1_2629+I1_2631+I1_2713+I1_2749+I1_2758+I1_2769+I1_279+I1_2796+I1_2800+I1_2871+I1_3053+I1_3054+I1_364+I1_369+I1_415+I1_425+I1_436+I1_449+I1_456+I1_471+I1_473+I1_475+I1_478+I1_486+I1_491+I1_495+I1_513+I1_517+I1_552+I1_556+I1_557+I1_559+I1_569+I1_570+I1_599+I1_60+I1_607+I1_624+I1_627+I1_628+I1_629+I1_645+I1_646+I1_647+I1_650+I1_651+I1_656+I1_660+I1_668+I1_670+I1_671+I1_673+I1_675+I1_676+I1_677+I1_678+I1_679+I1_767+I1_82+I1_918) as total_parts')
            ->from('parts_encode_nozzle as p')
            ->leftJoin('extracted_data_nozzle as e', 'e.id=p.id')
            ->where(['>', 'e.lifetime', 0])
            ->one();



        return $this->render('index',array(
                'count_failures_all'=>count($model_failures_all),
                'count_failures_notnull'=>count($model_failures_notnull),
                'transactions_sum_all'=>$model_transactions_sum_all['total_transactions'],
                'transactions_sum_failured_pump'=>$model_transactions_sum_failured_pump['total_transactions'],
                'total_parts_all'=>$model_parts_all['total_parts'],
                'total_parts_notnull'=>$model_parts_notnull['total_parts'],

                ));
    }

    public function actionPetrol()
    {
        $request = Yii::$app->request;

//        SELECT e.business_partner_name, e.pump, COUNT(*) as pump_failure_reports
//        FROM extracted_data_nozzle e
//        where station_id='RYB0715'
//        GROUP by e.pump

        $model_station = (new \yii\db\Query())
            ->select('e.business_partner_name, e.pump, COUNT(*) as pump_failure_reports, e.lifetime')
            ->from('extracted_data_nozzle as e')
            ->where(['=', 'e.station_id', $_POST['station_id']])
            ->groupBy(['e.pump'])
            ->all();

//        SELECT e.gas_type, COUNT(*) as num_gastype_failure
//        FROM extracted_data_nozzle e
//        where e.station_id='RYB0715' and e.lifetime>0
//        GROUP by e.gas_type

        $model_gas = (new \yii\db\Query())
            ->select('e.gas_type, COUNT(*) as num_gastype_failure')
            ->from('extracted_data_nozzle as e')
            ->where(['>', 'lifetime', 0])
            ->andWhere(['=', 'e.station_id', $_POST['station_id']])
            ->groupBy(['e.gas_type'])
            ->all();


        if (Yii::$app->request->isPost){
            return $this->renderPartial('petrol',array(
                'station_data'=>$model_station,
                'dataset'=>$_POST['dataset'],
                'station_id'=>$_POST['station_id'],
                'total_failure'=>$_POST['total_failure'],
                'gastype_data'=>$model_gas

            ), false,true);
        }

    }


}
