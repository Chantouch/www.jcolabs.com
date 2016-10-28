<li class="header">MAIN NAVIGATION</li>

<li class="{{ Request::is('admin/dashboard*') ? 'active' : '' }}">
    <a href="{!! route('admin.dashboard.index') !!}">
        <i class="fa fa-edit"></i><span>Dashboard</span></a>
</li>

<li class="treeview {{ Request::is('admin/master*') ? 'active' : '' }}">
    <a href="#">
        <i class="fa fa-dashboard"></i> <span>Master Admin</span>
        <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>

    <ul class="treeview-menu">

        <li class="{{ Request::is('admin/master/industryTypes*') ? 'active' : '' }}">
            <a href="{!! route('admin.industryTypes.index') !!}">
                <i class="fa fa-edit"></i><span>Industry Types</span></a>
        </li>

        <li class="{{ Request::is('admin/master/departmentTypes*') ? 'active' : '' }}">
            <a href="{!! route('admin.departmentTypes.index') !!}">
                <i class="fa fa-edit"></i><span>Department Types</span></a>
        </li>

        <li class="{{ Request::is('admin/master/boards*') ? 'active' : '' }}">
            <a href="{!! route('admin.boards.index') !!}">
                <i class="fa fa-edit"></i><span>University / Boards</span></a>
        </li>

        <li class="{{ Request::is('admin/master/subjects*') ? 'active' : '' }}">
            <a href="{!! route('admin.subjects.index') !!}">
                <i class="fa fa-edit"></i><span>Subjects</span></a>
        </li>

        <li class="{{ Request::is('admin/master/languages*') ? 'active' : '' }}">
            <a href="{!! route('admin.languages.index') !!}">
                <i class="fa fa-edit"></i><span>Languages</span></a>
        </li>

        <li class="{{ Request::is('admin/master/proofResidenses*') ? 'active' : '' }}">
            <a href="{!! route('admin.proofResidenses.index') !!}">
                <i class="fa fa-edit"></i><span>Proof Residences</span></a>
        </li>

        <li class="{{ Request::is('admin/master/cities*') ? 'active' : '' }}">
            <a href="{!! route('admin.cities.index') !!}">
                <i class="fa fa-edit"></i><span>Cities</span></a>
        </li>

        <li class="{{ Request::is('admin/master/districts*') ? 'active' : '' }}">
            <a href="{!! route('admin.districts.index') !!}">
                <i class="fa fa-edit"></i><span>Districts</span></a>
        </li>

        <li class="{{ Request::is('admin/master/exams*') ? 'active' : '' }}">
            <a href="{!! route('admin.exams.index') !!}">
                <i class="fa fa-edit"></i><span>Exams</span></a>
        </li>

        <li class="{{ Request::is('admin/master/positions*') ? 'active' : '' }}">
            <a href="{!! route('admin.positions.index') !!}">
                <i class="fa fa-edit"></i><span>Positions</span></a>
        </li>

        <li class="{{ Request::is('admin/master/jobListAll*') ? 'active' : '' }}">
            <a href="{!! route('admin.jobListAll.jobListAll') !!}">
                <i class="fa fa-edit"></i><span>Jobs list</span></a>
        </li>

    </ul>

</li>

<li class="treeview {{ Request::is('admin/employer*') ? 'active' : '' }}">
    <a href="#">
        <i class="fa fa-edit"></i><span>Employer</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>

    <ul class="treeview-menu">
        <li class="{{ Request::is('admin/employer*') ? 'active' : '' }}">
            <a href="{!! route('admin.employers.employerListAll') !!}">
                <i class="fa fa-edit"></i><span>List</span>
            </a>
        </li>
    </ul>
</li>


<li class="treeview {{ Request::is('admin/candidates*') ? 'active' : '' }}">
    <a href="#">
        <i class="fa fa-share"></i> <span>Candidates</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
        <li class="{{ Request::is('admin/candidates/applications/received') ? 'active' : '' }}"><a
                    href="{{URL::route('admin.applications_received')}}"><i class="text-yellow fa fa-download"></i>
                Applications Received</a></li>
        <li class="{{ Request::is('admin/candidates/applications/verified') ? 'active' : '' }}"><a
                    href="{{URL::route('admin.applications_verified')}}"><i class="text-green fa fa-check"></i>
                Applications Verified</a></li>
        <li class="{{ Request::is('admin/candidates/applications/suspended') ? 'active' : '' }}"><a
                    href="{{URL::route('admin.applications_suspended')}}"><i class="text-red fa fa-ban"></i>
                Applications
                Suspended</a></li>
    </ul>
</li>