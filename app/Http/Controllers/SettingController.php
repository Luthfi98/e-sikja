<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SettingController extends Controller
{
    protected $settingsPath;

    public function __construct()
    {
        $this->settingsPath = public_path('setting/settings.json');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'title' => 'Pengaturan',
            'settings' => $this->getSettings()
        ];
        return view('cms.setting.index')->with($data);
    }

    public function profile()
    {
        $settings = $this->getSettings();
        return view('cms.setting.profile', compact('settings'));
    }

    public function saveProfile(Request $request)
    {
        $validated = $request->validate([
            'nama_instansi' => 'required|string|max:255',
            'alamat_instansi' => 'required|string',
            'visi_misi' => 'required|string',
            'tentang_kelurahan' => 'required|string',
            'struktur_organisasi' => 'required|string',
        ]);

        $settings = $this->getSettings();
        // dd($settings, $validated);
        $settings['profile'] = $validated;

        $this->saveSettings($settings);

        return redirect()->back()->with('success', 'Profil instansi berhasil diperbarui');
    }

    protected function getSettings()
    {
        if (!File::exists($this->settingsPath)) {
            return [];
        }

        $content = File::get($this->settingsPath);
        return json_decode($content, true) ?? [];
    }

    protected function saveSettings($settings)
    {
        $directory = dirname($this->settingsPath);
        
        if (!File::exists($directory)) {
            File::makeDirectory($directory, 0755, true);
        }

        File::put($this->settingsPath, json_encode($settings, JSON_PRETTY_PRINT));
    }
}

