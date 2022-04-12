function InitSubscripions (params = {}) {
    const baseurl = params.baseurl;
    const csrf = params.csrf;
    const type = params.type;

    document.addEventListener("DOMContentLoaded", function () {
        const pageNumber = document.getElementById('pageNumber');
        pageNumber.innerHTML = 1;
        const botonBack = document.getElementById('pagination-back');
        const botonNext = document.getElementById('pagination-next');

        requestData(parseInt(pageNumber.innerHTML), type);
        botonBack.addEventListener('click', function () {
            let pageNumber = document.getElementById('pageNumber');
            if (parseInt(pageNumber.innerHTML) > 1)
                pageNumber.innerHTML = parseInt(pageNumber.innerHTML)-1;
            requestData(parseInt(pageNumber.innerHTML), type);
        });

        botonNext.addEventListener('click', function () {
            let pageNumber = document.getElementById('pageNumber');
            const NumSubs = document.getElementById('NumSubs');
            if(parseInt(pageNumber.innerHTML) < Math.ceil(parseInt(NumSubs.innerHTML)/20))
                pageNumber.innerHTML = parseInt(pageNumber.innerHTML)+1;
                    
            requestData(parseInt(pageNumber.innerHTML), type);
        });
    });
    
    function requestData (page, type) {
        const thElem = document.getElementById('tipo_subscriptor');
        
        if(type === 'email')
            thElem.innerHTML = 'Correo';
        else
            thElem.innerHTML = 'Telefono';
    
        window.CSRF_TOKEN = csrf;
        fetch(`${baseurl}/subscription/getSubscribers`, {
            method: "POST",
            credentials: "same-origin",
            body: JSON.stringify({
                'type_subs': type,
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
            const bodyTable = document.getElementById('bodyTableSubs');
            while (bodyTable.lastChild){
                bodyTable.removeChild(bodyTable.lastChild);
            }
            result.data.forEach(suscriptorData => {
                const trElem = document.createElement("tr");
                const tdName = document.createElement("td");
                const tdEmail = document.createElement("td");
                const tdDate = document.createElement("td");
                tdName.innerHTML = suscriptorData.name + ' ' + suscriptorData.lastname;
                tdEmail.innerHTML = type === 'email' ? suscriptorData.email : suscriptorData.phone;
                tdDate.innerHTML = suscriptorData.created_at;
                trElem.appendChild(tdName);
                trElem.appendChild(tdEmail);
                trElem.appendChild(tdDate);
                bodyTable.appendChild(trElem);
            });
            const captionElem = document.getElementById('totalSubs');
            captionElem.innerHTML = `Total suscriptores: <b id="NumSubs">${result.TotalSubs}</b>`; 
        }).catch(() => {
    
        });
    }
}