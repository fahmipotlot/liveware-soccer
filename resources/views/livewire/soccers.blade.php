<div>
    @if (session()->has('message'))
        <div class="alert alert-success">
          {{ session('message') }}
        </div>
    @endif
    
    <h3>Klasmen</h3>
    <hr>
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Ma</th>
            <th>Me</th>
            <th>S</th>
            <th>K</th>
            <th>GM</th>
            <th>GK</th>
            <th>Point</th>
        </tr>
        @foreach($clubs as $key => $value)
            <tr>
                <td>{{ $key+1 }}</td>
                <td>{{ $value->name }}</td>
                <td>{{ $value->match }}</td>
                <td>{{ $value->win }}</td>
                <td>{{ $value->lose }}</td>
                <td>{{ $value->draw }}</td>
                <td>{{ $value->gm }}</td>
                <td>{{ $value->gk }}</td>
                <td>{{ $value->point }}</td>
            </tr>
        @endforeach
    </table>
  
    <form>
        <div class=" add-input">
            <h3>Input match 1</h3>
            <hr>
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="">Home Club</label>
                        <select class="form-control" wire:model="home_club_id.0">
                            <option value="">Select</option>
                            @foreach($clubs as $club)
                                <option value="{{ $club->id }}">{{ $club->name }}</option>
                            @endforeach
                        </select>
                        @error('home_club_id.0') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="">Away Club</label>
                        <select class="form-control" wire:model="away_club_id.0">
                            <option value="">Select</option>
                            @foreach($clubs as $club)
                                <option value="{{ $club->id }}">{{ $club->name }}</option>
                            @endforeach
                        </select>
                        @error('away_club_id.0') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group">
                        <input type="text" class="form-control" wire:model="home_club_score.0" placeholder="Home Club Score">
                        @error('home_club_score.0') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group">
                        <input type="text" class="form-control" wire:model="away_club_score.0" placeholder="Away Club Score">
                        @error('away_club_score.0') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="col-md-2">
                    <button class="btn text-white btn-info btn-sm" wire:click.prevent="add({{$i}})">Add</button>
                </div>
            </div>
        </div>
  
        @foreach($inputs as $key => $value)
            <h3>Input match {{ $key+2 }}</h3>
            <hr>
            <div class=" add-input">
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="">Home Club</label>
                            <select class="form-control" wire:model="home_club_id.{{ $value }}">
                                <option value="">Select</option>
                                @foreach($clubs as $club)
                                    <option value="{{ $club->id }}">{{ $club->name }}</option>
                                @endforeach
                            </select>
                            @error('home_club_id.'.$value) <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="">Away Club</label>
                            <select class="form-control" wire:model="away_club_id.{{ $value }}">
                                <option value="">Select</option>
                                @foreach($clubs as $club)
                                    <option value="{{ $club->id }}">{{ $club->name }}</option>
                                @endforeach
                            </select>
                            @error('away_club_id.'.$value) <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <input type="text" class="form-control" wire:model="home_club_score.{{ $value }}" placeholder="Home Club Score">
                            @error('home_club_score.'.$value) <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <input type="text" class="form-control" wire:model="away_club_score.{{ $value }}" placeholder="Away Club Score">
                            @error('away_club_score.'.$value) <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-danger btn-sm" wire:click.prevent="remove({{$key}})">Remove</button>
                    </div>
                </div>
            </div>
        @endforeach
  
        <div class="row">
            <div class="col-md-12">
                <button type="button" wire:click.prevent="store()" class="btn btn-success btn-sm">Submit</button>
            </div>
        </div>
  
    </form>
</div>