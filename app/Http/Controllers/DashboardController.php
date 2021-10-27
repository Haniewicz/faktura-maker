<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Vat;
use App\Models\Product;
use Validator;

class DashboardController extends Controller
{
    public function dashboard()
    {
        return view('template')->with('content', 'dashboard')->withUsers(User::get()->count());
    }

    public function add_vat_view()
    {
        return view('template')->withContent('AddVatView')->withJavascript('AddVat');
    }

    public function add_vat(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'seller' => 'required',
            'seller_city' => 'required',
            'seller_street' => 'required',
            'seller_postcode' => 'required',
            'client' => 'required',
            'client_city' => 'required',
            'client_street' => 'required',
            'client_postcode' => 'required',
            'name.*' => 'required',
            'price_netto.*' => 'required',
            'price_brutto.*' => 'required',
            'vat_rate.*' => 'required',
            'count.*' => 'required',
        ]);

        if ($validator->passes())
        {
            $data = $request->all();
            $Vat = Vat::create([
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
            foreach($data['name'] as $key => $value)
            {
                Product::create([
                    'name' => $value,
                    'price_netto' => $data['price_netto'][$key],
                    'price_brutto' => $data['price_brutto'][$key],
                    'vat_rate' => $data['vat_rate'][$key],
                    'vat_id' => $vat_id,
                    'count' => $data['count'][$key]

                ]);
            }
            return response()->json(['success'=>'Added new records.']);
        }
        return response()->json(['error'=>$validator->errors()->all()]);

    }

    public function list_vats_view()
    {
        $Vats = Vat::all();
        return view('template')->withContent('ListVats')->withVats($Vats)->withJavascript('VatsList');
    }

    public function edit_vat_view(Request $request, $id)
    {
        $products = Vat::find($id)->products;
        $details = Vat::find($id);
        return view('template')->withContent('EditVat')->withProducts($products)->withDetails($details)->withJavascript('EditVat');
    }

    public function edit_vat(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'seller' => 'required',
            'seller_city' => 'required',
            'seller_street' => 'required',
            'seller_postcode' => 'required',
            'client' => 'required',
            'client_city' => 'required',
            'client_street' => 'required',
            'client_postcode' => 'required',
            'name.*' => 'required',
            'price_netto.*' => 'required',
            'price_brutto.*' => 'required',
            'vat_rate.*' => 'required',
            'count.*' => 'required',
            'local_name.*' => 'required',
            'local_price_netto.*' => 'required',
            'local_price_brutto.*' => 'required',
            'local_vat_rate.*' => 'required',
            'local_count.*' => 'required',
        ]);

        if ($validator->passes())
        {
            $data = $request->all();
            Vat::where('id', $data['id'])->update([
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

            foreach($data['product_id'] as $key => $value)
            {
                Product::where('id', $value)->update([
                    'name' => $data['name'][$key],
                    'price_netto' => $data['price_netto'][$key],
                    'price_brutto' => $data['price_brutto'][$key],
                    'vat_rate' => $data['vat_rate'][$key],
                    'vat_id' => $data['id'],
                    'count' => $data['count'][$key]

                ]);
            }
            if(isset($data['local_name']))
            {
                foreach($data['local_name'] as $key => $value)
                {
                    Product::create([
                        'name' => $value,
                        'price_netto' => $data['local_price_netto'][$key],
                        'price_brutto' => $data['local_price_brutto'][$key],
                        'vat_rate' => $data['local_vat_rate'][$key],
                        'vat_id' => $data['id'],
                        'count' => $data['local_count'][$key]

                    ]);
                }
            }
            return response()->json(['success'=>'Zaktualizowano szczegóły faktury.']);
        }
        return response()->json(['error'=>$validator->errors()->all()]);
    }

    public function delete_vat(Request $request, $id)
    {
        $vat = Vat::find($id);
        $vat->products()->delete();
        $vat->delete();
        return back();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
