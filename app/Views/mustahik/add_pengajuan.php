<?= $this->extend('layout/user/layout') ?>
<?= $this->section('content') ?>
<div ng-controller="pengajuanController">
    <div class="row">
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-header bg-secondary">
                    <h5 style="margin-bottom: 5px !important;">Permohonan Pinjaman</h5>
                </div>
                <div class="card-body">
                    <form ng-submit="save()" name="form">
                        <div class="card-header bg-info">
                            <h5 class="header-title" style="margin-bottom: 5px !important;">Datail Pinjaman</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="kelengkapan">Nomor Anggota</label>
                                        <input type="text" readonly class="form-control form-control-sm" id="kelengkapan" ng-model="datas.mustahik.nomor" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="kelengkapan">Nama Peminjam</label>
                                        <input type="text" readonly class="form-control form-control-sm" id="kelengkapan" ng-model="datas.mustahik.nama" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="kelengkapan">Besar Pinjaman</label>
                                        <select id="nominal" class="form-control form-control-sm" ng-model="model.nominal_id" required>
                                            <option></option>
                                            <option ng-repeat="n in datas.nominal" value="{{n.id}}">{{n.nominal | currency: 'Rp. '}}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="kelengkapan">Lama Pinjaman</label>
                                        <select id="nominal" class="form-control form-control-sm" ng-model="model.waktu" required>
                                            <option></option>
                                            <option ng-repeat="n in [] | range:32:0" value="{{n+1}}">{{n+1}} Minggu</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group" ng-show="model.nominal_id && model.waktu">
                                    <button type="button" class="btn btn-info btn-sm" ng-click="rincian()">Rincian Cicilan</button>
                                </div>
                            </div>
                        </div>
                        <div class="card-header bg-info">
                            <h5 class="header-title" style="margin-bottom: 5px !important;">Berkas Permohonan</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6" ng-if="!model.id" ng-repeat="item in datas.kelengkapan">
                                    <div class="form-group">
                                        <label for="kelengkapan{{$index+1}}">{{item.kelengkapan}}</label>
                                        <input type="file" class="form-control form-control-sm" name="kelengkapan{{$index+1}}" id="kelengkapan{{$index+1}}" accept="image/*, application/pdf" base-sixty-four-input ng-model="item.berkas" maxsize="300" required>
                                        <span ng-show="form.kelengkapan{{$index+1}}.$error.maxsize" style="color: red;">Maximum file 300 KB</span>
                                    </div>
                                </div>
                                <div class="col-md-6" ng-if="model.id" ng-repeat="item in model.detail">
                                    <div class="form-group">
                                        <label for="kelengkapan{{$index+1}}">{{item.kelengkapan}}</label>
                                        <input type="file" class="form-control form-control-sm" name="kelengkapan{{$index+1}}" id="kelengkapan{{$index+1}}" accept="image/*, application/pdf" base-sixty-four-input ng-model="item.berkas" maxsize="300">
                                        <span ng-show="form.kelengkapan{{$index+1}}.$error.maxsize" style="color: red;">Maximum file 300 KB</span>
                                        <a ng-if="!item.berkas" href="/assets/berkas/{{item.file}}" target="_blank">{{item.file}}</a>
                                        <!-- <span>{{item.file}}</span> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm mt-4 pr-4 pl-4">Ajukan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="rincian" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Rincian Cicilan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Minggu</th>
                                            <th>Nominal Bayar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr ng-repeat="item in [] | range: model.rincian.length/2+((model.rincian.length/2)%2==0 ? 0 : 0.5):0">
                                            <td>Ke-{{$index+1}}</td>
                                            <td>{{model.rincian[item].nominal | currency: 'Rp. '}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <table class="table table-bordered" ng-if="model.rincian.length > 1">
                                    <thead>
                                        <tr>
                                            <th>Minggu</th>
                                            <th>Nominal Bayar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr ng-repeat="item in [] | range: model.rincian.length: model.rincian.length % 2 == 0 ? model.rincian.length/2 : model.rincian.length/2+0.5">
                                            <td>Ke-{{item+1}}</td>
                                            <td>{{model.rincian[item].nominal | currency: 'Rp. '}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>