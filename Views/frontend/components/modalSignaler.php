<div id="modal" class="container-signaler hide">
    <div class="main-container-form card">
        <div id="btn-close" class="btn-close"></div>
        <div id="reponse"></div>
        <div class="container-photo-profile">
            <p class="text-connexion text-center">Vous voulez vraiment signaler ce commantaire ?</p>
        </div>
        <div class="container-form grid-x">
            <form id="signaler-com" action="./routes/routerSignalerComm.php" method="POST" class="small-10">
                <input type="hidden" id="commid" name="commid" value="">
                <div class="form-group group-signaler">
                    <button id="annuler" type="button" class="btn error">Annuler</button>
                    <input class="btn valider" type="submit" value="Signaler">
                </div>
            </form>
        </div>
    </div>
</div>
