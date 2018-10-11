<?php
include 'Job.php';
session_start();

function getLeastAT($JOB_LIST){
    for($i=0 ; $i < count($JOB_LIST) ; $i++){
        $temparray[$i] = $JOB_LIST[$i]->AT;
    }
    sort($temparray);
    return $temparray[0];
}

function getMaxAT($JOB_LIST){
    for($i=0 ; $i < count($JOB_LIST) ; $i++){
        $temparray[$i] = $JOB_LIST[$i]->AT;
    }
    sort($temparray);
    return $temparray[count($JOB_LIST)-1];
}

function copyBT($JOB_LIST){
  $bt_temp_list = array();
  for ($i=0; $i < count($JOB_LIST); $i++) {
    // code...
    array_push($bt_temp_list,$JOB_LIST[$i]->BT);
  }
  return $bt_temp_list;
}
 //For loop to display the stored values.
function displayValues($JOB_LIST,$finish_queue,$bt_temp_list){
      for($i=0;$i<count($JOB_LIST);$i++){
        echo "<tr>";
            echo "<td>";
            echo $JOB_LIST[$i]->JOB_ID;
            echo "</td>";
        echo "<td>";
            echo $JOB_LIST[$i]->AT;
            echo "</td>";
        echo "<td>";
            echo $JOB_LIST[$i]->PRIORITY_Q;
            echo "</td>";
        echo "<td>";
            echo $JOB_LIST[$i]->MEMORY . ' KB';
            echo "</td>";
        echo "<td>";
            echo $bt_temp_list[$i];
            echo "</td>";
        echo "<td>";
            echo $JOB_LIST[$i]->PRIO;
            echo "</td>";
        echo "<td>";
            if (count($finish_queue)<=$i) {
              // code...
                echo '0';
            }else{
                echo $finish_queue[$i]->FT;
            }
            echo "</td>";
        echo "</tr>";
    }
}

function predisplayValues($JOB_LIST){
      for($i=0;$i<count($JOB_LIST);$i++){
        echo "<tr>";
            echo "<td>";
            echo $JOB_LIST[$i]->JOB_ID;
            echo "</td>";
        echo "<td>";
            echo $JOB_LIST[$i]->AT;
            echo "</td>";
        echo "<td>";
            echo $JOB_LIST[$i]->PRIORITY_Q;
            echo "</td>";
        echo "<td>";
            echo $JOB_LIST[$i]->MEMORY . ' KB';
            echo "</td>";
        echo "<td>";
            echo $JOB_LIST[$i]->BT;
            echo "</td>";
        echo "<td>";
            echo $JOB_LIST[$i]->PRIO;
            echo "</td>";
        echo "<td>";
            echo $JOB_LIST[$i]->FT;
            echo "</td>";
        echo "</tr>";
    }
}
function postdisplayValues($JOB_LIST){
      for($i=0;$i<count($JOB_LIST);$i++){
        echo "<tr>";
            echo "<td>";
            echo $JOB_LIST[$i]->JOB_ID;
            echo "</td>";
        echo "<td>";
            echo $JOB_LIST[$i]->AT;
            echo "</td>";
        echo "<td>";
            echo $JOB_LIST[$i]->PRIORITY_Q;
            echo "</td>";
        echo "<td>";
            echo $JOB_LIST[$i]->MEMORY . ' KB';
            echo "</td>";
        echo "<td>";
            echo $JOB_LIST[$i]->BT;
            echo "</td>";
        echo "<td>";
            echo $JOB_LIST[$i]->PRIO;
            echo "</td>";
        echo "<td>";
            echo $JOB_LIST[$i]->FT;

            echo "</td>";
        echo "</tr>";
    }
}
function findJob($AT,$JOB_LIST){

  for ($i=0; $i <count($JOB_LIST) ; $i++) {
    # code...
    if ($AT == ($JOB_LIST[$i]->AT)+1) {
      # code...
      return $JOB_LIST[$i];
    }
  }
  return  NULL;
}

function startedJob($AT,$JOB_LIST){

  for ($i=0; $i <count($JOB_LIST) ; $i++) {
    # code...
    if ($AT == (($JOB_LIST[$i]->AT))) {
      # code...
      return $JOB_LIST[$i];
    }
  }
  return  NULL;
}

function debug_to_console( $data ) {
  $output = $data;
  if ( is_array( $output ) )
      $output = implode( ',', $output);

  echo "<script>console.log( 'Debug Objects: " . $output . "' );</script>";
}
//Sort interactive queue according to SRTF algo (BT wise)
function srtfSort($interactive_queue){
    usort($interactive_queue,"ascendingBT");
    return $interactive_queue;
}

function ppSort($batch_queue){
    usort($batch_queue,"ascendingPP");
    return $batch_queue;
}

function finishSort($finish_queue){
  usort($finish_queue,"ascendingFinish");
  return $finish_queue;
}
//usort function for BT sorting
function ascendingBT($JOB1,$JOB2){
  if(($JOB1->BT)==($JOB2->BT)){
    return ($JOB1->AT)>=($JOB2->AT);
  }else{
    return ($JOB1->BT)>=($JOB2->BT);
  }
}

function descendingBT($JOB1,$JOB2){
  if(($JOB1->BT)==($JOB2->BT)){
    return ($JOB1->AT)<=($JOB2->AT);
  }else{
    return ($JOB1->BT)<=($JOB2->BT);
  }
}

//usort function for PP sorting
function ascendingPP($JOB1,$JOB2){
  if(($JOB1->PRIO)==($JOB2->PRIO)){
    return ($JOB1->AT)>=($JOB2->AT);
  }else{
    return ($JOB1->PRIO)>=($JOB2->PRIO);
  }
}
function descendingPP($JOB1,$JOB2){
  if(($JOB1->PRIO)==($JOB2->PRIO)){
    return ($JOB1->AT)<=($JOB2->AT);
  }else{
    return ($JOB1->PRIO)<=($JOB2->PRIO);
  }
}

function ascendingFinish($JOB1,$JOB2){
  $temp1 = $JOB1->JOB_ID;
  $temp2 = $JOB2->JOB_ID;
  preg_match_all('!\d+!', $temp1, $matches);
  $var1 = implode(' ', $matches[0]);

  preg_match_all('!\d+!', $temp2, $matches);
  $var2 = implode(' ', $matches[0]);
  return $var1>=$var2;
}

function isFinish($JOB_LIST,$finish_queue)
{
  if (count($JOB_LIST) == count($finish_queue)) {
    // code...
    return true;
  }
  else{
    return false;
  }
}
function initializeData(){
    //Insert Functions
  //Code for uploading to $_SERVER['DOCUMENT_ROOT']
  $_SESSION['JOBS'] = array();
  $_SESSION['GANTT_FT'] = array();
  $_SESSION['GANTT_JOB_ID'] = array();
  $_SESSION['GANTT_LIST'] = array();
  //  $JOB_LIST = array();
  if($_FILES["data-file"]["error"] >0){
  echo "Error:" . $_FILES["data-file"]["error"] . "<br />";
  }
  else{
  $uploaddir = $_SERVER['DOCUMENT_ROOT'] . '/';
  $uploadfile = $uploaddir . basename($_FILES['data-file']['name']);
  $filename = $_FILES["data-file"]["name"];
  move_uploaded_file($_FILES["data-file"]["tmp_name"],$uploadfile);
  }

  $myfile = fopen($uploadfile,"r") or die("Unable to open file!");
  $tempnum = 0;
  $tempindex = 0;
  //While loop for getting table values and inserting it to main_table multidimensional array.
  while(!feof($myfile)){
  $line = fgets($myfile);
  preg_match_all("/<(.*?)>/", $line,$matches);
  if($tempnum!==0){
      $temp = new Job($matches[1][0],$matches[1][1],$matches[1][2],$matches[1][3],$matches[1][4],$matches[1][5]);
      array_push($_SESSION['JOBS'],$temp);
      $main_table[$tempindex]["FT"] = " ";
      $tempindex++;
  }
  $tempnum++;
  }
  fclose($myfile);
  predisplayValues($_SESSION['JOBS']);

  $_SESSION['system_queue'] = array();
  $_SESSION['interactive_queue'] = array();
  $_SESSION['batch_queue'] = array();
  $_SESSION['time_counter'] = 0;
  $_SESSION['finish_flag'] = false;
  $_SESSION['finish_queue'] = array();
  $_SESSION['selected_job'] = findJob($_SESSION['time_counter'],$_SESSION['JOBS']);
  $_SESSION['bt_temp_list'] = array();
  $_SESSION['bt_temp_list'] = copyBT($_SESSION['JOBS']);
  $_SESSION['executed_job'] = NULL;

}

function execute(){
    // code...
  //Insert code here for operations
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
  // echo "</br>";
  // $batch_queue = ppSort($batch_queue);
  // print_r($batch_queue);
}

function step(){
  $JOB_LIST = $_SESSION['JOBS'];
  $system_queue = $_SESSION['system_queue'];
  $interactive_queue = $_SESSION['interactive_queue'];
  $batch_queue = $_SESSION['batch_queue'];
  $time_counter = $_SESSION['time_counter'];
  $finish_flag = $_SESSION['finish_flag'];
  $finish_queue = $_SESSION['finish_queue'];
  $_SESSION['selected_job'] = findJob($time_counter,$JOB_LIST);
  $selected_job = $_SESSION['selected_job'];

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
      //echo '<script type="text/javascript"> appendRow(' . $system_queue->JOB_ID . "," . $system_queue->FT . ');</script>';
      echo '<script type= "text/javascript">' . 'alert(' . $system_queue->JOB_ID . ');' . '</script>';
      if ($system_queue[0]->BT == 0) {
        array_push($finish_queue,array_shift($system_queue));
      }//else
      // display in gantt chart
    }elseif (count($interactive_queue) != 0) {
      // code...
      $interactive_queue[0]->FT = $time_counter+1;
      $interactive_queue[0]->BT -= 1;
      //echo '<script type="text/javascript"> appendRow(' . $interactive_queue->JOB_ID . "," . $interactive_queue->FT . ');</script>';
      echo '<script type= "text/javascript">' . 'alert(' . $interactive_queue->JOB_ID . ');' . '</script>';
      if ($interactive_queue[0]->BT == 0) {

        array_push($finish_queue,array_shift($interactive_queue));
      }
    }elseif(count($batch_queue) != 0) {
      $batch_queue[0]->FT = $time_counter+1;
      $batch_queue[0]->BT -= 1;
      if ($batch_queue[0]->BT == 0) {
      //echo '<script type="text/javascript"> appendRow(' . $batch_queue->JOB_ID . "," . $batch_queue->FT . ');</script>';
      echo '<script type= "text/javascript">' . 'alert(' . $batch_queue->JOB_ID . ');' . '</script>';
        array_push($finish_queue,array_shift($batch_queue));
      }
    }else{
      $finish_flag = true;
    }
  $time_counter++;
  $finish_queue = finishSort($finish_queue);
  $_SESSION['JOBS'] = $JOB_LIST;
  $_SESSION['system_queue'] = $system_queue;
  $_SESSION['interactive_queue'] = $interactive_queue;
  $_SESSION['batch_queue'] = $batch_queue;
  $_SESSION['time_counter'] = $time_counter;
  $_SESSION['finish_flag']  = $finish_flag;
  $_SESSION['finish_queue'] = $finish_queue;
}

function testData($num){
  $num = $num + 1;
  return $num;
}


 ?>
