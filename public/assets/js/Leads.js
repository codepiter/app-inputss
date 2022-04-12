function InitLeads (params = {}) {
    const baseurl = params.baseurl;
    const csrf = params.csrf;

    document.addEventListener("DOMContentLoaded", function () {
        const pageNumber = document.getElementById('pageNumber');
        pageNumber.innerHTML = 1;
        const botonBack = document.getElementById('pagination-back');
        const botonNext = document.getElementById('pagination-next');

        requestData(parseInt(pageNumber.innerHTML));
        botonBack.addEventListener('click', function () {
            let pageNumber = document.getElementById('pageNumber');
            if (parseInt(pageNumber.innerHTML) > 1)
                pageNumber.innerHTML = parseInt(pageNumber.innerHTML)-1;
            requestData(parseInt(pageNumber.innerHTML));
        });

        botonNext.addEventListener('click', function () {
            let pageNumber = document.getElementById('pageNumber');
            const NumSubs = document.getElementById('NumLeads');
            if(parseInt(pageNumber.innerHTML) < Math.ceil(parseInt(NumSubs.innerHTML)/20))
                pageNumber.innerHTML = parseInt(pageNumber.innerHTML)+1;
                    
            requestData(parseInt(pageNumber.innerHTML));
        });
    });
    
    function requestData (page) {
        window.CSRF_TOKEN = csrf;
        fetch(`${baseurl}/leads/getLeads`, {
            method: "POST",
            credentials: "same-origin",
            body: JSON.stringify({
                'page' : page,
            }),
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': window.CSRF_TOKEN
            }
        }).then((response) => {
            if (response.ok) {
                return response.json();
            }
        }).then((result) => {
            const bodyTable = document.getElementById('bodyTableLeads');
            while (bodyTable.lastChild){
                bodyTable.removeChild(bodyTable.lastChild);
            }
            result.data.forEach(leadsData => {
                const trElem = document.createElement("tr");
                const tdFullname = document.createElement("td");
                const tdEmail = document.createElement("td");
                const tdPhone = document.createElement("td");
                const tdDate = document.createElement("td");
                tdFullname.innerHTML = leadsData.fullname;
                tdEmail.innerHTML = leadsData.email;
                tdPhone.innerHTML = leadsData.phone;
                tdDate.innerHTML = leadsData.created_at;
                trElem.appendChild(tdFullname);
                trElem.appendChild(tdEmail);
                trElem.appendChild(tdPhone);
                trElem.appendChild(tdDate);
                bodyTable.appendChild(trElem);
            });
            const captionElem = document.getElementById('totalLeads');
            captionElem.innerHTML = `Total Leads: <b id="NumLeads">${result.TotalLeads}</b>`; 
        }).catch(() => {
    
        });
    }
}