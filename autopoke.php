<html><head><title>Chọc bạn bè để tương tác</title></head><body><?php
$limitfr = isset($_GET['limit']) ? intval($_GET['limit']) : 5000;
$token = isset($_GET['5db196dd1d73b4742263315']) ? $_GET['5db196dd1d73b4742263315'] : ''; //điền token vào đây
define("LIMIT_FR", $limitfr); //lấy uid max 5000 friend
$ar_thong_tin = '';
$ar_friend = '';
/**TÔN TRỌNG NHAU NHÉ **
#CODE BY KT1K99
#FROM #TSVT WITH LUV
** HIHI **/
$i = 0;
if($token != ''):
$uid = step(0,$token); //check token die
if($uid == true){
 $log_friend = step(4,$token);
 if(count($log_friend)<2){
    $tsvt = 'error';
    $thongbao = 'Bạn bè quá ít';
 }else{
 $fp = fopen('log/poke_'.$uid.'.txt', 'a+') or die('File không tồn tại');
  foreach ($log_friend as $u) {
      $ar_friend[] .= $u['id'];
  }
    foreach ($ar_friend as $value) {
     if(step(7,$token,$value) == true){
      $i++;
     }
     $name = step(6,$token,$value);
     $ar_thong_tin[] .= $name;
     echo $value.'|'.$name.'<br>';
     fwrite($fp, $value."|".$name."\n");
    }
 fclose($fp);
 }
  //$tsvt = 'success';
 $thongbao = 'Đã chọc thành công '.$i.' Bạn bè ';
}else{
 $thongbao = 'Token die rồi';
}
 echo $thongbao.'<br>';
endif;
function step($type,$token,$id = '')
{
 if($type == 0){
  $data = json_decode(auto('https://graph.facebook.com/me?fields=id&access_token='.$token),true);
  if(isset($data['id'])){
   return $data['id'];
  }
 }elseif($type == 1){
  $data = json_decode(auto('https://graph.facebook.com/me/feed?fields=id&limit='.LIMIT_POST.'&access_token='.$token),true);
  if(isset($data['data'])){
   return $data['data'];
  }
 }elseif($type == 2){
  $data = json_decode(auto('https://graph.facebook.com/'.$id.'/reactions?fields=id&limit='.LIMIT_REAC.'&access_token='.$token),true);
  if(isset($data['data'])){
   return $data['data'];
  }
 }elseif($type == 3){
  $data = json_decode(auto('https://graph.facebook.com/'.$id.'/comments?fields=from.id&limit='.LIMIT_CMT.'&access_token='.$token),true);
  if(isset($data['data'])){
   return $data['data'];
  }
 }elseif($type == 4){
  $data = json_decode(auto('https://graph.facebook.com/me/friends?fields=id&limit='.LIMIT_FR.'&access_token='.$token),true);
  if(isset($data['data'])){
   return $data['data'];
  }
 }elseif($type == 5){
  $data = json_decode(auto('https://graph.facebook.com/me/friends?uid='.$id.'&method=delete&access_token='.$token),true);
  return $data;
 }elseif($type == 6){
  $data = json_decode(auto('https://graph.facebook.com/'.$id.'?fields=name&access_token='.$token),true);
  return $data['name'];
 }elseif($type == 7){
  $data = json_decode(auto('https://graph.facebook.com/'.$id.'/pokes?method=post&access_token='.$token),true);
  return $data;
 }else
 return 0;
}
function auto($url, $data = null)
{
    $c = curl_init();
    curl_setopt($c, CURLOPT_URL, $url);
    if ($data != null) {
        curl_setopt($c, CURLOPT_POST, true);
        curl_setopt($c, CURLOPT_POSTFIELDS, $data);
    } 
   curl_setopt($c, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($c, CURLOPT_TIMEOUT, 300);
    $go = curl_exec($c);
    curl_close($c);
    return $go;
}
?> 
