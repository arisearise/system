<?php
require_once 'Base.php';

class company extends Base 
{
  
	public function setCompany()
	{
		$sql =<<<SQL
SELECT * FROM prefectures LIMIT 1000
SQL;
	$res=$this->getAll($sql);
	return $res;
	}
	
	public function setLocalCode($localcode)
	{
		$param['localcode'] = $localcode;
		$sql =<<<SQL
SELECT * FROM localcode WHERE company_location LIKE '%{$param['localcode']}%'
SQL;
		$res=$this->getOne($sql,$param);
		if (isset($res['localcode'])){
            return $res['localcode'];
        } else {
            echo '<pre>'; var_dump($sql,$param);
        }
	}
	public function insertYahoorecruitApi($Result){ 
			$param['jobId'] = $Result['jobId'];
			$param['corporationId'] = $Result['corporationId'];
			$param['yahooRecruitApi_json'] = json_encode($Result);
			/*$param['startDate'] =  $Result['startDae'];
			$param['updatedDate'] =  $Result['updatedDate'];
			$param['endDate'] =  $Result['endDate'];
			$param['status'] =  $Result['status'];
			$param['title'] =  $Result['title'];
			$param['postalCode'] =  intval($Result['postalCode']);
			$param['localGovernmentCode'] =  intval($Result['localGovernmentCode']);
			$param['workLocationPrefecture'] =  $Result['workLocationPrefecture'];
			$param['workLocationCity'] =  $Result['workLocationCity'];
			$param['workLocationTown'] =  $Result['workLocationTown'];
			$param['workLocationBlock'] =  $Result['workLocationBlock'];
			$param['workLocationBuilding'] =  $Result['workLocationBuilding'];
			$param['accessRoute'] =  $Result['accessRoute'];
			$param['industryCode'] =  $Result['industryCode'];
			$param['officeAtmosphere'] =  $Result['officeAtmosphere'];
			$param['employmentTypeCode'] =  $Result['employmentTypeCode'];
			$param['employmentTypeNote'] =  $Result['employmentTypeNote'];
			$param['employmentPeriodCode'] =  $Result['employmentPeriodCode'];
			$param['employmentPeriodStart'] =  $Result['employmentPeriodStart'];
			$param['employmentPeriodEnd'] =  $Result['employmentPeriodEnd'];
			$param['employmentPeriodNote'] =  $Result['employmentPeriodNote'];
			$param['occupationCode'] =  $Result['occupationCode'];
			$param['occupationName'] =  $Result['occupationName'];
			$param['description'] =  $Result['description'];
			$param['imgUrlPc'] =  $Result['imgUrlPc'];
			$param['imgUrlSp'] =  $Result['imgUrlSp'];
			$param['offerNumber'] =  $Result['offerNumber'];
			$param['workingDayCode'] =  $Result['workingDayCode'];
			$param['workingDayNote'] =  $Result['workingDayNote'];
			$param['workingTimeStart'] =  $Result['workingTimeStart'];
			$param['workingTimeEnd'] =  $Result['workingTimeEnd'];
			$param['workingTimeNote'] =  $Result['workingTimeNote'];
			$param['breakTimeStart'] =  $Result['breakTimeStart'];
			$param['breakTimeEnd'] =  $Result['breakTimeEnd'];
			$param['breakTimeNote'] =  $Result['breakTimeNote'];
			$param['flexTime'] =  $Result['flexTime'];
			$param['flexTimeNote'] =  $Result['flexTimeNote'];
			$param['holidayCode'] =  $Result['holidayCode'];
			$param['holidayNote'] =  $Result['holidayNote'];
			$param['overTime'] =  $Result['overTime'];
			$param['overTimeAverage'] =  $Result['overTimeAverage'];
			$param['salaryTypeCode'] =  $Result['salaryTypeCode'];
			$param['workingHours'] =  $Result['workingHours'];
			$param['salaryMax'] =  $Result['salaryMax'];
			$param['salaryMin'] =  $Result['salaryMin'];
			$param['salaryMaxTraining'] =  $Result['salaryMaxTraining'];
			$param['salaryMinTraining'] =  $Result['salaryMinTraining'];
			$param['salaryNote'] =  $Result['salaryNote'];
			$param['payRise'] =  $Result['payRise'];
			$param['payRiseNote'] =  $Result['payRiseNote'];
			$param['bonus'] =  $Result['bonus'];
			$param['bonusNote'] =  $Result['bonusNote'];
			$param['transportationFee'] =  $Result['transportationFee'];
			$param['transportationFeeNote'] =  $Result['transportationFeeNote'];
			$param['allowance'] =  $Result['allowance'];
			$param['allowanceNote'] =  $Result['allowanceNote'];
			$param['insuranceNote'] =  $Result['insuranceNote'];
			$param['retirementAllowance'] =  $Result['retirementAllowance'];
			$param['retirementAllowanceNote'] =  $Result['retirementAllowanceNote'];
			$param['retirement'] =  $Result['retirement'];
			$param['retirementAge'] =  $Result['retirementAge'];
			$param['retirementAgeNote'] =  $Result['retirementAgeNote'];
			$param['carCommuting'] =  $Result['carCommuting'];
			$param['carCommutingNote'] =  $Result['carCommutingNote'];
			$param['welfare'] =  $Result['welfare'];
			$param['subsidy'] =  $Result['subsidy'];
			$param['subsidyImmigration'] =  $Result['subsidyImmigration'];
			$param['subsidyNote'] =  $Result['subsidyNote'];
			$param['subsidyMax'] =  $Result['subsidyMax'];
			$param['subsidyMin'] =  $Result['subsidyMin'];
			$param['requiredAcademicBackground'] =  $Result['requiredAcademicBackground'];
			$param['requiredExperience'] =  $Result['requiredExperience'];
			$param['requiredLicense'] =  $Result['requiredLicense'];
			$param['requiredPersonality'] =  $Result['requiredPersonality'];
			$param['requiredWelcome'] =  $Result['requiredWelcome'];
			$param['ageLimit'] =  $Result['ageLimit'];
			$param['ageLimitDivision'] =  $Result['ageLimitDivision'];
			$param['ageLimitDetail'] =  $Result['ageLimitDetail'];
			$param['ageLimitReason'] =  $Result['ageLimitReason'];
			$param['trialPeriod'] =  $Result['trialPeriod'];
			$param['trialPeriodNote'] =  $Result['trialPeriodNote'];
			$param['employmentDisabled'] =  $Result['employmentDisabled'];
			$param['employmentDisabledNote'] =  $Result['employmentDisabledNote'];
			$param['receptionMethod'] =  $Result['receptionMethod'];
			$param['receptionTel'] =  $Result['receptionTel'];
			$param['receptionMail'] =  $Result['receptionMail'];
			$param['receptionUrl'] =  $Result['receptionUrl'];
			$param['receptionForm'] =  $Result['receptionForm'];
			$param['cpName'] =  $Result['cpName'];
			$param['yJobId'] =  $Result['yJobId'];*/

			
		$sql = <<<SQL
INSERT INTO recruit_json VALUES(
  :corporationId
, :jobId
, :yahooRecruitApi_json
)
SQL;
		$result = $this->execute($sql,$param);
		if($result){
			return $result;
		} else {
			echo '<pre>'; var_dump($sql,$param);
		}
			
	}
	public function getYahooRecruitApi($corporationId)
	{
		$param['corporationId'] = $corporationId;
		$sql = <<<SQL
SELECT * FROM recruit_json WHERE corporationId = :corporationId
SQL;
	return $this->getOne($sql,$param);
	}
	
	public function insertYahooCompanyApi($Result)
	{
			$param['corporationId'] = $Result['corporationId'];
			$param['name'] = $Result['name'];
			$param['yahooCompanyApi_json'] = json_encode($Result);
			/*$param['nameKana'] = $Result['nameKana'];
			$param['nameEn'] = $Result['nameEn'];
			$param['postalCode'] = $Result['postalCode'];
			$param['localGovernmentCode'] = $Result['localGovernmentCode'];
			$param['Prefecture'] = $Result['prefecture'];
			$param['City'] = $Result['city'];
			$param['Town'] = $Result['town'];
			$param['Block'] = $Result['block'];
			$param['Building'] = $Result['building'];
			$param['presidentPosition'] = $Result['presidentPosition'];
			$param['presidentName'] = $Result['presidentName'];
			$param['capital'] = $Result['capital'];
			$param['employees'] = $Result['employees'];
			$param['establishmentDate'] = $Result['establishmentDate'];
			$param['listed'] = $Result['listed'];
			$param['stockCode'] = $Result['stockCode'];
			$param['averageAge'] = $Result['averageAge'];
			$param['femaleRate'] = $Result['femaleRate'];
			$param['averageAnnualIncome'] = $Result['averageAnnualIncome'];
			$param['paidHolidayDigestibility'] = $Result['paidHolidayDigestibility'];
			$param['turnoverRate'] = $Result['turnoverRate'];
			$param['femaleManagerRate'] = $Result['femaleManagerRate'];
			$param['handicappedEmployeeRate'] = $Result['handicappedEmployeeRate'];
			$param['averageDuration'] = $Result['averageDuration'];
			$param['sales'] = $Result['sales'];
			$param['salesDate'] = $Result['salesDate'];
			$param['currentEarnings'] = $Result['currentEarnings'];
			$param['currentEarningsDate'] = $Result['currentEarningsDate'];
			$param['branch'] = $Result['branch'];
			$param['facebookUrl'] = $Result['facebookUrl'];
			$param['twitterUrl'] = $Result['twitterUrl'];
			$param['tel'] = $Result['tel'];
			$param['webUrl'] = $Result['webUrl'];
			$param['logoImgUrlPc'] = $Result['logoImgUrlPc'];
			$param['logoImgUrlSp'] = $Result['logoImgUrlSp'];
			$param['prText'] = $Result['prText'];
			$param['remarks'] = $Result['remarks'];
			$param['cpName'] = $Result['cpName'];*/
					
		$sql= <<<SQL
INSERT INTO company_json VALUES(
  :corporationId
, :name
, :yahooCompanyApi_json
)
SQL;
	
	$result = $this->execute($sql,$param);
		if($result){
			return $result;
		} else {
			echo '<pre>'; var_dump($sql,$param);
		}
			
	}
}
