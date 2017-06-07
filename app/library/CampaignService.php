<?php
class CampaignService
{
	private $campaign;
	public function __construct()
	{
		$this->campaign=new campaignMetadata();
	}
	public function addCampaigns()
	{
		$$this->campaign->addData();

	}
	public function getCampaigns()
	{
		$$this->campaign->fetchData();
	}
	public function updateCampaigns()
	{
		$$this->campaign->updateData();
	}
	public function deleteCampaigns()
	{
		$$this->campaign->deleteData();
	}

}
?>