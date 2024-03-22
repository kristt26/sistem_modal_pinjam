<?= $this->extend('layout/user/layout') ?>
<?= $this->section('content') ?>
<div ng-controller="angsuranController">
    <div class="row">
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-header">
                    <h4 class="header-title">Pinjaman</h4>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal Pengajuan</th>
                                    <th>Besar Pinjaman</th>
                                    <th>Lama Pinjaman</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="item in datas">
                                    <td>{{$index+1}}</td>
                                    <td>{{item.tanggal_pengajuan}}</td>
                                    <td>{{item.nominal | currency: 'Rp. '}}</td>
                                    <td>{{item.waktu}} Minggu</td>
                                    <td>{{item.status=='Diterima' ? 'Aktif': 'Lunas'}}</td>
                                    <td>
                                        <a href="angsuran/detail/{{item.id}}" class="btn btn-info btn-xs" title="Detail Angsuran" data-toggle="tooltip" data-placement="top" tooltip><i class="ti-book"></i></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>