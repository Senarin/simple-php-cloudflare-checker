<?php
error_reporting(0);

$cloudflare_ranges_v4 = <<<END
173.245.48.0/20
103.21.244.0/22
103.22.200.0/22
103.31.4.0/22
141.101.64.0/18
108.162.192.0/18
190.93.240.0/20
188.114.96.0/20
197.234.240.0/22
198.41.128.0/17
162.158.0.0/15
104.16.0.0/13
104.24.0.0/14
172.64.0.0/13
131.0.72.0/22
END;

$cloudflare_ranges_v6 = <<<END
2400:cb00::/32
2606:4700::/32
2803:f800::/32
2405:b500::/32
2405:8100::/32
2a06:98c0::/29
2c0f:f248::/32
END;

header("Content-type: application/json");
header("Access-Control-Allow-Origin: *");

function ip4CIDRToRange($cidr){
   $rdec = array();
   $rstr = array();
   $cidr = explode('/', $cidr);
   $rdec[0] = (ip2long($cidr[0]) & ((-1 << (32 - $cidr[1]))));
   $rdec[1] = (ip2long($cidr[0]) | ((1 << (32 - $cidr[1])) - 1));
 
   $rstr[0] = long2ip($rdec[0]);
   $rstr[1] = long2ip($rdec[1]);
 
   return array($rdec,$rstr);
}

function ip6PrefixToRange($prefix){
    list($ip,$len) = explode('/',$prefix);
    $addr0bin = inet_pton($ip);
    $addr0hex = bin2hex($addr0bin);

    $addr0str = inet_ntop($addr0bin);
    $fbits = 128 - intval($len);

    $addr64hex = $addr0hex;

    $p = 31;

    while($fbits > 0){
     $orig = substr($addr64hex,$p,1);
     $oval = hexdec($orig);
     $nval = $oval | (pow(2,min(4,$fbits))-1);

     $new = dechex($nval);
     $addr64hex = substr_replace($addr64hex,$new,$p,1);

     $fbits -= 4;
     $p -= 1;
    }

    $addr64bin = hex2bin($addr64hex);
    $addr64str = inet_ntop($addr64bin);

    $addr0dec = unpack("N*", $addr0bin);
    $addr64dec = unpack("N*", $addr64bin);


    $addr0decval = 0;
    $addr64decval = 0;

    for($i=0;$i<4;$i++){
     $addr0decval += $addr0dec[$i] * pow(2,32*(4-$i));
     $addr64decval += $addr64dec[$i] * pow(2,32*(4-$i));
    }

    $addr0decval = number_format($addr0decval,0,".","");
    $addr64decval = number_format($addr64decval,0,".","");

    return array($addr0decval,$addr64decval,$addr0str,$addr64str);
}

function ip4AddressInRange($ip, $range){
    list($start, $end) = ip4CIDRToRange($range)[0];
    $ipLong = ip2long($ip);
    return ($ipLong >= $start && $ipLong <= $end);
}

function ip6AddressInNet($ip, $sub, $prefix){
    $sub = inet_pton($sub);
    $ip = inet_pton($ip);

    $bprefix = str_repeat("f", $prefix / 4);
    switch($prefix % 4){
        case 0: break;
        case 1: $bprefix .= "8"; break;
        case 2: $bprefix .= "c"; break;
        case 3: $bprefix .= "e"; break;
    }
    $bprefix = str_pad($bprefix,32,"0");
    $bprefix = hex2bin($bprefix);

    return ($ip & $bprefix) == $sub;
}


$target_host = $_GET["host"];
$resolv_mode = $_GET["resolve"] ?? "v4";
$resolv_addr = [];

if(!is_null($target_host)){
  $ip4 = gethostbynamel($target_host)[0] ?? null;
  $resolv_addr["v4"] = $ip4 ?? null;
  if($resolv_mode == "v6"){
   $ip6 = dns_get_record($target_host, DNS_AAAA)[0]['ipv6'] ?? null;
   $resolv_addr["v6"] = $ip6 ?? null;
  }
}else{
  echo json_encode(["error" => "No host provided"]);
  exit;
}

foreach(explode("\n",$cloudflare_ranges_v4) as $range) {
    if(ip4AddressInRange($ip4,trim($range))){
     $is_cf = true;
     break;
    }else{$is_cf = false;}
}

if($resolv_mode == "v6" && !is_null($ip6)){
 foreach(explode("\n",$cloudflare_ranges_v6) as $net) {
    $ranges = explode("/",trim($net));
     if(ip6AddressInNet($ip6,$ranges[0],$ranges[1])){
      $is_cf = true;
      break;
     }else{$is_cf = false;}
 }
}

$_show_header = $_GET["h"] ?? "no";

if($_show_header !== "no"){
 $url_check = get_headers("https://$target_host");

 foreach($url_check as $header_line){
     if(preg_match("/^date:/i", $header_line)){$host_datetime = strtotime(trim(preg_replace("/^date:/i", "", $header_line)));}
     if(preg_match("/^cf-ray:/i", $header_line)){
         $cf_rayinfo = trim(explode(":", $header_line)[1]);
         $cf_rayid = trim(explode("-", $cf_rayinfo)[0]);
         $cf_edge = trim(explode("-", $cf_rayinfo)[1]);
     }
 }
}

$out_info = [
    "hostname" => $target_host,
    "resolv_addr" => $resolv_addr,
    "is_cloudflare" => $is_cf,
    "cf_hostinfo" => ($is_cf != false) ? [
        "host_timestamp" => $host_datetime ?? "NOT_CHECKED",    
        "rayid" => $cf_rayid ?? "NOT_CHECKED",
        "edge_region" => $cf_edge ?? "NOT_CHECKED"
    ] : "NOT_BEHIND_CLOUDFLARE",
    "res_headers" => $url_check ?? "NOT_CHECKED"
    ];

echo json_encode($out_info);
?>