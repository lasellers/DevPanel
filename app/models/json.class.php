<?php
/*

  @author: Lewis A. Sellers <lasellers@gmail.com>
  @date: 11/2013-12/2013
 */
  class Json
  {
  // --------------------------------------------------------------------
  /*
  This is a standardized json responsive handler to make sure all
  returned json data has a similiar format.

  Namely we use the convention of always returning at least

  error: false

  If error is anything but false, then the string is the error.

May return other data.

    @author: Lewis A. Sellers <lasellers@gmail.com>
    @date: 10/2013-12/2013
   */
    public static function response_formatted_json($error=false)
    {
     if(is_object($error))
     {
      $objects=$error;
      $data=$objects->toArray();
      foreach($objects as $name=>$object)
      {
        if(is_object($object))
          $data[$name]=$object->toArray();
        else
          $data[$name]=$object;
      }
      if(!isset($data['error']))
        $error=array(
          'error'=>false,
          'data'=>$data
          );
      else
        $error=$data;

    } else if (is_array($error))
    {
      if(!isset($error['error']))
       $error=array(
        'error'=>false,
        'data'=>$error
        );
   }
   else
   {
    $error=array (
      'error'=>$error
      );
  }
  return Response::json($error);
}

// --------------------------------------------------------------------

public static function error_data_response($data=null,$error=false)
{
  if(is_object($data))
  {
   $json=array(
    'error'=>false,
    'data'=>$data
    );
 }
 else
 {
  $json=array (
    'error'=>$error
    );
}
return Response::json($json);
}

// --------------------------------------------------------------------

}