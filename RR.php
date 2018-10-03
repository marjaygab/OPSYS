<html>
<head>
<title>Round Robin Algorithm</title>
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
        <h1>Round Robin Algorithm</h1>
    </div>
    <div class="table-div">
        <form enctype="multipart/form-data" action="RR.php" method="POST">
            <input accept='.txt' type="file" name="data-file"/>
            <input type="submit" name="upload"/>
        </form>
        <table>
        <tr>
            <th colspan="4">Round Robin</th>
        </tr>
        <tr>
            <th>JOB</th>
            <th>AT</th>
            <th>BT</th>
            <th>FT</th>
        </tr>
            <?php
                if(isset($_POST['upload'])){
            //function to get the least AT
            //Params: $main_table - Main Table that contains all the values untouched.
            //Returns: Least AT in the list.
            function getLeastAT($main_table){
                for($i=0 ; $i < count($main_table) ; $i++){
                    $temparray[$i] = $main_table[$i]['AT'];
                }
                sort($temparray);
                return $temparray[0];
            }
                    
             //functions that checks if all the JOB is finished executing.        
            //Params: $main_table - Main Table that contains all the values untouched.
            //Returns: Boolean $done. True if the process are all done. 
            function checkifAllDone($main_table){
                $done = true;
                for($i=0;$i<count($main_table);$i++){
                    if($main_table[$i]['BT'] != 0){
                       $done = false;
                        break;
                    }
                }
                return $done;
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
                    
            //While loop for getting table values and inserting it to main_table multidimensional array.
            while(!feof($myfile)){
                $line = fgets($myfile);
                preg_match_all("/<(.*?)>/", $line,$matches);
                
                if($tempnum!==0){
                    $copy_table[$tempindex]["PID"] = $main_table[$tempindex]["PID"] = $matches[1][0];
                    $copy_table[$tempindex]["AT"] = $main_table[$tempindex]["AT"] = $matches[1][1];
                    $copy_table[$tempindex]["BT"] = $main_table[$tempindex]["BT"] = $matches[1][2];
                    $main_table[$tempindex]["FT"] = " ";
//                    print_r($main_table[$tempindex]);
                    $tempindex++;
                }
                else{
                    $quantum_value = $matches[1][1];
                    
                }
                $tempnum++;
                
            }
            
            $leastAT = getLeastAT($main_table);
            echo 'Quantum = '. $quantum_value;
            echo '<br/>';
           
                    
            fclose($myfile);
                $queue = array();
//                array_push($queue,$main_table[1]);
//                $queue[0]['BT']=$queue[0]['BT'] - $quantum_value;
//                array_push($queue,array_shift($queue));        
//                echo '<br/>';
//                print_r($queue[1]['BT']);
                    
                    $current_time = $leastAT;
                    $previous_time = $current_time;
                   while(!checkifAllDone($main_table)){
                       for($i = 0;$i<count($main_table);$i++){
                           if($main_table[$i]['AT']<=$current_time){
                               array_push($queue,array_shift($main_table));
                           }
                       }
                       
                       
                       if($queue[0]['BT'] >= $quantum_value ){
                          $queue[0]['BT'] = $queue[0]['BT'] -$quantum_value; 
                           $previous_time = $current_time;
                          $current_time = $current_time+$quantum_value; 
                           for($i = 0;$i<count($main_table);$i++){
                               if($main_table[$i]['AT']<=$current_time){
                                   array_push($queue,array_shift($main_table));
                                   for($i=0;$i<count($queue);$i++){
                                    echo $queue[$i]['PID'] ." ". $queue[$i]['BT'] . " ";
                                    }
                               }
                           }    
                           array_push($queue,array_shift($queue));
                         
                       }else{
                          $previous_time = $current_time;
                          $current_time = $current_time+$queue[0]['BT'];
                           
                           echo "<tr>";
                            echo "<td>";
                            echo $queue[0]['PID'];
                            echo "</td>";
                            echo "<td>";
                            echo $queue[0]['AT'];
                            echo "</td>";
                           echo "<td>";
                            echo $queue[0]['BT'];
                            echo "</td>";
                            echo "<td>";
                            echo $current_time;
                            echo "</td>";
                            echo "</tr>";
                           $queue[0]['BT'] = 0;
                           array_shift($queue);
                       }
                       
                   }
                  
                    
//                    //For loop to display the stored values.
//                    for($i=0;$i<count($copy_table);$i++){
//                        echo "<tr>";
//                            echo "<td>";
//                            echo $copy_table[$i]['PID'];
//                            echo "</td>";
//                        echo "<td>";
//                            echo $copy_table[$i]['AT'];
//                            echo "</td>";
//                        echo "<td>";
//                            echo $copy_table[$i]['BT'];
//                            echo "</td>";
//                        echo "<td>";
//                            echo $main_table[$i]['FT'];
//                            echo "</td>";
//                        echo "</tr>";
//                    }
                }
            ?>
    </table>
    </div>
</body>
</html>