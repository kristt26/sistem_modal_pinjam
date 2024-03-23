<?= $this->extend('layout/admin/layout') ?>
<?= $this->section('content') ?>
<div ng-controller="pembayaranController">
    <div class="row">
        <div class="col-12 mt-4">
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" ng-click="setData('Pengajuan')" id="validasi-tab" data-toggle="tab" href="" data-target="#validasi" role="tab" aria-controls="validasi" aria-selected="true">Validasi Pembayaran</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" ng-click="setData('Validasi')" id="survey-tab" data-toggle="tab" href="" data-target="#jatuhTempo" role="tab" aria-controls="survey" aria-selected="false">Jatuh Tempo</a>
                        </li>
                    </ul>
                    <div class="tab-content mt-3" id="myTabContent">
                        <div class="tab-pane fade show active" id="validasi" role="tabpanel" aria-labelledby="validasi-tab">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode Pinjam</th>
                                            <th>Peminjam</th>
                                            <th>Tagihan</th>
                                            <th>Jatuh Tempo</th>
                                            <th>Nominal Bayar</th>
                                            <th>Tanggal Bayar</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr ng-repeat="item in datas" ng-class="{'bg-warning': item.status=='Draf'}">
                                            <td>{{$index+1}}</td>
                                            <td>{{item.kode}}</td>
                                            <td>{{item.nama}}</td>
                                            <td>{{item.tagihan | currency:'Rp. '}}</td>
                                            <td>{{item.tanggal_jatuh_tempo | date:'dd MMMM y'}}</td>
                                            <td>{{item.bayar | currency:'Rp. '}}</td>
                                            <td>{{item.tanggal_bayar}}</td>
                                            <td>
                                                <button ng-show="item.status!='Draf'" class="btn btn-primary btn-xs" title="Validasi Pembayaran" ng-click="validasi(item)" data-toggle="tooltip" data-placement="top" tooltip><i class="ti-check"></i></button>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="pembayaran" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Validasi Pembayaran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form ng-submit="save()">
                        <div class="form-group">
                            <label>Nominal Bayar</label>
                            <input type="text" class="form-control" ng-model="model.tagihan" ui-money-mask='0'>
                            <!-- <input type="text" class="form-control" id="kelengkapan" ng-model="model.kelengkapan" required> -->
                        </div>
                        <div class="form-group">
                            <label>Dibayar</label>
                            <input type="text" class="form-control" ng-model="model.bayar" ui-money-mask='0'>
                            <span ng-show="model.bayar>model.tagihan" class="text-info">Kelebihan {{model.bayar-model.tagihan | currency: 'Rp. '}} akan dialihkan untuk infak/sedekah</span>
                            <span ng-show="model.bayar<model.tagihan" class="text-danger">Jumlah yang dibayar tidak sesuai</span>
                        </div>
                        <div class="form-group">
                            <label>Bukti Pembayaran</label>
                            <img ng-src="<?= base_url()?>assets/berkas/{{model.bukti}}" alt="" style="border: 1px solid;">
                        </div>
                        <div class="form-group">
                            <label>Keterangan</label>
                            <textarea class="form-control" id="keterangan" rows="2" ng-model="model.catatan" require></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm">Validasi</button>
                        <button type="button" class="btn btn-primary btn-sm" ng-click="save('tolak')">Tolak</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>