angular.module('userctrl', [])
    // Admin
    .controller('dashboardController', dashboardController)
    .controller('pengajuanController', pengajuanController)
    .controller('permohonanController', permohonanController)
    ;

function dashboardController($scope, dashboardServices) {
    $scope.$emit("SendUp", "Dashboard");
    $scope.datas = {};
    $scope.title = "Dashboard";
    var all = [];
    mapboxgl.accessToken = 'pk.eyJ1Ijoia3Jpc3R0MjYiLCJhIjoiY2txcWt6dHgyMTcxMzMwc3RydGFzYnM1cyJ9.FJYE8uVi-eVl_mH_DLLEmw';
    
    dashboardServices.get().then(res=>{
        $scope.datas = res;
        $scope.$applyAsync(x=>{
            var map = new mapboxgl.Map({
                container: 'map',
                style: 'mapbox://styles/mapbox/satellite-v9',
                center: [140.7052499, -2.5565586],
                zoom: 12
            });
            $scope.datas.forEach(param => {
                var item = new mapboxgl.Marker({ color: param.status=='Diajukan'?'red':param.status=='Proses' ? 'Yellow' : '' })
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

function pengajuanController($scope, pengajuanServices, helperServices, pesan) {
    $scope.$emit("SendUp", "Pengajuan");
    $scope.datas = {};
    $scope.title = "Dashboard";
    $.LoadingOverlay('show');
    if(helperServices.lastPath=="add"){
        pengajuanServices.kelengkapan().then(res => {
            $scope.datas = res;
            $.LoadingOverlay('hide');
            console.log(res);
        })
    }else{
        pengajuanServices.get().then(res => {
            $scope.datas = res;
            $.LoadingOverlay('hide');
        })
    }

    $scope.add = ()=>{
        document.location.href = helperServices.url + "pengajuan/add"
    }

    $scope.edit = (param) => {
        $scope.model = angular.copy(param);
    }

    $scope.save = () => {
        pesan.dialog('Yakin ingin melanjutkan proses?', "Ya", "Tidak", "warning").then(x => {
            $.LoadingOverlay('show');
            pengajuanServices.post($scope.datas).then(res => {
                $.LoadingOverlay('hide');
                pesan.dialog('Pengajuan berhasil di tambahkan', 'OK', false, 'success').then(x=>{
                    document.location.href = helperServices.url + "pengajuan";
                })
            })
        })
    }

    $scope.delete = (param) => {
        pesan.dialog('Yakin ingin melanjutkan proses?', "Ya", "Tidak").then(x => {
            $.LoadingOverlay('show');
            pengajuanServices.deleted(param).then(res => {
                $.LoadingOverlay('hide');
            })
        })
    }
}


