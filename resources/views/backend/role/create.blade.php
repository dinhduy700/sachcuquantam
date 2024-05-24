@extends('backend.index')

@section('backend-content-wrapper')
<div class="container-fluid role-add-wrapper">
  <div class="row">
    <div class="col-12">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="javascript:void(0)">Roles</a></li>
          <li class="breadcrumb-item"><a href="javascript:void(0)">All Roles</a></li>
          <li class="breadcrumb-item active" aria-current="page">Add Role</li>
        </ol>
      </nav>
    </div>

    <div class="col-12 d-inline-flex justify-content-between align-items-center mb-4" id="fix-header-content">
      <div class="content-title">
        <h2>Add Role</h2>
      </div>

      <div class="content-btn d-flex align-items-center">
        <div class="btn-group">
          <a href="{{ route('admin.roles.create') }}" class="btn btn-primary text-white">
            {{ __('app.save') }}
          </a>
        </div>
      </div>
    </div>
  </div>

  <form id="role-add-form" method="post">
    <div class="row">
      <div class="col-12">
        <div class="card store-view-wrapper">
          <div class="card-body">
            <div class="form-group row">
              <label class="col-sm-2 col-form-label field-required">
                Store View:
              </label>

              <div class="col-sm-10 text-end">
                <select id="selectLanguage" class="form-select">
                  <option value="en">English</option>
                  <option value="vi">Vietnamese</option>
                </select>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-12 col-lg-8">
        <div class="card">
          <div class="card-header">
            Role Information
          </div>
      
          <div class="card-body">
            <div class="form-group row">
              <label class="col-sm-2 col-form-label field-required">
                Name:<sup>*</sup>
              </label>

              <div class="col-sm-10 text-end">
                <input type="text" id="inputName" class="form-control" value="">
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-12 col-lg-4">
        <div class="box">
          <ul class="checktree">
            <li>
              <input id="dashboard" type="checkbox" />
              <label>All</label>
              <ul>
                <li>
                  <input id="dashboard" type="checkbox" />
                  <label>Dashboard</label>
                </li>

                <li>
                  <input id="category" type="checkbox" />
                  <label>Manager Categories</label>
                  <ul>
                    <li>
                      <input id="newCategory" type="checkbox" />
                      <label>New</label>
                    </li>
                    <li>
                      <input id="editCategory" type="checkbox" />
                      <label>Edit</label>
                    </li>
                  </ul>
                </li>

                <li>
                  <input id="vicepresident" type="checkbox" />
                  <label>Demo 2</label>

                  <ul>
                    <li>
                      <input id="1" type="checkbox" />
                      <label>1</label>
                    </li>
                    <li>
                      <input id="2" type="checkbox" />
                      <label>2</label>
                    </li>
                    <li>
                      <input id="3" type="checkbox" />
                      <label>3</label>
                    </li>
                  </ul>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </form>
</div>
@endsection

@push('styles')
<style>
.box {
  padding: 5%;
  background: #fff;
  border-radius: 2px;
  border: 1px solid rgba(0,0,0,.125);
}

.checktree ul {
  margin-left: 10px;
  padding-left: 20px;
}

.checktree li {
  list-style: none;
  font-weight: normal;
}

.checktree input[type='checkbox'] {
  margin-right: 10px;
}

ul {
  list-style-type: none;
  margin: 3px;
}

ul.checktree li:before {
  height: 1em;
  width: 12px;
  border-bottom: 1px dashed;
  content: "";
  display: inline-block;
  top: -0.3em;
}

ul.checktree li {
  border-left: 1px dashed;
}

ul.checktree li:last-child:before {
  border-left: 1px dashed;
}

ul.checktree li:last-child {
  border-left: none;
}
</style>
@endpush

@push('scripts')
<script>
$(':checkbox').on('click', function (event){
  event.stopPropagation();
  var clkCheckbox = $(this),
  chkState = clkCheckbox.is(':checked'),
  parentLiTab = clkCheckbox.closest('li'),
  parentUls = parentLiTab.parents('ul');
  parentLiTab.find(':checkbox').prop('checked', chkState);
  parentUls.each(function(){
    parentUlTab = $(this);
    parentState = (parentUlTab.find(':checkbox').length == parentUlTab.find(':checked').length); 
    parentUlTab.siblings(':checkbox').prop('checked', parentState);
  });
});
</script>
@endpush
