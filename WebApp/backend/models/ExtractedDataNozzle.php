<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "extracted_data_nozzle".
 *
 * @property integer $id
 * @property string $case_id
 * @property string $station_id
 * @property string $business_partner_name
 * @property integer $pump
 * @property string $gas_type
 * @property string $creation_date
 * @property string $completion_date
 * @property integer $days_to_action
 * @property integer $lifetime
 * @property integer $transaction_days
 * @property integer $transaction_count
 * @property integer $adjusted_transaction_count
 * @property double $total_volume
 * @property double $adjusted_total_volume
 */
class ExtractedDataNozzle extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'extracted_data_nozzle';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['case_id', 'station_id', 'business_partner_name', 'pump', 'gas_type', 'creation_date', 'completion_date', 'days_to_action', 'lifetime', 'transaction_days', 'transaction_count', 'adjusted_transaction_count', 'total_volume', 'adjusted_total_volume'], 'required'],
            [['pump', 'days_to_action', 'lifetime', 'transaction_days', 'transaction_count', 'adjusted_transaction_count'], 'integer'],
            [['creation_date', 'completion_date'], 'safe'],
            [['total_volume', 'adjusted_total_volume'], 'number'],
            [['case_id', 'station_id', 'business_partner_name', 'gas_type'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'case_id' => 'Case ID',
            'station_id' => 'Station ID',
            'business_partner_name' => 'Business Partner Name',
            'pump' => 'Pump',
            'gas_type' => 'Gas Type',
            'creation_date' => 'Creation Date',
            'completion_date' => 'Completion Date',
            'days_to_action' => 'Days To Action',
            'lifetime' => 'Lifetime',
            'transaction_days' => 'Transaction Days',
            'transaction_count' => 'Transaction Count',
            'adjusted_transaction_count' => 'Adjusted Transaction Count',
            'total_volume' => 'Total Volume',
            'adjusted_total_volume' => 'Adjusted Total Volume',
        ];
    }
}
