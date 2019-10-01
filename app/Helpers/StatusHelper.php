<?php
/**
 * Status Translation
 */
  function status_kendaraan($id)
 {
   if ($id == 0) {
     return "Aktif";
   }elseif ($id == 1) {
     return "Rusak";
   }elseif ($id == 2) {
     return "Terpakai";
   }else {
     return "Tidak Diketahui";
   }
 }
  function status_pesanan($id)
 {
   if ($id == 0) {
     return "Belum Diproses";
   }elseif ($id == 1) {
     return "Sedang Diproses";
   }elseif ($id == 2) {
     return "Sedang Dikirm";
   }elseif ($id == 3) {
     return "Pengiriman Gagal";
   }else {
     return "Tidak Diketahui";
   }
 }
  function status_pembayaran($id)
 {
   if ($id == 0) {
     return "Belum Dibayar";
   }elseif ($id == 1) {
     return "Sedang Diverifikasi";
   }elseif ($id == 2) {
     return "Pembayaran Ditolak";
   }elseif ($id == 3) {
     return "Pembayaran Diterima";
   }else {
     return "Tidak Diketahui";
   }
 }
 function status_pengadaan($id)
 {
   if ($id == 0) {
     return "Menunggu Verifikasi Direktur";
   }elseif ($id == 1) {
     return "Ditolak Oleh Direktur";
   }elseif ($id == 2) {
     return "Pengajuan Diterima Direktur";
   }elseif ($id == 3) {
     return "Pengajuan Diproses";
   }elseif ($id == 4) {
     return "Menunggu Penerimaan oleh Gudang";
   }elseif ($id == 5) {
     return "Belum Di Terima Oleh Gudang";
   }elseif ($id == 6) {
     return "Sudah Diterima Oleh Gudang";
   }elseif ($id == 7) {
     return "Pengajuan Selesai";
   }elseif ($id == 8) {
     return "Pengajuan Dibatalkan Oleh Bag. Produksi";
   }else {
     return "Tidak Diketahui";
   }
 }
function konfirmasi($id)
 {
   if ($id == 0) {
     return "Belum Diverifikasi";
   }elseif ($id == 1) {
     return "Sudah Diverifikasi";
   }else {
     return "Tidak Diketahui";
   }
 }
  function status_pengguna($id)
 {
   if ($id == 0) {
     return "Tidak Aktif";
   }elseif ($id == 1) {
     return "Aktif";
   }else {
     return "Tidak Diketahui";
   }
 }
  function status_pengiriman($id)
 {
   if ($id == 0) {
     return "Menunggu Muatan";
   }elseif ($id == 1) {
     return "Sedang Dikirim";
   }elseif ($id == 2) {
     return "Pengiriman Gagal";
   }elseif ($id == 3) {
     return "Pengiriman Selesai";
   }else {
     return "Tidak Diketahui";
   }
 }
  function status_produksi($id)
 {
   if ($id == 0) {
     return "Menyiapkan Bahan Baku";
   }elseif ($id == 1) {
     return "Sedang Diproses";
   }elseif ($id == 2) {
     return "Produksi Gagal";
   }elseif ($id == 3) {
     return "Produksi Selesai";
   }else {
     return "Tidak Diketahui";
   }
 }
 function status_akun($id)
 {
   if ($id == 0) {
     return "Tidak Aktif";
   }elseif ($id == 1) {
     return "Aktif";
   }else {
     return "Tidak Diketahui";
   }
 }
