<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RequestLetter;
use App\Models\HistoryRequestLetter;
use App\Models\Notification;
use Illuminate\Support\Facades\DB;

class RequestController extends Controller
{
    public function verifikasiOperator($id){
        $data = [
          'title' => 'Verifikasi Operator',
          'requestLetter' => RequestLetter::with(['user.resident', 'requestType', 'documentRequestLetters', 'historyRequestLetters'])->find($id)
        ];

        return view('cms.request.verifikasi-operator', $data);
    }

    public function updateVerifikasi(Request $request, $id)
    {
        try {
            DB::beginTransaction();

            $requestLetter = RequestLetter::findOrFail($id);
            
            // Update request letter status
            $requestLetter->update([
                'status' => $request->status
            ]);

            // Create history
            HistoryRequestLetter::create([
                'request_letter_id' => $requestLetter->id,
                'status' => $request->status,
                'notes' => $request->notes
            ]);

            // Send notification to user
            Notification::create([
                'type' => 'Pengajuan',
                'user_id' => $requestLetter->user_id,
                'title' => 'Update Status Pengajuan ' . $requestLetter->requestType->name,
                'text' => 'Pengajuan Anda dengan nomor ' . $requestLetter->code . ' telah ' . strtolower($request->status),
                'link' => '/pengajuan-saya/' . $requestLetter->id
            ]);

            DB::commit();

            return redirect()->back()->with('success', 'Status pengajuan berhasil diperbarui');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
