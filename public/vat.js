function add_product()
{
     document.getElementById("products_table").innerHTML +=
     \\"<tr id="1">
         <td>1</td>
         <td><input type="text" class="form-control" name="name" id="name" placeholder="Jane Doe"></td>
         <td><input type="number" class="form-control" name="count" id="count" placeholder="jane.doe@example.com"></td>
         <td><input type="text" class="form-control" name="price_netto" id="price_netto" placeholder="jane.doe@example.com"></td>
         <td class="input-group"><input type="text" class="form-control" name="vat_rate" id="vat_rate" placeholder="jane.doe@example.com">
             <span class="input-group-addon">%</span>
         </td>
         <td><input type="text" class="form-control" name="price_brutto" id="price_brutto" placeholder="jane.doe@example.com"></td>
         <td><button type="button" class="btn btn-alert">Usuń</button></td>
     </tr>";
}
