<h1>Edycja profilu</h1>
<p>Dane, które tu wprowadzisz, będą automatycznie uzupełniane podczas tworzenia nowej faktury.</p>
<div class="alert alert-danger print-error-msg" style="display:none">
        <ul></ul>
    </div>
<div class="col-lg-4">
    <form id="EditProfileForm" data-ajax="true" method="POST" action="/profile" style="display: block;">
        @csrf
        <!-- @csrf_field -->
        <div class="form-group">
            <input type="text" name="seller" id="seller" tabindex="1" class="form-control" placeholder="Nazwa sprzedawcy" value="">
        </div>
        <div class="form-group">
            <input type="text" name="nip" id="nip" tabindex="2" class="form-control" placeholder="Nip">
        </div>
        <div class="form-group">
            <input type="text" name="city" id="city" tabindex="3" class="form-control" placeholder="Miejscowość">
        </div>
        <div class="form-group">
            <input type="text" name="street" id="street" tabindex="4" class="form-control" placeholder="Ulica">
        </div>
        <div class="form-group">
            <input type="text" name="postcode" id="postcode" tabindex="5" class="form-control" placeholder="Kod pocztowy">
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-sm-6 col-sm-offset-3">
                    <input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Zapisz">
                </div>
            </div>
        </div>
    </form>
</div>
