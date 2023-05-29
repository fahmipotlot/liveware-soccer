<!DOCTYPE html>
<html>
  <head>
    <title>Laravel Livewire Soccers</title>
    @livewireStyles
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  </head>
<body>
  <div class="container">
    <div class="card">
      <div class="card-header">
        <!-- A grey horizontal navbar that becomes vertical on small screens -->
        <nav class="navbar navbar-expand-sm bg-light">
          <!-- Links -->
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="/">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="club">Club</a>
            </li>
          </ul>
        </nav>
      </div>
      <div class="card-body">
        @livewire('soccers')
      </div>
    </div>
  </div>
</body>
@livewireScripts
</html>