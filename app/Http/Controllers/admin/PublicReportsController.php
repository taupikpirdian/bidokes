<?php

namespace App\Http\Controllers\admin;

use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Models\PublicReport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PublicReportsController extends Controller
{
    /**
     * Display a listing of the public reports.
     */
    public function index()
    {
        $reports = PublicReport::orderBy('created_at', 'desc')->get();
        return view('admin.public-reports.index', compact('reports'));
    }

    /**
     * Display the specified public report.
     */
    public function show(string $id)
    {
        $report = PublicReport::findOrFail($id);
        return view('admin.public-reports.show', compact('report'));
    }

    /**
     * Remove the specified public report from storage.
     */
    public function destroy(string $id)
    {
        $report = PublicReport::findOrFail($id);
        $report->delete();

        return redirect()->route('dashboard.public-reports.index')
            ->with('success', 'Laporan berhasil dihapus.');
    }

    public function datatable(Request $request)
    {
        if (request()->ajax()) {
            /**
             * column shown in the table
             */
            $columns = [
                'reporter_name',
                'reporter_phone',
                'issue',
                'created_at',
                'updated_at',
            ];

            $limit = $request->input('length');
            $start = $request->input('start');
            $order = $columns[$request->input('order.0.column')];
            $dir = $request->input('order.0.dir');

            $posts = PublicReport::orderBy('created_at', 'desc');
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
                    $button .= '<a href="' . route('dashboard.public-reports.show', $post->id) . '" type="button" class="btn btn-sm btn-info" title="View">
                                <i class="fas fa-eye"></i>
                            </a>';

                    $htmlButton = '<div class="btn-group" role="group">
                            ' . $button . '
                        </div>';

                    $nestedData['reporter_name'] = $post->reporter_name;
                    $nestedData['reporter_phone'] = $post->reporter_phone;
                    $nestedData['issue'] = Str::limit($post->issue, 100);

                    $nestedData['created_at'] = Carbon::parse($post->created_at)->format('d/m/Y H:i');
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
}