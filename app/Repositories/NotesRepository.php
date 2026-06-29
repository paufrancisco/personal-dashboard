<?php

namespace App\Repositories;

use App\Models\Notes;

class NotesRepository
{

    public function create(array $data){
        
        $notes = Notes::create($data);

        return $notes;
    }

    public function getAll(){

        $notes = Notes::All();

        return $notes;
    }

    public function update(int $id, array $data)
    {
        $notes = Notes::find($id);
        $notes->update($data);

        return $notes;
    }

    public function delete(int $id)
    {
        $notes = Notes::find($id);
        $notes->delete();
    }
}