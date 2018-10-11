<?php
include 'Job.php';
session_start();

for ($i=0; $i < count($_SESSION['interactive_queue']); $i++) {
  // code...
  echo '<tr>';
  echo '<td>';
  echo $_SESSION['interactive_queue'][$i]->JOB_ID;
  echo '</td>';
  echo '<td>';
  echo $_SESSION['interactive_queue'][$i]->AT;
  echo '</td>';
  echo '<td>';
  echo $_SESSION['interactive_queue'][$i]->BT;
  echo '</td>';
  echo '</tr>';
}

 ?>
