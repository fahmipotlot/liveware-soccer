<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Club as ClubModel;
use App\Http\Livewire\Field;
use Illuminate\Http\Request;

class Club extends Component
{
    public $clubs, $name, $city;

    public function render()
    {
        $this->clubs = ClubModel::all();
        return view('livewire.club');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    private function resetInputFields(){
        $this->name = '';
        $this->city = '';
    }
      
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function store()
    {
        $validatedDate = $this->validate([
                'name' => 'required|unique:clubs,name',
                'city' => 'required',
            ]
        );

        ClubModel::create(['name' => $this->name, 'city' => $this->city]);
   
        $this->resetInputFields();
        session()->flash('message', 'berhasil menyimpan data klub');
    }
}
