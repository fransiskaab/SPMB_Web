<?php

namespace App\Http\Controllers;

use App\Models\PaketPendaftaran;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    /**
     * Show the public home page.
     */
    public function home()
    {
        $totalApplicants = \App\Models\Siswa::count();
        $availablePrograms = \App\Models\PaketPendaftaran::count();
        $acceptedStudents = \App\Models\Siswa::where('status_pendaftaran', 'Diterima')->count();
        $activeWaves = 1; // Active waves count

        $programs = \App\Models\PaketPendaftaran::with('kelas')->get();

        return view('public.home', compact(
            'totalApplicants',
            'availablePrograms',
            'acceptedStudents',
            'activeWaves',
            'programs'
        ));
    }

    /**
     * Show the school profile page.
     */
    public function profile()
    {
        return view('public.profile');
    }

    /**
     * Show the facilities page.
     */
    public function facilities()
    {
        return view('public.fasilitas');
    }

    /**
     * Show the registration info page.
     */
    public function info()
    {
        return view('public.informasi-pendaftaran');
    }

    /**
     * Show the registration packages pricing page.
     */
    public function packages()
    {
        $paket = PaketPendaftaran::with(['kelas', 'items'])->orderBy('nominal_biaya', 'asc')->get();
        return view('public.paket-pendaftaran', compact('paket'));
    }

    /**
     * Show the contact page.
     */
    public function contact()
    {
        return view('public.kontak');
    }
}
