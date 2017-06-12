<?php
class BaseConnector
{
	public function __construct()
	{
		//load cofig properties
		//connect with the loaded ip + port
	}
	

	public function fireEsQuery($elastic_query)
	{
		//fire the query to elastic and return the result
		$time_start = microtime(true);
		$curl_response = curl_exec($elastic_query);
		$time_end=microtime(true);

		$json_pretty = json_decode($curl_response,true);
	
		echo($time_end-$time_start);
		print_r($json_pretty);
		return $json_pretty;
		// return $result;	
	}
	public function fireMongoQuery($mongo_query)
	{

	}
	//currently not in use
	public function updateEsQuery($campaign_objectID)
	{
		//update capaigns status to ACTIVE
		return $result;	
	}

}
?>