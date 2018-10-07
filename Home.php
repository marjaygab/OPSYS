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
            <th colspan="6">Table</th>
        </tr>
        <tr>
            <th>JOB</th>
            <th>AT</th>
            <th>Priority</th>
            <th>Memory</th>
            <th>BT</th>
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
                    function displayValues($JOB_LIST){
                          for($i=0;$i<count($JOB_LIST);$i++){
                            echo "<tr>";
                                echo "<td>";
                                echo $JOB_LIST[$i]->JOB_ID;
                                echo "</td>";
                            echo "<td>";
                                echo $JOB_LIST[$i]->AT;
                                echo "</td>";
                            echo "<td>";
                                echo $JOB_LIST[$i]->PRIORITY;;
                                echo "</td>";
                            echo "<td>";
                                echo $JOB_LIST[$i]->MEMORY . ' KB';
                                echo "</td>";
                            echo "<td>";
                                echo $JOB_LIST[$i]->BT;;
                                echo "</td>";
                            echo "<td>";
                                echo $JOB_LIST[$i]->FT;;
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
                    $temp = new Job($matches[1][0],$matches[1][1],$matches[1][2],$matches[1][3],$matches[1][4]);
                    array_push($JOB_LIST,$temp);
                    $main_table[$tempindex]["FT"] = " ";
                    $tempindex++;
                }
                $tempnum++;
            }
            fclose($myfile);
            displayValues($JOB_LIST);

            //Insert code here for operations
            $system_queue = array();
            $interactive_queue = array();
            $batch_queue = array();
            $time_counter = 0;
            $finish_flag = false;
            $selected_job = findJob($time_counter,$JOB_LIST);
            //echo $selected_job->JOB_ID;

            while (!$finish_flag) {
              # code...
              $selected_job = findJob($time_counter,$JOB_LIST);
              if (!is_null($selected_job)) {
                # code...
                //echo 'Selected Job: ' . $selected_job->JOB_ID;
                switch ($selected_job->PRIORITY) {
                  case 'SYSTEM':
                    # code...
                    array_push($system_queue,$selected_job);
                    break;
                  case 'INTERACTIVE':
                      # code...
                    array_push($interactive_queue,$selected_job);
                      break;
                  case 'BATCH':
                        # code...
                    array_push($batch_queue,$selected_job);
                        break;
                      }



              }else{
                //echo 'No Job arrived';
                //check queues for remaining job
                //select job to execute
                //individual algos here maybe?

              }

              if ($time_counter==5) {
                # code...
                $finish_flag = true;
              }else{
                  $time_counter++;
              }

            }
            //print_r($system_queue);
             //print_r($interactive_queue);
            print_r($batch_queue);
            }
            ?>
    </table>
    </div>
</body>
</html>
