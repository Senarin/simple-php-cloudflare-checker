


function doCheckHost(){
 var in_host = document.getElementById("host").value;

 var check_cdn = document.getElementById("check-cdn").checked;
 var check_ip6 = document.getElementById("check-ip6").checked;

 fetch(`./api.php?host=${in_host}&h=${check_cdn ? "yes" : "no"}&resolve=${check_ip6 ? "v6" : "v4"}`)
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }

        return response.json();
    }).then(data => {
        var resList = document.getElementById("result-list");
        resList.innerHTML = "";

        var hostInfoHead = document.getElementById("host-head");
        hostInfoHead.textContent = `${data.hostname}에 대한 결과`;

        var ip4Addr = (typeof data.resolv_addr.v4 != "undefined") ? data.resolv_addr.v4 : "감지되지 않음";
        var ip4Text = document.createTextNode(`감지된 IPv4 주소: ${ip4Addr}`);
        var ip4Display = document.createElement("li");
        ip4Display.appendChild(ip4Text);
        resList.appendChild(ip4Display);
        if(check_ip6 !== false){
         var ip6Addr = (typeof data.resolv_addr.v6 != "undefined") ? data.resolv_addr.v6 : "감지되지 않음";
         var ip6Text = document.createTextNode(`감지된 IPv6 주소: ${ip6Addr}`);
         var ip6Display = document.createElement("li");
         ip6Display.appendChild(ip6Text);
         resList.appendChild(ip6Display);
        }

        var isUsingCF = data.is_cloudflare;
        var isUsingCFText = document.createTextNode(isUsingCF ? "Cloudflare 사용 여부: 사용 중" : "Cloudflare 사용 여부: 감지되지 않음");
        var isUsingCFDisplay = document.createElement("li");
        isUsingCFDisplay.appendChild(isUsingCFText);
        resList.appendChild(isUsingCFDisplay);

        if(isUsingCF !== false && check_cdn !== false){
            var edgeRegion = data.cf_hostinfo.edge_region;
            var edgeRegionText = document.createTextNode(`감지된 엣지 로케이션 코드: ${edgeRegion}`);
            var edgeRegionDisplay = document.createElement("li");
            edgeRegionDisplay.appendChild(edgeRegionText);
            resList.appendChild(edgeRegionDisplay);
        }

    });

}