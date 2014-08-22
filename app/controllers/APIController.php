<?php
/*

 */
class APIController extends BaseController
{
	public $restful=true;
	public function __construct()
	{
//		$this->beforeFilter('csrf', array ('on'=>'post'));
	}

// --------------------------------------------------------------------

	public function get_sites()
	{
		return Json::response_formatted_json(Discovery::get_sites());
	}
// --------------------------------------------------------------------

	public function get_unassigned_folders()
	{
		return Json::response_formatted_json(Discovery::get_unassigned_folders());
	}

// --------------------------------------------------------------------

	public function get_databases()
	{
		return Json::response_formatted_json(Discovery::get_databases());
	}

	// --------------------------------------------------------------------

	public function get_database_tables()
	{
		return Json::response_formatted_json(Discovery::get_database_tables());
	}

// --------------------------------------------------------------------

	public function get_network_interfaces()
	{
		return Json::response_formatted_json(
			Discovery::get_network_interfaces()
			);
	}

// --------------------------------------------------------------------

	public function get_servers()
	{
		return Json::response_formatted_json(Discovery::get_servers());
	}

// --------------------------------------------------------------------

	public function get_server($type)
	{
		switch($type)
		{
			case 'mysql':
			return Json::response_formatted_json(Discovery::get_server_mysql());
			case 'apache':
			return Json::response_formatted_json(Discovery::get_server_apache());
			case 'mongo':
			return Json::response_formatted_json(Discovery::get_server_mongo());
			case 'nginx':
			return Json::response_formatted_json(Discovery::get_server_nginx());
			case 'postgresql':
			return Json::response_formatted_json(Discovery::get_server_postgresql());
			case 'nodejs':
			return Json::response_formatted_json(Discovery::get_server_nodejs());
			default:
			return Json::response_formatted_json(array());
		}
	}

// --------------------------------------------------------------------

	public function get_readme()
	{
		$readme=file_get_contents(base_path().'/readme.md');

		return Json::response_formatted_json(
			array(
				'readme'=>$readme
				)
			);
	}
// --------------------------------------------------------------------


}
?>