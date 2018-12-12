<?php
include "Functions.php";
$JOB_LIST = $_SESSION['JOBS'];
$PHYSICAL_MEM = $_SESSION['MEMORY'];
$max_size = $_SESSION['PM_SIZE'];
$time_counter = $_SESSION['time_counter'];
$_SESSION['arrivedjob'] = findinMem($time_counter,$JOB_LIST);
$job_arrived = $_SESSION['arrivedjob'];
$ready_queue = $_SESSION['ready_queue'];
if($job_arrived != NULL){
  //if(countEmptyPages($PHYSICAL_MEM) <= $max_size){
    array_push($ready_queue,$job_arrived);
    $remaining =countEmptyPages($PHYSICAL_MEM);
    $required = floor(($job_arrived->MEMORY)/2);
    if($required == 0){
      $required = 1;
    }
    if($remaining >= $required){

      for ($i=0; $i < sizeof($PHYSICAL_MEM); $i++) {
        if ($PHYSICAL_MEM[$i]->isempty && $required !=0) {
              $PHYSICAL_MEM[$i]->assign_Job($job_arrived);
              $required--;
        }
      }
      displayMemValues($PHYSICAL_MEM);
    }

  //}
}else {
  displayMemValues($PHYSICAL_MEM);
}





 ?>
