<?php
include 'Functions.php';
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
          margin-top: 21%;
          margin-left: 52%;
        width: auto;
        height: 300px;
        border-collapse: collapse;
        display: block;
        overflow: auto;

        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
      }
      .upload {
          position: fixed;
          margin-top: 15%;
          margin-left: 52%;
        width: 500px;

      }
      .Execute{
          position: fixed;
          margin-top: 45%;
          margin-left: 52%;
        width: 100px;
      }
      .step{
             position: fixed;
          margin-top: 45%;
          margin-left: 66%;
        width: 100px;
      }
      .pause{
          position: fixed;
          margin-top: 45%;
          margin-left: 79%;
          width: 100px;
      }

      label{
          font-size: 10px;
      }
      .gantt {
        position:fixed;
        margin-top:10%;
        margin-left: 88%;
        height: 550px;
        width: 150px;
        overflow: auto;
        border-collapse: collapse;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);

      }
      .Q4 {
         position:fixed;
        margin-top: 25%;
        margin-left: 70%;
        width: 13%;
        height: 200px;
        border-radius:20px;
        border-collapse: collapse;
        background-color:#1e1f26;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
      }
      .timer H1{
           align-self:center;
           margin-top: -10%;
           margin-left: -23%;
          font-family:'digital-7';
          font-size: 10em;
          color: #d50700;
      }
      .timer H2{
          margin-top: 0;
          width: 13%;
          margin-left: -5%;
          align-self:center;
          font-family:'digital-7';
          font-size: 3em;
          font-weight: 20px;
          color: #fff;

      }
      .gantt thead th {
          background-color: #13547a;
          width: 250px;
      }
      .gantt tbody {
          overflow: auto;
      }
      .gantt tbody tr {
          width: 250px;
      }
      .gantt tbody td {
          width: 55px;
          align-items: center;
      }


 /* --------------------- Q1 Css Design -------------------------  */
      .Q1{
        position:fixed;
        margin-top: 21%;
        margin-left: 40%;
        width: auto;
        border-collapse: collapse;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        border-radius: 20px;
      }
      .Q1 thead th{

        background-color: #1e3c72;
      }
      .Q1 tbody{
          display: block;
          height: 200px;
         overflow-y: auto;
      }
       .Q1 tbody td  {
          display: absolute;
        width: 27%;
        overflow-y: auto;
      }

 /* --------------------- Q2 Css Design -------------------------  */
      .Q2 tbody{
          display: block;
          height: 200px;
        overflow-y: auto;
      }
      .Q2 tbody tr  {
          display: absolute;
        width: 100%;
        overflow-y: auto;
      }
       .Q2 tbody td  {
          display: absolute;
        width: 27%;
        overflow-y: auto;
      }
      .Q2 thead th{
        background-color:#2a5298;
      }

/* --------------------- Q3 Css Design -------------------------  */
      .Q3 tbody{
          display: block;
          height: 200px;
        overflow-y: auto;
      }

       .Q3 tbody td  {
          display: absolute;
        width: 27%;
        overflow-y: auto;
      }
      .gantt tbody{
          display: block;
          height: 550px;
        overflow-y: auto;
      }
      .Q2{
        position:fixed;
        margin-top: 21%;
        margin-left: 50%;
        width: auto;
        border-radius: 20px;
         border-collapse: collapse;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
      }
      .Q3{
        position:fixed;
        margin-top: 21%;
        margin-left: 60%;
        width: auto;
       border-radius: 20px;
          border-collapse: collapse;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
      }
      .Q3 thead th{
         background-color: #2c3e50;

      }
      th,
      td {
        padding: 8px;
        background-color: rgba(255, 255, 255, 0.2);
        color: #fff;
        display: absolute;
        font-size: 15px;
        align-self:center;
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
        top: auto;
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
      	transform: skewY(-2deg);
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
              margin-top: 10px;
      }
      h2 {
      	font-size:25px;
      	font-weight: 500;
      	letter-spacing: .01em;
      	padding: 0 0 0 4.5rem;
      	text-shadow: .022em .022em .022em #111;
      	color: #fff;
      }



 /*-- Step Button CSS ---------*/
 @import url("https://fonts.googleapis.com/css?family=Montserrat:300,400");
*,
*::before,
*::after {
  box-sizing: border-box;
}

:root {
  --color-primary-500: #FFEB3B;
  --color-primary-600: #FDD835;
  --color-primary-900: #F57F17;
  --color-secondary-500: #009688;
  --color-secondary-900: #004D40;
  --font-primary: "Montserrat", sans-serif;
}



.btn {
  position: relative;
  display: inline-block;
  margin: 0;
  padding: 1.5rem 4.5rem;
  background: #48c6ef ;
  color: white;
  font-family: inherit;
  font-size: 2rem;
  font-weight: 500;
  line-height: normal;
  border: 0;
  border-radius: 2rem;
  box-shadow: -1px 1px 8px rgba(0, 0, 0, 0.4);
  -webkit-appearance: none;
     -moz-appearance: none;
          appearance: none;
  cursor: pointer;
  transition: background 250ms, box-shadow 250ms;
}
.btn:hover {
  background:#489cef;
  box-shadow: -2px 2px 16px rgba(0, 0, 0, 0.6);
}
.btn:active, .btn:focus {
  outline: none;
}
.btn:active {
  box-shadow: -4px 4px 24px rgba(0, 0, 0, 0.8);
}

.btn .text {
  position: relative;
  z-index: 2;
}

.btn .dot {
  position: absolute;
  z-index: -1;
  display: block;
  width: 200px;
  height: 10px;
  -webkit-transform-origin: 5px 5px;
          transform-origin: 5px 5px;
  pointer-events: none;
}
.btn .dot:nth-child(1) {
  top: 50%;
  left: 100%;
  -webkit-transform: translate3d(-10px, -5px, 0);
          transform: translate3d(-10px, -5px, 0);
}
.btn .dot:nth-child(2) {
  bottom: 0;
  left: 100%;
  -webkit-transform: translate3d(-10px, 0, 0) rotate(45deg);
          transform: translate3d(-10px, 0, 0) rotate(45deg);
}
.btn .dot:nth-child(3) {
  bottom: 0;
  left: 50%;
  -webkit-transform: translate3d(-5px, 0, 0) rotate(90deg);
          transform: translate3d(-5px, 0, 0) rotate(90deg);
}
.btn .dot:nth-child(4) {
  bottom: 0;
  left: 0;
  -webkit-transform: rotate(135deg);
          transform: rotate(135deg);
}
.btn .dot:nth-child(5) {
  top: 50%;
  left: 0;
  -webkit-transform: translate3d(0, -5px, 0) rotate(180deg);
          transform: translate3d(0, -5px, 0) rotate(180deg);
}
.btn .dot:nth-child(6) {
  top: 0;
  left: 0;
  -webkit-transform: rotate(225deg);
          transform: rotate(225deg);
}
.btn .dot:nth-child(7) {
  top: 0;
  left: 50%;
  -webkit-transform: translate3d(-5px, 0, 0) rotate(270deg);
          transform: translate3d(-5px, 0, 0) rotate(270deg);
}
.btn .dot:nth-child(8) {
  top: 0;
  left: 100%;
  -webkit-transform: translate3d(-10px, 0, 0) rotate(315deg);
          transform: translate3d(-10px, 0, 0) rotate(315deg);
}
.btn .dot::before {
  position: absolute;
  top: 0;
  left: 0;
  display: block;
  width: 6px;
  height: 6px;
  background-color: var(--color-primary-500);
  border-radius: 50%;
  offset-path: path("M0 1c7.1 0 10.7 2 14.3 4s7.1 4 14.3 4 10.7-2 14.3-4 7.2-4 14.3-4 10.7 2 14.3 4 7.1 4 14.3 4 10.7-2 14.3-4 7.1-4 14.3-4 10.7 2 14.3 4 7.1 4 14.3 4 10.7-2 14.3-4 7.1-4 14.3-4 10.7 2 14.3 4 7.1 4 14.3 4");
  offset-distance: 0;
  pointer-events: none;
  content: "";
}

.btn.is-animating .dot::before {
  -webkit-animation: dot 750ms cubic-bezier(0.215, 0.61, 0.355, 1);
          animation: dot 750ms cubic-bezier(0.215, 0.61, 0.355, 1);
}

@-webkit-keyframes dot {
  0% {
    offset-distance: 0%;
    opacity: 1;
  }
  100% {
    offset-distance: 100%;
    opacity: 0;
  }
}

@keyframes dot {
  0% {
    offset-distance: 0%;
    opacity: 1;
  }
  100% {
    offset-distance: 100%;
    opacity: 0;
  }
}


/* button execute CSS design */


.btns {
  position: relative;
  display: inline-block;
  margin: 0;
  padding: 1.5rem 4.5rem;
  background: #3498db;
  color: white;
  font-family: inherit;
  font-size: 2rem;
  font-weight: 500;
  line-height: normal;
  border: 0;
  border-radius: 2rem;
  box-shadow: -1px 1px 8px rgba(0, 0, 0, 0.4);
  -webkit-appearance: none;
     -moz-appearance: none;
          appearance: none;
  cursor: pointer;
  transition: background 250ms, box-shadow 250ms;
}


  &:hover,
  &:focus {
    color: #fff;
    outline: 0;
  }



.third {
  border-color: #0d924f;
  color: #fff;
  box-shadow: 0 0 40px 40px #0d924f inset, 0 0 0 0 #0d924f;
  transition: all 150ms ease-in-out;
}
.third:hover {
  box-shadow: 0 0 10px 0 #3498db inset, 0 0 10px 4px #3498db;
}


/* pause button css design */
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
.btnpause {
  position: relative;
  display: inline-block;
  margin: 0;
  padding: 1.5rem 4.5rem;
  background: #3498db;
  color: white;
  font-family: inherit;
  font-size: 2rem;
  font-weight: 500;
  line-height: normal;
  border: 0;
  border-radius: 2rem;
  box-shadow: -1px 1px 8px rgba(0, 0, 0, 0.4);
  -webkit-appearance: none;
     -moz-appearance: none;
          appearance: none;
  cursor: pointer;
  transition: background 250ms, box-shadow 250ms;
}
.btnpause:hover {
	animation: bounce 1s;
}
  </style>
  <link href='https://fonts.googleapis.com/css?family=Orbitron' rel='stylesheet' type='text/css'>
  </head>
  <body>
    <header style="height:200px;">
      <h1>Multilevel Queue</h1>
      <h2> First Come First Serve | Shortest Remaining Time First | Preemptive Priority</h2>
    </header>
    <script src="jquery-3.3.1/jquery-3.3.1.min.js" type="text/javascript"></script>
    <script type="text/javascript">
      $(document).ready(function() {
        // $('#execute_btn').click(function() {
        //   $('#t_body').load('Execute.php');
        // });
        var time = -1;
        $('#step_btn').click(function() {

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
        clearInterval(myInterval);
        });

        $('#execute_btn').click(function(){

          myInterval = setInterval(function(){
            var isFinish = $('#finish_label').html();
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
        <tbody id="t_body">
          <?php
           if(isset($_POST['upload'])){
             initializeData();
           }
           ?>
          <div id="execute_div"></div>
          <div id="step_div"></div>
        </tbody>
              </table>

                <!-- <form action="Home.php" method="post"> -->

                   <div class="Execute">
                <!-- <form action="Home.php" method="post"> -->
                  <div class="input-file-container">
                      <button id="execute_btn" type="submit" name="execute" value="Execute" class="btns third">Execute</button>
                  </div>
                <!-- </form> -->
              </div>
              <div class="step">
                <!-- <form action="Home.php" method="post"> -->
                  <div class="input-file-container">

                      <button id="pause_btn" type="submit" name="Step" value="Step" class="btnpause">Pause</button>
                </div>



                  </div>
           <div class="pause">
                <!-- <form action="Home.php" method="post"> -->
                  <div class="input-file-container">

                     <button id="step_btn" type="submit" name="Step" value="Step" class="btn">
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
     <script>var $btn = document.querySelector('.btn');

$btn.addEventListener('click', function (e) {
  window.requestAnimationFrame(function () {
    $btn.classList.remove('is-animating');

    window.requestAnimationFrame(function () {
      $btn.classList.add('is-animating');
    });
  });
});</script>
</body>
</html>
