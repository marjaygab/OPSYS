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
$executed_job = $_SESSION['executed_job'];
// $GANTT_FT = $_SESSION['GANTT_FT'];
// $GANTT_JOB_ID = $_SESSION['GANTT_JOB_ID'];


  if(isFinish($JOB_LIST,$finish_queue) == false){
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
    }else {
      //debug_to_console('Null at Time' . $_SESSION['time_counter']);
    }

    if (count($system_queue) != 0) {
      $system_queue[0]->FT = $time_counter;
      $system_queue[0]->BT -= 1;
      $executed_job = $system_queue[0];
      //echo '<script type="text/javascript"> appendRow(' . $system_queue[0]->JOB_ID . "," . $system_queue[0]->FT . ');</script>';
      if ($system_queue[0]->BT == 0) {
        array_push($finish_queue,array_shift($system_queue));
        //display in gantt chart
      }//else
      // display in gantt chart
    }elseif (count($interactive_queue) != 0) {
      // code...

      $interactive_queue[0]->FT = $time_counter;
      $interactive_queue[0]->BT -= 1;
      $executed_job = $interactive_queue[0];
      //echo '<script type="text/javascript"> appendRow(' . $interactive_queue[0]->JOB_ID . "," . $interactive_queue[0]->FT . ');</script>';
      if ($interactive_queue[0]->BT == 0) {
        array_push($finish_queue,array_shift($interactive_queue));
      }
    }elseif(count($batch_queue) != 0) {

        $batch_queue[0]->FT = $time_counter;
        $batch_queue[0]->BT -= 1;
        $executed_job = $batch_queue[0];
      //echo '<script type="text/javascript"> appendRow(' . $batch_queue[0]->JOB_ID . "," . $batch_queue[0]->FT . ');</script>';
      if ($batch_queue[0]->BT == 0) {
        array_push($finish_queue,array_shift($batch_queue));
      }
    }else {
      $executed_job = NULL;
    }

    if(is_null($executed_job)){
      array_push($_SESSION['GANTT_FT'],$time_counter);
      array_push($_SESSION['GANTT_JOB_ID'],'  ');
    }else{
      array_push($_SESSION['GANTT_FT'],$executed_job->FT);
      array_push($_SESSION['GANTT_JOB_ID'],$executed_job->JOB_ID);
    }
    $finish_flag = false;
    $time_counter++;
  }
  else{
    $finish_flag = true;
  }

$finish_queue = finishSort($finish_queue);
$_SESSION['JOBS'] = $JOB_LIST;
$_SESSION['system_queue'] = $system_queue;
$_SESSION['interactive_queue'] = $interactive_queue;
$_SESSION['batch_queue'] = $batch_queue;
$_SESSION['time_counter'] = $time_counter;
$_SESSION['finish_flag']  = $finish_flag;
$_SESSION['finish_queue'] = $finish_queue;
$_SESSION['executed_job'] = $executed_job;
// $_SESSION['GANTT_FT'] = $GANTT_FT;
// $_SESSION['GANTT_JOB_ID'] = $GANTT_JOB_ID;
displayValues($_SESSION['JOBS'],$_SESSION['finish_queue'],$_SESSION['bt_temp_list']);

 ?>
