<?php

$obj1 = new Object(5,8,"J3");
$obj2 = new Object(6,2,"J4");
$obj3 = new Object(20,35,"J1");
$obj4 = new Object(3,1,"J2");

$obj_array = array($obj1,$obj2,$obj3,$obj4);

function cmp($obj1,$obj2){
  return strcmp(($obj1->id),($obj2->id));
}

foreach ($obj_array as $variable) {
  // code...
  echo $variable->id . ",";
}
echo "</br>";
usort($obj_array,"cmp");
echo "</br>";

foreach ($obj_array as $variable) {
  // code...
  echo $variable->id . ",";
}


  /**
   *
   */
  class Object
  {
    public $firstnum;
    public $secondnum;
    public $id;
    function __construct($number,$number2,$jid)
    {
      // code...
      $this->firstnum = $number;
      $this->secondnum = $number2;
      $this->id = $jid;
    }
  }


 ?>
