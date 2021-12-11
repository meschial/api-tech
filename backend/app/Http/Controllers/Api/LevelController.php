<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateLevel;
use App\Http\Resources\LevelResource;
use App\Services\LevelService;
use Illuminate\Http\Request;

class LevelController extends Controller
{
    protected $levelService;

    public function __construct(LevelService $levelService)
    {
        $this->levelService = $levelService;
    }
    /**
     * Display a listing of the resource.
     * @param  string  $order
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $level = $this->levelService->getLevels();

        return LevelResource::collection($level);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateLevel $request)
    {
        $level = $this->levelService->createNewLevel($request->validated());

        return new LevelResource($level);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $level = $this->levelService->getLevel($id);

        return new LevelResource($level);
    }
    
    /**
     * Display the search resource.
     *
     * @return \Illuminate\Http\Request $text
     */
    public function search(Request $text)
    {
        $level = $this->levelService->getLevelSearch($text->search);

        return LevelResource::collection($level);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateLevel $request, $id)
    {
        $this->levelService->updateLevel($id, $request->validated());

        return response()->json(['message' => 'updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->levelService->deleteLevel($id);

        return response()->json([], 204);
    }
}
