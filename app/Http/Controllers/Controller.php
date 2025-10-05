<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\tb_auditee;
use App\Models\tb_auditor;
use App\Models\data_cabang;
use App\Models\formSurat;
use App\Models\tb_foto_penyelesaian;
use App\Models\tb_foto_temuan;
use PDF;
use App\Models\tb_roomAudit;
use Illuminate\Http\Request;
use App\Models\Tb_hasilpengamatan;
use App\Models\tb_penyelesaian;
use App\Models\tb_temuan;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function tambahAuditor(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'nik' => 'required|unique:tb_auditor,nik',
            'dept' => 'required',
            'jabatan' => 'required',
            'id_cabang' => 'nullable',
            'fotoTtd' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // opsional
        ]);

        // Upload file kalau ada
        if ($request->hasFile('fotoTtd')) {
            $file = $request->file('fotoTtd');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/ttd'), $filename);
            $validatedData['fotoTtd'] = $filename;
        }

        tb_auditor::create($validatedData);

        session()->flash('success', 'Data Berhasil Ditambahkan.');
        return redirect()->back();
    }

    public function updateFotoAuditor(Request $request, $id)
    {
        $request->validate([
            'fotoTtd' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $auditor = tb_auditor::findOrFail($id);

        if ($request->hasFile('fotoTtd')) {
            // Hapus foto lama kalau ada
            if ($auditor->fotoTtd && file_exists(public_path('uploads/ttd/' . $auditor->fotoTtd))) {
                unlink(public_path('uploads/ttd/' . $auditor->fotoTtd));
            }

            $file = $request->file('fotoTtd');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/ttd'), $filename);

            $auditor->fotoTtd = $filename;
            $auditor->save();
        }

        return redirect()->back()->with('success', 'Foto TTD berhasil diperbarui!');
    }

    public function updateFotoAuditee(Request $request, $id)
    {
        $request->validate([
            'fotoTtd' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $auditee = tb_auditee::findOrFail($id);

        if ($request->hasFile('fotoTtd')) {
            // Hapus foto lama kalau ada
            if ($auditee->fotoTtd && file_exists(public_path('uploads/ttd/' . $auditee->fotoTtd))) {
                unlink(public_path('uploads/ttd/' . $auditee->fotoTtd));
            }

            $file = $request->file('fotoTtd');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/ttd'), $filename);

            $auditee->fotoTtd = $filename;
            $auditee->save();
        }

        return redirect()->back()->with('success', 'Foto TTD berhasil diperbarui!');
    }



    public function dataAuditor() {
        $dataAuditor = tb_auditor::all();
        return view('dataAuditor', compact('dataAuditor'));
    }

    public function dataAuditee() {
    $user = auth()->user();

    if ($user->level === 'Master') {
        // Jika Master, tampilkan semua data
        $dataAuditee = tb_auditee::all();
    } else {
        // Jika bukan Master, tampilkan hanya data sesuai NIK user login
        $dataAuditee = tb_auditee::where('nik', $user->nik)->get();
    }

    return view('dataAuditee', compact('dataAuditee'));
}

    public function dataSuratKeluar() {
        $suratKeluar = formSurat::all();
        return view('suratKeluar', compact('suratKeluar'));
    }

    public function dataCabang() {
        $dataCabang = data_cabang::all();
        return view('dataCabang', compact('dataCabang'));
    }

    public function tambahCabang(Request $request) {
        $validatedData = $request->validate([
            'cabang' => 'required',
            'divisi' => 'required',
            'kode_cabang' => 'required'
        ]);

        data_cabang::create($validatedData);
        session()->flash('success', 'Data Berhasil Ditambahkan.');
        return redirect()->back();
    }

    public function tambahSurat(Request $request) {
        $validatedData = $request->validate([
            'kodeForm' => 'required',
            'noTerbitan' => 'required',
            'tglEfektif' => 'required'
        ]);

        formSurat::create($validatedData);
        session()->flash('success', 'Data Berhasil Ditambahkan.');
        return redirect()->back();
    }

    public function deleteSurat($id)
    {
        $surat = formSurat::findOrFail($id);
        $surat->delete();

        return redirect()->back()->with('success', 'Surat Keluar berhasil dihapus.');
    }



    public function updateCabang(Request $request, $id)
    {
        $validatedData = $request->validate([
        'cabang' => 'required',
        'divisi' => 'required',
        'kode_cabang' => 'required'
        ]);

        $cabang = data_cabang::findOrFail($id);
        $cabang->update($validatedData);

        return redirect()->back()->with('success', 'Data Cabang berhasil diupdate.');
    }

    public function Cabangdestroy($id)
    {
        $cabang = data_cabang::findOrFail($id);
        $cabang->delete();

        return redirect()->back()->with('success', 'Data Cabang berhasil dihapus.');
    }


    public function tambahAuditee(Request $request) {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'nik' => 'required|unique:tb_auditee,nik',
            'dept' => 'required',
            'jabatan' => 'required',
            'id_cabang' => 'nullable'
        ]);

        tb_auditee::create($validatedData);
        session()->flash('success', 'Data Berhasil Ditambahkan.');
        return redirect()->back();
    }

    public function updateAuditee(Request $request, $id)
    {
        $validatedData = $request->validate([
        'name' => 'required|max:255',
        'nik' => 'required|unique:tb_auditee,nik,' . $id, // biar nik bisa sama dengan dirinya sendiri
        'dept' => 'required',
        'jabatan' => 'required',
        ]);

        $auditee = tb_auditee::findOrFail($id);
        $auditee->update($validatedData);

        return redirect()->back()->with('success', 'Data Auditee berhasil diupdate.');
    }

    public function Auditeedestroy($id)
    {
        $auditee = tb_auditee::findOrFail($id);
        $auditee->delete();

        return redirect()->back()->with('success', 'Data Auditee berhasil dihapus.');
    }



    public function updateAuditor(Request $request, $id)
    {
        $validatedData = $request->validate([
        'name' => 'required|max:255',
        'nik' => 'required|unique:tb_auditor,nik,' . $id, // biar nik bisa sama dengan dirinya sendiri
        'dept' => 'required',
        'jabatan' => 'required',
        ]);

        $auditor = tb_auditor::findOrFail($id);
        $auditor->update($validatedData);

        return redirect()->back()->with('success', 'Data Auditor berhasil diupdate.');
    }

    public function Auditordestroy($id)
    {
        $auditor = tb_auditor::findOrFail($id);
        $auditor->delete();

        return redirect()->back()->with('success', 'Data Auditor berhasil dihapus.');
    }

    public function dataUser() {
        $dataUser = User::all();
        $dataCabang = data_cabang::all();

        return view('dataUser', compact('dataUser', 'dataCabang'));
    }

    public function getKodeCabang($cabang)
    {
        $data = data_cabang::where('cabang', $cabang)->first();
        return response()->json($data);
    }

    // Simpan user baru
    public function tambahUser(Request $request)
    {
        $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:user,email',
        'password' => 'required|string|min:6',
        'level' => 'required|string',
        'nik' => 'required|string|unique:user,nik',
        'cabang' => 'required|string',
        'kode_cabang' => 'required|string',
        ]);

        User::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'password' => Hash::make($validated['password']), // hash password
        'level' => $validated['level'],
        'nik' => $validated['nik'],
        'sistemManagement' => $request->sistemManagement,
        'dept' => $request->dept,
        'cabang' => $validated['cabang'],
        'kode_cabang' => $validated['kode_cabang'],
        ]);

        return redirect()->back()->with('success', 'User berhasil ditambahkan!');
    }

    public function Userdestroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->back()->with('success', 'Data User berhasil dihapus.');
    }

    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:user,email,' . $id,
        'password' => 'nullable|string|min:6',
        'level' => 'required|string',
        'nik' => 'required|string|unique:user,nik,' . $id,
        'cabang' => 'required|string',
        'kode_cabang' => 'required|string',
        ]);

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->level = $validated['level'];
        $user->nik = $validated['nik'];
        $user->cabang = $validated['cabang'];
        $user->kode_cabang = $validated['kode_cabang'];

        if (!empty($validated['password'])) {
        $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return redirect()->back()->with('success', 'User berhasil diperbarui!');
    }

    public function dataRoom() {
        $dataRoom = tb_roomAudit::all();

        return view('dataRoom', compact('dataRoom'));

    }

    // public function createRoom(Request $request)
    // {
    //     $request->validate([
    //     'namaAudit' => 'required|string',
    //     'tglMulai' => 'required|date',
    //     'tglSelesai' => 'required|date',
    //     // 'nik' => 'required|string|unique:tb_roomaudit,nik',
    //     'sandiRoom' => 'required|string|min:6',
    //     'id_cabang' => 'required|string',
    //     ]);

    //     // Buat kodeRoom otomatis
    //     $words = explode(' ', $request->namaAudit);
    //     $prefix = '';
    //     foreach ($words as $word) {
    //     $prefix .= strtoupper(substr($word, 0, 1));
    //     }

    //     $lastRoom = tb_roomAudit::where('kodeRoom', 'like', $prefix . '%')
    //     ->orderBy('kodeRoom', 'desc')
    //     ->first();

    //     if ($lastRoom) {
    //     $lastNumber = (int) substr($lastRoom->kodeRoom, strlen($prefix));
    //     $newNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
    //     } else {
    //     $newNumber = '0001';
    //     }

    //     $kodeRoom = $prefix . $newNumber;

    //     tb_roomAudit::create([
    //     'namaAudit' => $request->namaAudit,
    //     'tglMulai' => $request->tglMulai,
    //     'tglSelesai' => $request->tglSelesai,
    //     'kodeRoom' => $kodeRoom,
    //     // 'nik' => $request->nik,
    //     'sandiRoom' => Hash::make($request->sandiRoom),
    //     'id_cabang' => $request->id_cabang,
    //     ]);

    //     return redirect()->back()->with('success', 'Room audit berhasil dibuat!');
    // }

    public function createRoom(Request $request)
    {
        $request->validate([
        'namaAudit' => 'required|string',
        'tglMulai' => 'required|date',
        'tglSelesai' => 'required|date|after_or_equal:tglMulai',
        'sandiRoom' => 'required|string|min:6',
        // 'niks' => 'required|array',
        // 'niks.*' => 'required|string',
        ]);

        // Buat kodeRoom otomatis
        $words = explode(' ', $request->namaAudit);
        $prefix = '';
        foreach ($words as $word) {
        $prefix .= strtoupper(substr($word, 0, 1));
        }

        $lastRoom = tb_roomAudit::where('kodeRoom', 'like', $prefix . '%')
        ->orderBy('kodeRoom', 'desc')
        ->first();

        if ($lastRoom) {
            $lastNumber = (int) substr($lastRoom->kodeRoom, strlen($prefix));
            $newNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
        } else {
            $newNumber = '0001';
        }

        $kodeRoom = $prefix . $newNumber;

        // simpan room
        $room = tb_roomAudit::create([
            'namaAudit' => $request->namaAudit,
            'tglMulai' => $request->tglMulai,
            'tglSelesai' => $request->tglSelesai,
            'kodeRoom' => $kodeRoom,
            'sandiRoom' => Hash::make($request->sandiRoom),
            'id_cabang' => Auth::user()->kode_cabang, // <-- ambil dari user login
        ]);

        // simpan nik berulang
    //     foreach ($request->niks as $nik) {
    //     $room->niks()->create([
    //     'nik' => $nik
    //     ]);
    // }

        return redirect()->back()->with('success', 'Room audit berhasil dibuat!');
    }


    // public function updateRoom(Request $request, $id)
    // {
    //     $request->validate([
    //     'namaAudit' => 'required|string|max:255',
    //     'tglMulai' => 'required|date',
    //     // 'nik' => 'nullalbe|string|unique:tb_roomaudit,nik,' . $id,
    //     'tglSelesai'=> 'required|date|after_or_equal:tglMulai',
    //     'id_cabang' => 'nullable|string|max:50',
    //     'sandiRoom' => 'nullable|string|min:4', // optional saat edit
    //     ]);

    //     $dataRoom = tb_roomAudit::findOrFail($id);

    //     // Update field selain kodeRoom
    //     $dataRoom->namaAudit = $request->namaAudit;
    //     $dataRoom->tglMulai = $request->tglMulai;
    //     $dataRoom->tglSelesai= $request->tglSelesai;
    //     $dataRoom->id_cabang = $request->id_cabang;
    //     // $dataRoom->nik = $request->nik;

    //     // Update sandiRoom hanya jika diisi
    //     if (!empty($request->sandiRoom)) {
    //         $dataRoom->sandiRoom = bcrypt($request->sandiRoom);
    //     }

    //     $dataRoom->save();

    //     return redirect()->back()->with('success', 'Room berhasil diperbarui.');
    // }

    public function updateRoom(Request $request, $id)
    {
        $request->validate([
        'namaAudit' => 'required|string',
        'tglMulai' => 'required|date',
        'tglSelesai' => 'required|date',
        'sandiRoom' => 'nullable|string|min:6',
        // 'id_cabang' => 'required|string', // kalau tidak diedit, tidak perlu divalidasi
        ]);

        // Cari data berdasarkan id
        $room = tb_roomAudit::findOrFail($id);

        // Update field
        $room->namaAudit = $request->namaAudit;
        $room->tglMulai = $request->tglMulai;
        $room->tglSelesai = $request->tglSelesai;

        // Jika user isi sandi baru → hash ulang
        if ($request->filled('sandiRoom')) {
        $room->sandiRoom = Hash::make($request->sandiRoom);
        }

        // id_cabang dan kodeRoom tidak diupdate (readonly/disabled)
        $room->save();

        return redirect()->back()->with('success', 'Room audit berhasil diperbarui!');
    }

    public function Roomdestroy($id)
    {
        $dataRoom = tb_roomAudit::findOrFail($id);
        $dataRoom->delete();

        return redirect()->back()->with('success', 'Room berhasil dihapus.');
    }

    public function listRoom()
    {
        $today = Carbon::today();
        $userNik = Auth::user()->nik;

        // Cek apakah user ada di tb_auditor
        $auditor = DB::table('tb_auditor')->where('nik', $userNik)->first();

        if (!$auditor) {
            // Kalau user belum terdaftar sebagai auditor
            $listRoom = collect(); // kosong
        } else {
            // Ambil semua room aktif hari ini
            $listRoom = DB::table('tb_roomAudit')
                ->whereDate('tglMulai', '<=', $today)
                ->whereDate('tglSelesai', '>=', $today)
                ->get();
        }

        return view('roomAudit', compact('listRoom'));
    }

    public function detailRoom($id)
    {
        $room = tb_roomAudit::with('niks')->findOrFail($id);
        $userNik = auth()->user()->nik;

        // Cek apakah nik user login ada di daftar room
        $allowed = $room->niks->contains('nik', $userNik);

        // if (! $allowed) {
        // abort(403, 'Anda tidak berhak mengakses room ini.');
        // }

        return view('cekRoom', compact('room'));
    }


    public function checkSandiRoom(Request $request, $id)
    {
        $request->validate(['sandiRoom' => 'required|string']);

        $room = tb_roomAudit::findOrFail($id);

        // cek hash
        if (Hash::check($request->sandiRoom, $room->sandiRoom)) {

            // redirect sambil bawa room_id
            return redirect()->route('formHasil', ['room_id' => $room->id]);
        }

        return back()->withErrors(['sandiRoom' => 'Sandi room tidak sesuai!']);
    }


    public function login(Request $request)
    {
        $credentials = $request->only('nik', 'password');

        if (Auth::attempt($credentials)) {
        $request->session()->regenerate();

        $user = Auth::user();

        // Arahkan sesuai level
        switch ($user->level) {
            case 'Master':
                return redirect()->route('dataUser');
            case 'leadAuditor':
                return redirect()->route('hasilAudit');
            case 'Auditor':
                return redirect('/MD-Auditor');
            case 'Auditee':
                return redirect('/MD-Auditor');
            default:
                return redirect('/'); // fallback kalau level tidak dikenali
        }
        }

        return back()->withErrors([
            'login' => 'NIK atau password salah.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

    public function findAuditee($nik)
    {
        $auditee = tb_auditee::where('nik', $nik)->first();

        if ($auditee) {
            return response()->json([
                'success' => true,
                'name' => $auditee->name,
                'dept' => $auditee->dept,
                'jabatan' => $auditee->jabatan,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Auditee dengan NIK tersebut tidak ditemukan.'
            ]);
        }
    }

    public function storePengamatan(Request $request, $room_id)
    {
        $request->validate([
            'kategori'    => 'required|string',
            'catatan'     => 'required|string',
            'nikAuditee'  => 'required|numeric',
            'namaAuditee' => 'required|string',
        ]);

        $room = tb_roomAudit::findOrFail($room_id);

        tb_hasilpengamatan::create([
            'namaAudit'    => $room->id,
            'tanggal'      => Carbon::now()->toDateString(),
            'kategori'     => $request->kategori,
            'lokasi'       => $request->lokasi,
            'catatan'      => $request->catatan,
            'id_cabang'    => Auth::user()->kode_cabang,
            'namaAuditor'  => Auth::user()->nik,
            'namaAuditee'  => $request->nikAuditee,
            'status_final' => 'pending',
        ]);

        return redirect()->route('dataPengamatan', ['room_id' => $room->id])
        ->with('success', 'Data berhasil disimpan untuk audit: ' . $room->namaAudit);

    }

    public function auditeePengamatan() {
        $user = auth()->user();

        $auditeePengamatan = Tb_hasilpengamatan::with('roomAudit')
        ->where('namaAuditee', $user->nik)
        ->whereIn('status_final', ['proses', 'approved'])
        ->where('lokasi', $user->dept)
        ->get();

        return view('auditeHasilPengamatan', compact('auditeePengamatan'));

    }

    public function showHasilAudit()
    {
        $user = auth()->user();

        $data = Tb_temuan::with([
            'hasilPengamatan.roomAudit',
            'hasilPengamatan.auditor',
            'hasilPengamatan.auditee',
            'penyelesaian.fotoPenyelesaian',
            'fotos'
        ])
        ->when($user->level !== 'Master', function ($query) use ($user) {
            // Jika bukan Master, filter leadAuditor berdasarkan sistemManagement
            $query->whereHas('hasilPengamatan.roomAudit', function ($q) use ($user) {
                $q->where('namaAudit', $user->sistemManagement);
            });
        })
        ->get();

        return view('hasilAudit', compact('data'));
    }


    public function lihatHasilAudit($id)
    {
        $data = Tb_temuan::with([
            'hasilPengamatan.roomAudit',
            'hasilPengamatan.auditor',
            'hasilPengamatan.auditee',
            'penyelesaian.fotoPenyelesaian',
            'fotos' // ganti 'fotos' ke nama relasi yang benar
        ])->findOrFail($id);

        return view('detailHasilAudit', compact('data'));
    }

    public function approveTemuan($id)
    {
        // Cari data temuan berdasarkan ID
        $temuan = tb_temuan::findOrFail($id);

        // Update status menjadi 'selesai'
        $temuan->status = 'selesai';
        $temuan->save();

        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Status temuan berhasil diubah menjadi Selesai!');
    }

    public function editRevisi($id)
    {
        // Ambil data temuan dan relasi penyelesaian
        $temuan = Tb_temuan::with('penyelesaian')->findOrFail($id);

        return view('editRevisiTemuan', compact('temuan'));
    }

    public function updateRevisi(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'deskripsi' => 'required|string',
            'krisis' => 'required|string',
            'lokasi' => 'required|string',
            'prosedure' => 'required|string',
            'elemen' => 'required|string',
            'identifikasi' => 'required|string',
            'tindakanlangsung' => 'required|string',
            'perbaikan' => 'required|string',
        ]);

        // Ambil data temuan
        $temuan = Tb_temuan::findOrFail($id);
        $penyelesaian = $temuan->penyelesaian;

        // Update hanya field yang diperbolehkan
        $temuan->update([
            'deskripsi' => $request->deskripsi,
            'krisis' => $request->krisis,
            'lokasi' => $request->lokasi,
            'prosedure' => $request->prosedure,
            'elemen' => $request->elemen,
            'status' => 'revisi', // ubah status agar menandakan sedang revisi
        ]);

        // Update tabel penyelesaian
        if ($penyelesaian) {
            $penyelesaian->update([
                'identifikasi' => $request->identifikasi,
                'tindakanlangsung' => $request->tindakanlangsung,
                'perbaikan' => $request->perbaikan,
            ]);
        }

        return redirect()->route('hasilAudit')->with('success', 'Data revisi berhasil diperbarui!');
    }





    public function exportAuditeePengamatanPDF($id)
    {
        $user = auth()->user();

        $suratKeluar = formSurat::all();

        $auditeePengamatan = Tb_hasilpengamatan::with(['roomAudit', 'auditor', 'auditee'])
            ->where('id', $id)
            ->where('namaAuditee', $user->nik)
            ->where('lokasi', $user->dept)
            ->get();

        if ($auditeePengamatan->isEmpty()) {
            return redirect()->back()->with('error', 'Data tidak ditemukan atau Anda tidak punya akses.');
        }

        $pdf = FacadePdf::loadView('auditeePengamatan', compact('auditeePengamatan','suratKeluar'))
            ->setPaper('A4', 'portrait');

        return $pdf->download('Hasil_Pengamatan_'.$id.'.pdf');
    }

    public function previewAuditeePengamatan($id)
    {
        $user = auth()->user();
        $suratKeluar = formSurat::all();

        $auditeePengamatan = Tb_hasilpengamatan::with(['roomAudit', 'auditor', 'auditee'])
            ->where('id', $id)
            ->where('namaAuditee', $user->nik)
            ->where('lokasi', $user->dept)
            ->get();

        if ($auditeePengamatan->isEmpty()) {
            return redirect()->back()->with('error', 'Data tidak ditemukan atau Anda tidak punya akses.');
        }

        return view('previewauditeePengamatan', compact('auditeePengamatan', 'suratKeluar'));
    }



    public function approve($id, Request $request)
    {
        $pengamatan = Tb_hasilpengamatan::findOrFail($id);
        $pengamatan->status_final = $request->status_final;
        $pengamatan->save();

        return redirect()->back()->with('success', 'Data berhasil di-Update!');
    }

    public function dataPengamatan($room_id)
    {
        $room = tb_roomAudit::findOrFail($room_id);

        $nikUser = Auth::user()->nik;

        // Data hasil pengamatan
        $dataPengamatan = DB::table('tb_hasilpengamatan')
            ->join('tb_roomAudit', 'tb_hasilpengamatan.namaAudit', '=', 'tb_roomAudit.id')
            ->where('tb_hasilpengamatan.namaAudit', $room->id)
            ->where('tb_hasilpengamatan.namaAuditor', $nikUser)
            ->select(
                'tb_hasilpengamatan.*',
                'tb_roomAudit.namaAudit as namaAudit_asli'
            )
            ->get();

        // Data temuan + foto (relasi lewat id_hasilpengamatan)
        $temuan = DB::table('tb_temuan')
            ->leftJoin('tb_hasilpengamatan', 'tb_temuan.id_hasilpengamatan', '=', 'tb_hasilpengamatan.id')
            ->leftJoin('tb_foto_temuan', 'tb_temuan.id', '=', 'tb_foto_temuan.temuan_id')
            ->whereIn('tb_temuan.id_hasilpengamatan', $dataPengamatan->pluck('id')) // hanya ambil temuan dari hasil pengamatan yg ditampilkan
            ->select(
                'tb_temuan.*',
                'tb_temuan.deskripsi as deskripsi_pengamatan',
                'tb_foto_temuan.foto as foto_temuan',
                'tb_hasilpengamatan.namaAuditee as namaAuditee'
            )
            ->get()
            ->groupBy('id'); // biar foto yang sama temuan dikelompokkan

        return view('dataHasilPengamatan', compact('dataPengamatan', 'temuan', 'room'));
    }

    public function listPenyelesaian()
    {
        $nikUser = Auth::user()->nik;

        // Ambil data temuan yang berelasi dengan hasil pengamatan
        // dan hanya tampilkan data milik user login (berdasarkan NIK)
        $temuan = tb_temuan::with(['fotos', 'hasilPengamatan'])
            ->whereHas('hasilPengamatan', function ($query) use ($nikUser) {
                $query->where('namaAuditee', $nikUser);
            })
            ->leftJoin('tb_hasilpengamatan', 'tb_temuan.id_hasilpengamatan', '=', 'tb_hasilpengamatan.id')
            ->select(
                'tb_temuan.*',
                'tb_temuan.deskripsi as deskripsi_pengamatan',
                'tb_hasilpengamatan.namaAuditee as namaAuditee'
            )
            ->where('status', "draft")
            ->get();

        return view('penyelesaianAuditee', compact('temuan'));
    }

    public function formPenyelesaian($id)
    {
        $nikUser = auth()->user()->nik;

        $temuan = tb_temuan::with([
                'fotos',
                'hasilPengamatan',
                'hasilPengamatan.auditor'
            ])
            ->where('id', $id)
            ->whereHas('hasilPengamatan', function ($query) use ($nikUser) {
                $query->where('namaAuditee', $nikUser);
            })
            ->firstOrFail();

        return view('formPenyelesaian', compact('temuan'));
    }

    public function storePenyelesaian(Request $request)
    {
        $request->validate([
            'temuan_id' => 'required|exists:tb_temuan,id',
            'identifikasi' => 'required|string',
            'tindakanlangsung' => 'required|string',
            'perbaikan' => 'required|string',
            'targetPerbaikan' => 'required',
            'foto' => 'nullable|array',
            'foto.*' => 'nullable|string',
        ]);

        $user = auth()->user();

        // Simpan data utama penyelesaian
        $penyelesaian = tb_penyelesaian::create([
            'temuan_id' => $request->temuan_id,
            'identifikasi' => $request->identifikasi,
            'tindakanlangsung' => $request->tindakanlangsung,
            'perbaikan' => $request->perbaikan,
            'targetPerbaikan' => $request->targetPerbaikan,
            'tanggal' => now()->format('Y-m-d'),
            'id_cabang' => $user->cabang,
        ]);

        // Simpan foto (base64)
        if ($request->has('foto')) {
            foreach ($request->foto as $index => $fotoBase64) {
                if ($fotoBase64) {
                    $fotoData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $fotoBase64));
                    $namaFile = 'penyelesaian_' . time() . "_{$index}.jpg";
                    $path = public_path('uploads/foto/' . $namaFile);
                    file_put_contents($path, $fotoData);

                    tb_foto_penyelesaian::create([
                        'penyelesaian_id' => $penyelesaian->id,
                        'foto' => $namaFile
                    ]);
                }
            }
        }

        // 🔹 Update status temuan menjadi 'proses'
        tb_temuan::where('id', $request->temuan_id)->update(['status' => 'proses']);

        return redirect()->back()->with('success', 'Penyelesaian berhasil dikirim dan status temuan diubah menjadi PROSES.');
    }









    public function form($room_id)
    {
        $room = tb_roomAudit::with('niks')->findOrFail($room_id);

        // (opsional) cek akses: pastikan user punya NIK terdaftar
        // $userNik = auth()->user()->nik;
        // if (! $room->niks->contains('nik', $userNik)) abort(403);

        return view('formHasil', compact('room'));
    }

    public function updateCatatan(Request $request, $id, $room_id)
    {
        $request->validate([
            'catatan' => 'required|string',
        ]);

        $pengamatan = Tb_hasilpengamatan::findOrFail($id);

        $pengamatan->update([
            'catatan' => $request->catatan,
        ]);

        return redirect()->route('dataPengamatan', ['room_id' => $room_id])
            ->with('success', 'Catatan berhasil diperbarui.');
    }


    public function pengamatanDestroy($id, $room_id)
    {
        $pengamatan = Tb_hasilpengamatan::findOrFail($id);
        $pengamatan->delete();

        // return redirect()->route('dataPengamatan', ['room_id' => $room_id])
        //     ->with('success', 'Data pengamatan berhasil dihapus.');

        return redirect()->route('listRoom')
        ->with('success', 'Data pengamatan berhasil dihapus.');
    }


    public function temuanAudit($id) {
        // ambil data hasil pengamatan berdasarkan id
        $hasilPengamatan = Tb_hasilpengamatan::findOrFail($id);

        // lempar ke view form temuan audit
        return view('formTemuanAudit', compact('hasilPengamatan'));

    }




    // Simpan data temuan
    public function createTemuan(Request $request)
    {
        $request->validate([
            'id_hasilpengamatan' => 'required|exists:tb_hasilpengamatan,id',
            'deskripsi' => 'required|string',
            'lokasi' => 'required|string',
            'elemen' => 'required|string',
            'prosedure' => 'required|string',
            'krisis' => 'required|string',
            'foto' => 'required|array',        // multiple foto
            'foto.*' => 'required|string',     // setiap item base64 string
        ]);

        $user = auth()->user(); // ambil user login

        // simpan data utama ke tb_temuan
        $temuan = Tb_temuan::create([
            'id_hasilpengamatan' => $request->id_hasilpengamatan,
            'nik' => $user->nik,
            'deskripsi' => $request->deskripsi,
            'lokasi' => $request->lokasi,
            'prosedure' => $request->prosedure,
            'krisis' => $request->krisis,
            'elemen' => $request->elemen,
            'tanggal' => now()->format('Y-m-d'),
            'id_cabang' => $user->cabang,
            'status' => 'draft',
            'current_owner_id' => $user->id,
        ]);


        // simpan setiap foto ke tabel relasi tb_foto_temuan
        foreach ($request->foto as $index => $fotoBase64) {
            $fotoData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $fotoBase64));
            $namaFile = time() . "_{$index}.png";
            $path = public_path('uploads/foto/' . $namaFile);
            file_put_contents($path, $fotoData);

            Tb_foto_temuan::create([
                'temuan_id' => $temuan->id,
                'foto' => $namaFile
            ]);
        }

        // // ✅ ambil room_id lewat relasi hasilPengamatan → room_id
        // $room_id = $temuan->hasilPengamatan->room_id;

        // ambil namaAudit dari relasi hasilPengamatan
        $namaAudit = $temuan->hasilPengamatan->namaAudit;

        return redirect()->route('dataPengamatan', ['room_id' => $namaAudit])
        ->with('success', 'Temuan berhasil ditambahkan.');



    }



    private function saveFoto($temuanId, $fotoBase64)
    {
        $image = str_replace('data:image/jpeg;base64,', '', $fotoBase64);
        $image = str_replace(' ', '+', $image);
        $imageName = 'temuan_' . time() . '_' . uniqid() . '.jpeg';
        $path = public_path('uploads/foto/' . $imageName);
        file_put_contents($path, base64_decode($image));

        tb_foto_temuan::create([
            'temuan_id' => $temuanId,
            'foto' => $imageName,
        ]);
    }

    public function addFoto(Request $request, $temuanId)
    {
        $request->validate([
            'foto' => 'required|string',
        ]);

        $this->saveFoto($temuanId, $request->foto);

        return redirect()->back()->with('success', 'Foto tambahan berhasil disimpan.');
    }

    public function hasilTemuan()
    {
        // Ambil semua temuan beserta hasil pengamatan & fotonya
        $temuan = Tb_temuan::with(['hasilPengamatan', 'fotos'])->get();

        return view('hasilTemuan', compact('temuan'));
    }

    public function deleteTemuan($id)
    {
        $temuan = DB::table('tb_temuan')->where('id', $id)->first();

        if (!$temuan) {
        return redirect()->back()->with('error', 'Data temuan tidak ditemukan');
        }

        // Hapus record utama (foto ikut kehapus karena foreign key cascade)
        DB::table('tb_temuan')->where('id', $id)->delete();

        return redirect()->back()->with('success', 'Temuan berhasil dihapus');
    }


    public function selesaikanTemuan($id)
    {
        DB::table('tb_hasilpengamatan')
        ->where('id', $id)
        ->update(['status_final' => 'proses']);

        return redirect()->route('listRoom')->with('success', 'Status hasil pengamatan berhasil diperbarui ke PROSES.');
    }


}
