<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Information;

class HomeController extends Controller
{
    function index()
    {
        $data = [
            'title' => 'Beranda',
            'informations' => Information::where('status', true)->with('user')->get()
        ];
        return view('landing.home')->with($data);
    }

    public function information(Request $request)
    {
        $query = Information::where('status', true);

        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $informations = $query->latest()->paginate(6);

        return view('landing.information', compact('informations'));
    }

    public function showInformation($slug)
    {

        $information = Information::where('slug', $slug)
            ->where('status', true)
            ->firstOrFail();

        $data = [
            'title' => $information->title,
            'information' => $information
        ];

        return view('landing.information-detail')->with($data);
    }

    public function submission()
    {
        return view('landing.submission');
    }

    public function complaint()
    {
        return view('landing.complaint');
    }

    public function profile()
    {
        $settingsPath = public_path('setting/settings.json');
        $setting = json_decode(file_get_contents($settingsPath), true)??[];
        $profile = $setting['profile']??[];
        $data = [
            'title' => 'Profil ',
            'profile' => $profile
        ];
        return view('landing.profile')->with($data);
    }
}
