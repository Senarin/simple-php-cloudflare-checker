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
</head>
<body id="mainpagebody">


<div id="check-form">
도메인명 : <input type="text" name="hostname" id="host" placeholder="www.example.com" />
<button id="cf-scan" onclick="doCheckHost();">Scan</button>
<br />
<input type="checkbox" id="check-cdn" checked /><label for="check-cdn">자세한 정보 보기</label>
</div>

<h2><span id="host-head"></span></h2>
<div id="result">
<ul id="result-list">
</ul>
</div>

</body>
</html>