<?php
include 'Functions.php';
 ?>
<html>
  <head>
    <title>Multilevel Queue</title>
    <link rel="stylesheet" href="style/Main.css">
    <link href='https://fonts.googleapis.com/css?family=Orbitron' rel='stylesheet' type='text/css'>
    <script src="Others\jquery-3.3.1\jquery-3.3.1.min.js" type="text/javascript"></script>
    <script type="text/javascript">
      $(document).ready(function() {
        var time = -1;
        var selected_speed = $('#speed_select').val();
        //toggleControls(true,true,true,false,false);
        function toggleControls(exec,step,pause,ss,list){
          $('#execute_btn').attr('disabled',exec);
          $('#step_btn').attr('disabled',step);
          $('#pause_btn').attr('disabled',pause);
          $('#set_speed').attr('disabled',ss);
          $('#set_speed').attr('disabled',ss);
          $('#speed_select').attr('disabled',list);
        }

        $('#set_speed').click(function() {
          selected_speed = $('#speed_select').val();
          alert(selected_speed + ' ms simulation speed set!');
        });


        $('#step_btn').click(function() {
          toggleControls(false,false,true,true,true);
          var isFinish = $('#finish_label').html();
          if(isFinish != true){
            $('#memory').load('MemManage.php');
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
          toggleControls(false,false,true,false,false);
        clearInterval(myInterval);
        });

        $('#execute_btn').click(function(){
          toggleControls(true,true,false,true,true);
          myInterval = setInterval(function(){
            var isFinish = $('#finish_label').html();
            $('#execute_btn').prop('disabled',true);
            $('#step_btn').prop('disabled',true);
            $('#pause_btn').prop('disabled',false);

            if(isFinish){
              clearInterval(myInterval);
            }else{
              $('#memory').load('MemManage.php');
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
          },selected_speed);
        });
      });
  </script>
  <style>
      .back {
	border: none;
	background: #3a7999;
	color: #f2f2f2;
	padding: 10px;
	font-size: 18px;
	border-radius: 5px;
	position: relative;
	box-sizing: border-box;
	transition: all 500ms ease;
}
@keyframes bounce {
	0%, 20%, 60%, 100% {
		-webkit-transform: translateY(0);
		transform: translateY(0);
	}

	40% {
		-webkit-transform: translateY(-20px);
		transform: translateY(-20px);
	}

	80% {
		-webkit-transform: translateY(-10px);
		transform: translateY(-10px);
	}
}
a {
color:inherit;
    text-decoration: none;
}
.back:hover {
	animation: bounce 1s;
            cursor: pointer;
}
      </style>
      <script type="text/javascript">
    document.getElementById("myButton").onclick = function () {
        location.href = "OptionTab.php";
    };
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

            <button class="back" onClick="location.href='OptionTab.php'" ><a href="OptionTab.php">🠔 Go Back</a></button>
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
           if(isset($_POST['upload']) && $_FILES["data-file"]["error"] == 0){
             initializeData();
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

      <table class="memo" id="my-table">
      <thead>
        <tr>
          <th colspan="3"><center>Memory Offset</center></th>
        </tr>
        <tr>
          <th><center>Page Number</center></th>
          <th><center>Offset</center></th>
      <th><center>Job</center></th>
        </tr>
      </thead>
      <tbody id="memory">
        <tr>
            <td><center>0</center></td>
      <td><center>0 - 1</center></td>
      <td><center></center></td>
      </tr>
              <tr>
      <td><center>1</center></td>
      <td><center>2 - 3</center></td>
      <td><center></center></td>
        </tr>
        <tr>
      <td><center>2</center></td>
      <td><center>4 - 5</center></td>
      <td><center></center></td>
        </tr>
        <tr>
      <td><center>3</center></td>
      <td><center>6 - 7</center></td>
      <td><center></center></td>
        </tr>
        <tr>
      <td><center>4</center></td>
      <td><center>8 - 9</center></td>
      <td><center></center></td>
        </tr>
        <tr>
      <td><center>5</center></td>
      <td><center>10 - 11</center></td>
      <td><center></center></td>
        </tr>
        <tr>
      <td><center>6</center></td>
      <td><center>12 - 13</center></td>
      <td><center></center></td>
        </tr>
        <tr>
      <td><center>7</center></td>
      <td><center>14 - 15</center></td>
      <td><center></center></td>
        </tr>
        <tr>
      <td><center>8</center></td>
      <td><center>16 - 17</center></td>
      <td><center></center></td>
      </tr>
      <tr>
      <td><center>9</center></td>
      <td><center>18 - 19</center></td>
      <td><center></center></td>
        </tr>
        <tr>
      <td><center>10</center></td>
      <td><center>20 - 21</center></td>
      <td><center></center></td>
        </tr>
        <tr>
      <td><center>11</center></td>
      <td><center>22 - 23</center></td>
      <td><center></center></td>
        </tr>
        <tr>
      <td><center>12</center></td>
      <td><center>24 - 25</center></td>
      <td><center></center></td>
        </tr>
        <tr>
      <td><center>13</center></td>
      <td><center>26 - 27</center></td>
      <td><center></center></td>
        </tr>
        <tr>
      <td><center>14</center></td>
      <td><center>28 - 29</center></td>
      <td><center></center></td>
        </tr>
        <tr>
      <td><center>15</center></td>
      <td><center>30 - 31</center></td>
      <td><center></center></td>
        </tr>
        <tr>
      <td><center>16</center></td>
      <td><center>32 - 33</center></td>
      <td><center></center></td>
        </tr>
        <tr>
      <td><center>17</center></td>
      <td><center>34 - 35</center></td>
      <td><center></center></td>
        </tr>
        <tr>
      <td><center>18</center></td>
      <td><center>36 - 37</center></td>
      <td><center></center></td>
        </tr>
        <tr>
      <td><center>19</center></td>
      <td><center>38 - 39</center></td>
      <td><center></center></td>
        </tr>
        <tr>
      <td><center>20</center></td>
      <td><center>40 - 41</center></td>
      <td><center></center></td>
        </tr>
        <tr>
      <td><center>21</center></td>
      <td><center>42 - 43</center></td>
      <td><center></center></td>
        </tr>
        <tr>
      <td><center>22</center></td>
      <td><center>44 - 45</center></td>
      <td><center></center></td>
        </tr>
        <tr>
      <td><center>23</center></td>
      <td><center>46 - 47</center></td>
      <td><center></center></td>

        </tr>
        <tr>
      <td><center>24</center></td>
      <td><center>48 - 49</center></td>
      <td><center></center></td>
        </tr>
        <tr>
      <td><center>25</center></td>
      <td><center>50 - 51</center></td>
      <td><center></center></td>
        </tr>
        <tr>
      <td><center>26</center></td>
      <td><center>52 - 53</center></td>
      <td><center></center></td>
      </tr>
        <tr>
      <td><center>27</center></td>
      <td><center>54 - 55</center></td>
      <td><center></center></td>
        </tr>
        <tr>
      <td><center>28</center></td>
      <td><center>56 - 57</center></td>
      <td><center></center></td>
        </tr>
        <tr>
      <td><center>29</center></td>
      <td><center>58 - 59</center></td>
      <td><center></center></td>
        </tr>
        <tr>
      <td><center>30</center></td>
      <td><center>60 - 61</center></td>
      <td><center></center></td>
        </tr>
        <tr>
      <td><center>31</center></td>
      <td><center>62 - 63</center></td>
      <td><center></center></td>
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
        <div class="choice_group" name="group">
          <select id="speed_select" class="list_drop">
            <option value="1000" selected>1000 ms</option>
            <option value="500">500 ms</option>
            <option value="250">250 ms</option>
          </select>
          <span><button class="btns-small" id="set_speed" name="set_speed" value="set_speed">Set</button></span>
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
