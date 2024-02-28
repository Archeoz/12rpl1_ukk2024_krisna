@extends('master')
@section('content')
    <!-- Main content -->
    <section class="content" style="padding-top: 5%">
      <div class="container-fluid">
  
          <!-- Timelime example  -->
          <div class="row">
            @if (Session('errorupload'))
                <span class="alert alert-warning">{{ Session('errorupload') }}</span>
            @endif
            @if (Session('errorpassword'))
                <span class="alert alert-warning">{{ Session('errorpassword') }}</span>
            @endif
            <div class="col-md-12">
              <!-- The time line -->
              <div class="timeline">
                <!-- timeline time label -->
                <div class="time-label">
                  <span class="bg-red">Your gallery timeline</span>
                </div>
                <!-- /.timeline-label -->
                <!-- timeline item -->
                <div>
                  <i class="fa fa-camera bg-purple"></i>
                  <div class="timeline-item">
                    {{-- @if (optional($tglterbaru->created_at == null))
                    @else
                      <span class="time"><i class="fas fa-clock"></i>{{ $tglterbaru->created_at->diffForHumans() }}</span>
                    @endif --}}
                    <h3 class="timeline-header"><a href="#">{{ Auth::user()->username }} |</a> Your latest upload</h3>
                    <div class="timeline-body">
                      @foreach ($fototerbaru as $fb)
                      <a href="{{ asset('foto/'.$fb->foto) }}" data-toggle="lightbox" data-title="{{ $fb->judul }}" data-gallery="gallery">
                        <img src="{{ asset('foto/'.$fb->foto) }}" alt="" width="200" height="150" class="img-fluid">  
                      </a>
                      @endforeach
                    </div>
                  </div>
                </div>
                <!-- END timeline item -->
                <!-- timeline item -->
                @foreach ($gallery as $gl)
                  <div class="time-label pt-2">
                    <span class="bg-green">{{ $gl->created_at }}</span>
                  </div>
                  <div>
                    <i class="fas fa-camera bg-maroon"></i>
    
                    <div class="timeline-item">
                      <span class="time"><i class="fas fa-clock"></i>{{ $gl->created_at->diffForHumans() }}</span>
                      <h3 class="timeline-header"><a href="#">{{ $gl->judul }} |</a>
                          <a href="" class="btn btn-warning" data-toggle="modal" data-target="#edit{{ $gl->id_gallery }}"><i class="fas fa-edit"></i></a>
                          <div class="modal fade" id="edit{{ $gl->id_gallery }}">
                              <div class="modal-dialog">
                                <div class="modal-content" style="border: 4px solid rgb(255, 217, 4)">
                                  <div class="modal-header" style="border-bottom: 4px solid rgb(255, 217, 4)">
                                    <h4 class="modal-title">Edit Form</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <form action="{{ url('editfoto/'.$gl->id_gallery) }}" method="post" enctype="multipart/form-data">
                                      @csrf
                                      <div class="modal-body">
                                          <label for="judul">Judul :</label>
                                          <input type="text" id="judul" name="judul" class="form-control" value="{{ $gl->judul }}" required>
                                          <label for="deskripsi">Deskripsi :</label>
                                          <input type="text" id="deskripsi" name="deskripsi" class="form-control" value="{{ $gl->deskripsi }}" required>
                                          <label for="foto">Foto :</label>
                                          <input type="file" id="foto" name="foto" class="form-control">
                                          <span class="text-danger">* Kosongi jika tidak ingin mengganti foto</span><br>
                                          <span class="text-danger">* The photo format must be Png,Jpg,or Jpeg</span>
                                      </div>
                                      <div class="modal-footer justify-content-between" style="border-top: 4px solid rgb(255, 217, 4)">
                                        <button type="button" class="btn btn-light" data-dismiss="modal" style="border: 3px solid rgb(244, 195, 0)">Close</button>
                                        <button type="submit" class="btn btn-light" style="border: 3px solid rgb(75, 245, 1)">Edit</button>
                                      </div>
                                  </form>
                                </div>
                                <!-- /.modal-content -->
                              </div>
                              <!-- /.modal-dialog -->
                          </div>
                          <a href="" class="btn btn-danger" data-toggle="modal" data-target="#hapus{{ $gl->id_gallery }}"><i class="fas fa-trash"></i></a>
                          <div class="modal fade" id="hapus{{ $gl->id_gallery }}">
                              <div class="modal-dialog">
                                <div class="modal-content" style="border: 4px solid rgb(255, 69, 18)">
                                  <div class="modal-header" style="border-bottom: 4px solid rgb(255, 69, 18)">
                                    <h4 class="modal-title">Delete Warning</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <form action="{{ url('hapusfoto/'.$gl->id_gallery) }}" method="get">
                                      @csrf
                                      <div class="modal-body">
                                          <span> Do you really want to delete this "{{ $gl->judul }}"?</span>
                                      </div>
                                      <div class="modal-footer justify-content-between" style="border-top: 4px solid rgb(255, 69, 18)">
                                        <button type="button" class="btn btn-light" data-dismiss="modal" style="border: 3px solid rgb(244, 195, 0)">Close</button>
                                        <button type="submit" class="btn btn-light" style="border: 3px solid rgb(255, 31, 2)">Delete</button>
                                      </div>
                                  </form>
                                </div>
                                <!-- /.modal-content -->
                              </div>
                              <!-- /.modal-dialog -->
                          </div>
                      </h3>
    
                      <div class="timeline-body">
                        <div class="embed-responsive">
                          <a href="{{ asset('foto/'.$gl->foto) }}" data-toggle="lightbox" data-title="{{ $fb->judul }}" data-gallery="gallery">
                            <img src="{{ asset('foto/'.$gl->foto) }}" alt="" width="350" height="250" class="img-fluid">
                          </a>
                        </div>
                      </div>
                      <div class="timeline-footer">
                        <p>{{ $gl->deskripsi }}</p>
                      </div>
                    </div>
                  </div>
                @endforeach
                
                <!-- END timeline item -->
                <div>
                  <i class="fas fa-clock bg-gray"></i>
                </div>
              </div>
            </div>
            <!-- /.col -->
          </div>
        </div>
        <!-- /.timeline -->
  
      </section>
      <!-- /.content -->
@endsection