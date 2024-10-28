<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSkillRequest;
use App\Http\Resources\V1\SkillResource;
use App\Models\skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    public function index()
    {
        return response()->json("Mantap Bos");
    }

    public function show(Skill $skill)
    {
        return new SkillResource($skill);
    }

    public function store(StoreSkillRequest $request)
    {
        Skill::create($request->validated());
        return response()->json("Skill Created");
    }

    public function update(StoreSkillRequest $request, Skill $skill)
    {
        $skill->update($request->validated());
        return response()->json("Skill Updated");
    }
}
