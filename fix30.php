<?php
require_once 'framework/application.php';
application::init(array());
//messages::pa(servers::$server);

$count=0;

$ids=null;

// *************************************************************************
	$feedback = db::query("SELECT thread_id,message,email FROM feedback;");
	foreach($feedback as $row)
	{
    $thread_id=$row['thread_id'];
    $message=$row['message'];
if($message!='')
{
	$check = db::query("SELECT forum_id FROM feedback WHERE message='".db::sql($message)."' and thread_id=$thread_id;");
if(is_array($check) and count($check)>=2)
{
echo '<br>';
$loop_count=0;
foreach($check as $row2)
{
    $forum_id=$row2['forum_id'];
echo "forum_id: $forum_id thread_id=$thread_id : $message<br>";
if($loop_count>=1) { $ids[]=$forum_id; $count++;
 }
$loop_count++;
}
}
}
}

echo "count=$count<br>";
print_r($ids);
$csv=implode(',',$ids);
	$feedback = db::query("DELETE FROM feedback WHERE forum_id IN ($csv);");

?>
