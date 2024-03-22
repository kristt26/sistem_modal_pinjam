<?= $this->extend('layout/admin/layout') ?>
<?= $this->section('content') ?>
<div ng-controller="permohonanController">
    <div class="row">
        <div class="col-12 mt-4">
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" ng-click="setData('Pengajuan')" id="validasi-tab" data-toggle="tab" href="" data-target="#validasi" role="tab" aria-controls="validasi" aria-selected="true">Validasi Berkas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" ng-click="setData('Validasi')" id="survey-tab" data-toggle="tab" href="" data-target="#survey" role="tab" aria-controls="survey" aria-selected="false">Survey Lokasi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" ng-click="setData('Survey')" id="diterima-tab" data-toggle="tab" href="" data-target="#diterima" role="tab" aria-controls="diterima" aria-selected="false">Permohonan Diterima</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" ng-click="setData('Ditolak')" id="ditolak-tab" data-toggle="tab" href="" data-target="#ditolak" role="tab" aria-controls="ditolak" aria-selected="false">Permohonan Ditolak</a>
                        </li>
                    </ul>
                    <div class="tab-content mt-3" id="myTabContent">
                        <div class="tab-pane fade show active" id="validasi" role="tabpanel" aria-labelledby="validasi-tab">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>No. Anggota</th>
                                            <th>Pemohon</th>
                                            <th>NIK</th>
                                            <th>HP</th>
                                            <th>Berkas</th>
                                            <th>Besar Pnj.</th>
                                            <th>Lama Pnj.</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr ng-repeat="item in datas" ng-class="{'bg-warning': item.status=='Draf'}">
                                            <td>{{$index+1}}</td>
                                            <td>{{item.nomor}}</td>
                                            <td>{{item.nama}}</td>
                                            <td>{{item.nik}}</td>
                                            <td>{{item.kontak}}</td>
                                            <td>
                                                <p ng-repeat="berkas in item.detail"><a href="assets/berkas/{{berkas.file}}" target="_blank">{{berkas.kelengkapan}}</a></p>
                                            </td>
                                            <td>{{item.nominal | currency: 'Rp. '}}</td>
                                            <td>{{item.waktu}} Minggu</td>
                                            <td>
                                                <button ng-show="item.status!='Draf'" class="btn btn-warning btn-xs" ng-click="kembalikan(item)" title="Kembalikan" data-toggle="tooltip" data-placement="top" tooltip><i class="ti-pencil"></i></button>
                                                <button ng-show="item.status!='Draf'" class="btn btn-primary btn-xs" title="Validasi Berkas" ng-click="setuju(item.id,'Validasi')" data-toggle="tooltip" data-placement="top" tooltip><i class="ti-check"></i></button>
                                                <label ng-show="item.status=='Draf'">Dikembalikan</label>
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
                                            <th>No. Anggota</th>
                                            <th>Pemohon</th>
                                            <th>NIK</th>
                                            <th>HP</th>
                                            <th>Alamat</th>
                                            <th>Besar Pnj.</th>
                                            <th>Lama Pnj.</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr ng-repeat="item in datas">
                                            <td>{{$index+1}}</td>
                                            <td>{{item.nomor}}</td>
                                            <td>{{item.nama}}</td>
                                            <td>{{item.nik}}</td>
                                            <td>{{item.kontak}}</td>
                                            <td>{{item.alamat}}</td>
                                            <td>{{item.nominal | currency: 'Rp. '}}</td>
                                            <td>{{item.waktu}} Minggu</td>
                                            <td>
                                                <button class="btn btn-warning btn-xs" title="Ubah data" data-toggle="tooltip" data-placement="top" tooltip><i class="ti-pencil"></i></button>
                                                <button class="btn btn-primary btn-xs" title="Validasi Berkas" ng-click="setuju(item.id,'Survey')" data-toggle="tooltip" data-placement="top" tooltip><i class="ti-check"></i></button>
                                            </td>
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
                                            <th>No. Anggota</th>
                                            <th>Pemohon</th>
                                            <th>NIK</th>
                                            <th>HP</th>
                                            <!-- <th>Alamat</th> -->
                                            <th>Besar Pinjaman</th>
                                            <th>Lama Pinjaman</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr ng-repeat="item in datas">
                                            <td>{{$index+1}}</td>
                                            <td>{{item.nomor}}</td>
                                            <td>{{item.nama}}</td>
                                            <td>{{item.nik}}</td>
                                            <td>{{item.kontak}}</td>
                                            <!-- <td>{{item.alamat}}</td> -->
                                            <td>{{item.nominal | currency: 'Rp. '}}</td>
                                            <td>{{item.waktu}} Minggu</td>
                                            <td>
                                                <?php if (session()->get('role') == 'Ketua') : ?>
                                                    <button ng-show="item.tahapan=='Survey'" class="btn btn-warning btn-xs" title="Ubah data" data-toggle="tooltip" data-placement="top" tooltip><i class="ti-pencil"></i></button>
                                                    <button ng-show="item.tahapan=='Survey'" class="btn btn-primary btn-xs" title="Validasi Berkas" ng-click="setuju(item.id,'Diterima')" data-toggle="tooltip" data-placement="top" tooltip><i class="ti-check"></i></button>
                                                    <label ng-show="item.tahapan=='Diterima'">Diterima</label>
                                                <?php endif; ?>
                                                <?php if (session()->get('role') == 'Staf') : ?>
                                                    <label ng-show="item.tahapan=='Survey'">Menunggu Pimpinan</label>
                                                    <label ng-show="item.tahapan=='Diterima'">Diterima</label>
                                                <?php endif; ?>
                                            </td>
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
                                            <th>No. Anggota</th>
                                            <th>Pemohon</th>
                                            <th>NIK</th>
                                            <th>HP</th>
                                            <th>Alamat</th>
                                            <th>Besar Pinjaman</th>
                                            <th>Lama Pinjaman</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr ng-repeat="item in datas">
                                            <td>{{$index+1}}</td>
                                            <td>{{item.nomor}}</td>
                                            <td>{{item.nama}}</td>
                                            <td>{{item.nik}}</td>
                                            <td>{{item.kontak}}</td>
                                            <td>{{item.alamat}}</td>
                                            <td>{{item.nominal | currency: 'Rp. '}}</td>
                                            <td>{{item.waktu}} Minggu</td>
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
    <div class="modal fade" id="kembalikan" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Kembalikan Pengajuan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form ng-submit="setuju(model.id, model.tahapan, 'Draf', model.keterangan)">
                        <div class="form-group">
                            <label for="kelengkapan">Keterangan</label>
                            <textarea class="form-control" id="keterangan" rows="4" ng-model="model.keterangan" require></textarea>
                            <!-- <input type="text" class="form-control" id="kelengkapan" ng-model="model.kelengkapan" required> -->
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm mt-4 pr-4 pl-4">Kembalikan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>