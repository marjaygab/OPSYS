<?php

$obj1 = new Object(0,1,"J1");
$obj2 = new Object(1,8,"J2");
$obj3 = new Object(2,2,"J3");
$obj4 = new Object(3,1,"J4");

$obj_array = array($obj1,$obj2,$obj3,$obj4);

function cmp($obj1,$obj2){
  if(($obj1->secondnum)==($obj2->secondnum)){
    return ($obj1->firstnum)>=($obj2->firstnum);
  }else{
    return ($obj1->secondnum)>=($obj2->secondnum);
  }
}

foreach ($obj_array as $variable) {
  // code...
  echo "[" . $variable->id . "," .  $variable->secondnum . "]";
}


echo "</br>";
usort($obj_array,"cmp");
echo "</br>";


foreach ($obj_array as $variable) {
  // code...
    echo "[" . $variable->id . "," . $variable->secondnum . "]";
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
