
    @extends('admin.template.navbar')
    @section('title') {{'Icons'}} @endsection
    @section('content')
    <div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <h6 class="h2 text-white d-inline-block mb-0">Icons</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="#">Components</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Icons</li>
                </ol>
              </nav>
            </div>
            <div class="col-lg-6 col-5 text-right">
              <a href="#" class="btn btn-sm btn-neutral">New</a>
              <a href="#" class="btn btn-sm btn-neutral">Filters</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid w-100 mt--6">
      <div class="row justify-content-center">
          <div class="card w-100">
            <div class="card-header bg-transparent">
              <h3 class="mb-0">Icons</h3>
            </div>
            <div class="card-body">
              <table class="table table-hover table-bordered table-responsive" id="productTable">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Image</th>
                    <th scope="col">Category</th>
                    <th scope="col">Brand</th>
                    <th scope="col">Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Processor</th>
                    <th scope="col">HHD</th>
                    <th scope="col">RAM</th>
                    <th scope="col">Screen Size</th>
                    <th scope="col">OS</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($products as $product)
                  <tr>
                    <th scope="row">1</th>
                    <td></td>
                    <td>{{$product->category_id}}</td>
                    <td>{{$product->brand_id}}</td>
                    <td>{{ Str::limit($product->product_name, 10) }}</td>
                    <td>{{number_format($product->product_price)}}</td>
                    <td>{{$product->processor_id}}</td>
                    <td>{{$product->storage_id}}</td>
                    <td>{{$product->ram_id}}</td>
                    <td>{{$product->screen_size}}</td>
                    <td>{{$product->os_id}}</td>
                    <td>
                      <button data-id={{$product->id}} type="button" class="btn btn-sm btn-outline-warning"><i class="fa fa-edit fa-fw"></i>Edit</button>
                    <button data-id={{$product->id}} type="button" class="btn btn-sm btn-outline-danger"><i class="fa fa-trash fa-fw"></i>Delete</button>

                    </td>
                    
                  </tr>
                   @endforeach
                </tbody>
              </table>
            </div>
          </div>
      </div>
    </div>
  </div>
  @endsection
  @push('scripts')
    <script>
      $(document).ready( function () {
    $('#productTable').DataTable();
} );

    </script>
  @endpush