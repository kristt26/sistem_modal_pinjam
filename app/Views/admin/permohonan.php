<?= $this->extend('layout/admin/layout') ?>
<?= $this->section('content') ?>
<div ng-controller="permohonanController">
    <div class="row">
        <div class="col-12 mt-4">
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" ng-click="setData('Validasi')" id="validasi-tab" data-toggle="tab" href="#validasi" role="tab" aria-controls="validasi" aria-selected="true">Validasi Berkas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" ng-click="setData('Survey')" id="survey-tab" data-toggle="tab" href="#survey" role="tab" aria-controls="survey" aria-selected="false">Survey Lokasi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" ng-click="setData('Diterima')" id="diterima-tab" data-toggle="tab" href="#diterima" role="tab" aria-controls="diterima" aria-selected="false">Permohonan Diterima</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" ng-click="setData('Ditolak')" id="ditolak-tab" data-toggle="tab" href="#ditolak" role="tab" aria-controls="ditolak" aria-selected="false">Permohonan Ditolak</a>
                        </li>
                    </ul>
                    <div class="tab-content mt-3" id="myTabContent">
                        <div class="tab-pane fade show active" id="validasi" role="tabpanel" aria-labelledby="validasi-tab">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Pemohon</th>
                                            <th>NIK</th>
                                            <th>HP</th>
                                            <th>Berkas</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr ng-repeat="item in datas">
                                            <td>{{$index+1}}</td>
                                            <td>{{item.nama}}</td>
                                            <td>{{item.nik}}</td>
                                            <td>{{item.kontak}}</td>
                                            <td>
                                                <p ng-repeat="berkas in item.detail"><a href="assets/berkas/{{berkas.file}}" target="_blank">{{berkas.kelengkapan}}</a></p>
                                            </td>
                                            <td>
                                                <button class="btn btn-warning btn-xs" title="Ubah data" data-toggle="tooltip" data-placement="top" tooltip><i class="ti-pencil"></i></button>
                                                <button class="btn btn-primary btn-xs" title="Validasi Berkas" ng-click="setuju(item.id,'Survey')" data-toggle="tooltip" data-placement="top" tooltip><i class="ti-check"></i></button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="survey" role="tabpanel" aria-labelledby="survey-tab">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Pemohon</th>
                                            <th>NIK</th>
                                            <th>HP</th>
                                            <th>Alamat</th>
                                            <!-- <th>Action</th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr ng-repeat="item in datas">
                                            <td>{{$index+1}}</td>
                                            <td>{{item.nama}}</td>
                                            <td>{{item.nik}}</td>
                                            <td>{{item.kontak}}</td>
                                            <td>{{item.alamat}}</td>
                                            <!-- <td>
                                                <button class="btn btn-warning btn-xs" title="Ubah data" data-toggle="tooltip" data-placement="top" tooltip><i class="ti-pencil"></i></button>
                                                <button class="btn btn-primary btn-xs" title="Validasi Berkas" ng-click="setuju('Disetujui')" data-toggle="tooltip" data-placement="top" tooltip><i class="ti-check"></i></button>
                                            </td> -->
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="diterima" role="tabpanel" aria-labelledby="diterima-tab">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Pemohon</th>
                                            <th>NIK</th>
                                            <th>HP</th>
                                            <th>Alamat</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr ng-repeat="item in datas">
                                            <td>{{$index+1}}</td>
                                            <td>{{item.nama}}</td>
                                            <td>{{item.nik}}</td>
                                            <td>{{item.kontak}}</td>
                                            <td>{{item.alamat}}</td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="ditolak" role="tabpanel" aria-labelledby="ditolak-tab">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Pemohon</th>
                                            <th>NIK</th>
                                            <th>HP</th>
                                            <th>Alamat</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr ng-repeat="item in datas">
                                            <td>{{$index+1}}</td>
                                            <td>{{item.nama}}</td>
                                            <td>{{item.nik}}</td>
                                            <td>{{item.kontak}}</td>
                                            <td>{{item.alamat}}</td>
                                            <td>
                                                <button class="btn btn-info btn-xs"><i class="ti-pencil"></i></button>
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
    </div>
</div>
<?= $this->endSection() ?>