<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function reload()
    {
        $json = Http::get('https://webcams.cumlouder.com/feed/webcams/online/61/1/');
        $url_base = 'https://webcams.cumlouder.com/joinmb/cumlouder/';
        $personas = json_decode($json->body());

        foreach($personas as $persona)
        {
            $chicas[] = [
                'link' => $url_base . $persona->wbmerPermalink,
                'nombre'    => $persona->wbmerNick,
            ];
        }

        return view('reload', ['chicas' => $chicas])->render();
    }
}
