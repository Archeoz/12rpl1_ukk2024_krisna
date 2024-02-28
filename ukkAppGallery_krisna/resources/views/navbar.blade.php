<!-- Navbar -->
<nav class="navbar navbar-expand navbar-light   " style="top: 0; position: fixed; z-index: 300; width:100%; background-color:rgb(255, 183, 0)">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-user"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="" class="nav-link">{{ Auth::user()->username }}</a>
      </li>
      {{-- <li class="nav-item d-none d-sm-inline-block">
        <a href="" class="nav-link" data-toggle="modal" data-target="#edit{{ Auth::user()->id }}"><i class="fas fa-edit"></i> Edit Profile |</a>
      </li> --}}
      <li class="nav-item d-none d-sm-inline-block">
        <a href="" class="nav-link" data-toggle="modal" data-target="#upload"><i class="fas fa-upload"></i> Upload Photo</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-images"> Pending images</i>
          <span class="badge badge-secondary navbar-badge">{{ count($pendingfoto) }}</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="max-height: 250px; overflow: auto;">
          <span class="dropdown-item dropdown-header">{{ count($pendingfoto) }} Images on pending state</span>
          <div class="dropdown-divider"></div>
          @foreach ($pendingfoto as $pf)
          <a class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="{{ asset('foto/'.$pf->foto) }}" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  {{ $pf->judul }}
                  <span class="float-right text-sm text-warning">Pending</span>
                </h3>
                <p class="text-sm">{{ $pf->deskripsi }}</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i>{{ $pf->created_at->diffForHumans() }}</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          @endforeach
          <a href="#" class="dropdown-item dropdown-footer">============================</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-images"> Declined images</i>
          <span class="badge badge-danger navbar-badge">{{ count($declinedfoto) }}</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="max-height: 250px; overflow: auto;">
          <span class="dropdown-item dropdown-header">{{ count($declinedfoto) }} Images has been declined by admin</span>
          <div class="dropdown-divider"></div>
          @foreach ($declinedfoto as $df)
          <a class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="{{ asset('foto/'.$df->foto) }}" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  {{ $df->judul }}
                  <form action="{{ url('hapusfoto/'.$df->id_gallery) }}" method="get">
                    @csrf
                    <button type="submit" class="float-right btn btn-danger btn-sm">Delete</button>
                  </form>
                </h3>
                <p class="text-sm">{{ $df->deskripsi }}</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i>{{ $df->created_at->diffForHumans() }}</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          @endforeach
          <a href="#" class="dropdown-item dropdown-footer">============================</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ url('logout') }}">
          <i class="fas fa-sign-out-alt"> Logout</i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->
  <div class="modal fade" id="upload">
    <div class="modal-dialog">
      <div class="modal-content" style="border: 4px solid rgb(19, 164, 248)">
        <div class="modal-header" style="border-bottom: 4px solid rgb(19, 164, 248)">
          <h4 class="modal-title">Upload Form</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ url('uploadfoto') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
                <label for="judul">Judul :</label>
                <input type="text" id="judul" name="judul" class="form-control" required>
                <label for="deskripsi">Deskripsi :</label>
                <input type="text" id="deskripsi" name="deskripsi" class="form-control" required>
                <label for="foto">Foto :</label>
                <input type="file" id="foto" name="foto" class="form-control" required>
                <span class="text-danger">* The photo format must be Png,Jpg,or Jpeg</span>
            </div>
            <div class="modal-footer justify-content-between" style="border-top: 4px solid rgb(19, 164, 248)">
              <button type="button" class="btn btn-light" data-dismiss="modal" style="border: 3px solid rgb(244, 195, 0)">Close</button>
              <button type="submit" class="btn btn-light" style="border: 3px solid rgb(75, 245, 1)">Upload</button>
            </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <div class="modal fade" id="edit{{ Auth::user()->id }}">
    <div class="modal-dialog">
      <div class="modal-content" style="border: 4px solid rgb(248, 229, 19)">
        <div class="modal-header" style="border-bottom: 4px solid rgb(248, 229, 19)">
          <h4 class="modal-title">Edit Form</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ url('editprofile/'.Auth::user()->id) }}" method="post">
            @csrf
            <div class="modal-body">
                <label for="username">Username :</label>
                <input type="text" id="username" name="username" class="form-control" value="{{ Auth::user()->username }}" required>
                <label for="favthing">Favorite thing :</label>
                <input type="text" id="favthing" name="favthing" class="form-control">
                <span class="text-danger">* Kosongi jika tak ingin diganti</span><br>
                <label for="password">Password :</label>
                <input type="password" id="password" name="password" class="form-control">
                <span class="text-danger">* Kosongi jika tak ingin diganti</span><br>
                <label for="verpassword">Verify Password :</label>
                <input type="password" id="verpassword" name="verpassword" class="form-control" required>
            </div>
            <div class="modal-footer justify-content-between" style="border-top: 4px solid rgb(248, 229, 19)">
              <button type="button" class="btn btn-light" data-dismiss="modal" style="border: 3px solid rgb(244, 195, 0)">Close</button>
              <button type="submit" class="btn btn-light" style="border: 3px solid rgb(75, 245, 1)">Edit</button>
            </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>