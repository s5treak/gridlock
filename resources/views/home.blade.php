@extends('layouts.master')

@section('content')
  
    <div class="container-fluid mt-5">

       
        <div class="page-inner pt-5 mt-3">

          <h2>Welcome back, {{Auth::user()->name}}</h2>
         

            <div class="row mt-5 pt-1">
                <div class="col-sm-6 col-lg-4">
                    <div class="card p-3">
                        <div class="d-flex align-items-center">
                            <span class="stamp stamp-md bg-secondary mr-3">
                              <i class="fa fa-biohazard" style="font-size:20px;"></i>
                            </span>
                            <div>
                                <h5 class="mb-1"><b><a href="#">{{$clients}} <small>Total Clients</small></a></b></h5>
                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="card p-3">
                        <div class="d-flex align-items-center">
                            <span class="stamp stamp-md bg-success mr-3">
                             
                              <i class="fab fa-bitcoin" style="font-size:20px;"></i>
                            </span>
                            <div>
                                <h5 class="mb-1"><b><a href="#">{{$paid}} <small>Paid Clients</small></a></b></h5>
                                
                            </div>
                        </div>
                    </div>
                </div>
                        <!-- <div class="col-sm-6 col-lg-4">
                            <div class="card p-3">
                                <div class="d-flex align-items-center">
                                    <span class="stamp stamp-md bg-danger mr-3">
                                         <i class="fas fa-cookie-bite"></i>
                                    </span>
                                    <div>
                                        <h5 class="mb-1"><b><a href="#">12 <small>Cookie Heist </small></a></b></h5>
                                        
                                    </div>
                                </div>
                            </div>
                        </div> -->
                <div class="col-sm-6 col-lg-4">
                    <div class="card p-3">
                        <div class="d-flex align-items-center">
                            <span class="stamp stamp-md bg-warning mr-3">
                                
                                <i class="fas fa-inbox" style="font-size:20px;"></i> 
                            </span>
                            <div>
                                <h5 class="mb-1"><b><a href="#">{{$unpaid}} <small>Unpaid Clients</small></a></b></h5>
                           </div>
                        </div>
                    </div>
                </div>

             
            </div>
        </div>
    </div>                  
    <!-- footer should be here -->




@endsection



