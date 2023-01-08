

    <div class="app-sidebar colored">
        <div class="sidebar-header">
            <a class="header-brand" href="{{route('admin.dashboard')}}">
                <span class="text">{{ Config::get('SITE_TITLE') }}</span>
            </a>
            <button type="button" class="nav-toggle"><i data-toggle="expanded" class="ik ik-toggle-right toggle-icon"></i></button>
            <button id="sidebarClose" class="nav-close"><i class="ik ik-x"></i></button>
        </div>

        <div class="sidebar-content">
            <div class="nav-container">
                <nav id="main-menu-navigation" class="navigation-main">
                    <div class="nav-lavel">Navigation</div>
                    <div class="nav-item {{ menu_active('web_admin/dashboard') }}">
                        <a href="{{route('admin.dashboard')}}"><i class="ik ik-bar-chart-2"></i><span>Dashboard</span></a>
                    </div>
                    <div class="nav-item {{ menu_active('web_admin/category') }} ">
                        <a href="{{ route('category.index') }}"><i class="ik ik-folder-plus"></i><span>Category</span></a>
                    </div>

                    <div class="nav-item {{ menu_active('web_admin/tags') }}">
                        <a href="{{ route('tags.index') }}"><i class="ik ik-tag"></i><span>Tags</span></a>
                    </div>


                    <div class="nav-item has-sub {!! sidebar_open("/products/",url_format(Request::url()) )!!}" >

                        <a href="#"><i class="ik ik-package"></i><span>Products</span></a>
                        <div class="submenu-content">
                            <a href="{{ route('products.index') }}" class="menu-item {{ menu_active('web_admin/products') }}">All Products</a>
                            <a href="{{ route('products.create') }}" class="menu-item {{ menu_active('web_admin/products/create') }}">Add Products</a>

                        </div>
                    </div>


                    <div class="nav-item has-sub {!! sidebar_open("/users/",url_format(Request::url()) )   !!} {!! sidebar_open("/login-history/",url_format(Request::url()) )  !!}">
                        <a href="javascript:void(0)"><i class="ik ik-users"></i><span>User Manager</span></a>
                        <div class="submenu-content">
                            <a href="{{ route('users.index') }}" class="menu-item {{ menu_active('web_admin/users') }}">All Users</a>
                            <a href="{{ route('users.active') }}" class="menu-item {{ menu_active('web_admin/active/users') }}">Active Users</a>
                            <a href="{{ route('users.banned') }}" class="menu-item {{ menu_active('web_admin/banned/users') }}">Banned Users</a>
                            <a href="{{ route('users.unverified') }}" class="menu-item {{ menu_active('web_admin/email/unverified/users') }}">Email Unverified</a>
                            <a href="{{ route('login-history.index') }}" class="menu-item {{ menu_active('web_admin/login-history') }}">Login History</a>
                            <a href="{{ route('all.mail') }}" class="menu-item {{ menu_active('web_admin/email/to-all/users') }}">Send Mail</a>
                        </div>
                    </div>
                    <div class="nav-lavel">System</div>
                    <div class="nav-item {!! sidebar_open("/supports/",url_format(Request::url()) )   !!}">
                        <a href="{{ route('admin.support_index') }}"><i class="ik ik-clock"></i><span>Ticket Support</span></a>
                    </div>
                    <div class="nav-item">
                        <a href="#"><i class="ik ik-check-circle"></i><span>Subscribers</span></a>
                    </div>
                    <div class="nav-item {!! sidebar_open("/payments/",url_format(Request::url()) )   !!}">
                        <a href="{{ route('payments.index') }}"><i class="ik ik-credit-card"></i><span>Payment Gateways</span></a>
                    </div>


                    <div class="nav-item has-sub {!! sidebar_open("/orders/",url_format(Request::url()) )   !!}">
                        <a href="#"><i class="ik ik-gift"></i><span>Orders</span><span class="badge badge-danger">{{ new_orders_count() }}</span></a>
                        <div class="submenu-content">
                            <a href="{{ route('admin.order_show') }}" class="menu-item {{ menu_active('web_admin/orders') }}">New Orders <span class="badge badge-danger"></span></a>
                            <a href="{{ route('admin.completed_order') }}" class="menu-item {{ menu_active('web_admin/orders/completed') }}">Completed Orders</a>
                            <a href="{{ route('admin.order_cancelled') }}" class="menu-item {{ menu_active('web_admin/orders/cancelled') }}">Cancelled Orders</a>
                        </div>
                    </div>

                    <div class="nav-lavel">Apps</div>

                    <div class="nav-item">
                        <a href="#"><i class="ik ik-link"></i><span>Plugin Extension</span></a>
                    </div>
                    <div class="nav-item has-sub {!! sidebar_open("/frontend/",url_format(Request::url()) )!!}">
                        <a href="#"><i class="ik ik-lock"></i><span>Frontend Manager</span></a>
                        <div class="submenu-content">
                            <a href="{{route('frontend.blog')}}" class="menu-item {{ menu_active('web_admin/frontend-manager/blogs') }}">Blog Manager</a>
                            <a href="#" class="menu-item">Seo Manager</a>
                            <a href="#" class="menu-item">Social Icons</a>
                            <a href="#" class="menu-item">Testimonial</a>
                        </div>
                    </div>

                    <div class="nav-item has-sub {!! sidebar_open("/settings/",url_format(Request::url()) )!!}" >

                        <a href="#"><i class="ik ik-settings"></i><span>General Settings</span></a>
                        <div class="submenu-content">
                            <a href="{{ route('settings.index') }}" class="menu-item {{ menu_active('web_admin/settings') }}">Basic</a>
                            <a href="{{ route('settings.create') }}" class="menu-item {{ menu_active('web_admin/settings/create') }}">Social Login</a>
                            <a href="{{ route('settings.logo') }}" class="menu-item {{ menu_active('web_admin/logo/settings') }}">Logo & Icons</a>
                            <a href="{{ route('language') }}" class="menu-item {{ menu_active('web_admin/language/settings') }}">Language</a>
                            <a href="{{ route('admin.perm_show') }}" class="menu-item {{ menu_active('web_admin/permission-settings') }}">Permissions</a>
                        </div>
                    </div>
                    <div class="nav-item has-sub {!! sidebar_open("/email-manager/",url_format(Request::url()) )!!}">
                        <a href="#"><i class="ik ik-mail"></i><span>Email Manager</span></a>
                        <div class="submenu-content">
                            <a href="{{ route('email-manager.index') }}" class="menu-item {{ menu_active('web_admin/email-manager') }}">Design Template</a>
                            <a href="{{ route('admin.emailTemplate') }}" class="menu-item {{ menu_active('web_admin/save-template/email-manager') }}">Email Template</a>
                            <a href="{{ route('email-manager.create') }}" class="menu-item {{ menu_active('web_admin/email-manager/create') }}">Email Configure</a>

                        </div>
                    </div>

                </nav>
            </div>
        </div>
    </div>



