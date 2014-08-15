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
				$conf['Engine']='Drupal';
			else if(file_exists($path."/wp-admin/"))
				$conf['Engine']='WordPress';
			else if(file_exists($path."/app/start/artisan.php"))
				$conf['Engine']='Laravel';	
			else if($last=='public'&&file_exists($uppath."/app/start/artisan.php"))
				$conf['Engine']='Laravel';
		}
		return json_decode(json_encode($conf),FALSE);
	}
// --------------------------------------------------------------------

	public function index()
	{
		$srcfiles=glob("/etc/apache2/sites-available/*.conf");
		$sites_available=array();
		foreach ($srcfiles as $file) {
			$parts=explode("/",$file);
			$filename=$parts[count($parts)-1];
			$sites_available[$filename]=$this->decode_conf($file);
		}

		$srcfiles=glob("/etc/apache2/sites-enabled/*.conf");
		$sites_enabled=array();
		foreach ($srcfiles as $file) {
			$parts=explode("/",$file);
			$filename=$parts[count($parts)-1];
			$sites_enabled[$filename]=$this->decode_conf($file);
		}
		return View::make('home.index')
		->with('meta_title', 'Home')
		->with('sites_available', $sites_available)
		->with('sites_enabled', $sites_enabled)
		;
	}

	// ---------------------------------------------------------------

	public function databases()
	{
		$databases=DB::select("SHOW DATABASES");
		$datas=array();
		$tables=array();
		foreach($databases as $database)
		{
			$dbname=$database->Database;

			if(!in_array($dbname,array('','mysql','performance_schema','information_schema')))
			{
			//$tables=DB::select("SHOW TABLE STATUS FROM ?;",array($dbname));
				$tables=DB::select("SHOW TABLE STATUS FROM $dbname");
			//$datas=array_merge($datas,$tables);
				$datas[$dbname]=$tables;
			}
		}

		return View::make('home.databases')
		->with('meta_title', 'Home')
		->with('databases', $databases)
		->with('tables', $tables)
		->with('datas', $datas)
		;
	}
		/*
		show databases;
		SHOW TABLE STATUS FROM singletreerealtytn;

show logs; show errors;
show  binary logs;

show plugins;
show processlist;
		*/
	// --------------------------------------------------------------------
}
?>