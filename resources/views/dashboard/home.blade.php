@extends('dashboard.layouts.app')

@section('title', __('site.home'))

@section('content')
  <div class="content-wrapper">
    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-header row"></div>
        <div class="content-body">
          <!-- Start State -->
          <div class="row">
            <div class="col-xl-3 col-lg-6 col-12">
              <div class="card">
                <div class="card-content">
                  <div class="media align-items-stretch">
                    <div class="p-2 text-center bg-primary bg-darken-2">
                      <i class="icon-camera font-large-2 white"></i>
                    </div>
                    <div class="p-2 bg-gradient-x-primary white media-body">
                      <h5>Products</h5>
                      <h5 class="text-bold-400 mb-0">
                        <i class="ft-plus"></i> 28
                      </h5>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-12">
              <div class="card">
                <div class="card-content">
                  <div class="media align-items-stretch">
                    <div class="p-2 text-center bg-danger bg-darken-2">
                      <i class="icon-user font-large-2 white"></i>
                    </div>
                    <div class="p-2 bg-gradient-x-danger white media-body">
                      <h5>New Users</h5>
                      <h5 class="text-bold-400 mb-0">
                        <i class="ft-arrow-up"></i>1,238
                      </h5>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-12">
              <div class="card">
                <div class="card-content">
                  <div class="media align-items-stretch">
                    <div class="p-2 text-center bg-warning bg-darken-2">
                      <i class="icon-basket-loaded font-large-2 white"></i>
                    </div>
                    <div class="p-2 bg-gradient-x-warning white media-body">
                      <h5>New Orders</h5>
                      <h5 class="text-bold-400 mb-0">
                        <i class="ft-arrow-down"></i> 4,658
                      </h5>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-12">
              <div class="card">
                <div class="card-content">
                  <div class="media align-items-stretch">
                    <div class="p-2 text-center bg-success bg-darken-2">
                      <i class="icon-wallet font-large-2 white"></i>
                    </div>
                    <div class="p-2 bg-gradient-x-success white media-body">
                      <h5>Total Profit</h5>
                      <h5 class="text-bold-400 mb-0">
                        <i class="ft-arrow-up"></i> 5.6 M
                      </h5>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- End State -->
          <!--Product sale & buyers -->
          <div class="row match-height">
            <div class="col-xl-12 col-lg-12">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title">Products Sales </h4>
                  <a class="heading-elements-toggle"
                    ><i class="fa fa-ellipsis-v font-medium-3"></i
                  ></a>
                  <div class="heading-elements">
                    <ul class="list-inline mb-0">
                      <li>
                        <a data-action="reload"><i class="ft-rotate-cw"></i></a>
                      </li>
                      <li>
                        <a data-action="expand"><i class="ft-maximize"></i></a>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="card-content">
                  <div class="card-body">
                    <div id="products-sales" class="height-300"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!--/ Product sale & buyers -->
        </div>
      </div>
    </div>
  </div><!-- end of content wrapper -->
@endsection