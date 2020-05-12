<?php
//get price
$prices = [11,12,18.9,11.0];
function calculatePrice(array $prices, $discount){
    $total_price=0;
  foreach ($prices as $price){
      $total_price = $total_price + $price ;
  }
  echo $total_price * $discount ;
}
//calculatePrice ($prices, 0.1);

//generate random
function generateRandom(){
    $num = 0;
    for($i=1; $i < 10; $i++){
        $num .= $i;
    }
    echo $num;
}
//generateRandom ();

//get smallest value which does not occurs in array.
$A = [1, 3, 6, 4, 1, 2];
for($i=1; in_array($i, $A); $i++);
//echo  $i;

//
