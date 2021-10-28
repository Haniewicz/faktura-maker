\<script type="text/javascript">
    var id_count = 1;
    function delete_product(id){
        if(!String(id).includes('local'))
        {
            var _token = $("input[name='_token']").val();

            $.ajax({
                url: "{{ route('delete.product') }}",
                type:'POST',
                data: {_token:_token, id:id},
                dataType: 'json',
                success: function(data) {
                    if($.isEmptyObject(data.error)){
                        alert(data.success);
                    }else{
                        printErrorMsg(data.error);
                    }
                }
            });
        }
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
        string.value = newString;
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
        var brutto = document.getElementsByName("summary_entity[]");
        var netto = document.getElementsByName("summary_netto[]");
        var vat = document.getElementsByName("vat_price[]");
        var brutto_summary = 0;
        for (var i = 0; i < brutto.length; i++)
        {
            var val = brutto[i];
            brutto_summary += parseFloat(val.value);
        }
        var netto_summary = 0;
        for (var i = 0; i < netto.length; i++)
        {
            var val = netto[i];
            netto_summary += parseFloat(val.value);
        }
        var vat_summary = 0;
        for (var i = 0; i < vat.length; i++)
        {
            var val = vat[i];
            vat_summary += parseFloat(val.value);
        }
        document.getElementById("final_brutto").value = Math.round((brutto_summary + Number.EPSILON) * 100) / 100;
        document.getElementById("final_netto").value = Math.round((netto_summary + Number.EPSILON) * 100) / 100;
        document.getElementById("final_vat").value = Math.round((vat_summary + Number.EPSILON) * 100) / 100;
    }

     window.onload = function() {
         var btn = document.getElementById("add_product");
         btn.addEventListener("click", function()
         {
             id_count += 1;
             id_string = "_local_"+String(id_count);
             var newProduct =
             "<tr id='" + id_string +"'>\
                 <td><input type='text' class='form-control' name='local_name[]' id='name" + id_string +"' placeholder='Nazwa produktu'></td>\
                 <td><input type='number' class='form-control' onchange='count_changed(\"" + id_string + "\")' name='local_count[]' id='count" + id_string +"' value='1' placeholder='Liczba produktów'></td>\
                 <td><input type='text' class='form-control' onchange='change_brutto(\"" + id_string + "\")' name='local_price_netto[]' id='price_netto" + id_string +"' value='0.00' placeholder='Cena netto'></td>\
                 <td><input type='text' class='form-control' name='summary_netto[]' id='summary_netto" + id_string +"' value='0.00' placeholder='Wartość całkowita netto' readonly></td>\
                 <td class='input-group'><input type='text' class='form-control' onchange='vat_changed(\"" + id_string + "\")' name='local_vat_rate[]' id='vat_rate" + id_string +"' value='23' placeholder='Stawka VAT'>\
                     <span class='input-group-addon'>%</span>\
                 </td>\
                 <td><input type='text' class='form-control' name='vat_price[]' id='vat_price" + id_string +"' value='0.00' readonly></td>\
                 <td><input type='text' class='form-control' name='local_price_brutto[]' id='price_brutto" + id_string +"' onchange='change_netto(\"" + id_string + "\")' value='0.00' placeholder='Stawka brutto'></td>\
                 <td><input type='text' class='form-control' name='summary_entity[]' id='summary" + id_string +"' value='0.00' readonly></td>\
                 <td><button type='button' onclick='delete_product(\"" + id_string +"\")' class='btn btn-danger'>Usuń</button></td>\
             </tr>";

             document.getElementById("products_table").insertAdjacentHTML('beforeend', newProduct);
         }, false);
    }

    $(document).ready(function() {
        $(".btn-submit").click(function(e){
            e.preventDefault();

            var _token = $("input[name='_token']").val();
            var id = $("input[name='id']").val();
            var seller = $("input[name='seller']").val();
            var seller_nip = $("input[name='seller_nip']").val();
            var seller_city = $("input[name='seller_city']").val();
            var seller_street = $("input[name='seller_street']").val();
            var seller_postcode = $("input[name='seller_postcode']").val();
            var client = $("input[name='client']").val();
            var client_nip = $("input[name='client_nip']").val();
            var client_city = $("input[name='client_city']").val();
            var client_street = $("input[name='client_street']").val();
            var client_postcode = $("input[name='client_postcode']").val();
            var final_netto = $("input[name='final_netto']").val();
            var final_vat = $("input[name='final_vat']").val();
            var final_brutto = $("input[name='final_brutto']").val();
            var product_id = [];
            $('input[name^="product_id"]').each(function() {
                product_id.push(this.value);
            });
            var name = [];
            $('input[name^="name"]').each(function() {
                name.push(this.value);
            });
            var price_netto = [];
            $('input[name^="price_netto"]').each(function() {
                price_netto.push(this.value);
            });
            var price_brutto = [];
            $('input[name^="price_brutto"]').each(function() {
                price_brutto.push(this.value);
            });
            var vat_rate = [];
            $('input[name^="vat_rate"]').each(function() {
                vat_rate.push(this.value);
            });
            var count = [];
            $('input[name^="count"]').each(function() {
                count.push(this.value);
            });
            var local_name = [];
            $('input[name^="local_name"]').each(function() {
                local_name.push(this.value);
            });
            var local_price_netto = [];
            $('input[name^="local_price_netto"]').each(function() {
                local_price_netto.push(this.value);
            });
            var local_price_brutto = [];
            $('input[name^="local_price_brutto"]').each(function() {
                local_price_brutto.push(this.value);
            });
            var local_vat_rate = [];
            $('input[name^="local_vat_rate"]').each(function() {
                local_vat_rate.push(this.value);
            });
            var local_count = [];
            $('input[name^="local_count"]').each(function() {
                local_count.push(this.value);
            });

            $.ajax({
                url: "{{ route('edit.vat') }}",
                type:'POST',
                data: {_token:_token, id:id, seller:seller, seller_nip:seller_nip, seller_city:seller_city, seller_street:seller_street, seller_postcode:seller_postcode, client:client, client_nip:client_nip, client_city:client_city, client_street:client_street, client_postcode:client_postcode, product_id:product_id, name:name, price_netto:price_netto, price_brutto:price_brutto, vat_rate:vat_rate, count:count, final_netto:final_netto, final_vat:final_vat, final_brutto:final_brutto, local_name:local_name, local_price_netto:local_price_netto, local_price_brutto:local_price_brutto, local_vat_rate:local_vat_rate, local_count:local_count},
                dataType: 'json',
                success: function(data) {
                    if($.isEmptyObject(data.error)){
                        alert(data.success);
                    }else{
                        printErrorMsg(data.error);
                    }
                }
            });

        });

        function printErrorMsg (msg) {
            $(".print-error-msg").find("ul").html('');
            $(".print-error-msg").css('display','block');
            $.each( msg, function( key, value ) {
                $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
            });
        }
    });

</script>
