<?php
/*
 */
/**
 *
 */
class Timer
{
    // -------------------------------------------------------------------------------------------

    private $running=true;
    private $start_time=null;
    private $end_time=null;
    public function __construct()
    {
        $this->start_time=microtime(true);
        $this->end_time=microtime(true);
    }
    public function __destruct()
    {
        $this->start_time=null;
        $this->end_time=null;
    }
    // -------------------------------------------------------------------------------------------

    public function start()
    {
        $this->running=true;
        $this->start_time=microtime(true);
    }
// -------------------------------------------------------------------------------------------

    public function update()
    {
        $this->end_time=microtime(true);
    }
// -------------------------------------------------------------------------------------------
    public function stop()
    {
        $this->running=false;
        $this->end_time=microtime(true);
    }
// -------------------------------------------------------------------------------------------

    public function get()
    {
        if($this->running===true) $this->update();
        $time=($this->end_time)-($this->start_time);
        return ($time>0)?$time:0;
    }
// -------------------------------------------------------------------------------------------

    public function dump()
    {
       // $this->stop();
        $t=$this->get();
        echo sprintf("%8.2f seconds %s\r\n", $t, ($this->running?'Running':'Stopped'));
        echo " start {$this->start_time} end {$this->end_time}\r\n";
    }
// -------------------------------------------------------------------------------------------

     public function print_time($extra='')
    {
        $t=$this->get();

        $pps=60/$t;

       // if($progress!=null) $str="% ".sprintf("%4.1f", $progress*100)."\t Execution Time: ".trim(sprintf("%6.2", $pps));
       // else 
            $str=" Execution Time: ".trim(sprintf("%6.2f", $pps));

        if(Messages::is_cli())
        {
            echo "# $t s ($str pages per second) \t$extra\n";
        }
        else
        {
            echo '<b>'.$t.'</b> s (<b>'.$str.'</b> pages per second) '.$extra.'<br>';
        }
    }

}
?>
