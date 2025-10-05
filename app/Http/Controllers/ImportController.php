<?php

namespace App\Http\Controllers;

use App\Imports\AuditeeImport;
use App\Imports\AuditorImport;
use App\Imports\CabangImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Controller
{
    //

    public function importAuditor() {
        Excel::import(new AuditorImport(), request()->file('file'));
        return redirect()->back()->with('Succes Import');
    }

    public function importAuditee() {
        Excel::import(new AuditeeImport(), request()->file('file'));
        return redirect()->back()->with('success', 'Data Auditee berhasil Di Import.');
    }

    public function importCabang() {
        Excel::import(new CabangImport(), request()->file('file'));
        return redirect()->back()->with('success', 'Data Cabang berhasil Di Import.');
    }

}
