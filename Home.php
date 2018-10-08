<?php
include 'Job.php';

 ?>
<html>
<head>
<title>Multilevel Queue</title>
<style>
    table,tr,th,td{
        border: 1px solid black;
        border-collapse: collapse;
        margin: 0 auto;
    }
    .table-div{
        text-align: center;
    }
    .header{
        text-align: center;
    }
</style>
</head>
<body>
    <div class="header">
        <h1>Multilevel Queue</h1>
    </div>
    <div class="table-div">
        <form enctype="multipart/form-data" action="Home.php" method="POST">
            <input accept='.txt' type="file" name="data-file"/>
            <input type="submit" name="upload"/>
        </form>
        <table>
        <tr>
            <th colspan="7">Table</th>
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
            <?php
                if(isset($_POST['upload'])){

                  //Insert Functions here
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
                     //For loop to display the stored values.
                    function displayValues($JOB_LIST,$finish_queue){
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
                                echo $JOB_LIST[$i]->BT;;
                                echo "</td>";
                            echo "<td>";
                                echo $JOB_LIST[$i]->PRIO;
                                echo "</td>";
                            echo "<td>";
                                echo $finish_queue[$i]->FT;
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
                      return strcmp(($JOB1->JOB_ID),($JOB2->JOB_ID));
                    }


            //Code for uploading to $_SERVER['DOCUMENT_ROOT']
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
            $JOB_LIST = array();

            //While loop for getting table values and inserting it to main_table multidimensional array.
            while(!feof($myfile)){
                $line = fgets($myfile);
                preg_match_all("/<(.*?)>/", $line,$matches);
                if($tempnum!==0){
                    $temp = new Job($matches[1][0],$matches[1][1],$matches[1][2],$matches[1][3],$matches[1][4],$matches[1][5]);
                    array_push($JOB_LIST,$temp);
                    $main_table[$tempindex]["FT"] = " ";
                    $tempindex++;
                }
                $tempnum++;
            }
            fclose($myfile);


            //Insert code here for operations
            $system_queue = array();
            $interactive_queue = array();
            $batch_queue = array();
            $time_counter = getLeastAT($JOB_LIST);
            $finish_flag = false;
            $finish_queue = array();
            $selected_job = findJob($time_counter,$JOB_LIST);
            //echo $selected_job->JOB_ID;

            while (!$finish_flag) {
              $selected_job = findJob($time_counter,$JOB_LIST);
              if (!is_null($selected_job)) {
                switch ($selected_job->PRIORITY_Q) {
                  case 'SYSTEM':
                    array_push($system_queue,$selected_job);
                    break;
                  case 'INTERACTIVE':
                    array_push($interactive_queue,$selected_job);
                    $interactive_queue = srtfSort($interactive_queue);
                      break;
                  case 'BATCH':
                    array_push($batch_queue,$selected_job);
                    $batch_queue = ppSort($batch_queue);
                        break;
                  }
              }

              if (count($system_queue) != 0) {
                // code...
                $system_queue[0]->FT = $time_counter+1;
                $system_queue[0]->BT -= 1;
                if ($system_queue[0]->BT == 0) {
                  array_push($finish_queue,array_shift($system_queue));
                }
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
            displayValues($JOB_LIST,$finish_queue);
            // echo "</br>";
            // $batch_queue = ppSort($batch_queue);
            // print_r($batch_queue);
            }
            ?>
    </table>
    </div>
</body>
</html>
