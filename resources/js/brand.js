$(document).ready(function () {
    fetchBrand();
    function fetchBrand(){
      var table = $('#brandTable').DataTable({
          processing: true,
          serverSide: true,
          destroy:true,
          ajax: "{{ route('fetch.brand') }}",

          columns: [
              {data: 'brand_id', name: 'brand_id'},
              {data: 'image', name: 'image'},
              {data: 'brand_name', name: 'brand_name'},
              {data: 'brand_description', name: 'brand_description'},
              {data: 'created_at', name: 'created_at'},
              {data: 'updated_at', name: 'updated_at'},
              {data: 'action', name: 'action', orderable: false, searchable: false},
          ],
          columnDefs: [ {
            targets: [2,3],
            render: function ( data, type, row ) {
              return data.length > 10 ? data.substr( 0, 10 ) +'…' : data;
            }
        }]
          
    });
    }

    $('input[type="file"][name="brand_image"]').val('');
          //Image preview
          $('input[type="file"][name="brand_image"]').on('change', function(){
              var img_path = $(this)[0].value;
              var img_holder = $('.img-holder');
              var extension = img_path.substring(img_path.lastIndexOf('.')+1).toLowerCase();
              if(extension == 'jpeg' || extension == 'jpg' || extension == 'png'){
                   if(typeof(FileReader) != 'undefined'){
                        img_holder.empty();
                        var reader = new FileReader();
                        reader.onload = function(e){
                            $('<img/>',{'src':e.target.result,'class':'img-fluid','style':'max-width:100px;margin-bottom:10px;'}).appendTo(img_holder);
                        }
                        img_holder.show();
                        reader.readAsDataURL($(this)[0].files[0]);
                   }else{
                       $(img_holder).html('This browser does not support FileReader');
                   }
              }else{
                  $(img_holder).empty();
              }
          });

    $(document).on('submit','#add-brand', function (e) {
      e.preventDefault();
      const data = new FormData(this);
      $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
      $.ajax({
        type: "POST",
        url: "{{route('add.brand')}}",
        data: data,
        dataType: "JSON",
        processing:false,
        contentType:false,
        success: function (response) {
          console.log(response);
          fetchBrand();
        }
      });
      
    });
  });