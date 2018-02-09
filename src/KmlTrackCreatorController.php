<?php

namespace Aghayev\KmlTrackCreator;

use App\Http\Controllers\Controller;

class KmlTrackCreatorController extends Controller
{

    public function index($timezone)
    {
        // echo 'Welcome to Kml Track Creator';
        return view('kmltracks::index');
    }
}