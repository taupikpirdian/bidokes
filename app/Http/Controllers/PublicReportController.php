<?php

namespace App\Http\Controllers;

use App\Models\PublicReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PublicReportController extends Controller
{
    /**
     * Menampilkan form pelaporan untuk masyarakat.
     */
    public function index()
    {
        return view('public.contact');
    }

    /**
     * Menyimpan data pelaporan dari masyarakat.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'reporter_name' => 'required|string|max:255',
            'reporter_phone' => 'required|string|max:15',
            'issue' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        PublicReport::create([
            'reporter_name' => $request->reporter_name,
            'reporter_phone' => $request->reporter_phone,
            'issue' => $request->issue,
        ]);

        return redirect()->back()->with('success', 'Laporan Anda telah berhasil dikirim. Terima kasih atas partisipasi Anda.');
    }
}
