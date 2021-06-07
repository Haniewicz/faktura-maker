<table class="table table-bordered">
    <tr>
        <th style="width: 5%">ID</th>
        <th >Nazwa produktu</th>
        <th style="width: 7%;">Liczba produktów</th>
        <th style="width: 10%;">Cena netto</th>
        <th style="width: 10%;">Stawka VAT</th>
        <th style="width: 10%;">Cena brutto</th>
        <th style="width: 10%;">Akcje</th>
    </tr>
    <tr id="1">
        <td>1</td>
        <td><input type="text" class="form-control" name="name" id="name" placeholder="Jane Doe"></td>
        <td><input type="number" class="form-control" name="count" id="count" placeholder="jane.doe@example.com"></td>
        <td><input type="text" class="form-control" name="price_netto" id="price_netto" placeholder="jane.doe@example.com"></td>
        <td class="input-group"><input type="text" class="form-control" name="vat_rate" id="vat_rate" placeholder="jane.doe@example.com">
            <span class="input-group-addon">%</span>
        </td>
        <td><input type="text" class="form-control" name="price_brutto" id="price_brutto" placeholder="jane.doe@example.com"></td>
        <td><button type="button" class="btn btn-alert">Usuń</button></td>
    </tr>
</table>
<table class="table table-bordered">
    <tr>
        <td style="width: 60%; text-align: right;">Razem: </td>
        <td style="text-align: left;">111 zł</td>
    </tr>
</table>

<form class="form-inline">
  <div class="form-group">
    <label class="vat-add-label" for="name">Nazwa Produktu</label>
    <input type="text" class="form-control" name="name" id="name" placeholder="Jane Doe">
  </div>
  <div class="form-group">
    <label for="count">Liczba produktów</label>
    <input type="number" class="form-control" name="count" id="count" placeholder="jane.doe@example.com">
  </div>
  <div class="form-group">
    <label for="price_netto">Cena netto</label>
    <input type="text" class="form-control" name="price_netto" id="price_netto" placeholder="jane.doe@example.com">
  </div>
  <div class="form-group">
    <label for="vat_rate">Vat</label>
    <input type="text" class="form-control" name="vat_rate" id="vat_rate" placeholder="jane.doe@example.com">
    <span class="form-group-addon">
        %
    </span>
  </div>
  <div class="form-group">
    <label for="price_netto">Cena brutto</label>
    <input type="text" class="form-control" name="price_brutto" id="price_brutto" placeholder="jane.doe@example.com">
  </div>
  <button type="button" class="btn btn-alert">Usuń</button>
  <div style="clear:both;"></div>
  <button type="button" class="btn btn-success">Dodaj produkt</button>
</form>
