<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
       <li class="nav-item has-treeview {{\Illuminate\Support\Str::contains(request()->route()->getName(),'sections')||\Illuminate\Support\Str::contains(request()->route()->getName(),'lessons')?'menu-open':''}}">
            <a href="#" class="nav-link bg-gray-light {{\Illuminate\Support\Str::contains(request()->route()->getName(),'sections')||\Illuminate\Support\Str::contains(request()->route()->getName(),'lessons')?'active':''}}">
                <i class="nav-icon fa fa-tachometer-alt"></i>
                <p>
                    الكورسات
                    <i class="right fa fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview {{\Illuminate\Support\Str::contains(request()->route()->getName(),'sections')||\Illuminate\Support\Str::contains(request()->route()->getName(),'lessons')?'active':''}}">
                <li class="nav-item">
                    <a href="{{route('dahsboard.sections')}}" class="nav-link  bg-gray-light {{\Illuminate\Support\Str::contains(request()->route()->getName(),'sections')||\Illuminate\Support\Str::contains(request()->route()->getName(),'lessons')?'active':''}}">
                        <i class="fa fa-circle nav-icon"></i>
                        <p>الفصول</p>
                       {{-- <span class="right badge badge-danger">جدید</span>--}}
                    </a>
                </li>

            </ul>
        </li>




        <li class="nav-item  {{\Illuminate\Support\Str::contains(request()->route()->getName(),'users')?'active':''}}">
            <a href="{{route('dahsboard.users')}}" class="nav-link  bg-gray-light  {{\Illuminate\Support\Str::contains(request()->route()->getName(),'users')?'active':''}}">
                <i class="nav-icon fa fa-users-cog"></i>
                <p>

                    المستخدمين

                </p>
            </a>
        </li>


        <li class="nav-item  {{\Illuminate\Support\Str::contains(request()->route()->getName(),'examples')?'active':''}}">
            <a href="{{route('dahsboard.examples.index.all')}}" class="nav-link  bg-gray-light  {{\Illuminate\Support\Str::contains(request()->route()->getName(),'examples')?'active':''}}">
                <i class="nav-icon fa fa-users-cog"></i>
                <p>

                    التدريبات

                </p>
            </a>
        </li>

        <li class="nav-item  {{\Illuminate\Support\Str::contains(request()->route()->getName(),'session')?'active':''}}">
            <a href="{{route('dahsboard.session.index')}}" class="nav-link  bg-gray-light {{\Illuminate\Support\Str::contains(request()->route()->getName(),'session')?'active':''}}">
                <i class="nav-icon fa fa-users-cog"></i>
                <p>

                    حجوزات منصة زووم

                </p>
            </a>
        </li>

        <li class="nav-item ">
            <a href="{{route('logout')}}" class="nav-link text-dark">
                <i class="nav-icon fa fa-sign-out-alt"></i>
                <p>

                    تسجيل الخروج

                </p>
            </a>
        </li>
    </ul>
</nav>