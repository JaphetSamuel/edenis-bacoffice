<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="../../index3.html" class="brand-link">
        <img src="/images/LOGOEDENIS.png" alt="AdminLTE Logo" class="brand-image" style="opacity: .8">
        <span class="brand-text font-weight-light">Back Office</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ route('dash') }}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('network.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Network

                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Wallet
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('deposit.index')}}" class="nav-link">
                                <i class="nav-icon fas fa-copy"></i>
                                <p>
                                    Deposit
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('withdrawal.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-copy"></i>
                                <p>
                                    Withdraw
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('packs.create') }}" class="nav-link">
                                <i class="nav-icon fas fa-copy"></i>
                                <p>
                                    Package
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('transaction.list')}}" class="nav-link">
                                <i class="nav-icon fas fa-copy"></i>
                                <p>
                                    Transaction History
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{route('settings.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>
                            Settings
                        </p>
                    </a>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
