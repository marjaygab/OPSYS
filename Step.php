<?php
include 'Functions.php';
$JOB_LIST = $_SESSION['JOBS'];
$system_queue = $_SESSION['system_queue'];
$interactive_queue = $_SESSION['interactive_queue'];
$batch_queue = $_SESSION['batch_queue'];
$time_counter = $_SESSION['time_counter'];
$finish_flag = $_SESSION['finish_flag'];
$finish_queue = $_SESSION['finish_queue'];
$_SESSION['selected_job'] = findJob($time_counter,$JOB_LIST);
$selected_job = $_SESSION['selected_job'];
// $GANTT_FT = $_SESSION['GANTT_FT'];
// $GANTT_JOB_ID = $_SESSION['GANTT_JOB_ID'];
  $selected_job = findJob($time_counter,$JOB_LIST);
  if (!is_null($selected_job)) {
    switch ($selected_job->PRIORITY_Q) {
      case 'SYSTEM':
        array_push($system_queue,$selected_job);
        //display in respective queue
        break;
      case 'INTERACTIVE':
        array_push($interactive_queue,$selected_job);
        $interactive_queue = srtfSort($interactive_queue);
        //display in respective queue
          break;
      case 'BATCH':
        array_push($batch_queue,$selected_job);
        $batch_queue = ppSort($batch_queue);
        //display in respective queue
            break;
      }
  }
  if (count($system_queue) != 0) {
    // code...
    $system_queue[0]->FT = $time_counter+1;
    $system_queue[0]->BT -= 1;
    $GANTT_FT = $system_queue[0]->FT;
    $GANTT_JOB_ID = $system_queue[0]->JOB_ID;
    array_push($_SESSION['GANTT_FT'],$GANTT_FT);
    array_push($_SESSION['GANTT_JOB_ID'],$GANTT_JOB_ID);
    //echo '<script type="text/javascript"> appendRow(' . $system_queue[0]->JOB_ID . "," . $system_queue[0]->FT . ');</script>';
    if ($system_queue[0]->BT == 0) {
      array_push($finish_queue,array_shift($system_queue));
      //display in gantt chart
    }//else
    // display in gantt chart
  }elseif (count($interactive_queue) != 0) {
    // code...
    $interactive_queue[0]->FT = $time_counter+1;
    $interactive_queue[0]->BT -= 1;

    //$GANTT_JOB_ID = $interactive_queue[0]->JOB_ID;
    $GANTT_FT = $interactive_queue[0]->FT;
    $GANTT_JOB_ID = $interactive_queue[0]->JOB_ID;
    array_push($_SESSION['GANTT_FT'],$interactive_queue[0]->FT);
    array_push($_SESSION['GANTT_JOB_ID'],$interactive_queue[0]->JOB_ID);
    //echo '<script type="text/javascript"> appendRow(' . $interactive_queue[0]->JOB_ID . "," . $interactive_queue[0]->FT . ');</script>';
    if ($interactive_queue[0]->BT == 0) {
      array_push($finish_queue,array_shift($interactive_queue));
    }
  }elseif(count($batch_queue) != 0) {
    $batch_queue[0]->FT = $time_counter+1;
    $batch_queue[0]->BT -= 1;
    $GANTT_FT = $batch_queue[0]->FT;
    $GANTT_JOB_ID = $batch_queue[0]->JOB_ID;

    array_push($_SESSION['GANTT_FT'],$GANTT_FT);
    array_push($_SESSION['GANTT_JOB_ID'],$GANTT_JOB_ID);
    //echo '<script type="text/javascript"> appendRow(' . $batch_queue[0]->JOB_ID . "," . $batch_queue[0]->FT . ');</script>';
    if ($batch_queue[0]->BT == 0) {
      array_push($finish_queue,array_shift($batch_queue));
    }
  }else{
    $finish_flag = true;
  }
  if($finish_flag != true){
      $time_counter++;
  }
$finish_queue = finishSort($finish_queue);
$_SESSION['JOBS'] = $JOB_LIST;
$_SESSION['system_queue'] = $system_queue;
$_SESSION['interactive_queue'] = $interactive_queue;
$_SESSION['batch_queue'] = $batch_queue;
$_SESSION['time_counter'] = $time_counter;
$_SESSION['finish_flag']  = $finish_flag;
$_SESSION['finish_queue'] = $finish_queue;
// $_SESSION['GANTT_FT'] = $GANTT_FT;
// $_SESSION['GANTT_JOB_ID'] = $GANTT_JOB_ID;
displayValues($_SESSION['JOBS'],$_SESSION['finish_queue'],$_SESSION['bt_temp_list']);

 ?>
