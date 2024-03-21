<div class="main-menu">
    <div class="menu-inner">
        <nav>
            <ul class="metismenu" id="menu">
                <li ng-class="{'active': header=='beranda'}"><a href="home"><i class="ti-dashboard"></i><span>dashboard</span></a></li>
                <?php if (session()->get('role') == 'Staf') : ?>
                    <li ng-class="{'active': header=='Setting Kelengkapan Berkas'}"><a href="kelengkapan"><i class="ti-view-list"></i><span>Kelengkapan Berkas</span></a></li>
                    <li ng-class="{'active': header=='Mustahik'}"><a href="mustahik"><i class="ti-user"></i><span>Mustahik</span></a></li>
                    <li ng-class="{'active': header=='Daftar Permohonan'}"><a href="permohonan"><i class="ti-bookmark-alt"></i><span>Permohonan</span></a></li>
                    <li ng-class="{'active': header=='Laporan'}"><a href="permohonan"><i class="ti-files"></i><span>Laporan</span></a></li>
                <?php endif; ?>
                <?php if (session()->get('role') == 'Ketua') : ?>
                    <li ng-class="{'active': header=='Manajemen User'}"><a href="mustahik"><i class="ti-user"></i><span>Manajemen User</span></a></li>
                    <li ng-class="{'active': header=='Daftar Permohonan'}"><a href="permohonan"><i class="ti-bookmark-alt"></i><span>Permohonan</span></a></li>
                    <li>
                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-files"></i><span>Laporan</span></a>
                        <ul class="collapse">
                            <li><a href="accordion.html">Mustahik</a></li>
                        </ul>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</div>