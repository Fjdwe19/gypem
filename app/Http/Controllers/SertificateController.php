<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use setasign\Fpdi\Fpdi;


class SertificateController extends Controller
{

    public function index(){
        // return view('sertificate.index');
        return view('sertificate.index');
    }
    public function process(Request $request){
        $nama = $request->post('nama');
        // $nama = "Fajar Dwi VVVVV";
        $outputfile = public_path().'dcc.pdf';
        $this->fillPDF(public_path().'/master/dcc.pdf',$outputfile,$nama);

        return response()->file($outputfile);
    }

    public function fillPDF($file,$outputfile,$nama){
        $fpdi = new FPDI;
        $fpdi->setSourceFile($file);
        $template = $fpdi->importPage(1);
        $size = $fpdi->getTemplateSize($template);
        $fpdi->AddPage($size['orientation'],array($size['width'],$size['height']));
        $fpdi->useTemplate($template);
        $top = 105;
        $right = 118;
        $name = $nama;
        $fpdi->SetFont("helvetica","",20);
        $fpdi->setTextColor(25,26,25);
        $fpdi->Text($right, $top, $name);

        return $fpdi->Output($outputfile,'F');
    }
}
