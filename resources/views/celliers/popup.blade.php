<!---- Message -->
<div id="myToast1" class="toast align-items-center text-white bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="d-flex">
        <div class="toast-body">
            Bouteille à été ajouté avec succès...!!!
        </div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
</div>
<div id="myToast2" class="toast align-items-center text-white bg-danger border-0" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="d-flex">
        <div class="toast-body">
            Bouteille supprimé avec succès...!!!
        </div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
</div>
<div id="myToast3" class="toast align-items-center text-white bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="d-flex">

        <div class="toast-body">
            Quantité mise a jour avec succés...
        </div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
</div>
<!-- popup.blade.php -->
<div id="popup" class="popup">
    <div class="popup-content">
        <span class="close" onclick="cacherPopupCellier()">&times;</span>
        <h5>Suppression Boutteille</h2>
            <div class="alert alert-danger" role="alert">
                Voulez vous suuprimer cette bouteiille ?
            </div>
            <input type="button" onclick="cacherPopupCellier()" value="Annuler">
            <input type="button" id="idsuppbc" value="Valider">
            .
    </div>

</div>
</div>