function InitStadistics (params = {}) {
    const baseurl = params.baseurl;
    const csrf = params.csrf;

    document.addEventListener("DOMContentLoaded", function () {
        RequestDataLinks();
    });

    function RequestDataLinks () {
        window.CSRF_TOKEN = csrf;
        fetch(`${baseurl}/stadistics/getLinksData`, {
            method: "POST",
            credentials: "same-origin",
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': window.CSRF_TOKEN
            }
        }).then((response) => {
            if (response.ok) {
                return response.json();
            }
        }).then((result) => {
            const bodyTable = document.getElementById('bodyTableStadistics');
            while (bodyTable.lastChild){
                bodyTable.removeChild(bodyTable.lastChild);
            }
            result.data.forEach(LinkData => {
                const trElem = document.createElement("tr");
                const tdLink = document.createElement("td");
                const tdUrl = document.createElement("td");
                const tdDate = document.createElement("td");
                const tdClick = document.createElement("td");
                tdLink.innerHTML = LinkData.title;
                tdUrl.innerHTML = LinkData.url;
                tdDate.innerHTML = LinkData.created_at;
                tdClick.innerHTML = LinkData.click;
                trElem.appendChild(tdLink);
                trElem.appendChild(tdUrl);
                trElem.appendChild(tdDate);
                trElem.appendChild(tdClick);
                bodyTable.appendChild(trElem);
                trElem.addEventListener('click', function () {
                    const tableDetails = document.getElementById('tableDetails');
                    const nameTable = document.getElementById('linkSelected');
                    const botonBack = document.getElementById('pagination-back');
                    const botonNext = document.getElementById('pagination-next');

                    if(tableDetails.style.display === "block" && nameTable.innerHTML === LinkData.title) {
                        tableDetails.style.display = "none";
                        botonBack.removeEventListener("click", Back);
                        botonNext.removeEventListener("click", Next);

                        if(document.getElementById('temp').hasChildNodes())
                            document.getElementById('link').remove();
                    } else {
                        tableDetails.style.display = "block";
                        NameTable(LinkData.title);
                        RequestDetailedDataLink(LinkData.id, 1);

                        if(document.getElementById('temp').hasChildNodes())
                            document.getElementById('link').remove();
                        
                        const inputElem = document.createElement("input");
                        inputElem.setAttribute('id', "link");
                        inputElem.setAttribute('type', 'hidden');
                        inputElem.setAttribute('value', LinkData.id);
                        document.getElementById('temp').appendChild(inputElem);
                        
                        const pageNumber = document.getElementById('pageNumber');
                        pageNumber.innerHTML = 1;
                        
                        botonBack.addEventListener('click', Back);
                        botonNext.addEventListener('click', Next);
                        
                        GererateChart(LinkData.id);
                    }
                });
            });
        }).catch(() => {

        });
    }

    function Back () {
        const inputElem = document.getElementById("link");
        let pageNumber = document.getElementById('pageNumber');
        if (parseInt(pageNumber.innerHTML) > 1)
            pageNumber.innerHTML = parseInt(pageNumber.innerHTML)-1;
        
        RequestDetailedDataLink(parseInt(inputElem.value), parseInt(pageNumber.innerHTML));
    }
    
    function Next () {
        const inputElem = document.getElementById("link");
        let pageNumber = document.getElementById('pageNumber');
        const NumRecords = document.getElementById('NumClicks');
        if(parseInt(pageNumber.innerHTML) < Math.ceil(parseInt(NumRecords.innerHTML)/20))
            pageNumber.innerHTML = parseInt(pageNumber.innerHTML)+1;
                            
        RequestDetailedDataLink(parseInt(inputElem.value), parseInt(pageNumber.innerHTML));
    }

    function NameTable (title) {
        const nameTable = document.getElementById('linkSelected');
        nameTable.innerHTML = title;
    }

    function GererateChart (id_link) {

        window.CSRF_TOKEN = csrf;
        fetch(`${baseurl}/stadistics/getChartDataLink`, {
            method: "POST",
            credentials: "same-origin",
            body: JSON.stringify({
                'id_link': id_link,
            }),
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': window.CSRF_TOKEN,
            }
        }).then((response) => {
            if (response.ok) {
                return response.json();
            }
        }).then((result) => {
            let dataChart = [];
            result.data.forEach(chartData => {
                dataChart.push([chartData.country_name, parseInt(chartData.clicks)]);
            })

            var chart = c3.generate({
                bindto: '#chart',
                data: {
                    columns: dataChart,
                    type: 'pie'
                }
            });
        }).catch(() => {

        });
    }

    function RequestDetailedDataLink (id_link, page) {        
        window.CSRF_TOKEN = csrf;
        fetch(`${baseurl}/stadistics/getDetailedDataLink`, {
            method: "POST",
            credentials: "same-origin",
            body: JSON.stringify({
                'id_link': id_link,
                'page': page,
            }),
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': window.CSRF_TOKEN,
            }
        }).then((response) => {
            if (response.ok) {
                return response.json();
            }
        }).then((result) => {
            const bodyTable = document.getElementById('bodyTableLink');
            while (bodyTable.lastChild){
                bodyTable.removeChild(bodyTable.lastChild);
            }
            
            if(result.TotalRecords) {
                result.data.forEach(ClickData => {
                    const trElem = document.createElement("tr");
                    const tdCountry = document.createElement("td");
                    const tdCity = document.createElement("td");
                    const tdDate = document.createElement("td");
                    tdCountry.innerHTML = ClickData.country_name;
                    tdCity.innerHTML = ClickData.city_name;
                    tdDate.innerHTML = ClickData.created_at;
                    trElem.appendChild(tdCountry);            
                    trElem.appendChild(tdCity);
                    trElem.appendChild(tdDate);
                    bodyTable.appendChild(trElem);
                    const captionElem = document.getElementById('totalClicksLink');
                    captionElem.innerHTML = `Total registros: <b id="NumClicks">${result.TotalRecords}</b>`;
                });
            } else {
                const captionElem = document.getElementById('totalClicksLink');
                captionElem.innerHTML = `Total registros: <b id="NumClicks">${result.TotalRecords}</b>`;
            }
        }).catch(() => {

        });
    }
}