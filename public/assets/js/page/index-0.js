"use strict";
// $(document).ready(function () {
//     $("#table-petugas").DataTable();
// });

$("#namaL").keyup(function () {
    var username = $("#namaL").val();
    if (username == "") {
        $("#valnama").html("<span style='color:red'>Nama Harus Diisi</span>");
    }
});

$("#username").keyup(function () {
    var username = $("#username").val();
    var jumlahkarakter = username.length;
    if (jumlahkarakter < 6) {
        $("#valusername").html(
            "<span style='color:red'>Username Terlalu Pendek</span>"
        );
    } else if (jumlahkarakter > 24) {
        $("#valusername").html(
            "<span style='color:red'>Username Terlalu Panjang</span>"
        );
    } else {
        if (username.match(/[^a-zA-Z0-9]/i))
            $("#valusername").html(
                "<span style='color:red'>Anda memasukkan karakter yang tidak diijinkan</span>"
            );
        else $("#valusername").html("<span style='color:green'>Bagus!</span>");
    }
});

$("#password").keyup(function () {
    var password = $("#password").val();
    var jumlahkarakter = password.length;
    if (jumlahkarakter < 8) {
        $("#kon1").html(
            "<span style='color:red'>Password terlalu pendek</span>"
        );
    } else {
        $("#kon1").html("<span style='color:green'>Bagus!</span>");
    }
});

$("#password2").blur(function () {
    var password1 = $("#password").val();
    var password2 = $("#password2").val();

    if (password2 != password1) {
        $("#kon2").html("<span style='color:red'>Password tidak cocok</span>");
    } else {
        $("#kon2").html("<span style='color:green'>Password cocok</span>");
    }
});