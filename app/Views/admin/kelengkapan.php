<?= $this->extend('layout/admin/layout') ?>
<?= $this->section('content') ?>
<div ng-controller="kelengkapanController">
    <div class="row">
        <div class="col-4 mt-5">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Input Data Kelengkapan</h4>
                    <form ng-submit="save()">
                        <div class="form-group">
                            <label for="kelengkapan">Kelengkapan</label>
                            <input type="text" class="form-control" id="kelengkapan" ng-model="model.kelengkapan" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm mt-4 pr-4 pl-4">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-8 mt-5">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Daftar Kelengkapan</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kelengkapan</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="item in datas">
                                    <td>{{$index+1}}</td>
                                    <td>{{item.kelengkapan}}</td>
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