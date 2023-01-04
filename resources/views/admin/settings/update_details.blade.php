@extends('admin.layout.layout')
@section('content')
<div class="main-panel">
  <div class="content-wrapper">
    <div class="row">
      <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Update Details</h4>
       
            @if ($errors->any())
              <div class="alert alert-danger">
                <ul>
                  @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
              @endif
            <form class="forms-sample" method="post" action="{{ url('admin/update-details') }}" enctype="multipart/form-data">

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
                <label>Name</label>
                <input type="text" class="form-control" value="{{ $adminDetails['name'] }}" name="name">
              </div>

              <div class="form-group">
                <label>Mobile</label>
                <input type="text" class="form-control" value="{{ $adminDetails['mobile'] }}" name="mobile" >
              </div>

              <div class="form-group">
                <label>Image</label><br>
                <img src="{{ auth()->guard('admin')->user()->image_path }}"  style="width: 100px" class="img-thumbnail image-preview" alt="">
                <input type="file" class="image form-control" name="image"  accept="image/png, image/jpeg">
              </div>

              <button type="submit" class="btn btn-primary mr-2">Submit</button>
              <button type="reset" class="btn btn-light">Cancel</button>
            </form>
          </div>
        </div>
      </div>

    </div>

    @endsection