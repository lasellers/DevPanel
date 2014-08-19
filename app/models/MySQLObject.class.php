<?php
/*
 */
/**
 *
 */
class MySQLObject
{
    // -------------------------------------------------------------------------------------------


    public function __construct()
    {
    }
    public function __destruct()
    {
    }
    // -------------------------------------------------------------------------------------------

    public static function print_obj_all($database,$tables)
{
echo "<table class=\"table table-striped table-hover table-responsive\">\r\n";
echo MySQLObject::print_obj_database($database,count($tables)-1);
echo MySQLObject::print_obj_header($tables[0],$database);
echo MySQLObject::print_obj($tables,$database);
echo "</table>\r\n";
 }

  // -------------------------------------------------------------------------------------------

    public static function print_obj_database($database,$count)
    {
        echo "<caption>\r\n";
        echo "<a href=\"#\" class=\"show-database hide-show-button\" data-id=\"$database\">Show</a> \r\n";
        echo "<a href=\"#\" class=\"hide-database hide-show-button\" data-id=\"$database\">Hide</a> \r\n";
        echo " <small>($count)</small> \r\n";
        echo "$database</caption>\r\n";
    }
    // -------------------------------------------------------------------------------------------

    public static function print_obj_header($obj,$database)
    {
      echo "<theader class='database-header' id='database-$database-header' style='display: none'>\r\n";
      echo '<tr>';
       foreach($obj as $k=>$v)
      {
        echo '<th>'.$k.'</th>';
    }
    echo "</tr>\r\n";
    echo "</theader>\r\n";
}
     // -------------------------------------------------------------------------------------------

public static function print_obj($objs,$database)
{
 echo "<tbody class='database-body' id='database-$database-body' style='display: none'>\r\n";
 foreach($objs as $obj)
 {
     echo "<tr>";
     foreach($obj as $k=>$v)
     {
        echo '<td>'.$v.'</td>';
    }
    echo "</tr>\r\n";
}
echo "</tbody>\r\n";
}
 // -------------------------------------------------------------------------------------------

}
?>
