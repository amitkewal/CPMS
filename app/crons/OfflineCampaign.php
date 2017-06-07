<?php
class OfflineCron
{
	run()
	{
		$result=$this->getOfflineEligibleCampaign();
		$counter=count($result);
		while(($counter--)>0)
		{
		//for each campaign fork the child process
			
		pcntl_fork();
		//forming query
		$fetch_campaign_criteria_query=formQuery(where campaign_metadata objectId= campaign_criteria_id);
		//singleton
		// $connector=new {Es or Mongo}Connector();
		//mark the respective campaign ACTIVE
		//result 
		// $result=$connector->fire{Es or Mongo}Query($fetch_campaign_criteria_query);
		$scroll=new scrollAPI_Service($fetch_campaign_criteria_query)
		$croll->scrollJob($result);
		}
	
	}
	private function getOfflineEligibleCampaign()
	{
		//forming query and time comparision will be hourly / minutes / seconds base??
		$offline_campaign_query=formQuery(where schedule_time=current_time);
		// singleton
		$connector=new {Es or Mongo}Connector();
		//result will have the campains info which have to be started
		$result=$connect->fire{Es or Mongo}Query($offline_campaign_query);
		
	}
	private function formQuery()
	{
		//construct the query for fetching campaigns where schedule_time=current_time
		return $query;
	}
}

$dummy=new OfflineCron();
$dummy->run();

?>