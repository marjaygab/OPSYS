<?php
include 'Functions.php';
$JOB_LIST = $_SESSION['JOBS'];
$ready_queue = $_SESSION['ready_queue'];
$system_queue = $_SESSION['system_queue'];
$interactive_queue = $_SESSION['interactive_queue'];
$batch_queue = $_SESSION['batch_queue'];
$time_counter = $_SESSION['time_counter'];
$finish_flag = $_SESSION['finish_flag'];
$finish_queue = $_SESSION['finish_queue'];
$selected_job = $_SESSION['selected_job'];
$executed_job = $_SESSION['executed_job'];
$PHYSICAL_MEM = $_SESSION['MEMORY'];
//Test Revision

  if(isFinish($JOB_LIST,$finish_queue) == false){
    for ($i=0; $i < sizeof($ready_queue) ; $i++) {
      if (!is_null($ready_queue[$i])) {
        switch ($ready_queue[$i]->PRIORITY_Q) {
          case 'SYSTEM':
            if(!search($ready_queue[$i]->JOB_ID,$system_queue)){
                array_push($system_queue,$ready_queue[$i]);
                $ready_queue[$i] = NULL;
            }
            break;
          case 'INTERACTIVE':
            if(!search($ready_queue[$i]->JOB_ID,$interactive_queue)){
              array_push($interactive_queue,$ready_queue[$i]);
              $interactive_queue = srtfSort($interactive_queue);
              $ready_queue[$i] = NULL;
            }
              break;
          case 'BATCH':
            if(!search($ready_queue[$i]->JOB_ID,$batch_queue)){
              array_push($batch_queue,$ready_queue[$i]);
              $batch_queue = ppSort($batch_queue);
              $ready_queue[$i] = NULL;
            }
                break;
          }
      }
    }

    $ready_queue = refactorArray($ready_queue);
    if (count($system_queue) != 0) {
      $system_queue[0]->FT = $time_counter;
      $system_queue[0]->BT -= 1;
      $executed_job = $system_queue[0];

      if ($system_queue[0]->BT == 0) {
        removefromMem($PHYSICAL_MEM,$system_queue[0]->JOB_ID);
        array_push($finish_queue,array_shift($system_queue));
      }

    }elseif (count($interactive_queue) != 0) {
      $interactive_queue[0]->FT = $time_counter;
      $interactive_queue[0]->BT -= 1;
      $executed_job = $interactive_queue[0];
      if ($interactive_queue[0]->BT == 0) {
        removefromMem($PHYSICAL_MEM,$interactive_queue[0]->JOB_ID);
        array_push($finish_queue,array_shift($interactive_queue));

      }
    }elseif(count($batch_queue) != 0) {

      $batch_queue[0]->FT = $time_counter;
      $batch_queue[0]->BT -= 1;
      $executed_job = $batch_queue[0];
      if ($batch_queue[0]->BT == 0) {
        removefromMem($PHYSICAL_MEM,$batch_queue[0]->JOB_ID);
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
    solveATBT($ready_queue,$_SESSION['bt_temp_list']);
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
$_SESSION['ready_queue'] = $ready_queue;
$_SESSION['MEMORY'] = $PHYSICAL_MEM;
displayValues($_SESSION['JOBS'],$_SESSION['finish_queue'],$_SESSION['bt_temp_list']);

 ?>
