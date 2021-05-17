package servlet;

import controller.DataExtractController;

import java.io.IOException;
import java.io.PrintWriter;
import java.sql.SQLException;
import java.util.ArrayList;
import java.util.List;

import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

/**
 * Servlet implementation class first
 */
@WebServlet("/RunScript")
public class DataExtractServlet extends HttpServlet {
	private static final long serialVersionUID = 1L;
	DataExtractController dataExtractController;

	/**
	 * @see HttpServlet#doGet(HttpServletRequest request, HttpServletResponse response)
	 */
	protected void doGet(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		dataExtractController = new DataExtractController();
		String action = request.getParameter("action").toLowerCase();
		int rankParts = Integer.parseInt(request.getParameter("rankParts"));
		int rankStations = Integer.parseInt(request.getParameter("rankStations"));
		String problemCategory = request.getParameter("problemCategory").toLowerCase();
		try {
			
			if (action.equalsIgnoreCase("all")) {
				dataExtractController.extractDataDate(rankStations, problemCategory,response);
				dataExtractController.extractDataPumpGasType(rankStations, problemCategory,response);
				dataExtractController.executeScript(rankStations, problemCategory, 1);
				dataExtractController.executeScript(rankStations, problemCategory, 2);
				dataExtractController.executeScript(rankStations, problemCategory, 3);
				dataExtractController.executeScript(rankStations, problemCategory, 4);
				dataExtractController.extractDataLifetime(problemCategory, response);
				dataExtractController.executeScript(rankStations, problemCategory, 5);
				dataExtractController.extractDataProblemEncode(problemCategory, response);
				dataExtractController.executeScript(rankStations, problemCategory, 6);
				dataExtractController.extractDataPartsEncode(problemCategory, response);
				dataExtractController.shiftEncodedData(problemCategory, response);
				dataExtractController.exportToCSV(problemCategory, response);
			}else if (action.equalsIgnoreCase("loop")) {
				int [] station11 = {0,4,9,54,70,118,405};
				for (int i : station11) {
//				for (int i = 0; i <= rankStations; i++) {
					dataExtractController.extractDataDate(i, problemCategory,response);
					dataExtractController.extractDataPumpGasType(i, problemCategory,response);
				}
				dataExtractController.executeScript(0, problemCategory, 1);
				for (int i : station11) {
//				for (int i = 0; i <= rankStations; i++) {
					dataExtractController.executeScript(i, problemCategory, 2);
					dataExtractController.executeScript(i, problemCategory, 3);
				}
				dataExtractController.executeScript(0, problemCategory, 4);
				dataExtractController.extractDataLifetime(problemCategory, response);
				dataExtractController.executeScript(0, problemCategory, 5);
				dataExtractController.extractDataProblemEncode(problemCategory, response);
				dataExtractController.executeScript(0, problemCategory, 6);
				dataExtractController.extractDataPartsEncode(problemCategory, response);
				dataExtractController.shiftEncodedData(problemCategory, response);
				dataExtractController.exportToCSV(problemCategory, response);
			}else if (action.equalsIgnoreCase("date")) {
				dataExtractController.extractDataDate(rankStations, problemCategory,response);
			}else if (action.equalsIgnoreCase("pump")) {
				dataExtractController.extractDataPumpGasType(rankStations, problemCategory,response);
			}else if (action.equalsIgnoreCase("script1")) {
				dataExtractController.executeScript(rankStations, problemCategory, 1);
				dataExtractController.executeScript(rankStations, problemCategory, 2);
				dataExtractController.executeScript(rankStations, problemCategory, 3);
				dataExtractController.executeScript(rankStations, problemCategory, 4);
			}else if (action.equalsIgnoreCase("lifetime")) {
				dataExtractController.extractDataLifetime(problemCategory, response);
			}else if (action.equalsIgnoreCase("encode")) {
				dataExtractController.executeScript(rankStations, problemCategory, 5);
				dataExtractController.extractDataProblemEncode(problemCategory, response);
				dataExtractController.executeScript(rankStations, problemCategory, 6);
				dataExtractController.extractDataPartsEncode(problemCategory, response);
				dataExtractController.shiftEncodedData(problemCategory, response);
			}else if (action.equalsIgnoreCase("export")) {
				dataExtractController.exportToCSV(problemCategory, response);
			}
			
			//////////////////////////////////////////////////// ver 2
			
			if (action.equalsIgnoreCase("tester")) {
				List<String> listStationId = new ArrayList<>();
				listStationId = dataExtractController.getListStationId();
				for (String stationId : listStationId) {
					dataExtractController.extractDataMesralinkPumpGasType(stationId, response);
				}
				dataExtractController.extractedDataTable(response);
			}
			
			
			if (action.equalsIgnoreCase("test")) {
				dataExtractController.runTest(problemCategory, response);
			}
			else if (action.equalsIgnoreCase("test2")) {
				for (int i = rankStations; i <= rankStations+50; i++) {
//					dataExtractController.extractDataDate(i, problemCategory,response);
					dataExtractController.extractDataPumpGasType(i, problemCategory,response);
				}
			}
		} catch (Exception e) {
			e.printStackTrace();
			throw new ServletException(e.getMessage());
		}
	}

	/**
	 * @see HttpServlet#doPost(HttpServletRequest request, HttpServletResponse response)
	 */
	protected void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		// TODO Auto-generated method stub
		doGet(request, response);
	}

}
