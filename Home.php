<?php
include 'Functions.php';
 ?>
<html>
  <head>
    <title>Multilevel Queue</title>
    <link rel="stylesheet" href="Main.css">
    <link href='https://fonts.googleapis.com/css?family=Orbitron' rel='stylesheet' type='text/css'>
    <script src="Others\jquery-3.3.1\jquery-3.3.1.min.js" type="text/javascript"></script>
    <script type="text/javascript">
      $(document).ready(function() {
        var time = -1;

        function disableButtons(exec,step,pause){
          $('#execute_btn').attr('disabled',exec);
          $('#step_btn').attr('disabled',step);
          $('#pause_btn').attr('disabled',pause);
        }

        //disableButtons(true,true,true);

        $('#step_btn').click(function() {
          disableButtons(false,false,true);
          var isFinish = $('#finish_label').html();
          if(isFinish != true){
            $('#t_body').load('Step.php');
            $('#gantt_chart').load('Gantt.php');
            $('#fcfs_chart').load('FCFS_Queue.php');
            $('#srtf_chart').load('SRTF_Queue.php');
            $('#pp_chart').load('PP_Queue.php');
              if(time != -1){
                $('#title').html(time);
              }
              else {
                $('#title').html(0);
              }
              time++;
          }
          $('#finish_label').load('isFinish.php');
        });

        $('#pause_btn').click(function() {
          disableButtons(false,false,true);
        clearInterval(myInterval);
        });

        $('#execute_btn').click(function(){
          disableButtons(true,true,false);
          myInterval = setInterval(function(){
            var isFinish = $('#finish_label').html();
            $('#execute_btn').prop('disabled',true);
            $('#step_btn').prop('disabled',true);
            $('#pause_btn').prop('disabled',false);

            if(isFinish){
              clearInterval(myInterval);
            }else{
              $('#t_body').load('Step.php');
              $('#gantt_chart').load('Gantt.php');
              $('#fcfs_chart').load('FCFS_Queue.php');
              $('#srtf_chart').load('SRTF_Queue.php');
              $('#pp_chart').load('PP_Queue.php');
              if(time != -1){
                $('#title').html(time);
              }
              else {
                $('#title').html(0);
              }
              time++;
            }
            $('#finish_label').load('isFinish.php');
          },1000);
        });
      });
  </script>
  </head>
  <body>
    <header style="height:200px;">
      <h1>Multilevel Queue</h1>
      <h2> First Come First Serve | Shortest Remaining Time First | Preemptive Priority</h2>
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
        <span id="finish_label" hidden></span>
      </div>
      <table>
        <thead>
        <tr>
          <th colspan="9"><center>Uploaded Data</center></th>
        </tr>
        <tr>
          <th>JOB</th>
          <th>AT</th>
          <th>Priority Queue</th>
          <th>Memory</th>
          <th>BT</th>
          <th>Priority</th>
          <th>FT</th>
          <th>TT</th>
          <th>WT</th>
        </tr>
      </thead>
        <tbody id="t_body">
          <?php
           if(isset($_POST['upload'])){
             initializeData();
             echo isset($_POST['upload'])== true ? 'disabled' : '';
           }
          ?>
          <div id="execute_div"></div>
          <div id="step_div"></div>
        </tbody>
      </table>
      <div class="Execute">
        <div class="input-file-container">
          <button id="execute_btn" type="submit" name="execute" value="Execute" class="btns third" <?php echo (isset($_POST['upload'])== true ? '' : 'disabled'); ?>>Execute</button>
        </div>
      </div>
      <div class="pause">
        <div class="input-file-container">
          <button id="pause_btn" type="submit" name="pause" value="pause" class="btnpause" <?php echo (isset($_POST['upload'])== true ? '' : 'disabled');?>>Pause</button>
        </div>
      </div>
      <div class="step">
        <div class="input-file-container">
          <button id="step_btn" type="submit" name="Step" value="Step" class="btn" <?php echo (isset($_POST['upload']) == true ? '' : 'disabled');?>>
            <span class="dot"></span>
            <span class="dot"></span>
            <span class="dot"></span>
            <span class="dot"></span>
            <span class="dot"></span>
            <span class="dot"></span>
            <span class="dot"></span>
            <span class="dot"></span>
            <span class="text">Step</span>
          </button>
        </div>
      </div>
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
      <tbody id="gantt_chart">
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
      <tbody id="fcfs_chart">
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
      <tbody id="srtf_chart">
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
        <tbody id="pp_chart">
        </tbody>
      </table>
      <div class="Q4">
        <div class="timer">
          <h2 style="font-family: 'Orbitron', sans-serif;">TIMER</h2>
          <h1 id="title" style="font-family: 'Orbitron', sans-serif;">00</h1>
        </div>
      </div>
    </div>
    <script type="text/javascript" src="JSFunctions.js"></script>
    <script>
    var $btn = document.querySelector('.btn');
      $btn.addEventListener('click', function (e) {
        window.requestAnimationFrame(function () {
          $btn.classList.remove('is-animating');
          window.requestAnimationFrame(function () {
            $btn.classList.add('is-animating');
          });
        });
      });
    </script>
  </body>
</html>
