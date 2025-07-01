<!DOCTYPE html>
<html lang="ko">
<head>
<title>Simple Cloudflare Usage Scanner</title>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta name="color-scheme" content="light dark" />
<meta name="fediverse:creator" content="@Rina@uri.life" />
<script src="./check.js"></script>
<link rel="stylesheet" href="./main.css" />
</head>
<body id="mainpagebody">

<div id="page-content">
<h2>단순 Cloudflare 사용 검사기</h2>

<p>이 페이지는 웹사이트가 Cloudflare를 사용하는지 여부를 검사하는 간단한 도구입니다.
<br />아래 입력란에 도메인명을 입력하고 "Scan" 버튼을 클릭하면 해당 도메인이 Cloudflare를 사용하고 있는지 확인할 수 있습니다.</p>

<div id="check-form">
도메인명 : <input type="text" name="hostname" id="host" placeholder="www.example.com" />
<button id="cf-scan" onclick="doCheckHost();">Scan</button>
<br />
<input type="checkbox" id="check-cdn" checked /><label for="check-cdn">자세한 정보 보기</label>
<input type="checkbox" id="check-ip6" checked /><label for="check-ip6">IPv6 주소 조회</label>
</div>

<h2><span id="host-head"></span></h2>
<div id="result">
 <ul id="result-list"></ul>
</div>
</div>


</body>
</html>