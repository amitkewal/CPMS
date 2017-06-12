<?php

class ProfileService
{
	public function __construct()
	{

	}
	public function getprofileDetails($memberlogin)
	{
		$elastic_query=$this->formESQuery($memberlogin);
		$connector=new BaseConnector();// singleton
		// $fire=new QueryController();
		$member_info=$connector->fireEsQuery($elastic_query);
		return $member_info;

		
	}
	private function formESQuery($memberlogin)
	{

		//construct the elastic query
		$service_url = 'http://10.10.0.24:9200/male,female/profiles/_search';
		$curl = curl_init($service_url);
		$curl_post_data=' 
		 {
		  "query": { "match": { "memberlogin": "iSH94964599" } },
		  "_source": ["memberlogin", "age"]
		}';
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $curl_post_data);

		return $curl;
	}

	

}
?>
