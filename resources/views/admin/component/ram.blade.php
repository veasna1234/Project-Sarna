@extends('admin.template.navbar')
  @section('title') {{'RAMs'}} @endsection
  @section('content')
  <!-- Main content -->
    <!-- Header -->
    <!-- Header -->
    {{-- view modal --}}
    <div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="height: 500px;">
          <div class="modal-header">
            <h5 class="modal-title text-center" id="viewModalLabel" style="margin-left: 40%;margin-bottom:20px;">View RAM</h5>
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
                <ul id="viewText" style="list-style: '- '">
                  
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    {{-- end view modal --}}


    {{-- add model --}}
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title text-center" id="exampleModalLabel">Add RAM</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="" method="post" id="add-ram" enctype="multipart/form-data">
              <div class="form-group">
                <label for="ram name">RAM</label>
                <input type="text" name="ram_name" id="ram_name" class="form-control">
                <small id="error"></small>
              </div>
              <div class="form-group">
                <label for="ram size">RAM Size</label>
                <input type="text" name="ram_size" id="ram_size" class="form-control">
                <small id="error_size"></small>
              </div>
              <div class="form-group">
                <label for="ram description">RAM Description</label>
                <input type="text" name="ram_description" id="ram_description" class="form-control">
                <small id="error_des"></small>
              </div>
              <div class="form-group">
                <label for="ram image">Image</label>
                <input type="file" name="ram_image" id="ram_image" class="form-control">
                <small id="error_des"></small>
              </div>
              <div class="img-holder"></div>
              <button type="button" class="btn btn-secondary float-right" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary float-right mr-3" id="save_ram">Save</button>
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
            <h5 class="modal-title text-center" id="deleteModalLabel">Delete RAM</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
              <div id="data-delete" class="mb-4 mt-0"></div>
              <input type="hidden" name="deleteId" id="deleteId">
              <button type="button" class="btn btn-secondary float-right" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-danger float-right mr-2" id="delete_ram">Delete</button>

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

    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title text-center" id="editModalLabel">Edit ram</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="" method="PUT" id="edit-form" enctype="multipart/form-data">
              <div class="form-group">
                <label for="ram name">RAM</label>
                <input type="text" name="edit_ram_name" id="edit_ram_name" class="form-control">
                <small id="edit_error"></small>
              </div>
              <div class="form-group">
                <label for="ram name">RAM Size</label>
                <input type="text" name="edit_ram_size" id="edit_ram_size" class="form-control">
                <small id="edit_error"></small>
              </div>
              <div class="form-group">
                <label for="ram description">RAM Description</label>
                <input type="text" name="edit_ram_description" id="edit_ram_description" class="form-control">
                <input type="hidden" name="edit_id" id="edit_id">
                <small id="edit_error_des"></small>
              </div>
              <div class="form-group">
                <label for="ram image">Image</label>
                <input type="file" name="edit_ram_image" id="edit_ram_image" class="form-control">
                <small id="error_file"></small>
               
              </div>
              <div class="img-holder-edit"></div>
              <button type="button" class="btn btn-secondary float-right" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary float-right mr-3" id="edit_ram">Save</button>
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
              <h3 class="mb-0">RAM</h3>
            </div>
            <!-- Light table -->
            <div class="table-responsive">
              <table class="table align-items-center table-responesive table-hover table-bordered" id="ramTable">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Image</th>
                    <th scope="col">ram</th>
                    <th scope="col">ram size</th>
                    <th scope="col">ram Description</th>
                    <th scope="col">Create At</th>
                    <th scope="col">Update At</th>
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
    fetchRAM();
    function fetchRAM(){
      var table = $('#ramTable').DataTable({
          processing: true,
          serverSide: true,
          destroy:true,
          ajax: "{{ route('fetch.ram') }}",

          columns: [
              {data: 'ram_id', name: 'ram_id'},
              {data: 'image', name: 'image'},
              {data: 'ram_name', name: 'ram_name'},
              {data: 'ram_size', name: 'ram_size'},
              {data: 'ram_description', name: 'ram_description'},
              {data: 'created_at', name: 'created_at'},
              {data: 'updated_at', name: 'updated_at'},
              {data: 'action', name: 'action', orderable: false, searchable: false},
          ],
          columnDefs: [ {
            targets: [2,4],
            render: function ( data, type, row ) {
              return data.length > 10 ? data.substr( 0, 10 ) +'…' : data;
            }
        }]
          
    });
    }

    $('input[type="file"][name="ram_image"]').val('');
          $('input[type="file"][name="ram_image"]').on('change', function(){
              var img_path = $(this)[0].value;
              var img_holder = $('.img-holder');
              var extension = img_path.substring(img_path.lastIndexOf('.')+1).toLowerCase();
              if(extension == 'jpeg' || extension == 'jpg' || extension == 'png'){
                   if(typeof(FileReader) != 'undefined'){
                        img_holder.empty();
                        var reader = new FileReader();
                        reader.onload = function(e){
                            $('<img/>',{'src':e.target.result,'class':'img-fluid','style':'max-width:200px;margin-bottom:10px;'}).appendTo(img_holder);
                        }
                        img_holder.show();
                        reader.readAsDataURL($(this)[0].files[0]);
                   }else{
                       $(img_holder).html('This browser does not support FileReader');
                   }
              }else{
                  $(img_holder).html('<small class="text-danger">Allow file jpeg, jpg and png</small>');
              }
          });

   $(document).on('submit','#add-ram', function (e) {
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
        url: "{{route('add.ram')}}",
        data: data,
        dataType: "JSON",
        processData:false,
        contentType:false,
        success: function (response) {
          var error = $('#error');
          var error_des = $('#error_des');
          error.html('');
          error_des.html('');
          if(response.status === 'empty'){
            error.addClass('text-danger');
            error_des.addClass('text-danger');
            error.html(response.message);
            error_des.html(response.message);
          }else if(response.status === 'min_max'){
            error_des.addClass('text-danger');
            error.addClass('text-danger');
            error.html(response.message);
            error_des.html(response.message);
          }else if(response.status === 'success'){
            $('#block-alert').removeClass('d-none');
            $('#text-message').html(response.message);
            $('#block-alert').fadeIn(1000).fadeOut(5000);
            $('#add-category').trigger('reset');
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
          }else if(response.status === 'min_max_des'){
            error_des.addClass('text-danger');
            error_des.html(response.message);
          } 
          $(':input[type="submit"]').prop('disabled', false);
          $('#add-ram').trigger('reset');
          fetchRAM();
        }
      });
      
    });
    $(document).on('click','#delete', function (e) {
      e.preventDefault();
      $('#deleteModal').modal('show');
      const id = $(this).attr('data-id');
      $.ajax({
        type: "GET",
        url: "get.delete_ram/"+id,
        dataType: "JSON",
        success: function (response) {
          if(response.status === 'success'){
            $('#deleteId').val(response.ram[0].ram_id);
            $('#data-delete').html('<small  style="font-size:20px;">Are you sure to delete <strong>'+response.ram[0].ram_name+ '</strong> ram?</small>');

          }
          
        }
      });
      
    });

    $(document).on('click','#delete_ram', function (e) {
      e.preventDefault();
      const id = $('#deleteId').val();
      const data = {"_token": "{{ csrf_token() }}"};
      $.ajax({
        type: "DELETE",
        url: "delete.ram/"+id,
        data: data,
        dataType: "JSON",
        success: function (response) {
          if(response.status === 'success'){
            $('#deleteModal').modal('hide');
            $('#block-alert').removeClass('d-none');
            $('#text-message').html(response.message);
            $('#block-alert').fadeIn(1000).fadeOut(5000);
            fetchRAM();
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
        url: "get_edit.ram/"+id,
        dataType: "JSON",
        success: function (response) {
          if(response.status === 'success'){
            console.log(response)
            $('#edit_ram_name').val(response.ram[0].ram_name);
            $('#edit_ram_description').val(response.ram[0].ram_description);
            $('#edit_id').val(response.ram[0].ram_id);
            $('#edit_ram_size').val(response.ram[0].ram_size);
            $('.img-holder-edit').html((response.ram[0].ram_image.indexOf('.jpg') >=0) ? ('<img src=assets/img/upload/ram_image/'+response.ram[0].ram_image+' style="margin-bottom:20px;max-width:200px;"></img>') : '' );
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
        url: "{{route('update.ram')}}",
        data: data,
        dataType: "JSON",
        processData: false,
        contentType: false,
        success: function (response) {
          var enable = $(':input[type="submit"]').prop('disabled', false);
          console.log(response)
          var error = $('#edit_error');
          var error_des = $('#edit_error_des');
          var error_file = $('#error_file');
          error.html('');
          error_des.html('');
          if(response.status === 'empty'){
            error.addClass('text-danger');
            error_des.addClass('text-danger');
            error.html(response.message);
            error_des.html(response.message);
            enable;
          }else if(response.status === 'min_max'){
            error_des.addClass('text-danger');
            error.addClass('text-danger');
            error.html(response.message);
            error_des.html(response.message);
            enable;
          }else if(response.status === 'success'){
            $('#block-alert').removeClass('d-none');
            $('#text-message').html(response.message);
            $('#block-alert').fadeIn(1000).fadeOut(5000);
            $('#add-brand').trigger('reset');
            $('#editModal').modal('hide');
            enable;
          fetchRAM();
          }else if(response.status === 'empty_name'){
            error.addClass('text-danger');
            error.html(response.message);
            enable;
          }else if(response.status === 'empty_des'){
            error_des.addClass('text-danger');
            error_des.html(response.message);
            enable;
          }else if(response.status === 'min_max_name'){
            error.addClass('text-danger');
            error.html(response.message);
            enable;
          }else if(response.status === 'min_max_des'){
            error_des.addClass('text-danger');
            error_des.html(response.message);
            enable;
          }else if(response.status === 'wrong_file'){
           error_file.addClass('text-danger');
            error_file.html(response.message);
            enable;

          }
          
        }
      });

    });
//to make text uppercase

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

    $(document).on('click','#ramTable td:not(td:last-child)', function (e) {
      e.preventDefault();
      var id=parseInt($(this).closest('tr').children('td:first').text());
      const modal = $('#viewModal').modal('show');
      $.ajax({
        type: "GET",
        url: "view.ram/"+id,
        dataType: "JSON",
        success: function (response) {
          console.log(response)
          var ram_image = response.ram[0].ram_image;

          var image = $('#viewImage')[0].src= ((ram_image.indexOf('.jpg') >= 0) ? 'assets/img/upload/ram_image/'+response.ram[0].ram_image : ('assets/img/upload/ram_image/ram_avatar.png'));
          var detail = $('#viewText');
          $('.modal-title').text(response.ram[0].ram_name);
          var text = response.ram[0];
          var created_at = new Date(response.ram[0].created_at);
          var updated_at = new Date(response.ram[0].updated_at);
          $.each(text,function(index, value){
            
            if(index == 'created_at' || index == 'updated_at'){
               return 0;
            }
            detail.append('<li class="mb-3"><b>'+ucfirst(index.replace(new RegExp('_', 'g')," ")+'</b> : '+value+'</li>'));
            
          })

          detail.append('<li class="mb-3"><b>Create at</b> : '+format_date(created_at)+'</li>')
          detail.append('<li><b>Update at</b> : '+format_date(updated_at)+'</li>')

          
        }
      });

      if(!$('#viewModal').hasClass('show')){
        $('#viewText').html('');
      }

      
    });


  });
      </script>
  @endpush