package controller;

import dto.ServiceFlowcoDto;
import dto.ServiceMesralinkDto;

import java.io.File;
import java.io.FileNotFoundException;
import java.io.FileWriter;
import java.io.IOException;
import java.io.PrintWriter;
import java.io.Writer;
import java.sql.ResultSet;
import java.sql.Statement;
import java.text.DateFormat;
import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.sql.Date;
import java.util.ArrayList;
import java.util.Arrays;
import java.util.Calendar;
import java.util.HashSet;
import java.util.List;
import java.util.Scanner;
import java.util.Set;
import java.util.concurrent.TimeUnit;
import java.util.regex.Matcher;
import java.util.regex.Pattern;
import java.util.stream.Collectors;

import javax.servlet.http.HttpServletResponse;

import org.apache.tomcat.util.http.fileupload.ThresholdingOutputStream;

import dao.DataExtractDao;

public class DataExtractController {
	DataExtractDao dataExtractDao;
	
	public DataExtractController(){
		
	}

	public void extractDataDate(int rankStations, String problemCategory, HttpServletResponse response) throws Exception{
		System.out.println("ExtractingDate..."+rankStations);
		Statement statement = null;
		ResultSet resultSet = null;
		try {
			dataExtractDao = new DataExtractDao("jdbc:MySQL://localhost:3306/data_clean", "root", "");
			PrintWriter out = response.getWriter(); //temporary

			for (int i = 0; i < dataExtractDao.getTotalPartsByStation(rankStations, problemCategory); i++) {
				statement = null;
				resultSet = null;
				resultSet = dataExtractDao.getResDateByPartsStationProbCat(i, rankStations, problemCategory);
				
				List<ServiceFlowcoDto> listServiceFlowcoDto = new ArrayList<>();
				while (resultSet.next()) {
					ServiceFlowcoDto serviceFlowcoDto = new ServiceFlowcoDto();
					serviceFlowcoDto.setRawId(resultSet.getInt("raw_id"));
					serviceFlowcoDto.setCreationDate(resultSet.getDate("creation_date"));
					serviceFlowcoDto.setResolution(resultSet.getString("resolution"));
					serviceFlowcoDto.setCase_id(resultSet.getString("case_id"));
					listServiceFlowcoDto.add(serviceFlowcoDto);
				}
				for(ServiceFlowcoDto serviceFlowcoDto : listServiceFlowcoDto) {
					String dateInitial = dataExtractDao.getCompletedDateFromStationDowntime(serviceFlowcoDto.getCase_id());
					if (dateInitial.equals("")) {
						System.out.println("no date available from raw_id = "+serviceFlowcoDto.getRawId()+"	extracting from resolution...");
						if (!serviceFlowcoDto.getResolution().equals("0")) {
//							String dateString = extractCompletedDateUnused(serviceFlowcoDto.getRawId(), serviceFlowcoDto.getResolution());
							String dateString = extractCompletedDate(serviceFlowcoDto.getRawId(), serviceFlowcoDto.getCreationDate(), serviceFlowcoDto.getResolution());
							if (checkDateValidity(dateString)) {//&&checkCompletedDateFilterUnused(serviceFlowcoDto.getResolution())!=false) {
								String finalDate = adjustDate(serviceFlowcoDto.getCreationDate(), dateString);
								out.println("rawId: "+serviceFlowcoDto.getRawId());
								out.println("extractedDate: "+dateString);
								out.println("creationDate: "+serviceFlowcoDto.getCreationDate());
								out.println(serviceFlowcoDto.getResolution());
								if (!finalDate.equals("")) {
									System.out.println("Invalid date triggered, changed to corrected date: "+finalDate+"	raw_id = "+serviceFlowcoDto.getRawId());
									out.println("Invalid date triggered, changed to corrected date: "+finalDate+"	raw_id = "+serviceFlowcoDto.getRawId());
								}else {
									finalDate = dateString;
								}
//								out.println("pattern match: "+checkCompletedDateFilterUnused(serviceFlowcoDto.getResolution()));
								out.println();
								dataExtractDao.insertCompletedDate(serviceFlowcoDto.getRawId(), finalDate);
							}else {
								System.out.println("Unknown date or Invalid date occur!! raw_id = "+serviceFlowcoDto.getRawId());
								System.out.println("resolution: "+serviceFlowcoDto.getResolution());
								
								out.println("Unknown date or Invalid date occur!! raw_id = "+serviceFlowcoDto.getRawId());
								out.println("creationDate: "+serviceFlowcoDto.getCreationDate());
								String finalDate = addOneDay(serviceFlowcoDto.getCreationDate());
								out.println("resolution: "+serviceFlowcoDto.getResolution());
								out.println("Invalid date triggered, changed to corrected date: "+finalDate+"	raw_id = "+serviceFlowcoDto.getRawId());
								System.out.println("Invalid date triggered, changed to corrected date: "+finalDate+"	raw_id = "+serviceFlowcoDto.getRawId());
								out.println();
							}
						} else {
							System.out.println("0 occur in resolution!! raw_id = "+serviceFlowcoDto.getRawId());
							out.println("0 occur in resolution!! raw_id = "+serviceFlowcoDto.getRawId());
							out.println("creationDate: "+serviceFlowcoDto.getCreationDate());
							String finalDate = addOneDay(serviceFlowcoDto.getCreationDate());
							out.println("resolution: "+serviceFlowcoDto.getResolution());
							out.println("Invalid date triggered, changed to corrected date: "+finalDate+"	raw_id = "+serviceFlowcoDto.getRawId());
							System.out.println("Invalid date triggered, changed to corrected date: "+finalDate+"	raw_id = "+serviceFlowcoDto.getRawId());
							out.println();
						}
					} else {
						if (checkDateValidity(dateInitial)) {
							String finalDate = adjustDate(serviceFlowcoDto.getCreationDate(), dateInitial);
							out.println("caseId: "+serviceFlowcoDto.getCase_id());
							out.println("rawId: "+serviceFlowcoDto.getRawId());
							out.println("initialCompletionDate: "+dateInitial);
							out.println("creationDate: "+serviceFlowcoDto.getCreationDate());
							out.println(serviceFlowcoDto.getResolution());
							if (!finalDate.equals("")) {
								System.out.println("Invalid date triggered, changed to corrected date: "+finalDate+"	raw_id = "+serviceFlowcoDto.getRawId());
								out.println("Invalid date triggered, changed to corrected date: "+finalDate+"	raw_id = "+serviceFlowcoDto.getRawId());
							}else {
								finalDate = dateInitial;
							}
//							out.println("pattern match: "+checkCompletedDateFilterUnused(serviceFlowcoDto.getResolution()));
							out.println();
							dataExtractDao.insertCompletedDate(serviceFlowcoDto.getRawId(), finalDate);
						}else {
							System.out.println("Invalid date occur!! raw_id = "+serviceFlowcoDto.getRawId());
							out.println("Invalid date occur!! raw_id = "+serviceFlowcoDto.getRawId());
							out.println("caseId: "+serviceFlowcoDto.getCase_id());
							out.println("rawId: "+serviceFlowcoDto.getRawId());
							out.println("initialCompletionDate: "+dateInitial);
							out.println("creationDate: "+serviceFlowcoDto.getCreationDate());
							out.println(serviceFlowcoDto.getResolution());
							String finalDate = addOneDay(serviceFlowcoDto.getCreationDate());
							out.println("Invalid date triggered, changed to corrected date: "+finalDate+"	raw_id = "+serviceFlowcoDto.getRawId());
							System.out.println("Invalid date triggered, changed to corrected date: "+finalDate+"	raw_id = "+serviceFlowcoDto.getRawId());
							out.println();
						}
						
					}
					
		        }
			}
			out.close(); //temp
			dataExtractDao.closeConnection(resultSet, statement, dataExtractDao.getConnection());
		} catch (Exception e) {
			dataExtractDao.closeConnection(resultSet, statement, dataExtractDao.getConnection());
			e.printStackTrace();
			System.err.println("Error extractDataDate()");
		}
	}
	
	public String extractCompletedDateUnused(int raw_id,String text) {
		Scanner s;
		String result = "";
		String tempText = "";
		String tempDateFilter = "";
		try {
			s = new Scanner(new File("C:/Users/war09/Desktop/GTD_Petronas/import/CompletedDateFilter.txt"));
			ArrayList<String> dateFilterList = new ArrayList<String>();
			while (s.hasNextLine()){
				dateFilterList.add(s.nextLine());
			}
			s.close();
			
			for (String dateFilter : dateFilterList) {
//				System.out.println(dateFilter);
//				System.out.println(text);
				tempText = text.toLowerCase();
				tempDateFilter = dateFilter.toLowerCase();
				tempText = tempText.replace(" ", "");
				tempDateFilter = tempDateFilter.replace(" ", "");
//				System.out.println(tempDateFilter);
//				System.out.println(tempText);
//				System.out.println(tempDateFilter.length());
				if (tempText.contains(tempDateFilter)) {
					tempText = tempText.substring(tempText.indexOf(tempDateFilter) + tempDateFilter.length());
					break;
				}
			}
			Pattern pattern = Pattern.compile("\\p{L}");
			Matcher matcher = pattern.matcher(tempText);
			matcher.matches();
			if (matcher.find()) {
				tempText = tempText.substring(0, matcher.start());
			}
		
		
		
			if (tempText.length()>10) {
				if (tempText.contains("/")&&tempText.chars().filter(num -> num == '/').count()==1&&tempText.indexOf('/')!=tempText.length()-1) {
					String[] temp = tempText.split("/");
					tempText = temp[1].trim();
				}
			}
//			System.out.println(raw_id);
//			System.out.println(tempText);
			if (tempText.contains("/")) {
				result = dateSplitter(tempText, "/");
			}else if (tempText.contains("-")) {
				result = dateSplitter(tempText, "-");
			}else if (tempText.contains(".")) {
				result = dateSplitter(tempText, "\\.");
			}else if (tempText.length()==6) {
				String container [] = new String[3];
				container[0] = tempText.substring(0,2);
				container[1] = tempText.substring(2,4);
				container[2] = tempText.substring(4);
				for (int i = 0; i < container.length; i++) {
					if (container[i].length()>2) {
						container[i] = container[i].substring(container[i].length() - 2);
					}else if (container[i].length()<2) {
						container[i] = "0"+container[i];
					}
				}
				result = container[0]+"-"+container[1]+"-"+container[2];
			}else if (tempText.length()==8){
				String container [] = new String[3];
				container[0] = tempText.substring(0,2);
				container[1] = tempText.substring(2,4);
				container[2] = tempText.substring(4);
				for (int i = 0; i < container.length; i++) {
					if (container[i].length()>2) {
						container[i] = container[i].substring(container[i].length() - 2);
					}else if (container[i].length()<2) {
						container[i] = "0"+container[i];
					}
				}
				result = container[0]+"-"+container[1]+"-"+container[2];
			}else {
				result = "unknown";
			}
		} catch (FileNotFoundException e) {
			e.printStackTrace();
			System.err.println("Error extractCompletedDateUnused()");
		}
		return result;
	}
	
	public String extractCompletedDate(int raw_id, Date creationDate, String text) {
		String tempText = text.toLowerCase();
		String result = "";
		String extractText = "";
		int position = 0;
		List<Pattern> patterns = new ArrayList<>();
		// keyword pattern
		patterns.add(Pattern.compile("completed\\s*date\\s*\\."));
		patterns.add(Pattern.compile("completed\\s*date"));
		patterns.add(Pattern.compile("completed\\s*sate"));
		patterns.add(Pattern.compile("complated\\s*sate"));
		patterns.add(Pattern.compile("complete\\s*date"));
		patterns.add(Pattern.compile("complate\\s*date"));
		patterns.add(Pattern.compile("complete\\s*\\."));
		List<String> removeWords = new ArrayList<>();
		// remove keyword
		removeWords.add("completed\\s*date\\s*\\.");
		removeWords.add("completed\\s*date");
		removeWords.add("completed\\s*sate");
		removeWords.add("complated\\s*sate");
		removeWords.add("complete\\s*date");
		removeWords.add("complate\\s*date");
		removeWords.add("complete\\s*\\.");
		// remove special character
		removeWords.add(":");
		removeWords.add("\\(");
		
		for (Pattern pattern : patterns) {
			Matcher matcher = pattern.matcher(tempText);
			while(matcher.find()) {
				String dummy = "";
				for (int i = 0; i < matcher.end()-matcher.start(); i++) {
					dummy+= "@";
				}
				tempText = tempText.substring(0,matcher.start())+dummy+tempText.substring(matcher.end(),tempText.length());
				extractText = text.toLowerCase().substring(matcher.start());
				for (String removeWord : removeWords) {
					extractText = extractText.replaceAll(removeWord, "");
				}
				Pattern tempPattern = Pattern.compile("\\p{L}");
				Matcher tempMatcher = tempPattern.matcher(extractText);
				
				if(tempMatcher.find()) {
					if (tempMatcher.start()>=position) {
						extractText = extractText.substring(0,tempMatcher.start()).trim();
						position = tempMatcher.start();
					}
				}
				
			}
		}
		if (extractText.equals("")) { // extract with only word date
			Pattern p = Pattern.compile("date");
			Matcher m = p.matcher(tempText);
			if(m.find()) {
				extractText = text.toLowerCase().substring(m.start());
			}
			extractText = extractText.replaceAll("date", "");
			extractText = extractText.replaceAll(":", "");
			Pattern p2 = Pattern.compile("\\p{L}");
			Matcher m2 = p2.matcher(extractText);
			if(m2.find()) {
				extractText = extractText.substring(0,m2.start()).trim();
			}
		}
		
		if (extractText.equals("")) { // extract any date
			List<Pattern> patterns2 = new ArrayList<>();
			// keyword pattern
			patterns2.add(Pattern.compile("\\d+\\s*/\\s*\\d+\\s*/\\s*\\d+"));
			patterns2.add(Pattern.compile("\\d+\\s*-\\s*\\d+\\s*-\\s*\\d+"));
			patterns2.add(Pattern.compile("\\d+\\s*\\.\\s*\\d+\\s*//.\\s*\\d+"));
			for (Pattern pattern : patterns2) {
				Matcher matcher = pattern.matcher(tempText);
				while(matcher.find()) {
					String dummy = "";
					for (int i = 0; i < matcher.end()-matcher.start(); i++) {
						dummy+= "@";
					}
					tempText = tempText.substring(0,matcher.start())+dummy+tempText.substring(matcher.end(),tempText.length());
					extractText = text.toLowerCase().substring(matcher.start(), matcher.end());
				}
			}
			
		}
		
//		if (raw_id == 1242) {  // to check
//			System.out.println("raw_id: "+raw_id);
//			System.out.println("extracted: "+extractText);
//			System.out.println(tempText);
//		}
		
		if (extractText.length()>10) {
			if (extractText.contains("/")&&extractText.chars().filter(num -> num == '/').count()==1&&extractText.indexOf('/')!=extractText.length()-1) {
				String[] temp = extractText.split("/");
				extractText = temp[1].trim();
			}else if (extractText.contains(" ")&&extractText.chars().filter(num -> num == ' ').count()==1&&extractText.indexOf(' ')!=extractText.length()-1) {
				String[] temp = extractText.split(" ");
				extractText = temp[0].trim().replace(".", "");
			}
		}
		if (extractText.contains("/")) {
			result = dateSplitter(extractText, "/");
		}else if (extractText.contains("-")) {
			result = dateSplitter(extractText, "-");
		}else if (extractText.contains(".")) {
			result = dateSplitter(extractText, "\\.");
		}else if (extractText.contains(" ")) {
			result = dateSplitter(extractText, " ");
		}else if (extractText.length()==6) {
			String container [] = new String[3];
			container[0] = extractText.substring(0,2);
			container[1] = extractText.substring(2,4);
			container[2] = extractText.substring(4);
			for (int i = 0; i < container.length; i++) {
				if (container[i].length()>2) {
					container[i] = container[i].substring(container[i].length() - 2);
				}else if (container[i].length()<2) {
					container[i] = "0"+container[i];
				}
			}
			result = container[0]+"-"+container[1]+"-"+container[2];
		}else if (extractText.length()==8){
			String container [] = new String[3];
			container[0] = extractText.substring(0,2);
			container[1] = extractText.substring(2,4);
			container[2] = extractText.substring(4);
			for (int i = 0; i < container.length; i++) {
				if (container[i].length()>2) {
					container[i] = container[i].substring(container[i].length() - 2);
				}else if (container[i].length()<2) {
					container[i] = "0"+container[i];
				}
			}
			result = container[0]+"-"+container[1]+"-"+container[2];
		}else {
			result = "unknown";
		}
		
		return result;
	}
	
	public String dateSplitter(String dateString, String splitter) {
		String result = "";
		String container [] = dateString.split(splitter);
		for (int i = 0; i < container.length; i++) {
			if (container[i].length()>2) {
				container[i] = container[i].substring(container[i].length() - 2);
			}else if (container[i].length()<2) {
				container[i] = "0"+container[i];
			}
		}
//		System.out.println(container.length);
//		System.out.println(container[0]+"-"+container[1]+"-"+container[2]);
		result = container[0]+"-"+container[1]+"-"+container[2];
		return result;
	}
	
	public boolean checkDateValidity(String dateString) throws Exception {
		boolean result = false;
		try {
			SimpleDateFormat sdf1 = new SimpleDateFormat("dd-MM-yy");
			java.util.Date date;
			date = sdf1.parse(dateString);
			Calendar cal = Calendar.getInstance();
			cal.setLenient(false);
			cal.setTime(date);
			cal.getTime();// throws error if date not exist
			result = true;
		}catch (Exception e) {
		  System.out.println("Invalid date");
		}
		return result;
	}
	
	public boolean checkCompletedDateFilterUnused(String text) throws Exception{
		// to improve and add to database
		Scanner s;
		boolean result = false;
		try {
			s = new Scanner(new File("C:/Users/war09/Desktop/CompletedDateFilter.txt"));
			ArrayList<String> dateFilterList = new ArrayList<String>();
			while (s.hasNextLine()){
				dateFilterList.add(s.nextLine());
			}
			s.close();
			
			for (String dateFilter : dateFilterList) {
				result = false;
				String tempText = text.toLowerCase();
				String tempDateFilter = dateFilter.toLowerCase();
				tempText = tempText.replace(" ", "");
				tempDateFilter = tempDateFilter.replace(" ", "");
//				System.out.println(tempText);
//				System.out.println(tempDateFilter);
				if (tempText.contains(tempDateFilter)) {
					result = true;
//					System.out.println(result);
					break;
				}
			}
			
		} catch (FileNotFoundException e) {
			e.printStackTrace();
			System.err.println("Error checkCompletedDateList()");
		}
		return result;
	}

	public String adjustDate(Date creationDate, String dateString) {
		String result = "";
		try {
			SimpleDateFormat sdf1 = new SimpleDateFormat("dd-MM-yy");
			java.util.Date date;
			date = sdf1.parse(dateString);
			java.sql.Date extractedDate = new java.sql.Date(date.getTime());
			int days = getDifferenceDays(creationDate, extractedDate);
			if (days>5 || days<0) {
				result = addOneDay(creationDate);
			}
			
		} catch (ParseException e) {
			e.printStackTrace();
			System.err.println("Error adjustDate()");
		}
		return result;
	}
	
	public String addOneDay(Date creationDate) {
		String result = "";
		Calendar cal = Calendar.getInstance();
		cal.setTime(creationDate);
		cal.add(Calendar.DATE, 1);
		java.sql.Date newDate = new java.sql.Date(cal.getTimeInMillis());
		DateFormat df = new SimpleDateFormat("dd-MM-yy");
		result = df.format(newDate);
		return result;
	}
	
	public void extractDataPumpGasType(int rankStations, String problemCategory, HttpServletResponse response) {
		System.out.println("ExtractingPumpGas..."+rankStations);
		Statement statement = null;
		ResultSet resultSet = null;
		try {
			dataExtractDao = new DataExtractDao("jdbc:MySQL://localhost:3306/data_clean", "root", "");
			PrintWriter out = response.getWriter(); //temporary
			for (int i = 0; i < dataExtractDao.getTotalPartsByStation(rankStations, problemCategory); i++) {
				resultSet = dataExtractDao.getProbDescByPartsStationProbCat(i, rankStations, problemCategory);
				
				List<ServiceFlowcoDto> listServiceFlowcoDto = new ArrayList<>();
				while (resultSet.next()) {
					ServiceFlowcoDto serviceFlowcoDto = new ServiceFlowcoDto();
					serviceFlowcoDto.setRawId(resultSet.getInt("raw_id"));
					serviceFlowcoDto.setProblemDescription(resultSet.getString("problem_description"));
					serviceFlowcoDto.setCase_id(resultSet.getString("case_id"));
					listServiceFlowcoDto.add(serviceFlowcoDto);
				}
				for (ServiceFlowcoDto serviceFlowcoDto : listServiceFlowcoDto) {
					List<String[]> gasPosition = new ArrayList<String[]>();
					List<String[]> pumpPosition = new ArrayList<String[]>();
					List<String[]> matching = new ArrayList<String[]>();
					String processedTextGas = "";
					String processedTextPump = "";
					String[] gasTypeArray = {"95","97","diesel","ado","ngv"};
//					System.out.println(serviceFlowcoDto.getRawId());
					processedTextGas = extractGasType(serviceFlowcoDto.getRawId(),serviceFlowcoDto.getCase_id(),gasPosition,serviceFlowcoDto.getProblemDescription(),gasTypeArray);
					processedTextPump = extractPump(rankStations,problemCategory,serviceFlowcoDto.getRawId(),serviceFlowcoDto.getCase_id(),pumpPosition, processedTextGas);
					resultSet = dataExtractDao.getAllPumpFromProfile(rankStations, problemCategory);
					if (resultSet.isBeforeFirst() ) { // verify pump number if has data in profile
						List<String> listPump = new ArrayList<String>();
						while (resultSet.next()) {
							listPump.add(String.valueOf(resultSet.getInt("pump")));
						}
						List<Integer> toRemove = new ArrayList<Integer>();
						for (int j = 0; j < pumpPosition.size(); j++) {
							if (!listPump.contains(pumpPosition.get(j)[0])) {
								toRemove.add(j);
							}
						}
						for (Integer remove : toRemove) {
							pumpPosition.remove((int)remove);
						}
					}
					matching = pumpGasMatching(gasPosition, pumpPosition);
					List<String[]> matchedList = matching.stream().distinct().collect(Collectors.toList());//eliminate duplicate
					
//					for (String[] pair : gasPosition) {
//					out.println(Arrays.toString(pair));
//					}
//					for (String[] pair : pumpPosition) {
//						out.println(Arrays.toString(pair));
//					}
//					for (String[] match : matching) {
//						out.println(Arrays.toString(match));
//					}
					out.println(serviceFlowcoDto.getRawId());
					out.println(serviceFlowcoDto.getProblemDescription());
					out.println(processedTextGas);
					out.println(processedTextPump);
					for (String[] matched : matchedList) {
						out.println(Arrays.toString(matched));
					}
					out.println();
					for (int j = 0; j < matchedList.size(); j++) {
						if (matchedList.get(j)[0].equals("unknown")||matchedList.get(j)[1].equals("-1")) {
							System.out.println("Unknown or Wrong extraction of gas pump occur");
						}
						
						if (j==0) {
							dataExtractDao.insertPumpGas(serviceFlowcoDto.getRawId(),matchedList.get(j));
						}else {
							dataExtractDao.insertDuplicatePumpGas(serviceFlowcoDto.getRawId(),matchedList.get(j));
						}
					}
				}
			}
			out.close(); // temp
			dataExtractDao.closeConnection(resultSet, statement, dataExtractDao.getConnection());
		} catch (Exception e) {
			dataExtractDao.closeConnection(resultSet, statement, dataExtractDao.getConnection());
			e.printStackTrace();
			System.err.println("Error extractDataPumpGasType()");
		}
	}
	
	public String extractGasType(int raw_id, String case_id, List<String[]> gasPosition, String problem_description,String[] gasTypeArray) throws Exception {
		String tempProbDesc = problem_description.toLowerCase();
		for (int i = 0; i < gasTypeArray.length; i++) {
			if (tempProbDesc.contains(gasTypeArray[i])) {
				int occurance = checkNumberOfOccurance(gasTypeArray[i],tempProbDesc);
				for (int j = 0; j < occurance; j++) {
					String pair [] = new String [2];
					pair[0] = gasTypeArray[i];
					pair[1] = String.valueOf(tempProbDesc.indexOf(gasTypeArray[i]));
					if (pair[0].equals("ado")) { // change name here
						pair[0] = "diesel";
					}
					String dummy = "";
					for (int k = 0; k < gasTypeArray[i].length(); k++) {
						dummy+= "$";
					}
					tempProbDesc = tempProbDesc.replace(gasTypeArray[i], dummy);
					gasPosition.add(pair);
				}
			}
		}
		if (gasPosition.isEmpty()) {
			ResultSet resultSet = dataExtractDao.getPumpGasTypeFromStationDowntime(case_id);
			if (resultSet.next()) {
				String result = resultSet.getString("gas_type");
//				System.out.println(result);
				if (result.equals("")) {
					System.out.println("Unable to find gas_type!!	raw_id = "+raw_id);
					String pair [] = new String [2];
					pair[0] = "GasNone";
					pair[1] = "0";
					gasPosition.add(pair);
				} else {
					System.out.println("Unable to find gas_type!!	Getting gastype from stationDowntime	raw_id = "+raw_id);
					String pair [] = new String [2];
					pair[0] = result;
					pair[1] = "0";
					gasPosition.add(pair);
				}
			}else {
				System.out.println("Unable to find gas_type!!	raw_id = "+raw_id);
				String pair [] = new String [2];
				pair[0] = "GasNone";
				pair[1] = "0";
				gasPosition.add(pair);
			}
		}
		return tempProbDesc;
		
	}
	
	public int checkNumberOfOccurance(String filter, String text) {
		int counter = 0;
		String dummy = "";
		for (int i = 0; i < filter.length(); i++) {
			dummy+= "$";
		}
		while (text.contains(filter)) {
			text = text.replace(filter,dummy);
			counter++;
		}
		return counter;
	}
	
	public String extractPump(int rankStations, String problemCategory, int raw_id, String case_id, List<String[]> pumpPosition,String processedText) throws Exception {
		String tempText = processedText.toLowerCase();
		List<Pattern> patterns = new ArrayList<>();
		// keyword pattern
		patterns.add(Pattern.compile("pump\\s*no\\s*\\d+"));
		patterns.add(Pattern.compile("pam\\s*no\\s*\\d+"));
		patterns.add(Pattern.compile("pump\\s*\\d+"));
		patterns.add(Pattern.compile("pam\\s*\\d+"));
		patterns.add(Pattern.compile("p\\s*\\d+"));
		
		List<String> removeWords = new ArrayList<>();
		// remove keyword
		removeWords.add("pump\\s*no\\s*");
		removeWords.add("pam\\s*no\\s*");
		removeWords.add("pump\\s*");
		removeWords.add("pam\\s*");
		removeWords.add("p\\s*");
		// remove connector
		removeWords.add("and");
		// remove special character
		removeWords.add("$");
		for (Pattern pattern : patterns) {
			Matcher matcher = pattern.matcher(tempText);
			while(matcher.find()) {
				String dummy = "";
				for (int i = 0; i < matcher.end()-matcher.start(); i++) {
					dummy+= "@";
				}
				tempText = tempText.substring(0,matcher.start())+dummy+tempText.substring(matcher.end(),tempText.length());
				String extractText = "";
				extractText = processedText.toLowerCase().substring(matcher.start());
				for (String removeWord : removeWords) {
					extractText = extractText.replaceAll(removeWord, "");
				}
				Pattern tempPattern = Pattern.compile("\\p{L}");
				Matcher tempMatcher = tempPattern.matcher(extractText);
				if(tempMatcher.find()) {
					extractText = extractText.substring(0,tempMatcher.start()).trim();
				}
//				System.out.println(extractText);
				if (checkNumber(extractText)) {
//					System.out.println("direct");
					if (Integer.parseInt(extractText)>25) {
						String number = extractText;
						char[] digits = number.toCharArray();
						for (int i = 0; i < digits.length; i++) {
							String pair [] = new String [2];
							pair[0] = String.valueOf(digits[i]);
							pair[1] = String.valueOf(matcher.start());
							pumpPosition.add(pair);
						}
					}else {
						String pair [] = new String [2];
						pair[0] = String.valueOf(Integer.parseInt(extractText));
						pair[1] = String.valueOf(matcher.start());
						pumpPosition.add(pair);
					}
				}else {
//					System.out.println("toSplit");
					int[] pumps = pumpSplitter(extractText);
					if (pumps!=null) {
						for (int j = 0; j < pumps.length; j++) {
							if (pumps[j]>25) {
								String number = String.valueOf(pumps[j]);
								char[] digits = number.toCharArray();
								for (int i = 0; i < digits.length; i++) {
									String pair [] = new String [2];
									pair[0] = String.valueOf(digits[i]);
									pair[1] = String.valueOf(matcher.start());
									pumpPosition.add(pair);
								}
							}else {
								String pair [] = new String [2];
								pair[0] = String.valueOf(pumps[j]);
								pair[1] = String.valueOf(matcher.start());
								pumpPosition.add(pair);
							}
						}
					} else {
						System.out.println("Unable to match!!	raw_id = "+raw_id);
						String pair [] = new String [2];
						pair[0] = "-1";// -1 for unknown
						pair[1] = "0";
						pumpPosition.add(pair);
					}
				}
			}
		}
		if (pumpPosition.isEmpty()) {
			ResultSet resultSet = dataExtractDao.getPumpGasTypeFromStationDowntime(case_id);
			if (resultSet.next()) {
				String result = resultSet.getString("pump");
				if (result.equals("all")) {
					resultSet = dataExtractDao.getAllPumpFromProfile(rankStations, problemCategory);
					if (!resultSet.isBeforeFirst() ) {
						System.out.println("Pump not found!!	Getting pump from stationDowntime...	Profile return empty!	raw_id = "+raw_id);
						String pair [] = new String [2]; // temp
						pair[0] = "0"; //0 for none
						pair[1] = "0";
						pumpPosition.add(pair);
					} else {
						System.out.println("Pump not found!!	Getting pump from stationDowntime...	raw_id = "+raw_id);
						while (resultSet.next()) {
							String pair [] = new String [2]; // temp
							pair[0] = String.valueOf(resultSet.getInt("pump"));
							pair[1] = "0";
							pumpPosition.add(pair);
						}
					}
				} else {
					System.out.println("Pump not found!!	Getting pump from stationDowntime...	raw_id = "+raw_id);
					String pair [] = new String [2];
					pair[0] = String.valueOf(Integer.parseInt(result));
					pair[1] = "0";
					pumpPosition.add(pair);
				}
			} else {
				if (tempText.contains("all")) {
					resultSet = dataExtractDao.getAllPumpFromProfile(rankStations, problemCategory);
					if (!resultSet.isBeforeFirst() ) {
						System.out.println("Pump not found!!	Getting pump from stationDowntime...	Profile return empty!	raw_id = "+raw_id);
						String pair [] = new String [2]; // temp
						pair[0] = "0"; //0 for none
						pair[1] = "0";
						pumpPosition.add(pair);
					} else {
						System.out.println("Pump not found!!	Getting pump from stationDowntime...	raw_id = "+raw_id);
						while (resultSet.next()) {
							String pair [] = new String [2]; // temp
							pair[0] = String.valueOf(resultSet.getInt("pump"));
							pair[1] = "0";
							pumpPosition.add(pair);
						}
					}
				}else {
					System.out.println("Pump not found!!	raw_id = "+raw_id);
					String pair [] = new String [2];
					pair[0] = "0"; //0 for none
					pair[1] = "0";
					pumpPosition.add(pair);
				}
			}
		}
		return tempText;
	}
	
	public boolean checkNumber(String stringNumber) {
		boolean result = false;
		Pattern numPattern = Pattern.compile("[0-9]+");
		Matcher numMatcher = numPattern.matcher(stringNumber);
		if(numMatcher.matches()) {
			result = true;
		}
		return result;
	}
	
	public int[] pumpSplitter(String stringNumber) {
		String tempString = stringNumber.replaceAll("\\s{2,}", " ");
		int[] result = null;
		List<String> splitter = new ArrayList<>();
		splitter.add(",");
		splitter.add("/");
		splitter.add("-");
		// single whitespace last
		splitter.add(" ");
		for (String split : splitter) {
			if (tempString.contains(split)) {
				String[] tempResult = tempString.split(split);
				int length = tempResult.length;
				for (int i = 0; i < tempResult.length; i++) {
					tempResult[i] = tempResult[i].replaceAll("\\D+","").trim();
					if (tempResult[i].equals("")) {
						length -= 1;
					}
				}
				result = new int[length];
				for (int i = 0; i < length; i++) {
					result[i] = Integer.parseInt(tempResult[i]);
				}
				break;
			}
		}
		return result;
	}

	public List<String[]> pumpGasMatching(List<String[]> gasPosition, List<String[]> pumpPosition) {
		List<String[]> matching = new ArrayList<>();
		if (gasPosition.size()==1) {
			for (String[] pump : pumpPosition) {
				String[] match = new String[2];
				match[0] = gasPosition.get(0)[0];
				match[1] = pump[0];
				matching.add(match);
			}
		}else {
			if (checkOneSide(gasPosition, pumpPosition)) {
				if (gasPosition.size()==pumpPosition.size()) {
					for (int i = 0; i < gasPosition.size(); i++) {
						String[] match = new String[2];
						match[0] = gasPosition.get(i)[0];
						match[1] = pumpPosition.get(i)[0];
						matching.add(match);
					}
				} else {
					System.out.println("Unable to match");
					String[] match = new String[2];
					match[0] = "unknown";
					match[1] = "-1";
					matching.add(match);
				}
			} else {
				if (Integer.parseInt(gasPosition.get(0)[1])<Integer.parseInt(pumpPosition.get(0)[1])) {
					for (int i = 0; i < gasPosition.size(); i++) {
						for (int j = 0; j < pumpPosition.size(); j++) {
							if (Integer.parseInt(gasPosition.get(i)[1])==Integer.parseInt(gasPosition.get(gasPosition.size()-1)[1])) {
								if (Integer.parseInt(pumpPosition.get(j)[1])>Integer.parseInt(gasPosition.get(i)[1])) {
									String[] match = new String[2];
									match[0] = gasPosition.get(i)[0];
									match[1] = pumpPosition.get(j)[0];
									matching.add(match);
								}
							}else if (Integer.parseInt(pumpPosition.get(j)[1])>Integer.parseInt(gasPosition.get(i)[1])&&Integer.parseInt(pumpPosition.get(j)[1])<Integer.parseInt(gasPosition.get(i+1)[1])) {
								String[] match = new String[2];
								match[0] = gasPosition.get(i)[0];
								match[1] = pumpPosition.get(j)[0];
								matching.add(match);
							}
						}
					}
				} else {
					for (int i = 0; i < gasPosition.size(); i++) {
						for (int j = 0; j < pumpPosition.size(); j++) {
							if (Integer.parseInt(gasPosition.get(i)[1])==Integer.parseInt(gasPosition.get(0)[1])) {
								if (Integer.parseInt(pumpPosition.get(j)[1])<Integer.parseInt(gasPosition.get(i)[1])) {
									String[] match = new String[2];
									match[0] = gasPosition.get(i)[0];
									match[1] = pumpPosition.get(j)[0];
									matching.add(match);
								}
							}else if (Integer.parseInt(pumpPosition.get(j)[1])>Integer.parseInt(gasPosition.get(i-1)[1])&&Integer.parseInt(pumpPosition.get(j)[1])<Integer.parseInt(gasPosition.get(i)[1])){
								String[] match = new String[2];
								match[0] = gasPosition.get(i)[0];
								match[1] = pumpPosition.get(j)[0];
								matching.add(match);
							}
						}
					}
				}
			}
		}
		return matching;
	}
	
	public boolean checkOneSide(List<String[]> gasPosition, List<String[]> pumpPosition) {
		boolean gasFirst = true;
		boolean pumpFirst = true;
		for (String[] gas : gasPosition) {
			for (String[] pump : pumpPosition) {
				if (Integer.parseInt(gas[1])>Integer.parseInt(pump[1])) {
					
				}else {
					gasFirst = false;
				}
				if (Integer.parseInt(gas[1])<Integer.parseInt(pump[1])) {
					
				}else {
					pumpFirst = false;
				}
			}
		}
//		System.out.println(gasFirst);
//		System.out.println(pumpFirst);
		return gasFirst||pumpFirst;
	}

	public void executeScript(int rankStations,String problemCategory, int scriptNum) throws Exception{
		System.out.println("ExecutingScript"+scriptNum+"...");
		Statement statement = null;
		ResultSet resultSet = null;
		try {
			dataExtractDao = new DataExtractDao("jdbc:MySQL://localhost:3306/data_clean", "root", "");
			if (scriptNum==1) {
				dataExtractDao.scriptCreateExtractedDataTable(problemCategory);
			}else if (scriptNum==2) {
				dataExtractDao.scriptInsertAllPumpGasExtractedDataTable(rankStations, problemCategory);
			}else if (scriptNum==3) {
				dataExtractDao.scriptInsertExtractedDataTable(rankStations, problemCategory);
			}else if (scriptNum==4) {
				dataExtractDao.scriptAlterExtractedDataTable(problemCategory);
			}else if (scriptNum==5) {
				dataExtractDao.scriptCreateEncodeTable("problem",problemCategory);
			}else if (scriptNum==6) {
				dataExtractDao.scriptCreateEncodeTable("parts",problemCategory);
			}
			dataExtractDao.closeConnection(resultSet, statement, dataExtractDao.getConnection());
		} catch (Exception e) {
			dataExtractDao.closeConnection(resultSet, statement, dataExtractDao.getConnection());
			e.printStackTrace();
			System.err.println("Error executeScript()");
		}
	}

	public void extractDataLifetime(String problemCategory,HttpServletResponse response) {
		System.out.println("ExtractingLifetime...");
		Statement statement = null;
		ResultSet resultSet = null;
		try {
			dataExtractDao = new DataExtractDao("jdbc:MySQL://localhost:3306/data_clean", "root", "");
			PrintWriter out = response.getWriter(); //temporary
			resultSet = dataExtractDao.getIdentityExtractedData(problemCategory);
			List<ServiceFlowcoDto> listServiceFlowcoDto = new ArrayList<>();
			while (resultSet.next()) {
				ServiceFlowcoDto serviceFlowcoDto = new ServiceFlowcoDto();
				serviceFlowcoDto.setStationId(resultSet.getString("station_id"));
				serviceFlowcoDto.setBusinessPartnerName(resultSet.getString("business_partner_name"));
				serviceFlowcoDto.setPump(resultSet.getInt("pump"));
				serviceFlowcoDto.setGasType(resultSet.getString("gas_type"));
				listServiceFlowcoDto.add(serviceFlowcoDto);
			}
			for (ServiceFlowcoDto serviceFlowcoDto : listServiceFlowcoDto) {
				out.print("station_id: "+serviceFlowcoDto.getStationId());
				out.print("	station_name: "+serviceFlowcoDto.getBusinessPartnerName());
				out.print("	pump: "+serviceFlowcoDto.getPump());
				out.println("	gas: "+serviceFlowcoDto.getGasType());
				
//				if (!serviceFlowcoDto.getGasType().equalsIgnoreCase("GasNone")) {
					resultSet = dataExtractDao.getDatesByStationPumpGas(serviceFlowcoDto.getBusinessPartnerName(), serviceFlowcoDto.getPump(), serviceFlowcoDto.getGasType(), problemCategory);
					List<ServiceFlowcoDto> listServiceFlowcoDto2 = new ArrayList<>();
					while (resultSet.next()) {
						ServiceFlowcoDto serviceFlowcoDto2 = new ServiceFlowcoDto();
						serviceFlowcoDto2.setId(resultSet.getInt("id"));
						serviceFlowcoDto2.setCreationDate(resultSet.getDate("creation_date"));
						serviceFlowcoDto2.setCompletionDate(resultSet.getDate("completion_date"));
						if (serviceFlowcoDto2.getCreationDate() == null) {
							serviceFlowcoDto2.setDaysToAction(0);
						}else {
							serviceFlowcoDto2.setDaysToAction(getDifferenceDays(serviceFlowcoDto2.getCreationDate(), serviceFlowcoDto2.getCompletionDate()));
						}
						
						listServiceFlowcoDto2.add(serviceFlowcoDto2);
					}
					for (ServiceFlowcoDto serviceFlowcoDto2 : listServiceFlowcoDto2) {
						dataExtractDao.insertDaysToAction(serviceFlowcoDto2.getId(), serviceFlowcoDto2.getDaysToAction(), problemCategory);
					}
					
					if (listServiceFlowcoDto2.size()>1) {
						for (int i = 0; i < listServiceFlowcoDto2.size(); i++) {
							if (i == listServiceFlowcoDto2.size()-1) {
								java.sql.Date currentDate = new java.sql.Date(System.currentTimeMillis());
								resultSet = dataExtractDao.getTransactionCountVolume(serviceFlowcoDto.getStationId(), serviceFlowcoDto.getPump(), serviceFlowcoDto.getGasType(), listServiceFlowcoDto2.get(i).getCompletionDate(), currentDate);
								out.print("id: "+listServiceFlowcoDto2.get(i).getId());
								out.print("	creation: "+listServiceFlowcoDto2.get(i).getCreationDate());
								out.print("	completion: "+listServiceFlowcoDto2.get(i).getCompletionDate());
								out.println("	lifetime: "+0);
								if (resultSet.next()) {
									int transactionCount = resultSet.getInt(1);
									float totalVolume = resultSet.getFloat(2);
									int transactionDays = resultSet.getInt(3);
									out.print("transaction_count: "+transactionCount);
									out.println("	total_volume: "+totalVolume);
									dataExtractDao.insertTransactionCountVolume(listServiceFlowcoDto2.get(i).getId(), transactionCount, totalVolume, transactionDays, problemCategory);
								}
							}else {
								int lifetime = getDifferenceDays(listServiceFlowcoDto2.get(i).getCompletionDate(),listServiceFlowcoDto2.get(i+1).getCompletionDate());
								resultSet = dataExtractDao.getTransactionCountVolume(serviceFlowcoDto.getStationId(), serviceFlowcoDto.getPump(), serviceFlowcoDto.getGasType(), listServiceFlowcoDto2.get(i).getCompletionDate(), listServiceFlowcoDto2.get(i+1).getCreationDate());
								out.print("id: "+listServiceFlowcoDto2.get(i).getId());
								out.print("	creation: "+listServiceFlowcoDto2.get(i).getCreationDate());
								out.print("	completion: "+listServiceFlowcoDto2.get(i).getCompletionDate());
								out.println("	lifetime: "+lifetime);
								dataExtractDao.insertLifetime(listServiceFlowcoDto2.get(i).getId(), lifetime, problemCategory);
								if (resultSet.next()) {
									int transactionCount = resultSet.getInt(1);
									float totalVolume = resultSet.getFloat(2);
									int transactionDays = resultSet.getInt(3);
									out.print("transaction_count: "+transactionCount);
									out.println("	total_volume: "+totalVolume);
									dataExtractDao.insertTransactionCountVolume(listServiceFlowcoDto2.get(i).getId(), transactionCount, totalVolume, transactionDays, problemCategory);
									int daystoAction = dataExtractDao.getDaysToAction(listServiceFlowcoDto2.get(i).getId(), problemCategory);
									int adjustedTransaction = calculateAdjustedTransactionCountVolume((float)transactionCount, transactionDays, daystoAction, lifetime);
									int adjustedVolume = calculateAdjustedTransactionCountVolume(totalVolume, transactionDays, daystoAction, lifetime);
									dataExtractDao.updateAdjustedTransactionVolume(listServiceFlowcoDto2.get(i).getId(), adjustedTransaction, adjustedVolume, problemCategory);
								}
							}
						}
						out.println();
					}else {
						java.sql.Date currentDate = new java.sql.Date(System.currentTimeMillis());
						resultSet = dataExtractDao.getTransactionCountVolume(serviceFlowcoDto.getStationId(), serviceFlowcoDto.getPump(), serviceFlowcoDto.getGasType(), listServiceFlowcoDto2.get(0).getCompletionDate(), currentDate);
						out.println("Only one datapoint");
						out.print("id: "+listServiceFlowcoDto2.get(0).getId());
						out.print("	creation: "+listServiceFlowcoDto2.get(0).getCreationDate());
						out.print("	completion: "+listServiceFlowcoDto2.get(0).getCompletionDate());
						out.println("	lifetime: "+0);
						if (resultSet.next()) {
							int transactionCount = resultSet.getInt(1);
							float totalVolume = resultSet.getFloat(2);
							int transactionDays = resultSet.getInt(3);
							out.print("transaction_count: "+transactionCount);
							out.println("	total_volume: "+totalVolume);
							dataExtractDao.insertTransactionCountVolume(listServiceFlowcoDto2.get(0).getId(), transactionCount, totalVolume, transactionDays, problemCategory);
						}
						out.println();
						
					}
//				}else {
//					out.println("No gasType information");
//					out.println();
//				}
			}
			
			out.close(); // temp
			dataExtractDao.closeConnection(resultSet, statement, dataExtractDao.getConnection());
		} catch (Exception e) {
			dataExtractDao.closeConnection(resultSet, statement, dataExtractDao.getConnection());
			e.printStackTrace();
			System.err.println("Error extractDataLifetime()");
		}
	}
	
	public int getDifferenceDays(Date d1, Date d2) {
	    long diff = d2.getTime() - d1.getTime();
	    return (int) TimeUnit.DAYS.convert(diff, TimeUnit.MILLISECONDS);
	}
	
	public int calculateAdjustedTransactionCountVolume(float countVolume, int transactionDays, int daystoAction, int lifetime) {
		if (countVolume == 0 || transactionDays == 0|| lifetime == 0 ) {
			return 0;
		}else {
			return (int)((lifetime - daystoAction) * (float)countVolume / (float)transactionDays);
		}
	}
	
	public void extractDataProblemEncode(String problemCategory, HttpServletResponse response) {
		System.out.println("Generating problem type encoding...");
		Statement statement = null;
		ResultSet resultSet = null;
		try {
			dataExtractDao = new DataExtractDao("jdbc:MySQL://localhost:3306/data_clean", "root", "");
			PrintWriter out = response.getWriter(); //temporary
			resultSet = dataExtractDao.getProblemTypeByCategory(problemCategory);
			List<String> listProblemType = new ArrayList<>();
			while (resultSet.next()) {
				listProblemType.add(resultSet.getString(1));
			}
			resultSet = dataExtractDao.getDetailsExtractedData(problemCategory);
			List<ServiceFlowcoDto> listServiceFlowcoDto = new ArrayList<>();
			while (resultSet.next()) {
				ServiceFlowcoDto serviceFlowcoDto = new ServiceFlowcoDto();
				serviceFlowcoDto.setId(resultSet.getInt("id"));
				serviceFlowcoDto.setBusinessPartnerName(resultSet.getString("business_partner_name"));
				serviceFlowcoDto.setPump(resultSet.getInt("pump"));
				serviceFlowcoDto.setGasType(resultSet.getString("gas_type"));
				serviceFlowcoDto.setCreationDate(resultSet.getDate("creation_date"));
				listServiceFlowcoDto.add(serviceFlowcoDto);
			}
			for (ServiceFlowcoDto serviceFlowcoDto : listServiceFlowcoDto) {
				out.println(serviceFlowcoDto.getId());
				out.println(serviceFlowcoDto.getBusinessPartnerName());
				out.print("pump: "+serviceFlowcoDto.getPump());
				out.print("	gasType: "+serviceFlowcoDto.getGasType());
				out.println("	creation date: "+serviceFlowcoDto.getCreationDate());
				
				resultSet = dataExtractDao.getProblemTypeByDetails(serviceFlowcoDto.getBusinessPartnerName(), serviceFlowcoDto.getPump(), serviceFlowcoDto.getGasType(), serviceFlowcoDto.getCreationDate(), problemCategory);
				List<String> listProblemResult = new ArrayList<>();
				while (resultSet.next()) {
					listProblemResult.add(resultSet.getString(1));
				}
				List<Boolean> result = new ArrayList<>();
				for (String problemType : listProblemType) {
					if (listProblemResult.contains(problemType)) {
						result.add(true);
					}else {
						result.add(false);
					}
				}
				for (int i = 0; i < listProblemType.size(); i++) {
					out.println(listProblemType.get(i)+"	"+result.get(i));
				}
				dataExtractDao.insertProblemTypeEncode(serviceFlowcoDto.getId(), result, listProblemType, problemCategory);
				out.println();
			}
			
			out.close(); // temp
			dataExtractDao.closeConnection(resultSet, statement, dataExtractDao.getConnection());
		} catch (Exception e) {
			dataExtractDao.closeConnection(resultSet, statement, dataExtractDao.getConnection());
			e.printStackTrace();
			System.err.println("Error extractDataProblemEncode()");
		}
	}
	
	public void extractDataPartsEncode(String problemCategory, HttpServletResponse response) {
		System.out.println("Generating replacement parts encoding...");
		Statement statement = null;
		ResultSet resultSet = null;
		try {
			dataExtractDao = new DataExtractDao("jdbc:MySQL://localhost:3306/data_clean", "root", "");
			PrintWriter out = response.getWriter(); //temporary
			resultSet = dataExtractDao.getReplacementPartsByCategory(problemCategory);
			List<String> listReplacementParts = new ArrayList<>();
			while (resultSet.next()) {
				listReplacementParts.add(resultSet.getString(1));
			}
			resultSet = dataExtractDao.getDetailsExtractedData(problemCategory);
			List<ServiceFlowcoDto> listServiceFlowcoDto = new ArrayList<>();
			while (resultSet.next()) {
				ServiceFlowcoDto serviceFlowcoDto = new ServiceFlowcoDto();
				serviceFlowcoDto.setId(resultSet.getInt("id"));
				serviceFlowcoDto.setBusinessPartnerName(resultSet.getString("business_partner_name"));
				serviceFlowcoDto.setPump(resultSet.getInt("pump"));
				serviceFlowcoDto.setGasType(resultSet.getString("gas_type"));
				serviceFlowcoDto.setCreationDate(resultSet.getDate("creation_date"));
				listServiceFlowcoDto.add(serviceFlowcoDto);
			}
			for (ServiceFlowcoDto serviceFlowcoDto : listServiceFlowcoDto) {
				out.println(serviceFlowcoDto.getId());
				out.println(serviceFlowcoDto.getBusinessPartnerName());
				out.print("pump: "+serviceFlowcoDto.getPump());
				out.print("	gasType: "+serviceFlowcoDto.getGasType());
				out.println("	creation date: "+serviceFlowcoDto.getCreationDate());
				
				resultSet = dataExtractDao.getReplacementPartsByDetails(serviceFlowcoDto.getBusinessPartnerName(), serviceFlowcoDto.getPump(), serviceFlowcoDto.getGasType(), serviceFlowcoDto.getCreationDate(), problemCategory);
				List<String> listProblemResult = new ArrayList<>();
				while (resultSet.next()) {
					listProblemResult.add(resultSet.getString(1));
				}
				List<Boolean> result = new ArrayList<>();
				for (String replacementParts : listReplacementParts) {
					if (listProblemResult.contains(replacementParts)) {
						result.add(true);
					}else {
						result.add(false);
					}
				}
				for (int i = 0; i < listReplacementParts.size(); i++) {
					out.println(listReplacementParts.get(i)+"	"+result.get(i));
				}
				dataExtractDao.insertReplacementPartsEncode(serviceFlowcoDto.getId(), result, listReplacementParts, problemCategory);
				out.println();
			}
			
			out.close(); // temp
			dataExtractDao.closeConnection(resultSet, statement, dataExtractDao.getConnection());
		} catch (Exception e) {
			dataExtractDao.closeConnection(resultSet, statement, dataExtractDao.getConnection());
			e.printStackTrace();
			System.err.println("Error extractDataPartsEncode()");
		}
	}

	public void shiftEncodedData(String problemCategory, HttpServletResponse response) {
		System.out.println("Shifting encoded data...");
		Statement statement = null;
		ResultSet resultSet = null;
		try {
			dataExtractDao = new DataExtractDao("jdbc:MySQL://localhost:3306/data_clean", "root", "");
			PrintWriter out = response.getWriter(); //temporary
			resultSet = dataExtractDao.getIdentityExtractedData(problemCategory);
			List<ServiceFlowcoDto> listServiceFlowcoDto = new ArrayList<>();
			while (resultSet.next()) {
				ServiceFlowcoDto serviceFlowcoDto = new ServiceFlowcoDto();
				serviceFlowcoDto.setStationId(resultSet.getString("station_id"));
				serviceFlowcoDto.setPump(resultSet.getInt("pump"));
				serviceFlowcoDto.setGasType(resultSet.getString("gas_type"));
				listServiceFlowcoDto.add(serviceFlowcoDto);
			}
			
			for (ServiceFlowcoDto serviceFlowcoDto : listServiceFlowcoDto) {
				resultSet = dataExtractDao.getEncodedData(serviceFlowcoDto.getStationId(), serviceFlowcoDto.getPump(), serviceFlowcoDto.getGasType(), "problem", problemCategory);
				List<Integer> idList = new ArrayList<>();
				List<List<Boolean>> problemList = new ArrayList<>();
				while (resultSet.next()) {
					List<Boolean> problemEncodeList = new ArrayList<>();
					for (int i = 0; i < resultSet.getMetaData().getColumnCount() - 1; i++) {
						problemEncodeList.add(resultSet.getBoolean(i+1));
					}
					idList.add(resultSet.getInt("id"));
					problemList.add(problemEncodeList);
				}
				resultSet = dataExtractDao.getEncodedData(serviceFlowcoDto.getStationId(), serviceFlowcoDto.getPump(), serviceFlowcoDto.getGasType(), "parts", problemCategory);
				List<List<Boolean>> partsList = new ArrayList<>();
				while (resultSet.next()) {
					List<Boolean> partsEncodeList = new ArrayList<>();
					for (int i = 0; i < resultSet.getMetaData().getColumnCount() - 1; i++) {
						partsEncodeList.add(resultSet.getBoolean(i+1));
					}
					partsList.add(partsEncodeList);
				}
				for (int i = 0; i < idList.size(); i++) {
					if (i == idList.size()-1) {
						List<Boolean> falseProblemList = new ArrayList<>();
						for (int j = 0; j < problemList.get(i).size(); j++) {
							falseProblemList.add(false);
						}
						List<Boolean> falsePartsList = new ArrayList<>();
						for (int j = 0; j < partsList.get(i).size(); j++) {
							falsePartsList.add(false);
						}
						dataExtractDao.updateEncodeData(idList.get(i), falseProblemList, "problem", problemCategory);
						dataExtractDao.updateEncodeData(idList.get(i), falsePartsList, "parts", problemCategory);
					} else {
						dataExtractDao.updateEncodeData(idList.get(i), problemList.get(i+1), "problem", problemCategory);
						dataExtractDao.updateEncodeData(idList.get(i), partsList.get(i+1), "parts", problemCategory);
					}
				}
			}
			out.close(); // temp
			dataExtractDao.closeConnection(resultSet, statement, dataExtractDao.getConnection());
		} catch (Exception e) {
			dataExtractDao.closeConnection(resultSet, statement, dataExtractDao.getConnection());
			e.printStackTrace();
			System.err.println("Error shiftEncodedData()");
		}
	}
	
	////////////////////////////////////////////////// ver 2
	
	public void extractDataMesralinkPumpGasType(String stationId, HttpServletResponse response) {
		System.out.println("ExtractingPumpGas...	"+stationId);
		Statement statement = null;
		ResultSet resultSet = null;
		try {
			dataExtractDao = new DataExtractDao("jdbc:MySQL://localhost:3306/data_clean", "root", "");
			PrintWriter out = response.getWriter(); //temporary
			resultSet = dataExtractDao.getPumpByStationId(stationId);
			 List<ServiceMesralinkDto> listServiceMesralinkDto = new ArrayList<>();
			while (resultSet.next()) {
				ServiceMesralinkDto serviceMesralinkDto = new ServiceMesralinkDto();
				serviceMesralinkDto.setRawId(resultSet.getInt("raw_id"));
				serviceMesralinkDto.setCategory5(resultSet.getString("category_5").toLowerCase());
				listServiceMesralinkDto.add(serviceMesralinkDto);
			}
			for (ServiceMesralinkDto serviceMesralinkDto : listServiceMesralinkDto) {
				if (serviceMesralinkDto.getCategory5().equalsIgnoreCase("all pump")) {
					resultSet = dataExtractDao.getAllPumpByStationId(stationId);
					List<Integer> listPump = new ArrayList<>();
					while (resultSet.next()) {
						listPump.add(resultSet.getInt("pump"));
					}
					for (int i = 0; i < listPump.size(); i++) {
						if (i == 0) {
							dataExtractDao.updatePumpByRawId(serviceMesralinkDto.getRawId(), listPump.get(i));
						} else {
							dataExtractDao.insertDuplicatePumpByRawId(serviceMesralinkDto.getRawId(), listPump.get(i));
						}
					}
				} else {
					int pump = Integer.parseInt(serviceMesralinkDto.getCategory5().replace("pump", "").trim());
					dataExtractDao.updatePumpByRawId(serviceMesralinkDto.getRawId(), pump);
				}
			}
			
			out.close(); // temp
			dataExtractDao.closeConnection(resultSet, statement, dataExtractDao.getConnection());
		} catch (Exception e) {
			dataExtractDao.closeConnection(resultSet, statement, dataExtractDao.getConnection());
			e.printStackTrace();
			System.err.println("Error extractDataMesralinkPumpGasType()");
		}
	}
	
	public List<String> getListStationId() {
		System.out.println("Retriving station list...");
		Statement statement = null;
		ResultSet resultSet = null;
		List<String> stationIdList = new ArrayList<>();
		try {
			dataExtractDao = new DataExtractDao("jdbc:MySQL://localhost:3306/data_clean", "root", "");
			resultSet = dataExtractDao.getPilotStationId();
			while(resultSet.next()) {
				stationIdList.add(resultSet.getString("station_id"));
			}
			dataExtractDao.closeConnection(resultSet, statement, dataExtractDao.getConnection());
		} catch (Exception e) {
			dataExtractDao.closeConnection(resultSet, statement, dataExtractDao.getConnection());
			e.printStackTrace();
			System.err.println("Error getListPilotStation()");
		}
		return stationIdList;
	}
	
	public void extractedDataTable(HttpServletResponse response) {
		System.out.println("extractedDataTable...	");
		Statement statement = null;
		ResultSet resultSet = null;
		try {
			dataExtractDao = new DataExtractDao("jdbc:MySQL://localhost:3306/data_clean", "root", "");
			PrintWriter out = response.getWriter(); //temporary
			dataExtractDao.createExtractedDataTable();
			resultSet = dataExtractDao.getMissedGroupedDataDetails();
			List<ServiceMesralinkDto> listServiceMesralinkDto = new ArrayList<>();
			while (resultSet.next()) {
				ServiceMesralinkDto serviceMesralinkDto  = new ServiceMesralinkDto();
				serviceMesralinkDto.setStationId(resultSet.getString("station_id"));
				serviceMesralinkDto.setProblemCategory(resultSet.getString("problem_category"));
				serviceMesralinkDto.setPump(resultSet.getInt("pump"));
				serviceMesralinkDto.setGasType(resultSet.getString("gas_type"));
				serviceMesralinkDto.setCreationDate(resultSet.getDate("creation_date"));
				listServiceMesralinkDto.add(serviceMesralinkDto);
			}
			for (ServiceMesralinkDto serviceMesralinkDto : listServiceMesralinkDto) {
				resultSet = dataExtractDao.getCaseIdCompletionDateByDetails(serviceMesralinkDto.getStationId(), serviceMesralinkDto.getProblemCategory(), serviceMesralinkDto.getPump(), serviceMesralinkDto.getGasType(), serviceMesralinkDto.getCreationDate());
				List<ServiceMesralinkDto> listServiceMesralinkDto2 = new ArrayList<>();
				while (resultSet.next()) {
					ServiceMesralinkDto serviceMesralinkDto2  = new ServiceMesralinkDto();
					serviceMesralinkDto2.setCaseId(resultSet.getString("case_id"));
					serviceMesralinkDto2.setCompletionDate(resultSet.getDate("completion_date"));
					listServiceMesralinkDto2.add(serviceMesralinkDto2);
				}
				Set<String> caseIdSet = new HashSet<String>();
				Set<Date> completionDateSet = new HashSet<Date>();
				for (int i = 0; i < listServiceMesralinkDto2.size(); i++) {
					if (i == listServiceMesralinkDto2.size()-1) {
						caseIdSet.remove(listServiceMesralinkDto2.get(i).getCaseId());
						completionDateSet.remove(listServiceMesralinkDto2.get(i).getCompletionDate());
						dataExtractDao.updateCaseIdCompletionDateByDetails(listServiceMesralinkDto2.get(i).getCaseId(), listServiceMesralinkDto2.get(i).getCompletionDate(), serviceMesralinkDto.getStationId(), serviceMesralinkDto.getProblemCategory(), serviceMesralinkDto.getPump(), serviceMesralinkDto.getGasType(), serviceMesralinkDto.getCreationDate());
					} else {
						caseIdSet.add(listServiceMesralinkDto2.get(i).getCaseId());
						completionDateSet.add(listServiceMesralinkDto2.get(i).getCompletionDate());
					}
				}
				if (caseIdSet.size() > 0) {
					String note = "Additional CASE ID :";
					for(String caseId : caseIdSet) {
					    note += " "+caseId;
					}
					note += ". ";
					dataExtractDao.insertNoteByDetails(note, serviceMesralinkDto.getStationId(), serviceMesralinkDto.getProblemCategory(), serviceMesralinkDto.getPump(), serviceMesralinkDto.getGasType(), serviceMesralinkDto.getCreationDate());
				}
				if (completionDateSet.size() > 0) {
					String note = "Additional COMPLETION DATE :";
					for(Date completionDate : completionDateSet) {
					    note += " "+completionDate.toString();
					}
					note += ". ";
					dataExtractDao.insertNoteByDetails(note, serviceMesralinkDto.getStationId(), serviceMesralinkDto.getProblemCategory(), serviceMesralinkDto.getPump(), serviceMesralinkDto.getGasType(), serviceMesralinkDto.getCreationDate());
				}
			}
			
			
			out.close(); // temp
			dataExtractDao.closeConnection(resultSet, statement, dataExtractDao.getConnection());
		} catch (Exception e) {
			dataExtractDao.closeConnection(resultSet, statement, dataExtractDao.getConnection());
			e.printStackTrace();
			System.err.println("Error extractedDataTable()");
		}
	}
	
	
	public void runTest(String problemCategory, HttpServletResponse response) {
		System.out.println("Running test...");
		Statement statement = null;
		ResultSet resultSet = null;
		try {
			dataExtractDao = new DataExtractDao("jdbc:MySQL://localhost:3306/data_clean", "root", "");
			PrintWriter out = response.getWriter(); //temporary
			
			dataExtractDao.getTest(problemCategory);
			
			out.close(); // temp
			dataExtractDao.closeConnection(resultSet, statement, dataExtractDao.getConnection());
		} catch (Exception e) {
			dataExtractDao.closeConnection(resultSet, statement, dataExtractDao.getConnection());
			e.printStackTrace();
			System.err.println("Error extractDataPumpGasType()");
		}
	}
	
	
	public void exportToCSV(String problemCategory, HttpServletResponse response) throws Exception {
		System.out.println("Exporting to CSV...");
		Statement statement = null;
		ResultSet resultSet = null;
		FileWriter writer = null;
		String location = "C:/Users/war09/Desktop";
		String fileName = "result_"+problemCategory+".csv";
		try {
			writer = new FileWriter(location + "/" + fileName);
			dataExtractDao = new DataExtractDao("jdbc:MySQL://localhost:3306/data_clean", "root", "");
			PrintWriter out = response.getWriter(); //temporary
			List<String> title = new ArrayList<String>();
			List<String> distribution = new ArrayList<String>();
			title.add("station_id");
			title.add("pump");
			title.add("gas_type");
			title.add("startdate_lifetime");//completion_date
			title.add("transaction_count");
			title.add("adjusted_transaction_count");
			title.add("total_volume");
			title.add("adjusted_total_volume");
			
//			distribution.add("");
//			distribution.add("");
//			distribution.add("");
//			distribution.add("");
//			distribution.add("");
//			distribution.add("");
//			distribution.add("");
//			distribution.add("distribution");
			resultSet = dataExtractDao.getProblemTypeByCategory(problemCategory);
			while (resultSet.next()) {
				String temp = resultSet.getString(1).replace(" ", "_").replace("-", "_");
				title.add(temp);
//				distribution.add(dataExtractDao.getTotalBooleanYesUnused(temp, "problem", problemCategory));
			}
			resultSet = dataExtractDao.getReplacementPartsByCategory(problemCategory);
			while (resultSet.next()) {
				String temp = resultSet.getString(1).replace(" ", "_").replace("-", "_");
				title.add(temp);
//				distribution.add(dataExtractDao.getTotalBooleanYesUnused(temp, "parts", problemCategory));
			}
			title.add("lifetime");
//			distribution.add("");
//			writeLine(writer, distribution, ',', '"');
			writeLine(writer, title, ',', '"');
			resultSet = dataExtractDao.getResultTable(problemCategory);
			while (resultSet.next()) {
				List<String> row = new ArrayList<String>();
				for (int i = 0; i < resultSet.getMetaData().getColumnCount(); i++) {
					row.add(resultSet.getString(i+1));
				}
				writeLine(writer, row, ',', '"');
			}
			out.close(); // temp
			writer.close();
			dataExtractDao.closeConnection(resultSet, statement, dataExtractDao.getConnection());
		} catch (Exception e) {
			writer.close();
			dataExtractDao.closeConnection(resultSet, statement, dataExtractDao.getConnection());
			e.printStackTrace();
			System.err.println("Error exportToCSV()");
		}
	}
	////////////////////////////////////////CSV Writer start
	private static final char DEFAULT_SEPARATOR = ',';

	private static String followCVSformat(String value) {
	String result = value;
		if (result.contains("\"")) {
			result = result.replace("\"", "\"\"");
		}
		return result;
	}
	
	private static void writeLine(Writer w, List<String> values, char separators, char customQuote) throws IOException {
		boolean first = true;
		//default customQuote is empty
		if (separators == ' ') {
			separators = DEFAULT_SEPARATOR;
		}
		StringBuilder sb = new StringBuilder();
		for (String value : values) {
			if (!first) {
				sb.append(separators);
			}
			if (customQuote == ' ') {
				sb.append(followCVSformat(value));
			} else {
				sb.append(customQuote).append(followCVSformat(value)).append(customQuote);
			}
			first = false;
		}
		sb.append("\r\n");
		w.append(sb.toString());
	}
	//////////////////////////////////////// CSV Writer end
}
