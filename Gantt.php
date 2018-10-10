<?php
session_start();
for ($i=0; $i < count($_SESSION['GANTT_JOB_ID']); $i++) {
  // code...
  echo '<tr>';
  echo '<td>';
  echo $_SESSION['GANTT_FT'][$i];
  echo '</td>';
  echo '<td>';
  echo $_SESSION['GANTT_JOB_ID'][$i];
  echo '</td>';
  echo '</tr>';
}



 ?>
