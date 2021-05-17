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
class ReportController extends Controller
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
                        'actions' => ['index'],
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
        $type='';
        $message='';

        if (isset($_POST["upload"])) {

            $fileName = $_FILES["file"]["tmp_name"];

            if ($_FILES["file"]["size"] > 0) {

                $file = fopen($fileName, "r");

                while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {

                    // INSERT (table name, column values)
                    $result=Yii::$app->db->createCommand()->insert('uploaded_data', [
                                'id'=>'',
                                'case_id'=>$column[0],
                                'station_id'=>$column[1],
                                'business_partner_name'=>$column[2],
                                'pump'=>$column[3],
                                'gas_type'=>$column[4],
                                'start_date'=>$column[5],
                                'lifetime'=>$column[6],
                                'transaction_days'=>$column[7],
                                'transaction_count'=>$column[8],
                                'total_volume'=>$column[9],
                                'HP_Nzzl_Dropped_Off'=>$column[10],
                                'HP_Nzzl_Faulty'=>$column[11],
                                'HP_Nzzl_Leaking'=>$column[12],
                                'HP_Nzzl_No_Auto_Stop'=>$column[13],
                                'HP_Nzzl_Pulled_Off'=>$column[14],
                                'HP_Nzzl_Splash_Guard'=>$column[15],
                                'HP_VisiGauge_Leaking'=>$column[16],
                                'I1_1012'=>$column[17],
                                'I1_1026'=>$column[18],
                                'I1_105'=>$column[19],
                                'I1_109'=>$column[20],
                                'I1_1123'=>$column[21],
                                'I1_113'=>$column[22],
                                'I1_1141'=>$column[23],
                                'I1_1142'=>$column[24],
                                'I1_1143'=>$column[25],
                                'I1_1183'=>$column[26],
                                'I1_136'=>$column[27],
                                'I1_1469'=>$column[28],
                                'I1_1475'=>$column[29],
                                'I1_1487'=>$column[30],
                                'I1_1516'=>$column[31],
                                'I1_153'=>$column[32],
                                'I1_1628'=>$column[33],
                                'I1_1653'=>$column[34],
                                'I1_169'=>$column[35],
                                'I1_1702'=>$column[36],
                                'I1_171'=>$column[37],
                                'I1_1737'=>$column[38],
                                'I1_1739'=>$column[39],
                                'I1_1740'=>$column[40],
                                'I1_175'=>$column[41],
                                'I1_176'=>$column[42],
                                'I1_1785'=>$column[43],
                                'I1_1819'=>$column[44],
                                'I1_1820'=>$column[45],
                                'I1_1874'=>$column[46],
                                'I1_1900'=>$column[47],
                                'I1_1902'=>$column[48],
                                'I1_1937'=>$column[49],
                                'I1_1938'=>$column[50],
                                'I1_1960'=>$column[51],
                                'I1_1961'=>$column[52],
                                'I1_1962'=>$column[53],
                                'I1_1967'=>$column[54],
                                'I1_2058'=>$column[55],
                                'I1_2060'=>$column[56],
                                'I1_2061'=>$column[57],
                                'I1_208'=>$column[58],
                                'I1_2131'=>$column[59],
                                'I1_2132'=>$column[60],
                                'I1_2133'=>$column[61],
                                'I1_2158'=>$column[62],
                                'I1_2281'=>$column[63],
                                'I1_2329'=>$column[64],
                                'I1_245'=>$column[65],
                                'I1_25'=>$column[66],
                                'I1_250'=>$column[67],
                                'I1_2516'=>$column[68],
                                'I1_2517'=>$column[69],
                                'I1_2518'=>$column[70],
                                'I1_2519'=>$column[71],
                                'I1_2520'=>$column[72],
                                'I1_2521'=>$column[73],
                                'I1_256'=>$column[74],
                                'I1_2566'=>$column[75],
                                'I1_2567'=>$column[76],
                                'I1_2569'=>$column[77],
                                'I1_2571'=>$column[78],
                                'I1_2591'=>$column[79],
                                'I1_2617'=>$column[80],
                                'I1_2629'=>$column[81],
                                'I1_2631'=>$column[82],
                                'I1_2713'=>$column[83],
                                'I1_2749'=>$column[84],
                                'I1_2758'=>$column[85],
                                'I1_2769'=>$column[86],
                                'I1_279'=>$column[87],
                                'I1_2796'=>$column[88],
                                'I1_2800'=>$column[89],
                                'I1_2871'=>$column[90],
                                'I1_3053'=>$column[91],
                                'I1_3054'=>$column[92],
                                'I1_364'=>$column[93],
                                'I1_369'=>$column[94],
                                'I1_415'=>$column[95],
                                'I1_425'=>$column[96],
                                'I1_436'=>$column[97],
                                'I1_449'=>$column[98],
                                'I1_456'=>$column[99],
                                'I1_471'=>$column[100],
                                'I1_473'=>$column[101],
                                'I1_475'=>$column[102],
                                'I1_478'=>$column[103],
                                'I1_486'=>$column[104],
                                'I1_491'=>$column[105],
                                'I1_495'=>$column[106],
                                'I1_513'=>$column[107],
                                'I1_517'=>$column[108],
                                'I1_552'=>$column[109],
                                'I1_556'=>$column[110],
                                'I1_557'=>$column[111],
                                'I1_559'=>$column[112],
                                'I1_569'=>$column[113],
                                'I1_570'=>$column[114],
                                'I1_599'=>$column[115],
                                'I1_60'=>$column[116],
                                'I1_607'=>$column[117],
                                'I1_624'=>$column[118],
                                'I1_627'=>$column[119],
                                'I1_628'=>$column[120],
                                'I1_629'=>$column[121],
                                'I1_645'=>$column[122],
                                'I1_646'=>$column[123],
                                'I1_647'=>$column[124],
                                'I1_650'=>$column[125],
                                'I1_651'=>$column[126],
                                'I1_656'=>$column[127],
                                'I1_660'=>$column[128],
                                'I1_668'=>$column[129],
                                'I1_670'=>$column[130],
                                'I1_671'=>$column[131],
                                'I1_673'=>$column[132],
                                'I1_675'=>$column[133],
                                'I1_676'=>$column[134],
                                'I1_677'=>$column[135],
                                'I1_678'=>$column[136],
                                'I1_679'=>$column[137],
                                'I1_767'=>$column[138],
                                'I1_82'=>$column[139],
                                'I1_918'=>$column[140],

                    ])->execute();

                    if (! empty($result)) {
                        $type = "success";
                        $message = "CSV Data Imported into the Database";
                    } else {
                        $type = "error";
                        $message = "Problem in Importing CSV Data";
                    }
                }
            }
        }

        if (isset($_POST["migrate"])) {

            $model_uploads = (new \yii\db\Query())
                ->select('u.*')
                ->from('uploaded_data as u')
                ->all();

            foreach ($model_uploads as $key => $value) {

                //extracted_data_nozzle
                //id, case_id, station_id, business_partner_name, pump, gas_type, creation_date, completion_date, days_to_action, lifetime,
                // transaction_days, transaction_count, adjusted_transaction_count, total_volume, adjusted_total_volume

                $result_1=Yii::$app->db->createCommand()->insert('extracted_data_nozzle', [
                    'id'=>'0',
                    'case_id'=>$value['case_id'],
                    'station_id'=>$value['station_id'],
                    'business_partner_name'=>$value['business_partner_name'],
                    'pump'=>$value['pump'],
                    'gas_type'=>$value['gas_type'],
                    'creation_date'=>$value['start_date'],
                    'completion_date'=>$value['start_date'],
                    'days_to_action'=>0,
                    'lifetime'=>$value['lifetime'],
                    'transaction_days'=>$value['transaction_days'],
                    'transaction_count'=>$value['transaction_count'],
                    'adjusted_transaction_count'=>$value['transaction_count'],
                    'total_volume'=>$value['total_volume'],
                    'adjusted_total_volume'=>$value['total_volume'],
                ])->execute();

                $inserted_id= Yii::$app->db->getLastInsertID();

                //problem_encode_nozzle
                //id, HP_Nzzl_Dropped_Off, HP_Nzzl_Faulty, HP_Nzzl_Leaking, HP_Nzzl_No_Auto_Stop, HP_Nzzl_Pulled_Off, HP_Nzzl_Splash_Guard, HP_VisiGauge_Leaking

                $result_2=Yii::$app->db->createCommand()->insert('problem_encode_nozzle', [
                         'id'=>$inserted_id,
                         'HP_Nzzl_Dropped_Off'=>$value['HP_Nzzl_Dropped_Off'],
                         'HP_Nzzl_Faulty'=>$value['HP_Nzzl_Faulty'],
                         'HP_Nzzl_Leaking'=>$value['HP_Nzzl_Leaking'],
                         'HP_Nzzl_No_Auto_Stop'=>$value['HP_Nzzl_No_Auto_Stop'],
                         'HP_Nzzl_Pulled_Off'=>$value['HP_Nzzl_Pulled_Off'],
                         'HP_Nzzl_Splash_Guard'=>$value['HP_Nzzl_Splash_Guard'],
                         'HP_VisiGauge_Leaking'=>$value['HP_VisiGauge_Leaking'],
                ])->execute();

                //parts_encode_nozzle
                //id, I1_1012, I1_1026, I1_105, I1_109, I1_1123, I1_113, I1_1141, I1_1142, I1_1143, I1_1183, I1_136, I1_1469,
                // I1_1475, I1_1487, I1_1516, I1_153, I1_1628, I1_1653, I1_169, I1_1702, I1_171, I1_1737, I1_1739, I1_1740,
                // I1_175, I1_176, I1_1785, I1_1819, I1_1820, I1_1874, I1_1900, I1_1902, I1_1937, I1_1938, I1_1960, I1_1961,
                // I1_1962, I1_1967, I1_2058, I1_2060, I1_2061, I1_208, I1_2131, I1_2132, I1_2133, I1_2158, I1_2281, I1_2329,
                // I1_245, I1_25, I1_250, I1_2516, I1_2517, I1_2518, I1_2519, I1_2520, I1_2521, I1_256, I1_2566, I1_2567, I1_2569,
                // I1_2571, I1_2591, I1_2617, I1_2629, I1_2631, I1_2713, I1_2749, I1_2758, I1_2769, I1_279, I1_2796, I1_2800, I1_2871,
                // I1_3053, I1_3054, I1_364, I1_369, I1_415, I1_425, I1_436, I1_449, I1_456, I1_471, I1_473, I1_475, I1_478, I1_486, I1_491,
                // I1_495, I1_513, I1_517, I1_552, I1_556, I1_557, I1_559, I1_569, I1_570, I1_599, I1_60, I1_607, I1_624, I1_627, I1_628, I1_629,
                // I1_645, I1_646, I1_647, I1_650, I1_651, I1_656, I1_660, I1_668,
                // I1_670, I1_671, I1_673, I1_675, I1_676, I1_677, I1_678, I1_679, I1_767, I1_82, I1_918

                $result_3=Yii::$app->db->createCommand()->insert('parts_encode_nozzle', [
                    'id'=>$inserted_id,
                    'I1_1012'=>$value['I1_1012'],
                    'I1_1026'=>$value['I1_1026'],
                    'I1_105'=>$value['I1_105'],
                    'I1_109'=>$value['I1_109'],
                    'I1_1123'=>$value['I1_1123'],
                    'I1_113'=>$value['I1_113'],
                    'I1_1141'=>$value['I1_1141'],
                    'I1_1142'=>$value['I1_1142'],
                    'I1_1143'=>$value['I1_1143'],
                    'I1_1183'=>$value['I1_1183'],
                    'I1_136'=>$value['I1_136'],
                    'I1_1469'=>$value['I1_1469'],
                    'I1_1475'=>$value['I1_1475'],
                    'I1_1487'=>$value['I1_1487'],
                    'I1_1516'=>$value['I1_1516'],
                    'I1_153'=>$value['I1_153'],
                    'I1_1628'=>$value['I1_1628'],
                    'I1_1653'=>$value['I1_1653'],
                    'I1_169'=>$value['I1_169'],
                    'I1_1702'=>$value['I1_1702'],
                    'I1_171'=>$value['I1_171'],
                    'I1_1737'=>$value['I1_1737'],
                    'I1_1739'=>$value['I1_1739'],
                    'I1_1740'=>$value['I1_1740'],
                    'I1_175'=>$value['I1_175'],
                    'I1_176'=>$value['I1_176'],
                    'I1_1785'=>$value['I1_1785'],
                    'I1_1819'=>$value['I1_1819'],
                    'I1_1820'=>$value['I1_1820'],
                    'I1_1874'=>$value['I1_1874'],
                    'I1_1900'=>$value['I1_1900'],
                    'I1_1902'=>$value['I1_1902'],
                    'I1_1937'=>$value['I1_1937'],
                    'I1_1938'=>$value['I1_1938'],
                    'I1_1960'=>$value['I1_1960'],
                    'I1_1961'=>$value['I1_1961'],
                    'I1_1962'=>$value['I1_1962'],
                    'I1_1967'=>$value['I1_1967'],
                    'I1_2058'=>$value['I1_2058'],
                    'I1_2060'=>$value['I1_2060'],
                    'I1_2061'=>$value['I1_2061'],
                    'I1_208'=>$value['I1_208'],
                    'I1_2131'=>$value['I1_2131'],
                    'I1_2132'=>$value['I1_2132'],
                    'I1_2133'=>$value['I1_2133'],
                    'I1_2158'=>$value['I1_2158'],
                    'I1_2281'=>$value['I1_2281'],
                    'I1_2329'=>$value['I1_2329'],
                    'I1_245'=>$value['I1_245'],
                    'I1_25'=>$value['I1_25'],
                    'I1_250'=>$value['I1_250'],
                    'I1_2516'=>$value['I1_2516'],
                    'I1_2517'=>$value['I1_2517'],
                    'I1_2518'=>$value['I1_2518'],
                    'I1_2519'=>$value['I1_2519'],
                    'I1_2520'=>$value['I1_2520'],
                    'I1_2521'=>$value['I1_2521'],
                    'I1_256'=>$value['I1_256'],
                    'I1_2566'=>$value['I1_2566'],
                    'I1_2567'=>$value['I1_2567'],
                    'I1_2569'=>$value['I1_2569'],
                    'I1_2571'=>$value['I1_2571'],
                    'I1_2591'=>$value['I1_2591'],
                    'I1_2617'=>$value['I1_2617'],
                    'I1_2629'=>$value['I1_2629'],
                    'I1_2631'=>$value['I1_2631'],
                    'I1_2713'=>$value['I1_2713'],
                    'I1_2749'=>$value['I1_2749'],
                    'I1_2758'=>$value['I1_2758'],
                    'I1_2769'=>$value['I1_2769'],
                    'I1_279'=>$value['I1_279'],
                    'I1_2796'=>$value['I1_2796'],
                    'I1_2800'=>$value['I1_2800'],
                    'I1_2871'=>$value['I1_2871'],
                    'I1_3053'=>$value['I1_3053'],
                    'I1_3054'=>$value['I1_3054'],
                    'I1_364'=>$value['I1_364'],
                    'I1_369'=>$value['I1_369'],
                    'I1_415'=>$value['I1_415'],
                    'I1_425'=>$value['I1_425'],
                    'I1_436'=>$value['I1_436'],
                    'I1_449'=>$value['I1_449'],
                    'I1_456'=>$value['I1_456'],
                    'I1_471'=>$value['I1_471'],
                    'I1_473'=>$value['I1_473'],
                    'I1_475'=>$value['I1_475'],
                    'I1_478'=>$value['I1_478'],
                    'I1_486'=>$value['I1_486'],
                    'I1_491'=>$value['I1_491'],
                    'I1_495'=>$value['I1_495'],
                    'I1_513'=>$value['I1_513'],
                    'I1_517'=>$value['I1_517'],
                    'I1_552'=>$value['I1_552'],
                    'I1_556'=>$value['I1_556'],
                    'I1_557'=>$value['I1_557'],
                    'I1_559'=>$value['I1_559'],
                    'I1_569'=>$value['I1_569'],
                    'I1_570'=>$value['I1_570'],
                    'I1_599'=>$value['I1_599'],
                    'I1_60'=>$value['I1_60'],
                    'I1_607'=>$value['I1_607'],
                    'I1_624'=>$value['I1_624'],
                    'I1_627'=>$value['I1_627'],
                    'I1_628'=>$value['I1_628'],
                    'I1_629'=>$value['I1_629'],
                    'I1_645'=>$value['I1_645'],
                    'I1_646'=>$value['I1_646'],
                    'I1_647'=>$value['I1_647'],
                    'I1_650'=>$value['I1_650'],
                    'I1_651'=>$value['I1_651'],
                    'I1_656'=>$value['I1_656'],
                    'I1_660'=>$value['I1_660'],
                    'I1_668'=>$value['I1_668'],
                    'I1_670'=>$value['I1_670'],
                    'I1_671'=>$value['I1_671'],
                    'I1_673'=>$value['I1_673'],
                    'I1_675'=>$value['I1_675'],
                    'I1_676'=>$value['I1_676'],
                    'I1_677'=>$value['I1_677'],
                    'I1_678'=>$value['I1_678'],
                    'I1_679'=>$value['I1_679'],
                    'I1_767'=>$value['I1_767'],
                    'I1_82'=>$value['I1_82'],
                    'I1_918'=>$value['I1_918'],
                ])->execute();


            }

            if (! empty($result_3)) {
                $type = "success";
                $message = "Uploaded data has been migrated";
                Yii::$app->db->createCommand()->truncateTable('uploaded_data')->execute();

            } else {
                $type = "error";
                $message = "Problem in migrating new uploaded data";
            }
        }

        if (isset($_POST["clean"])) {
            Yii::$app->db->createCommand()->truncateTable('uploaded_data')->execute();
            $type = "success";
            $message = "Uploaded data has been cleaned";
        }

        //COLLECT DATA
        $model_total_uploads = (new \yii\db\Query())
            ->select('count(*) as total_uploads')
            ->from('uploaded_data as u')
            ->one();


        return $this->render('index', array(
            'type'=>$type,
            'message'=>$message,
            'total_uploads'=>$model_total_uploads['total_uploads'],

        ));



    }


}
