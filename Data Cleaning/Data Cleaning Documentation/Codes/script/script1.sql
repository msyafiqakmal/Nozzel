SELECT 'Starting script' AS '';

SELECT 'Creating tables...' AS '';
########################################### CREATE TABLE SECTION

DROP TABLE IF EXISTS `raw_data_service_flowco`;
CREATE TABLE `raw_data_service_flowco` (
	`business_partner_name` VARCHAR(255) NOT NULL,
	`problem_description` TEXT NOT NULL,
	`creation_date` DATE NOT NULL,
	`creation_time` TIME NOT NULL,
	`region_state` VARCHAR(255) NOT NULL,
	`cust_ref_no` VARCHAR(255) NOT NULL,
	`problem_type` VARCHAR(255) NOT NULL,
	`root_cause` VARCHAR(255) NOT NULL,
	`resolution` TEXT NOT NULL,
	`parts_replaced` VARCHAR(255) NOT NULL,
	`parts` VARCHAR(255) NOT NULL,
	`quantity` FLOAT(11,4) NOT NULL,
	`part_serial_no` VARCHAR(255) NOT NULL,
	`faulty_parts_no` VARCHAR(255) NOT NULL,
	`replacement_parts_no` VARCHAR(255) NOT NULL,
	`parts_name` VARCHAR(255) NOT NULL
) 
ENGINE = InnoDB 
CHARSET = utf8mb4 
COLLATE utf8mb4_unicode_ci 
COMMENT = 'Initial raw data for service data by flowco 2017 & 2018';

DROP TABLE IF EXISTS `raw_data_problem_type`;
CREATE TABLE `raw_data_problem_type` (
	`problem_type` VARCHAR(255) NOT NULL,
	`problem_category` VARCHAR(255) NOT NULL
)
ENGINE = InnoDB 
CHARSET = utf8mb4 
COLLATE utf8mb4_unicode_ci 
COMMENT = 'Initial raw data for problem type and its category';

DROP TABLE IF EXISTS `raw_data_parts_detail`;
CREATE TABLE `raw_data_parts_detail` (
	`parts_id` VARCHAR(255) NOT NULL,
	`parts_name` VARCHAR(255) NOT NULL
)
ENGINE = InnoDB 
CHARSET = utf8mb4 
COLLATE utf8mb4_unicode_ci 
COMMENT = 'Initial raw data for replacement parts detail';

DROP TABLE IF EXISTS `raw_data_station_profile_flowco`;
CREATE TABLE `raw_data_station_profile_flowco` (
	`station_id` VARCHAR(255) NOT NULL,
	`business_partner_name` VARCHAR(255) NOT NULL
)
ENGINE = InnoDB 
CHARSET = utf8mb4 
COLLATE utf8mb4_unicode_ci 
COMMENT = 'Station Profile for Flowco';

DROP TABLE IF EXISTS `raw_data_station_profile_11`;
CREATE TABLE `raw_data_station_profile_11` (
	`station_id` VARCHAR(255) NOT NULL,
	`business_partner_name` VARCHAR(255) NOT NULL,
	`dispenser_number` int(11) NOT NULL,
	`hose_number` int(11) NOT NULL,
	`gas_short_name` VARCHAR(255) NOT NULL,
	`total_volume` FLOAT(11,4) NOT NULL
)
ENGINE = InnoDB 
CHARSET = utf8mb4 
COLLATE utf8mb4_unicode_ci 
COMMENT = 'Station Profile for 11 pilot stations';

DROP TABLE IF EXISTS `raw_data_pdb_station_downtime`;
CREATE TABLE `raw_data_pdb_station_downtime` (
	`case_id` VARCHAR(255) NOT NULL,
	`created_on` DATE NOT NULL,
	`year` int(11) NOT NULL,
	`category_2` VARCHAR(255) NOT NULL,
	`category_3` VARCHAR(255) NOT NULL,
	`category_4` VARCHAR(255) NOT NULL,
	`category_5` VARCHAR(255) NOT NULL,
	`category_6` VARCHAR(255) NOT NULL,
	`regarding` VARCHAR(255) NOT NULL,
	`region` VARCHAR(255) NOT NULL,
	`ibase_description` VARCHAR(255) NOT NULL,
	`dealer_vendor` VARCHAR(255) NOT NULL,
	`status` VARCHAR(255) NOT NULL,
	`sla_start_date` DATE NOT NULL,
	`sla_planned_end_date` DATE NOT NULL,
	`sla_actual_end_date` DATE NOT NULL
)
ENGINE = InnoDB 
CHARSET = utf8mb4 
COLLATE utf8mb4_unicode_ci 
COMMENT = 'Mesralink system station downtime report 2016-2018';

DROP TABLE IF EXISTS `raw_data_mesralink_problem_type`;
CREATE TABLE `raw_data_mesralink_problem_type` (
	`problem_category` VARCHAR(255) NOT NULL,
	`problem_type` VARCHAR(255) NOT NULL
)
ENGINE = InnoDB 
CHARSET = utf8mb4 
COLLATE utf8mb4_unicode_ci 
COMMENT = 'Mapped Mesralink problem category';

########################################### CREATE TABLE SECTION

SELECT 'Importing data...' AS '';
########################################### IMPORT DATA SECTION

SET @date_format = '%d/%m/%Y';
SET @time_format = '%H:%i:%s';
LOAD DATA INFILE 'C:/Users/war09/Desktop/GTD_Petronas/import/service_flowco_2017.csv'
INTO TABLE `raw_data_service_flowco`
FIELDS TERMINATED BY '^' ENCLOSED BY ''
LINES TERMINATED BY '\r\n'
IGNORE 1 ROWS
(business_partner_name,problem_description,@creation_date,@creation_time,region_state,cust_ref_no,problem_type,root_cause,resolution,parts_replaced,parts,quantity,part_serial_no,faulty_parts_no,replacement_parts_no,parts_name)
SET creation_date = STR_TO_DATE(@creation_date, @date_format),
creation_time = STR_TO_DATE(@creation_time,@time_format);

SET @date_format = '%d/%m/%Y';
SET @time_format = '%h:%i%p';
LOAD DATA INFILE 'C:/Users/war09/Desktop/GTD_Petronas/import/service_flowco_2018.csv'
INTO TABLE `raw_data_service_flowco`
FIELDS TERMINATED BY '^' ENCLOSED BY ''
LINES TERMINATED BY '\r\n'
IGNORE 1 ROWS
(business_partner_name,problem_description,@creation_date,@creation_time,region_state,cust_ref_no,problem_type,root_cause,resolution,parts_replaced,parts,quantity,part_serial_no,faulty_parts_no,replacement_parts_no,parts_name)
SET creation_date = STR_TO_DATE(@creation_date, @date_format),
creation_time = STR_TO_DATE(@creation_time, @time_format);

LOAD DATA INFILE 'C:/Users/war09/Desktop/GTD_Petronas/import/problem_type.csv'
INTO TABLE `raw_data_problem_type`
FIELDS TERMINATED BY ',' ENCLOSED BY '"'
LINES TERMINATED BY '\r\n'
IGNORE 1 ROWS;

LOAD DATA INFILE 'C:/Users/war09/Desktop/GTD_Petronas/import/parts_detail.csv'
INTO TABLE `raw_data_parts_detail`
FIELDS TERMINATED BY ',' ENCLOSED BY '"'
LINES TERMINATED BY '\r\n'
IGNORE 1 ROWS;

LOAD DATA INFILE 'C:/Users/war09/Desktop/GTD_Petronas/import/mapped_station_flowco.csv'
INTO TABLE `raw_data_station_profile_flowco`
FIELDS TERMINATED BY ',' ENCLOSED BY '"'
LINES TERMINATED BY '\r\n'
IGNORE 1 ROWS;

LOAD DATA INFILE 'C:/Users/war09/Desktop/GTD_Petronas/import/11_pilot_stations_profile.csv'
INTO TABLE `raw_data_station_profile_11`
FIELDS TERMINATED BY ',' ENCLOSED BY '"'
LINES TERMINATED BY '\r\n'
IGNORE 1 ROWS;

SET @date_format = '%d/%m/%Y';
LOAD DATA INFILE 'C:/Users/war09/Desktop/GTD_Petronas/import/pdb_station_downtime.csv'
INTO TABLE `raw_data_pdb_station_downtime`
FIELDS TERMINATED BY ',' ENCLOSED BY '"'
LINES TERMINATED BY '\r\n'
IGNORE 1 ROWS
(case_id,@created_on,year,category_2,category_3,category_4,category_5,category_6,regarding,region,ibase_description,dealer_vendor,status,@sla_start_date,@sla_planned_end_date,@sla_actual_end_date)
SET created_on = STR_TO_DATE(@created_on, @date_format),
sla_start_date = STR_TO_DATE(@sla_start_date, @date_format),
sla_planned_end_date = STR_TO_DATE(@sla_planned_end_date, @date_format),
sla_actual_end_date = STR_TO_DATE(@sla_actual_end_date, @date_format);

LOAD DATA INFILE 'C:/Users/war09/Desktop/GTD_Petronas/import/mapped_problem_mesralink.csv'
INTO TABLE `raw_data_mesralink_problem_type`
FIELDS TERMINATED BY ',' ENCLOSED BY '"'
LINES TERMINATED BY '\r\n'
IGNORE 1 ROWS;

########################################### IMPORT DATA SECTION

SELECT 'Creating procedures...' AS '';
########################################### PROCEDURE SECTION
DELIMITER $$

DROP PROCEDURE IF EXISTS `Add_Id_Column`$$
CREATE PROCEDURE `Add_Id_Column`(IN table_name VARCHAR(255))
BEGIN
	DECLARE _stmt1 VARCHAR(255);
	DECLARE _stmt2 VARCHAR(255);
	DECLARE _stmt3 VARCHAR(255);
	SET @SQL1 := CONCAT('ALTER TABLE ', table_name,' ADD id INT NOT NULL AUTO_INCREMENT PRIMARY KEY FIRST;');
	SET @SQL2 := CONCAT('ALTER TABLE ', table_name,' CHANGE id id int(11);');
	SET @SQL3 := CONCAT('ALTER TABLE ', table_name,' DROP PRIMARY KEY;');
	PREPARE _stmt1 FROM @SQL1;
	PREPARE _stmt2 FROM @SQL2;
	PREPARE _stmt3 FROM @SQL3;
    EXECUTE _stmt1;
    EXECUTE _stmt2;
    EXECUTE _stmt3;
    DEALLOCATE PREPARE _stmt1;
    DEALLOCATE PREPARE _stmt2;
    DEALLOCATE PREPARE _stmt3;
END $$

DROP PROCEDURE IF EXISTS `Station_Service_Frequency`$$
CREATE PROCEDURE `Station_Service_Frequency`(IN problem_type VARCHAR(255))
BEGIN
	DECLARE _stmt1 VARCHAR(255);
	SET @SQL1 := CONCAT(
		'SELECT c.problem_category, c.business_partner_name, COUNT(c.business_partner_name) as service_frequency
		FROM (
		SELECT a.*, b.problem_category
		FROM service_flowco AS a
		INNER JOIN raw_data_problem_type AS b 
		ON a.problem_type = b.problem_type
		AND b.problem_category = "', problem_type,'" 
		 ) c GROUP BY business_partner_name
		ORDER BY service_frequency DESC, c.business_partner_name ASC;');
	PREPARE _stmt1 FROM @SQL1;
    EXECUTE _stmt1;
    DEALLOCATE PREPARE _stmt1;
END $$

DROP PROCEDURE IF EXISTS `Part_Changed_Frequency`$$
CREATE PROCEDURE `Part_Changed_Frequency`(IN rank_station int(11), IN problem_type VARCHAR(255))
BEGIN
	DECLARE _stmt1 VARCHAR(255);
	DECLARE _stmt2 VARCHAR(255);
	SET @SQL1 := CONCAT('SET @station = (SELECT Station_Rank_ProbCat(', rank_station, ',"', problem_type, '"));');
	SET @SQL2 := CONCAT(
		'SELECT c.business_partner_name, c.replacement_parts_no, COUNT(c.replacement_parts_no) AS changed_frequency
		FROM (
		SELECT a.*
		FROM service_flowco AS a
		INNER JOIN raw_data_problem_type AS b 
		ON a.problem_type = b.problem_type
		AND b.problem_category = "', problem_type, '"
		) c
		WHERE business_partner_name = @station
		GROUP BY c.replacement_parts_no
		ORDER BY changed_frequency DESC, c.replacement_parts_no ASC;');
	PREPARE _stmt1 FROM @SQL1;
	PREPARE _stmt2 FROM @SQL2;
    EXECUTE _stmt1;
    EXECUTE _stmt2;
    DEALLOCATE PREPARE _stmt1;
    DEALLOCATE PREPARE _stmt2;
END $$

DROP PROCEDURE IF EXISTS `Part_Rank_All_Station`$$
CREATE PROCEDURE `Part_Rank_All_Station`(IN rank_part int(11), IN problem_type VARCHAR(255))
BEGIN
	DECLARE x  INT;
	DECLARE station_count INT;
	DECLARE temp_parts_name VARCHAR(255);
	DROP TEMPORARY TABLE IF EXISTS `temp_table`;
	CREATE TEMPORARY TABLE `temp_table` (temp_parts VARCHAR(255)) ENGINE=MEMORY;
	SELECT Total_Station_ProbCat(problem_type) INTO station_count;
	SET x = 0;
	WHILE x  < station_count DO
		SET temp_parts_name = (SELECT Parts_Rank_Station(rank_part, x, problem_type));
		INSERT INTO temp_table (temp_parts) VALUES (temp_parts_name);
		SET  x = x + 1;
	END WHILE;
	SELECT temp_parts as replacement_parts_no, COUNT(temp_parts) as parts_count
	FROM temp_table
	GROUP BY replacement_parts_no
	ORDER BY parts_count DESC, replacement_parts_no ASC;
	DROP TEMPORARY TABLE `temp_table`;
END $$

DROP PROCEDURE IF EXISTS `Delete_Index`$$
CREATE PROCEDURE `Delete_Index`(IN index_name_input VARCHAR(255),IN table_name_input VARCHAR(255))
BEGIN
	DECLARE _stmt1 VARCHAR(255);
	IF((SELECT COUNT(*) AS index_exists 
		FROM information_schema.statistics 
		WHERE INDEX_SCHEMA = DATABASE() 
		AND TABLE_NAME = table_name_input 
		AND INDEX_NAME = index_name_input) > 0) 
	THEN
		SET @SQL1 = CONCAT('DROP INDEX `' , index_name_input , '` ON `' , table_name_input, '`;');
		PREPARE _stmt1 FROM @SQL1;
		EXECUTE _stmt1;
		DEALLOCATE PREPARE _stmt1;
	END IF;
END $$

DELIMITER ;
########################################### PROCEDURE SECTION

SELECT 'Creating functions...' AS '';
########################################### FUNCTION SECTION
DELIMITER $$

DROP FUNCTION IF EXISTS `Station_Rank_ProbCat`$$
CREATE FUNCTION `Station_Rank_ProbCat`(rank_station int(11), prob_cat VARCHAR(255)) RETURNS VARCHAR(255)
BEGIN
	DECLARE result VARCHAR(255);
	SELECT d.business_partner_name FROM (
		SELECT c.business_partner_name, COUNT(c.business_partner_name) AS service_frequency 
		FROM (
			SELECT a.*
			FROM service_flowco AS a
			INNER JOIN raw_data_problem_type AS b 
			ON a.problem_type = b.problem_type
			AND b.problem_category = prob_cat
		) c 
		GROUP BY c.business_partner_name 
		ORDER BY service_frequency DESC, c.business_partner_name ASC
		LIMIT rank_station, 1
	) d INTO result;
	RETURN result;
END $$

DROP FUNCTION IF EXISTS `Parts_Rank_Station`$$
CREATE FUNCTION `Parts_Rank_Station`(rank_parts int(11), rank_station int(11), prob_cat VARCHAR(255)) RETURNS VARCHAR(255)
BEGIN
	DECLARE result VARCHAR(255);
	DECLARE station VARCHAR(255);
	SET station = (SELECT Station_Rank_ProbCat(rank_station,prob_cat));
	SELECT d.replacement_parts_no FROM (
		SELECT replacement_parts_no, COUNT(replacement_parts_no) AS changed_frequency FROM (
			SELECT a.*
			FROM service_flowco AS a
			INNER JOIN raw_data_problem_type AS b 
			ON a.problem_type = b.problem_type
			AND b.problem_category = prob_cat
		) c
		WHERE business_partner_name = station
		GROUP BY replacement_parts_no
		ORDER BY changed_frequency DESC, c.replacement_parts_no ASC
		LIMIT rank_parts,1
	)d INTO result;
	RETURN result;
END $$

DROP FUNCTION IF EXISTS `Total_Part_Station`$$
CREATE FUNCTION `Total_Part_Station`(rank_station int(11), prob_cat VARCHAR(255)) RETURNS INT
BEGIN
	DECLARE result INT;
	DECLARE station VARCHAR(255);
	SET station = (SELECT Station_Rank_ProbCat(rank_station,prob_cat));
	SELECT COUNT(d.replacement_parts_no) total_parts FROM(
		SELECT c.business_partner_name, c.replacement_parts_no, COUNT(c.replacement_parts_no) AS changed_frequency
		FROM (
		SELECT a.*
		FROM service_flowco AS a
		INNER JOIN raw_data_problem_type AS b 
		ON a.problem_type = b.problem_type
		AND b.problem_category = prob_cat
	) c
	WHERE business_partner_name = station
	GROUP BY c.replacement_parts_no
	ORDER BY changed_frequency DESC, c.replacement_parts_no ASC) d INTO result;
	RETURN result;
END $$

DROP FUNCTION IF EXISTS `Total_Station_ProbCat`$$
CREATE FUNCTION `Total_Station_ProbCat`(prob_cat VARCHAR(255)) RETURNS INT
BEGIN
	DECLARE result INT;
	SELECT COUNT(DISTINCT c.business_partner_name)
	FROM(
		SELECT a.*
		FROM service_flowco AS a
		INNER JOIN raw_data_problem_type AS b 
		ON a.problem_type = b.problem_type
		AND b.problem_category = prob_cat
	)c INTO result;
	RETURN result;
END $$

DELIMITER ;
########################################### FUNCTION SECTION

SELECT 'Creating indexes...' AS '';
########################################### INDEX SECTION

CALL Delete_Index('query_completed_date','raw_data_pdb_station_downtime');
CREATE INDEX query_completed_date 
ON raw_data_pdb_station_downtime(case_id, sla_actual_end_date);

CALL Delete_Index('query_pump_gas','raw_data_pdb_station_downtime');
CREATE INDEX query_pump_gas 
ON raw_data_pdb_station_downtime(case_id, category_5, category_6);

########################################### INDEX SECTION

CALL `Add_Id_Column`('raw_data_service_flowco');
CALL `Add_Id_Column`('raw_data_problem_type');
CALL `Add_Id_Column`('raw_data_parts_detail');
CALL `Add_Id_Column`('raw_data_station_profile_flowco');
CALL `Add_Id_Column`('raw_data_station_profile_11');
CALL `Add_Id_Column`('raw_data_pdb_station_downtime');
CALL `Add_Id_Column`('raw_data_mesralink_problem_type');

DROP TABLE IF EXISTS `service_flowco`;
CREATE TABLE `service_flowco`
SELECT id AS raw_id, business_partner_name, problem_description, creation_date, creation_time, cust_ref_no AS case_id, problem_type, resolution, replacement_parts_no
FROM raw_data_service_flowco;

DROP TABLE IF EXISTS `problem_parts_map`;
CREATE TABLE `problem_parts_map`
SELECT b.problem_category, a.problem_type, a.replacement_parts_no
FROM service_flowco AS a
INNER JOIN raw_data_problem_type AS b 
ON a.problem_type = b.problem_type
WHERE NOT a.replacement_parts_no = '' 
AND NOT a.replacement_parts_no = 'N/A'
AND NOT a.replacement_parts_no = 'NIL'
GROUP BY b.problem_category, a.problem_type, a.replacement_parts_no;

DROP TABLE IF EXISTS `pdb_station_downtime_filtered`;
CREATE TABLE `pdb_station_downtime_filtered`
SELECT a.id AS raw_id, a.case_id, b.station_id, a.ibase_description AS station_name, a.created_on AS creation_date, a.sla_actual_end_date AS completion_date,
c.problem_category, a.category_4 AS problem_type, a.category_5, a.category_6 AS gas_type, a.dealer_vendor
FROM raw_data_pdb_station_downtime AS a
INNER JOIN (SELECT station_id, business_partner_name FROM `raw_data_station_profile_11` GROUP BY station_id) AS b
ON a.ibase_description = b.business_partner_name
INNER JOIN (SELECT problem_category, problem_type FROM raw_data_mesralink_problem_type) AS c
ON a.category_4 = c.problem_type
WHERE a.category_2 = 'Retail Facilities Equipment'
AND (
	a.category_3 = 'Dispenser-Hose/Nozzle Repair'
	OR a.category_3 = 'NGV - Nozzle & Hose Faulty'
	)
AND (
	a.dealer_vendor = 'Flowco Malaysia Sdn Bhd'
	OR a.dealer_vendor = 'Titan (M) Sdn Bhd'
	)
AND a.sla_actual_end_date != '0000-00-00';

SELECT 'Completed' AS '';