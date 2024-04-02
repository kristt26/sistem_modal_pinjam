<?= $this->extend('layout/user/layout') ?>
<?= $this->section('content') ?>
<div ng-controller="angsuranController">
    <div class="row">
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-header">
                    <h4 class="header-title">Jadwal Angsuran</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Jatuh Tempo</th>
                                    <th>Besar Pinjaman</th>
                                    <th>Lama Pinjaman</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="item in datas">
                                    <td ng-class="{'text-primary': item.status=='Valid'}">{{$index+1}}</td>
                                    <td ng-class="{'text-primary': item.status=='Valid'}">{{item.tanggal_jatuh_tempo}}</td>
                                    <td ng-class="{'text-primary': item.status=='Valid'}">{{item.tagihan | currency: 'Rp. '}}</td>
                                    <td ng-class="{'text-primary': item.status=='Valid'}">Minggu {{$index+1}}</td>
                                    <td ng-class="{'text-primary': item.status=='Valid'}">{{item.status=='Pengajuan' ? 'Sedang di proses': 'Terbayar'}}</td>
                                    <td ng-class="{'text-primary': item.status=='Valid'}">
                                        <button ng-show="!item.bayar" type="button" class="btn btn-info btn-xs" ng-click="bayar(item)" title="Verifikasi Pembayaran" data-toggle="tooltip" data-placement="top" tooltip><i class="ti-package"></i></button>
                                        <label ng-show="item.status=='Pengajuan'" class="text-warning">Menunggu Verifikasi</label>
                                        <label ng-show="item.status=='Valid'" class="text-primary">Valid</label>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="bayar" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Verifikasi Pembayaran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form ng-submit="save()" name="form">
                        <div class="form-group">
                            <label for="kelengkapan">Tanggal Jatuh Tempo</label>
                            <input type="text" readonly class="form-control" id="tanggal_jatuh_tempo" ng-model="model.tanggal_jatuh_tempo">
                        </div>
                        <div class="form-group">
                            <label for="kelengkapan">Tagihan</label>
                            <input type="text" readonly class="form-control" id="tagihan" ng-model="model.tagihan" ui-money-mask>
                        </div>
                        <div class="form-group">
                            <label for="kelengkapan">Tanggal Bayar</label>
                            <input type="date" class="form-control" id="tanggal_bayar" ng-model="model.tanggal_bayar" required>
                        </div>
                        <div class="form-group">
                            <label for="kelengkapan">Nominal Bayar</label>
                            <input type="text" class="form-control" id="bayar" ng-model="model.bayar" required ui-money-mask='0'>
                        </div>
                        <div class="form-group">
                            <label>Upload Bukti Pembayaran</label>
                            <input type="file" class="form-control form-control-sm" name="berkas" id="berkas" accept="image/*, application/pdf" base-sixty-four-input ng-model="model.berkas" maxsize="300" required>
                            <span ng-show="form.berkas.$error.maxsize" style="color: red;">Maximum file 300 KB</span>
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm mt-4 pr-4 pl-4">Kirim</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>