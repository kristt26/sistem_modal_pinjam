<?= $this->extend('layout/user/layout') ?>
<?= $this->section('content') ?>
<div ng-controller="infakController">
    <div class="row">
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                    <th>Keterangan</th>
                                    <th>Nominal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="item in datas">
                                    <td>{{$index+1}}</td>
                                    <td>{{item.tanggal | date: 'd MMMM y'}}</td>
                                    <td>Belum disalurkan</td>
                                    <td></td>
                                    <td>{{item.nominal | currency: 'Rp. '}}</td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr><td colspan="4"><strong>Total</strong></td><td>{{total | currency: 'Rp. '}}</td></tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>