<script type="text/javascript" src="JSFunctions.js"></script>
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

//echo $selected_job->JOB_ID;

while (!$finish_flag) {
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
  // for ($i=0; $i < count($interactive_queue); $i++) {
  //   // code...
  //   debug_to_console("t= ".$time_counter.",".$interactive_queue[$i]->JOB_ID . "," . $interactive_queue[$i]->BT);
  // }
  if (count($system_queue) != 0) {
    // code...
    $system_queue[0]->FT = $time_counter+1;
    $system_queue[0]->BT -= 1;
    if ($system_queue[0]->BT == 0) {
      array_push($finish_queue,array_shift($system_queue));
      //display in gantt chart
    }//else
    // display in gantt chart

  }elseif (count($interactive_queue) != 0) {
    // code...
    $interactive_queue[0]->FT = $time_counter+1;
    $interactive_queue[0]->BT -= 1;
    if ($interactive_queue[0]->BT == 0) {
      array_push($finish_queue,array_shift($interactive_queue));
    }
  }elseif(count($batch_queue) != 0) {
    $batch_queue[0]->FT = $time_counter+1;
    $batch_queue[0]->BT -= 1;
    if ($batch_queue[0]->BT == 0) {
      array_push($finish_queue,array_shift($batch_queue));
    }
  }else{
    $finish_flag = true;
    break;
  }

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

displayValues($_SESSION['JOBS'],$_SESSION['finish_queue'],$_SESSION['bt_temp_list']);
 ?>
