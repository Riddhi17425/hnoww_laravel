<!-- sidebar -->
<div class="sidebar px-4 py-4 py-md-4 me-0">
    <div class="d-flex flex-column h-100">
        <a href="{!! route('admin.dashboard') !!}" class="mb-0 brand-icon">
            <span class="logo-icon">
                <i class="bi bi-bag-check-fill fs-4"></i>
            </span>
            <span class="logo-text">{{ Auth::guard('admin')->user()->name }}</span>
        </a>
        <ul class="menu-list flex-grow-1 mt-3">
            <li><a class="m-link" href="{!! route('admin.dashboard') !!}"><i class="icofont-home fs-5"></i><span>Dashboard</span></a></li>
            <li class="{{ request()->routeIs('admin.categories*') ? '' : 'collapsed' }}">
                <a class="m-link {{ request()->routeIs('admin.categories*') ? 'active' : '' }}" data-bs-toggle="collapse" data-bs-target="#categories" href="#">
                    <i class="icofont-listing-box fs-5"></i> <span>Categories</span> <span class="arrow icofont-rounded-down ms-auto text-end fs-5"></span></a>
                <!-- Menu: Sub menu ul -->
                <ul class="sub-menu collapse {{ request()->routeIs('admin.categories*') ? 'show' : '' }}" id="categories">
                    <li><a class="ms-link {{ request()->routeIs('admin.categories.index') ? 'active' : '' }}" href="{{ route('admin.categories.index') }}">Category List</a></li>
                    <li><a class="ms-link {{ request()->routeIs('admin.categories.create') ? 'active' : '' }}" href="{{ route('admin.categories.create') }}">Category Add</a></li>
                </ul>
            </li>

            <li class="{{ request()->routeIs('admin.products*') ? '' : 'collapsed' }}">
                <a class="m-link {{ request()->routeIs('admin.products*') ? 'active' : '' }}" data-bs-toggle="collapse" data-bs-target="#products" href="#">
                    <i class="icofont-box fs-5"></i> <span>Products</span> <span class="arrow icofont-rounded-down ms-auto text-end fs-5"></span></a>
                <!-- Menu: Sub menu ul -->
                <ul class="sub-menu collapse {{ request()->routeIs('admin.products*') ? 'show' : '' }}" id="products">
                    <li><a class="ms-link {{ request()->routeIs('admin.products.index') ? 'active' : '' }}" href="{{ route('admin.products.index') }}">Products List</a></li>
                    <li><a class="ms-link {{ request()->routeIs('admin.products.create') ? 'active' : '' }}" href="{{ route('admin.products.create') }}">Product Add</a></li>
                </ul>
            </li>

            <li class="{{ request()->routeIs('admin.product-tabs*') ? '' : 'collapsed' }}">
                <a class="m-link {{ request()->routeIs('admin.product-tabs*') ? 'active' : '' }}" data-bs-toggle="collapse" data-bs-target="#product-tabs" href="#">
                    <i class="icofont-chart-flow fs-5"></i> <span>Product Tabs</span> <span class="arrow icofont-rounded-down ms-auto text-end fs-5"></span></a>
                <!-- Menu: Sub menu ul -->
                <ul class="sub-menu collapse {{ request()->routeIs('admin.product-tabs*') ? 'show' : '' }}" id="product-tabs">
                    <li><a class="ms-link {{ request()->routeIs('admin.product-tabs.index') ? 'active' : '' }}" href="{{ route('admin.product-tabs.index') }}">Products List</a></li>
                    <li><a class="ms-link {{ request()->routeIs('admin.product-tabs.create') ? 'active' : '' }}" href="{{ route('admin.product-tabs.create') }}">Product Add</a></li>
                </ul>
            </li>

            {{-- <li class="{{ request()->routeIs('admin.product-images*') ? '' : 'collapsed' }}">
                <a class="m-link {{ request()->routeIs('admin.product-images*') ? 'active' : '' }}" data-bs-toggle="collapse" data-bs-target="#product-images" href="#">
                    <i class="icofont-image fs-5"></i> <span>Product Images</span> <span class="arrow icofont-rounded-down ms-auto text-end fs-5"></span></a>
                <!-- Menu: Sub menu ul -->
                <ul class="sub-menu collapse {{ request()->routeIs('admin.product-images*') ? 'show' : '' }}" id="product-images">
                    <li><a class="ms-link {{ request()->routeIs('admin.product-images.index') ? 'active' : '' }}" href="{{ route('admin.product-images.index') }}">Products List</a></li>
                    <li><a class="ms-link {{ request()->routeIs('admin.product-images.create') ? 'active' : '' }}" href="{{ route('admin.product-images.create') }}">Product Add</a></li>
                </ul>
            </li> --}}

            <li class="{{ request()->routeIs('admin.giftshops*') ? '' : 'collapsed' }}">
                <a class="m-link {{ request()->routeIs('admin.giftshops*') ? 'active' : '' }}" data-bs-toggle="collapse" data-bs-target="#giftshops" href="#">
                    <i class="icofont icofont-gift-box fs-5"></i> <span>Gift Shop</span> <span class="arrow icofont-rounded-down ms-auto text-end fs-5"></span></a>
                <!-- Menu: Sub menu ul -->
                <ul class="sub-menu collapse {{ request()->routeIs('admin.giftshops*') ? 'show' : '' }}" id="giftshops">
                    <li><a class="ms-link {{ request()->routeIs('admin.giftshops.index') ? 'active' : '' }}" href="{{ route('admin.giftshops.index') }}">Gift List</a></li>
                    <li><a class="ms-link {{ request()->routeIs('admin.giftshops.create') ? 'active' : '' }}" href="{{ route('admin.giftshops.create') }}">Gift Add</a></li>
                </ul>
            </li>

            <li class="{{ request()->routeIs('admin.corporate-kits*') ? '' : 'collapsed' }}">
                <a class="m-link {{ request()->routeIs('admin.corporate-kits*') ? 'active' : '' }}" data-bs-toggle="collapse" data-bs-target="#corporate-kits" href="#">
                    <i class="icofont icofont-briefcase-2 fs-5"></i> <span>Corporate Kits</span> <span class="arrow icofont-rounded-down ms-auto text-end fs-5"></span></a>
                <!-- Menu: Sub menu ul -->
                <ul class="sub-menu collapse {{ request()->routeIs('admin.corporate-kits*') ? 'show' : '' }}" id="corporate-kits">
                    <li><a class="ms-link {{ request()->routeIs('admin.corporate-kits.index') ? 'active' : '' }}" href="{{ route('admin.corporate-kits.index') }}">Corporate Kit List</a></li>
                    <li><a class="ms-link {{ request()->routeIs('admin.corporate-kits.create') ? 'active' : '' }}" href="{{ route('admin.corporate-kits.create') }}">Corporate Kit Add</a></li>
                </ul>
            </li>

            <li class="{{ request()->routeIs('admin.journals*') ? '' : 'collapsed' }}">
                <a class="m-link {{ request()->routeIs('admin.journals.*') ? 'active' : '' }}" data-bs-toggle="collapse" data-bs-target="#menu-journals" href="#">
                    <i class="icofont-notepad fs-5"></i> <span>Journals</span> <span class="arrow icofont-rounded-down ms-auto text-end fs-5"></span></a>
                    <!-- Menu: Sub menu ul -->
                    <ul class="sub-menu collapse {{ request()->routeIs('admin.journals*') ? 'show' : '' }}" id="menu-journals">
                        <li><a class="ms-link {{ request()->routeIs('admin.journals.index') ? 'active' : '' }}" href="{{ route('admin.journals.index') }}">List</a></li>
                        <li><a class="ms-link {{ request()->routeIs('admin.journals.create') ? 'active' : '' }}" href="{{ route('admin.journals.create') }}">Add</a></li>
                    </ul>
            </li>

            <li class="{{ request()->routeIs('admin.blessings*') ? '' : 'collapsed' }}">
                <a class="m-link {{ request()->routeIs('admin.blessings.*') ? 'active' : '' }}" data-bs-toggle="collapse" data-bs-target="#menu-blessings" href="#">
                    <i class="icofont-star-alt-1 fs-5"></i> <span>Blessings</span> <span class="arrow icofont-rounded-down ms-auto text-end fs-5"></span></a>
                    <!-- Menu: Sub menu ul -->
                    <ul class="sub-menu collapse {{ request()->routeIs('admin.blessings*') ? 'show' : '' }}" id="menu-blessings">
                        <li><a class="ms-link {{ request()->routeIs('admin.blessings.index') ? 'active' : '' }}" href="{{ route('admin.blessings.index') }}">List</a></li>
                        <li><a class="ms-link {{ request()->routeIs('admin.blessings.create') ? 'active' : '' }}" href="{{ route('admin.blessings.create') }}">Add</a></li>
                    </ul>
            </li>

            <li class="{{ request()->routeIs('admin.ceremonials*') ? '' : 'collapsed' }}">
                <a class="m-link {{ request()->routeIs('admin.ceremonials*') ? 'active' : '' }}" data-bs-toggle="collapse" data-bs-target="#ceremonials" href="#">
                    <i class="icofont-box fs-5"></i> <span>Ceremonials</span> <span class="arrow icofont-rounded-down ms-auto text-end fs-5"></span></a>
                <!-- Menu: Sub menu ul -->
                <ul class="sub-menu collapse {{ request()->routeIs('admin.ceremonials*') ? 'show' : '' }}" id="ceremonials">
                    <li><a class="ms-link {{ request()->routeIs('admin.ceremonials.index') ? 'active' : '' }}" href="{{ route('admin.ceremonials.index') }}">Ceremonial List</a></li>
                    <li><a class="ms-link {{ request()->routeIs('admin.ceremonials.create') ? 'active' : '' }}" href="{{ route('admin.ceremonials.create') }}">Ceremonial Add</a></li>
                </ul>
            </li>

            <li class="{{ request()->routeIs('admin.faqs*') ? '' : 'collapsed' }}">
                <a class="m-link {{ request()->routeIs('admin.faqs.*') ? 'active' : '' }}" data-bs-toggle="collapse" data-bs-target="#menu-faqs" href="#">
                    <i class="icofont-info-circle fs-5"></i> <span>Faqs</span> <span class="arrow icofont-rounded-down ms-auto text-end fs-5"></span></a>
                    <!-- Menu: Sub menu ul -->
                    <ul class="sub-menu collapse {{ request()->routeIs('admin.faqs*') ? 'show' : '' }}" id="menu-faqs">
                        <li><a class="ms-link {{ request()->routeIs('admin.faqs.index') ? 'active' : '' }}" href="{{ route('admin.faqs.index') }}">List</a></li>
                        <li><a class="ms-link {{ request()->routeIs('admin.faqs.create') ? 'active' : '' }}" href="{{ route('admin.faqs.create') }}">Add</a></li>
                    </ul>
            </li>

        </ul>

        <!-- Menu: menu collepce btn -->
        <button type="button" class="btn btn-link sidebar-mini-btn text-light">
            <span class="ms-2"><i class="icofont-bubble-right"></i></span>
        </button>
    </div>
</div>