<?php
/**
 *
 */
class Job
{
  public $JOB_ID;
  public $AT;
  public $BT;
  public $PRIORITY;
  public $MEMORY;
  public $FT=0;
  public $FINISH_FLAG = false;
  function __construct($JOB_ID_VAL,$AT_VAL,$PRIO,$MEM,$BT_VAL)
  {
    # code...
    $this->JOB_ID = $JOB_ID_VAL;
    $this->AT = $AT_VAL;
    $this->BT = $BT_VAL;
    $this->PRIORITY = $PRIO;
    $this->MEMORY = $MEM;
  }
}
?>
