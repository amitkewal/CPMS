<?php

class CampaignController extends \Phalcon\Mvc\Controller
{

    public function indexAction()
    {

    }
     public function addCampaigns(Request $request){
   	 $resultCampaign=new campaignMetadata();
   	 $result=$resultCampaign->addData($request);
   }
  
   public function resultCampaigns(Request $request){
   	 //fetch n show campaigns based on some any criteria e.g. Active
   	 $resultCampaign=new campaignMetadata();
   	 $result=$resultCampaign->fetchData($request);//based on request criteria
   	 //call view to display the results.
   }
   public function deleteCampaigns(Request $request){
   	//deleting the campaigns
   	 $resultCampaign=new campaignMetadata();
   	 $result=$resultCampaign->deleteData($request);
   }
	public function updateCampaigns(Request $request){
   	 $resultCampaign=new campaignMetadata();
   	 $result=$resultCampaign->updateData($request);
   }
   public function addCampaignsCriteria(Request $request){
   	//adding the campaign Criterias
   	 $resultCampaign=new campaignCriteria();
   	 $result=$resultCampaign->addData($request);
   }
   public function updateCampaignsCriteria(Request $request){
   	//updating the campaign Criterias
   	 $resultCampaign=new campaignCriteria();
   	 $result=$resultCampaign->updateCriteria($request);
   }
   public function fetchCampaignsCriteria(Request $request){
   	//fetching the campaign Criterias
   	 $resultCampaign=new campaignCriteria();
   	 $result=$resultCampaign->fetchCriteria($request);
   }
    public function updateCampaignsCriteria(Request $request){
   	//update the campaign Criterias
   	 $resultCampaign=new campaignCriteria();
   	 $result=$resultCampaign->updateCriteria($request);
   }

}

