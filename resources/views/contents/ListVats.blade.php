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
                <a href="/delete_vat/{{$vat->id}}" style="float: left;" class="btn btn-danger">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-excel-fill" viewBox="0 0 16 16">
                        <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zM5.884 6.68 8 9.219l2.116-2.54a.5.5 0 1 1 .768.641L8.651 10l2.233 2.68a.5.5 0 0 1-.768.64L8 10.781l-2.116 2.54a.5.5 0 0 1-.768-.641L7.349 10 5.116 7.32a.5.5 0 1 1 .768-.64z"/>
                    </svg>
                </a>
                <a href="/edit_vat/{{$vat->id}}" style="float: left;" class="btn btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                    </svg>
                </a>
            </td>
        </tr>
    @endforeach
</tbody>
</table>
