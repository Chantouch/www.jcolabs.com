<aside class="main-sidebar" id="sidebar-wrapper">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                @if(Auth::guard('employer')->user()->photo != 'default.jpg')
                    <img src="{!! asset('uploads/employers/avatar/' . Auth::guard('employer')->user()->id.'/' . Auth::guard('employer')->user()->photo) !!}"
                         class="img-circle"
                         alt="{!! Auth::guard('employer')->user()->contact_name !!}"/>
                @else
                    <img src="{!! asset('uploads/employers/' . Auth::guard('employer')->user()->photo) !!}"
                         class="img-circle"
                         alt="{!! Auth::guard('employer')->user()->contact_name !!}"/>
                @endif
            </div>
            <div class="pull-left info">
                @if(!Auth::guard('employer')->user())
                    <p>{{ Auth::guard('admin')->user()->contact_name }}</p>
                @else
                    <p>{!! Auth::guard('employer')->user()->contact_name !!}</p>
            @endif
            <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form (Optional) -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
                <span class="input-group-btn">
            <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
            </button>
          </span>
            </div>
        </form>
        <!-- Sidebar Menu -->

        <ul class="sidebar-menu">
            @include('employers.layouts.menu')
        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>