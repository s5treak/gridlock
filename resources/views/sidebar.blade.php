<!-- Sidebar -->
		<div class="sidebar sidebar-style-2" data-background-color="dark">			
			<div class="sidebar-wrapper scrollbar scrollbar-inner">
				<div class="sidebar-content">
					<div class="user">
						<div class="avatar-sm float-left mr-2">
							
							<img src="/assets/img/logoproduct3.svg"  alt="..." class="avatar-img rounded-circle">
							{{-- <img src="/storage/upload/{{Auth::user()->avatar}}"  alt="..." class="avatar-img rounded-circle"> --}}
						</div>
						<div class="info">
							<a>
								<span>
									{{Auth::user()->name}}
									<span class="user-level">Regular</span>
									<!-- <span class="caret"></span> -->
								</span>
							</a>
							<div class="clearfix"></div>

							<div class="in collapse" id="collapseExample" style="">
								<ul class="nav">
									<li>
										<a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
												document.getElementById('logout-form').submit();">
										Logout</a>
										<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
											@csrf
										</form>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<ul class="nav nav-primary">

						<li class="nav-item active">
							<a href="home" class="nav-link">
								<i class="fas fa-home"></i>
								<p>Dashboard</p>
							
							</a>
						</li>	
					   
					   

					    <li class="nav-item">
					        <a href="{{url('/ransomware')}}">

					          <i class="fas fa-virus" style="font-size: 24px;"></i>
					            <p>RansomeWare</p>
					            
					        </a>
					    </li>
					</ul>

				</div>
			</div>
		</div>
		<!-- End Sidebar -->
