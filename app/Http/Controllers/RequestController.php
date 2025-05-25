<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RequestLetter;
use App\Models\HistoryRequestLetter;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;

class RequestController extends Controller
{
    public function __construct()
    {
        if (Auth::user()->role == 'masyarakat') {
            return redirect('dashboard')->with('error', 'Anda tidak memiliki hak akses')->send();
        }
    }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = RequestLetter::with(['user', 'requestType'])
                ->when($request->status && $request->status != 'semua', function($q) use ($request) {
                    return $q->where('status', $request->status);
                });
            if (Auth::user()->role == 'admin') {
                $query = $query->whereIn('status', ['Diproses', 'Ditolak', 'Selesai']);
            }else{
                // $query = $query->where('status', '!=' ,'Diajukan');
            }

            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('request_type', function($row) {
                    return $row->requestType->name;
                })
                ->addColumn('action', function($row) {
                    $actionBtn = '';
                    
                    if ($row->status == 'Diajukan' || ($row->status == 'Diproses' && Auth::user()->role == 'admin')) {
                        $actionBtn = '<a href="'.route('data-pengajuan.verifikasi-'.Auth::user()->role, $row->id).'" class="btn btn-sm btn-primary">
                            <i class="fas fa-check"></i> Verifikasi
                        </a>';
                    } else {
                        $actionBtn = '<a href="'.route('data-pengajuan.show', $row->id).'" class="btn btn-sm btn-info">
                            <i class="fas fa-eye"></i> Detail
                        </a>';
                    }
                    
                    return $actionBtn;
                })
                ->rawColumns(['action', 'status'])
                ->make(true);
        }

        $data = [
            'title' => 'Data Pengajuan'
        ];

        return view('cms.request.index', $data);
    }

    public function show($id){
        $data = [
          'title' => 'Detail Pengajuan',
          'requestLetter' => RequestLetter::find($id)
        ];

        return view('cms.request.verifikasi-operator', $data);
    }

    public function verifikasiOperator($id){
        if (Auth::user()->role != 'operator') {
            return redirect('dashboard')->with('error', 'Anda tidak memiliki hak akses')->send();
        }
        $requestLetter = RequestLetter::find($id);
        if ($requestLetter->status != 'Diajukan') {
            return redirect('dashboard')->with('error', 'Pengajuan tidak dapat diverifikasi')->send();
        }
        $data = [
          'title' => 'Verifikasi Operator',
          'requestLetter' => $requestLetter
        ];

        return view('cms.request.verifikasi-operator', $data);
    }

    public function verifikasiAdmin($id){
        if (Auth::user()->role != 'admin') {
            return redirect('dashboard')->with('error', 'Anda tidak memiliki hak akses')->send();
        }
        $requestLetter = RequestLetter::find($id);
        if ($requestLetter->status != 'Diproses') {
            return redirect('dashboard')->with('error', 'Pengajuan tidak dapat diverifikasi')->send();
        }
        $data = [
          'title' => 'Verifikasi Admin',
          'requestLetter' => $requestLetter
        ];

        return view('cms.request.verifikasi-admin', $data);
    }

    public function updateVerifikasi(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $status = $request->status;

            $requestLetter = RequestLetter::findOrFail($id);
            
            // Update request letter status
            
            $data = [
                'status' => $status
            ];
            // Create history
            if ($status == 'Ditolak') {
                $notes = 'Pengajuan ditolak oleh '.Auth::user()->name.'.' . ($request->notes ? ' dengan catatan: ' . $request->notes : '');
            } else if ($status == 'Selesai') {
                $typeCode = $requestLetter->requestType->code;
                $documentNumber = "$typeCode/" . date('y') . "/" . date('m') . "/" . date('d');
                $getLast = RequestLetter::where('request_type_id', $requestLetter->request_type_id)->latest()->first();
                $lastNumber = $getLast ? intval(substr($getLast->document_number, -3)) + 1 : 1;
                $documentNumber .= '/' . str_pad($lastNumber, 3, '0', STR_PAD_LEFT);
                $data['document_number'] = $documentNumber;
                $notes = 'Pengajuan selesai diverifikasi '.Auth::user()->name.'.' . ($request->notes ? ' dengan catatan: ' . $request->notes : '');
            } else {
                $notes = 'Pengajuan diteruskan ke admin.' . ($request->notes ? ' dengan catatan: ' . $request->notes : '');
            }
            $requestLetter->update($data);

            HistoryRequestLetter::create([
                'request_letter_id' => $requestLetter->id,
                'status' => $request->status,
                'notes' =>  $notes
            ]);

            if($status == 'Diproses'){
                $admins = User::where('role', 'admin')->get();
    
                foreach ($admins as $admin) {
                    // Send notification to admin
                    Notification::create([
                        'type' => 'Pengajuan',
                        'user_id' => $admin->id,
                        'title' => 'Update Status Pengajuan ' . $requestLetter->requestType->name,
                        'text' => 'Pengajuan dengan nomor ' . $requestLetter->code . ' telah ' . strtolower($request->status). ' oleh operator',
                        'link' => '/data-pengajuan/verifikasi-admin/' . $requestLetter->id
                    ]);
                }
            }else{
                Notification::create([
                    'type' => 'Pengajuan',
                    'user_id' => $requestLetter->user_id,
                    'title' => 'Update Status Pengajuan ' . $requestLetter->requestType->name,
                    'text' => 'Pengajuan Anda dengan nomor ' . $requestLetter->code . ' telah ' . strtolower($request->status),
                    'link' => '/pengajuan-saya/show/' . $requestLetter->id
                ]);
            }
            

            // Send notification to user
            // Notification::create([
            //     'type' => 'Pengajuan',
            //     'user_id' => $requestLetter->user_id,
            //     'title' => 'Update Status Pengajuan ' . $requestLetter->requestType->name,
            //     'text' => 'Pengajuan Anda dengan nomor ' . $requestLetter->code . ' telah ' . strtolower($request->status),
            //     'link' => '/pengajuan-saya/' . $requestLetter->id
            // ]);

            DB::commit();

            return redirect()->back()->with('success', 'Status pengajuan berhasil diperbarui');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
