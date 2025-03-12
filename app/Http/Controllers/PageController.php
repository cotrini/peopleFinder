<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PageController extends Controller
{
    protected $url = 'https://aplicaciones.adres.gov.co/bdua_internet/Pages/ConsultarAfiliadoWeb.aspx';

    public function fetchExternalPage()
    {
        $url = $this->url;
        $response = Http::withOptions(['verify' => false])->get($url);
        $htmlContent = $response->body();
        $dom = new \DOMDocument();
        @$dom->loadHTML($htmlContent);
        $xpath = new \DOMXPath($dom);
        $element = $xpath->query('//form[@name="afiliado"]')->item(0);
        $element->setAttribute('action', 'https://aplicaciones.adres.gov.co/bdua_internet/Pages/ConsultarAfiliadoWeb.aspx');
        $capcha = $xpath->query('.//img[@id="Capcha_CaptchaImageUP"]', $element)->item(0);
        $newcapchaSrc = 'https://aplicaciones.adres.gov.co/bdua_internet'.substr($capcha->getAttribute('src'), 2);
        $capcha->setAttribute('src', $newcapchaSrc);
        $content = $element ? $dom->saveHTML($element) : 'Content not found';
        return view('finder', compact('content'));
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $url = $this->url;
        //tipoDoc, txtNumDoc, Capcha_CaptchaTextBox
        $response = Http::withOptions(['verify' => false])->post($url, [
            'tipoDoc' => 'CC',
            'txtNumDoc' => '1053790466',
            'Capcha_CaptchaTextBox' => '123456'
        ]);
        $content = $response->body();
       
        return view('show', compact('content'));
       
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
