<?= $this->extend('layout/admin/layout') ?>
<?= $this->section('content') ?>
<div ng-controller="nominalController">
    <div class="row">
        <div class="col-3 mt-5">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Tambah Besar Pinjaman</h4>
                    <form ng-submit="save()">
                        <div class="form-group">
                            <label for="nominal">Nominal</label>
                            <input type="text" class="form-control" id="nominal" ng-model="model.nominal" required ui-money-mask='0'>
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm mt-4 pr-4 pl-4">Tambah</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-9 mt-5">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Daftar Besar Pinjaman</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nominal</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="item in datas">
                                    <td>{{$index+1}}</td>
                                    <td>{{item.nominal}}</td>
                                    <td>
                                        <button type="button" class="btn btn-warning btn-xs" ng-click="edit(item)"><i class="ti-pencil"></i></button>
                                        <button type="button" class="btn btn-danger btn-xs" ng-click="delete(item)"><i class="ti-trash"></i></button>
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