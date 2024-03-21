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
                                    <th>Berkas</th>
                                    <th>Status</th>
                                    <!-- <th>Action</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="item in datas">
                                    <td>{{$index+1}}</td>
                                    <td>{{item.tanggal_pengajuan}}</td>
                                    <td>
                                        <p ng-repeat="berkas in item.detail"><a href="assets/berkas/{{berkas.file}}" target="_blank">{{berkas.kelengkapan}}</a></p>
                                    </td>
                                    <td>{{item.status=='Validasi' ? 'Validasi Berkas':item.status=='Survey' ? 'Survey Lokasi' : item.status=='Diterima' ? 'Permohonan Diterima' : 'Pemohonan Ditolak'}}</td>
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