    @extends('admin.template.navbar')
    @section('content')
    <div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <h6 class="h2 text-white d-inline-block mb-0">Upgrade to PRO</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="#">Examples</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Upgrade to pro</li>
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
    <div class="container-fluid mt--6">
      <div class="row mt--5">
        <div class="col-md-10 ml-auto mr-auto">
          <div class="card card-upgrade">
            <div class="card-header text-center border-bottom-0">
              <h4 class="card-title">Argon Dashboard PRO</h4>
              <p class="card-category">Are you looking for more components? Please check our Premium Version of Argon Dashboard.</p>
            </div>
            <div class="card-body">
              <div class="table-responsive table-upgrade">
                <table class="table">
                  <thead>
                    <tr>
                      <th></th>
                      <th class="text-center">Free</th>
                      <th class="text-center">PRO</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>Elements</td>
                      <td class="text-center">100</td>
                      <td class="text-center">200</td>
                    </tr>
                    <tr>
                      <td>Plugins</td>
                      <td class="text-center">4</td>
                      <td class="text-center">16</td>
                    </tr>
                    <tr>
                      <td>Example Pages</td>
                      <td class="text-center">6</td>
                      <td class="text-center">25</td>
                    </tr>
                    <tr>
                      <td>DataTables, VectorMap, SweetAlert, Wizard,<br> jQueryValidation, FullCalendar etc...</td>
                      <td class="text-center"><i class="ni ni-fat-remove text-danger"></i></td>
                      <td class="text-center"><i class="ni ni-check-bold text-success"></i></td>
                    </tr>
                    <tr>
                      <td>Mini Sidebar</td>
                      <td class="text-center"><i class="ni ni-fat-remove text-danger"></i></td>
                      <td class="text-center"><i class="ni ni-check-bold text-success"></i></td>
                    </tr>
                    <tr>
                      <td>Premium Support</td>
                      <td class="text-center"><i class="ni ni-fat-remove text-danger"></i></td>
                      <td class="text-center"><i class="ni ni-check-bold text-success"></i></td>
                    </tr>
                    <tr>
                      <td></td>
                      <td class="text-center">Free</td>
                      <td class="text-center">Just $79</td>
                    </tr>
                    <tr>
                      <td class="text-center"></td>
                      <td class="text-center">
                        <a href="#" class="btn btn-round btn-default disabled">Current Version</a>
                      </td>
                      <td class="text-center">
                        <a target="_blank" href="https://www.creative-tim.com/product/argon-dashboard-pro?ref=ad-update-pro" class="btn btn-round btn-primary">Upgrade to PRO</a>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Footer -->
      <footer class="footer pt-0">
        <div class="row align-items-center justify-content-lg-between">
          <div class="col-lg-6">
            <div class="copyright text-center  text-lg-left  text-muted">
              &copy; 2020 <a href="https://www.creative-tim.com" class="font-weight-bold ml-1" target="_blank">Creative Tim</a>
            </div>
          </div>
          <div class="col-lg-6">
            <ul class="nav nav-footer justify-content-center justify-content-lg-end">
              <li class="nav-item">
                <a href="https://www.creative-tim.com" class="nav-link" target="_blank">Creative Tim</a>
              </li>
              <li class="nav-item">
                <a href="https://www.creative-tim.com/presentation" class="nav-link" target="_blank">About Us</a>
              </li>
              <li class="nav-item">
                <a href="http://blog.creative-tim.com" class="nav-link" target="_blank">Blog</a>
              </li>
              <li class="nav-item">
                <a href="https://github.com/creativetimofficial/argon-dashboard/blob/master/LICENSE.md" class="nav-link" target="_blank">MIT License</a>
              </li>
            </ul>
          </div>
        </div>
      </footer>
    </div>
  </div>
  
  @endsection