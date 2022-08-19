@extends('admin.template.navbar')
  @section('title') {{'Discount'}} @endsection
  @section('content')
  <!-- Main content -->
    <!-- Header -->
    <!-- Header -->
    {{-- view-modal --}}

    <div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="height: 500px;">
          <div class="modal-header">
            <h5 class="modal-title text-center" id="viewModalLabel" style="margin-left: 40%;margin-bottom:20px;">View discount</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button> 
          </div>
          <div class="container">
            <div class="row">
              <div class="col-md-6" >
                <img src="" id="viewImage" width="100%" alt="" style="max-height: 400px">

              </div>
              <div class="col-md-6">
                <ul id="viewText" style="list-style: '- ';margin-top:30px">
                  
                </ul>
               

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    {{-- view-modal --}}
    {{-- add model --}}
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title text-center" id="exampleModalLabel">Add discount</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="" method="post" id="add-discount" enctype="multipart/form-data">
              <div class="form-row">
                <div class="form-group col-md-2">
                 
                  <label for="is_active">Is Active</label>
                  <select name="is_active" id="is_active" class="form-control">
                    <option value="0">False</option>
                    <option value="1">True</option>
                  </select>
                  <small id="error_is_active"></small>
                </div>
              <div class="form-group col-md-5">
                <label for="discount name">discount</label>
                <input type="text" name="discount_name" id="discount_name" class="form-control">
                <small id="error"></small>
              </div>
              <div class="form-group col-md-5">
                <label for="discount Percent">discount Percent</label>
                <input type="text" name="discount_percent" id="discount_percent" class="form-control">
                <small id="error_dis_per"></small>
              </div>
            </div>
              <div class="form-row">
              <div class="form-group col-md-5">
                <label for="discount start">Start</label>
                <input type="date" name="discount_start" id="discount_start" class="form-control">
                <small id="error_dis_start"></small>
              </div>
              <div class="form-group col-md-6">
                <label for="discount end">End</label>
                <input type="date" name="discount_end" id="discount_end" class="form-control">
                <small id="error_dis_end"></small>
              </div>
            </div>
            <div class="form-group">
              <label for="discount description">discount Description</label>
              <input type="text" name="discount_description" id="discount_description" class="form-control">
              <small id="error_des"></small>
            </div>
              <div class="img-holder"></div>
              <button type="button" class="btn btn-secondary float-right" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary float-right mr-3" id="save_discount">Save</button>
            </form>

          </div>
        </div>
      </div>
    </div>
    {{-- edit modal --}}

    {{-- delete-modal --}}
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title text-center" id="deleteModalLabel">Delete discount</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
              <div id="data-delete" class="mb-4 mt-0"></div>
              <input type="hidden" name="deleteId" id="deleteId">
              <button type="button" class="btn btn-secondary float-right" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-danger float-right mr-2" id="delete_discount">Delete</button>

          </div>
        </div>
      </div>
    </div>
    {{-- end-delete-modal --}}

    <div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <h6 class="h2 text-white d-inline-block mb-0">Tables</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="#">Tables</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Tables</li>
                </ol>
              </nav>
            </div>
            <div class="col-lg-6 col-5 text-right">
              <a href="#" class="btn btn-sm btn-neutral" data-toggle="modal" data-target="#exampleModal">New</a>
              <a href="#" class="btn btn-sm btn-neutral">Filters</a>
            </div>
          </div>
        </div>
      </div>
    </div>

    {{-- edit modal --}}

    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editMoLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title text-center" id="editMoLabel">Add discount</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="" method="post" id="edit-form" enctype="multipart/form-data">
              <div class="form-row">
                <div class="form-group col-md-2">
                 
                  <label for="is_active">Is Active</label>
                  <select name="is_active" id="edit_is_active" class="form-control">
                    <option value="0">False</option>
                    <option value="1">True</option>
                  </select>
                  <small id="edit_error_is_active"></small>
                </div>
              <div class="form-group col-md-5">
                <label for="discount name">Discount</label>
                <input type="text" name="discount_name" id="edit_discount_name" class="form-control">
                <small id="edit_error"></small>
              </div>
              <div class="form-group col-md-5">
                <label for="discount Percent">Discount Percent</label>
                <input type="text" name="discount_percent" id="edit_discount_percent" class="form-control">
                <small id="edit_error_dis_per"></small>
              </div>
            </div>
              <div class="form-row">
              <div class="form-group col-md-5">
                <label for="discount start">Start</label>
                <input type="date" name="discount_start" id="edit_discount_start" class="form-control">
                <small id="edit_error_dis_start"></small>
              </div>
              <div class="form-group col-md-6">
                <label for="discount end">End</label>
                <input type="date" name="discount_end" id="edit_discount_end" class="form-control">
                <small id="edit_error_dis_end"></small>
              </div>
            </div>
            <div class="form-group">
              <label for="discount description">discount Description</label>
              <input type="text" name="discount_description" id="edit_discount_description" class="form-control">
              <input type="hidden" name="id" id="edit_id">
              <small id="edit_error_des"></small>
            </div>
              <div class="img-holder"></div>
              <button type="button" class="btn btn-secondary float-right" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary float-right mr-3" id="save_discount">Save</button>
            </form>
           
                

          </div>
        </div>
      </div>
    </div>



    {{-- end-edit-modal --}}
    <!-- Page content -->
    <div class="container-fluid mt--6">
      <div class="row">
        <div class="col">
          <div class="card">
            <!-- Card header -->
            <div class="card-header border-0">
              <h3 class="mb-0">discount</h3>
            </div>
            <!-- Light table -->
            <div class="table-responsive">
              <table class="table align-items-center table-responesive table-hover table-bordered" id="discountTable">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">ID</th>
                    {{-- <th scope="col">Image</th> --}}
                    <th scope="col">discount</th>
                    <th scope="col">discount Description</th>
                    <th scope="col">Is Active</th>
                    <th scope="col">Create At</th>
                    <th scope="col">Start At</th>
                    <th scope="col">End At</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>

                </tbody>
              </table>
            </div>
            <!-- Card footer -->
          </div>
        </div>
      </div>
    </div>
  </div>
  @endsection
@push('scripts')
<script>
    $(document).ready(function () {
      
        fetchdiscount();
    function fetchdiscount(){
      var table = $('#discountTable').DataTable({
          processing: true,
          serverSide: true,
          destroy:true,
          ajax: "{{ route('fetch.discount') }}",

          columns: [
              {data: 'id', name: 'id'},
            //   {data: 'image', name: 'image'},
              {data: 'discount_percent', name: 'discount_percent'},
              {data: 'description', name: 'description'},
              {data: 'active', name: 'active'},
              {data: 'created_at', name: 'created_at'},
              {data: 'started_at', name: 'started_at'},
              {data: 'end_at', name: 'end'},
              {data: 'action', name: 'action', orderable: false, searchable: false},
          ],
          columnDefs: [ {
            targets: 2,
            render: function ( data, type, row ) {
              return data.length > 10 ? data.substr( 0, 10 ) +'…' : data;
            }
        }]
          
    });
    }
   $(document).on('submit','#add-discount', function (e) {
      e.preventDefault();
      $(':input[type="submit"]').prop('disabled', true);
      $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  var data = new FormData(this);
      $.ajax({
        type: "POST",
        url: "{{route('add.discount')}}",
        data: data,
        dataType: "JSON",
        processData:false,
        contentType:false,
        success: function (response) {
          var error_dis_percent = $('#error_dis_per');
          var error_is_active = $('#error_is_active');
          var error = $('#error');
          var error_des = $('#error_des');
          var error_dis_start = $('#error_dis_start');
          var error_date_end = $('#error_dis_end');
          error.html('');
          error_des.html('');
          error_dis_percent.html('');
          error_is_active.html('');
          error_dis_start.html('');
          if(response.status === 'empty'){
            error.addClass('text-danger');
            error_des.addClass('text-danger');
            error_dis_percent.addClass('text-danger');
            error_is_active.addClass('text-danger');
            error.html(response.message);
            error_des.html(response.message);
            error_is_active.html(response.message);
            error_dis_percent.html(response.message);
          }else if(response.status === 'min_max'){
            error_des.addClass('text-danger');
            error.addClass('text-danger');
            error_dis_percent.addClass('text-danger');
            error_is_active.addClass('text-danger');
            error.html(response.message);
            error_des.html(response.message);
            error_is_active.html(response.message);
            error_dis_percent.html(response.message);
          }else if(response.status === 'success'){
            $('#block-alert').removeClass('d-none');
            $('#text-message').html(response.message);
            $('#block-alert').fadeIn(1000).fadeOut(5000);
            $('#add-discount').trigger('reset');
            $('#exampleModal').modal('hide');
          }else if(response.status === 'empty_name'){
            error.addClass('text-danger');
            error.html(response.message);
          }else if(response.status === 'empty_des'){
            error_des.addClass('text-danger');
            error_des.html(response.message);
          }else if(response.status === 'min_max_name'){
            error.addClass('text-danger');
            error.html(response.message);
          }else if(response.message === 'empty_is_active'){
            error_is_active.addClass('text-danger');
            error_is_active.html(response.message);
          }else if(response.message === 'empty_discount_percent'){
            error_dis_percent.addClass('text-danger');
            error_dis_percent.html(response.message);
          }else if(response.status === 'min_max_des'){
            error_des.addClass('text-danger');
            error_des.html(response.message);
          }else if(response.status === 'min_max_discount'){
            error_dis_percent.addClass('text-danger');
            error_dis_percent.html(response.message);
          }else if(response.status === 'start_date_is_biger'){
            error_dis_start.addClass('text-danger');
            error_dis_start.html(response.message);
          }else if(response.status === 'empty_date'){
            error_dis_start.addClass('text-danger');
            error_dis_start.html(response.message);
            error_date_end.addClass('text-danger');
            error_date_end.html(response.message);
          }else if(response.status === 'error_discount'){
            error_dis_percent.addClass('text-danger');
            error_dis_percent.html(response.message);
          }
          fetchdiscount();
          $(':input[type="submit"]').prop('disabled', false);
        }
      });
      
    });
    $.date = function(dateObject) {
    var d = new Date(dateObject);
    var day = d.getDate();
    var month = d.getMonth() + 1;
    var year = d.getFullYear();
    if (day < 10) {
        day = "0" + day;
    }
    if (month < 10) {
        month = "0" + month;
    }
    var date = month + "/" + day + "/" + year;

    return date;
};
    $(document).on('click','#delete', function (e) {
      e.preventDefault();
      $('#deleteModal').modal('show');
      const id = $(this).attr('data-id');
      $.ajax({
        type: "GET",
        url: "get.delete_discount/"+id,
        dataType: "JSON",
        success: function (response) {
          if(response.status === 'success'){
            $('#deleteId').val(response.discount[0].id);
            $('#data-delete').html('<small  style="font-size:20px;">Are you sure to delete <strong>'+response.discount[0].name+ '</strong> discount?</small>');

          }
          
        }
      });
      
    });
    $(document).on('click','#delete_discount', function (e) {
      e.preventDefault();
      const id = $('#deleteId').val();
      const data = {"_token": "{{ csrf_token() }}"};
      $.ajax({
        type: "DELETE",
        url: "delete.discount/"+id,
        data: data,
        dataType: "JSON",
        success: function (response) {
          if(response.status === 'success'){
            $('#deleteModal').modal('hide');
            $('#block-alert').removeClass('d-none');
            $('#text-message').html(response.message);
            $('#block-alert').fadeIn(1000).fadeOut(5000);
            fetchdiscount();
          }
          $('#exampleModal').modal('hide');
          
        }
      });
      
    });
    
    $(document).on('click','#edit', function (e) {
      e.preventDefault();
      $('#editModal').modal('show');
      const id = $(this).attr('data-id');
      $.ajax({
        type: "GET",
        url: "get_edit.discount/"+id,
        dataType: "JSON",
        success: function (response) {
          var start =new Date( response.discount[0].started_at);
          var end =new Date( response.discount[0].end_at);
          if(response.status === 'success'){
            $('#edit_discount_name').val(response.discount[0].name);
            $('#edit_discount_description').val(response.discount[0].description);
            $('#edit_discount_percent').val(response.discount[0].discount_percent);
            $('#edit_is_active').val(response.discount[0].description);
            document.getElementById('edit_discount_start').valueAsDate = new Date(start.setDate(start.getDate()+1));
            document.getElementById("edit_discount_end").valueAsDate = new Date(end.setDate(end.getDate()+1));
            $('#edit_is_active').val(response.discount[0].active)
            $('#edit_id').val(response.discount[0].id);
          }
          
        }
      });
      
    });

    $(document).on('submit','#edit-form', function (e) {
      e.preventDefault();
      $(':input[type="submit"]').prop('disabled', true);
      $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
      var data = new FormData(this);
      $.ajax({
        type: "POST",
        url: "{{route('update.discount')}}",
        data: data,
        dataType: "JSON",
        processData:false,
        contentType:false,
        success: function (response) {
          var error_dis_percent = $('#error_dis_per');
          var error_is_active = $('#error_is_active');
          var error = $('#error');
          var error_des = $('#error_des');
          var error_dis_start = $('#error_dis_start');
          var error_date_end = $('#error_dis_end');
          error.html('');
          error_des.html('');
          error_dis_percent.html('');
          error_is_active.html('');
          error_dis_start.html('');
          if(response.status === 'empty'){
            error.addClass('text-danger');
            error_des.addClass('text-danger');
            error_dis_percent.addClass('text-danger');
            error_is_active.addClass('text-danger');
            error.html(response.message);
            error_des.html(response.message);
            error_is_active.html(response.message);
            error_dis_percent.html(response.message);
          }else if(response.status === 'min_max'){
            error_des.addClass('text-danger');
            error.addClass('text-danger');
            error_dis_percent.addClass('text-danger');
            error_is_active.addClass('text-danger');
            error.html(response.message);
            error_des.html(response.message);
            error_is_active.html(response.message);
            error_dis_percent.html(response.message);
          }else if(response.status === 'success'){
            $('#block-alert').removeClass('d-none');
            $('#text-message').html(response.message);
            $('#block-alert').fadeIn(1000).fadeOut(5000);
            $('#add-category').trigger('reset');
            $('#editModal').modal('hide');
          }else if(response.status === 'empty_name'){
            error.addClass('text-danger');
            error.html(response.message);
          }else if(response.status === 'empty_des'){
            error_des.addClass('text-danger');
            error_des.html(response.message);
          }else if(response.status === 'min_max_name'){
            error.addClass('text-danger');
            error.html(response.message);
          }else if(response.message === 'empty_is_active'){
            error_is_active.addClass('text-danger');
            error_is_active.html(response.message);
          }else if(response.message === 'empty_discount_percent'){
            error_dis_percent.addClass('text-danger');
            error_dis_percent.html(response.message);
          }else if(response.status === 'min_max_des'){
            error_des.addClass('text-danger');
            error_des.html(response.message);
          }else if(response.status === 'min_max_discount'){
            error_dis_percent.addClass('text-danger');
            error_dis_percent.html(response.message);
          }else if(response.status === 'start_date_is_biger'){
            error_dis_start.addClass('text-danger');
            error_dis_start.html(response.message);
          }else if(response.status === 'empty_date'){
            error_dis_start.addClass('text-danger');
            error_dis_start.html(response.message);
            error_date_end.addClass('text-danger');
            error_date_end.html(response.message);
          }else if(response.status === 'error_discount'){
            error_dis_percent.addClass('text-danger');
            error_dis_percent.html(response.message);
          }
          
          $('#add-discount').trigger('reset');
          fetchdiscount();
          $(':input[type="submit"]').prop('disabled', false);
        }
      });

    });
  });

  function ucfirst(str,force){
          str=force ? str.toLowerCase() : str;
          return str.replace(/(\b)([a-zA-Z])/,
                   function(firstLetter){
                      return   firstLetter.toUpperCase();
                   });
     }

     //Date format

     function format_date(date) {
  month=date.getMonth();
  month=month+1; //javascript date goes from 0 to 11
  if (month<10) month="0"+month; //adding the prefix

  year=date.getFullYear();
  day=date.getDate();
  hour=date.getHours();
  minutes=date.getMinutes();
  seconds=date.getSeconds();

  return day+"/"+month+"/"+year+" "+hour+":"+minutes+":"+seconds;

}



    $(document).on('click','#discountTable td:not(td:last-child)', function (e) {
      e.preventDefault();
      var id=parseInt($(this).closest('tr').children('td:first').text());
      const modal = $('#viewModal').modal('show');
      $.ajax({
        type: "GET",
        url: "view.discount/"+id,
        dataType: "JSON",
        success: function (response) {
          var discount_image = response.discount[0].discount_image;

          var image = $('#viewImage')[0].src= 'assets/img/upload/discount_image/discount_avatar.png';
          var detail = $('#viewText');
          // $('.modal-title').text(response.discount[0].name);
          var text = response.discount[0];
          var created_at = new Date(response.discount[0].created_at);
          var updated_at = new Date(response.discount[0].updated_at);
          var start_at = new Date(response.discount[0].started_at);
          var end_at = new Date(response.discount[0].end_at);
          $.each(text,function(index, value){
            
            if(index == 'created_at' || index == 'updated_at' || index == 'started_at' || index == 'end_at'){
               return 0;
            }
            detail.append('<li class="mb-3"><b>'+ucfirst(index.replace(new RegExp('_', 'g')," ")+'</b> : '+value+'</li>'));
            
          })
          detail.append('<li class="mb-3"><b>Stared at</b> : '+format_date(start_at)+'</li>')
          detail.append('<li class="mb-3"><b>End at</b> : '+format_date(end_at)+'</li>')
          detail.append('<li class="mb-3"><b>Create at</b> : '+format_date(created_at)+'</li>')
          detail.append('<li><b>Update at</b> : '+format_date(updated_at)+'</li>')

          
        }
      });

      if(!$('#viewModal').hasClass('show')){
        $('#viewText').html('');
      }

      
    });

    </script>
    
@endpush