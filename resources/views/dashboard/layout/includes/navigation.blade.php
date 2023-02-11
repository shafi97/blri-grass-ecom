<ul class="metismenu" id="menu">
    <li>
        <a href="{{ route('admin.dashboard') }}">
            <div class="parent-icon">
                <ion-icon name="home-sharp"></ion-icon>
            </div>
            <div class="menu-title">Dashboard</div>
        </a>
    </li>
    <li class="menu-label">Elements</li>
    <li>
        <a href="javascript:;" class="has-arrow">
            <div class="parent-icon">
                <i class="fa-solid fa-user-shield"></i>
            </div>
            <div class="menu-title">Admin</div>
        </a>
        <ul>
            <li class="{{ activeNav('admin.admin-user.*') }}">
                <a href="{{ route('admin.admin-user.index') }}">
                    <ion-icon name="ellipse-outline"></ion-icon>Admin User
                </a>
            </li>
        </ul>
    </li>
    {{-- Slider --}}
    <li>
        <a href="{{ route('admin.slider.index') }}">
            <div class="parent-icon">
                <i class="fa-regular fa-images"></i>
            </div>
            <div class="menu-title">Slider</div>
        </a>
    </li>
    <li>
        <a href="javascript:;" class="has-arrow">
            <div class="parent-icon">
                <i class="fa-solid fa-list-ul"></i>
            </div>
            <div class="menu-title">Category</div>
        </a>
        <ul>
            <li>
                <a href="{{ route('admin.category.index') }}">
                    <ion-icon name="ellipse-outline"></ion-icon>Category
                </a>
            </li>
            <li>
                <a href="{{ route('admin.sub-category.index') }}">
                    <ion-icon name="ellipse-outline"></ion-icon>Sub Category
                </a>
            </li>
        </ul>
    </li>
    {{-- Product --}}
    <li>
        <a href="{{ route('admin.product.index') }}">
            <div class="parent-icon">
                <ion-icon name="document-text-sharp"></ion-icon>
            </div>
            <div class="menu-title">Product</div>
        </a>
    </li>

    {{-- Order --}}
    <li>
        <a href="{{ route('admin.order.index') }}">
            <div class="parent-icon">
                <ion-icon name="document-text-sharp"></ion-icon>
            </div>
            <div class="menu-title">Order</div>
        </a>
    </li>

    {{-- stock --}}
    <li>
        <a href="{{ route('admin.stock.index') }}">
            <div class="parent-icon">
                <ion-icon name="document-text-sharp"></ion-icon>
            </div>
            <div class="menu-title">Stock</div>
        </a>
    </li>

    <li>
        <a href="javascript:;" class="has-arrow">
            <div class="parent-icon">
                <ion-icon name="bag-handle-sharp"></ion-icon>
            </div>
            <div class="menu-title">Blank</div>
        </a>
        <ul>
            <li>
                <a href="{{ route('admin.blank.index') }}">
                    <ion-icon name="ellipse-outline"></ion-icon>Index
                </a>
            </li>
            <li>
                <a href="{{ route('admin.blank.create') }}">
                    <ion-icon name="ellipse-outline"></ion-icon>create
                </a>
            </li>
        </ul>
    </li>



    {{-- settings --}}
    <li class="menu-label">settings</li>
    <li>
        <a href="javascript:;" class="has-arrow">
            <div class="parent-icon">
                <i class="fa-solid fa-gear"></i>
            </div>
            <div class="menu-title">Settings</div>
        </a>
        <ul>
            <li class="{{ activeNav('admin.permission.*') }}">
                <a href="{{ route('admin.role.index') }}">
                    <ion-icon name="ellipse-outline"></ion-icon>Roles & Permission
                </a>
            </li>
            <li class="{{ activeNav('admin.backup.*') }}">
                <a href="{{ route('admin.backup.password') }}">
                    <ion-icon name="ellipse-outline"></ion-icon>App DB Backup
                </a>
            </li>
        </ul>
    </li>

    <li>
        <br>
        <br>
        <form action="{{ route('logout') }}" method="post">
            @csrf
            <button type="submit" class="btn btn-danger btn-sm" style="width: 100%">
                <i class="fa-solid fa-right-from-bracket"></i>
                Logout
            </button>
        </form>
    </li>

    {{-- <li class="menu-label">Others</li> --}}
    {{-- <li>
        <a class="has-arrow" href="javascript:;">
            <div class="parent-icon">
                <ion-icon name="list-sharp"></ion-icon>
            </div>
            <div class="menu-title">Menu Levels</div>
        </a>
        <ul>
            <li> <a class="has-arrow" href="javascript:;">
                    <ion-icon name="ellipse-outline"></ion-icon>Level One
                </a>
                <ul>
                    <li> <a class="has-arrow" href="javascript:;">
                            <ion-icon name="ellipse-outline"></ion-icon>Level Two
                        </a>
                        <ul>
                            <li> <a href="javascript:;">
                                    <ion-icon name="ellipse-outline"></ion-icon>Level Three
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
        </ul>
    </li> --}}

    {{-- <li>
        <a href="javascript:;" target="_blank">
            <div class="parent-icon">
                <ion-icon name="document-text-sharp"></ion-icon>
            </div>
            <div class="menu-title">Documentation</div>
        </a>
    </li> --}}
</ul>
