<?php

class AdminController extends \Phalcon\Mvc\Controller
{

    private $campaign;
    public function indexAction()
    {

    }
	public function __construct()
	{
		$campaign=new CampaignService();
	}
	public function addCampaign($data)
	{
		$this->campaign->addCampaign();
		
	}
	public function getCampaign()
	{
		$this->campaign->getCampaign();
		
	}
	public function updateCampaign()
	{
		$this->campaign->updateCampaign();
		
	}
	public function deleteCampaign()
	{
		$this->campaign->deleteCampaign();
		
	}
	

}

