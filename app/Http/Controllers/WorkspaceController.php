<?php

namespace App\Http\Controllers;

use App\Models\Lokasi;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WorkspaceController extends Controller
{
    public function index(Request $request)
    {
        $query = Lokasi::query()->orderByDesc('created_at');

        if ($kategori = $request->query('kategori')) {
            $query->where('kategori', $kategori);
        }
        if ($status = $request->query('status')) {
            $query->where('status', $status);
        }
        if ($search = $request->query('search')) {
            $query->where(fn ($q) => $q->where('nama', 'like', "%{$search}%")->orWhere('wilayah', 'like', "%{$search}%"));
        }

        $kategoriTitles = [
            'hutan' => 'Data Kehutanan',
            'program' => 'Data Program',
            'monitoring' => 'Data Monitoring',
        ];
        $statusTitles = [
            'menunggu' => 'Menunggu Tinjauan',
            'terbit' => 'Data Tayang',
            'ditolak' => 'Data Ditolak',
        ];

        $title = $kategoriTitles[$kategori] ?? $statusTitles[$status] ?? 'Semua Data';

        $perPage = (int) $request->query('per_page', 10);
        if (! in_array($perPage, [10, 25, 50, 100], true)) {
            $perPage = 10;
        }

        return view('pages.workspace.index', [
            'title' => $title,
            'perPage' => $perPage,
            'lokasi' => $query->paginate($perPage)->withQueryString(),
            'total' => Lokasi::count(),
            'menunggu' => Lokasi::where('status', 'menunggu')->count(),
            'terbit' => Lokasi::where('status', 'terbit')->count(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'kategori' => ['required', 'in:hutan,program,monitoring'],
            'nama' => ['required', 'string', 'max:150'],
            'ig_zip' => ['required', 'file', 'max:25600'],
            'style_file' => ['nullable', 'file', 'max:5120'],
            'sumber' => ['nullable', 'string', 'max:255'],
            'deskripsi' => ['nullable', 'string', 'max:1000'],
        ]);

        $igFile = $request->file('ig_zip');
        $igPath = $igFile->store('uploads/ig');

        $stylePath = null;
        $styleFilename = null;
        if ($request->hasFile('style_file')) {
            $styleFile = $request->file('style_file');
            $stylePath = $styleFile->store('uploads/style');
            $styleFilename = $styleFile->getClientOriginalName();
        }

        Lokasi::create([
            'kode' => 'RBP-'.random_int(1000, 9999),
            'nama' => $data['nama'],
            'wilayah' => 'Belum ditentukan',
            'kategori' => $data['kategori'],
            'bulan' => (int) now()->format('n'),
            'luas' => 0,
            'penerima' => 0,
            'x' => round(mt_rand(150, 850) / 1000, 3),
            'y' => round(mt_rand(100, 900) / 1000, 3),
            'status' => 'menunggu',
            'sumber' => $data['sumber'] ?? null,
            'deskripsi' => $data['deskripsi'] ?? null,
            'ig_path' => $igPath,
            'ig_filename' => $igFile->getClientOriginalName(),
            'ig_size' => $igFile->getSize(),
            'style_path' => $stylePath,
            'style_filename' => $styleFilename,
        ]);

        return redirect()->route('workspace.index')->with('status', 'Data tersimpan, menunggu tinjauan Admin.');
    }

    public function approve(Lokasi $lokasi): RedirectResponse
    {
        abort_unless(session('role') === 'admin', 403);
        $lokasi->update(['status' => 'terbit']);

        return redirect()->route('workspace.index');
    }

    public function reject(Lokasi $lokasi): RedirectResponse
    {
        abort_unless(session('role') === 'admin', 403);
        $lokasi->update(['status' => 'ditolak']);

        return redirect()->route('workspace.index');
    }
}
