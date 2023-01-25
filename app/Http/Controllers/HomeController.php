<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\URL;

class HomeController extends Controller
{
    public function index()
    {
        $config = [];
        $url = parse_url(URL::full(), PHP_URL_HOST);
        $dominio = explode(".", str_replace('www.', '', $url));

        switch($dominio[1])
        {
            case 'babosas':
                $config = [
                    'css-reset' => config('site-config.babosas.css-path') . 'reset.css',
                    'css-estilos' => config('site-config.babosas.css-path') . 'estilos.css',
                ];
                return view('welcome', compact('config'));
            break;

            case 'cerdas':
                $config = [
                    'css-reset' => config('site-config.cerdas.css-path') . 'reset.css',
                    'css-estilos' => config('site-config.cerdas.css-path') . 'estilos.css',
                ];
                return view('welcome', compact('config'));
            break;

            case 'conejox':
                $config = [
                    'css-reset' => config("site-config.conejox.css-path") . 'reset.css',
                    'css-estilos' => config("site-config.conejox.css-path") . 'estilos.css',
                ];
                return view('welcome', compact('config'));
            break;

            default: "URL MAL FORMADA";
            break;
        }
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
