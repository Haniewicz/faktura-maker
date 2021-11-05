<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Vat;
use App\Models\Product;

use Validator;
use PDF;

Use \Carbon\Carbon;

use App\Http\Requests\AddVatRequest;
use App\Http\Requests\EditVatRequest;

use App\Http\Controllers\ProductController;

class VatController extends Controller
{
    public function show_add()
    {
        return view('template')->withContent('AddVatView')->withUser(Auth::user())->withJavascript('AddVat');
    }

    public function show_edit(Request $request, $id)
    {
        $products = Vat::find($id)->products;
        $details = Vat::find($id);
        return view('template')->withContent('EditVat')->withProducts($products)->withDetails($details)->withJavascript('EditVat');
    }

    public function show_list()
    {
        $Vats = Vat::Where('creator_id', Auth::user()->id)->get();
        return view('template')->withContent('ListVats')->withVats($Vats)->withJavascript('VatsList');
    }

    public function store(AddVatRequest $request)
    {
        $data = $request->all();
        $Vat = Vat::create([
            'creator_id' => Auth::user()->id,
            'seller' => $data['seller'],
            'seller_nip' => $data['seller_nip'],
            'seller_city' => $data['seller_city'],
            'seller_street' => $data['seller_street'],
            'seller_postcode' => $data['seller_postcode'],
            'client' => $data['client'],
            'client_nip' => $data['client_nip'],
            'client_city' => $data['client_city'],
            'client_street' => $data['client_street'],
            'client_postcode' => $data['client_postcode'],
            'final_price_netto' => $data['final_netto'],
            'final_price_vat' => $data['final_vat'],
            'final_price_brutto' => $data['final_brutto']

        ]);

        $vat_id = $Vat->id;
        ProductController::store($data, $vat_id); //Using store method of ProductController to insert products
        return response()->json(['success'=>'Zapisano fakturę w bazie danych']);
    }

    public function update(EditVatRequest $request)
    {
        $data = $request->all();
        Vat::where('id', $data['id'])->where('creator_id', Auth::user()->id)->update([
            'seller' => $data['seller'],
            'seller_nip' => $data['seller_nip'],
            'seller_city' => $data['seller_city'],
            'seller_street' => $data['seller_street'],
            'seller_postcode' => $data['seller_postcode'],
            'client' => $data['client'],
            'client_nip' => $data['client_nip'],
            'client_city' => $data['client_city'],
            'client_street' => $data['client_street'],
            'client_postcode' => $data['client_postcode'],
            'final_price_netto' => $data['final_netto'],
            'final_price_vat' => $data['final_vat'],
            'final_price_brutto' => $data['final_brutto']
        ]);

        ProductController::update($data); //Updating products data using update method of ProductController

        if(isset($data['local_name']))
        {
            ProductController::append($data); //Appending new product to the form using append method of ProductController
        }
        return response()->json(['success'=>'Zaktualizowano szczegóły faktury.']);
    }

    public function delete(Request $request, $id)
    {
        $vat = Vat::find($id);
        $vat->products()->delete();
        $vat->delete();
        return back();
    }

    public function create_pdf(Request $request, $id)
    {
        $products = Vat::find($id)->products;
        $details = Vat::find($id);

        view()->share('details', $details);
        view()->share('products', $products);
        view()->share('actual_date', Carbon::now()->format('d/m/Y'));
        view()->share('id', 0);

        $pdf = PDF::loadView('contents.pdfview');
        return $pdf->download('faktura '.$details->client.' '. $details->created_at->format('d/m/Y') .'.pdf');
    }

}
