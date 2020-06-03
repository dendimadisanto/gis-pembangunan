<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GisController extends Controller
{
    public function get(){
       $url = file_get_contents('http://localhost:8080/geoserver/test/ows?service=WFS&version=1.0.0&request=GetFeature&typeName=test%3Atabel_3&outputFormat=application%2Fjson');
       echo $url;
    }
}
