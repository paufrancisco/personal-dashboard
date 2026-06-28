<?php

namespace App\Repositories;

use App\Models\Shortcuts;

class ShortcutsRepository
{
    public function getAll()
    {
        $shortcuts = Shortcuts::all();

        return $shortcuts;
    }

    public function create(array $data)
    {
        $shortcut = Shortcuts::create($data);

        return $shortcut;
    }

    public function delete(int $id)
    {
        $shortcut = Shortcuts::find($id);
        $shortcut->delete();
    }

    public function update(int $id, array $data)
    {
        $shortcut = Shortcuts::find($id);
        $shortcut->update($data);
        return $shortcut;
    }


}