$(document).ready(function (){
    $(this).on('click', '*[data-click]', function(e) {
        let func = $(this).data('click');
        switch (func) {
            case 'test':
                Vastore_Admin.test($(this))
                break;
            default:
                break;
        }
    })
})

const Vastore_Admin = {
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
