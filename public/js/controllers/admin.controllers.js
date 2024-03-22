angular.module('adminctrl', [])
    // Admin
    .controller('dashboardController', dashboardController)
    .controller('mustahikController', mustahikController)
    .controller('kelengkapanController', kelengkapanController)
    .controller('permohonanController', permohonanController)
    ;

function dashboardController($scope, dashboardServices) {
    $scope.$emit("SendUp", "Dashboard");
    $scope.datas = {};
    $scope.title = "Dashboard";
    var all = [];
    mapboxgl.accessToken = 'pk.eyJ1Ijoia3Jpc3R0MjYiLCJhIjoiY2txcWt6dHgyMTcxMzMwc3RydGFzYnM1cyJ9.FJYE8uVi-eVl_mH_DLLEmw';

    dashboardServices.get().then(res => {
        $scope.datas = res;
        $scope.$applyAsync(x => {
            var map = new mapboxgl.Map({
                container: 'map',
                style: 'mapbox://styles/mapbox/satellite-v9',
                center: [140.7052499, -2.5565586],
                zoom: 12
            });
            $scope.datas.forEach(param => {
                var item = new mapboxgl.Marker({ color: param.status == 'Diajukan' ? 'red' : param.status == 'Proses' ? 'Yellow' : '' })
                    .setLngLat([Number(param.long), Number(param.lat)])
                    .setPopup(
                        new mapboxgl.Popup({ offset: 25 }) // add popups
                            .setHTML(
                                `<h4><strong>Nomor Laporan: ${param.nomor}</strong></h4><p>Permasalahan: ${param.kerusakan}<br>Status: <strong>${param.status}</strong></p>`
                            )
                    )
                    .addTo(map);
                all.push(item);
            });
        })
    })
}

function mustahikController($scope, mustahikServices, pesan) {
    $scope.$emit("SendUp", "Mustahik");
    $scope.datas = {};
    $scope.title = "Dashboard";
    $.LoadingOverlay('show');
    mustahikServices.get().then(res => {
        $scope.datas = res;
        $.LoadingOverlay('hide');
    })

    $scope.edit = (param) => {
        $scope.model = angular.copy(param);
    }

    $scope.save = () => {
        pesan.dialog('Yakin ingin melanjutkan proses?', "Ya", "Tidak", "info").then(x => {
            $.LoadingOverlay('show');
            if ($scope.model.id) {
                mustahikServices.put($scope.model).then(res => {
                    $scope.model = {}
                    $.LoadingOverlay('hide');
                })
            } else {
                mustahikServices.post($scope.model).then(res => {
                    $scope.model = {}
                    $.LoadingOverlay('hide');
                })
            }
        })
    }

    $scope.delete = (param) => {
        pesan.dialog('Yakin ingin melanjutkan proses?', "Ya", "Tidak").then(x => {
            $.LoadingOverlay('show');
            mustahikServices.deleted(param).then(res => {
                $.LoadingOverlay('hide');
            })
        })
    }
}

function kelengkapanController($scope, kelengkapanServices, pesan) {
    $scope.$emit("SendUp", "Setting Kelengkapan Berkas");
    $scope.datas = {};
    $scope.title = "Dashboard";
    $.LoadingOverlay('show');
    kelengkapanServices.get().then(res => {
        $scope.datas = res;
        $.LoadingOverlay('hide');
    })

    $scope.edit = (param) => {
        $scope.model = angular.copy(param);
    }

    $scope.save = () => {
        pesan.dialog('Yakin ingin melanjutkan proses?', "Ya", "Tidak", "info").then(x => {
            $.LoadingOverlay('show');
            if ($scope.model.id) {
                kelengkapanServices.put($scope.model).then(res => {
                    $scope.model = {}
                    $.LoadingOverlay('hide');
                })
            } else {
                kelengkapanServices.post($scope.model).then(res => {
                    $scope.model = {}
                    $.LoadingOverlay('hide');
                })
            }
        })
    }

    $scope.delete = (param) => {
        pesan.dialog('Yakin ingin melanjutkan proses?', "Ya", "Tidak").then(x => {
            $.LoadingOverlay('show');
            kelengkapanServices.deleted(param).then(res => {
                $.LoadingOverlay('hide');
            })
        })
    }
}

function permohonanController($scope, permohonanServices, helperServices, pesan) {
    $scope.$emit("SendUp", "Daftar Permohonan");
    $scope.datas = {};
    $scope.title = "Dashboard";
    $.LoadingOverlay('show');
    permohonanServices.get('Pengajuan').then(res => {
        $scope.datas = res;
        $.LoadingOverlay('hide');
    })

    $scope.setData = (param) => {
        $.LoadingOverlay('show');
        permohonanServices.get(param).then(res => {
            $scope.datas = res;
            if(param=="Survey"){

            }
            $.LoadingOverlay('hide');
        })
    }

    $scope.edit = (param) => {
        $scope.model = angular.copy(param);
    }

    $scope.setuju = (id, param, status, ket) => {
        pesan.dialog('Yakin ingin melanjutkan proses?', "Ya", "Tidak", "warning").then(x => {
            $.LoadingOverlay('show');
            var item = {};
            item = $scope.rincian(id);
            item.tahapan = param;
            if(status)item.status=status;
            if(ket)item.keterangan=ket;
            permohonanServices.put(item).then(res => {
                var set = $scope.datas.find(x=>x.id ==id);
                if(status=='Draf'){
                    set.status = status
                    set.keterangan = ket
                }else{
                    if(set && param!='Diterima'){
                        var index = $scope.datas.indexOf(set);
                        $scope.datas.splice(index,1);
                    }
                }
                $.LoadingOverlay('hide');
                if(status) $("#kembalikan").modal('hide');
            })
        })
    }

    $scope.save = () => {
        pesan.dialog('Yakin ingin ingin melakukan validasi?', "Ya", "Tidak", "warning").then(x => {
            $.LoadingOverlay('show');
            permohonanServices.post($scope.datas).then(res => {
                $.LoadingOverlay('hide');
                pesan.dialog('Pengajuan berhasil di tambahkan', 'OK', false, 'success').then(x => {
                    document.location.href = helperServices.url + "pengajuan";
                })
            })
        })
    }

    $scope.delete = (param) => {
        pesan.dialog('Yakin ingin melanjutkan proses?', "Ya", "Tidak").then(x => {
            $.LoadingOverlay('show');
            permohonanServices.deleted(param).then(res => {
                $.LoadingOverlay('hide');
            })
        })
    }

    $scope.kembalikan = (param)=>{
        $scope.model = angular.copy(param);
        console.log($scope.datas);
        $("#kembalikan").modal('show');
    }

    $scope.rincian = (id)=>{
        var item = $scope.datas.find(x=>x.id==id);
        var nominal = parseFloat(item.nominal);
        if(item.waktu == '1'){
            item.rincian = [{tagihan:nominal}]
        }else if(item.waktu == '2'){
            item.rincian = [{tagihan:90000}, {tagihan:nominal-90000}]
            console.log(item.rincian);
        }else{
            var lama = parseInt(item.waktu);
            item.rincian = [{tagihan:90000}];
            var bayar = (parseFloat(nominal)-90000)/(lama-1);
            var set = {tagihan:bayar}
            for (let i = 1; i < lama; i++) {
                item.rincian.push(set)
            }
            console.log(item.rincian);
        }
        return item;
    }
}
