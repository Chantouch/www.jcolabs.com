<li class="treeview {{ Request::is('employers/post-jobs*') ? 'active' : '' }}">
    <a href="#">
        <i class="fa fa-dashboard"></i> <span>Jobs Settings</span>
        <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
        <li class="{{ Request::is('employers/post-jobs/all*') ? 'active' : '' }}">
            <a href="{!! route('employer.postJobs.index') !!}"><i class="fa fa-edit"></i><span>All Jobs</span></a>
        </li>
        <li class="{{ Request::is('employers/post-jobs/create*') ? 'active' : '' }}">
            <a href="{!! route('employer.postJobs.create') !!}">
                <i class="fa fa-edit"></i><span>Post a new job</span></a>
        </li>
        <li class="{{ Request::is('employers/post-jobs/expired/all*') ? 'active' : '' }}">
            <a href="{!! route('employer.jobs.expired') !!}"><i class="fa fa-plus"></i>Jobs Expired</a>
        </li>
    </ul>
</li>

<li class="treeview {{ Request::is('employers/account-settings*') ? 'active' : '' }}">
    <a href="#">
        <i class="fa fa-dashboard"></i> <span>Account Settings</span>
        <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
        <li class="{!! Request::is ('employers/account-settings/company/profile*') ? 'active' : '' !!}">
            <a href="{!! route('employer.company.profile') !!}">
                <i class="fa fa-plus"></i> Company Profile</a>
        </li>
        <li class="{{ Request::is('employers/account-settings/contact-person*') ? 'active' : '' }}">
            <a href="{!! route('employer.contactPeople.index') !!}">
                <i class="fa fa-edit"></i><span>Contact People</span></a>
        </li>
        <li class="{!! Request::is('employers/account-settings/company/change-password')? 'active' : '' !!}">
            <a href="{!! route('employer.company.show_form_change_password') !!}"><i class="fa fa-plus"></i>Change
                password</a>
        </li>
    </ul>
</li>

<li class="treeview {{ Request::is('employers/documents-uploaded') ? 'active' : '' }}">
    <a href="#">
        <i class="fa fa-dashboard"></i> <span>Document Upload</span>
        <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
        <li class="{!! Request::is ('employers/documents-uploaded/form*') ? 'active' : '' !!}">
            <a href="{!! route('employer.documents.uploaded.form') !!}">
                <i class="fa fa-plus"></i> Upload New</a>
        </li>
        <li class="{{ Request::is('employers/documents-uploaded/list*') ? 'active' : '' }}">
            <a href="{!! route('employer.documents.uploaded.index') !!}">
                <i class="fa fa-edit"></i><span>List All Documents</span></a>
        </li>
    </ul>
</li>

