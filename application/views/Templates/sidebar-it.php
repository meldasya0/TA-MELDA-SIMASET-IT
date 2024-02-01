
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo base_url("IT/dashboard");?>">
                <div class="sidebar-brand-icon rotate-n-15">
                  
                </div>
                <div class="sidebar-brand-text mx-3">SIMAset-IT </div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url("IT/dashboard");?>">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

        
            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed"  data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Data Master</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Data Master</h6>
                        <a class="collapse-item" href="<?php echo base_url("IT/User");?>">Users</a>
                        <a class="collapse-item"  href="<?php echo base_url("IT/Divisi");?>">Divisi</a>
                        <a class="collapse-item"  href="<?php echo base_url("IT/Departemen");?>">Departemen</a>
                        <h6 class="collapse-header">Tipe Hardware</h6>
                        <a class="collapse-item" href="<?php echo base_url("IT/Tipe");?>">Tipe</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed"  data-toggle="collapse" data-target="#collapseData"
                    aria-expanded="true" aria-controls="#collapseData">
                    <i class="fas fa-database"></i>
                    <span>Data Aset</span>
                </a>
                <div id="collapseData" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Data Aset</h6>
                        <a class="collapse-item" href="<?php echo base_url("IT/Software");?>">Software</a>
                        <a class="collapse-item" href="<?php echo base_url("IT/Hardware");?>">Hardware</a>
                    </div>
                </div>
            </li>
            

            
             <!-- Nav Item - Utilities Collapse Menu -->
             <li class="nav-item">
                <a class="nav-link "  href="<?php echo base_url("IT/HistoryPerbaikan");?>">
                <i class="fas fa-tools"></i>
                    <span>History Perbaikan</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link " href="<?php echo base_url("IT/HistoryPeminjaman");?>">
                <i class="fas fa-truck-loading"></i>
                    <span>History Peminjaman</span>
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link collapsed"  data-toggle="collapse" data-target="#collapselaporan"
                    aria-expanded="true" aria-controls="#collapselaporan">
                    <i class="fas fa-poll-h"></i>
                    <span>Laporan</span>
                </a>
                <div id="collapselaporan" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Laporan</h6>
                        <a class="collapse-item" href="<?php echo base_url("IT/Laporan/Aset");?>">Data Aset </a>
                        <a class="collapse-item" href="<?php echo base_url("IT/Laporan/Peminjaman");?>">History Peminjaman</a>
                        <a class="collapse-item"  href="<?php echo base_url("IT/Laporan/Perbaikan");?>">History perbaikan</a>
                    </div>
                </div>
            </li>
            <!-- Nav Item - Tables -->
            <!-- <li class="nav-item">
                <a class="nav-link " href="<?php echo base_url("IT/laporan");?>">
                <i class="fas fa-truck-loading"></i>
                    <span>Laporan</span>
                </a>
            </li> -->

          

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- <a class="collapse-item"  href="<?php echo base_url("IT/Software");?>">Software</a>
                        <a class="collapse-item"  href="<?php echo base_url("IT/Hardware");?>">Hardware</a> -->