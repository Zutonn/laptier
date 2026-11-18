<?php
require_once __DIR__ . '/auth.php';
if($_SERVER['REQUEST_METHOD']!=='POST'){http_response_code(405);exit('Method not allowed');}
verify_csrf();$id=filter_input(INPUT_POST,'id',FILTER_VALIDATE_INT);
if($id){$stmt=db()->prepare('DELETE FROM laptops WHERE id=:id');$stmt->execute(['id'=>$id]);flash('success',$stmt->rowCount()?'Produk berhasil dihapus.':'Produk tidak ditemukan.');}else flash('error','ID produk tidak valid.');
redirect('laptops.php');
