function InitPremium (params = {}) {
    const baseurl = params.baseurl;
    const csrf = params.csrf;

    document.addEventListener("DOMContentLoaded", function () {
        const button_add = document.getElementById('button_add');
        button_add.addEventListener('click', addToWhiteList);

        const button_update = document.getElementById('button_update');
        button_update.addEventListener('click', updateListItem);

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
            const NumList = document.getElementById('NumList');
            if(parseInt(pageNumber.innerHTML) < Math.ceil(parseInt(NumList.innerHTML)/20))
                pageNumber.innerHTML = parseInt(pageNumber.innerHTML)+1;
                    
            requestData(parseInt(pageNumber.innerHTML));
        });
    });
    
    function addToWhiteList() {
        const dataInput = document.getElementById('email_add').value;

        let error = 0;
        
        window.CSRF_TOKEN = csrf;
        fetch(`${baseurl}/premium/addEmail`, {
            method: "POST",
            credentials: "same-origin",
            body: JSON.stringify({
                'email' : dataInput,
            }),
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': window.CSRF_TOKEN
            }
        }).then((response) => {
            if (response.ok) {
                document.getElementById('email_add').value = '';
                $('#add_email').modal('hide');
                const pageNumber = document.getElementById('pageNumber');
                pageNumber.innerHTML = 1;
                requestData(parseInt(pageNumber.innerHTML));
                return response.json();
            } else {
                $('#add_email').modal('hide');
                error = 1;
                return response.json();
            }
        }).then((data) => {
            document.getElementById('modal-title').innerHTML = error ? 'Atencion' : 'Exito';
            document.getElementById('message-alert').innerHTML = data.result;
            $('#alert-modal').modal('show');
        });
    }

    function updateListItem() {
        const id_email_list = document.getElementById('id_list').value;
        const dataInput = document.getElementById('email_update').value;
        const statusEmail = document.getElementById('status').value;

        let error = 0;
        
        window.CSRF_TOKEN = csrf;
        fetch(`${baseurl}/premium/updateEmail/${id_email_list}`, {
            method: "POST",
            credentials: "same-origin",
            body: JSON.stringify({
                'email' : dataInput,
                'status': statusEmail,
            }),
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': window.CSRF_TOKEN
            }
        }).then((response) => {
            if (response.ok) {
                document.getElementById('id_list').value = '';
                document.getElementById('email_update').value = '';
                document.getElementById('status').value = 0;
                $('#update_email').modal('hide');
                const pageNumber = document.getElementById('pageNumber');
                requestData(parseInt(pageNumber.innerHTML));
                return response.json();
            } else {
                $('#update_email').modal('hide');
                error = 1;
                return response.json();
            }
        }).then((data) => {
            document.getElementById('modal-title').innerHTML = error ? 'Atencion' : 'Exito';
            document.getElementById('message-alert').innerHTML = data.result;
            $('#alert-modal').modal('show');
        });
    }

    function deleteListItem(id) {
        window.CSRF_TOKEN = csrf;
        let error = 0;

        fetch(`${baseurl}/premium/deleteEmail/${id}`, {
            method: "DELETE",
            credentials: "same-origin",
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': window.CSRF_TOKEN
            }
        }).then((response) => {
            if (response.ok) {
                const pageNumber = document.getElementById('pageNumber');
                requestData(parseInt(pageNumber.innerHTML));
                return response.json();
            } else {
                error = 1;
                return response.json();
            }
        }).then((data) => {
            document.getElementById('modal-title').innerHTML = error ? 'Atencion' : 'Exito';
            document.getElementById('message-alert').innerHTML = data.result;
            $('#alert-modal').modal('show');
        })
    }

    function requestData(page) {
        fetch(`${baseurl}/premium/getList?page=${page}`)
        .then((response) => {
            if (response.ok) {
                return response.json();
            }
        }).then((result) => {
            const bodyTable = document.getElementById('bodyTableList');
            while (bodyTable.lastChild){
                bodyTable.removeChild(bodyTable.lastChild);
            }
            result.data.forEach(whiteListData => {
                const trElem = document.createElement("tr");
                const tdEmail = document.createElement("td");
                const tdStatus = document.createElement("td");
                const tdActions = document.createElement("td");
                tdStatus.innerHTML = whiteListData.email;
                if(parseInt(whiteListData.status))
                    tdEmail.innerHTML = `<p class="status-active"> Activo </p>` ;
                else
                    tdEmail.innerHTML = `<p class="status-inactive"> Inactivo </p>` ;

                //creo los botones que iran dentro de la columna de acciones
                const buttonEdit = document.createElement('button');
                const buttonDelete = document.createElement('button');

                buttonEdit.className += 'btn btn-info button-edit';
                buttonDelete.className += 'btn btn-danger button-delete';

                buttonEdit.dataset.toggle = 'modal';
                buttonEdit.dataset.target = '#update_email';

                const iElemUpdate = document.createElement('i');
                iElemUpdate.className += 'ti-pencil';
                const iElemDelete = document.createElement('i');
                iElemDelete.className += 'ti-trash';

                buttonEdit.appendChild(iElemUpdate);
                buttonDelete.appendChild(iElemDelete);

                tdActions.appendChild(buttonEdit);
                tdActions.appendChild(buttonDelete);
                trElem.appendChild(tdStatus);
                trElem.appendChild(tdEmail);
                trElem.appendChild(tdActions);
                bodyTable.appendChild(trElem);

                tdActions.addEventListener('click', function () {
                    const id_list_update = document.getElementById('id_list');
                    const email_update_input = document.getElementById('email_update');
                    const status_select = document.getElementById('status');

                    id_list_update.value = parseInt(whiteListData.id);
                    email_update_input.value = whiteListData.email;
                    status_select.value = parseInt(whiteListData.status);
                });

                buttonDelete.addEventListener('click', function () {
                    deleteListItem(whiteListData.id);
                });
            });
            const captionElem = document.getElementById('totalList');
            captionElem.innerHTML = `Total Registros: <b id="NumList">${result.TotalList}</b>`; 
        }).catch(() => {
    
        });
    }
}