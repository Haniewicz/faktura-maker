<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title></title>
        <style>
            .table {
            border-collapse: collapse;
            width: 100%;
            }

            .table td, th {
            border: 1px solid #727272;
            padding-left: 5px;
            padding-right: 5px;
            text-align: left;
            }
        </style>
    </head>
    <body style="font-family: DejaVu Sans">
        <div style="width: 100%">
            <div style="width: 50%; float: left;">
                <h1>{{$details->seller}}</h1>
            </div>
            <div style="width: 50%; float: left;">
                <h3 style="margin-bottom: 0px; padding-left: 5px; border: 1px solid #727272;">Faktura nr: {{$details->created_at->format('d/m/Y')}}</h3>
                <p style="margin-top: 0px; padding-left: 5px; margin-bottom: 0px; border: 1px solid #727272;">Data wystawienia: {{$details->created_at->format('d/m/Y')}}</p>
                <p style="margin-top: 0px; padding-left: 5px; border: 1px solid #727272; border-top: 0px;">Data sprzedaży: {{$actual_date}}</p>
            </div>
        </div>
        <br style="clear: both;" />
        <table style="font-size: 14px; width: 100%; margin-bottom: 20px;">
            <tr>
                <th style="border: 0px; width: 50%; padding: 0px; text-align: left;"><b>Sprzedawca</b></th>
                <th style="border: 0px; width: 50%; padding: 0px; text-align: left;"><b>Klient</b></th>
            </tr>
            <tr>
                <td style="text-align: left;" class="form-inline">
                    <div class="form-group">
                      <span>{{$details->seller}}</span>
                    </div>
                </td>
                <td style="text-align: left;" class="form-inline">
                    <div class="form-group">
                      <span>{{$details->client}}</span>
                    </div>
                </td>
            </tr>
            <tr>
                <td style="text-align: left;" class="form-inline">
                    <div class="form-group">
                        <label>NIP: </label>
                      <span>{{$details->seller_nip}}</span>
                    </div>
                </td>
                <td style="text-align: left;" class="form-inline">
                    <div class="form-group">
                      <label>NIP: </label>
                      <span>{{$details->client_nip}}</span>
                    </div>
                </td>
            </tr>
            <tr>
                <td style="text-align: left;" class="form-inline">
                    <div class="form-group">
                      <span>{{$details->seller_postcode}} {{$details->seller_city}}</span>
                    </div>
                </td>
                <td style="text-align: left;" class="form-inline">
                    <div class="form-group">
                      <span>{{$details->client_postcode}} {{$details->client_city}}</span>
                    </div>
                </td>
            </tr>
            <tr>
                <td style="text-align: left;" class="form-inline">
                    <div class="form-group">
                      <span>ul. {{$details->seller_street}}</span>
                    </div>
                </td>
                <td style="text-align: left;" class="form-inline">
                    <div class="form-group">
                      <span>ul. {{$details->client_street}}</span>
                    </div>
                </td>
            </tr>
        </table>
        <hr>
        <table style="margin-top: 20px; font-size: 14px;" width="100%" class="table">
            <tr>
                <th style="width: 5%; text-align: center;">Lp.</th>
                <th>Nazwa</th>
                <th style="width: 5%; text-align: center;">Jedn.</th>
                <th style="width: 5%; text-align: center;">Ilość</th>
                <th style="width: 13%; text-align: center;">Cena netto</th>
                <th style="width: 5%; text-align: center;">Stawka</th>
                <th style="width: 13%; text-align: center;">Wartość netto</th>
                <th style="width: 13%; text-align: center;">Wartość brutto</th>
            </tr>
            <tbody>
                @foreach($products as $product)
                    <tr>
                        <td style="text-align: center;">{{$id += 1}}</td>
                        <td>{{$product->name}}</td>
                        <td style="text-align: center;">{{$product->unit_of_measure}}</td>
                        <td style="text-align: center;">{{$product->count}}</td>
                        <td style="text-align: right;">{{$product->price_netto}}</td>
                        <td style="text-align: center;">{{$product->vat_rate}}%</td>
                        <td style="text-align: right;">{{$product->price_netto * $product->count}}</td>
                        <td style="text-align: right;">{{$product->price_brutto * $product->count}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div style="font-size: 14px; width: 100%; margin-top: 20px;">
            <div style="width: 50%; float: left;">
                <table class="table" width="100%" border=1>
                    <tr>
                        <th></th>
                        <th>Wartość netto</th>
                        <th>Kwota VAT</th>
                        <th>Wartość brutto</th>
                    </tr>
                    <tbody>
                        <tr>
                            <td>Razem</td>
                            <td style="text-align: right;">{{$details->final_price_netto}}</td>
                            <td style="text-align: right;">{{$details->final_price_vat}}</td>
                            <td style="text-align: right;">{{$details->final_price_brutto}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div style="text-align: right; width: 50%; float: left;">
                <p style="margin-top: 0px;">Wartość netto: {{$details->final_price_netto}} PLN</p>
                <p>Wartość VAT: {{$details->final_price_vat}} PLN</p>
                <p style="font-weight: bold;">Do zapłaty: <b style="color: #0066ff">{{$details->final_price_brutto}} PLN</b></p>
            </div>
        </div>
        <br style="clear: both;" />
        <div style="text-align: center; width: 100%; margin-top: 60px;">
            <div style=" width: 50%; float: left;">
                <hr style="width: 60%">
                <p style="font-size: 14px;">Podpis sprzedawcy</p>
            </div>
            <div style="text-align: center; width: 50%; float: left;">
                <hr style="width: 60%">
                <p style="font-size: 14px;">Podpis nabywcy</p>
            </div>
        </div>
    </body>
</html>
