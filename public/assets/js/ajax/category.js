
    
//     var table = $('#categoryTable').DataTable({
//       processing: true,
//       serverSide: true,
//       ajax: "{{ !! route('admin.fetch.category') !! }}",

//       columns: [
//           {data: 'category_name', name: 'category_name'},
//           {data: 'category_description', name: 'category_description'},
//           {data: 'action', name: 'action', orderable: false, searchable: false},
//       ]

//   });
var table = $('#categoryTable').DataTable({
    processing: true,
    serverSide: true,
    ajax: "{{ route('fetch.category') }}",

    columns: [
        {data: 'category_id', name: 'category_id'},
        {data: 'category_name', name: 'category_name'},
        {data: 'category_description', name: 'category_description'},
        {data: 'action', name: 'action', orderable: false, searchable: false},
    ]

});

    // $(document).on('click','#category_save', function () {
    //     const data = {
    //         'category_name': $('#category_name').val(),
    //         'category_description': $('#category_description').val(),
    //     }
    //     $.ajax({
    //         type: "POST",
    //         url: "add.student",
    //         data: data,
    //         dataType: "JSON",
    //         success: function (response) {
                
    //         }
    //     });

        
