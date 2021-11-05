<table class="table table-bordered display" id="table_id">
    <thead>
        <th style="width: 5%;">Id</th>
        <th style="width: 10%;">Data utworzenia</th>
        <th style="width: 15%;">Klient</th>
        <th style="width: 10%;">NIP</th>
        <th style="width: 10%;">Miejscowość</th>
        <th style="width: 15%;">Ulica</th>
        <th style="width: 7%;">Kod pocztowy</th>
        <th style="width: 7%;">Cena netto</th>
        <th style="width: 7%;">Cena brutto</th>
        <th style="width: 7%;">Cena vat</th>
        <th>Operacje</th>
    </thead>
    <tbody>
    @foreach($vats as $vat)
        <tr>
            <td>{{$vat->id}}</td>
            <td>{{$vat->created_at->format('d/m/Y')}}</td>
            <td>{{$vat->client}}</td>
            <td>{{$vat->client_nip}}</td>
            <td>{{$vat->client_city}}</td>
            <td>{{$vat->client_street}}</td>
            <td>{{$vat->client_postcode}}</td>
            <td>{{$vat->final_price_netto}} zł</td>
            <td>{{$vat->final_price_brutto}} zł</td>
            <td>{{$vat->final_price_vat}} zł</td>
            <td>
                <a href="/edit_vat/{{$vat->id}}" class="edit" title="Edit" data-toggle="tooltip"><i style="color: #F69C0C;" class="material-icons">&#xE254;</i></a>
                <a href="/delete_vat/{{$vat->id}}" class="delete" title="Delete" data-toggle="tooltip"><i style="color: #D60000;" class="material-icons">&#xE872;</i></a>
                <a href="/create_pdf/{{$vat->id}}" class="download" title="Create_PDF" data-toggle="tooltip"><i style="color: green;" class="material-icons">picture_as_pdf</i></a>
            </td>
        </tr>
    @endforeach
</tbody>
</table>
