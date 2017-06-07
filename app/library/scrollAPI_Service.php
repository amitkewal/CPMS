<?php
class scrollAPI_Service
{
	public function __construct()
	{

	}
	public function scrollJob($data)
	{
		elastic_connect();
		fetch_result();
		forward_results_to_KINESIS();
	}
}
?>