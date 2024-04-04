<?= $this->extend('layout/admin/layout') ?>
<?= $this->section('content') ?>
<div ng-controller="mustahikController">
    <div class="row">
        <!-- <div class="col-3 mt-5">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Input Data Mustahik</h4>
                    <form ng-submit="save()">
                        <div class="form-group">
                            <label for="nik">NIK</label>
                            <input type="text" class="form-control" id="nik" ng-model="model.nik" minlength="16" maxlength="16" required>
                        </div>
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" id="nama" ng-model="model.nama" required>
                        </div>
                        <div class="form-group">
                            <label for="kontak">No. Hp</label>
                            <input type="text" class="form-control" id="kontak" ng-model="model.kontak" required>
                        </div>
                        <div class="form-group">
                            <label for="kontak_lain">No. Hp Lain</label>
                            <input type="text" class="form-control" id="kontak_lain" ng-model="model.kontak_lain" required>
                        </div>
                        <div class="form-group">
                            <label for="kontak_lain">Alamat</label>
                            <textarea rows="3" class="form-control" ng-model="model.alamat"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm mt-4 pr-4 pl-4">Simpan</button>
                    </form>
                </div>
            </div>
        </div> -->
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Daftar Mustahik</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NIK</th>
                                    <th>Nama</th>
                                    <th>Alamat</th>
                                    <th>No. HP</th>
                                    <th>No. HP Lain</th>
                                    <!-- <th>Action</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="item in datas">
                                    <td>{{$index+1}}</td>
                                    <td>{{item.nik}}</td>
                                    <td>{{item.nama}}</td>
                                    <td>{{item.alamat}}</td>
                                    <td>{{item.kontak}}</td>
                                    <td>{{item.kontak_lain}}</td>
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