<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
    <ul class="app-menu">
        <li>
            <a class="app-menu__item  {{ Route::currentRouteName() == 'admin.dashboard' ? 'active' : '' }}" href="{{ route('admin.dashboard') }}"><i class="app-menu__icon fa fa-dashboard"></i>
                <span class="app-menu__label">Dashboard</span>
            </a>
        </li>

        <!-- User Management -->
        <li>
            <a class="app-menu__item {{ request()->is('admin/users*') ? 'active' : '' }} {{ sidebar_open(['admin.users']) }}" href="{{ route('admin.users.index') }}">
                <i class="app-menu__icon fa fa-user"></i>
                <span class="app-menu__label">User Management</span>
            </a>
        </li>

        <!-- Event Management -->
        <li class="text-light" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
            <a href="#" class="app-menu__item @if(request()->is('admin/event*')) {{ 'active' }} @endif">
                <span class="app-menu__label">Event Master</span>
                <i class="app-menu__icon fa fa-chevron-down"></i>
            </a>
        </li>

        <div id="collapseOne" class="collapse @if(request()->is('admin/event*')) {{ 'show' }} @endif" aria-labelledby="headingOne" data-parent="#accordion">
            <li>
                <a class="app-menu__item {{ request()->is('admin/event/category*') ? 'active' : '' }}" href="{{ route('admin.event-category.index') }}">
                    <i class="app-menu__icon fa fa-archive"></i>
                    <span class="app-menu__label">Category</span>
                 </a>
            </li>
            <li>
                <a class="app-menu__item {{ request()->is('admin/event*') ? 'active' : '' }}" href="{{ route('admin.event.index') }}"><i class="app-menu__icon fa fa-cogs"></i>
                    <span class="app-menu__label">Management</span>
                </a>
            </li>
        </div>

        <li class="text-light" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <a href="#" class="app-menu__item @if(request()->is('admin/deals*') || request()->is('admin/deals*')) {{ 'active' }} @endif">
                <span class="app-menu__label">Deals Master</span>
                <i class="app-menu__icon fa fa-chevron-down"></i>
            </a>
        </li>
        <div id="collapseTwo" class="collapse @if(request()->is('admin/deals*')) {{ 'show' }} @endif" aria-labelledby="headingOne" data-parent="#accordion">
            <li>
                <a class="app-menu__item {{ request()->is('admin/deals/category*') ? 'active' : '' }}" href="{{ route('admin.deals.category.index') }}">
                    <i class="app-menu__icon fa fa-archive"></i>
                    <span class="app-menu__label">Deals Category</span>
                </a>
            </li>
            <li>
                <a class="app-menu__item {{ request()->is('admin/deals') ? 'active' : '' }}" href="{{ route('admin.deals.index') }}">
                    <i class="app-menu__icon fa fa-folder"></i>
                    <span class="app-menu__label">All Deals</span>
                </a>
            </li>
        </div>

        <!-- Course Management -->
        <li class="text-light" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <a href="#" class="app-menu__item @if(request()->is('admin/course-category*') || request()->is('admin/course*')) {{ 'active' }} @endif">
                <span class="app-menu__label">Course Master</span>
                <i class="app-menu__icon fa fa-chevron-down"></i>
            </a>
        </li>
        <div id="collapseTwo" class="collapse @if(request()->is('admin/course*')) {{ 'show' }} @endif" aria-labelledby="headingOne" data-parent="#accordion">
            <li>
                <a class="app-menu__item {{ request()->is('admin/course/category*') ? 'active' : '' }}" href="{{ route('admin.course-category.index') }}">
                    <i class="app-menu__icon fa fa-archive"></i>
                    <span class="app-menu__label">Category</span>
                </a>
            </li>
            <li>
                <a class="app-menu__item {{ request()->is('admin/course') ? 'active' : '' }}" href="{{ route('admin.course.index') }}">
                    <i class="app-menu__icon fa fa-folder"></i>
                    <span class="app-menu__label">Course</span>
                </a>
            </li>
            <li>
                <a class="app-menu__item {{ request()->is('admin/course/lesson*') ? 'active' : '' }}" href="{{ route('admin.lesson.index') }}">
                    <i class="app-menu__icon fa fa-folder"></i>
                    <span class="app-menu__label">Lesson</span>
                </a>
            </li>
            <li>
                <a class="app-menu__item {{ request()->is('admin/course/topic*') ? 'active' : '' }}" href="{{ route('admin.topic.index') }}">
                    <i class="app-menu__icon fa fa-folder"></i>
                    <span class="app-menu__label">Topic</span>
                </a>
            </li>
            {{-- <li>
                <a class="app-menu__item {{ request()->is('admin/module') ? 'active' : '' }}" href="{{ route('admin.module.index') }}">
                    <i class="app-menu__icon fa fa-folder"></i>
                    <span class="app-menu__label">Module</span>
                </a>
            </li> --}}

            <li>
                <a class="app-menu__item {{ request()->is('admin/quiz') ? 'active' : '' }}" href="{{ route('admin.quiz.index') }}">
                    <i class="app-menu__icon fa fa-folder"></i>
                    <span class="app-menu__label">Quiz</span>
                </a>
            </li>
        </div>

        <!-- Article Management -->
        <li class="text-light" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
            <a href="#" class="app-menu__item @if(request()->is('admin/category*') || request()->is('admin/subcategory*') || request()->is('admin/tertiary*') || request()->is('admin/article*')) {{ 'active' }} @endif">
                <span class="app-menu__label">Article Master</span>
                <i class="app-menu__icon fa fa-chevron-down"></i>
            </a>
        </li>
        <div id="collapseThree" class="collapse @if(request()->is('admin/category*') || request()->is('admin/subcategory*') || request()->is('admin/tertiary*') || request()->is('admin/article*')) {{ 'show' }} @endif" aria-labelledby="headingOne" data-parent="#accordion">
            <li>
                <a class="app-menu__item {{ request()->is('admin/article-category*') ? 'active' : '' }} {{ sidebar_open(['admin.article-category']) }}"
                        href="{{ route('admin.article-category.index') }}">
                        <i class="app-menu__icon fa fa-archive"></i>
                        <span class="app-menu__label">Category Management</span>
                 </a>
            </li>
                <!--- Sub category management --->
            <li>
                <a class="app-menu__item {{ request()->is('admin/article-subcategory*') ? 'active' : '' }} {{ sidebar_open(['admin.article-subcategory']) }}"
                        href="{{ route('admin.article-subcategory.index') }}">
                        <i class="app-menu__icon fa fa-sitemap"></i>
                        <span class="app-menu__label">Sub Category Management</span>
                </a>
            </li>
                <!---  Tertiary management ---->
            {{-- <li>
                <a class="app-menu__item {{ request()->is('admin/article-tertiary*') ? 'active' : '' }} {{ sidebar_open(['admin.article-tertiary']) }}"
                        href="{{ route('admin.article-tertiary.index') }}">
                        <i class="app-menu__icon fa fa-sitemap"></i>
                        <span class="app-menu__label">Tertiary Management</span>
                </a>
            </li> --}}
                <!---  Article management ---->
            <li>
                <a class="app-menu__item {{ request()->is('admin/article*') ? 'active' : '' }} {{ sidebar_open(['admin.article']) }}"
                        href="{{ route('admin.article.index') }}">
                        <i class="app-menu__icon fa fa-file"></i>
                        <span class="app-menu__label">Article Management</span>
                </a>
            </li>
        </div>
        <!-- Market Management -->
        <li class="text-light" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
            <a href="#" class="app-menu__item @if(request()->is('admin/market*') || request()->is('admin/market/category*') || request()->is('admin/market/banner*') || request()->is('admin/market/faq*')) {{ 'active' }} @endif">
                <span class="app-menu__label">Market Master</span>
                <i class="app-menu__icon fa fa-chevron-down"></i>
            </a>
        </li>
        <div id="collapseFour" class="collapse @if(request()->is('admin/market*') || request()->is('admin/market/category*') || request()->is('admin/market/banner*') || request()->is('admin/market/faq*')) {{ 'show' }} @endif" aria-labelledby="headingOne" data-parent="#accordion">
                <!--- Category management --->
            <li>
                <a class="app-menu__item {{ request()->is('admin/market/category*') ? 'active' : '' }} {{ sidebar_open(['admin.market.category']) }}"
                        href="{{ route('admin.market.category.index') }}">
                        <i class="app-menu__icon fa fa-archive"></i>
                        <span class="app-menu__label">Category Management</span>
                 </a>
            </li>
                <!---  Market management ---->
            <li>
                <a class="app-menu__item {{ request()->is('admin/market*') ? 'active' : '' }} {{ sidebar_open(['admin.market']) }}"
                        href="{{ route('admin.market.index') }}">
                        <i class="app-menu__icon fa fa-file"></i>
                        <span class="app-menu__label">Market Management</span>
                </a>
            </li>
            <!--- Banner management --->
            <li>
                <a class="app-menu__item {{ request()->is('admin/market/banner*') ? 'active' : '' }} {{ sidebar_open(['admin.market.banner']) }}"
                        href="{{ route('admin.market.banner.index') }}">
                        <i class="app-menu__icon fa fa-sitemap"></i>
                        <span class="app-menu__label">Banner Management</span>
                </a>
            </li>
            <!---  Faq management ---->
            <li>
                <a class="app-menu__item {{ request()->is('admin/market/faq*') ? 'active' : '' }} {{ sidebar_open(['admin.market.faq']) }}"
                        href="{{ route('admin.market.faq.index') }}">
                        <i class="app-menu__icon fa fa-file"></i>
                        <span class="app-menu__label">Faq Management</span>
                </a>
            </li>
        </div>
        <!-- support -->

        <li class="text-light" data-toggle="collapse" data-target="#collapseFive" aria-expanded="true" aria-controls="collapseFive">
            <a href="#" class="app-menu__item @if(request()->is('admin/market*') || request()->is('admin/market/category*') || request()->is('admin/market/banner*') || request()->is('admin/market/faq*')) {{ 'active' }} @endif">
                <span class="app-menu__label">Support Master</span>
                <i class="app-menu__icon fa fa-chevron-down"></i>
            </a>
        </li>
        <div id="collapseFive" class="collapse @if(request()->is('admin/support*') || request()->is('admin/support/widget*') || request()->is('admin/support/faq/category*') || request()->is('admin/support/faq*')) {{ 'show' }} @endif" aria-labelledby="headingOne" data-parent="#accordion">
                <!--- Category management --->
            <li>
                <a class="app-menu__item {{ request()->is('admin/support*') ? 'active' : '' }} {{ sidebar_open(['admin.support']) }}"
                        href="{{ route('admin.support.index') }}">
                        <i class="app-menu__icon fa fa-archive"></i>
                        <span class="app-menu__label"> Management</span>
                 </a>
            </li>
                <!---  Market management ---->
            <li>
                <a class="app-menu__item {{ request()->is('admin/support/widget*') ? 'active' : '' }} {{ sidebar_open(['admin.support.widget']) }}"
                        href="{{ route('admin.support.widget.index') }}">
                        <i class="app-menu__icon fa fa-file"></i>
                        <span class="app-menu__label">Widget Management</span>
                </a>
            </li>
            <!--- Banner management --->
            <li>
                <a class="app-menu__item {{ request()->is('admin/support/faq/category*') ? 'active' : '' }} {{ sidebar_open(['admin.support.faq.category']) }}"
                        href="{{ route('admin.support.faq.category.index') }}">
                        <i class="app-menu__icon fa fa-sitemap"></i>
                        <span class="app-menu__label">Faq Category Management</span>
                </a>
            </li>
            <!---  Faq management ---->
            <li>
                <a class="app-menu__item {{ request()->is('admin/support/faq*') ? 'active' : '' }} {{ sidebar_open(['admin.support.faq']) }}"
                        href="{{ route('admin.support.faq.index') }}">
                        <i class="app-menu__icon fa fa-file"></i>
                        <span class="app-menu__label">Faq Management</span>
                </a>
            </li>
        </div>
        <!-- Event Management -->
        <li class="text-light" data-toggle="collapse" data-target="#collapseSix" aria-expanded="true" aria-controls="collapseSix">
            <a href="#" class="app-menu__item @if(request()->is('admin/orders*')) {{ 'active' }} @endif">
                <span class="app-menu__label">Order Master</span>
                <i class="app-menu__icon fa fa-chevron-down"></i>
            </a>
        </li>

        <div id="collapseSix" class="collapse @if(request()->is('admin/orders*')) {{ 'show' }} @endif" aria-labelledby="headingSix" data-parent="#accordion">
            {{-- Orders --}}
            <li>
                <a class="app-menu__item {{ request()->is('admin/orders*') ? 'active' : '' }} {{ sidebar_open(['admin.order']) }}" href="{{ route('admin.order.index') }}">
                    <span class="app-menu__label">Orders</span>
                </a>
            </li>
        </div>
         <!-- Event Management -->
         <li class="text-light" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="true" aria-controls="collapseSeven">
            <a href="#" class="app-menu__item @if(request()->is('admin/job*')) {{ 'active' }} @endif">
                <span class="app-menu__label">Job Master</span>
                <i class="app-menu__icon fa fa-chevron-down"></i>
            </a>
        </li>

        <div id="collapseSeven" class="collapse @if(request()->is('admin/job*')) {{ 'show' }} @endif" aria-labelledby="headingOne" data-parent="#accordion">
            <li>
                <a class="app-menu__item {{ request()->is('admin/job/category*') ? 'active' : '' }}" href="{{ route('admin.job.category.index') }}">
                    <i class="app-menu__icon fa fa-archive"></i>
                    <span class="app-menu__label">Category</span>
                 </a>
            </li>
            <li>
                <a class="app-menu__item {{ request()->is('admin/job*') ? 'active' : '' }}" href="{{ route('admin.job.index') }}"><i class="app-menu__icon fa fa-cogs"></i>
                    <span class="app-menu__label">Management</span>
                </a>
            </li>
        </div>
    </ul>
</aside>
