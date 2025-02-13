<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Models\Setting\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $cabang = Project::where('id', Auth::user()->id_project)->first();

        return view('setting.profile.index', compact('cabang'));
    }

    public function getdata()
    {
        $idProject = Auth::user()->id_project;
        $data = DB::select("exec dbo.tPendaftaran_GetPasienWeb ?", [$idProject]);
        return response()->json([
            'data' => $data
        ]);
    }
}
