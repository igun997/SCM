<?php

function konversi($rasio,$jumlah,$harga_bahan)
{
  $cCounter = $jumlah*$rasio;
  $sub = $harga_bahan * $cCounter;
  return ["hasil"=>$cCounter,"harga"=>round($sub)];
}
