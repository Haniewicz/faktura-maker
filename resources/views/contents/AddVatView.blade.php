<table class="table table-bordered">
    <tr>
        <th >Nazwa produktu</th>
        <th style="width: 7%;">Liczba produktów</th>
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
            <td><input type="text" class="form-control" name="name" id="name1" placeholder="Nazwa produktu"></td>
            <td><input type="number" class="form-control" onchange="count_changed(1)" name="count" id="count1" value="1" placeholder="Liczba produktów"></td>
            <td><input type="text" class="form-control" onchange="change_brutto(1)" name="price_netto" id="price_netto1" value="0.00" placeholder="Cena netto"></td>
            <td><input type="text" class="form-control" name="summary_netto" id="summary_netto1" value="0.00" placeholder="Wartość całkowita netto" readonly></td>
            <td class="input-group"><input type="text" class="form-control" onchange="vat_changed(1)" name="vat_rate" id="vat_rate1" value="23" placeholder="Stawka VAT">
                <span class="input-group-addon">%</span>
            </td>
            <td><input type="text" class="form-control" name="vat_price" id="vat_price1" value="0.00" readonly></td>
            <td><input type="text" class="form-control" onchange="change_netto(1)" name="price_brutto" id="price_brutto1" value="0.00" placeholder="Cena brutto"></td>
            <td><input type="text" class="form-control" name="summary_entity[]" id="summary1" value="0.00" readonly></td>
            <td><button type="button" onclick="delete_product(1)" class="btn btn-alert">Usuń</button></td>
        </tr>
    </tbody>
</table>
<table class="table table-bordered">
    <tr>
        <td style="width: 60%; text-align: right;">Razem do zapłaty: </td>
        <td style="text-align: left;" name="summary" id="summary"></td>
    </tr>
</table>
  <button type="button" id="add_product" class="btn btn-success">Dodaj produkt</button>
