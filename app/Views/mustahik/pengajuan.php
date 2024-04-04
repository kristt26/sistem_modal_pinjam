<?= $this->extend('layout/user/layout') ?>
<?= $this->section('content') ?>
<div ng-controller="pengajuanController">
    <div class="row">
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3">
                        <h4 class="header-title">Daftar Permohonan</h4>
                        <button class="btn btn-info btn-xs" ng-click="add()"><i class="ti-plus"></i></button>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal Pengajuan</th>
                                    <th>Besar Pinjaman</th>
                                    <th>Lama Pinjaman</th>
                                    <th>Berkas</th>
                                    <th>Tahapan</th>
                                    <th>Status</th>
                                    <!-- <th>Action</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="item in datas" ng-class="{'bg-warning': item.status=='Draf', 'bg-info text-white': item.tahapan=='Diterima'}">
                                    <td>{{$index+1}}</td>
                                    <td>{{item.tanggal_pengajuan}}</td>
                                    <td>{{item.nominal | currency: 'Rp. '}}</td>
                                    <td>{{item.waktu}} Minggu</td>
                                    <td>
                                        <p ng-repeat="berkas in item.detail"><a href="assets/berkas/{{berkas.file}}" ng-class="{'text-white': item.tahapan=='Diterima'}" target="_blank">{{berkas.kelengkapan}}</a></p>
                                    </td>
                                    <td>{{item.tahapan=='Pengajuan' ? 'Validasi Berkas':item.tahapan=='Validasi' ? 'Survey Lokasi' : item.tahapan=='Survey' ? 'Menunggu Persetujuan' : item.tahapan=='Diterima' ? 'Permohonan Disetujui':'Pemohonan Ditolak'}}</td>
                                    <td>{{item.status=='Diajukan' ? 'Pengajuan sedang di proses': item.status=='Diterima' ? 'Diterima' : 'Pengajuan di kembalikan'}}</td>
                                    <!-- <td>
                                        <button type="button" class="btn btn-warning btn-xs" ng-click="edit(item)"><i class="ti-pencil"></i></button>
                                        <button type="button" class="btn btn-danger btn-xs" ng-click="delete(item)"><i class="ti-trash"></i></button>
                                    </td> -->
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