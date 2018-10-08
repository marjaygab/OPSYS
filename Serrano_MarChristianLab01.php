<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
    
       <center>
           
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
        <input type="file" name="file" size="60"/>
        <input type="submit" value="RUN"/>
        </form>
           
  <!-- Getting all the Inputs in Text File -->
        <?php
        if($_FILES){
        
            if($_FILES['file']['name'] != "") {
            
        $fileName = $_FILES['file']['tmp_name'];
        $file = fopen($fileName, "r");
        $i = 0;      
        while (!feof($file)) {  
            $temp[$i] = fgets($file);   
            $temp[$i];
            $i++;
        }
            
        fclose($file);
        }
        
   // Removing All the J in inputs // 
        
        $noofjobs = preg_replace('/[^\p{L}\p{N}\s]/u', '', $temp[0]); 
        
        ?>
        
        <?php
        
        for ($j=1;$j<=$noofjobs;$j++){       
            $symbols = array('<', '>');
            $others  = array(' ', ' ');
            $job[$j] = str_replace($symbols, $others, $temp[$j]); 
        }
            ?>
            <?php
            for ($j=1;$j<=$noofjobs;$j++){
                list($a,$b,$c) = explode("  ", $job[$j]);
                $proc[$j][0] = $b;
                $proc[$j][1] = $c;
        }
               
      
        $total_time = 0;
        $min = 99;
        for ($i=1;$i<=$noofjobs;$i++){
            $addtime = $proc[$i][1];
            settype($addtime, "integer");
            $total_time = $total_time + $addtime;
            if ($proc[$i][0] < $min){
                $min = $proc[$i][0];
                $min_proc = $i;
            }
        }
        $add_time = $proc[$min_proc][0];
        settype($add_time, "integer");
        $total_time = $total_time + $add_time;
        
      
        $min = 99;
        $sel_proc=0;
        for ($t = 0;$t<=$total_time;$t++){
            for ($i=1;$i<=$noofjobs;$i++){
                if ($proc[$i][0] <= $t) {   
                    if ($proc[$i][1]<$min && $proc[$i][1]!=0){ 
                        $min = $proc[$i][1];
                        $sel_proc = $i;
                    }
                                     
                    }
                }
                $min = 99;
                if ($sel_proc > 0){
                $oldBT = $proc[$sel_proc][1];
                settype($oldBT, "integer");
                $newBT= $oldBT - 1;
                settype($newBT, "String");
                $proc[$sel_proc][1] = $newBT;
                    if ($proc[$sel_proc][1] == 0){ 
                        $proc_time[$sel_proc] = $t+1;
            }
                }
            $sel_proc =0;
        }
        ?>
           
        <table width="200" border="1">
            <tr>
                <td>JOB</td>
                <td>AT</td>
                <td>BT</td>
                <td>FT</td>
                
            </tr>  
            <?php
            for ($j=1;$j<=$noofjobs;$j++){
            list($a,$b,$c) = explode("  ", $job[$j]);
                $proc[$j][0] = $b;
                $proc[$j][1] = $c;
                ?>
            <tr>
                <td><?php echo $a?></td>
                <td><?php echo $b?></td>
                <td><?php echo $c?></td>
                <td><?php echo $proc_time[$j] ?></td>
            </tr>
              <?php  
            }
        }
            ?>
        </table>
        
       </center>      
    </body>
</html>
