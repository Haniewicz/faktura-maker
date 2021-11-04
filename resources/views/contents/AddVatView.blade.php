<div class="alert alert-danger print-error-msg" style="display:none">
        <ul></ul>
    </div>
<form id="AddVatForm" data-ajax="true" method="POST" action="/add_vat">
    @csrf
    <table style="width: 50%; margin-left:50%; margin-bottom: 20px;">
        <tr>
            <th style="width: 50%; text-align: right;">Sprzedawca</th>
            <th style="width: 50%; text-align: right;">Klient</th>
        </tr>
        <tr>
            <td style="text-align: right;" class="form-inline">
                <div class="form-group">
                  <labe>  Nazwa: </label>
                  <input type="text" name="seller" class="form-control" placeholder="Nazwa" value="{{$user->seller}}">
                </div>
            </td>
            <td style="text-align: right;" class="form-inline">
                <div class="form-group">
                  <label>  Nazwa: </label>
                  <input type="text" name="client" class="form-control" placeholder="Nazwa">
                </div>
            </td>
        </tr>
        <tr>
            <td style="text-align: right;" class="form-inline">
                <div class="form-group">
                  <labe>  NIP: </label>
                  <input type="text" name="seller_nip" class="form-control" placeholder="NIP" value="{{$user->nip}}">
                </div>
            </td>
            <td style="text-align: right;" class="form-inline">
                <div class="form-group">
                  <label>  NIP: </label>
                  <input type="text" name="client_nip" class="form-control" placeholder="NIP">
                </div>
            </td>
        </tr>
        <tr>
            <td style="text-align: right;" class="form-inline">
                <div class="form-group">
                  <labe>  Miejscowość: </label>
                  <input type="text" name="seller_city" class="form-control" placeholder="Miejscowość" value="{{$user->city}}">
                </div>
            </td>
            <td style="text-align: right;" class="form-inline">
                <div class="form-group">
                  <label>  Miejscowość: </label>
                  <input type="text" name="client_city" class="form-control" placeholder="Miejscowość">
                </div>
            </td>
        </tr>
        <tr>
            <td style="text-align: right;" class="form-inline">
                <div class="form-group">
                  <labe>  Ulica: </label>
                  <input type="text" name="seller_street" class="form-control" placeholder="Ulica" value="{{$user->street}}">
                </div>
            </td>
            <td style="text-align: right;" class="form-inline">
                <div class="form-group">
                  <label>  Ulica: </label>
                  <input type="text" name="client_street" class="form-control" placeholder="Ulica">
                </div>
            </td>
        </tr>
        <tr>
            <td style="text-align: right;" class="form-inline">
                <div class="form-group">
                  <labe>  Kod pocztowy: </label>
                  <input type="text" name="seller_postcode" class="form-control" placeholder="Kod pocztowy" value="{{$user->postcode}}">
                </div>
            </td>
            <td style="text-align: right;" class="form-inline">
                <div class="form-group">
                  <label>  Kod pocztowy: </label>
                  <input type="text" name="client_postcode" class="form-control" placeholder="Kod pocztowy">
                </div>
            </td>
        </tr>
    </table>
    <table class="table table-bordered">
        <tr>
            <th >Nazwa produktu</th>
            <th style="width: 5%;">Liczba produktów</th>
            <th style="width: 5%;">Jednostka miary</th>
            <th style="width: 10%;">Cena jednostkowa netto</th>
            <th style="width: 10%;">Wartość całkowita netto</th>
            <th style="width: 10%;">Stawka VAT</th>
            <th style="width: 7%;">Kwota VAT</th>
            <th style="width: 10%;">Cena jednostkowa brutto</th>
            <th style="width: 10%;">Wartość całkowita brutto</th>
            <th style="width: 5%;">Akcje</th>
        </tr>
        <tbody id="products_table">
            <tr id="1">
                <td><input type="text" class="form-control" name="name[]" id="name1" placeholder="Nazwa produktu"></td>
                <td><input type="number" class="form-control" onchange="count_changed(1)" name="count[]" id="count1" value="1" placeholder="Liczba produktów"></td>
                <td>
                    <select class="form-control" name="unit_of_measure[]">
                        <option value="szt.">szt.</option>
                        <option value="usł.">usł.</option>
                        <option value="mies.">mies.</option>
                        <option value="opak.">opak.</option>
                        <option value="m2">m2</option>
                        <option value="m3">m3</option>
                    </select>
                </td>
                <td><input type="text" class="form-control" onchange="change_brutto(1)" name="price_netto[]" id="price_netto1" value="0.00" placeholder="Cena netto"></td>
                <td><input type="text" class="form-control" name="summary_netto[]" id="summary_netto1" value="0.00" placeholder="Wartość całkowita netto" readonly></td>
                <td class="input-group"><input type="text" class="form-control" onchange="vat_changed(1)" name="vat_rate[]" id="vat_rate1" value="23" placeholder="Stawka VAT">
                    <span class="input-group-addon">%</span>
                </td>
                <td><input type="text" class="form-control" name="vat_price[]" id="vat_price1" value="0.00" readonly></td>
                <td><input type="text" class="form-control" onchange="change_netto(1)" name="price_brutto[]" id="price_brutto1" value="0.00" placeholder="Cena brutto"></td>
                <td><input type="text" class="form-control" name="summary_entity[]" id="summary1" value="0.00" readonly></td>
                <td><button type="button" onclick="delete_product(1)" class="btn btn-danger">Usuń</button></td>
            </tr>
        </tbody>
    </table>
    <button type="button" id="add_product" style="margin-bottom: 20px;" class="btn btn-primary">Dodaj produkt</button>
    <table class="table table-bordered">
        <tr>
            <th style="width: 38%; text-align: right;"></th>
            <th style="text-align: left;">Cena netto:</th>
            <th style="text-align: left;">Cena VAT</th>
            <th style="text-align: left;">Cena brutto:</th>
        </tr>
        <tr>
            <td style="width: 38%; text-align: right;">Razem do zapłaty: </td>
            <td style="text-align: left;"><input class="form-control" type="text" id="final_netto" name="final_netto" value="" readonly></td>
            <td style="text-align: left;"><input class="form-control" name="final_vat" id="final_vat" type="text" value="" readonly></td>
            <td style="text-align: left;"><input class="form-control" name="final_brutto" id="final_brutto" type="text" value="" readonly></td>
        </tr>
    </table>
    <button type="success" id="save_product" style="margin-bottom: 20px;" class="btn btn-submit btn-success">Zapisz fakturę</button>
</form>
