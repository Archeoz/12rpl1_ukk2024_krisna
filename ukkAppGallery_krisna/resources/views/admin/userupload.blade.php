@extends('admin.master')
@section('admincontent')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">  
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">User Upload List</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <!-- Check all button -->
                <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="far fa-square"> Check All</i>
                </button>
                <form action="{{ url('edituserupload') }}" method="post">
                    @csrf
                    <table id="example1" class="table table-bordered table-striped mailbox-messages">
                        <thead>
                        <tr>
                          <th>Checkbox</th>
                          <th>No</th>
                          <th>Username</th>
                          <th>Role</th>
                          <th>Judul</th>
                          <th>Deskripsi</th>
                          <th>Foto</th>
                          <th>Status</th>
                        </tr>
                        </thead>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($upload as $upl)
                        <tbody>
                          <tr>
                            <td>
                              <div class="icheck-primary">
                                  <input type="checkbox" name="id_gallery[]" value="{{ $upl->id_gallery }}" id="check{{ $upl->id_gallery }}">
                                  <label for="check{{ $upl->id_gallery }}"></label>
                                </div>
                            </td>
                            <td>{{ $no++ }}</td>
                            <td>{{ $upl->username }}</td>
                            <td>{{ $upl->role }}</td>
                            <td>{{ $upl->judul }}</td>
                            <td>{{ $upl->deskripsi }}</td>
                            <td>
                              <a href="{{ asset('foto/'.$upl->foto) }}" data-toggle="lightbox" data-title="adshad" data-gallery="gallery" >
                                  <img src="{{ asset('foto/'.$upl->foto) }}" alt="" width="100" height="80" class="img-fluid">
                            </td>
                            <td>
                              @if ($upl->status == "accept")
                                <a class="btn btn-success btn-sm">Accept</a>
                              @elseif($upl->status == "pending")
                                <a class="btn btn-secondary btn-sm">Pending</a>
                              @elseif($upl->status == "declined")
                                <a class="btn btn-danger btn-sm">Declined</a>
                              @endif
                            </td>
                          </tr>
                        </tbody>
                        @endforeach
                        <tfoot>
                        <tr>
                            <th colspan="8" style="text-align: right">
                                <button type="submit" class="btn btn-success btn-sm" name="status" value="accept">Accept</button>
                                <button type="submit" class="btn btn-secondary btn-sm" name="status" value="pending">Pending</button>
                                <button type="submit" class="btn btn-danger btn-sm" name="status" value="declined">Declined</button>
                            </th>
                        </tr>
                        </tfoot>
                      </table>
                </form>
                  
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
      </section>
      <!-- /.content -->
@endsection