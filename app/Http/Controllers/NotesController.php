<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\NotesRepository;

class NotesController extends Controller
{

    protected NotesRepository $repository;

    public function __construct(NotesRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $notes = $this->repository->getAll();
        return response()->json($notes);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $notes = $this->repository->create($request->all());

        return response()->json($notes);
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
        $notes = $this->repository->update($id, $request->all());

        return response()->json($notes);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $deleted = $this->repository->delete($id);
        
        return response()->json(['message' => 'Deleted successfully']);
    }
}
