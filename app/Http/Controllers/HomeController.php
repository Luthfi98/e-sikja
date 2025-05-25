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

    public function storeComplaint(Request $request)
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu untuk mengirim pengaduan.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string'
        ]);

        // Here you would typically save the complaint to the database
        // For now, we'll just redirect back with a success message
        return redirect()->back()->with('success', 'Pengaduan berhasil dikirim. Tim kami akan segera menghubungi Anda.');
    }
}
