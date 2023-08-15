// Fonction de la mise a jour de la quantité :
function updateQuantite(id,qte) {
    var myid =id.trim();
    
    const currentUrl = window.location.href;
    let url = currentUrl+'/updateQuantite';
    let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    fetch(url, {
        headers: {
            "Content-Type": "application/json",
            "Accept": "application/json, text-plain, */*",
            "X-Requested-With": "XMLHttpRequest",
            "X-CSRF-TOKEN": token
        },
        method: 'post',
        credentials: "same-origin",
        body: JSON.stringify({
            idcb: id,
            quantite:document.getElementById(myid).value
        })
    })
        .then((data) => {
            var element3 = document.getElementById("myToast3");
            var myToast3 = new bootstrap.Toast(element3);
            myToast3.show();
            setTimeout(() => {
                myToast3.hide();
            }, 2000);
        })
        .catch(function(error) {
            console.log(error);
        });
}

function afficherPopupCellier(event) {
    const popup = document.getElementById("popup");
    popup.style.display = "block";
    let idBouteilleC = event.currentTarget.getAttribute("data-id");
    let idsuppbc = document.getElementById("idsuppbc");
    idsuppbc.onclick = function () {
        SupprimerBouteilleCellier(idBouteilleC);
    };
    
    }
    function cacherPopupCellier() {
        const popup = document.getElementById("popup");
        popup.style.display = "none";
    }
    // Fonction supp bouteilles JS :
    function SupprimerBouteilleCellier(idbc) {
      
      
        const currentUrl = window.location.href;
                let url = currentUrl + '/bouteillecellier-destroy';
                let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
              
                fetch(url, {
                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json, text-plain, */*",
                        "X-Requested-With": "XMLHttpRequest",
                        "X-CSRF-TOKEN": token
                    },
                    method: 'POST',
                    credentials: "same-origin",
                    body: JSON.stringify({
                        idbc: idbc,
                    })
                })
                    .then((data) => {
                        cacherPopupCellier();
                        var element2 = document.getElementById("myToast2");
                        var myToast2 = new bootstrap.Toast(element2);
                        myToast2.show();
                        setTimeout(() => {
                            myToast2.hide();
                        }, 2000);
                        setTimeout(() => {
                            location.href =  currentUrl;
                        }, 1000);
    
                       
                    })
                    .catch(function(error) {
                        console.log(error);
                    });
    
    
    
    
            }
            //ajouter 
            function AjouterBouteilleCellier(id,qte) {
                const currentUrl = window.location.href;
                let url = currentUrl + '/updateQuantite';
                let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
              
                fetch(url, {
                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json, text-plain, */*",
                        "X-Requested-With": "XMLHttpRequest",
                        "X-CSRF-TOKEN": token
                    },
                    method: 'post',
                    credentials: "same-origin",
                    body: JSON.stringify({
                        idcb: id,
                        quantite: qte
                    })
                })
                    .then((data) => {
                        var element3 = document.getElementById("myToast3");
                        var myToast3 = new bootstrap.Toast(element3);
                        myToast3.show();
                        setTimeout(() => {
                            myToast3.hide();
                        }, 2000);
                    })
                    .catch(function(error) {
                        console.log(error);
                    });
    
    
    
    
            }