angular.module('admin.service', [])
    // admin
    .factory('dashboardServices', dashboardServices)
    .factory('mustahikServices', mustahikServices)
    .factory('kelengkapanServices', kelengkapanServices)
    .factory('permohonanServices', permohonanServices)
    .factory('pembayaranServices', pembayaranServices)
    .factory('pesanServices', pesanServices)
    .factory('nominalServices', nominalServices)
    ;

function dashboardServices($http, $q, helperServices, AuthService) {
    var controller = helperServices.url + 'beranda/';
    var service = {};
    service.data = [];
    service.instance = false;
    return {
        get: get,
        getLayanan: getLayanan
    };

    function get() {
        var def = $q.defer();
        $http({
            method: 'get',
            url: controller + 'read',
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                def.resolve(res.data);
            },
            (err) => {
                def.reject(err);
            }
        );
        return def.promise;
    }

    function getLayanan() {
        var def = $q.defer();
        $http({
            method: 'get',
            url: controller + 'get_layanan',
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                def.resolve(res.data);
            },
            (err) => {
                def.reject(err);
            }
        );
        return def.promise;
    }
}

function mustahikServices($http, $q, helperServices, AuthService, pesan) {
    var controller = helperServices.url + 'mustahik/';
    var service = {};
    service.data = [];
    return {
        get: get,
        post: post,
        put: put,
        deleted: deleted
    };

    function get() {
        var def = $q.defer();
        $http({
            method: 'get',
            url: controller + 'read',
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                service.data = res.data;
                def.resolve(res.data);
            },
            (err) => {
                pesan.error(err.data.message);
                def.reject(err);
            }
        );
        return def.promise;
    }

    function post(param) {
        var def = $q.defer();
        $http({
            method: 'post',
            url: controller + 'post',
            data: param,
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                service.data.push(res.data);
                def.resolve(res.data);
            },
            (err) => {
                $.LoadingOverlay('hide');
                pesan.error(err.data.messages.error);
                def.reject(err);
            }
        );
        return def.promise;
    }

    function put(param) {
        var def = $q.defer();
        $http({
            method: 'put',
            url: controller + 'put',
            data: param,
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                var data = service.data.find(x => x.id == param.id);
                if (data) {
                    data.nama = param.nama;
                    data.nik = param.nik;
                    data.alamat = param.alamat;
                    data.kontak = param.kontak;
                    data.kontak_lain = param.kontak_lain;
                }
                def.resolve(res.data);
            },
            (err) => {
                def.reject(err);
            }
        );
        return def.promise;
    }

    function deleted(param) {
        var def = $q.defer();
        $http({
            method: 'delete',
            url: controller + "/delete/" + param.id,
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                var index = service.data.indexOf(param);
                service.data.splice(index, 1);
                def.resolve(res.data);
            },
            (err) => {
                def.reject(err);
                message.error(err.data.message)
            }
        );
        return def.promise;
    }

}

function kelengkapanServices($http, $q, helperServices, AuthService, pesan) {
    var controller = helperServices.url + 'kelengkapan/';
    var service = {};
    service.data = [];
    return {
        get: get,
        post: post,
        put: put,
        deleted: deleted
    };

    function get() {
        var def = $q.defer();
        $http({
            method: 'get',
            url: controller + 'read',
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                service.data = res.data;
                def.resolve(res.data);
            },
            (err) => {
                pesan.error(err.data.message);
                def.reject(err);
            }
        );
        return def.promise;
    }

    function post(param) {
        var def = $q.defer();
        $http({
            method: 'post',
            url: controller + 'post',
            data: param,
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                service.data.push(res.data);
                def.resolve(res.data);
            },
            (err) => {
                $.LoadingOverlay('hide');
                pesan.error(err.data.messages.error);
                def.reject(err);
            }
        );
        return def.promise;
    }

    function put(param) {
        var def = $q.defer();
        $http({
            method: 'put',
            url: controller + 'put',
            data: param,
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                var data = service.data.find(x => x.id == param.id);
                if (data) {
                    data.nama = param.nama;
                    data.nik = param.nik;
                    data.alamat = param.alamat;
                    data.kontak = param.kontak;
                    data.kontak_lain = param.kontak_lain;
                }
                def.resolve(res.data);
            },
            (err) => {
                def.reject(err);
            }
        );
        return def.promise;
    }

    function deleted(param) {
        var def = $q.defer();
        $http({
            method: 'delete',
            url: controller + "/delete/" + param.id,
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                var index = service.data.indexOf(param);
                service.data.splice(index, 1);
                def.resolve(res.data);
            },
            (err) => {
                def.reject(err);
                message.error(err.data.message)
            }
        );
        return def.promise;
    }

}

function permohonanServices($http, $q, helperServices, AuthService, pesan) {
    var controller = helperServices.url + 'permohonan/';
    var service = {};
    service.data = [];
    return {
        get: get,
        post: post,
        put: put,
        deleted: deleted
    };

    function get(param) {
        var def = $q.defer();
        $http({
            method: 'get',
            url: controller + 'read/' + param,
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                service.data = res.data;
                def.resolve(res.data);
            },
            (err) => {
                pesan.error(err.data.message);
                def.reject(err);
            }
        );
        return def.promise;
    }

    function post(param) {
        var def = $q.defer();
        $http({
            method: 'post',
            url: controller + 'post',
            data: param,
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                service.data.push(res.data);
                def.resolve(res.data);
            },
            (err) => {
                $.LoadingOverlay('hide');
                pesan.error(err.data.messages.error);
                def.reject(err);
            }
        );
        return def.promise;
    }

    function put(param) {
        var def = $q.defer();
        $http({
            method: 'put',
            url: controller + 'put',
            data: param,
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                // var data = service.data.find(x => x.id == param.id);
                // if (data) {
                //     data.nama = param.nama;
                //     data.nik = param.nik;
                //     data.alamat = param.alamat;
                //     data.kontak = param.kontak;
                //     data.kontak_lain = param.kontak_lain;
                // }
                def.resolve(res.data);
            },
            (err) => {
                def.reject(err);
            }
        );
        return def.promise;
    }

    function deleted(param) {
        var def = $q.defer();
        $http({
            method: 'delete',
            url: controller + "/delete/" + param.id,
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                var index = service.data.indexOf(param);
                service.data.splice(index, 1);
                def.resolve(res.data);
            },
            (err) => {
                def.reject(err);
                message.error(err.data.message)
            }
        );
        return def.promise;
    }

}

function pembayaranServices($http, $q, helperServices, AuthService, pesan) {
    var controller = helperServices.url + 'pembayaran/';
    var service = {};
    service.data = [];
    return {
        get: get,
        put: put
    };

    function get(param) {
        var def = $q.defer();
        $http({
            method: 'get',
            url: controller + 'read/' + param,
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                service.data = res.data;
                def.resolve(res.data);
            },
            (err) => {
                pesan.error(err.data.message);
                def.reject(err);
            }
        );
        return def.promise;
    }


    function put(param) {
        var def = $q.defer();
        $http({
            method: 'put',
            url: controller + 'put',
            data: param,
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                // var data = service.data.find(x => x.id == param.id);
                // if (data) {
                //     data.nama = param.nama;
                //     data.nik = param.nik;
                //     data.alamat = param.alamat;
                //     data.kontak = param.kontak;
                //     data.kontak_lain = param.kontak_lain;
                // }
                def.resolve(res.data);
            },
            (err) => {
                def.reject(err);
            }
        );
        return def.promise;
    }
}

function pesanServices($http, $q, helperServices, AuthService, pesan) {
    var controller = helperServices.url + 'kirim_pesan';
    return {
        get: get,
    };

    function get() {
        var def = $q.defer();
        $http({
            method: 'get',
            url: controller,
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                def.resolve(res.data);
            },
            (err) => {
                pesan.error(err.data.message);
                def.reject(err);
            }
        );
        return def.promise;
    }

}

function nominalServices($http, $q, helperServices, AuthService, pesan) {
    var controller = helperServices.url + 'nominal/';
    var service = {};
    service.data = [];
    return {
        get: get,
        post: post,
        put: put,
        deleted: deleted
    };

    function get() {
        var def = $q.defer();
        $http({
            method: 'get',
            url: controller + 'read',
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                service.data = res.data;
                def.resolve(res.data);
            },
            (err) => {
                pesan.error(err.data.message);
                def.reject(err);
            }
        );
        return def.promise;
    }

    function post(param) {
        var def = $q.defer();
        $http({
            method: 'post',
            url: controller + 'post',
            data: param,
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                service.data.push(res.data);
                def.resolve(res.data);
            },
            (err) => {
                $.LoadingOverlay('hide');
                pesan.error(err.data.messages.error);
                def.reject(err);
            }
        );
        return def.promise;
    }

    function put(param) {
        var def = $q.defer();
        $http({
            method: 'put',
            url: controller + 'put',
            data: param,
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                var data = service.data.find(x => x.id == param.id);
                if (data) {
                    data.nama = param.nama;
                    data.nik = param.nik;
                    data.alamat = param.alamat;
                    data.kontak = param.kontak;
                    data.kontak_lain = param.kontak_lain;
                }
                def.resolve(res.data);
            },
            (err) => {
                def.reject(err);
            }
        );
        return def.promise;
    }

    function deleted(param) {
        var def = $q.defer();
        $http({
            method: 'delete',
            url: controller + "/delete/" + param.id,
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                var index = service.data.indexOf(param);
                service.data.splice(index, 1);
                def.resolve(res.data);
            },
            (err) => {
                def.reject(err);
                message.error(err.data.message)
            }
        );
        return def.promise;
    }

}


