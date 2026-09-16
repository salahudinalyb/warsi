@extends('layouts.public')

@php $title = 'Ruang Kerja'; @endphp

@section('content')
    <div class="mx-auto flex max-w-md flex-1 flex-col items-center justify-center gap-3 px-6 py-24 text-center">
        <h1 class="text-xl font-bold text-gray-800 dark:text-white/90">Butuh peran Operator atau Admin</h1>
        <p class="text-sm text-gray-500 dark:text-gray-400">
            Ruang Kerja hanya untuk pengguna yang login sebagai Operator (input data) atau Admin (tinjau &amp; kelola pengguna). Ganti peran lewat selector di navbar situs publik.
        </p>
        <a href="{{ url('/') }}" class="mt-2 inline-flex items-center gap-2 rounded-lg bg-linear-to-b from-brand-400 to-brand-600 px-5 py-3 text-sm font-medium text-white shadow-theme-xs transition-all duration-150 hover:from-brand-500 hover:to-brand-700 hover:shadow-lg hover:shadow-brand-500/25 active:scale-[0.97]">
            Kembali ke Beranda
        </a>
    </div>
@endsection

@section('footer')
@endsection
