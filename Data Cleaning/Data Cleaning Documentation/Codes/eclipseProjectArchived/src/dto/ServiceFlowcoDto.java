package dto;

import java.sql.Date;
import java.sql.Time;

public class ServiceFlowcoDto {
	int id;
	String stationId;
	int rawId;
	String businessPartnerName;
	String problemDescription;
	Date creationDate;
	Time creationTime;
	String case_id;
	String problemType;
	String resolution;
	String replacementPartsNo;
	Date completionDate;
	Time completionTime;
	int pump;
	String gasType;
	int daysToAction;
	int lifetime;
	
	public ServiceFlowcoDto() {
	}

	public int getId() {
		return id;
	}

	public void setId(int id) {
		this.id = id;
	}

	public String getStationId() {
		return stationId;
	}

	public void setStationId(String stationId) {
		this.stationId = stationId;
	}

	public int getRawId() {
		return rawId;
	}

	public void setRawId(int rawId) {
		this.rawId = rawId;
	}

	public String getBusinessPartnerName() {
		return businessPartnerName;
	}

	public void setBusinessPartnerName(String businessPartnerName) {
		this.businessPartnerName = businessPartnerName;
	}

	public String getProblemDescription() {
		return problemDescription;
	}

	public void setProblemDescription(String problemDescription) {
		this.problemDescription = problemDescription;
	}

	public Date getCreationDate() {
		return creationDate;
	}

	public void setCreationDate(Date creationDate) {
		this.creationDate = creationDate;
	}

	public Time getCreationTime() {
		return creationTime;
	}

	public void setCreationTime(Time creationTime) {
		this.creationTime = creationTime;
	}

	public String getCase_id() {
		return case_id;
	}

	public void setCase_id(String case_id) {
		this.case_id = case_id;
	}

	public String getProblemType() {
		return problemType;
	}

	public void setProblemType(String problemType) {
		this.problemType = problemType;
	}

	public String getResolution() {
		return resolution;
	}

	public void setResolution(String resolution) {
		this.resolution = resolution;
	}

	public String getReplacementPartsNo() {
		return replacementPartsNo;
	}

	public void setReplacementPartsNo(String replacementPartsNo) {
		this.replacementPartsNo = replacementPartsNo;
	}

	public Date getCompletionDate() {
		return completionDate;
	}

	public void setCompletionDate(Date completionDate) {
		this.completionDate = completionDate;
	}

	public Time getCompletionTime() {
		return completionTime;
	}

	public void setCompletionTime(Time completionTime) {
		this.completionTime = completionTime;
	}

	public int getPump() {
		return pump;
	}

	public void setPump(int pump) {
		this.pump = pump;
	}

	public String getGasType() {
		return gasType;
	}

	public void setGasType(String gasType) {
		this.gasType = gasType;
	}

	public int getDaysToAction() {
		return daysToAction;
	}

	public void setDaysToAction(int daysToAction) {
		this.daysToAction = daysToAction;
	}

	public int getLifetime() {
		return lifetime;
	}

	public void setLifetime(int lifetime) {
		this.lifetime = lifetime;
	}
	
}
