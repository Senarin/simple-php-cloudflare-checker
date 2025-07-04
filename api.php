<?php
error_reporting(0);

# Cloudflare IP Ranges for IPv4
# Source: https://www.cloudflare.com/ips/
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

# Additional Cloudflare IP Ranges for IPv4
$cloudflare_extra_ranges_v4 = <<<END
1.0.0.0/24
1.0.128.0/17
1.1.1.0/24
1.1.128.0/17
1.12.0.0/14
1.22.0.0/15
1.38.0.0/15
1.4.128.0/17
1.52.0.0/14
1.66.0.0/15
103.204.180.0/22
103.209.140.0/22
103.21.244.0/22
103.212.224.0/22
103.217.92.0/22
103.219.164.0/22
103.22.200.0/22
103.220.16.0/22
103.229.84.0/22
103.230.64.0/22
103.240.136.0/22
103.243.20.0/22
103.243.96.0/22
103.248.80.0/22
103.249.236.0/22
103.250.136.0/22
103.251.216.0/22
103.253.108.0/22
103.31.4.0/22
103.81.228.0/24
104.153.196.0/22
104.16.0.0/12
104.171.160.0/20
104.192.32.0/21
104.200.128.0/19
104.200.96.0/20
104.201.64.0/18
104.204.0.0/16
104.247.32.0/19
104.37.192.0/21
104.64.0.0/10
105.112.0.0/12
105.128.0.0/11
105.184.0.0/14
105.228.0.0/15
106.75.0.0/16
106.96.0.0/13
107.172.0.0/14
108.162.192.0/18
109.76.0.0/14
109.86.0.0/15
110.174.0.0/15
110.36.0.0/14
12.0.0.0/8
13.104.0.0/14
139.28.216.0/22
139.38.0.0/16
139.61.0.0/16
14.0.128.0/17
14.32.0.0/11
141.101.64.0/18
141.226.184.0/21
142.167.0.0/16
142.229.0.0/16
160.131.0.0/16
160.154.0.0/15
161.213.0.0/16
161.215.0.0/16
161.217.0.0/16
161.239.0.0/16
161.8.0.0/16
162.158.0.0/15
162.208.96.0/22
162.210.96.0/21
162.212.24.0/21
162.213.16.0/22
162.213.188.0/22
162.216.44.0/22
162.217.248.0/22
162.247.240.0/22
162.249.240.0/21
162.251.80.0/22
162.41.0.0/16
162.93.0.0/16
163.171.192.0/18
164.115.0.0/16
164.240.0.0/12
165.166.0.0/16
165.227.0.0/16
165.84.128.0/18
166.21.0.0/16
166.95.0.0/16
171.224.0.0/11
172.111.128.0/17
172.242.0.0/15
172.64.0.0/13
172.83.152.0/21
172.93.128.0/17
172.94.0.0/17
172.96.160.0/23
173.16.0.0/12
173.180.0.0/14
173.195.64.0/20
173.211.0.0/17
173.215.0.0/17
173.222.0.0/15
173.245.48.0/20
173.45.0.0/18
173.47.0.0/16
174.124.0.0/15
174.192.0.0/10
175.100.0.0/17
175.101.0.0/16
175.176.0.0/17
175.180.0.0/14
176.118.112.0/20
176.122.128.0/18
176.123.192.0/20
176.212.0.0/14
176.232.0.0/15
176.28.128.0/17
176.29.0.0/16
176.33.0.0/16
176.47.0.0/16
176.54.0.0/15
176.56.0.0/19
176.57.248.0/21
176.62.0.0/19
176.62.176.0/20
176.65.96.0/19
185.146.172.0/22
188.114.96.0/20
189.240.0.0/12
190.40.0.0/17
190.93.240.0/20
195.242.122.0/23
196.176.0.0/14
197.136.0.0/14
197.160.0.0/13
197.234.240.0/22
198.217.250.0/23
198.41.128.0/17
198.61.96.0/19
199.27.128.0/21
2.176.0.0/12
2.92.0.0/14
200.75.160.0/20
23.227.32.0/19
5.101.112.0/20
5.16.0.0/14
5.252.236.0/22
5.254.0.0/17
5.254.160.0/21
5.53.128.0/17
5.8.16.0/21
6.0.0.0/8
64.68.192.0/20
65.110.56.0/21
66.235.200.0/24
68.67.64.0/20
8.0.0.0/9
8.244.0.0/14
91.234.214.0/24
END;

# Cloudflare IP Ranges for IPv6
# Source: https://www.cloudflare.com/ips/
$cloudflare_ranges_v6 = <<<END
2400:cb00::/32
2606:4700::/32
2803:f800::/32
2405:b500::/32
2405:8100::/32
2a06:98c0::/29
2c0f:f248::/32
END;


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

header("Content-type: application/json");
header("Access-Control-Allow-Origin: *");

$target_host = $_GET["host"];
$resolv_mode = $_GET["resolve"] ?? "v4";
$resolv_addr = [];
$resolv_nameservers = [];

if(!is_null($target_host)){
  $target_host = idn_to_ascii(strtolower(trim($target_host)), IDNA_NONTRANSITIONAL_TO_ASCII | IDNA_CHECK_BIDI | IDNA_ALLOW_UNASSIGNED);
  $ip4 = gethostbynamel($target_host)[0] ?? null;
  $resolv_addr["v4"] = $ip4 ?? null;
  if($resolv_mode == "v6"){
   $ip6 = dns_get_record($target_host, DNS_AAAA)[0]['ipv6'] ?? null;
   $resolv_addr["v6"] = $ip6 ?? null;
  }
  $nameserver_data = dns_get_record($target_host,DNS_NS);
  for($i=0;$i<count($nameserver_data);$i++){$resolv_nameservers[] = $nameserver_data[$i]['target'];}

}else{
  http_response_code(400);
  echo json_encode(["error" => "No host provided"]);
  exit;
}

foreach(explode("\n",$cloudflare_ranges_v4) as $range) {
    if(ip4AddressInRange($ip4,trim($range))){
     $is_cf = true;
     break;
    }else{$is_cf = false;}
}

foreach(explode("\n",$cloudflare_extra_ranges_v4) as $range) {
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
    "resolv_nameservers" => $resolv_nameservers ?? null,
    "res_headers" => $url_check ?? "NOT_CHECKED"
    ];

echo json_encode($out_info);
?>