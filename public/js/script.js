$(document).ready( function () {
    $('#table').DataTable();
} );

$('#submitButton').on('click', function (e) {
    e.preventDefault();
    swal({
        icon: "warning",
        title: "Apakah anda yakin ingin menyimpan data ini?",
        // text: "Simpan ?",
        buttons: true,
        dangerMode: true
    }).then((isConfirm) => {
        if (isConfirm) {
            document.getElementById("myForm").submit();
            swal({
                icon: "success",
                title: 'Petugas berhasil ditambahkan!',
            });
        }
    });
});

$('#submitEditButton').on('click', function (e) {
    e.preventDefault();
    swal({
        icon: "warning",
        title: "Are you sure?",
        text: "Simpan?",
        buttons: true,
        dangerMode: true
    }).then((isConfirm) => {
        if (isConfirm) {
            document.getElementById("editForm").submit();
            swal({
                icon: "success",
                title: 'Petugas berhasil diupdate!',
            });
        }
    });
});

$('#deleteButton').on('click', function (e) {
    e.preventDefault();
    var form = $(this).parents('form');
    var message = $('#deleteButton').attr('data-message');
    swal({
        icon: "warning",
        title: "Are you sure?",
        text: message,
        buttons: true,
        dangerMode: true
    }).then((isConfirm) => {
        if (isConfirm) {
            form.submit();
            swal({
                icon: "success",
                title: 'Petugas berhasil dihapus!',
            });
        }
    });
});