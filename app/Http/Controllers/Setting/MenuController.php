<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Models\Setting\Menu;
use Illuminate\Http\Request;



use Illuminate\Support\Facades\DB;


class MenuController extends Controller
{
    public function index(Request $request)
    {
        $header = DB::table('m_menu')
            ->select('m_menu.*', 'a.name as parent_name')
            ->leftJoin('m_menu as a', 'm_menu.parent_id', '=', 'a.id')
            ->where('m_menu.is_active', 1)
            ->orderBy('breadcrumb')
            ->get();
        return view('setting.menu.index', compact('header'));
    }

    public function create()
    {
        $data = Menu::where('url', '#')->orderby('breadcrumb')->get();
        return view('setting.menu.create', compact('data'));
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            Menu::create([
                'name' => $request->name,
                'parent_id' => $request->parent_id,
                'breadcrumb' => $request->breadcrumb,
                'url' => $request->url,
                'icon' => $request->icon,
                'level' => $request->level,
                'is_active' => $request->is_active
            ]);
            DB::commit();
            return response()->json([
                'url' => url('menu'),
                'status' => 200,
                'message' => 'Save Data Successfully'
            ]);
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json([
                'url' => url('menu'),
                'status' => 400,
                'message' =>  $e->getMessage()
            ]);
        }
    }

    public function edit($id)
    {
        $header = Menu::findOrFail($id);
        $parent =  Menu::where('url', '#')->orderby('breadcrumb')->get();
        return view('setting.menu.edit', [
            'header' => $header,
            'parent' => $parent
        ]);
    }

    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            Menu::where('id', $id)->update([
                'name' => $request->name,
                'parent_id' => $request->parent_id,
                'breadcrumb' => $request->breadcrumb,
                'url' => $request->url,
                'icon' => $request->icon,
                'level' => $request->level,
                'is_active' => $request->is_active
            ]);
            DB::commit();
            return response()->json([
                'url' => url('menu'),
                'status' => 200,
                'message' => 'Update Data Successfully'
            ]);
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json([
                'url' => url('menu'),
                'status' => 400,
                'message' => $e->getMessage()
            ]);
        }
    }
}
