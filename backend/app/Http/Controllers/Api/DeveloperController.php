<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateDeveloper;
use App\Http\Resources\DeveloperResource;
use App\Services\DeveloperService;
use Illuminate\Http\Request;

class DeveloperController extends Controller
{
    protected $developerService;

    public function __construct(DeveloperService $developerService)
    {
        $this->developerService = $developerService;
    }
    /**
     * Display a listing of the resource.
     * @param  string  $order
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $developers = $this->developerService->getDevelopers();

        return DeveloperResource::collection($developers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateDeveloper $request)
    {
        $developer = $this->developerService->createNewDeveloper($request->validated());

        return new DeveloperResource($developer);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $developer = $this->developerService->getDeveloper($id);

        return new DeveloperResource($developer);
    }

    /**
     * Display the search resource.
     *
     * @return \Illuminate\Http\Request $text
     */
    public function search(Request $text)
    {
        $developer = $this->developerService->getDeveloperSearch($text->search);

        return DeveloperResource::collection($developer);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateDeveloper $request, $id)
    {
        $this->developerService->updateDeveloper($id, $request->validated());

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
        $this->developerService->deleteDeveloper($id);

        return response()->json([], 204);
    }
}
