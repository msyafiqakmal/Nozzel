package dao;

import java.sql.Connection;
import java.sql.Date;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.text.DateFormat;
import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Calendar;
import java.util.List;

import com.mysql.cj.xdevapi.Result;

public class DataExtractDao {
	Connection connection = null;
	public DataExtractDao(String url, String userName, String password){
		try {
			connection = setConnection( url,  userName,  password);
		} catch (Exception e) {
			e.printStackTrace();
		}
	}
	
	public Connection getConnection() {
		return connection;
	}
	
	public Connection setConnection(String url, String userName, String password) throws Exception {
		try{
			System.out.println("***** Attempt MySQL JDBC Connection *****");
			Class.forName ("com.mysql.cj.jdbc.Driver").newInstance ();
	        url += "?useUnicode=true&useJDBCCompliantTimezoneShift=true&useLegacyDatetimeCode=false&serverTimezone=Asia/Kuala_Lumpur&zeroDateTimeBehavior=CONVERT_TO_NULL";        
	        connection = DriverManager.getConnection (url, userName, password);
	        System.out.println("Database connection successfull");
	    }catch (SQLException e){
	    	e.printStackTrace();
	    	System.err.println ("Cannot connect to database server");
	    	System.err.println("Error setConnection()");
	    } 
		return connection;
	}
	
	public void closeConnection(ResultSet resultSet, Statement statement, Connection connection) {
    	if (resultSet != null) {
            try {
                resultSet.close();
            } catch (SQLException sqlEx) { } // ignore

            resultSet = null;
        }
        if (statement != null) {
            try {
                statement.close();
            } catch (SQLException sqlEx) { } // ignore

            statement = null;
        }
    	if (connection != null){
    		try{
    			System.out.println("***** Let terminate the Connection *****");
    			connection.close ();					   
    			System.out.println ("Database connection terminated...");
            }catch (Exception ex){
				   System.out.println ("Error in connection termination!");
            }
    	}
	    
	}
	
	public ResultSet getResDateByPartsStationProbCat(int rankParts, int rankStations, String problemCategory) throws Exception {
		Statement statement = null;
		ResultSet resultSet = null;
		String resultStation = null;
		String resultParts = null;
		
		try {
			statement = connection.createStatement();
			resultSet = statement.executeQuery("SELECT Station_Rank_ProbCat("+rankStations+", '"+problemCategory+"')");
			if (resultSet.next()) {
				resultStation = resultSet.getString(1);
			}
			
			statement = connection.createStatement();
			resultSet = statement.executeQuery("SELECT Parts_Rank_Station("+rankParts+","+rankStations+", '"+problemCategory+"')");
			if (resultSet.next()) {
				resultParts = resultSet.getString(1);
			}
	
			statement = connection.createStatement();
			resultSet = statement.executeQuery(
					"SELECT raw_id,creation_date,resolution,case_id " + 
					"FROM ( " + 
					"	SELECT a.* " + 
					"	FROM service_flowco AS a " + 
					"	INNER JOIN raw_data_problem_type AS b " + 
					"	ON a.problem_type = b.problem_type " + 
					"	AND b.problem_category = '"+problemCategory+"' " + 
					") c " + 
					"WHERE business_partner_name = '"+resultStation+"' " + 
					"AND replacement_parts_no = '"+resultParts+"' "
					);
		}catch (SQLException e){
			e.printStackTrace();
	    	System.err.println("Error getResDateByPartsStationProbCat()");
		}
		
		return resultSet;
	}

	public void insertCompletedDate(int raw_id, String dateString) throws Exception{
		try {
			SimpleDateFormat sdf1 = new SimpleDateFormat("dd-MM-yy");
			java.util.Date date;
			date = sdf1.parse(dateString);
			java.sql.Date sqlDate = new java.sql.Date(date.getTime());
			
			String query = "UPDATE service_flowco_duplicate SET completion_date = ? WHERE raw_id = ?";
		    PreparedStatement preparedStatement = connection.prepareStatement(query);
		    preparedStatement.setDate(1, sqlDate);
		    preparedStatement.setInt(2, raw_id);;
		    preparedStatement.executeUpdate();
			
			//System.out.println("raw_id = "+raw_id+"    completion_date = "+dateString+" sqlDate = "+sqlDate+ "    inserted");
		} catch (ParseException e) {
			e.printStackTrace();
			System.err.println("Error insertCompletedDate()");
		}
		 
	}

	public int getTotalPartsByStation(int rankStation,  String problemCategory) throws Exception{
		int resultTotal = 0;
		try {
			Statement statement = null;
			ResultSet resultSet = null;
			
			statement = connection.createStatement();
			resultSet = statement.executeQuery("SELECT Total_Part_Station("+rankStation+", '"+problemCategory+"' )");
			
			if (resultSet.next()) {
				resultTotal = resultSet.getInt(1);
			}
		} catch (SQLException e) {
			e.printStackTrace();
			System.err.println("Error getTotalPartsByStation()");
		}
		return resultTotal;
	}

	public ResultSet getProbDescByPartsStationProbCat(int rankParts, int rankStations, String problemCategory) throws Exception{
		Statement statement = null;
		ResultSet resultSet = null;
		String resultStation = null;
		String resultParts = null;
		
		try {
			statement = connection.createStatement();
			resultSet = statement.executeQuery("SELECT Station_Rank_ProbCat("+rankStations+", '"+problemCategory+"')");
			if (resultSet.next()) {
				resultStation = resultSet.getString(1);
			}
			
			statement = connection.createStatement();
			resultSet = statement.executeQuery("SELECT Parts_Rank_Station("+rankParts+","+rankStations+", '"+problemCategory+"')");
			if (resultSet.next()) {
				resultParts = resultSet.getString(1);
			}
	
			statement = connection.createStatement();
			resultSet = statement.executeQuery(
					"SELECT raw_id, problem_description, case_id " + 
					"FROM ( " + 
					"	SELECT a.* " + 
					"	FROM service_flowco AS a " + 
					"	INNER JOIN raw_data_problem_type AS b " + 
					"	ON a.problem_type = b.problem_type " + 
					"	AND b.problem_category = '"+problemCategory+"' " + 
					") c " + 
					"WHERE business_partner_name = '"+resultStation+"' " + 
					"AND replacement_parts_no = '"+resultParts+"' "
					);
		}catch (SQLException e){
			e.printStackTrace();
	    	System.err.println("Error getProbDescByPartsStationProbCat()");
		}
		return resultSet;
	}

	public void insertPumpGas(int raw_id, String[] matched) throws Exception{
		try {
			String query = "UPDATE service_flowco_duplicate SET gas_type = ?, pump = ? WHERE raw_id = ?";
		    PreparedStatement preparedStatement = connection.prepareStatement(query);
		    preparedStatement.setString(1, matched[0]);
		    preparedStatement.setString(2, matched[1]);
		    preparedStatement.setInt(3, raw_id);;
		    preparedStatement.executeUpdate();
			
//			System.out.println("raw_id = "+raw_id+"    gas_type = "+matched[0]+" pump = "+matched[1]+ "    inserted");
		} catch (SQLException e) {
			e.printStackTrace();
			System.err.println("Error insertPumpGas()");
		}
	}
	
	public void insertDuplicatePumpGas(int raw_id, String[] matched) throws Exception{
		try {
			String query = "INSERT INTO `service_flowco_duplicate` (raw_id, business_partner_name, problem_description, creation_date, creation_time, case_id, problem_type, resolution, replacement_parts_no, completion_date, completion_time, pump, gas_type) " + 
					"SELECT raw_id, business_partner_name, problem_description, creation_date, creation_time, case_id, problem_type, resolution, replacement_parts_no, completion_date, completion_time, ?, ?" + 
					"FROM service_flowco_duplicate WHERE raw_id = ? LIMIT 0,1";
		    PreparedStatement preparedStatement = connection.prepareStatement(query);
		    preparedStatement.setString(1, matched[1]);
		    preparedStatement.setString(2, matched[0]);
		    preparedStatement.setInt(3, raw_id);
		    preparedStatement.executeUpdate();
			
//		  System.out.println("raw_id = "+raw_id+"    gas_type = "+matched[0]+" pump = "+matched[1]+ "    inserted (Duplicate)");
		} catch (SQLException e) {
			e.printStackTrace();
			System.err.println("Error insertDuplicatePumpGas()");
		}
	}

	public void scriptCreateExtractedDataTable(String problemCategory) throws Exception{
		Statement statement = null;
		try {
			
			statement = connection.createStatement();
			statement.executeUpdate("DROP TABLE IF EXISTS `extracted_data_"+problemCategory+"`;");
			statement = connection.createStatement();
			statement.executeUpdate(
					"CREATE TABLE `extracted_data_"+problemCategory+"` ( " + 
					"	`id` int NOT NULL AUTO_INCREMENT, " + 
					"	`case_id` VARCHAR(255) NOT NULL, " + 
					"	`station_id` VARCHAR(255) NOT NULL, " + 
					"	`business_partner_name` VARCHAR(255) NOT NULL, " + 
					"	`pump` int(11) NOT NULL, " + 
					"	`gas_type` VARCHAR(255) NOT NULL, " + 
					"	`creation_date` DATE NOT NULL, " + 
					"	`completion_date` DATE NOT NULL, " +
					"	PRIMARY KEY (`id`) " + 
					") " + 
					"ENGINE = InnoDB " + 
					"CHARSET = utf8mb4 " + 
					"COLLATE utf8mb4_unicode_ci " + 
					"COMMENT = 'Extracted data for "+problemCategory+"';");
			
			System.out.println("TABLE extracted_data_"+problemCategory+" CREATED");
		} catch (SQLException e) {
			e.printStackTrace();
			System.err.println("Error scriptCreateExtractedDataTable()");
		}
	}
	
	public void scriptInsertAllPumpGasExtractedDataTable(int rankStations, String problemCategory) throws Exception {
		Statement statement = null;
		ResultSet resultSet = null;
		String resultStation = null;
		int maxId = 0;
		try {
			statement = connection.createStatement();
			resultSet = statement.executeQuery("SELECT Station_Rank_ProbCat("+rankStations+", '"+problemCategory+"')");
			if (resultSet.next()) {
				resultStation = resultSet.getString(1);
			}
			statement = connection.createStatement();
//			resultSet = statement.executeQuery("SELECT c.station_id, c.pump, c.gas_type FROM( " +  // from transaction data
//					"SELECT a.station_id, b.business_partner_name, a.pump, a.gas_type " + 
//					"FROM `transaction_11` AS a " + 
//					"INNER JOIN raw_data_station_profile_flowco As b " + 
//					"ON a.station_id = b.station_id) as c " + 
//					"WHERE c.business_partner_name = '"+resultStation+"' " + 
//					"GROUP BY c.pump, c.gas_type;");
			resultSet = statement.executeQuery("SELECT c.station_id, c.pump, c.gas_type FROM( " + 	// from 11 pilot profile
					"SELECT a.station_id, b.business_partner_name, a.dispenser_number AS pump, a.gas_short_name AS gas_type " + 
					"FROM `raw_data_station_profile_11` AS a " + 
					"INNER JOIN `raw_data_station_profile_flowco` As b " + 
					"ON a.station_id = b.station_id) as c " + 
					"WHERE c.business_partner_name = '"+resultStation+"' " + 
					"GROUP BY c.pump, c.gas_type;");
			while(resultSet.next()) {
				statement = connection.createStatement();
				String sql = "INSERT INTO `extracted_data_"+problemCategory+"`(case_id,station_id, business_partner_name, pump, gas_type, creation_date, completion_date) " + 
						"VALUEs('','"+resultSet.getString("station_id")+"','"+resultStation+"','"+resultSet.getInt("pump")+"','"+resultSet.getString("gas_type").toLowerCase().replace("primax", "").trim()+"','0000-00-00','2017-01-01');";
//				System.out.println(sql);
				statement.executeUpdate(sql);
			}
			statement = connection.createStatement();
			resultSet = statement.executeQuery("SELECT max(id) + 1 FROM `extracted_data_"+problemCategory+"`");
			if (resultSet.next()) {
				maxId = resultSet.getInt(1);
			}
			String query = "ALTER TABLE `extracted_data_"+problemCategory+"` AUTO_INCREMENT = ? ";
			PreparedStatement preparedStatement = connection.prepareStatement(query);
		    preparedStatement.setInt(1, maxId);
		    preparedStatement.executeUpdate();
			
			System.out.println("INSERTED initial pump, gasType INTO extracted_data_"+problemCategory+" TABLE for station "+rankStations);
		} catch (SQLException e) {
			e.printStackTrace();
			System.err.println("Error scriptInsertAllPumpGasExtractedDataTable()");
		}
	}
	
	public void scriptInsertExtractedDataTable(int rankStations, String problemCategory) throws Exception {
		Statement statement = null;
		ResultSet resultSet = null;
		String resultStation = null;
		int maxId = 0;
		try {
			statement = connection.createStatement();
			resultSet = statement.executeQuery("SELECT Station_Rank_ProbCat("+rankStations+", '"+problemCategory+"')");
			if (resultSet.next()) {
				resultStation = resultSet.getString(1);
			}
			statement = connection.createStatement();
			statement.executeUpdate("INSERT INTO `extracted_data_"+problemCategory+"`(case_id, station_id, business_partner_name, pump, gas_type,creation_date, completion_date) " + 
					"SELECT d.case_id, d.station_id, d.business_partner_name, d.pump, d.gas_type,  d.creation_date, d.completion_date " + 
					"FROM ( " + 
					"SELECT a.*, c.station_id " + 
					"FROM service_flowco_duplicate AS a " + 
					"INNER JOIN raw_data_problem_type AS b " + 
					"ON a.problem_type = b.problem_type " + 
					"AND b.problem_category = '"+problemCategory+"' " + 
					"INNER JOIN raw_data_station_profile_flowco AS c " + 
					"ON c.business_partner_name = a.business_partner_name " + 
					") d " + 
					"WHERE business_partner_name = '"+resultStation+"' " + 
					"AND completion_date != '0000-00-00' "+
					"GROUP BY business_partner_name, pump, gas_type, creation_date, completion_date " + 
					"ORDER BY business_partner_name, pump, gas_type, creation_date, completion_date;");
			statement = connection.createStatement();
			resultSet = statement.executeQuery("SELECT max(id) + 1 FROM `extracted_data_"+problemCategory+"`");
			if (resultSet.next()) {
				maxId = resultSet.getInt(1);
			}
			String query = "ALTER TABLE `extracted_data_"+problemCategory+"` AUTO_INCREMENT = ? ";
			PreparedStatement preparedStatement = connection.prepareStatement(query);
		    preparedStatement.setInt(1, maxId);
		    preparedStatement.executeUpdate();
			
			System.out.println("INSERTED INTO extracted_data_"+problemCategory+" TABLE for station "+rankStations);
		} catch (SQLException e) {
			e.printStackTrace();
			System.err.println("Error scriptCreateExtractedDataTable()");
		}
	}

	public void scriptAlterExtractedDataTable(String problemCategory) throws Exception{
		Statement statement = null;
		try {
			statement = connection.createStatement();
			statement.executeUpdate("ALTER TABLE `extracted_data_"+problemCategory+"` " +
					"ADD `days_to_action` int(11) NOT NULL, " +
					"ADD `lifetime` int(11) NOT NULL, " +
					"ADD `transaction_days` int(11) NOT NULL, " +
					"ADD `transaction_count` int(11) NOT NULL, " + 
					"ADD `adjusted_transaction_count` int(11) NOT NULL, " +
					"ADD `total_volume` FLOAT NOT NULL, " +
					"ADD `adjusted_total_volume` FLOAT NOT NULL; " 
					);
			
			System.out.println("TABLE extracted_data_"+problemCategory+" ALTERED");
		} catch (SQLException e) {
			e.printStackTrace();
			System.err.println("Error scriptAlterExtractedDataTable()");
		}
	}

	public ResultSet getIdentityExtractedData(String problemCategory) throws Exception {
		Statement statement = null;
		ResultSet resultSet = null;
		try {
			statement = connection.createStatement();
			resultSet = statement.executeQuery(
					"SELECT b.station_id, a.business_partner_name, a.pump, a.gas_type " + 
					"FROM extracted_data_"+problemCategory+" AS a " + 
					"INNER JOIN raw_data_station_profile_flowco AS b " + 
					"ON a.business_partner_name = b.business_partner_name " + 
					"GROUP BY b.station_id, a.business_partner_name, a.pump, a.gas_type; "
					);
		}catch (SQLException e){
			e.printStackTrace();
	    	System.err.println("Error getIdentityExtractedData()");
		}
		return resultSet;
	}
	
	public ResultSet getDatesByStationPumpGas(String businessPartnerName, int pump, String gasType, String problemCategory) throws Exception {
		Statement statement = null;
		ResultSet resultSet = null;
		try {
			statement = connection.createStatement();
			resultSet = statement.executeQuery(
					"SELECT id, creation_date, completion_date " + 
					"FROM extracted_data_"+problemCategory+" "+
					"WHERE business_partner_name = '"+businessPartnerName+"'" + 
					"AND pump = "+pump+" AND gas_type = '"+gasType+"';"
					);
		}catch (SQLException e){
			e.printStackTrace();
	    	System.err.println("Error getDatesByStationPumpGas()");
		}
		return resultSet;
	}
	
	public void insertLifetime(int id, int lifetime, String problemCategory) throws Exception {
		try {
			String query = "UPDATE extracted_data_"+problemCategory+" SET lifetime = ? WHERE id = ?";
		    PreparedStatement preparedStatement = connection.prepareStatement(query);
		    preparedStatement.setInt(1, lifetime);
		    preparedStatement.setInt(2, id);
		    preparedStatement.executeUpdate();
			
//			System.out.println("id = "+id+"    lifetime = "+lifetime+"    inserted");
		} catch (SQLException e) {
			e.printStackTrace();
			System.err.println("Error insertLifetime()");
		}
	}
	
	public void insertDaysToAction(int id, int daysToAction, String problemCategory) throws Exception {
		try {
			String query = "UPDATE extracted_data_"+problemCategory+" SET days_to_action = ? WHERE id = ?;";
		    PreparedStatement preparedStatement = connection.prepareStatement(query);
		    preparedStatement.setInt(1, daysToAction);
		    preparedStatement.setInt(2, id);
		    preparedStatement.executeUpdate();
			
//			System.out.println("id = "+id+"    daysToAction = "+daysToAction+"    inserted");
		} catch (SQLException e) {
			e.printStackTrace();
			System.err.println("Error insertDaysToAction()");
		}
	}

	public ResultSet getProblemTypeByCategory(String problemCategory) throws Exception {
		Statement statement = null;
		ResultSet resultSet = null;
		try {
			statement = connection.createStatement();
			resultSet = statement.executeQuery(
					"SELECT problem_type FROM raw_data_problem_type " + 
					"WHERE problem_category = '"+problemCategory+"';"
					);
		}catch (SQLException e){
			e.printStackTrace();
	    	System.err.println("Error getProblemTypeByCategory()");
		}
		return resultSet;
	}
	
	public void scriptCreateEncodeTable(String type, String problemCategory) throws Exception{
		Statement statement = null;
		ResultSet resultSet = null;
		try {
			statement = connection.createStatement();
			if (type.equals("problem")) {
				resultSet = getProblemTypeByCategory(problemCategory);
			}else if (type.equals("parts")) {
				resultSet = getReplacementPartsByCategory(problemCategory);
			}
			String column = "`id` int(11) NOT NULL AUTO_INCREMENT,";
			while (resultSet.next()) {
				String temp = resultSet.getString(1).replace(" ", "_").replace("-", "_");
				column+=" `"+temp+"` BOOLEAN NOT NULL DEFAULT 0,";
			}
			column+= " PRIMARY KEY (`id`) ";
			String sql = "CREATE TABLE `"+type+"_encode_"+problemCategory+"` ("+column+")" + 
					"ENGINE = InnoDB " + 
					"CHARSET = utf8mb4 " + 
					"COLLATE utf8mb4_unicode_ci " + 
					"COMMENT = 'Encode data for problem type for "+problemCategory+"';";
			statement = connection.createStatement();
			statement.executeUpdate("DROP TABLE IF EXISTS `"+type+"_encode_"+problemCategory+"`;");
			statement = connection.createStatement();
			statement.executeUpdate(sql);
			
			System.out.println("TABLE "+type+"_encode_"+problemCategory+" CREATED");
		} catch (SQLException e) {
			e.printStackTrace();
			System.err.println("Error scriptCreateProblemEncodeTable()");
		}
	}
	
	public ResultSet getDetailsExtractedData(String problemCategory) throws Exception{
		Statement statement = null;
		ResultSet resultSet = null;
		try {
			statement = connection.createStatement();
			resultSet = statement.executeQuery(
					"SELECT id, business_partner_name, pump, gas_type, creation_date " + 
					"FROM extracted_data_"+problemCategory+"; "
					);
		}catch (SQLException e){
			e.printStackTrace();
	    	System.err.println("Error getDetailsExtractedData()");
		}
		return resultSet;
	}

	public ResultSet getProblemTypeByDetails(String businessPartnerName, int pump, String gasType, Date creationDate, String problemCategory) throws Exception {
		Statement statement = null;
		ResultSet resultSet = null;
		try {
			statement = connection.createStatement();
			resultSet = statement.executeQuery(
					"SELECT c.problem_type " + 
					"FROM ( " + 
					"	SELECT a.* " + 
					"	FROM service_flowco_duplicate AS a " + 
					"	INNER JOIN raw_data_problem_type AS b " + 
					"	ON a.problem_type = b.problem_type " + 
					"	AND b.problem_category = '"+problemCategory+"' " + 
					") c " + 
					"WHERE business_partner_name = '"+businessPartnerName+"' " + 
					"AND pump = "+pump+" " + 
					"AND gas_type = '"+gasType+"' " + 
					"AND creation_date = '"+creationDate+"'; "
					);
		}catch (SQLException e){
			e.printStackTrace();
	    	System.err.println("Error getProblemTypeByDetails()");
		}
		return resultSet;
	}

	public void insertProblemTypeEncode(int id, List<Boolean> result, List<String> listProblemType, String problemCategory) throws Exception {
		Statement statement = null;
		try {
			String probType = "";
			String input = "";
			probType+= "`"+listProblemType.get(0).replace(" ", "_").replace("-", "_")+"`";
			input+= result.get(0);
			for (int i = 1; i < listProblemType.size(); i++) {
				probType+= ", `"+listProblemType.get(i).replace(" ", "_").replace("-", "_")+"`";
				input+= ", "+result.get(i);
			}
			String sql = "INSERT INTO problem_encode_"+problemCategory+" ("+probType+") ";
			sql+= "VALUES ("+input+")";
			statement = connection.createStatement();
			statement.executeUpdate(sql);
//			System.out.println("id = "+id+" "+probType+" AS "+input+"	inserted");
		} catch (SQLException e) {
			e.printStackTrace();
			System.err.println("Error insertProblemTypeEncode()");
		}
	}
	
	public ResultSet getReplacementPartsByCategory(String problemCategory) throws Exception{
		Statement statement = null;
		ResultSet resultSet = null;
		try {
			statement = connection.createStatement();
			resultSet = statement.executeQuery(
					"SELECT c.replacement_parts_no " + 
					"FROM( " + 
					"	SELECT a.* " + 
					"	FROM service_flowco AS a " + 
					"	INNER JOIN raw_data_problem_type AS b " + 
					"	ON a.problem_type = b.problem_type " + 
					"	AND b.problem_category = '"+problemCategory+"' " + 
					") c " + 
					"WHERE NOT c.replacement_parts_no = '' " + 
					"AND NOT c.replacement_parts_no = 'N/A' " + 
					"AND NOT c.replacement_parts_no = 'NIL' " + 
					"GROUP BY c.replacement_parts_no " + 
					"ORDER BY c.replacement_parts_no;"
					);
		}catch (SQLException e){
			e.printStackTrace();
	    	System.err.println("Error getReplacementPartsByCategory()");
		}
		return resultSet;
	}
	
	public ResultSet getReplacementPartsByDetails(String businessPartnerName, int pump, String gasType, Date creationDate, String problemCategory) throws Exception {
		Statement statement = null;
		ResultSet resultSet = null;
		try {
			statement = connection.createStatement();
			resultSet = statement.executeQuery(
					"SELECT c.replacement_parts_no " + 
					"FROM ( " + 
					"	SELECT a.* " + 
					"	FROM service_flowco_duplicate AS a " + 
					"	INNER JOIN raw_data_problem_type AS b " + 
					"	ON a.problem_type = b.problem_type " + 
					"	AND b.problem_category = '"+problemCategory+"' " + 
					") c " + 
					"WHERE business_partner_name = '"+businessPartnerName+"' " + 
					"AND pump = "+pump+" " + 
					"AND gas_type = '"+gasType+"' " + 
					"AND creation_date = '"+creationDate+"'; "
					);
		}catch (SQLException e){
			e.printStackTrace();
	    	System.err.println("Error getReplacementPartsByDetails()");
		}
		return resultSet;
	}
	
	public void insertReplacementPartsEncode(int id, List<Boolean> result, List<String> listReplacementParts, String problemCategory) throws Exception {
		Statement statement = null;
		try {
			String replaceParts = "";
			String input = "";
			replaceParts+= "`"+listReplacementParts.get(0).replace(" ", "_").replace("-", "_")+"`";
			input+= result.get(0);
			for (int i = 1; i < listReplacementParts.size(); i++) {
				replaceParts+= ", `"+listReplacementParts.get(i).replace(" ", "_").replace("-", "_")+"`";
				input+= ", "+result.get(i);
			}
			String sql = "INSERT INTO parts_encode_"+problemCategory+" ("+replaceParts+") ";
			sql+= "VALUES ("+input+")";
			statement = connection.createStatement();
			statement.executeUpdate(sql);
//			System.out.println("id = "+id+" "+replaceParts+" AS "+input+"	inserted");
		} catch (SQLException e) {
			e.printStackTrace();
			System.err.println("Error insertProblemTypeEncode()");
		}
	}
	
	public ResultSet getResultTable(String problemCategory) throws Exception {
		Statement statement = null;
		ResultSet resultSet = null;
		String sql="";
		try {
			sql+="SELECT station_id, pump, gas_type, completion_date, transaction_count, adjusted_transaction_count, total_volume, adjusted_total_volume ";
			resultSet = getProblemTypeByCategory(problemCategory);
			while (resultSet.next()) {
				sql+=", "+resultSet.getString(1).replace(" ", "_").replace("-", "_");
			}
			resultSet = getReplacementPartsByCategory(problemCategory);
			while (resultSet.next()) {
				sql+=", "+resultSet.getString(1).replace(" ", "_").replace("-", "_");
			}
			sql+=" , lifetime ";
			statement = connection.createStatement();
			resultSet = statement.executeQuery(sql+
					"FROM extracted_data_"+problemCategory+" AS a " + 
					"INNER JOIN problem_encode_"+problemCategory+" AS b " + 
					"ON a.id = b.id " + 
					"INNER JOIN parts_encode_"+problemCategory+" AS c " + 
					"ON a.id = c.id " +
					"ORDER BY station_id, pump, gas_type, completion_date"
					);
		}catch (Exception e){
			e.printStackTrace();
	    	System.err.println("Error getResultTable()");
		}
		return resultSet;
	}
	
	public String getTotalBooleanYesUnused(String column, String encodeType,String problemCategory) throws Exception {
		Statement statement = null;
		ResultSet resultSet = null;
		String result = null;
		try {
			statement = connection.createStatement();
			resultSet = statement.executeQuery("SELECT SUM("+column+" = 1) FROM "+encodeType+"_encode_"+problemCategory+"; ");
			if (resultSet.next()) {
				result = resultSet.getString(1);
			}
		}catch (SQLException e){
			e.printStackTrace();
	    	System.err.println("Error getTotalBooleanYesUnused()");
		}
		return result;
	}
	
	public ResultSet getTransactionCountVolume(String stationId, int pump, String gasType, Date startDate, Date endDate) throws Exception {
		Statement statement = null;
		ResultSet resultSet = null;
		try {
			if (gasType.equals("95")) {
				gasType = "primax 95";
			}else if (gasType.equals("97")) {
				gasType = "primax 97";
			}else if (gasType.equals("GasNone")) {
				gasType = "";
			}
			String sql = "SELECT COUNT(*) AS transaction_count, SUM(quantity) AS total_volume, COUNT(DISTINCT job_load_date) as transaction_days " + 
					"FROM transaction_11 " + 
					"WHERE station_id = '"+stationId+"' AND pump = "+pump+" "+
					"AND gas_type = '"+gasType+"' " + 
					"AND job_load_date >= '"+startDate.toString()+"'  AND job_load_date <= '"+endDate.toString()+"'; ";
			statement = connection.createStatement();
			resultSet = statement.executeQuery(sql);
//			System.out.println(sql);
		}catch (SQLException e){
			e.printStackTrace();
	    	System.err.println("Error getTransactionCountVolume()");
		}
		return resultSet;
	}
	
	public void insertTransactionCountVolume(int id, int transactionCount, float totalVolume, int transactionDays, String problemCategory) throws Exception {
		try {
			String query = "UPDATE extracted_data_"+problemCategory+" SET transaction_count = ?, total_volume = ?, transaction_days = ? WHERE id = ?";
		    PreparedStatement preparedStatement = connection.prepareStatement(query);
		    preparedStatement.setInt(1, transactionCount);
		    preparedStatement.setFloat(2, totalVolume);
		    preparedStatement.setFloat(3, transactionDays);
		    preparedStatement.setInt(4, id);
		    preparedStatement.executeUpdate();
			
//			System.out.println("id = "+id+"   transaction_count = "+transactionCount+", total_volume = "+totalVolume+"    inserted");
		} catch (SQLException e) {
			e.printStackTrace();
			System.err.println("Error insertTransactionCountVolume()");
		}
	}
	
	public ResultSet getEncodedData(String stationId, int pump, String gasType, String type, String problemCategory) throws Exception {
		Statement statement = null;
		ResultSet resultSet = null;
		try {
			if (type.equals("problem")) {
				resultSet = getProblemTypeByCategory(problemCategory);
			}else if (type.equals("parts")) {
				resultSet = getReplacementPartsByCategory(problemCategory);
			}
			List<String> typeList = new ArrayList<>();
			while (resultSet.next()) {
				typeList.add(resultSet.getString(1).replace(" ", "_").replace("-", "_"));
			}
			String types = "";
			for (String temp : typeList) {
				types += temp+", ";
			}
			
			String sql = 
					"SELECT "+types+" id FROM ( "+
					"SELECT "+types+" a.id, b.station_id, b.pump, b.gas_type " + 
					"FROM "+type+"_encode_"+problemCategory+" AS a " + 
					"INNER JOIN extracted_data_"+problemCategory+" AS b " + 
					"ON a.id = b.id) c " + 
					"WHERE c.station_id = '"+stationId+"' " + 
					"AND pump = "+pump+" " + 
					"AND c.gas_type = '"+gasType+"'; ";
			statement = connection.createStatement();
			resultSet = statement.executeQuery(sql);
		}catch (SQLException e){
			e.printStackTrace();
	    	System.err.println("Error getEncodedData()");
		}
		return resultSet;
	}
	
	public void updateEncodeData(int id, List<Boolean> result, String type, String problemCategory) throws Exception {
		Statement statement = null;
		ResultSet resultSet = null;
		try {
			if (type.equals("problem")) {
				resultSet = getProblemTypeByCategory(problemCategory);
			}else if (type.equals("parts")) {
				resultSet = getReplacementPartsByCategory(problemCategory);
			}
			List<String> typeList = new ArrayList<>();
			while (resultSet.next()) {
				typeList.add(resultSet.getString(1).replace(" ", "_").replace("-", "_"));
			}
			String sql = "UPDATE "+type+"_encode_"+problemCategory+" SET ";
			sql += typeList.get(0)+" = "+result.get(0);
			for (int i = 1; i < typeList.size(); i++) {
				sql += ", "+typeList.get(i)+" = "+result.get(i);
			}
			sql+= " WHERE id = "+id+"; ";
//			System.out.println(sql);
			statement = connection.createStatement();
			statement.executeUpdate(sql);
//			System.out.println("id = "+id+"		encoded data	UPDATED");
		} catch (SQLException e) {
			e.printStackTrace();
			System.err.println("Error updateEncodeData()");
		}
	}

	public int getDaysToAction(int id, String problemCategory)throws Exception {
		Statement statement = null;
		ResultSet resultSet = null;
		int result = 0;
		try {
			String sql = "SELECT days_to_action FROM extracted_data_"+problemCategory+" WHERE id = "+id+" ; ";
			statement = connection.createStatement();
			resultSet = statement.executeQuery(sql);
			if (resultSet.next()) {
				result = resultSet.getInt(1);
			}
		}catch (SQLException e){
			e.printStackTrace();
	    	System.err.println("Error getDaysToAction()");
		}
		return result;	
	}

	public void updateAdjustedTransactionVolume(int id, int adjustedTransaction, int adjustedVolume, String problemCategory)throws Exception {
		try {
			String query = "UPDATE extracted_data_"+problemCategory+" SET adjusted_transaction_count = ?, adjusted_total_volume = ?  WHERE id = ? ;";
		    PreparedStatement preparedStatement = connection.prepareStatement(query);
		    preparedStatement.setInt(1, adjustedTransaction);
		    preparedStatement.setFloat(2, adjustedVolume);
		    preparedStatement.setInt(3, id);
		    preparedStatement.executeUpdate();
			
//			System.out.println("id = "+id+"   adjusted_transaction = "+adjustedTransaction+", adjusted_total_volume = "+adjustedVolume+"    inserted");
		} catch (SQLException e) {
			e.printStackTrace();
			System.err.println("Error updateAdjustedTransactionVolume()");
		}
	}
	
	public String getCompletedDateFromStationDowntime(String case_id)throws Exception{
		Statement statement = null;
		ResultSet resultSet = null;
		String result = "";
		Date resultDate;
		try {
			String sql = "SELECT sla_actual_end_date AS completion_date " + 
					"FROM raw_data_pdb_station_downtime " + 
					"WHERE case_id = '"+case_id+"'; ";
			statement = connection.createStatement();
			resultSet = statement.executeQuery(sql);
			if (resultSet.next()) {
				resultDate = resultSet.getDate(1);
				if (!(resultDate == null)) {
					Calendar cal = Calendar.getInstance();
					cal.setTime(resultDate);
					java.sql.Date newDate = new java.sql.Date(cal.getTimeInMillis());
					DateFormat df = new SimpleDateFormat("dd-MM-yy");
					result = df.format(newDate);
				}
			}
		}catch (SQLException e){
			e.printStackTrace();
	    	System.err.println("Error getCompletedDateFromStationDowntime()");
		}
		return result;	
	}

	public ResultSet getPumpGasTypeFromStationDowntime(String case_id)throws Exception {
		Statement statement = null;
		ResultSet resultSet = null;
		try {
			String sql = "SELECT ( " + 
					"	CASE " + 
					"	WHEN category_5 LIKE '%pump%' " + 
					"	THEN (TRIM(REPLACE(LOWER(category_5),'pump',''))) " + 
					"	ELSE LOWER(category_5) " + 
					"	END " + 
					") AS pump, " + 
					"( " + 
					"	CASE " + 
					"	WHEN category_6 LIKE '%-%' " + 
					"	THEN (TRIM(REPLACE(LOWER(category_6),'-',''))) " + 
					"	WHEN category_6 LIKE '%px%'  " + 
					"	THEN (TRIM(REPLACE(LOWER(category_6),'px',''))) " + 
					"	ELSE LOWER(category_6) " + 
					"	END " + 
					") AS gas_type " + 
					"FROM raw_data_pdb_station_downtime " +
					"WHERE case_id = '"+case_id+"' ; ";
			statement = connection.createStatement();
			resultSet = statement.executeQuery(sql);
//			System.out.println(sql);
		}catch (SQLException e){
			e.printStackTrace();
	    	System.err.println("Error getPumpGasTypeFromStationDowntime()");
		}
		return resultSet;
	}
	
	public ResultSet getAllPumpFromProfile(int rankStations, String problemCategory) throws Exception{
		Statement statement = null;
		ResultSet resultSet = null;
		String resultStation = null;
		try {
			statement = connection.createStatement();
			resultSet = statement.executeQuery("SELECT Station_Rank_ProbCat("+rankStations+", '"+problemCategory+"')");
			if (resultSet.next()) {
				resultStation = resultSet.getString(1);
			}
			statement = connection.createStatement();
			resultSet = statement.executeQuery(
					"SELECT c.pump FROM( " + 
					"SELECT a.dispenser_number AS pump, b.business_partner_name " + 
					"FROM `raw_data_station_profile_11` AS a " + 
					"INNER JOIN `raw_data_station_profile_flowco` As b " + 
					"ON a.station_id = b.station_id) as c " + 
					"WHERE c.business_partner_name = '"+resultStation+"' " + 
					"GROUP BY c.pump; "
					);
		}catch (SQLException e){
			e.printStackTrace();
	    	System.err.println("Error getAllPumpFromProfile()");
		}
		return resultSet;
	}

	///////////////////////////////////// ver 2
	
	public ResultSet getPilotStationId() throws Exception{
		Statement statement = null;
		ResultSet resultSet = null;
		try {
			statement = connection.createStatement();
			resultSet = statement.executeQuery("SELECT station_id FROM `raw_data_station_profile_11` GROUP BY station_id; ");
		}catch (SQLException e){
			e.printStackTrace();
	    	System.err.println("Error getPilotStationId()");
		}
		return resultSet;
	}
	
	public ResultSet getPumpByStationId(String stationId) throws Exception{
		Statement statement = null;
		ResultSet resultSet = null;
		try {
			statement = connection.createStatement();
			resultSet = statement.executeQuery(
					"SELECT raw_id, category_5 FROM `pdb_station_downtime_filtered` " + 
					"where station_id = '"+stationId+"'; ");
		}catch (SQLException e){
			e.printStackTrace();
	    	System.err.println("Error getPumpByStationId()");
		}
		return resultSet;
	}
	
	public void updatePumpByRawId(int rawId, int pump)throws Exception {
		try {
			String query = "UPDATE pdb_station_downtime_filtered_duplicate SET pump = ?  WHERE raw_id = ? ;";
		    PreparedStatement preparedStatement = connection.prepareStatement(query);
		    preparedStatement.setInt(1, pump);
		    preparedStatement.setInt(2, rawId);
		    preparedStatement.executeUpdate();
			
//			System.out.println("raw_id = "+rawId+"   pump = "+pump+"	updated");
		} catch (SQLException e) {
			e.printStackTrace();
			System.err.println("Error updatePumpByRawId()");
		}
	}
	
	public void insertDuplicatePumpByRawId(int raw_id, int pump) throws Exception{
		try {
			String query = "INSERT INTO `pdb_station_downtime_filtered_duplicate` (raw_id, case_id, station_id, station_name, creation_date, completion_date, problem_category, problem_type, category_5, gas_type, dealer_vendor, days_to_action, pump) " + 
					"SELECT raw_id, case_id, station_id, station_name, creation_date, completion_date, problem_category, problem_type, category_5, gas_type, dealer_vendor, days_to_action, ? " + 
					"FROM pdb_station_downtime_filtered_duplicate WHERE raw_id = ? LIMIT 0,1";
		    PreparedStatement preparedStatement = connection.prepareStatement(query);
		    preparedStatement.setInt(1,pump);
		    preparedStatement.setInt(2, raw_id);
		    preparedStatement.executeUpdate();
			
//		  System.out.println("raw_id = "+raw_id+"    pump = "+pump+ "    inserted (Duplicate)");
		} catch (SQLException e) {
			e.printStackTrace();
			System.err.println("Error insertDuplicatePumpByRawId()");
		}
	}
	
	public ResultSet getAllPumpByStationId(String stationId) throws Exception{
		Statement statement = null;
		ResultSet resultSet = null;
		try {
			statement = connection.createStatement();
			resultSet = statement.executeQuery(
					"SELECT dispenser_number AS pump FROM `raw_data_station_profile_11` " + 
					"WHERE station_id = '"+stationId+"' " + 
					"GROUP BY dispenser_number; ");
		}catch (SQLException e){
			e.printStackTrace();
	    	System.err.println("Error getAllPumpByStationId()");
		}
		return resultSet;
	}
	
	public void createExtractedDataTable() throws Exception{
		Statement statement = null;
		try {
			statement = connection.createStatement();
			statement.executeUpdate("DROP TABLE IF EXISTS `extracted_data`;");
			statement = connection.createStatement();
			statement.executeUpdate(
					"CREATE TABLE `extracted_data` " + 
					"SELECT case_id, station_id, dealer_vendor, problem_category, pump, gas_type, creation_date, completion_date, days_to_action  " + 
					"FROM `pdb_station_downtime_filtered_duplicate` " + 
					"GROUP BY station_id, problem_category, pump, gas_type, creation_date; ");
			statement = connection.createStatement();
			statement.executeUpdate("ALTER TABLE `extracted_data` " + 
					"ADD `lifetime` int(11) NOT NULL, " +
					"ADD `transaction_days` int(11) NOT NULL, " +
					"ADD `transaction_count` int(11) NOT NULL, " + 
					"ADD `adjusted_transaction_count` int(11) NOT NULL, " +
					"ADD `total_volume` FLOAT NOT NULL, " +
					"ADD `adjusted_total_volume` FLOAT NOT NULL, " +
					"ADD `note` VARCHAR(255) NOT NULL; ");
			System.out.println("TABLE extracted_data CREATED");
		} catch (SQLException e) {
			e.printStackTrace();
			System.err.println("Error createExtractedDataTable()");
		}
	}
	
	public ResultSet getMissedGroupedDataDetails() throws Exception{
		Statement statement = null;
		ResultSet resultSet = null;
		try {
			statement = connection.createStatement();
			resultSet = statement.executeQuery(
					"SELECT  station_id, problem_category, pump, gas_type, creation_date, completion_date, COUNT(*) c " +
					"FROM pdb_station_downtime_filtered_duplicate " + 
					"GROUP BY station_id, problem_category, pump, gas_type, creation_date HAVING c>1; ");
		}catch (SQLException e){
			e.printStackTrace();
	    	System.err.println("Error getMissedGroupedData()");
		}
		return resultSet;
	}
	
	public ResultSet getCaseIdCompletionDateByDetails(String stationId, String problemCategory, int pump, String gasType, Date creationDate) throws Exception {
		Statement statement = null;
		ResultSet resultSet = null;
		try {
			statement = connection.createStatement();
			resultSet = statement.executeQuery(
					"SELECT case_id, completion_date FROM `pdb_station_downtime_filtered_duplicate` " + 
					"WHERE station_id = '"+stationId+"' " + 
					"AND problem_category = '"+problemCategory+"' " + 
					"AND pump = "+pump+" " + 
					"AND gas_type = '"+gasType+"' " + 
					"AND creation_date = '"+creationDate.toString()+"' " + 
					"ORDER BY completion_date; ");
		}catch (SQLException e){
			e.printStackTrace();
	    	System.err.println("Error getCaseIdCompletionDateByDetails()");
		}
		return resultSet;
	}
	
	public void updateCaseIdCompletionDateByDetails(String caseID, Date completionDate, String stationId, String problemCategory, int pump, String gasType, Date creationDate)throws Exception {
		try {
			String query = "UPDATE extracted_data SET case_id = ?, completion_date = ?  " +
					"WHERE station_id = ? AND problem_category = ? AND pump = ? AND gas_type = ? AND creation_date = ? ;";
		    PreparedStatement preparedStatement = connection.prepareStatement(query);
		    preparedStatement.setString(1, caseID);
		    preparedStatement.setDate(2, completionDate);
		    preparedStatement.setString(3, stationId);
		    preparedStatement.setString(4, problemCategory);
		    preparedStatement.setInt(5, pump);
		    preparedStatement.setString(6, gasType);
		    preparedStatement.setDate(7,  creationDate);
		    preparedStatement.executeUpdate();
			
//			System.out.println("station_id = "+stationId+"   case_id = "+caseID+", completion_date = "+completionDate+"    UPDATED");
		} catch (SQLException e) {
			e.printStackTrace();
			System.err.println("Error updateAdjustedTransactionVolume()");
		}
	}
	
	public void insertNoteByDetails(String note, String stationId, String problemCategory, int pump, String gasType, Date creationDate)throws Exception {
		try {
			String query = "UPDATE extracted_data SET note = CONCAT(note,?,' ')  " +
					"WHERE station_id = ? AND problem_category = ? AND pump = ? AND gas_type = ? AND creation_date = ? ;";
		    PreparedStatement preparedStatement = connection.prepareStatement(query);
		    preparedStatement.setString(1, note);
		    preparedStatement.setString(2, stationId);
		    preparedStatement.setString(3, problemCategory);
		    preparedStatement.setInt(4, pump);
		    preparedStatement.setString(5, gasType);
		    preparedStatement.setDate(6,  creationDate);
		    preparedStatement.executeUpdate();
			
//			System.out.println("station_id = "+stationId+"   note = "+note+"   UPDATED");
		} catch (SQLException e) {
			e.printStackTrace();
			System.err.println("Error insertNoteByDetails()");
		}
	}
	
	
	public void getTest(String problemCategory) throws Exception {
		Statement statement = null;
		ResultSet resultSet = null;
		String resultStation = null;
		String sql = "";
		try {
			statement = connection.createStatement();
			resultSet = statement.executeQuery(
					"SELECT a.station_id "
					+ "FROM `raw_data_station_profile_11` as a "
					+ "INNER JOIN extracted_data_nozzle as b "
					+ "ON a.station_id = b.station_id "
					+ "GROUP BY station_id; ");
			List<String> stationList = new ArrayList<>();
			while (resultSet.next()) {
				stationList.add(resultSet.getString(1));
			}
			for (String station : stationList) {
				statement = connection.createStatement();
				resultSet = statement.executeQuery(
						"SELECT dispenser_number AS pump " +
						"FROM raw_data_station_profile_11 " + 
						"WHERE station_id = '"+station+"' " + 
						"GROUP BY pump; ");
				List<Integer> pumpList = new ArrayList<>();
				while (resultSet.next()) {
					pumpList.add(resultSet.getInt(1));
				}
				for (Integer pump : pumpList) {
					statement = connection.createStatement();
					resultSet = statement.executeQuery(
							"SELECT gas_short_name AS gas_type FROM raw_data_station_profile_11 " + 
							"WHERE station_id = '"+station+"' " + 
							"AND dispenser_number = "+pump+" " + 
							"GROUP BY gas_type; ");
					List<String> gasTypeList = new ArrayList<>();
					while (resultSet.next()) {
						gasTypeList.add(resultSet.getString(1).replaceAll("PRIMAX", "").trim());
					}
					for (int i = 0; i < gasTypeList.size(); i++) {
						sql+=" SELECT station_id, pump, gas_type, completion_date, transaction_count, adjusted_transaction_count, total_volume, adjusted_total_volume ";
						resultSet = getProblemTypeByCategory(problemCategory);
						while (resultSet.next()) {
							sql+=", "+resultSet.getString(1).replace(" ", "_").replace("-", "_");
						}
						resultSet = getReplacementPartsByCategory(problemCategory);
						while (resultSet.next()) {
							sql+=", "+resultSet.getString(1).replace(" ", "_").replace("-", "_");
						}
						sql+=" , lifetime ";
						sql += " FROM( " + 
								"SELECT * from extracted_data_"+problemCategory+" " + 
								"WHERE station_id = '"+station+"' " + 
								"AND pump = "+pump+" " + 
								"AND gas_type = '"+gasTypeList.get(i)+"' " + 
								"ORDER BY completion_date desc LIMIT 2) as d " +
								"INNER JOIN problem_encode_"+problemCategory+" AS e " + 
								"ON d.id = e.id " + 
								"INNER JOIN parts_encode_"+problemCategory+" AS f " + 
								"ON d.id = f.id UNION ";
					}
				}
			}
			sql = sql.substring(0, sql.length() - 6);
			sql += " ORDER BY station_id, pump, gas_type, completion_date ;";
			System.out.println(sql);
//			statement = connection.createStatement();
//			resultSet = statement.executeQuery();
		}catch (SQLException e){
			e.printStackTrace();
	    	System.err.println("Error getAllPumpFromProfile()");
		}
	}
}
