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
}