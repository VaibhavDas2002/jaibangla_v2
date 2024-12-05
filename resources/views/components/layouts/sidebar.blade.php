<link href="{{ asset('css/styles/layouts/sidebar.css') }}" rel="stylesheet" type="text/css" />
<aside class="main-sidebar">
  <section class="sidebar">
    <div class="user-panel">
      <div class="pull-left image">
        <img src="{{ asset("/bower_components/AdminLTE/dist/img/user2-160x160.jpg") }}" class="img-circle"
          alt="User Image">
      </div>
      <div class="pull-left info">
        <p>{{ Auth::user()->username}} </p>
        <!-- Status -->
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    <form action="#" method="get" class="sidebar-form">
      <div class="input-group">
        <input type="text" name="q" class="form-control" placeholder="Search...">
        <span class="input-group-btn">
          <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
          </button>
        </span>
      </div>
    </form>
    <ul class="sidebar-menu">
      <li class="active"><a href="{{ url('/backendlogin') }}"><i class="fa fa-link"></i> <span>Dashboard</span></a></li>
      <li class=""><a href="{{ url('/entryformoption')}}"><i class="fa fa-link"></i><span>Jai Bangla Form</span></a></li>
      <li class=""><a href="{{ url('/schemelistforUpdate')}}"><i class="fa fa-link"></i><span>Application List</span></a></li>
      <li class=""><a href="{{ url('/workflow')}}"><i class="fa fa-link"></i><span>Workflow</span></a></li>
      <li class=""><a href="{{ url('/dutymanagement')}}"><i class="fa fa-link"></i><span>Duty Management</span></a></li>
      <li class=""><a href="{{ url('/tokencreation')}}"><i class="fa fa-link"></i><span>Token Create</span></a></li>
      <li class=""><a href="{{ url('/tokenVerification')}}"><i class="fa fa-link"></i><span>Token Verification</span></a></li>
      <li class=""><a href="{{ route('editBeneficiary')}}"><i class="fa fa-link"></i><span> Edit Beneficiary</span></a></li>
      <li class=""><a href="{{ url('/editVerification')}}"><i class="fa fa-link"></i><span> Edit Verification</span></a></li>
    </ul>
  </section>
</aside>
