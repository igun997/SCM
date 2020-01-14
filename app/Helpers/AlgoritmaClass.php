<?php

/**
 * Algoritma Exponansial Smooting
 */
class ES
{
  public $a = 0;
  function __construct($t = 0)
  {
    $this->a = (2 / ($t + 1));
  }
  public function setConstanta($a)
  {
    $this->a = $a;
  }
  public function singleCalc($ft,$dt)
  {
    return round($ft + $this->a * ($dt - $ft));
  }
  public function constanta()
  {
    return $this->a;
  }

}
/**
 * Algoritma Simple Moving Average
 */
class SMA
{
  public $n = [];
  public $t = 0;
  function __construct()
  {

  }
  public function setData($n)
  {
    $this->n = $n;
  }
  public function setPeriode($t)
  {
    $this->t = $t;
  }
  public function calc()
  {
    $cN = count($this->n);
    $cT = $this->t;
    if ($cN == $cT) {
      $n = array_sum($this->n);
      return round($n/$this->t);
    }else {
      return false;
    }
  }
}
