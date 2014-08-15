<?php
class CLI
{
 public static function is_cli()
 {
  static $cached_is_cli=null;
  if($cached_is_cli===null)
  {
    $sapi_type=php_sapi_name();
    if(substr($sapi_type, 0, 3)=='cli') $cached_is_cli=true;
    else $cached_is_cli=false;
  }
  return $cached_is_cli;
}

      // --------------------------------------------------------------------
public static function println($s='')
{
  if(is_array($s))
  {
    print_r($s);
    exit;
  }
  echo $s."\n";
}
      // --------------------------------------------------------------------
public static function printtearhr()
{
  echo str_repeat("*", 76)."\n";
}
public static function printhr()
{
  echo str_repeat("-", 76)."\n";
}
public static function printdoublehr()
{
  echo str_repeat("=", 76)."\n";
}
      // --------------------------------------------------------------------
public static function exit_cron()
{
  self::printhr();
  self::print_memory();
  self::printhr();
  exit;
}
      // --------------------------------------------------------------------

public static function section_title($s)
{
  self::printhr();
  CLI::println($s);
  self::printhr();
}
      // --------------------------------------------------------------------

public static function print_memory()
{
  $mb=1024*1024;
  $l=ini_get('memory_limit')>0?"".ini_get('memory_limit')."":"Unlimited";
  $mu=number_format(memory_get_usage()/$mb, 2);
  $mpu=number_format(memory_get_peak_usage()/$mb, 2);
  $drt=date('r',time());
  CLI::println("Mem: usage=$mu MB peak=$mpu MB limit=$l \t $drt");
}

      // --------------------------------------------------------------------
  /**
     * prints bytes in humable readable format such as 1.7GB, etc.
     *
     * @param integer $bytes
     * @return string
     */
  public static function printable_bytes($bytes)
  {
    $b=$bytes;
    $type='B';
    if($b>1024*1024*1024)
    {
      $type='GB';
      $b=$b/(1024*1024*1024);
    }
    else if($b>(1024*1024))
    {
      $type='MB';
      $b=$b/(1024*1024);
    }
    else if($b>1024)
    {
      $type='KB';
      $b=$b/1024;
    }
    return '('.sprintf("%.1f", $b).' '.$type.')';
  }
      // --------------------------------------------------------------------

  public static function abort($str)
  {
    CLI::println($str);
    exit;
  }
     // --------------------------------------------------------------------

}
?>