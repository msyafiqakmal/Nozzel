
##DROP Table created using java (to get clean state)
DROP TABLE IF EXISTS `extracted_data_nozzle`;
DROP TABLE IF EXISTS `problem_encode_nozzle`;
DROP TABLE IF EXISTS `parts_encode_nozzle`;
DROP TABLE IF EXISTS `extracted_data_hose`;
DROP TABLE IF EXISTS `problem_encode_hose`;
DROP TABLE IF EXISTS `parts_encode_hose`;

DROP TABLE IF EXISTS `service_flowco_duplicate`;
CREATE TABLE `service_flowco_duplicate`
SELECT * FROM service_flowco;

ALTER TABLE `service_flowco_duplicate`
ADD `completion_date` DATE NOT NULL,
ADD `completion_time` TIME NOT NULL,
ADD `pump` int(11) NOT NULL,
ADD `gas_type` VARCHAR(255) NOT NULL;


##################### ver 2
DROP TABLE IF EXISTS `extracted_data`;

DROP TABLE IF EXISTS `pdb_station_downtime_filtered_duplicate`;
CREATE TABLE `pdb_station_downtime_filtered_duplicate`
SELECT a.*, 
(CASE a.completion_date
	WHEN '0000-00-00' THEN 0
	ELSE DATEDIFF(completion_date, creation_date)
END) AS days_to_action
FROM pdb_station_downtime_filtered AS a;

ALTER TABLE `pdb_station_downtime_filtered_duplicate`
ADD `pump` int(11) NOT NULL;

SELECT 'DONE' AS '';