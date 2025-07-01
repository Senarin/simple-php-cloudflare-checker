


function doCheckHost(){
 var in_host = document.getElementById("host").value;

 var check_cdn = document.getElementById("check-cdn").checked;

 fetch(`./api.php?host=${in_host}&h=${check_cdn ? "yes" : "no"}`)
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
        

        var isUsingCF = data.is_cloudflare;
        var isUsingCFText = document.createTextNode(isUsingCF ? "Cloudflare 사용 중" : "Cloudflare가 감지되지 않음");
        var isUsingCFDisplay = document.createElement("li");
        isUsingCFDisplay.appendChild(isUsingCFText);
        resList.appendChild(isUsingCFDisplay);

        if(check_cdn !== false){
            var edgeRegion = data.cf_hostinfo.edge_region;
            var edgeRegionText = document.createTextNode(`경유 엣지: ${edgeRegion}`);
            var edgeRegionDisplay = document.createElement("li");
            edgeRegionDisplay.appendChild(edgeRegionText);
            resList.appendChild(edgeRegionDisplay);
        }

    });

}