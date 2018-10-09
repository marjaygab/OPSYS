<?php
include 'Job.php';
session_start();
 ?>
<html>
<head>
<title>Multilevel Queue</title>
<style>
 @font-face{
 font-family:'digital-7';
 src: url('SAMPLE/digital-7.ttf');
}

body {
  margin: 0;
  background: linear-gradient(45deg,  #4d648d, #283655);
  font-family: sans-serif;
  font-weight: 100;
   height: 100%;
	font-family: sans-serif;
        overflow: auto;
}
.container {
   width: 100%;
  position: fixed;

  top: 0%;
  left: 0%;
  -webkit-transform: translate(-50%, -50%);
          transform: translate(-50%, -50%);
}
table {
    position: fixed;
    margin-top: 26%;
    margin-left: 52%;
  width: auto;
  border-collapse: collapse;
  display: block;
  overflow: auto;

  box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
}

.upload {
    position: fixed;
    margin-top: 20%;
    margin-left: 52%;
  width: 500px;

}

.Execute{
    position: fixed;
    margin-top: 43%;
    margin-left: 52%;
  width: 100px;
}
.step{
       position: fixed;
    margin-top: 43%;
    margin-left: 63%;
  width: 100px;
}

label{
    font-size: 10px;
}
.gantt{
  position:fixed;
  margin-top:17%;
  margin-left: 132%;
  height: 550px;
  width: 250px;
  overflow: hidden;
  border-collapse: collapse;
  box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);

}
.timer {

  position: fixed;
  margin-top: 26%;
  margin-left: 118%;

}
.timer H1{
    font-family:'digital-7';
    font-size: 5em;
}

.gantt thead th {
    background-color: #13547a;
    width: 250px;
}

.gantt tbody tr {

    width: 250px;
}
.gantt tbody td {

    width: 120;
    align-items: center;
}

.Q1{
  position:fixed;
  margin-top: 26%;
  margin-left: 85%;
  width: auto;
  border-collapse: collapse;
  box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
}
.Q1 tbody{
    display: block;
    height: 170px;
  overflow-y: auto;
}
.Q2 tbody{
    display: block;
    height: 170px;
  overflow-y: auto;
}
.Q3 tbody{
    display: block;
    height: 170px;
  overflow-y: auto;
}
.gantt tbody{
    display: block;
    height: 550px;
  overflow-y: auto;
}

.Q2{
  position:fixed;
  margin-top: 26%;
  margin-left: 95%;
  width: auto;
   border-collapse: collapse;
  box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
}

.Q3{
  position:fixed;
  margin-top: 26%;
  margin-left: 105%;
  width: auto;
    border-collapse: collapse;
  box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
}

th,
td {
  padding: 10px;
  background-color: rgba(255, 255, 255, 0.2);
  color: #fff;
  font-size: 15px;
}
th {
  text-align: left;
}
thead th {
  background-color: #1e1f26;
}
tbody tr:hover {
  background-color: rgba(255, 255, 255, 0.3);
}
tbody td {
  position: relative;
}
tbody td:hover:before {
  content: "";
  position: absolute;
  left: 0;
  right: 0;
  top: autox;
  bottom: auto;
  background-color: rgba(255, 255, 255, 0.2);
  z-index: -1;
}

.input-file-container {
    display: inline;
  position: relative;
  width: 225px;
  border-radius: 10px;
}
.js .input-file-trigger {
  display: inline;
  padding: 14px 45px;
  background: #39D2B4;
  color: #fff;
  font-size: 15px;
  transition: all .4s;
  cursor: pointer;
  border-radius: 10px;
}
.js .input-file {
  position: absolute;
  top: 0; left: 0;
  width: 225px;
  opacity: 0;
  padding: 14px 0;
  cursor: pointer;
  border-radius: 10px;
}
.js .input-file:hover + .input-file-trigger,
.js .input-file:focus + .input-file-trigger,
.js .input-file-trigger:hover,
.js .input-file-trigger:focus {
  background: #34495E;
  color: #39D2B4;
}

.file-return {
    font-size: 50px;
    color: white;
  margin: 0;
}
.file-return:not(:empty) {
  margin: 1em 0;
}
.js .file-return {
  font-style: italic;
  font-size: 20px;
  font-weight: bold;
}
.js .file-return:not(:empty):before {
  content: "Selected file: ";
  font-style: normal;
  font-weight: normal;
}

input[type=submit] {
  background-color: #0693cd;
  border: 0;
  border-radius: 5px;
  cursor: pointer;
  color: #fff;
  font-size:16px;
  font-weight: bold;
  line-height: 1.4;
  padding: 10px;
  width: 180px
}
input[type=submit] :hover + .input-file-trigger,
input[type=submit]:focus + .input-file-trigger,
input[type=submit]:hover,
input[type=submit]:focus {
  background: #1e1f26;
  color: #fff;
}

/* header CSS */
@import url(https://fonts.googleapis.com/css?family=Roboto:400,700);
:root {
	/* Base font size */
	font-size: 10px;

	/* Heading height variable*/
	--heading-height: 30em;
}

header {
	position: fixed;
	width: 100%;
	height: var(--heading-height);
}

/* Create angled background with 'before' pseudo-element */
header::before {
	content: "";
	display: block;
	position: absolute;
	left: 0;
	bottom: 5em;
	width: 100%;
	height: calc(var(--heading-height) + 5em);
	z-index: -1;
	transform: skewY(-2.5deg);
	background:
		linear-gradient(rgba(0,0,0,.6), rgba(0,0,0,.6)),
		url(https://wallpaper-house.com/data/out/7/wallpaper2you_170209.jpg) no-repeat center,
		linear-gradient(#4e4376, #2b5876);
	background-size: cover;
	border-bottom: .2em solid #fff;
}

h1 {
	font-size: calc(2.8em + 2.6vw);
	font-weight: 700;
	letter-spacing: .01em;
	padding: 0 0 0 4.5rem;
	text-shadow: .022em .022em .022em #111;
	color: #fff;
        margin-bottom: 0px;
}


h2 {
	font-size:30px;
	font-weight: 500;
	letter-spacing: .01em;
	padding: 0 0 0 4.5rem;
	text-shadow: .022em .022em .022em #111;
	color: #fff;
}

main {
	padding: calc(var(--heading-height) + 1.5vw) 4em 0;
}
</style>

<link href='https://fonts.googleapis.com/css?family=Orbitron' rel='stylesheet' type='text/css'>
</head>
<body>
  <header>
	   <h1>Multilevel Queue</h1>
      <h2>First Come First Serve | Shortest Remaining Time First | Preemptive Priority</h2>
  </header>
    <div class="container">
       <div class="upload">
         <form  enctype="multipart/form-data" action="Home.php" method="POST">
           <div class="input-file-container">
             <input class="input-file" id="my-file" type="file" name="data-file" accept='.txt'>
             <label tabindex="0" for="my-file" class="input-file-trigger">Select a file...</label>
             <input type="submit" name="upload"/>
           </div>
           <p class="file-return"></p>
         </form>
       </div>
       <table>
         <thead>
           <tr>
             <th colspan="7"><center>Uploaded Data</center></th>
           </tr>
           <tr>
            <th>JOB</th>
            <th>AT</th>
            <th>Priority Queue</th>
            <th>Memory</th>
            <th>BT</th>
            <th>Priority</th>
            <th>FT</th>
          </tr>
        </thead>
             <?php
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
                    if ($AT == $JOB_LIST[$i]->AT) {
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


              if(isset($_POST['upload'])){
                      //Insert Functions
                //Code for uploading to $_SERVER['DOCUMENT_ROOT']
                $_SESSION['JOBS'] = array();
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
                $_SESSION['time_counter'] = getLeastAT($_SESSION['JOBS']);
                $_SESSION['finish_flag'] = false;
                $_SESSION['finish_queue'] = array();
                $_SESSION['selected_job'] = findJob($_SESSION['time_counter'],$_SESSION['JOBS']);
                $_SESSION['bt_temp_list'] = array();
                $_SESSION['bt_temp_list'] = copyBT($_SESSION['JOBS']);
              }
                if (isset($_POST['execute']) && $_SESSION['JOBS']!=NULL) {
                $JOB_LIST = $_SESSION['JOBS'];
                $system_queue = $_SESSION['system_queue'];
                $interactive_queue = $_SESSION['interactive_queue'];
                $batch_queue = $_SESSION['batch_queue'];
                $time_counter = $_SESSION['time_counter'];
                $finish_flag = $_SESSION['finish_flag'];
                $finish_queue = $_SESSION['finish_queue'];
                $_SESSION['selected_job'] = findJob($time_counter,$JOB_LIST);
                $selected_job = $_SESSION['selected_job'];

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

                if (isset($_POST['Step']) && $_SESSION['JOBS']!=NULL) {
                  // code...
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
                  //displayValues($_SESSION['JOBS'],$_SESSION['finish_queue'],$bt_temp_list);
                  postdisplayValues($_SESSION['JOBS']);
                }
                ?>
              </table>
              <div class="Execute">
                <form action="Home.php" method="post">
                  <div class="input-file-container">
                    <input type="submit" name="execute" value="Execute">
                  </div>
                </form>
              </div>
              <div class="step">
                <form action="Home.php" method="post">
                  <div class="input-file-container">
                    <input type="submit" name="Step" value="Step">
                  </div>
                </form>
              </div>
              <table class="gantt" id="my-table">
                <thead>
                  <tr>
                    <th colspan="2"><center>Gantt Chart</center></th>
                  </tr>
		                <tr>
                      <th><center>Time</center></th>
                      <th><center>Job</center></th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                    </tr>
                  </tbody>
                </table>
                  <table class="Q1">
                    <thead>
                      <tr>
                        <th colspan="1"><center>Q1</center></th>
                        <th colspan="2">FCFS</th>
                      </tr>
		                    <tr>
                          <th><center>JOB</center></th>
                          <th><center>AT</center></th>
                          <th><center>BT</center></th>
                        </tr>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
                    <table class="Q2">
                      <thead>
                        <tr>
                          <th colspan="1"><center>Q2</center></th>
                          <th colspan="2">SRTF</th>
                        </tr>
                        <tr>
                          <th><center>JOB</center></th>
                          <th><center>AT</center></th>
                          <th><center>BT</center></th>
                        </tr>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
                    <table class="Q3">
                      <thead>
                        <tr>
                          <th colspan="1"><center>Q3</center></th>
                          <th colspan="2">PP</th>
                        </tr>
		                      <tr>
                            <th><center>JOB</center></th>
                            <th><center>AT</center></th>
                            <th><center>BT</center></th>
                          </tr>
                        </thead>
                        <tbody>
                        </tbody>
                      </table>
                      <div class="timer">
                        <h1 id="title" style="font-family: 'Orbitron', sans-serif;">000</h1>
                        <button id="my-button" >Test</button>
                        <button id="my-5thbutton">5x</button>
                        <input type="button" value="Add row" onclick="javascript:appendRow()" class="append_row">
                      </div>
                    </div>
                    <script>
                    document.querySelector("html").classList.add('js');

                    var fileInput  = document.querySelector( ".input-file" ),
                    button     = document.querySelector( ".input-file-trigger" ),
                    the_return = document.querySelector(".file-return");
                    button.addEventListener( "keydown", function( event ) {
                      if ( event.keyCode == 13 || event.keyCode == 32 ) {
                        fileInput.focus();
                      }
                    });
                    button.addEventListener( "click", function( event ) {
                      fileInput.focus();
                      return false;
                    });
                    fileInput.addEventListener( "change", function( event ) {
                      the_return.innerHTML = this.value;
                    });
                    </script>
                    <script>
                    var p = 6;
                    var j = 0;
                    var button = document.getElementById("my-button");
                    var times = 0;
                    var title = document.getElementById("title");
                    var time = -1;
                    var myInterval;
                    var tbl = document.getElementById('my-table'), // table reference
                    row = tbl.insertRow(tbl.rows.length),      // append table row
                    i;
                    button.addEventListener("click", function(event){
                      myInterval = setInterval (function(){
                        time ++;
                        appendRow(j++);

                        title.innerHTML = time;
                      }, 1000);
                    });

                    function appendRow(j) {
                      var tbl = document.getElementById('my-table'), // table reference
                      row = tbl.insertRow(tbl.rows.length),      // append table row
                      i;
                      // insert table cells to the new row
                      for (i = 0; i < 2; i++) {
                        createCell(row.insertCell(i), j, 'row');
                      }
                    }

                    // create DIV element and append to the table cell
                    function createCell(cell, text, style) {
                      var div = document.createElement('div'), // create DIV element
                      txt = document.createTextNode(text); // create text node
                      div.appendChild(txt);                    // append text node to the DIV
                      div.setAttribute('class', style);        // set DIV class attribute
                      div.setAttribute('className', style);    // set DIV class attribute for IE (?!)
                      cell.appendChild(div);                   // append DIV to the table cell
                    }


                    </script>
                  </body>
                  </html>
