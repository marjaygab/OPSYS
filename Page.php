<?php
   //include 'Job.php';
  class Page
  {
    public $isempty;
    public $size = 2;
    public $JOB_OWNER;
    //public $pageno;
    function __construct($isempty)
    {
      // code...
      $this->isempty = $isempty;
      $this->JOB_OWNER = NULL;
    }
    function assign_Job($JOB_OWNER){
      $this->isempty = false;
      $this->JOB_OWNER = $JOB_OWNER;
      //$this->$pageno = $pagenum;
    }
    function remove(){
      $this->isempty = true;
      $this->JOB_OWNER = NULL;
    }
    function replace($JOB_OWNER){
      $this->JOB_OWNER = $JOB_OWNER;
    }
  }


 ?>
