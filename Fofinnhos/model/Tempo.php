<?php

class Tempo{
  public function minimo()
  {
  	return date('Y-m-d',strtotime('-120 years'));
   }
   public function maximo()
   {
   	return date('Y-m-d',strtotime('-18 years'));
   }
   public function minpet()
   {
    return date('Y-m-d',strtotime('-20 years'));
   }
   public function maxpet()
   {
     return date('Y-m-d',strtotime('-3 months'));
   }
}
?>

	
