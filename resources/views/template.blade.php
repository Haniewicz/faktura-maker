<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="{{ asset('dashboard.css') }}" rel="stylesheet">
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
        <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>


        <title>FakturaMaker</title>
    </head>
    <body>
        <div id="viewport">
          <!-- Sidebar -->
          <div id="sidebar">
            <header>
              <a href="#">Faktura-Maker</a>
            </header>
            <ul class="nav">
              <li>
                <a href="/dashboard">
                  <i class="zmdi zmdi-view-dashboard"></i> Dashboard
                </a>
              </li>
              <li>
                <a href="/add_vat">
                  <i class="zmdi zmdi-link"></i> Wystaw nową fakturę
                </a>
              </li>
              <li>
                <a href="#">
                  <i class="zmdi zmdi-widgets"></i> Overview
                </a>
              </li>
              <li>
                <a href="#">
                  <i class="zmdi zmdi-calendar"></i> Events
                </a>
              </li>
              <li>
                <a href="#">
                  <i class="zmdi zmdi-info-outline"></i> About
                </a>
              </li>
              <li>
                <a href="#">
                  <i class="zmdi zmdi-settings"></i> Services
                </a>
              </li>
              <li>
                <a href="#">
                  <i class="zmdi zmdi-comment-more"></i> Contact
                </a>
              </li>
            </ul>
          </div>
          <!-- Content -->
          <div id="content">
            <nav class="navbar navbar-default">
              <div class="container-fluid">
                <ul class="nav navbar-nav navbar-right">
                  <li>
                    <a href="#"><i class="zmdi zmdi-notifications text-danger"></i>
                    </a>
                  </li>
                  <li><a href="#" style="color:green">{{Auth::user()->name}}</a></li>
                  <li><a href="/logout" style="color:red">Wyloguj</a></li>
                </ul>
              </div>
            </nav>
            <div class="container-fluid">
                @include('contents.'.$content)
            </div>
          </div>
        </div>
        <script type="text/javascript">
            var id_count = 1;
            function delete_product(id){
                document.getElementById(id).remove();
                summary()
            }

            function change_brutto(id)
            {
                var netto = replace_dots(document.getElementById("price_netto"+id));
                var vat = replace_dots(document.getElementById("vat_rate"+id));
                var count = replace_dots(document.getElementById("count"+id));
                if(vat > 0)
                {
                    vat = vat/100;
                    vat += 1;
                    var calc = netto*vat;
                    document.getElementById("price_brutto"+id).value = Math.round((calc + Number.EPSILON) * 100) / 100;
                    calc = calc*count;
                    document.getElementById("summary"+id).value = Math.round((calc + Number.EPSILON) * 100) / 100;
                    change_netto_vat_summary(id)
                    summary()
                }else if(vat == "" || vat == 0){
                    document.getElementById("vat_rate"+id).value = "0";
                    document.getElementById("price_brutto"+id).value = netto;
                    document.getElementById("summary"+id).value = netto*count;
                    change_netto_vat_summary(id)
                    summary()
                }else{
                    alert("Wpisz poprawną stawkę VAT");
                }
            }

            function change_netto(id)
            {
                var brutto = replace_dots(document.getElementById("price_brutto"+id));
                var vat = replace_dots(document.getElementById("vat_rate"+id));
                var count = replace_dots(document.getElementById("count"+id));
                if(vat > 0)
                {
                    vat = vat/100;
                    vat += 1;
                    var calc = brutto / vat;
                    document.getElementById("price_netto"+id).value = Math.round((calc + Number.EPSILON) * 100) / 100;
                    calc = brutto * count;
                    document.getElementById("summary"+id).value = Math.round((calc + Number.EPSILON) * 100) / 100;
                    change_netto_vat_summary(id)
                    summary()
                }else if(vat == "" || vat == 0){
                    document.getElementById("vat_rate"+id).value = "0";
                    document.getElementById("price_netto"+id).value = brutto;
                    change_netto_vat_summary(id)
                    summary()
                }else{
                    alert("Wpisz poprawną stawkę VAT");
                }
            }

            function replace_dots(string)
            {
                newString = string.value.replace(",",".");
                return newString;
            }

            function vat_changed(id)
            {
                if (document.getElementById("price_netto"+id).value != "")
                {
                    change_brutto(id);
                }else if(document.getElementById("price_brutto"+id).value != "") {
                    change_netto(id);
                }
            }

            function change_netto_vat_summary(id)
            {
                var brutto = replace_dots(document.getElementById("price_brutto"+id));
                var netto = replace_dots(document.getElementById("price_netto"+id));
                var vat = replace_dots(document.getElementById("vat_rate"+id));
                var count = replace_dots(document.getElementById("count"+id));

                if(netto > 0)
                {
                    document.getElementById("summary_netto"+id).value = netto*count;
                    vat = vat/100;
                    var calc = netto*count;
                    summ = calc*vat;
                    document.getElementById("vat_price"+id).value = Math.round((summ + Number.EPSILON) * 100) / 100;

                }else if(brutto > 0){
                    vat = vat/100;
                    vat += 1;
                    var calc = brutto/vat;
                    document.getElementById("summary_netto"+id).value = calc*count;
                    vat -= 1;
                    summ = calc*vat;
                    document.getElementById("vat_price"+id).value = Math.round((summ + Number.EPSILON) * 100) / 100;
                }

            }

            function count_changed(id)
            {
                var count = replace_dots(document.getElementById("count"+id));
                var brutto = replace_dots(document.getElementById("price_brutto"+id));
                document.getElementById("summary"+id).value =  brutto * count;
                change_netto_vat_summary(id)
                summary()
            }

            function summary()
            {
                var summ = document.getElementsByName("summary_entity[]");
                var price_summary = 0;
                for (var i = 0; i < summ.length; i++)
                {
                    var val = summ[i];
                    price_summary += parseFloat(val.value);
                }
                document.getElementById("summary").innerHTML = Math.round((price_summary + Number.EPSILON) * 100) / 100;
            }

             window.onload = function() {
                 var btn = document.getElementById("add_product");
                 btn.addEventListener("click", function()
                 {
                     id_count += 1;
                     var newProduct =
                     "<tr id='" + id_count +"'>\
                         <td><input type='text' class='form-control' name='name' id='name" + id_count +"' placeholder='Nazwa produktu'></td>\
                         <td><input type='number' class='form-control' onchange='count_changed(" + id_count + ")' name='count' id='count" + id_count +"' value='1' placeholder='Liczba produktów'></td>\
                         <td><input type='text' class='form-control' onchange='change_brutto(" + id_count + ")' name='price_netto' id='price_netto" + id_count +"' value='0.00' placeholder='Cena netto'></td>\
                         <td><input type='text' class='form-control' name='summary_netto' id='summary_netto" + id_count +"' value='0.00' placeholder='Wartość całkowita netto' readonly></td>\
                         <td class='input-group'><input type='text' class='form-control' onchange='vat_changed(" + id_count + ")' name='vat_rate' id='vat_rate" + id_count +"' value='23' placeholder='Stawka VAT'>\
                             <span class='input-group-addon'>%</span>\
                         </td>\
                         <td><input type='text' class='form-control' name='vat_price' id='vat_price" + id_count +"' value='0.00' readonly></td>\
                         <td><input type='text' class='form-control' name='price_brutto' id='price_brutto" + id_count +"' onchange='change_netto(" + id_count + ")' value='0.00' placeholder='Stawka brutto'></td>\
                         <td><input type='text' class='form-control' name='summary_entity[]' id='summary" + id_count +"' value='0.00' readonly></td>\
                         <td><button type='button' onclick='delete_product(" + id_count +")' class='btn btn-alert'>Usuń</button></td>\
                     </tr>";

                     document.getElementById("products_table").insertAdjacentHTML('beforeend', newProduct);
                 }, false);
            }

        </script>
    </body>
</html>
