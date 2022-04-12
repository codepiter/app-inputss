function InitInputslink (params = {}) {
    const baseurl = params.baseurl;
    const assetsurl = params.assetsurl;
    const csrf = params.csrf;
    const id_user = parseInt(params.id);
    const inputslinks = params.publicInputslinks;
    const userprofile_id = parseInt(params.userprofile_id);
    const subs_email = parseInt(params.subs_email);
    const title_subs_email = params.title_subs_email;
    const subtitle_subs_email = params.subtitle_subs_email;
    const default_subtitle_subs_email = params.default_subtitle_subs_email;
    const subs_sms = parseInt(params.subs_sms);
    const title_subs_sms = params.title_subs_email;
    const subtitle_subs_sms = params.subtitle_subs_sms;
    const default_subtitle_subs_sms = params.default_subtitle_subs_sms;
    const template = parseInt(params.template);
    const rounded_userprofile = (params.rounded_userprofile === 'on') ? 1 : 0;

    let viewPremium = 0;

    document.addEventListener('DOMContentLoaded', function () {
        const contentPremium = document.getElementById('content-premium');
        contentPremium.addEventListener('click', function () {
            if(!id_user) {
                $('#modal_test').modal("show");
            } else {
                if(viewPremium) {
                    //en este caso debo devolver la lista de enlaces normales
                    showPublicData(template);
                } else {
                    checkUser(userprofile_id, template);
                }
            }
        }); 
    });

    function showPublicData(template) {
        const contentPremium = document.getElementById('content-premium');
        viewPremium = !viewPremium;
        const sortableDiv = document.getElementById('sortable');
        while (sortableDiv.lastChild)
            sortableDiv.removeChild(sortableDiv.lastChild);

        if(subs_email)
            subscriptionEmail(sortableDiv, template);

        if(subs_sms)
            subscriptionSms(sortableDiv, template);

        inputslinks.forEach( (enlace, index) => {
            console.log(index);
            if(enlace.video)
                videoElem(sortableDiv, template, index, enlace);

            else if (enlace.music)
                musicElem(sortableDiv, template, index, enlace.music);

            else if (enlace.comercial2 === 'on')
                imgElem(sortableDiv, template, index, enlace);
                        
            else
                linkElem(sortableDiv, template, index, enlace);
        });

        contentPremium.removeChild(contentPremium.lastChild);
        const iElem = document.createElement("i");
        iElem.className += 'fas fa-crown';
        contentPremium.appendChild(iElem);
    }

    function showPremiumData(data, template) {
        const contentPremium = document.getElementById('content-premium');
        viewPremium = !viewPremium;
        const sortableDiv = document.getElementById('sortable');
        while (sortableDiv.lastChild)
            sortableDiv.removeChild(sortableDiv.lastChild);

        if(subs_email)
            subscriptionEmail(sortableDiv, template);

        if(subs_sms)
            subscriptionSms(sortableDiv, template);

        data.forEach( (enlace, index ) => {
            if(enlace.video)
                videoElem(sortableDiv, template, index, enlace);

            else if (enlace.music)
                musicElem(sortableDiv, template, index, enlace.music);

            else if (enlace.comercial2 === 'on')
                imgElem(sortableDiv, template, index, enlace);
                        
            else
                linkElem(sortableDiv, template, index, enlace);
        });

        contentPremium.removeChild(contentPremium.lastChild);
        const iElem = document.createElement("i");
        iElem.className += 'fas fa-unlock-alt';
        contentPremium.appendChild(iElem);
    }

    function subscriptionEmail (container, template) {
        const divElemEmail = document.createElement("div");

        divElemEmail.dataset.toggle = "modal";
        divElemEmail.dataset.target = "#subs_emailModal";

        const divElemImgEmail = document.createElement("div");
        const imgElemEmail = document.createElement("img");
        
        imgElemEmail.src = `${assetsurl}/rrss/sms.png`;
        imgElemEmail.style.maxWidth = "5rem";
        divElemImgEmail.appendChild(imgElemEmail);
        
        const divElemTitleEmail = document.createElement("div");

        if(template === 1) {
            divElemEmail.className += "fade-in-image enlace row mx-auto thumbnail ui-state-default text-center p-0";
            divElemImgEmail.className += "col-md-12 col-xs-12 text-center border-bottom border-dark p-0";
            divElemTitleEmail.className += "col-xs-12 col-md-12";
        } else {
            divElemEmail.className += "row thumbnail ui-state-default";
            divElemImgEmail.className += "col-md-2 col-xs-2 text-center";
            divElemTitleEmail.className += "col-xs-10 col-md-10";
        }

        if(title_subs_email) {
            const h4ElemEmail = document.createElement("h4");
            h4ElemEmail.className += "skill__single-part__title";
            h4ElemEmail.style.fontSize = "16px";
            h4ElemEmail.innerHTML = title_subs_email;

            const h5ElemEmail = document.createElement("h5");
            h5ElemEmail.innerHTML = subtitle_subs_email;

            divElemTitleEmail.appendChild(h4ElemEmail);
            divElemTitleEmail.appendChild(h5ElemEmail);
        } else {
            const h4ElemEmail = document.createElement("h4");
            h4ElemEmail.className += "skill__single-part__title";
            h4ElemEmail.style.fontSize = "16px";
            h4ElemEmail.innerHTML = default_subtitle_subs_email;

            const h5ElemEmail = document.createElement("h5");
            h5ElemEmail.innerHTML = 'Click aqui para suscribirse por correo';

            divElemTitleEmail.appendChild(h4ElemEmail);
            divElemTitleEmail.appendChild(h5ElemEmail);
        }

        divElemEmail.appendChild(divElemImgEmail);
        divElemEmail.appendChild(divElemTitleEmail);
        container.appendChild(divElemEmail);
    }

    function subscriptionSms (container, template) {
        const divElemSms = document.createElement("div");

        divElemSms.dataset.toggle = "modal";
        divElemSms.dataset.target = "#subs_emailModal";

        const divElemImgSms = document.createElement("div");
        const imgElemSms = document.createElement("img");

        imgElemSms.src = `${assetsurl}/rrss/email.png`;
        imgElemSms.style.maxWidth = "5rem";
        divElemImgSms.appendChild(imgElemSms);

        const divElemTitleSms = document.createElement("div");

        if(title_subs_email) {
            const h4ElemSms = document.createElement("h4");
            h4ElemSms.className += "skill__single-part__title";
            h4ElemSms.style.fontSize = "16px";
            h4ElemSms.innerHTML = title_subs_sms;

            const h5ElemSms = document.createElement("h5");
            h5ElemSms.innerHTML = subtitle_subs_sms;

            divElemTitleSms.appendChild(h4ElemSms);
            divElemTitleSms.appendChild(h5ElemSms);

        } else {
            const h4ElemSms = document.createElement("h4");
            h4ElemSms.className += "skill__single-part__title";
            h4ElemSms.style.fontSize = "16px";
            h4ElemSms.innerHTML = default_subtitle_subs_sms;

            const h5ElemSms = document.createElement("h5");
            h5ElemSms.innerHTML = 'Click aqui para suscribirse por sms';

            divElemTitleSms.appendChild(h4ElemSms);
            divElemTitleSms.appendChild(h5ElemSms);
        }

        if(template === 1) {
            divElemSms.className += "fade-in-image enlace row mx-auto thumbnail ui-state-default text-center p-0";
            divElemImgSms.className += "col-md-12 col-xs-12 text-center border-bottom border-dark p-0";
            divElemTitleSms.className += "col-xs-12 col-md-12";
        } else {
            divElemSms.className += "row thumbnail ui-state-default";
            divElemImgSms.className += "col-md-2 col-xs-2 text-center";
            divElemTitleSms.className += "col-xs-10 col-md-10";
        }
        
        divElemSms.appendChild(divElemImgSms);
        divElemSms.appendChild(divElemTitleSms);
        container.appendChild(divElemSms);
    }

    function musicElem (container, template, index, data) {
        const divElemMusic = document.createElement("div");
        divElemMusic.innerHTML = data;

        if(template === 1) {
            if(index % 2)
                divElemMusic.className += "der row fade-in-image music enlace justify-content-center";
            else
                divElemMusic.className += "izq row fade-in-image music enlace justify-content-center";
        } else
            divElemMusic.className += "row music";

        container.appendChild(divElemMusic);
    }

    function videoElem (container, template, index, data) {
        const divElemVideo = document.createElement("div");
        divElemVideo.style.marginBottom = "0px";
        divElemVideo.innerHTML = data.video;

        if(template === 1) {
            if(index % 2)
                divElemVideo.className += "der row vid justify-content-center fade-in-image enlace";
            else
                divElemVideo.className += "izq row vid justify-content-center fade-in-image enlace";
        } else
            divElemVideo.className += "row vid";

        container.appendChild(divElemVideo);
                            
        if(data.comercial === 'on') {
            const divElemPaypalButton = document.createElement("div");

            if(template === 1) {
                if(index % 2)
                    divElemPaypalButton.className += "der paypal-button-video enlace fade-in-image justify-content-center";
                else
                    divElemPaypalButton.className += "izq paypal-button-video enlace fade-in-image justify-content-center";
            } else
                divElemPaypalButton.className += "paypal-button-video";

            divElemPaypalButton.innerHTML = data.paypal_button;
            container.appendChild(divElemPaypalButton);

            if(!scriptAlredyExist(divElemPaypalButton.firstChild.nextElementSibling.src)) {
                const script = document.createElement('script');
                script.src = divElemPaypalButton.firstChild.nextElementSibling.src;
                script.dataset.sdkIntegrationSource = divElemPaypalButton.firstChild.nextElementSibling.dataset.sdkIntegrationSource;
                script.onload = function () {
                    const script2 = document.createElement('script');
                    script2.innerHTML = divElemPaypalButton.firstChild.nextElementSibling.nextElementSibling.innerHTML;
                    document.body.append(script2);
                }
                document.body.append(script);
            } else {
                const script2 = document.createElement('script');
                script2.innerHTML = divElemPaypalButton.firstChild.nextElementSibling.nextElementSibling.innerHTML;
                deleteScript(script2);
                document.body.append(script2);
            }
        }
    }

    function imgElem(container, template, index, data) {
        const divElemImg = document.createElement("div");
        divElemImg.style.marginBottom = "0px";

        const divElemPaypalButton = document.createElement("div");
        divElemPaypalButton.innerHTML = data.paypal_button;

        const imgElem = document.createElement("img");

        if(data.img_comercial !== null)
            imgElem.src = `${assetsurl}/${data.img_comercial}`;

        if(template === 1) {
            if(index % 2) {
                divElemImg.className += "der row fade-in-image imgcom mx-auto justify-content-center";
                divElemPaypalButton.className += "der fade-in-image paypal-button-img justify-content-center";
            } else {
                divElemImg.className += "izq row fade-in-image imgcom mx-auto justify-content-center";
                divElemPaypalButton.className += "izq fade-in-image paypal-button-img justify-content-center";
            }
            imgElem.className += "w-100";

        } else {
            divElemImg.className += "row imgcom";
            divElemPaypalButton.className += "paypal-button-img"
        }

        divElemImg.appendChild(imgElem);
        container.appendChild(divElemImg);
        container.appendChild(divElemPaypalButton);
    }

    function linkElem(container, template, index, data) {
        const aElem = document.createElement("a");
        aElem.addEventListener("click", function () {
            clickUrl(data);
        });

        const divElem = document.createElement("div");
        if(rounded_userprofile)
            divElem.style.borderRadius = "40px";

        const divElemImg = document.createElement("div");
        const imgElem = document.createElement("img");

        if(data.logo !== null)
            imgElem.src = `${assetsurl}/${data.logo}`;

        const divElemTitle = document.createElement("div");

        if(template === 1) {
            divElemImg.className += "col-md-12 col-xs-12 text-center justify-content-center border-bottom border-dark";
            imgElem.style.borderTopLeftRadius = (rounded_userprofile) ? "40px" : "14px";
            imgElem.style.borderTopRightRadius = (rounded_userprofile) ? "40px" : "14px";
            
            if(data.expanded) {
                divElemImg.className += " p-0";
                imgElem.style.width = "100%";
                imgElem.style.maxHeight = "250px";
                imgElem.style.objectFit = "cover";
            } else {                
                divElemImg.className += " py-5";
                imgElem.style.maxWidth = "5rem";
            }

            if(index % 2)
                divElem.className += "der tag row p-0 fade-in-image thumbnail ui-state-default mx-auto justify-content-center enlace";
            else
                divElem.className += "izq tag row p-0 fade-in-image thumbnail ui-state-default mx-auto justify-content-center enlace";

                
            divElemTitle.className += "col-xs-12 col-md-12 justify-content-center text-center";
        } else {
            divElem.className += "row thumbnail ui-state-default";
            divElemImg.className += "col-md-2 col-xs-2 text-center";
            imgElem.style.maxWidth = "5rem";
            divElemTitle.className += "col-xs-10 col-md-10";
        }
        
        divElemImg.appendChild(imgElem);

        const h4Elem = document.createElement("h4");
        h4Elem.className += "skill__single-part__title";
        h4Elem.style.fontSize = "16px";
        h4Elem.innerHTML = data.title;

        const h5Elem = document.createElement("h5");
        h5Elem.innerHTML = data.subtitle;

        divElemTitle.appendChild(h4Elem);
        divElemTitle.appendChild(h5Elem);
        divElem.appendChild(divElemImg);
        divElem.appendChild(divElemTitle);
        aElem.appendChild(divElem);
        container.appendChild(aElem);
    }

    function checkUser (userprofile_id, template) {
        let error = 0;
        window.CSRF_TOKEN = csrf;
        fetch(`${baseurl}/premium/getPremiumData`, {
            method: "POST",
            credentials: "same-origin",
            body: JSON.stringify({
                'userprofile_id': userprofile_id,
            }),
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': window.CSRF_TOKEN
            }
        }).then((response) => {
            if (response.ok) {
                return response.json();
            } else {
                error = 1;
                return response.json();
            }
        }).then((data) => {
            if (error) {
                document.getElementById('modal-title').innerHTML = 'Atencion';
                document.getElementById('message-alert').innerHTML = data.result;
                $('#alert-modal').modal('show');
            } else {
                showPremiumData(data.result, template);
            }
        });
    }

    function scriptAlredyExist(url) {
        let count = 0;
        var scripts = document.getElementsByTagName('script');
        for (var i = scripts.length; i--;) {
            if (scripts[i].src == url) 
                count++;
        }
        if(count === 1)
            return false;
        else 
            return true;
    }

    function deleteScript(script) {
        var scripts = document.getElementsByTagName('script');
        for (var i = scripts.length; i--;) {
            if (scripts[i] == script) {
                script[i].remove();
                break;
            }
        }
    }
}