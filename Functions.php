<?php
include 'Job.php';
include 'Page.php';
session_start();

function findinMem($AT,$JOB_LIST){
  return findJob($AT,$JOB_LIST);
}

function countEmptyPages($PM)
{
  $temp = 0;
  for ($i=0; $i < sizeof($PM); $i++) {
    if($PM[$i]->isempty){
      $temp++;
    }
  }
  return $temp;
}
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

function solveATBT($JOB_LIST,$bt_temp_list){
  for ($i=0; $i < count($JOB_LIST); $i++) {
    $JOB_LIST[$i]->TT =($JOB_LIST[$i]->FT) - ($JOB_LIST[$i]->AT);
    $JOB_LIST[$i]->WT = ($JOB_LIST[$i]->TT) - $bt_temp_list[$i];
  }
}

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
        echo "<td>";
            echo
              $JOB_LIST[$i]->TT;
        echo "</td>";
        echo "<td>";
            echo
              $JOB_LIST[$i]->WT;
        echo "</td>";
        echo "</tr>";
    }
}

function displayMemValues($PHYSICAL_MEM){
      echo " ";
      $temp_counter = 0;
      $previous = 0;
      for($i=0;$i<sizeof($PHYSICAL_MEM);$i++){
        if(!$PHYSICAL_MEM[$i]->isempty){
          echo "<tr>";
              echo "<td>";
              echo $i;
              echo "</td>";
              echo "<td>";
              if($temp_counter != 0){
                $temp_counter = $temp_counter + 1;
              }
              echo $previous . " - " . ($temp_counter+=1);
              $previous = $temp_counter+1;
              echo "</td>";
              echo "<td>";
              echo $PHYSICAL_MEM[$i]->JOB_OWNER->JOB_ID;
              echo "</td>";
          echo "</tr>";
        }else{
          echo "<tr>";
            echo "<td>";
            echo $i;
            echo "</td>";
            echo "<td>";
            if($temp_counter != 0){
              $temp_counter = $temp_counter + 1;
            }

            echo $previous . " - " . ($temp_counter+=1);
            $previous = $temp_counter+1;
            echo "</td>";
            echo "<td>";
            echo "         ";
            echo "</td>";
          echo "</tr>";
        }
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
        echo "<td>";
          echo $JOB_LIST[$i]->TT;
        echo "</td>";
        echo "<td>";
          echo $JOB_LIST[$i]->WT;
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
  $_SESSION['PM_SIZE'] = 32; //pages
  $_SESSION['JOBS'] = array();
  $_SESSION['MEMORY'] = array();
  $_SESSION['GANTT_FT'] = array();
  $_SESSION['GANTT_JOB_ID'] = array();
  $_SESSION['GANTT_LIST'] = array();
  $_SESSION['execute_lock'] = false;
  $_SESSION['step_lock']= false;
  $_SESSION['pause_lock']= true;
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
  for ($i=0; $i < 32; $i++) {
    $temp = new Page(true);
    array_push($_SESSION['MEMORY'],$temp);
  }
  $_SESSION['ready_queue'] = array();
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

 ?>
