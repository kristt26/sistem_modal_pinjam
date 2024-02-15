<?= $this->extend('layout/user/layout') ?>
<?= $this->section('content') ?>
<div ng-controller="pengajuanController">
    <div class="row">
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Lengkapi berkas permohonan</h4>
                    <form ng-submit="save()" name="form">
                        <div class="form-group" ng-repeat="item in datas">
                            <label for="kelengkapan{{$index+1}}">{{item.kelengkapan}}</label>
                            <input type="file" class="form-control" name="kelengkapan{{$index+1}}" id="kelengkapan{{$index+1}}" accept="image/*, application/pdf" base-sixty-four-input ng-model="item.berkas" maxsize="300" required>
                            <span ng-show="form.kelengkapan{{$index+1}}.$error.maxsize" style="color: red;">Maximum file 300 KB</span>
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm mt-4 pr-4 pl-4">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>