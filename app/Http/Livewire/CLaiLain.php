<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

class CLaiLain extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search;
    protected $queryString = ['search'];

    public function render()
    {
        return view('livewire.c-lai-lain');
    }
}
