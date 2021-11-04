<div class="alert alert-danger print-error-msg" style="display:none">
        <ul></ul>
    </div>
<form id="EditVatForm" data-ajax="true" method="POST" action="/edit_vat">
    @csrf
    <input type="hidden" name="id" value="{{$details->id}}">
    <table style="width: 50%; margin-left:50%; margin-bottom: 20px;">
        <tr>
            <th style="width: 50%; text-align: right;">Sprzedawca</th>
            <th style="width: 50%; text-align: right;">Klient</th>
        </tr>
        <tr>
            <td style="text-align: right;" class="form-inline">
                <div class="form-group">
                  <label for="exampleInputName2">  Nazwa: </label>
                  <input type="text" name="seller" class="form-control" placeholder="Nazwa" value="{{$details->seller}}">
                </div>
            </td>
            <td style="text-align: right;" class="form-inline">
                <div class="form-group">
                  <label for="exampleInputEmail2">  Nazwa: </label>
                  <input type="text" name="client" class="form-control" placeholder="Nazwa" value="{{$details->client}}">
                </div>
            </td>
        </tr>
        <tr>
            <td style="text-align: right;" class="form-inline">
                <div class="form-group">
                  <label for="exampleInputName2">  NIP: </label>
                  <input type="text" name="seller_nip" class="form-control" placeholder="NIP" value="{{$details->seller_nip}}">
                </div>
            </td>
            <td style="text-align: right;" class="form-inline">
                <div class="form-group">
                  <label for="exampleInputEmail2">  NIP: </label>
                  <input type="text" name="client_nip" class="form-control" placeholder="NIP" value="{{$details->client_nip}}">
                </div>
            </td>
        </tr>
        <tr>
            <td style="text-align: right;" class="form-inline">
                <div class="form-group">
                  <label for="exampleInputName2">  Miejscowość: </label>
                  <input type="text" name="seller_city" class="form-control" placeholder="Miejscowość" value="{{$details->seller_city}}">
                </div>
            </td>
            <td style="text-align: right;" class="form-inline">
                <div class="form-group">
                  <label for="exampleInputEmail2">  Miejscowość: </label>
                  <input type="text" name="client_city" class="form-control" placeholder="Miejscowość" value="{{$details->client_city}}">
                </div>
            </td>
        </tr>
        <tr>
            <td style="text-align: right;" class="form-inline">
                <div class="form-group">
                  <label for="exampleInputName2">  Ulica: </label>
                  <input type="text" name="seller_street" class="form-control" placeholder="Ulica" value="{{$details->seller_street}}">
                </div>
            </td>
            <td style="text-align: right;" class="form-inline">
                <div class="form-group">
                  <label for="exampleInputEmail2">  Ulica: </label>
                  <input type="text" name="client_street" class="form-control" placeholder="Ulica" value="{{$details->client_street}}">
                </div>
            </td>
        </tr>
        <tr>
            <td style="text-align: right;" class="form-inline">
                <div class="form-group">
                  <label for="exampleInputName2">  Kod pocztowy: </label>
                  <input type="text" name="seller_postcode" class="form-control" placeholder="Kod pocztowy" value="{{$details->seller_postcode}}">
                </div>
            </td>
            <td style="text-align: right;" class="form-inline">
                <div class="form-group">
                  <label for="exampleInputEmail2">  Kod pocztowy: </label>
                  <input type="text" name="client_postcode" class="form-control" placeholder="Kod pocztowy" value="{{$details->client_postcode}}">
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
            @foreach($products as $product)
                <tr id="{{$product->id}}">
                    <input type="hidden" name="product_id[]" value="{{$product->id}}">
                    <td><input type="text" class="form-control" name="name[]" id="name1" value="{{$product->name}}" placeholder="Nazwa produktu"></td>
                    <td><input type="number" class="form-control" onchange="count_changed({{$product->id}})" name="count[]" id="count{{$product->id}}" value="{{$product->count}}" placeholder="Liczba produktów"></td>
                    <td>
                        <select class="form-control" name="unit_of_measure[]">
                            <option @if($product->unit_of_measure == "szt.") selected @endif value="szt.">szt.</option>
                            <option @if($product->unit_of_measure == "usł.") selected @endif value="usł.">usł.</option>
                            <option @if($product->unit_of_measure == "mies.") selected @endif value="mies.">mies.</option>
                            <option @if($product->unit_of_measure == "opak.") selected @endif value="opak.">opak.</option>
                            <option @if($product->unit_of_measure == "m2") selected @endif value="m2">m2</option>
                            <option @if($product->unit_of_measure == "m3") selected @endif value="m3">m3</option>
                        </select>
                    </td>
                    <td><input type="text" class="form-control" onchange="change_brutto({{$product->id}})" name="price_netto[]" id="price_netto{{$product->id}}" value="{{$product->price_netto}}" placeholder="Cena netto"></td>
                    <td><input type="text" class="form-control" name="summary_netto[]" id="summary_netto{{$product->id}}" value="{{$product->price_netto * $product->count}}" placeholder="Wartość całkowita netto" readonly></td>
                    <td class="input-group"><input type="text" class="form-control" onchange="vat_changed({{$product->id}})" name="vat_rate[]" id="vat_rate{{$product->id}}" value="{{$product->vat_rate}}" placeholder="Stawka VAT">
                        <span class="input-group-addon">%</span>
                    </td>
                    <td><input type="text" class="form-control" name="vat_price[]" id="vat_price{{$product->id}}" value="{{$product->price_netto * $product->vat_rate / 100}}" readonly></td>
                    <td><input type="text" class="form-control" onchange="change_netto({{$product->id}})" name="price_brutto[]" id="price_brutto{{$product->id}}" value="{{$product->price_brutto}}" placeholder="Cena brutto"></td>
                    <td><input type="text" class="form-control" name="summary_entity[]" id="summary{{$product->id}}" value="{{$product->price_brutto * $product->count}}" readonly></td>
                    <td><button type="button" onclick="delete_product({{$product->id}})" class="btn btn-danger">Usuń</button></td>
                </tr>
            @endforeach
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
            <td style="text-align: left;"><input class="form-control" type="text" id="final_netto" name="final_netto" value="{{$details->final_price_netto}}" readonly></td>
            <td style="text-align: left;"><input class="form-control" name="final_vat" id="final_vat" type="text" value="{{$details->final_price_vat}}" readonly></td>
            <td style="text-align: left;"><input class="form-control" name="final_brutto" id="final_brutto" type="text" value="{{$details->final_price_brutto}}" readonly></td>
        </tr>
    </table>
    <button type="success" id="save_product" style="margin-bottom: 20px;" class="btn btn-submit btn-success">Zapisz fakturę</button>
</form>
