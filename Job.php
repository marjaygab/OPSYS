<?php
/**
 *
 */
class Job
{
  public $JOB_ID;
  public $AT;
  public $BT;
  public $PRIORITY_Q;
  public $PRIO;
  public $MEMORY;
  public $FT=0;
  public $FINISH_FLAG = false;
  function __construct($JOB_ID_VAL,$AT_VAL,$PRIO_Q,$MEM,$BT_VAL,$PRIO)
  {
    # code...
    $this->JOB_ID = $JOB_ID_VAL;
    $this->AT = $AT_VAL;
    $this->BT = $BT_VAL;
    $this->PRIORITY_Q = $PRIO_Q;
    $this->MEMORY = $MEM;
    $this->PRIO = $PRIO;
  }
}
?>
