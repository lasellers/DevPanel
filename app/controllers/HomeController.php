<?php
/*

 */
class HomeController extends BaseController
{
	public $restful=true;
	public function __construct()
	{
//		$this->beforeFilter('csrf', array ('on'=>'post'));
	}

// --------------------------------------------------------------------

	public function index()
	{
		return View::make('home.index')
		->with('meta_title', 'Home')
		;
	}

// --------------------------------------------------------------------

	public function sites()
	{
		$databases=Discovery::get_show_databases();
	
		$sites_available=Discovery::get_sites_available();
		$sites_enabled=Discovery::get_sites_enabled();
		$sites=Discovery::extract_site_ips($sites_available);
		$folders=Discovery::get_web_folders($sites_available);

		//
		list($autos,$interfaces,$ip,$primary_auto)=Discovery::get_network_interfaces();

//
		return View::make('home.sites')
		->with('meta_title', 'Sites')
		->with('sites', $sites)
		->with('sites_available', json_decode(json_encode($sites_available),FALSE) )
		->with('sites_enabled', json_decode(json_encode($sites_enabled),FALSE) )
		->with('folders',json_decode(json_encode($folders),FALSE) )
		->with('ip', $ip )
		->with('primary_auto', $primary_auto )
		->with('autos', $autos )
		->with('interfaces', $interfaces )
		;
	}

	// ---------------------------------------------------------------

	public function network()
	{
		$databases=Discovery::get_show_databases();
	
		$sites_available=Discovery::get_sites_available();
		//$sites_enabled=Discovery::get_sites_enabled();
		$sites=Discovery::extract_site_ips($sites_available);
		$folders=Discovery::get_web_folders($sites_available);

		//
		list($autos,$interfaces,$ip,$primary_auto)=Discovery::get_network_interfaces();

//
		$sites_available= json_decode(json_encode($sites_available),FALSE);
		//$sites_enabled= json_decode(json_encode($sites_enabled),FALSE);
		//$folders= json_decode(json_encode($folders),FALSE);

		return View::make('home.network')
		->with('meta_title', 'Network')
		->with('sites', $sites)
		//->with('sites_available', $sites_available )
		//->with('sites_enabled', $sites_enabled )
		//->with('folders', $folders )
		->with('ip', $ip )
		->with('primary_auto', $primary_auto )
		->with('autos', $autos )
			->with('interfaces', $interfaces )
	;
	}

	// ---------------------------------------------------------------

	public function databases()
	{
		$databases=Discovery::get_show_databases();

		//
		$datas=array();
		$tables=array();
		$default=array(
			0=>array(
				'Name'=>'',
				'Engine'=>'',
				'Version'=>'',
				'Rows'=>''
				)
			);
		foreach($databases as $database)
		{
			if(!in_array($database,array('','mysql','performance_schema','information_schema')))
			{
			//$tables=DB::select("SHOW TABLE STATUS FROM ?;",array($database));
				$tables=DB::select("SHOW TABLE STATUS FROM $database");
			//$datas=array_merge($datas,$tables);
				$datas[$database]=$tables;
			}
			else
			{
				$datas[$database]=json_decode(json_encode($default),FALSE);
			}
		}

		return View::make('home.databases')
		->with('meta_title', 'Databases')
		->with('databases', $databases)
		->with('tables', $tables)
		->with('datas', $datas)
		;
	}

	// ---------------------------------------------------------------

	public function mysql()
	{
		$databases=Discovery::get_show_databases();
		$sites=array();

		$plugins=DB::select("SHOW PLUGINS");
		$processlists=DB::select("SHOW PROCESSLIST");
		$logs=DB::select("SHOW STATUS");
		$engines=DB::select("SHOW ENGINES");
		$opentables=DB::select("SHOW OPEN TABLES");
		$variables=DB::select("SHOW VARIABLES");

		return View::make('home.mysql')
		->with('meta_title', 'MySQL')
		->with('plugins', $plugins)
		->with('processlists', $processlists)
		->with('logs', $logs)
		->with('engines', $engines)
		->with('opentables', $opentables)
		->with('variables', $variables)
		;
	}
	// ---------------------------------------------------------------

	public function mongo()
	{
		return View::make('home.mongo')
		->with('meta_title', 'Mongo')
		;
	}

	// ---------------------------------------------------------------

	public function db_postgresql()
	{
		return View::make('home.postgresql')
		->with('meta_title', 'PostgreSql')
		;
	}

	// ---------------------------------------------------------------

	public function apache2()
	{
		return View::make('home.apache2')
		->with('meta_title', 'Apache2')
		;
	}
	// --------------------------------------------------------------------
}
?>