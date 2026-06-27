<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ShortcutsRepository;

class ShortcutsController extends Controller
{

    protected ShortcutsRepository $repository;

    public function __construct(ShortcutsRepository $repository)
    {
        $this->repository = $repository;
    }
 
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $shortcuts = $this->repository->getAll();
        return response()->json($shortcuts);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $shortcut = $this->repository->create($request->all());
        return response()->json($shortcut, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
