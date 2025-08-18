<?php

namespace App\Http\Controllers\admin;

use Carbon\Carbon;
use App\Models\Report;
use App\Models\Category;
use App\Models\Institution;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\Access;
use Illuminate\Support\Facades\Auth;

class PerkarasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.perkaras.index');
    }

    public function datatable(Request $request)
    {
        if (request()->ajax()) {
            $role = Auth::user()->roles[0]->name;

            /**
             * column shown in the table
             */
            // check from model Report
            $columns = [
                'polres_id',
                'polsek_id',
                'nomor',
                'reporter_date',
                'reporter_name',
                'created_at',
                'created_by',
            ];

            $limit = $request->input('length');
            $start = $request->input('start');
            $order = $columns[$request->input('order.0.column')];
            $dir = $request->input('order.0.dir');

            $posts = Report::with(['polres', 'polsek'])->orderBy('created_at', 'desc');
            $access = Access::where('user_id', Auth::user()->id)->first();
            // check when role is polres or polsek, where based on access data
            if ($role == 'polres') {
                $posts = $posts->where('polres_id', $access->institution_id);
            }
            if ($role == 'polsek') {
                $posts = $posts->where('polsek_id', $access->institution_id);
            }

            if ($request->search['value']) {
                $posts = $posts->where('reporter_name', 'like', '%' . $request->search['value'] . '%')
                    ->orWhere('reporter_phone', 'like', '%' . $request->search['value'] . '%')
                    ->orWhere('issue', 'like', '%' . $request->search['value'] . '%');
            }

            $totalData = $posts->count();
            $posts = $posts->skip($start)->take($limit)->orderBy($order, $dir)->get();
            $data = array();
            if (!empty($posts)) {
                foreach ($posts as $key => $post) {
                    $button = '';
                    $button .= '<a href="' . route('dashboard.perkaras.show', $post->id) . '" type="button" class="btn btn-sm btn-info" title="View">
                                <i class="fas fa-eye"></i>
                            </a>';

                    $button .= '<a href="' . route('dashboard.perkaras.edit', $post->id) . '" type="button" class="btn btn-sm btn-warning" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>';

                    $button .= '<button type="button" class="btn btn-sm btn-danger" title="Delete" onclick="deleteData(' . $post->id . ')">
                                <i class="fas fa-trash"></i>
                            </button>';

                    $htmlButton = '<div class="btn-group" role="group">
                            ' . $button . '
                        </div>';

                    if ($post->polsek_id) {
                        $instansi = $post->polres->name . " - " . $post->polsek->name;
                    } else {
                        $instansi = $post->polres->name;
                    }
                    $nestedData['polres'] = $instansi;

                    $nestedData['nomor'] = $post->nomor;
                    $nestedData['reporter_date'] = $post->reporter_date;
                    $nestedData['reporter_name'] = $post->reporter_name;
                    $nestedData['category'] = $post->category->name ?? "-";

                    $nestedData['created_at'] = Carbon::parse($post->created_at)->format('d/m/Y H:i');
                    $nestedData['created_by'] = $post->user->name ?? "-";
                    $nestedData['action'] = $htmlButton;
                    $nestedData['DT_RowIndex'] = ($key + 1) + $start;

                    $data[] = $nestedData;
                }
            }

            $json_data = array(
                "draw"            => intval($request->input('draw')),
                "recordsTotal"    => intval($totalData),
                "recordsFiltered" => intval($totalData),
                "data"            => $data
            );

            return response()->json($json_data);
        }
    }

    /**
     * Print a listing of the resource.
     */
    public function indexCetak()
    {
        return view('admin.perkaras.cetak.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $is_edit = false;
        $categories = Category::all();
        $polres = Institution::where('level', 1)->get();
        $role = Auth::user()->roles->pluck('name')->first();
        $perkara = null;

        return view('admin.perkaras.create', compact('is_edit', 'categories', 'polres', 'role', 'perkara'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nomor' => ['required', 'string', 'max:255', 'unique:reports,nomor'], // unique
            'reporter_name' => ['required', 'string', 'max:255'],
            'reporter_address' => ['required', 'string'],
            'reporter_phone' => ['required', 'string'],
            'issue' => ['required', 'string'],
            'category_id' => ['required', 'string'],
        ], [
            'nomor.required' => 'Nomor pelaporan wajib diisi.',
            'reporter_name.required' => 'Nama pelapor wajib diisi.',
            'reporter_address.required' => 'Alamat pelapor wajib diisi.',
            'reporter_phone.required' => 'Nomor telepon pelapor wajib diisi.',
            'issue.required' => 'Isi perkara wajib diisi.',
            'category_id.required' => 'Kategori perkara wajib diisi.',
        ]);

        try {
            DB::beginTransaction();
            $role = Auth::user()->roles[0]->name;

            $reporterDateTime = Carbon::parse(
                $request->reporter_date . ' ' . $request->reporter_time
            );
            if ($role == 'polres') {
                $access = Access::where('user_id', Auth::user()->id)->first();
                $polres_id = $access->institution_id;
                $polsek_id = null;
            } else if ($role = 'polsek') {
                $access = Access::where('user_id', Auth::user()->id)->first();
                $institution = Institution::where('id', $access->institution_id)->first();
                $parent = Institution::where('id', $institution->parent_id)->first();

                $polres_id = $parent->id;
                $polsek_id = $access->institution_id;
            } else {
                $polres_id = $request->polres_id;
                $polsek_id = $request->polsek_id;
            }
            // Create perkara
            Report::create([
                'polres_id' => $polres_id,
                'polsek_id' => $polsek_id,
                'nomor' => $validated['nomor'],
                'reporter_name' => $validated['reporter_name'],
                'reporter_address' => $validated['reporter_address'],
                'reporter_phone' => $validated['reporter_phone'],
                'issue' => $validated['issue'],
                'category_id' => $validated['category_id'],
                'reporter_date' => $reporterDateTime,
                'created_by' => Auth::user()->id,
            ]);

            DB::commit();
            return redirect()->route('dashboard.perkaras.index')
                ->with('success', 'Perkara berhasil ditambahkan dengan nomor ' . ucfirst($validated['nomor']) . '.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error storing perkara: ' . $e->getMessage());
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat menyimpan data user');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $perkara = Report::findOrFail($id);
        return view('admin.perkaras.show', compact('perkara'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $is_edit = true;
        $categories = Category::all();
        $polres = Institution::where('level', 1)->get();
        $role = Auth::user()->roles->pluck('name')->first();
        $perkara = Report::findOrFail($id);
        $reporterDate = Carbon::parse($perkara->reporter_date)->format('Y-m-d');
        $reporterTime = Carbon::parse($perkara->reporter_date)->format('H:i');
        return view('admin.perkaras.create', compact('is_edit', 'categories', 'polres', 'role', 'perkara', 'reporterDate', 'reporterTime'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'nomor' => ['required', 'string', 'max:255'],
            'reporter_name' => ['required', 'string', 'max:255'],
            'reporter_address' => ['required', 'string'],
            'reporter_phone' => ['required', 'string'],
            'issue' => ['required', 'string'],
            'category_id' => ['required', 'string'],
        ], [
            'nomor.required' => 'Nomor pelaporan wajib diisi.',
            'reporter_name.required' => 'Nama pelapor wajib diisi.',
            'reporter_address.required' => 'Alamat pelapor wajib diisi.',
            'reporter_phone.required' => 'Nomor telepon pelapor wajib diisi.',
            'issue.required' => 'Isi perkara wajib diisi.',
            'category_id.required' => 'Kategori perkara wajib diisi.',
        ]);

        try {
            DB::beginTransaction();
            // Update perkara
            $perkara = Report::findOrFail($id);
            $reporterDateTime = Carbon::parse(
                $request->reporter_date . ' ' . $request->reporter_time
            );
            $perkara->update([
                'polres_id' => $request->polres_id,
                'polsek_id' => $request->polsek_id,
                'nomor' => $validated['nomor'],
                'reporter_name' => $validated['reporter_name'],
                'reporter_address' => $validated['reporter_address'],
                'reporter_phone' => $validated['reporter_phone'],
                'issue' => $validated['issue'],
                'category_id' => $validated['category_id'],
                'reporter_date' => $reporterDateTime,
                'updated_by' => Auth::user()->id,
            ]);
            DB::commit();
            return redirect()->route('dashboard.perkaras.index')
                ->with('success', 'Perkara berhasil diupdate dengan nomor ' . ucfirst($validated['nomor']) . '.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat menyimpan data user: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            DB::beginTransaction();
            $perkara = Report::findOrFail($id);
            $perkara->delete();
            DB::commit();
            return redirect()->route('dashboard.perkaras.index')
                ->with('success', 'Perkara berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat menghapus data perkara: ' . $e->getMessage());
        }
    }
}
