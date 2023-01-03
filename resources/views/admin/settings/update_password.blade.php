@extends('admin.layout.layout')
@section('content')
<div class="main-panel">
  <div class="content-wrapper">
    <div class="row">
      <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Update Password</h4>
            @if(Session::has('error'))
              <div class="alert alert-danger" role="alert">
                Error : {{ Session::get('error') }}
              </div>
            @endif

            @if(Session::has('success'))
              <div class="alert alert-success" role="alert">
                Success : {{ Session::get('success') }}
              </div>
            @endif
            <form class="forms-sample" method="post" action="{{ url('admin/update-password') }}">

              @csrf
              <div class="form-group">
                <label>Email</label>
                <input type="text" class="form-control" value="{{ $adminDetails['email'] }}" readonly>
              </div>

              <div class="form-group">
                <label>Admin Type</label>
                <input type="text" class="form-control" value="{{ ucfirst( $adminDetails['type'] ) }}" readonly>
              </div>

              <div class="form-group">
                <label>Current Password</label>
                <input type="password" class="form-control" id="current_password" name="current_password">
                <span id="check_password_msg"></span>
              </div>
              <div class="form-group">
                <label>New Password</label>
                <input type="password" class="form-control" name="new_password">
              </div>

              <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" class="form-control" name="confirm_password">
              </div>

              <button type="submit" class="btn btn-primary mr-2">Submit</button>
              <button type="reset" class="btn btn-light">Cancel</button>
            </form>
          </div>
        </div>
      </div>

    </div>

    @endsection