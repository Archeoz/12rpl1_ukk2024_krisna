@extends('admin.master')
@section('admincontent')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">  
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">User Data List</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <!-- Check all button -->
                <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="far fa-square"> Check All</i>
                </button>
                <form action="{{ url('edituserdata') }}" method="post">
                    @csrf
                    <table id="example1" class="table table-bordered table-striped mailbox-messages">
                        <thead>
                        <tr>
                          <th>Checkbox</th>
                          <th>No</th>
                          <th>Username</th>
                          <th>Email</th>
                          <th>Role</th>
                          <th>Status</th>
                        </tr>
                        </thead>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($user as $u)
                        <tbody>
                          <tr>
                            <td>
                              <div class="icheck-primary">
                                  <input type="checkbox" name="id[]" value="{{ $u->id }}" id="check{{ $u->id }}">
                                  <label for="check{{ $u->id }}"></label>
                                </div>
                            </td>
                            <td>{{ $no++ }}</td>
                            <td>{{ $u->username }}</td>
                            <td>{{ $u->email }}</td>
                            <td>{{ $u->role }}</td>
                            <td>
                              @if ($u->status == "active")
                                <a class="btn btn-success btn-sm">Active</a>
                              @elseif($u->status == "pending")
                                <a class="btn btn-secondary btn-sm">Pending</a>
                              @elseif($u->status == "blocked")
                                <a class="btn btn-danger btn-sm">Blocked</a>
                              @endif
                            </td>
                          </tr>
                        </tbody>
                        @endforeach
                        
                        <tfoot>
                        <tr>
                            <th colspan="6" style="text-align: right">
                                <button type="submit" class="btn btn-success btn-sm" name="status" value="active">Active</button>
                                <button type="submit" class="btn btn-secondary btn-sm" name="status" value="pending">Pending</button>
                                <button type="submit" class="btn btn-danger btn-sm" name="status" value="blocked">Blocked</button>
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