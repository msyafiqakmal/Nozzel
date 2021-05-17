DROP TABLE IF EXISTS `raw_data_transaction_11`;
CREATE TABLE `raw_data_transaction_11` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`station_id` VARCHAR(255) NOT NULL,
	`transaction_number` int(11) NOT NULL,
	`dispenser_number` int(11) NOT NULL,
	`hose_number` int(11) NOT NULL,
	`quantity` FLOAT NOT NULL,
	`gas_short_name` VARCHAR(255) NOT NULL,
	`reg_unit_price` FLOAT NOT NULL,
	`unit_cost` FLOAT NOT NULL,
	`price_sold` FLOAT NOT NULL,
	`extended_price` FLOAT NOT NULL,
	`price_entry_mode` int(11) NOT NULL,
	`prepay` int(11) NOT NULL,
	`tax_group_id` int(11) NOT NULL,
	`tax1_id` int(11) NOT NULL,
	`tax1_percentage` FLOAT NOT NULL,
	`tax1_amount` FLOAT NOT NULL,
	`tax2_id` int(11) NOT NULL,
	`tax2_percentage` FLOAT NOT NULL,
	`tax2_amount` FLOAT NOT NULL,
	`original_total_price` FLOAT NOT NULL,
	`tax_code` VARCHAR(255) NOT NULL,
	`job_id` int(11) NOT NULL,
	`job_file_datetime` DATE NOT NULL,
	`job_load_datetime` DATE NOT NULL,
	PRIMARY KEY (`id`)
)
ENGINE = InnoDB 
CHARSET = utf8mb4 
COLLATE utf8mb4_unicode_ci 
COMMENT = 'Pilot stations (11) transaction data';

LOAD DATA INFILE 'C:/Users/war09/Desktop/GTD_Petronas/import/pos_fuel_trans_11_pilot_stations.csv'
INTO TABLE `raw_data_transaction_11`
FIELDS TERMINATED BY ',' ENCLOSED BY '"'
LINES TERMINATED BY '\r\n'
IGNORE 1 ROWS
(station_id,transaction_number,dispenser_number,hose_number,quantity,
	gas_short_name,reg_unit_price,unit_cost,price_sold,extended_price,
	price_entry_mode,prepay,tax_group_id,tax1_id,tax1_percentage,
	tax1_amount,tax2_id,tax2_percentage,tax2_amount,original_total_price,
	tax_code,job_id,job_file_datetime,job_load_datetime);

CALL Delete_Index('initial_transaction_extraction','raw_data_transaction_11');
CREATE INDEX initial_transaction_extraction
ON raw_data_transaction_11(station_id, dispenser_number, hose_number, gas_short_name);

DROP TABLE IF EXISTS `transaction_11`;
CREATE TABLE `transaction_11`
SELECT a.id, a.station_id, a.dispenser_number AS pump,
(CASE
	WHEN a.gas_short_name = '' THEN b.gas_short_name
	ELSE a.gas_short_name
END) AS gas_type,
a.quantity, a.job_load_datetime AS job_load_date
FROM `raw_data_transaction_11` a 
INNER JOIN `raw_data_station_profile_11` b
ON (a.station_id = b.station_id 
AND a.dispenser_number = b.dispenser_number 
AND a.hose_number = b.hose_number)
ORDER BY a.id;

CALL Delete_Index('update_on_index','transaction_11');
CREATE INDEX update_on_index
ON transaction_11(id);

CALL Delete_Index('query_sum_transaction','transaction_11');
CREATE INDEX query_sum_transaction 
ON transaction_11(station_id, pump, gas_type, quantity, job_load_date);

DROP TABLE IF EXISTS `transaction_sum_day_11`;
CREATE TABLE `transaction_sum_day_11`
SELECT station_id, pump, gas_type, job_load_date, SUM(quantity)
FROM transaction_11
GROUP BY station_id, pump, gas_type, job_load_date

