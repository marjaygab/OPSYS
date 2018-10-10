<?php
include 'Job.php';
session_start();

for ($i=0; $i < count($_SESSION['batch_queue']); $i++) {
  // code...
  echo '<tr>';
  echo '<td>';
  echo $_SESSION['batch_queue'][$i]->JOB_ID;
  echo '</td>';
  echo '<td>';
  echo $_SESSION['batch_queue'][$i]->AT;
  echo '</td>';
  echo '<td>';
  echo $_SESSION['batch_queue'][$i]->BT;
  echo '</td>';
  echo '</tr>';
}

 ?>
