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
                    
                    function getLeastAT($main_table){
                        for($i=0 ; $i < count($main_table) ; $i++){
                            $temparray[$i] = $main_table[$i]['AT'];
                        }
                        sort($temparray);
                        return $temparray[0];
                    }
                    
                     //For loop to display the stored values.
                    function displayValues($copy_table,$main_table){
                          for($i=0;$i<count($copy_table);$i++){
                        echo "<tr>";
                            echo "<td>";
                            echo $copy_table[$i]['PID'];
                            echo "</td>";
                        echo "<td>";
                            echo $copy_table[$i]['AT'];
                            echo "</td>";
                        echo "<td>";
                            echo $copy_table[$i]['PRIORITY'];
                            echo "</td>";
                        echo "<td>";
                            echo $copy_table[$i]['MEMORY'] . ' KB';
                            echo "</td>";
                        echo "<td>";
                            echo $copy_table[$i]['BT'];
                            echo "</td>";
                        echo "<td>";
                            echo $main_table[$i]['FT'];
                            echo "</td>";
                        echo "</tr>";
                    }
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
                    $copy_table[$tempindex]["PRIORITY"] = $main_table[$tempindex]["PRIORITY"] = $matches[1][2];
                    $copy_table[$tempindex]["MEMORY"] = $main_table[$tempindex]["MEMORY"] = $matches[1][3];
                    $copy_table[$tempindex]["BT"] = $main_table[$tempindex]["BT"] = $matches[1][4];
                    $main_table[$tempindex]["FT"] = " ";
                    $tempindex++;
                }
                $tempnum++;   
            }
            fclose($myfile);
                   
            displayValues($copy_table,$main_table);
                    
            
                    
            }
            ?>
    </table>
    </div>
</body>
</html>