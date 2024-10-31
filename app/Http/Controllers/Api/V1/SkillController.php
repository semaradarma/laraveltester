<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSkillRequest;
use App\Http\Resources\V1\SkillResource;
use App\Models\skill;
use GuzzleHttp\Psr7\Message;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    public function index()
    {
        $items = skill::all();

        // Mengembalikan data dalam format JSON
        return response()->json([
            'data' => $items,
            'message' => 'Data skill berhasil diambil',
            'success' => true
        ]);
    }

    public function show(Skill $skill)
    {
        // Mengambil item berdasarkan ID
        $item = skill::find($skill);
        

        // Jika item tidak ditemukan, kembalikan respons 40

        // Mengembalikan data dalam format JSON
        return response()->json([
            'message' => 'Item retrieved successfully',
            'success' => true,
            'data' => $item
        ]);
    }

    public function store(StoreSkillRequest $request)
    {
        Skill::create($request->validated());
        return response()->json([
            'message' => 'Data skill berhasil disimpan',
            'success' => true
        ]);
    }

    public function update(StoreSkillRequest $request, Skill $skill)
    {
        dd("anjay");
        $item = skill::find($skill);
        $item->update([
            'name' => $request->name,
            'slug' => $request->slug,
        ]);
        $item->save();
        return response()->json([
            'message' => 'success',
            'success' => true       
        ]);
    }

    public function delete(StoreSkillRequest $request, Skill $skill)
    {
       
    }

    public  function updateSkills(Request $request, $id){
        $item = skill::find($id);
        $item->update([
            'name' => $request->name,
            'slug' => $request->slug,
        ]);
        $item->save();
        return response()->json([
            'message' => 'success',
            'success' => true       
        ]);
    }

    public function deleteSkills ($id){
        $item = skill::find($id);
        $item->delete();
        return response()->json([
            'message' => 'Data deleted successfully',
            'success' => true
        ]);
    }

}
