<?php
class Discovery 
{

// --------------------------------------------------------------------

	private static function split_on_newline($str)
	{
		return preg_split('/\r\n|\r|\n/', $str);
	}
	private static function split_on_tcsv($str)
	{
		return preg_split('/\s+/', $str);
	}
// --------------------------------------------------------------------

//
	private static function get_sites_available()
	{
		$srcfiles=glob("/etc/apache2/sites-available/*.conf");
		$sites_available=array();
		foreach ($srcfiles as $file) {
			$parts=explode("/",$file);
			$filename=$parts[count($parts)-1];
			$conf=Discovery::decode_apache_conf($file);
			$sites_available[]=$conf;
		}
		return $sites_available;
	}
// --------------------------------------------------------------------

	public static function extract_site_ips($sites_available)
	{
		$sites=array();
		foreach($sites_available as $site)
		{
			if(is_object($site))
				$sites[$site->filename]=$site->IP;
			else
				$sites[$site['filename']]=$site['IP'];
		}
		return $sites;
	}
// --------------------------------------------------------------------

	public static function get_sites()
	{
		$sites_available=Discovery::get_sites_available();
		$sites_enabled=Discovery::get_sites_enabled();

		foreach($sites_available as $key=>&$site)
		{
			if(isset($sites_enabled[$key]))
			{
				$site['Enabled']='Yes';
			}
		}
		unset($site);
		return $sites_available;
	}
// --------------------------------------------------------------------

//
	private static function get_sites_enabled()
	{
		$srcfiles=glob("/etc/apache2/sites-enabled/*.conf");
		$sites_enabled=array();
		foreach ($srcfiles as $file) 
		{
			$parts=explode("/",$file);
			$filename=$parts[count($parts)-1];
			$conf=Discovery::decode_apache_conf($file);
			$sites_enabled[]=$conf;
		}
		return $sites_enabled;
	}
// --------------------------------------------------------------------

//
	public static function get_unassigned_folders($sites_available=array())
	{
		$folder="/var/www";
		$srcfiles=scandir($folder);
		$folders=array();
		foreach ($srcfiles as $filename)
		{
			$file="$folder/$filename";
			if(!in_array($filename,array('.','..'))&&is_dir($file))
			{
				$found=false;
				foreach($sites_available as $a)
				{
					if($a['filename']==$filename)
					{
						$found=true;
						break;
					}
				}
				if(!$found)
				{
					$folders[$filename]=array(
						'file'=>$file,
						'filename'=>$filename,
						'size'=>!is_dir("$file")?0:count(scandir("$file/"))
						);
				}
			}
		}
		return $folders;
	}

// --------------------------------------------------------------------

//
	public static function get_databases()
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

	public static function get_database_tables()
	{
		$databases=Discovery::get_databases();

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
				$tables=DB::select("SHOW TABLE STATUS FROM $database");
				foreach($tables as $k=>&$table)
				{
					$table->database=$database;
				}
			}
			else
			{
				$default['database']=$database;
			}
			$tables=json_decode(json_encode($tables),FALSE);
			
			$datas[$database]=$tables;
		}
		return $datas;
	}

// --------------------------------------------------------------------

	public static function get_network_interfaces()
	{
		$ip='127.0.0.1';

		$autos=array();
		$primary_auto='eth0';
		$interfaces=array();

		$file="/etc/network/interfaces";
		if(file_exists($file))
		{
			$raw=file_get_contents($file);
			//$csv=explode("\n",$raw);
			$csv=self::split_on_newline($raw);

			// get list of all auto
			foreach($csv as $line)
			{
				$line=trim($line);
				$a=explode(" ",$line);
				if($a[0]=='auto')
				{
					$autos[]=$a[1];
				}
			}
			//find the primary auto
			foreach($autos as $auto)
			{
				if(!in_array($auto,array('lo'))&&(strpos(':',$auto)===false))
				{
					$primary_auto=$auto;
					break;
				}
			}

			// extract the detailed data for each auto
			$auto=false;
			$types=array(
				'address'=>'address',
				'network'=>'network',
				'gateway'=>'gateway',
				'netmask'=>'netmask',
				'dns_nameservers'=>'dns-nameservers'
				);
			foreach($csv as $line)
			{
				$line=trim($line);
				$a=explode(" ",$line);
				$type=array_shift($a);
				$first_parm=isset($a[0])?$a[0]:'';
				$parms=implode(" ",$a);
				if($type=='iface')
				{
					$auto=$first_parm;
					$interfaces[$auto]['name']=$auto;
					foreach($types as $type_index=>$type_name)
					{
						$interfaces[$auto][$type_index]='';
					}
				}
				else if($auto!==false)
				{
					foreach($types as $type_index=>$type_name)
					{
						if($type===$type_name)
							$interfaces[$auto][$type_index]=$parms;
					}
				}
			}

			// get ip of primary auto
			$ip=$interfaces[$primary_auto]['address'];
		}

//
		return array(
			'autos'=>$autos,
			'interfaces'=>$interfaces,
			'ip'=>$ip,
			'primary_auto'=>$primary_auto);
	}

// --------------------------------------------------------------------

	private static function get_drupal($path)
	{
		$file=$path."/CHANGELOG.txt";
		if(file_exists($file))
		{
			$raw=file_get_contents($file);
			//$csv=explode("\n",$raw);
			$csv=self::split_on_newline($raw);
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

	private static function get_laravel($path)
	{
		$file=$path."/vendor/composer/installed.json";
		if(file_exists($file))
		{
			$json=file_get_contents($file);
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

	private static function get_cakephp($path)
	{
		$file=$path."/lib/Cake/VERSION.txt";
		if(file_exists($file))
		{
			$raw=file_get_contents($file);
			//$csv=explode("\n",$raw);
			$csv=self::split_on_newline($raw);
			foreach($csv as $line)
			{
				$line=trim($line);
				$a=explode(" ",$line);
				if(count($a)>2&&$a[1]=='@since')
				{
					array_shift($a);
					array_shift($a);
					return trim(implode(" ",$a));
				}
			}
		}

		return 'CakePHP';
	}

// --------------------------------------------------------------------

	private static function get_wordpress($path)
	{
		$file=$path."/wp-includes/version.php";

		if(file_exists($file))
		{
			include $file;
			if(isset($wp_version))
				return 'Wordpress '.$wp_version;
		}

		return 'Wordpress';
	}

// --------------------------------------------------------------------

	private static function get_codeigniter($path)
	{
		$file=$path."/system/core/CodeIgniter.php";
		if(file_exists($file))
		{
			//define('CI_VERSION', '2.2.0');
			$raw=file_get_contents($file);
			//$csv=explode("\n",$raw);
			//$csv = preg_split('/[\n\r]+/', $raw);
			$csv=self::split_on_newline($raw);
			foreach($csv as $line)
			{
				$line=trim($line);
				$a=explode(",",$line);
				if(count($a)>=2&&$a[0]=="define('CI_VERSION'")
				{
					return 'CodeIgnitor '. preg_replace('/[^0-9.]/i', '', $a[1]);
				}
			}
		}

		return 'CodeIgniter';
	}

// --------------------------------------------------------------------
	private static function decode_apache_conf($file)
	{
		$conf=array(
			'conf_file'=>$file,
			'conf_filename'=>'',
			'Size'=>filesize($file),
			'ServerAdmin'=>'',
			'ServerName'=>'',
			'DocumentRoot'=>'',
			'ErrorLog'=>'',
			'CustomLog'=>'',
			'IP'=>'',
			'Engine'=>'',
			'file'=>$file,
			'filename'=>'',
			'ServerBrand'=>'Apache2',
			'Enabled'=>'No'
			);
		$raw=file_get_contents($file);
		$a=explode("/",$file);
		$conf['conf_filename']=array_pop($a);
		//$csv=explode("\n",$raw);
		$csv=self::split_on_newline($raw);
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
		}

			//
		$path=$conf['DocumentRoot'];
		$conf['file']=$path;
		$a=explode("/",$path);
		$last=array_pop($a);
		$uppath=implode("/",$a);
		$last2=array_pop($a);
		$uppath2=implode("/",$a);
		$last3=array_pop($a);
		$uppath3=implode("/",$a);
			//
		if(!file_exists($conf['DocumentRoot']))
		{
			$conf['Engine']="Folder doesn't exist";
			$conf['file']="Folder doesn't exist";
		}
		//
		else if($conf['DocumentRoot']=="/var/www")
		{
			$conf['Engine']='Default ';
			$conf['file']='default'.$conf['IP'];
		}
		//Drupal
		else if(file_exists($path."/sites/default/settings.php"))
		{
			if($last2=='www')
			{
				$conf['Engine']=Discovery::get_drupal($path);
				$conf['file']=$path;
			}
			else
			{
				$conf['Engine']=Discovery::get_drupal($path);
				$conf['file']=$uppath;
			}
		}
		//WordPress
		else if(file_exists($path."/wp-admin/"))
		{
			$conf['Engine']=Discovery::get_wordpress($path);
			$conf['file']=$path;
		}
		//Laravel
		else if(file_exists($path."/app/start/artisan.php"))
		{
			$conf['Engine']=Discovery::get_laravel($uppath);
			$conf['file']=$uppath;
		}
		//Laravel
		else if($last=='public'&&file_exists($uppath."/app/start/artisan.php"))
		{
			$conf['Engine']=Discovery::get_laravel($uppath);
			$conf['file']=$uppath;
		}
		// CakePHP
		else if($last=='webroot'&&$last2=='app'&&file_exists($uppath2."/lib/Cake/VERSION.txt"))
		{
			$conf['Engine']=Discovery::get_cakephp($uppath2);
			$conf['file']=$uppath2;
		}
		// CodeIgniter
		else if(file_exists("$path/system/core/CodeIgniter.php"))
		{
			$conf['Engine']=Discovery::get_codeigniter($path);
			$conf['file']=$path;
		}
		
		//
		$a=explode("/",$conf['file']);
		$conf['filename']=array_pop($a);
		//
		return $conf;
	}
// --------------------------------------------------------------------

	private static function cnf_file_to_array($file)
	{
		if(!file_exists($file))
		{
			echo "$file doesn't exist.";
			return false;
		}
		$datas=array();
		$raw=file_get_contents($file);
//$lines=explode("\r\n",$raw);
		$lines=self::split_on_newline($raw);
		foreach($lines as $line)
		{
			//$a=explode(" ",trim($line));
			$a=self::split_on_tcsv(trim($line));

			//echo '<pre>'; print_r($a); echo '</pre>';
			if(count($a)>=3)
			{
				if($a[1]=='=')
				{
					$key=array_shift($a);
					array_shift($a);
					$value=implode(" ",$a);
					if(strlen($key)>1&&$key[0]!='#')
					{
						$datas[$key]=$value;
					}
				}
			}
		}

		return $datas;
	}
// --------------------------------------------------------------------

	private static function conf_file_to_array($file)
	{
		if(!file_exists($file))
		{
			echo "$file doesn't exist.";
			return false;
		}
		$datas=array();
		$raw=file_get_contents($file);
//$lines=explode("\r\n",$raw);
		$lines=self::split_on_newline($raw);
		foreach($lines as $line)
		{
			//$a=explode(" ",trim($line));
			$a=self::split_on_tcsv(trim($line));

			//echo '<pre>'; print_r($a); echo '</pre>';
			if(count($a)>=2)
			{
//				if($a[1]=='=')
				{
					$key=array_shift($a);
				//	array_shift($a);
					$value=implode(" ",$a);
					if(strlen($key)>1&&$key[0]=='<')
					{
						$key=substr($key,1,strlen($key)-1);
						$value=substr($value,0,strlen($value)-1);
						$datas[$key]=$value;
					}
					else if(strlen($key)>1&&$key[0]!='#')
					{
						$datas[$key]=$value;
					}
				}
			}
		}

		return $datas;
	}
// --------------------------------------------------------------------

	private static function detect_mysql()
	{
		return self::cnf_file_to_array('/etc/mysql/my.cnf');
	}
// --------------------------------------------------------------------
private static function detect_apache()
	{
		return self::conf_file_to_array('/etc/apache2/apache2.conf');
	}
// --------------------------------------------------------------------

	public static function get_servers()
	{
		/*
		$servers=array(
			'mysql'=>'MySQL',
			'apache'=>'Apache',
			'mongo'=>'Mongo',
			'nginx'=>'Nginx',
			'postgresql'=>'PostgreSQL',
			'nodejs'=>'Node.js'
			);
*/

//
$servers=array();

//
$datas=self::detect_mysql();
if($datas!==false)
{
	$datas['id']='mysql';
	$datas['name']='MySQL';
	$servers[]=$datas;
}

//
$datas=self::detect_apache();
if($datas!==false)
{
	$datas['id']='apache';
	$datas['name']='Apache';
	$servers[]=$datas;
}

//
	return $servers;
}

// --------------------------------------------------------------------

public function get_server_mysql()
{
	$databases=Discovery::get_show_databases();

	$plugins=DB::select("SHOW PLUGINS");
	$processlists=DB::select("SHOW PROCESSLIST");
	$logs=DB::select("SHOW STATUS");
	$engines=DB::select("SHOW ENGINES");
	$opentables=DB::select("SHOW OPEN TABLES");
	$variables=DB::select("SHOW VARIABLES");

	return array(
		'plugins'=>$plugins,
		'processlists'=>$processlists,
		'logs'=>$logs,
		'engines'=>$engines,
		'opentables'=>$opentables,
		'variables'=>$variables
		);
}
// --------------------------------------------------------------------

public function get_server_apache()
{
}
	// --------------------------------------------------------------------

public function get_server_mongo()
{
}
	// --------------------------------------------------------------------

public function get_server_nginx()
{
}
	// --------------------------------------------------------------------

public function get_server_postgresql()
{
}
	// --------------------------------------------------------------------

}
?>