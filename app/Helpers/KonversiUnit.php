<?php

function konversi($rasio,$jumlah,$harga_bahan)
{
  $cCounter = $jumlah*$rasio;
  $sub = $harga_bahan * $cCounter;
  return ["hasil"=>$cCounter,"harga"=>round($sub)];
}
function _distance($lat1, $lon1, $lat2, $lon2, $unit) {
  // https://maps.googleapis.com/maps/api/distancematrix/json?units=km&origins=-6.734388142327505,107.43869778364251&destinations=-6.880350267473086,107.6118826553161&key=AIzaSyD1cM44pjtWnEej7CgCeCVtYx5D70ImTdQ
  $client = new GuzzleHttp\Client();
  $res = $client->request('GET', 'https://maps.googleapis.com/maps/api/distancematrix/json?units=km&origins=-6.734388142327505,107.43869778364251&destinations=-6.880350267473086,107.6118826553161&key=AIzaSyD1cM44pjtWnEej7CgCeCVtYx5D70ImTdQ');
  $res = json_decode($res->getBody());
  if (isset($res->rows[0]->elements[0]->distance->value)) {
    return $res->rows[0]->elements[0]->distance->value;
  }else {
    return false;
  }
}
