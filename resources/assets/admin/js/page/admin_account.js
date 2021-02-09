$(document).ready(function (){
    $(this).on('click', '*[data-click]', function(e) {
        let func = $(this).data('click');
        switch (func) {
            case 'openChangeStatus':
                Vastore_Admin.openChangeStatus($(this))
                break;
            case 'openDelete':
                Vastore_Admin.openDelete($(this))
                break;
            case 'test':
                Vastore_Admin.test($(this))
                break;
            default:
                break;
        }
    })
})

const Vastore_Admin = {
    openChangeStatus: function (el) {
        let id = el.data('id')
        console.log(BASE_URL)
        init.showLoader('.content')
        //toastr.error('Have fun storming the castle!')
        var url = BASE_URL + '/admin/admin-account/get-admin-by-id';
        console.log(url)
        var data = { id };
        $.get(url, data, function(res){
            if(res.success == 1){ //tồn tại
                var admin = res.data
                if (admin.is_active === 1) { //block
                    init.hideLoader('.content')
                    Swal.fire({
                        title: 'Bạn có muốn khóa tài khoản',
                        text: admin.email,
                        icon: "question",
                        buttonsStyling: false,
                        confirmButtonText: "<i class='la la-lock'></i> Đồng ý!",
                        showCancelButton: true,
                        cancelButtonText: "<i class='la la-window-close'></i> Hủy",
                        reverseButtons: true,
                        customClass: {
                            confirmButton: "btn btn-danger",
                            cancelButton: "btn btn-default"
                        }
                    }).then(function(result) {
                        if (result.value) {
                            Vastore_Admin.changeStatus(admin)
                        }
                    });
                } else { //active
                    init.hideLoader('.content')
                    Swal.fire({
                        title: 'Bạn có muốn kích hoạt tài khoản',
                        text: admin.email,
                        icon: "question",
                        buttonsStyling: false,
                        confirmButtonText: "<i class='la la-lock'></i> Đồng ý!",
                        showCancelButton: true,
                        cancelButtonText: "<i class='la la-window-close'></i> Hủy",
                        reverseButtons: true,
                        customClass: {
                            confirmButton: "btn btn-danger",
                            cancelButton: "btn btn-default"
                        }
                    }).then(function(result) {
                        if (result.value) {
                            init.showLoader('.content')
                            Vastore_Admin.changeStatus(admin)
                        }
                    });
                }
            } else {
                toastr.error(res.message)
                setTimeout(function(){
                    window.location.reload()
                }, 1000);
            }
        })
    },

    changeStatus: function (admin) {
        var url = BASE_URL + '/admin/admin-account/change-status'
        var data = {
            'id': admin.id,
            'is_active': admin.is_active
        }
        $.post(url, data, function(res){
            if (res.success === 1) {
                init.hideLoader('.content')
                Swal.fire({
                    title: res.message,
                    text: res.data.email,
                    icon: "success",
                    buttonsStyling: false,
                    confirmButtonText: "Đóng",
                    reverseButtons: true,
                    customClass: {
                        confirmButton: "btn btn-primary"
                    }
                }).then(function(result) {
                    location.reload()
                });
            } else {
                toastr.error(res.message)
                setTimeout(function(){
                    window.location.reload()
                }, 1000);
            }
        })
    },

    openDelete: function (el) {
        let id = el.data('id')
        let email = el.data('email')
        console.log(email)
        Swal.fire({
            title: 'Bạn có muốn xóa tài khoản',
            text: email,
            icon: "question",
            buttonsStyling: false,
            confirmButtonText: "<i class='la la-lock'></i> Đồng ý!",
            showCancelButton: true,
            cancelButtonText: "<i class='la la-window-close'></i> Hủy",
            reverseButtons: true,
            customClass: {
                confirmButton: "btn btn-danger",
                cancelButton: "btn btn-default"
            }
        }).then(function(result) {
            if (result.value) {
                Vastore_Admin.confirmDelete(id)
            }
        });
    },

    confirmDelete: function (id) {
        let url = BASE_URL + '/admin/admin-account/delete'
        let data = { id }
        $.post(url, data, function(res){
            if (res.success == 1) {
                toastr.success(res.message)
                setTimeout(function(){
                    window.location.reload()
                }, 1000);
            } else {
                toastr.error(res.message)
                setTimeout(function(){
                    window.location.reload()
                }, 1000);
            }
        })
    },




    test: function (el) {
        Swal.fire({
            title: 'Bạn có muốn kích hoạt tài khoản',
            text: 'anh195np@email.com',
            icon: "question",
            buttonsStyling: false,
            confirmButtonText: "<i class='la la-lock'></i> Đồng ý!",
            showCancelButton: true,
            cancelButtonText: "<i class='la la-window-close'></i> Hủy",
            reverseButtons: true,
            customClass: {
                confirmButton: "btn btn-danger",
                cancelButton: "btn btn-default"
            }
        }).then(function(result) {
            if (result.value) {
                console.log('ok')
            }
        });
    },
}
