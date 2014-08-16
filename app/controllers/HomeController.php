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

//
	private function get_show_databases()
	{
		$show_databases=DB::select("SHOW DATABASES");

		$databases=array();
		foreach($show_databases as $database)
		{
			$databases[]=$database->Database;
		}

		return $databases;
	}
	

// --------------------------------------------------------------------

	private function get_drupal_version($path)
	{
		if(file_exists($path."/CHANGELOG.txt"))
		{
			$raw=file_get_contents($path."/CHANGELOG.txt");
			$csv=explode("\n",$raw);
			foreach($csv as $line)
			{
				$line=trim($line);
				$a=explode(" ",$line);
				if($a[0]=='Drupal')
					return $line;
			}
		}

		return 'Drupal';
	}


// --------------------------------------------------------------------

	private function get_laravel_version($path)
	{
		//echo "$path/vendor/composer/installed.json<br>";
		if(file_exists($path."/vendor/composer/installed.json"))
		{
			$json=file_get_contents($path."/vendor/composer/installed.json");
		//	print_r($json); 
			$installs=json_decode($json);
			foreach($installs as $install)
			{
				if($install->name=='laravel/framework')
				{
					return 'Laravel '.$install->version;
				}
			}

		}

		return 'Laravel';
	}


// --------------------------------------------------------------------
	private function decode_conf($file)
	{
		$conf=array();
		$conf=array(
			'Size'=>filesize($file),
			'ServerAdmin'=>'',
			'ServerName'=>'',
			'DocumentRoot'=>'',
			'ErrorLog'=>'',
			'CustomLog'=>'',
			'IP'=>'',
			'Engine'=>''
			);
		$raw=file_get_contents($file);
		$csv=explode("\n",$raw);
		foreach($csv as $line)
		{
			$line=trim($line);
			$a=explode(" ",$line);
			if(in_array($a[0],
				array('ServerAdmin','ServerName','DocumentRoot','ErrorLog','CustomLog','<VirtualHost')))
			{
				if($a[0]=='<VirtualHost')
					$conf['IP']= preg_replace('/[^0-9.:]/', '', $a[1]);
				else
					$conf[$a[0]]=$a[1];
			}
			$path=$conf['DocumentRoot'];
			$a=explode("/",$path);
			$last=array_pop($a);
			$uppath=implode("/",$a);
			if(file_exists($path."/sites/default/settings.php"))
			{
				//$conf['Engine']='Drupal';
				$conf['Engine']=$this->get_drupal_version($path);
			}
			else if(file_exists($path."/wp-admin/"))
				$conf['Engine']='WordPress';
			else if(file_exists($path."/app/start/artisan.php"))
			{
				//$conf['Engine']='Laravel';
				$conf['Engine']=$this->get_laravel_version($uppath);
			}
			else if($last=='public'&&file_exists($uppath."/app/start/artisan.php"))
			{
				//$conf['Engine']='Laravel';
				$conf['Engine']=$this->get_laravel_version($uppath);
			}
		}
		return json_decode(json_encode($conf),FALSE);
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
		$databases=$this->get_show_databases();
		$sites=array();

		$srcfiles=glob("/etc/apache2/sites-available/*.conf");
		$sites_available=array();
		foreach ($srcfiles as $file) {
			$parts=explode("/",$file);
			$filename=$parts[count($parts)-1];
			$sites_available[$filename]=$this->decode_conf($file);

			$sites[$filename]=$sites_available[$filename]->IP;
		}

		$srcfiles=glob("/etc/apache2/sites-enabled/*.conf");
		$sites_enabled=array();
		foreach ($srcfiles as $file) {
			$parts=explode("/",$file);
			$filename=$parts[count($parts)-1];
			$sites_enabled[$filename]=$this->decode_conf($file);
		}
		return View::make('home.sites')
		->with('meta_title', 'Sites')
		->with('sites', $sites)
		->with('sites_available', $sites_available)
		->with('sites_enabled', $sites_enabled)
		;
	}

	// ---------------------------------------------------------------

	public function databases()
	{
		$databases=$this->get_show_databases();

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
		//	echo "database=$database<br>";
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
			//	echo "<pre>"; print_r($tables); echo "</pre>";; 
				//echo "<hr><hr>";
		}
		//echo "<pre>"; print_r($datas); exit; 

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
		$databases=$this->get_show_databases();
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



	public function apache2()
	{
		return View::make('home.apache2')
		->with('meta_title', 'Apache2')
		;
	}
	// --------------------------------------------------------------------
}
?>