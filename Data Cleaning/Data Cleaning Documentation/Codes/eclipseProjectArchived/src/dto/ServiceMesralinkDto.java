package dto;

import java.sql.Date;

public class ServiceMesralinkDto {
	int id;
	int rawId;
	String caseId;
	String stationId;
	String stationName;
	Date creationDate;
	Date completionDate;
	String problemCategory;
	String problemType;
	String category5;
	String gasType;
	String dealerVendor;
	int daysToAction;
	int pump;
	public int getId() {
		return id;
	}
	public void setId(int id) {
		this.id = id;
	}
	public int getRawId() {
		return rawId;
	}
	public void setRawId(int rawId) {
		this.rawId = rawId;
	}
	public String getCaseId() {
		return caseId;
	}
	public void setCaseId(String caseId) {
		this.caseId = caseId;
	}
	public String getStationId() {
		return stationId;
	}
	public void setStationId(String stationId) {
		this.stationId = stationId;
	}
	public String getStationName() {
		return stationName;
	}
	public void setStationName(String stationName) {
		this.stationName = stationName;
	}
	public Date getCreationDate() {
		return creationDate;
	}
	public void setCreationDate(Date creationDate) {
		this.creationDate = creationDate;
	}
	public Date getCompletionDate() {
		return completionDate;
	}
	public void setCompletionDate(Date completionDate) {
		this.completionDate = completionDate;
	}
	public String getProblemCategory() {
		return problemCategory;
	}
	public void setProblemCategory(String problemCategory) {
		this.problemCategory = problemCategory;
	}
	public String getProblemType() {
		return problemType;
	}
	public void setProblemType(String problemType) {
		this.problemType = problemType;
	}
	public String getCategory5() {
		return category5;
	}
	public void setCategory5(String category5) {
		this.category5 = category5;
	}
	public String getGasType() {
		return gasType;
	}
	public void setGasType(String gasType) {
		this.gasType = gasType;
	}
	public String getDealerVendor() {
		return dealerVendor;
	}
	public void setDealerVendor(String dealerVendor) {
		this.dealerVendor = dealerVendor;
	}
	public int getDaysToAction() {
		return daysToAction;
	}
	public void setDaysToAction(int daysToAction) {
		this.daysToAction = daysToAction;
	}
	public int getPump() {
		return pump;
	}
	public void setPump(int pump) {
		this.pump = pump;
	}
	
}
