<?php
namespace Helpers;
use App\Models\Pengaturan as ModelPengaturan;
/**
 * Pengaturan
 */

class Pengaturan
{
  static function validity($id)
  {
    $set = ModelPengaturan::where(["meta_key"=>$id])->where("valid",">",date("Y-m-d"));
    if ($set->count() > 0) {
      return ["status"=>1,"msg"=>"Pengaturan Valid"];
    }else {
      return ["status"=>0,"msg"=>"Pengaturan Tidak Ditemukan / Tidak Valid"];
    }
  }
  static function ins($data)
  {
    $ins = ModelPengaturan::insert($data);
    if ($ins) {
      return true;
    }else {
      return false;
    }
  }
  static function get($data = null)
  {
    if ($data != null) {
      $get = ModelPengaturan::where($data);
      if ($get->count() > 0) {
        return $get;
      }else {
        return false;
      }
    }else {
      return ModelPengaturan::get();
    }
  }
  static function del($data){
    $del = ModelPengaturan::where($data)->delete();
    return $del;
  }
  static function up($glue,$data){
    $up = ModelPengaturan::where($glue);
    if ($up->count() > 0) {
      return $up->update($data);
    }else {
      return false;
    }
  }
}
