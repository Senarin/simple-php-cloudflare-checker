<!DOCTYPE html>
<html lang="ko">
<head>
<title>Simple Cloudflare Usage Scanner</title>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta name="color-scheme" content="light dark" />
<meta name="fediverse:creator" content="@Rina@uri.life" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha384-vtXRMe3mGCbOeY7l30aIg8H9p3GdeSe4IFlP6G8JMa7o7lXvnz3GFKzPxzJdPfGK" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/ea96b8b098.js" crossorigin="anonymous"></script>
<script src="./check.js"></script>
<script>
$(document).ready(function(){document.getElementById("host").addEventListener("keydown", function(e) {
    if (e.key.toLowerCase().indexOf("enter") != -1 || e.keyCode === 13){
        e.preventDefault();
        document.getElementById("cf-scan").click();
    }
  });
});
</script>
<link rel="stylesheet" href="./main.css" />
</head>
<body id="mainpagebody">

<div id="page-content">
<h2>Cloudflare 사용 체크 도구</h2>

<p>이 페이지는 웹사이트가 Cloudflare를 사용하는지 여부를 검사하는 간단한 도구입니다.
<br />아래 입력란에 도메인명을 입력하고 "스캔하기" 버튼을 클릭하면 해당 도메인이 Cloudflare를 사용하고 있는지 확인할 수 있습니다.</p>

<div id="check-form">
도메인명 : <input type="text" name="hostname" id="host" placeholder="www.example.com" size="16" />
<button id="cf-scan" onclick="doCheckHost();">스캔하기</button>
<br />
<input type="checkbox" id="check-cdn" checked /><label for="check-cdn">자세한 정보 보기</label>
<input type="checkbox" id="check-ip6" checked /><label for="check-ip6">IPv6 주소 조회</label>
</div>

<h2><span id="host-head"></span></h2>
<div id="result">
 <ul id="result-list"></ul>
</div>
</div>

<hr style="margin: 1em auto; width: 100%;" />


<p class="about">Made with <i style="color:#FF69B4;" class="fas fa-heart"></i> by <a href="https://bombyeol.me/">Bombyeol (aka. Haruboshi)</a>.</p>
<p class="disclaimer" id="disclaimer-ko">
면책 조항: 이 앱은 <a href="https://www.cloudflare.com/">Cloudflare Inc.</a>와 직접적으로 연관이 없습니다.<br />
이 앱은 <a href="https://developers.cloudflare.com/api/">Cloudflare의 공식 API</a>를 사용하지 않으며, 단순히 DNS 레코드를 조회하여 Cloudflare 사용 여부를 판단합니다.<br />
</p>
<p class="disclaimer" id="disclaimer-en">
<i>Disclaimer: This app is not affiliated with <a href="https://www.cloudflare.com/">Cloudflare Inc.</a><br />
It does not use <a href="https://developers.cloudflare.com/api/">Cloudflare's official API</a> and simply checks DNS records to determine if a site is using Cloudflare.<br /></i>
</p>
</body>
</html>