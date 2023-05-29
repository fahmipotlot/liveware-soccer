<div>
    @if (session()->has('message'))
        <div class="alert alert-success">
          {{ session('message') }}
        </div>
    @endif
    
    <h3>Club</h3>
    <hr>
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>City</th>
        </tr>
        @foreach($clubs as $key => $value)
            <tr>
                <td>{{ $key+1 }}</td>
                <td>{{ $value->name }}</td>
                <td>{{ $value->city }}</td>
            </tr>
        @endforeach
    </table>
  
    <form>
        <div class=" add-input">
            <h3>Input Club</h3>
            <hr>
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" class="form-control" wire:model="name" placeholder="Name">
                        @error('name') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="">City</label>
                        <input type="text" class="form-control" wire:model="city" placeholder="City">
                        @error('city') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>
        </div>
  
        <div class="row">
            <div class="col-md-12">
                <button type="button" wire:click.prevent="store()" class="btn btn-success btn-sm">Submit</button>
            </div>
        </div>
  
    </form>
</div>