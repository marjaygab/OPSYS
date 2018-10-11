<?php
  $job = findJob(); //find job that started at time.
  if (!is_null($selected_job)) {
    switch ($selected_job->PRIORITY_Q) {
      case 'SYSTEM':
        //put to system queue
        //sort according to algorithm
        break;
      case 'INTERACTIVE':
      // put to interactive Queue
      //sort according to algorithm
          break;
      case 'BATCH':
      // put to batch Queue
      //sort according to algorithm
            break;
      }
  }
  if (count($system_queue) != 0) {
  //do operation on the first value in the system queue
  }elseif (count($interactive_queue) != 0) {
    //do operation on the first value in the interactive_queue
  }elseif(count($batch_queue) != 0) {
//do operation on the first value in the batch queue
  }
  //check if all the jobs are finished
  //if not increment time
//display values
 ?>
