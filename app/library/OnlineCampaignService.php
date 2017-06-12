<?php
include("/home/amitkewal/Documents/CPMS/app/library/BaseConnector.php");
/**
* 
*/
class OnlineCampaignService  
{
	private $member_info;
	private $channel;

	function __construct($member_info,$channel)
	{
		# code...
		$this->member_info=$member_info;
		$this->channel=$channel;
	}
	public function getAllAggregationESCampaignQueries()
	{
		$criteria_matching_query=$this->formESQuery($this->member_info);//forming query
		$connector=new BaseConnector();// singleton
		$aggregate_query=$connector->fireEsQuery($criteria_matching_query);
		// exit("till here");
		return $aggregate_query["aggregations"];
		
	}
	public function getEligibleCampaign($member_agg_info)
	{
		//get the campaign info after processing		
		$response=$this->processResult($member_agg_info);
		return $response;
	}
	
	private function formESQuery($member_info)
	{
		//construct the query for fetching campaigns
		//AGGEGATION QUERY
		$service_url = 'http://10.10.0.73:9200/male/profiles/_search';
		$curl = curl_init($service_url);
		$curl_post_data = '{
			"query":{
			    "bool":{
			        "filter":{
			        	"term":{
			        		"memberlogin": "$member_info"
			        	}
			        }
				}
			},
			"size":"0",
			"aggs": {
				"camp1": {
			        "filter": {
			        	"bool":{
			        		"filter":
			                    {"bool":{"must":[{"term":{"caste": "37"}},{"term":{"age": "32"}}]}}
			        		
			        	}
			        }
			    },
			    "camp2": {
			        "filter": {
			        	"bool":{
			        		"filter":
			                    {"bool":{"must":[{"term":{"countryofresidence": "11"}},{"term":{"age": "32"}}]}}
			        		
			        	}
			        }
			    },
			    "camp3": {
			        "filter": {
			        	"bool":{
			        		"filter":
			                    {"bool":{"must":{"term":{"caste": "37"}}}}
			        		
			        	}
			        }
			    },
			    "camp4": {
			        "filter": {
			        	"bool":{
			        		"filter":
			                    {"bool":{"must":{"term":{"complexion": "Very Fair"}}}}
			        	}
			        }
			    },
			    "camp5": {
			        "filter": {
			        	"bool":{
			        		"filter":
			                    {"bool":{"must":[{"term":{"complexion": "Very Fair"}},{"term":{"age": "32"}}]}}
			        		
			        	}
			        }
			    }
			               
			}
		}';

		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $curl_post_data);
		return $curl;
		////////////////////////////////////////////////////////////
		
	}
	
	private function processESResult()
	{
		//based on precedence and category
		//After this create payload
		return createChannelPayload();
	}
	
	private function createchannelPayload($channel)
	{
		//replace placeholder


		switch ($channel) {
			case (in_array($channel, array('ProfileBanner','ShaadiBanner','PaymentBanner'))?"$channel":false):
				$payload=new BannerPayloadService();
				$variableFunctionCall='get'.$channel.'Payload';
				$finalPayload=$payload->$variableFunctionCall();
				break;
			
			case (in_array($channel, array('MobileLayer','WebLayer','AndroidLayer','IosLayer'))?"$channel":false):
				$variableFunctionCall=new LayerPayloadService();
				$finalPayload=$payload->variableFunctionCall();
				break;

			case (in_array($channel, array('FamilyDetails','AstroDetails'))?"$channel":false):
				$variableFunctionCall=new StopPagePayloadService();
				$finalPayload=$payload->variableFunctionCall();
				break;
			
			case (in_array($channel, array('SpecialPromo'))?"$channel":false):
				$variableFunctionCall=new SpecialPromoPayloadService();
				$finalPayload=$payload->variableFunctionCall();
				break;

			default:
				# code...
				break;
		}
		return $finalPayload;
	}
		
}

?>
