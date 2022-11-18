<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
    <ul class="app-menu">
        <li>
            <a class="app-menu__item  {{ Route::currentRouteName() == 'admin.dashboard' ? 'active' : '' }}"
                href="{{ route('admin.dashboard') }}"><i class="app-menu__icon fa fa-dashboard"></i>
                <span class="app-menu__label">Dashboard</span>
            </a>
        </li>
        <!-- User Management -->
        <li>
            <a class="app-menu__item {{ request()->is('admin/users*') ? 'active' : '' }} {{ sidebar_open(['admin.users']) }}"
                href="{{ route('admin.users.index') }}">
                <i class="app-menu__icon fa fa-user"></i>
                <span class="app-menu__label">User Management</span>
            </a>
        </li>
        <li>
            <a class="app-menu__item {{ request()->is('admin/frontend-management/home-page*') ? 'active' : '' }}"
                href="{{ route('admin.homepagemanagement.index') }}">
                <i class="app-menu__icon fa fa-archive"></i>
                <span class="app-menu__label">Home Page Content</span>
            </a>
        </li>
        <!---Market management-->
        <li class="text-light" data-toggle="collapse" data-target="#collapseTwelve" aria-expanded="true"
            aria-controls="collapseTwelve">
            <a href="#" class="app-menu__item @if (request()->is('admin/market*') ||
                request()->is('admin/market/category') ||
                request()->is('admin/market/banner') ||
                request()->is('admin/market/faq')) {{ 'active' }} @endif">
                <span class="app-menu__label">Market</span>
                <i class="app-menu__icon fa fa-chevron-down"></i>
            </a>
        </li>
        <div id="collapseTwelve" class="collapse @if (request()->is('admin/market*') ||
            request()->is('admin/market/category') ||
            request()->is('admin/market/banner') ||
            request()->is('admin/market/faq')) {{ 'show' }} @endif"
            aria-labelledby="headingOne" data-parent="#accordion">
            
            <!---  Market management ---->
            <li>
                <a class="app-menu__item {{ request()->is('admin/market*') ? 'active' : '' }} {{ sidebar_open(['admin.market']) }}"
                    href="{{ route('admin.market.index') }}">
                    <i class="app-menu__icon fa fa-file"></i>
                    <span class="app-menu__label">Page Content</span>
                </a>
            </li>
            <!--- Category management --->
            <li>
                <a class="app-menu__item {{ request()->is('admin/market/category*') ? 'active' : '' }} {{ sidebar_open(['admin.market.category']) }}"
                    href="{{ route('admin.market.category.index') }}">
                    <i class="app-menu__icon fa fa-archive"></i>
                    <span class="app-menu__label">Category Management</span>
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
        <!---Tools-Feature management-->
        <li class="text-light" data-toggle="collapse" data-target="#collapseFifteen" aria-expanded="true"
            aria-controls="collapseFifteen">
            <a href="#" class="app-menu__item @if (request()->is('admin/tools*') ||
                request()->is('admin/tools/areaofInterestcategory') ||
                request()->is('admin/tools/areaofInterest')) {{ 'active' }} @endif">
                <span class="app-menu__label">Tools & Features</span>
                <i class="app-menu__icon fa fa-chevron-down"></i>
            </a>
        </li>
        <div id="collapseFifteen" class="collapse @if (request()->is('admin/tools*') ||
            request()->is('admin/tools/areaofInterestcategory') ||
            request()->is('admin/tools/areaofInterest')) {{ 'show' }} @endif"
            aria-labelledby="headingOne" data-parent="#accordion">
            <!--- Content --->
            <li>
                <a class="app-menu__item {{ request()->is('admin/tools*') ? 'active' : '' }} {{ sidebar_open(['admin.tools.content']) }}"
                    href="{{ route('admin.tools.content.index') }}">
                    <i class="app-menu__icon fa fa-archive"></i>
                    <span class="app-menu__label">Content</span>
                </a>
            </li>
            <!---  Area of Interest Category ---->
            <li>
                <a class="app-menu__item {{ request()->is('admin/tools/AreaOfInterest/category*') ? 'active' : '' }} {{ sidebar_open(['admin.tools.AreaOfInterest.category']) }}"
                    href="{{ route('admin.tools.AreaOfInterest.category.index') }}">
                    <i class="app-menu__icon fa fa-file"></i>
                    <span class="app-menu__label">Area of Interest Category</span>
                </a>
            </li>
            <!--- Area of Interest --->
            <li>
                <a class="app-menu__item {{ request()->is('admin/tools/AreaOfInterest*') ? 'active' : '' }} {{ sidebar_open(['admin.tools.AreaOfInterest']) }}"
                    href="{{ route('admin.tools.AreaOfInterest.index') }}">
                    <i class="app-menu__icon fa fa-sitemap"></i>
                    <span class="app-menu__label">Area of Interest</span>
                </a>
            </li>
        </div>
        <!-- support -->

        <li class="text-light" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="true"
            aria-controls="collapseSeven">
            <a href="#" class="app-menu__item @if (request()->is('admin/support') ||
                request()->is('admin/support/widget') ||
                request()->is('admin/support/faq/category') ||
                request()->is('admin/support/faq')) {{ 'active' }} @endif">
                <span class="app-menu__label">Support Master</span>
                <i class="app-menu__icon fa fa-chevron-down"></i>
            </a>
        </li>
        <div id="collapseSeven" class="collapse @if (request()->is('admin/support') ||
            request()->is('admin/support/widget') ||
            request()->is('admin/support/faq/category') ||
            request()->is('admin/support/faq')) {{ 'show' }} @endif"
            aria-labelledby="headingOne" data-parent="#accordion">
            <!--- Category management --->
            <li>
                <a class="app-menu__item {{ request()->is('admin/support') ? 'active' : '' }} {{ sidebar_open(['admin.support']) }}"
                    href="{{ route('admin.support.index') }}">
                    <i class="app-menu__icon fa fa-archive"></i>
                    <span class="app-menu__label">Content Management</span>
                </a>
            </li>
            <!---  Market management ---->
            <li>
                <a class="app-menu__item {{ request()->is('admin/support/widget') ? 'active' : '' }} {{ sidebar_open(['admin.support.widget']) }}"
                    href="{{ route('admin.support.widget.index') }}">
                    <i class="app-menu__icon fa fa-file"></i>
                    <span class="app-menu__label">Widget Management</span>
                </a>
            </li>
            <!--- Banner management --->
            <li>
                <a class="app-menu__item {{ request()->is('admin/support/faq/category') ? 'active' : '' }} {{ sidebar_open(['admin.support.faq.category']) }}"
                    href="{{ route('admin.support.faq.category.index') }}">
                    <i class="app-menu__icon fa fa-sitemap"></i>
                    <span class="app-menu__label">Faq Category Management</span>
                </a>
            </li>
            <!---  Faq management ---->
            <li>
                <a class="app-menu__item {{ request()->is('admin/support/faq') ? 'active' : '' }} {{ sidebar_open(['admin.support.faq']) }}"
                    href="{{ route('admin.support.faq.index') }}">
                    <i class="app-menu__icon fa fa-file"></i>
                    <span class="app-menu__label">Faq Management</span>
                </a>
            </li>
        </div>
        <!-- Article Management -->
        <li class="text-light" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true"
            aria-controls="collapseFour">
            <a href="#" class="app-menu__item @if (request()->is('admin/blog*')) {{ 'active' }} @endif">
                <span class="app-menu__label">Blog Master</span>
                <i class="app-menu__icon fa fa-chevron-down"></i>
            </a>
        </li>
        <div id="collapseFour" class="collapse @if (request()->is('admin/blog*')) {{ 'show' }} @endif"
            aria-labelledby="headingOne" data-parent="#accordion">
            <li>
                <a class="app-menu__item {{ request()->is('admin/article/category*') ? 'active' : '' }} {{ sidebar_open(['admin.article-category']) }}"
                    href="{{ route('admin.article-category.index') }}">
                    <i class="app-menu__icon fa fa-archive"></i>
                    <span class="app-menu__label">Category Management</span>
                </a>
            </li>
            <!--- Sub category management --->
            <li>
                <a class="app-menu__item {{ request()->is('admin/blog/subcategory*') ? 'active' : '' }} {{ sidebar_open(['admin.article-subcategory']) }}"
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
                <a class="app-menu__item {{ request()->is('admin/blog/management*') ? 'active' : '' }} {{ sidebar_open(['admin.article']) }}"
                    href="{{ route('admin.article.index') }}">
                    <i class="app-menu__icon fa fa-file"></i>
                    <span class="app-menu__label">Blog Management</span>
                </a>
            </li>
            <li>
                <a class="app-menu__item {{ request()->is('admin/blog/page*') ? 'active' : '' }} {{ sidebar_open(['admin.article']) }}"
                    href="{{ route('admin.article.page.index') }}">
                    <i class="app-menu__icon fa fa-file"></i>
                    <span class="app-menu__label">Page Content</span>
                </a>
            </li>
        </div>
        
        {{-- Plans and pricing --}}
        <li class="text-light" data-toggle="collapse" data-target="#collapsplansandpricing" aria-expanded="true"
            aria-controls="collapsplansandpricing">
            <a href="#" class="app-menu__item @if (request()->is('admin/plans-pricing*')) {{ 'active' }} @endif">
                <span class="app-menu__label">Plans and pricing Master</span>
                <i class="app-menu__icon fa fa-chevron-down"></i>
            </a>
        </li>
        <div id="collapsplansandpricing"
            class="collapse @if (request()->is('admin/plans-pricing*')) {{ 'show' }} @endif"
            aria-labelledby="headingOne" data-parent="#accordion">
            <li>
                <a class="app-menu__item {{ request()->is('admin/plans-pricing/management*') ? 'active' : '' }}"
                    href="{{ route('admin.plans.management.index') }}">
                    <i class="app-menu__icon fa fa-folder"></i>
                    <span class="app-menu__label">All Plans and pricing</span>
                </a>
            </li>
            <li>
                <a class="app-menu__item {{ request()->is('admin/plans-pricing/page*') ? 'active' : '' }}"
                    href="{{ route('admin.plans.page.index') }}">
                    <i class="app-menu__icon fa fa-folder"></i>
                    <span class="app-menu__label">Page Content</span>
                </a>
            </li>
            <li>
                <a class="app-menu__item {{ request()->is('admin/plans-pricing/faq*') ? 'active' : '' }}"
                    href="{{ route('admin.plans.faq.index') }}">
                    <i class="app-menu__icon fa fa-folder"></i>
                    <span class="app-menu__label">Faq Management</span>
                </a>
            </li>
        </div>

        {{-- Market place --}}
        <li class="text-light" data-toggle="collapse" data-target="#collapseFive" aria-expanded="true"
            aria-controls="collapseFive">
            <a href="#" class="app-menu__item @if (request()->is('admin/marketplace*')) {{ 'active' }} @endif">
                <span class="app-menu__label">Marketplace Master</span>
                <i class="app-menu__icon fa fa-chevron-down"></i>
            </a>
        </li>
        <div id="collapseFive" class="collapse @if (request()->is('admin/marketplace*')) {{ 'show' }} @endif"
            aria-labelledby="headingOne" data-parent="#accordion">
            <li>
                <a class="app-menu__item {{ request()->is('admin/marketplace/faq*') ? 'active' : '' }} {{ sidebar_open(['admin.market.faq.index']) }}"
                    href="{{ route('admin.marketplace.faq.index') }}">
                    <i class="app-menu__icon fa fa-file"></i>
                    <span class="app-menu__label">Faq Management</span>
                </a>
            </li>
            <li>
                <a class="app-menu__item {{ request()->is('admin/marketplace/page*') ? 'active' : '' }} {{ sidebar_open(['admin.market.page.index']) }}"
                    href="{{ route('admin.marketplace.page.index') }}">
                    <i class="app-menu__icon fa fa-file"></i>
                    <span class="app-menu__label">Marketplace page content</span>
                </a>
            </li>
        </div>


        <!-- Event Management -->
        <li class="text-light" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true"
            aria-controls="collapseOne">
            <a href="#"
                class="app-menu__item @if (request()->is('admin/event*') || request()->is('admin/event/category')) ) {{ 'active' }} @endif">
                <span class="app-menu__label">Event Master</span>
                <i class="app-menu__icon fa fa-chevron-down"></i>
            </a>
        </li>

        <div id="collapseOne" class="collapse @if (request()->is('admin/event*') || request()->is('admin/event/category')) ) {{ 'show' }} @endif"
            aria-labelledby="headingOne" data-parent="#accordion">
            <li>
                <a class="app-menu__item {{ request()->is('admin/event/category') ? 'active' : '' }}"
                    href="{{ route('admin.event-category.index') }}">
                    <i class="app-menu__icon fa fa-archive"></i>
                    <span class="app-menu__label">Category</span>
                </a>
            </li>
            <li>
                <a class="app-menu__item {{ request()->is('admin/event') ? 'active' : '' }}"
                    href="{{ route('admin.event.index') }}"><i class="app-menu__icon fa fa-cogs"></i>
                    <span class="app-menu__label">Management</span>
                </a>
            </li>
            {{-- Event page master --}}
            <li>
                <a class="app-menu__item {{ request()->is('admin/events/page*') ? 'active' : '' }}"
                    href="{{ route('admin.events.page.index') }}">
                    <i class="app-menu__icon fa fa-folder"></i>
                    <span class="app-menu__label">Page Content</span>
                </a>
            </li>
        </div>




        {{-- Deals --}}
        <li class="text-light" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
            aria-controls="collapseTwo">
            <a href="#" class="app-menu__item @if (request()->is('admin/deals*') || request()->is('admin/deals*')) {{ 'active' }} @endif">
                <span class="app-menu__label">Deals Master</span>
                <i class="app-menu__icon fa fa-chevron-down"></i>
            </a>
        </li>
        <div id="collapseTwo" class="collapse @if (request()->is('admin/deals*')) {{ 'show' }} @endif"
            aria-labelledby="headingOne" data-parent="#accordion">
            <li>
                <a class="app-menu__item {{ request()->is('admin/deals/category*') ? 'active' : '' }}"
                    href="{{ route('admin.deals.category.index') }}">
                    <i class="app-menu__icon fa fa-archive"></i>
                    <span class="app-menu__label">Deals Category</span>
                </a>
            </li>
            <li>
                <a class="app-menu__item {{ request()->is('admin/deals*') ? 'active' : '' }}"
                    href="{{ route('admin.deals.index') }}">
                    <i class="app-menu__icon fa fa-folder"></i>
                    <span class="app-menu__label">All Deals</span>
                </a>
            </li>
            <li>
                <a class="app-menu__item {{ request()->is('admin/deals/page*') ? 'active' : '' }}"
                    href="{{ route('admin.deals.page.index') }}">
                    <i class="app-menu__icon fa fa-folder"></i>
                    <span class="app-menu__label">Page Content</span>
                </a>
            </li>
        </div>

        <!-- Course Management -->
        <li class="text-light" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true"
            aria-controls="collapseThree">
            <a href="#" class="app-menu__item @if (request()->is('admin/course-category*') || request()->is('admin/course*')) {{ 'active' }} @endif">
                <span class="app-menu__label">Course Master</span>
                <i class="app-menu__icon fa fa-chevron-down"></i>
            </a>
        </li>
        <div id="collapseThree" class="collapse @if (request()->is('admin/course*')) {{ 'show' }} @endif"
            aria-labelledby="headingOne" data-parent="#accordion">
            <li>
                <a class="app-menu__item {{ request()->is('admin/course/category*') ? 'active' : '' }}"
                    href="{{ route('admin.course-category.index') }}">
                    <i class="app-menu__icon fa fa-archive"></i>
                    <span class="app-menu__label">Category</span>
                </a>
            </li>
            <li>
                <a class="app-menu__item {{ request()->is('admin/course*') ? 'active' : '' }}"
                    href="{{ route('admin.course.index') }}">
                    <i class="app-menu__icon fa fa-folder"></i>
                    <span class="app-menu__label">Course</span>
                </a>
            </li>
            <li>
                <a class="app-menu__item {{ request()->is('admin/course/lesson*') ? 'active' : '' }}"
                    href="{{ route('admin.lesson.index') }}">
                    <i class="app-menu__icon fa fa-folder"></i>
                    <span class="app-menu__label">Lesson</span>
                </a>
            </li>
            <li>
                <a class="app-menu__item {{ request()->is('admin/course/topic*') ? 'active' : '' }}"
                    href="{{ route('admin.topic.index') }}">
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

            {{-- <li>
                <a class="app-menu__item {{ request()->is('admin/quiz') ? 'active' : '' }}"
                    href="{{ route('admin.quiz.index') }}">
                    <i class="app-menu__icon fa fa-folder"></i>
                    <span class="app-menu__label">Quiz</span>
                </a>
            </li> --}}
        </div>

        <!-- Order Management -->
        <li class="text-light" data-toggle="collapse" data-target="#collapseEight" aria-expanded="true"
            aria-controls="collapseEight">
            <a href="#" class="app-menu__item @if (request()->is('admin/orders*')) {{ 'active' }} @endif">
                <span class="app-menu__label">Order Master</span>
                <i class="app-menu__icon fa fa-chevron-down"></i>
            </a>
        </li>

        <div id="collapseEight" class="collapse @if (request()->is('admin/orders*')) {{ 'show' }} @endif"
            aria-labelledby="headingEight" data-parent="#accordion">
            {{-- Orders --}}
            <li>
                <a class="app-menu__item {{ request()->is('admin/orders*') ? 'active' : '' }} {{ sidebar_open(['admin.order']) }}"
                    href="{{ route('admin.order.index') }}">
                    <span class="app-menu__label">Orders</span>
                </a>
            </li>
        </div>
        
        <!-- Job Management -->
        <li class="text-light" data-toggle="collapse" data-target="#collapseNine" aria-expanded="true"
            aria-controls="collapseNine">
            <a href="#" class="app-menu__item @if (request()->is('admin/job*')) {{ 'active' }} @endif">
                <span class="app-menu__label">Job Master</span>
                <i class="app-menu__icon fa fa-chevron-down"></i>
            </a>
        </li>

        <div id="collapseNine" class="collapse @if (request()->is('admin/job*')) {{ 'show' }} @endif"
            aria-labelledby="headingOne" data-parent="#accordion">
            <li>
                <a class="app-menu__item {{ request()->is('admin/job/category*') ? 'active' : '' }}"
                    href="{{ route('admin.job.category.index') }}">
                    <i class="app-menu__icon fa fa-archive"></i>
                    <span class="app-menu__label">Category</span>
                </a>
            </li>
            <li>
                <a class="app-menu__item {{ request()->is('admin/job*') ? 'active' : '' }}"
                    href="{{ route('admin.job.index') }}"><i class="app-menu__icon fa fa-cogs"></i>
                    <span class="app-menu__label">Management</span>
                </a>
            </li>
        </div>
        <!-- Template Management -->
        <li class="text-light" data-toggle="collapse" data-target="#collapseTen" aria-expanded="true"
            aria-controls="collapseTen">
            <a href="#" class="app-menu__item @if (request()->is('admin/template/category') ||
                request()->is('admin/template/subcategory') ||
                request()->is('admin/template/type') ||
                request()->is('admin/template')) {{ 'active' }} @endif">
                <span class="app-menu__label">Template Master</span>
                <i class="app-menu__icon fa fa-chevron-down"></i>
            </a>
        </li>

        <div id="collapseTen" class="collapse @if (request()->is('admin/template/category') ||
            request()->is('admin/template/subcategory') ||
            request()->is('admin/template/type') ||
            request()->is('admin/template')) {{ 'show' }} @endif"
            aria-labelledby="headingOne" data-parent="#accordion">
            <li>
                <a class="app-menu__item {{ request()->is('admin/template/category') ? 'active' : '' }}"
                    href="{{ route('admin.template.category.index') }}">
                    <i class="app-menu__icon fa fa-archive"></i>
                    <span class="app-menu__label">Category</span>
                </a>
            </li>
            <li>
                <a class="app-menu__item {{ request()->is('admin/template/subcategory') ? 'active' : '' }}"
                    href="{{ route('admin.template.subcategory.index') }}"><i class="app-menu__icon fa fa-cogs"></i>
                    <span class="app-menu__label">Subcategory</span>
                </a>
            </li>
            <li>
                <a class="app-menu__item {{ request()->is('admin/template/type') ? 'active' : '' }}"
                    href="{{ route('admin.template.type.index') }}"><i class="app-menu__icon fa fa-cogs"></i>
                    <span class="app-menu__label">Type</span>
                </a>
            </li>
            <li>
                <a class="app-menu__item {{ request()->is('admin/template') ? 'active' : '' }}"
                    href="{{ route('admin.template.index') }}"><i class="app-menu__icon fa fa-cogs"></i>
                    <span class="app-menu__label">Management</span>
                </a>
            </li>
        </div>

        {{-- Master Management --}}
        <li class="text-light" data-toggle="collapse" data-target="#collapseFourteen" aria-expanded="true"
            aria-controls="collapseFourteen">
            <a class="app-menu__item @if (request()->is('admin/master*')) {{ 'active' }} @endif">
                <span class="app-menu__label">Master Management</span>
                <i class="app-menu__icon fa fa-chevron-down"></i>
            </a>
        </li>
        <div id="collapseFourteen" class="collapse @if (request()->is('admin/master*')) {{ 'show' }} @endif"
            aria-labelledby="headingOne" data-parent="#accordion">
            <li>
                <a class="app-menu__item {{ request()->is('admin/master/socialmedia*') ? 'active' : '' }}"
                    href="{{ route('admin.socialmedia.master.index') }}"><i class="app-menu__icon fa fa-cogs"></i>
                    <span class="app-menu__label">Social Media Management</span>
                </a>
            </li>
            <li>
                <a class="app-menu__item {{ request()->is('admin/master/language*') ? 'active' : '' }}"
                    href="{{ route('admin.language.master.index') }}"><i class="app-menu__icon fa fa-cogs"></i>
                    <span class="app-menu__label">Language Management</span>
                </a>
            </li>
            <li>
                <a class="app-menu__item {{ request()->is('admin/master/currency*') ? 'active' : '' }}"
                    href="{{ route('admin.plans.category.index') }}">
                    <i class="app-menu__icon fa fa-archive"></i>
                    <span class="app-menu__label">Currency Management</span>
                </a>
            </li>
        </div>
        {{-- - footer - --}}
            <li>
                <a class="app-menu__item {{ request()->is('admin/footer*') ? 'active' : '' }}"
                    href="{{ route('admin.footer.content.index') }}"><i class="app-menu__icon fa fa-cogs"></i>
                    <span class="app-menu__label">Footer Content</span>
                </a>
            </li>
            <li>
                <a class="app-menu__item {{ request()->is('admin/settings*') ? 'active' : '' }}"
                    href="{{ route('admin.settings.index') }}"><i class="app-menu__icon fa fa-cogs"></i>
                    <span class="app-menu__label">Settings</span>
                </a>
            </li>
    </ul>
</aside>
