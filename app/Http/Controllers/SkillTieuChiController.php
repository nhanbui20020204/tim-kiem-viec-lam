<?php

namespace App\Http\Controllers;

use App\Models\SkillTieuChi;
use Illuminate\Http\Request;

class SkillTieuChiController extends Controller
{
    public function info(Request $request)
    {
        // $data = BaiDangTieuChi::find($request->id);
        $data = SkillTieuChi::where('id_tieu_chi', $request->id)
            ->join('skills', 'skills.id', '=', 'skill_tieu_chis.id_skill')
            ->select('skill_tieu_chis.id_skill', 'skills.ten_skill')
            ->get();
        return response()->json([
            'data'  => $data
        ]);
    }
}
