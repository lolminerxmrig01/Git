<?php

namespace App\Http\Controllers;

use App\Digikala;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use simplehtmldom\HtmlWeb;
use PDF;


class DigikalaController extends Controller
{

    public function index(Request $request)
    {
        return view('index');
    }

    public function ShowProduct(Request $request)
    {
        $productId = $request->input('product');
        $product = new Digikala($productId);
        return view('ShowProduct', compact('product'));
    }


    public function PdfProduct($productId)
    {

        $filePath = 'pdf/' . $productId . '.pdf';
        $exist = file_exists($filePath);
        if ($exist) {
            return response()->json([
                "pdf" => asset($filePath)
            ], 200);
        }


        $product = new Digikala($productId);
        $pdf = PDF::loadView('PdfProduct', compact('product'));
        file_put_contents($filePath, $pdf->output());
        return response()->json([
            "pdf" => asset($filePath)
        ], 200);

    }
}
