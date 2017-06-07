<?php
include('/home/amitkewal/Documents/CPMS/app/library/OnlineCampaignService.php');
include('/home/amitkewal/Documents/CPMS/app/library/ProfileService.php');
class OnlineCampaignController extends \Phalcon\Mvc\Controller
{

    public $memberlogin;
	public $channel;
    public function indexAction()
    {

    }
	// public function __construct()
	// {
	// }
	public function getCampaignPayload($memberlogin,$channel)
	{
		echo '------'.$this->memberlogin=$memberlogin;
		echo '------'.$this->channel=$channel;
		$campaignService= new OnlineCampaignService($this->memberlogin,$this->channel);
		$aggQueries=$campaignService->getAllAggregationESCampaignQueries();
		
		//For profile ES query with memberlogin and aggQueires
		$info=new ProfileService();
		$member_agg_info=$info->getprofileDetails($this->memberlogin);//fetch member info
		exit("PPPPPPPPPPPPPPPPPPPPPPPPP");
		//expected result
		/*
		{
			ml:uSH897asd
			agg:
			{
				c1:1,
				c2:0,
				c3:0
			}
		}
		*/
		//get information for eligible campaign e.g. c1
		$campaign_result = $campaignService->getEligibleCampaign($member_agg_info,$aggQueries);
		$final_result=createPayload($campaign_result,$channel);
		//post processing will done here
		return $final_result;
	}

}
$dummy=new OnlineCampaignController();
$dummy->getCampaignPayload("iSH94964599","profile_banner");

