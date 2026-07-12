<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index()
    {
        // Data fitur/layanan
        $features = [
            [
                'icon' => 'ph-paper-plane-tilt',
                'title' => 'Ajukan Pengaduan',
                'description' => 'Ajukan pengaduan Anda dengan mudah melalui platform digital kami.'
            ],
            [
                'icon' => 'ph-magnifying-glass',
                'title' => 'Lacak Status',
                'description' => 'Pantau status pengaduan Anda secara real-time melalui dashboard pribadi.'
            ],
            [
                'icon' => 'ph-chat-dots',
                'title' => 'Komunikasi Langsung',
                'description' => 'Berkomunikasi langsung dengan petugas DISPENDUKCAPIL untuk pengaduan Anda.'
            ],
            [
                'icon' => 'ph-check-circle',
                'title' => 'Resolusi Cepat',
                'description' => 'Kami berkomitmen menyelesaikan pengaduan Anda dengan cepat dan tuntas.'
            ]
        ];
        
        // Determine dashboard route based on authenticated user's role
        $dashboardRoute = null;
        if (auth()->check()) {
            $role = auth()->user()->role;
            if ($role === 'petugas') {
                $dashboardRoute = 'petugas.dashboard';
            } elseif ($role === 'masyarakat') {
                $dashboardRoute = 'masyarakat.dashboard';
            } else {
                $dashboardRoute = 'masyarakat.dashboard';
            }
        }

        return view('landing', compact('features', 'dashboardRoute'));
    }
}
