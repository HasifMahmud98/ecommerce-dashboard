<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" key="t-menu">Menu</li>

                <li>
                    <a href="{{ route('home') }}" class="waves-effect">
                        <i class="bx bx-home-circle"></i>
                        <span key="">Dashboards</span>
                    </a>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-user-circle"></i>
                        <span key="t-admin">Admin</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('product.index') }}" key="t-products">Products</a></li>
                        <li><a href="{{ route('category.index') }}" key="t-product-detail">Category</a></li>
                        <li><a href="{{ route('subcategory.index') }}" key="t-orders">Subcategory</a></li>
                    </ul>
                </li>

                <li>
                    <a href="{{ route('shop') }}" class="waves-effect">
                        <i class="bx bx-store"></i>
                        <span key="t-shop">Shop</span>
                    </a>
                </li>

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->