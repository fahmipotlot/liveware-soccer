<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Club;
use App\Models\Game;
use App\Http\Livewire\Field;
use Illuminate\Http\Request;

class Soccers extends Component
{
    public $clubs, $home_club_id, $away_club_id, $home_club_score, $away_club_score;
    public $updateMode = false;
    public $inputs = [];
    public $i = 1;

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function add($i)
    {
        $i = $i + 1;
        $this->i = $i;
        array_push($this->inputs ,$i);
    }
      
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function remove($i)
    {
        unset($this->inputs[$i]);
    }

    public function render()
    {
        $this->clubs = Club::with(['games', 'games_away'])->orderBy('point', 'desc')->get();
        return view('livewire.soccers');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    private function resetInputFields(){
        $this->away_club_id = '';
        $this->away_club_score = '';
        $this->home_club_id = '';
        $this->home_club_score = '';
    }
      
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function store()
    {
        $validatedDate = $this->validate([
                'away_club_id.0' => 'required|exists:clubs,id',
                'home_club_id.0' => 'required|exists:clubs,id',
                'away_club_score.0' => 'required|numeric|min:0',
                'home_club_score.0' => 'required|numeric|min:0',
                'away_club_id.*' => 'required|exists:clubs,id',
                'home_club_id.*' => 'required|exists:clubs,id',
                'away_club_score.*' => 'required|numeric|min:0',
                'home_club_score.*' => 'required|numeric|min:0',
            ],
            [
                'away_club_id.0.required' => 'away club field is required',
                'home_club_id.0.required' => 'home club field is required',
                'away_club_score.0.required' => 'away club score field is required',
                'home_club_score.0.required' => 'home club score field is required',
                'away_club_id.*.required' => 'away club field is required',
                'home_club_id.*.required' => 'home club field is required',
                'away_club_score.*.required' => 'away club score field is required',
                'home_club_score.*.required' => 'home club score field is required',
            ]
        );
   
        $duplicate_match = '';
        foreach ($this->away_club_id as $key => $value) {
            if ($this->away_club_id[$key] === $this->home_club_id[$key]) {
                $duplicate_match .= 'tidak bisa menyimpan pertandingan dengan club yang sama ';
            } else {
                // validate duplicate match
                $duplicate = Game::where([
                    'away_club_id' => $this->away_club_id[$key],
                    'home_club_id' => $this->home_club_id[$key]
                ])->first();

                if ($duplicate) {
                    $duplicate_match .= 'pertandingan '.$duplicate->home->name .' vs '.$duplicate->away->name.' sudah ada';
                } else {
                    $game = Game::create([
                        'away_club_id' => $this->away_club_id[$key],
                        'home_club_id' => $this->home_club_id[$key],
                        'away_club_score' => $this->away_club_score[$key],
                        'home_club_score' => $this->home_club_score[$key]
                    ]);

                    // calculate point for each club winner + 3, lose +0, draw +1
                    $game_home_club_score = $game->home_club_score;
                    $game_away_club_score = $game->away_club_score;
                    $home = Club::find($this->home_club_id[$key]);
                    $away = Club::find($this->away_club_id[$key]);

                    $home_point = $home->point;
                    $home_win = $home->win;
                    $home_lose = $home->lose;
                    $home_draw = $home->draw;
                    $home_gm = $home->gm + $this->home_club_score[$key];
                    $home_gk = $home->gk + $this->away_club_score[$key];

                    $away_point = $away->point;
                    $away_win = $away->win;
                    $away_lose = $away->lose;
                    $away_draw = $home->draw;
                    $away_gm = $away->gm + $this->away_club_score[$key];
                    $away_gk = $away->gk + $this->home_club_score[$key];

                    if ($game_home_club_score > $game_away_club_score) {
                        $home_point += 3;
                        $home_win += 1;
                        $away_point += 0;
                        $away_lose += 1;
                    } else if ($game_home_club_score < $game_away_club_score) {
                        $home_point += 0;
                        $home_lose += 1;
                        $away_point += 3;
                        $away_win += 1;
                    } else {
                        $home_point += 1;
                        $home_draw += 1;
                        $away_draw += 1;
                        $away_point += 1;
                    }

                    $home->update([
                        'point' => $home_point,
                        'match' => $home->match + 1,
                        'win' => $home_win,
                        'lose' => $home_lose,
                        'draw' => $home_draw,
                        'gm' => $home_gm,
                        'gk' => $home_gk
                    ]);
                    $away->update([
                        'point' => $away_point,
                        'match' => $away->match + 1,
                        'win' => $away_win,
                        'lose' => $away_lose,
                        'draw' => $away_draw,
                        'gm' => $away_gm,
                        'gk' => $away_gk
                    ]);
                }
            }
        }
  
        $this->inputs = [];
   
        $this->resetInputFields();
   
        if (!empty($duplicate_match)) {
            session()->flash('message', ' '.$duplicate_match);
        } else {
            session()->flash('message', 'berhasil menyimpan data pertandingan');
        }
    }
}
