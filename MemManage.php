<?php
include "Functions.php";
$JOB_LIST = $_SESSION['JOBS'];
$PHYSICAL_MEM = $_SESSION['MEMORY'];
$max_size = $_SESSION['PM_SIZE'];
$time_counter = $_SESSION['time_counter'];
$_SESSION['selected_job'] = findJob($time_counter,$JOB_LIST);
$job_arrived = $_SESSION['selected_job'];
$ready_queue = $_SESSION['ready_queue'];
$input_queue = $_SESSION['input_queue'];
if($job_arrived != NULL){
  //if(countEmptyPages($PHYSICAL_MEM) <= $max_size){
    array_push($input_queue,$job_arrived);
    $remaining =countEmptyPages($PHYSICAL_MEM);
    $required = floor(($job_arrived->MEMORY)/2);
    if($required == 0){
      $required = 1;
    }
    if($remaining >= $required){
      array_push($ready_queue,array_pop($input_queue));
      for ($i=0; $i < sizeof($PHYSICAL_MEM); $i++) {
        if ($PHYSICAL_MEM[$i]->isempty && $required !=0) {
              $PHYSICAL_MEM[$i]->assign_Job($job_arrived);
              $required--;
        }
      }
    }
  //}
  displayMemValues($PHYSICAL_MEM);
}else {
  for ($i=0; $i < sizeof($input_queue) ; $i++) {
    $remaining =countEmptyPages($PHYSICAL_MEM);
    $required = floor(($input_queue[$i]->MEMORY)/2);
    if($required == 0){
      $required = 1;
    }
    if($remaining >= $required){
      array_push($ready_queue,array_pop($input_queue));
      for ($i=0; $i < sizeof($PHYSICAL_MEM); $i++) {
        if ($PHYSICAL_MEM[$i]->isempty && $required !=0) {
              $PHYSICAL_MEM[$i]->assign_Job($input_queue[$i]);
              $required--;
        }
      }
    }
  }

  displayMemValues($PHYSICAL_MEM);
}


$_SESSION['ready_queue'] = $ready_queue;
$_SESSION['input_queue'] = $input_queue;

 ?>
