<div class="main-menu">
    <div class="menu-inner">
        <nav>
            <ul class="metismenu" id="menu">
                <li ng-class="{'active': beranda}"><a href="home"><i class="ti-dashboard"></i><span>dashboard</span></a></li>
                <li ng-class="{'active': colapse=='data'}">
                    <a href="javascript:void(0)" aria-expanded="true"><i class="ti-view-list"></i><span>Manajemen Data
                        </span></a>
                    <ul  ng-class="{'collapse in': colapse=='data', 'collapse': colapse!='data'}">
                        <li ng-class="{'active': header=='Setting Kelengkapan Berkas'}"><a href="kelengkapan">Kelengkapan Berkas</a></li>
                        <li ng-class="{'active': header=='Mustahik'}"><a href="mustahik">Mustahik</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</div>