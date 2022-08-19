  @extends('admin.template.navbar')
  @section('title') {{'Category'}} @endsection
  @section('css')
  <style>
    #categoryTable_length,#categoryTable_filter{
      padding: 20px;
    }
  </style>
      
  @endsection
  @section('content')
    <div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <h6 class="h2 text-white d-inline-block mb-0">Google maps</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="#">Maps</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Google maps</li>
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
    <!-- Page content -->
    {{-- add-modal --}}
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title text-center" id="exampleModalLabel">Add Category</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="" id="add-category">
              <div class="form-group">
                <label for="category name">Category</label>
                <input type="text" name="category_name" id="category_name" class="form-control">
                <small id="error"></small>
              </div>
              <div class="form-group">
                <label for="category description">Category Description</label>
                <input type="text" name="category_description" id="category_description" class="form-control">
                <small id="error_des"></small>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="save_category">Save</button>
          </div>
        </div>
      </div>
    </div>
    {{-- end-add-modal --}}

    {{-- view-modal --}}

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
                <ul id="viewText" style="list-style: '- ';margin-top:28%">
                  
                </ul>
               

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>


    {{-- end-view-modal --}}

    {{-- edit-modal --}}

    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title text-center" id="editModalLabel">Add Category</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="" id="update-category" enctype="multipart/form-data">
              <div class="form-group">
                <label for="category name">Category</label>
                <input type="text" name="category_name" id="edit_category_name" class="form-control">
                <small id="edit_error"></small>
              </div>
              <div class="form-group">
                <label for="category description">Category Description</label>
                <input type="text" name="category_description" id="edit_category_description" class="form-control">
                <input type="hidden" name="id" id="update_id">
                <small id="eidt_error_des"></small>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="update_category">Update</button>
          </div>
        </div>
      </div>
    </div>

    {{-- end-edit-modal --}}

    {{-- delete-model --}}
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title text-center" id="exampleModalLabel">Delete Category</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <h3 id="data-delete" class="text-center"></h3>
            <input type="hidden" name="" id="deleteId">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-danger" id="delete_category">Delete</button>
          </div>
        </div>
      </div>
    </div>
    {{-- end-delete-modal --}}

    <div class="container-fluid mt--6">
      <div class="row">
        <div class="col">
          <div class="card border-0">
            <table class="table table-hover table-bordered" id="categoryTable">
              <thead>
                <tr>
                  <th scope="col">ID</th>
                  <th scope="col">Category</th>
                  <th scope="col">Description</th>
                  <th scope="col">Created_at</th>
                  <th scope="col">Updated_at</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>

              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  @endsection
  @push('scripts')
  <script>
    $(document).ready(function () {
      fetchCategory();
      function fetchCategory(){
        var table = $('#categoryTable').DataTable({
            processing: true,
            serverSide: true,
            destroy:true,
            ajax: "{{ route('fetch.category') }}",

            columns: [
                {data: 'category_id', name: 'category_id'},
                {data: 'category_name', name: 'category_name'},
                {data: 'category_description', name: 'category_description'},
                {data: 'created_at', name: 'created_at'},
                {data: 'updated_at', name: 'updated_at'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            columnDefs: [ {
              targets: [1,2],
              render: function ( data, type, row ) {
                return data.length > 10 ? data.substr( 0, 10 ) +'…' : data;
              }
          }]
            
      });
      }
      

    $(document).on('click','#save_category', function (e) {
      e.preventDefault();
      const data = {
        'category_name': $('#category_name').val(),
        'category_description': $('#category_description').val()
      }

      $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

      $.ajax({
        type: "POST",
        url: "add.category",
        data: data,
        dataType: "JSON",
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
          fetchCategory();
        }
      });

      
    });

    $(document).on('click','#delete', function () {
      $('#deleteModal').modal('show');
      const id = $(this).attr('data-id');
      $.ajax({
        type: "GET",
        url: "get.delete/"+id,
        dataType: "JSON",
        success: function (response) {
          if(response.status === 'success'){
            $('#deleteId').val(response.category[0].category_id);
            $('#data-delete').html('<small style="font-size:20px">Are you sure to delete <strong>'+response.category[0].category_name+ '</strong> category?</small>');

          }
          
        }
      });
      
    });

    $(document).on('click','#delete_category', function () {
      const id = $('#deleteId').val();
      const data = {"_token": "{{ csrf_token() }}"};
      $.ajax({
        type: "DELETE",
        url: "delete.category/"+id,
        data: data,
        dataType: "JSON",
        success: function (response) {
          console.log(response)
          if(response.status === 'success'){
            $('#deleteModal').modal('hide');
            $('#block-alert').removeClass('d-none');
            $('#text-message').html(response.message);
            $('#block-alert').fadeIn(1000).fadeOut(5000);
            fetchCategory();
          }
          
        }
      });
      
    });

    $(document).on('click','#edit', function () {
      $('#editModal').modal('show');
      const id = $(this).attr('data-id');
      $.ajax({
        type: "GET",
        url: "get_edit.category/"+id,
        dataType: "JSON",
        success: function (response) {
          if(response.status === 'success'){
            console.log(response)
            $('#edit_category_name').val(response.category[0].category_name);
            $('#edit_category_description').val(response.category[0].category_description);
            $('#update_id').val(response.category[0].category_id);
          }
          
        }
      });
      
    });

   $(document).on('click','#update_category', function (e) {
      e.preventDefault();
      const data = {
        "category_name": $('#edit_category_name').val(),
        "category_description": $('#edit_category_description').val(),
        "id" : $('#update_id').val(),
        "_token": "{{ csrf_token() }}",
      }
    //   const data = new FormData(this);
     
      $.ajax({
        type: "PUT",
        url: "{{route('update.category')}}",
        data: data,
        dataType: "JSON",
        success: function (response) {
          console.log(response)
          var error = $('#edit_error');
          var error_des = $('#edit_error_des');
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
          }else if(response.status === 'min_max_des'){
            error_des.addClass('text-danger');
            error_des.html(response.message);
          } 
          fetchCategory();
          console.log(response)
          
        }
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

    $(document).on('click','#categoryTable td:not(td:last-child)', function (e) {
      e.preventDefault();
      var id=parseInt($(this).closest('tr').children('td:first').text());
      const modal = $('#viewModal').modal('show');
      $.ajax({
        type: "GET",
        url: "view.category/"+id,
        dataType: "JSON",
        success: function (response) {
          var category_name = response.category[0].category_name;

          var image = $('#viewImage')[0].src= ((category_name.indexOf('.jpg') >= 0) ? 'assets/img/upload/category_image/'+response.category[0].category_image : ('assets/img/upload/category_image/category_avatar.png'));
          var detail = $('#viewText');
          $('.modal-title').text(response.category[0].category_name);
          var text = response.category[0];
          var created_at = new Date(response.category[0].created_at);
          var updated_at = new Date(response.category[0].updated_at);
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