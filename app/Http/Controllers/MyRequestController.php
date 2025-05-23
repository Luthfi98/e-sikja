<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\RequestType;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Models\RequestLetter;
use Illuminate\Support\Facades\DB;
use App\Models\HistoryRequestLetter;
use App\Models\DocumentRequestLetter;
use Yajra\DataTables\Facades\DataTables;

class MyRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
         if ($request->ajax()) {
            $status = $request->status;
            
            $query = RequestLetter::where('user_id', auth()->id())
                                ->where('status', $status)
                                ->orderBy('created_at', 'desc');

            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('request_type', function($row) {
                    return $row->requestType->name;
                })
                ->addColumn('status', function($row) {
                    return $row->status;
                })
                ->addColumn('code', function($row) {
                    return $row->code;
                })
                ->addColumn('created_at', function($row) {
                    return date('d-m-Y', strtotime($row->created_at));
                })
                ->addColumn('action', function($row) {
                    $actionBtn = '<a href="'.route('pengajuan-saya.show', $row->id).'" class="btn btn-info btn-sm"><span class="fa fa-eye"></span></a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('cms.my-request.index', [
            'title' => 'Permohonan Saya'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'title' => 'Buat Pengajuan Baru',
            'requestTypes' => RequestType::where('status', true)->get()
        ];

        return view('cms.my-request.create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->all();
            $requestType = RequestType::find($request->request_type_id);
            unset($data['documents']);
            unset($data['_token']);

           

            $code = "REQ/$requestType->code/".date('y')."/".date('m')."/".date('d');
            $requestLetterLast = RequestLetter::where('code', 'like', "$code%")->latest()->first();
            $lastNumber = $requestLetterLast ? intval(substr($requestLetterLast->code, -3)) + 1 : 1;
            $code .= '/'.str_pad($lastNumber, 3, '0', STR_PAD_LEFT);
            
            // Create request letter
            $requestLetter = RequestLetter::create([
                'request_type_id' => $requestType->id, 
                'user_id' => auth()->user()->id,
                'code' => $code,
                'data' => json_encode($data)
            ]);

            // Handle document uploads
            if ($request->hasFile('documents')) {
                $documents = $request->file('documents');
                $requiredDocuments = json_decode($requestType->required_documents);
                
                foreach ($documents as $index => $document) {
                    if ($document->isValid()) {
                        $path = $document->store('documents/request-letters', 'public');
                        
                        DocumentRequestLetter::create([
                            'request_letter_id' => $requestLetter->id,
                            'name' => $requiredDocuments[$index] ?? 'Document ' . ($index + 1),
                            'url' => $path,
                            'type' => $document->getClientOriginalExtension(),
                            'description' => "Dokumen $requiredDocuments[$index] untuk permohonan $requestType->name"
                        ]);
                    }
                }
            }

            HistoryRequestLetter::create([
                'request_letter_id' => $requestLetter->id,
                'status' => 'Diajukan',
            ]);

            // Send notification
            $operator = User::where('role', 'operator')->get();
            foreach ($operator as $user) {
                Notification::create([ 
                    'type' => 'Pengajuan',
                    'user_id' => $user->id,
                    'title' => 'Pengajuan Baru '.$requestLetter->requestType->name,
                    'text' => 'Pengajuan baru telah dibuat oleh ' . auth()->user()->name. ' dengan nomor pengajuan ' . $requestLetter->code,
                    'link' => '/data-pengajuan/verifikasi-operator/' . $requestLetter->id
                ]);
            }

            DB::commit();

            return redirect()->route('pengajuan-saya.index')
                ->with('success', 'Pengajuan berhasil dibuat');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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

    public function form(Request $request, $code)
    {
        $request->session()->flashInput($request->all());
        $requestType = RequestType::where('code', $code)->firstOrFail();
        $resident = auth()->user()->resident;
        return view('cms.my-request.form.'.strtolower($code), [
            'title' => 'Buat Pengajuan Baru',
            'requestType' => $requestType,
            'resident' => $resident,
            'old' => $request->all()
        ]);
    }
}
