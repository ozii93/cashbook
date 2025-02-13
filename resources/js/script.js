// Import Numeral.js
import numeral from "numeral";

window.formatNumber = function (input, decimalPlaces) {
    let value = input.value;

    // Hapus semua karakter selain angka dan titik desimal
    value = value.replace(/[^0-9.]/g, "");

    // Pisahkan bagian integer dan decimal
    let parts = value.split(".");

    // Tambahkan koma untuk ribuan di bagian integer
    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");

    // Jika decimalPlaces > 0, batasi desimal sesuai decimalPlaces yang diberikan
    if (decimalPlaces > 0) {
        if (parts[1] && parts[1].length > decimalPlaces) {
            parts[1] = parts[1].substring(0, decimalPlaces);
        }
        input.value = parts.join("."); // Gabungkan integer dan decimal
    } else {
        input.value = parts[0]; // Jika decimalPlaces = 0, hanya tampilkan bagian integer
    }
};

// Fungsi untuk memformat angka dengan Numeral.js
window.formatNumeral = function (value, decimalPlaces = 2) {
    // Pastikan nilai yang diterima adalah angka
    let numberValue = numeral(value).value();

    // Jika nilai bukan angka, set ke 0
    if (isNaN(numberValue)) numberValue = 0;

    // Terapkan format ribuan dengan desimal
    const formattedValue = numeral(numberValue).format(
        `0,0${decimalPlaces > 0 ? "." + "0".repeat(decimalPlaces) : ""}`
    );

    return formattedValue;
};

window.formatNumberAjax = function (number, decimalPlaces = 0) {
    if (isNaN(number) || number === null) return "0"; // Handle jika bukan angka

    let value = parseFloat(number).toFixed(decimalPlaces); // Atur angka desimal

    let parts = value.split("."); // Pisahkan integer dan decimal

    // Tambahkan koma sebagai pemisah ribuan di bagian integer
    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");

    return parts.join("."); // Gabungkan kembali integer dan decimal
};

// Inisialisasi CSRF token dari meta tag yang ada di Blade layout
const csrfToken = document
    .querySelector('meta[name="csrf-token"]')
    .getAttribute("content");

// Setup global ajax request dengan CSRF token
$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": csrfToken,
    },
});

// Fungsi initDeleteButton
window.initDeleteButton = function (buttonSelector, baseUrl) {
    $("body").on("click", buttonSelector, function (e) {
        e.preventDefault();
        let id = $(this).data("id");
        let deleteUrl = `${baseUrl}/delete/${id}`;

        Swal.fire({
            title: "Are You Sure?",
            text: "Delete Data !!",
            icon: "warning",
            showCancelButton: true,
            cancelButtonText: "NO",
            confirmButtonText: "YES",
        }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    type: "PUT",
                    url: deleteUrl,
                    cache: false,
                    beforeSend: function () {
                        Swal.fire({
                            title: 'Please Wait ...',
                            allowOutsideClick: false,
                            confirmButtonText: "Something went wrong",
                            confirmButtonColor: "#ea0a2a",
                            didOpen: () => {
                                Swal.showLoading()
                            }
                        })

                    },
                    success: function (response) {
                        Swal.close();
                        Swal.fire({
                            icon: "success",
                            title: "Delete Data Successfully",
                            showConfirmButton: false,
                            timer: 1500,
                        });

                        if (response.url) {
                            window.location = response.url; // Redirect jika ada URL di response
                        } else {
                            location.reload(); // Refresh halaman jika tidak ada URL
                        }
                    },
                    error: function (xhr) {
                        Swal.close();
                        console.error(xhr.responseText);
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: "Something went wrong!",
                        });
                    },
                });
            }
        });
    });
};

// form-handler.js

window.initFormHandler = function (formSelector, submitButtonSelector) {
    const form = document.querySelector(formSelector);
    const btnsubmit = document.querySelector(submitButtonSelector);

    $(btnsubmit).on("click", function (event) {
        event.preventDefault();
        const isFormValid = validateForm(form);

        if (isFormValid) {
            Swal.fire({
                title: "Are you sure?",
                text: "Do you want to save this data?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes",
            }).then((result) => {
                if (result.isConfirmed) {
                    $(btnsubmit).prop("disabled", true);
                    $("body").append(
                        '<div class="overlay"><div class="spinner"></div></div>'
                    );
                    $(form).submit();
                }
            });
        }
    });

    $(form).on("submit", function (e) {
        e.preventDefault();
        const dataform = new FormData(form);

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $.ajax({
            url: $(form).attr("action"),
            method: $(form).attr("method"),
            data: dataform,
            processData: false,
            dataType: "json",
            contentType: false,
            beforeSend: function () {
                Swal.fire({
                    title: 'Please Wait ...',
                    allowOutsideClick: false,
                    confirmButtonText: "Something went wrong",
                    confirmButtonColor: "#ea0a2a",
                    didOpen: () => {
                        Swal.showLoading()
                    }
                })
                $(form).find('span.error-text').text('');
                btnsubmit.disabled = true;
            },
            success: function (res) {
                Swal.close();
                if (res.status === 200) {
                    Swal.fire({
                        icon: "success",
                        title: `${res.message}`,
                        timer: 1500,
                    }).then(() => {
                        window.location = res.url;
                    });
                } else {
                    Swal.fire({
                        icon: "error",
                        title: `${res.message}`,
                    });
                    btnsubmit.disabled = false;
                }

            },
            error: function (error) {
                Swal.close();
                Swal.fire({
                    icon: "error",
                    title: "An error occurred!",
                    text: (error.responseJSON && error.responseJSON.message) || "Something went wrong.",
                });


                btnsubmit.disabled = false;
            },
        });
    });

    // Fungsi validasi dinamis untuk berbagai form
    function validateForm(form) {
        let isValid = true;

        // Iterasi semua input dengan class 'required'
        $(form)
            .find(".required")
            .each(function () {
                const input = $(this);
                if (input.val().trim() === "") {
                    isValid = false;
                    input
                        .next(".error-text")
                        .text(`${input.attr("name")} is required!`);
                    Swal.fire({
                        icon: "error",
                        title: `${input.attr("name")} is required!`,
                    });
                    return false; // Hentikan iterasi jika ada input kosong
                } else {
                    input.next(".error-text").text(""); // Bersihkan pesan error jika valid
                }
            });

        return isValid;
    }
};

window.initSavePrint = function (formSelector, submitButtonSelector) {
    const form = document.querySelector(formSelector);
    const btnsubmit = document.querySelector(submitButtonSelector);

    $(btnsubmit).on("click", function (event) {
        event.preventDefault();
        const isFormValid = validateForm(form);

        if (isFormValid) {
            Swal.fire({
                title: "Are you sure?",
                text: "Do you want to save this data?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes",
            }).then((result) => {
                if (result.isConfirmed) {
                    $(btnsubmit).prop("disabled", true);
                    $("body").append(
                        '<div class="overlay"><div class="spinner"></div></div>'
                    );
                    $(form).submit();
                }
            });
        }
    });

    $(form).on("submit", function (e) {
        e.preventDefault();
        const dataform = new FormData(form);

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $.ajax({
            url: $(form).attr("action"),
            method: $(form).attr("method"),
            data: dataform,
            processData: false,
            dataType: "json",
            contentType: false,
            beforeSend: function () {
                Swal.fire({
                    title: 'Please Wait ...',
                    allowOutsideClick: false,
                    confirmButtonText: "Something went wrong",
                    confirmButtonColor: "#ea0a2a",
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
                $(form).find('span.error-text').text('');
                btnsubmit.disabled = true;
            },
            success: function (res) {
                Swal.close();
                if (res.status == 200) {
                    Swal.fire({
                        icon: "success",
                        title: `${res.message}`,
                        timer: 1500,
                    }).then((result) => {
                        if (result.isConfirmed || result.dismiss === Swal.DismissReason.timer) {
                            // Buka tab baru hanya jika print_tab tersedia
                            if (res.print_tab) {
                                var newTab = window.open(res.print_tab, '_blank');
                                if (!newTab || newTab.closed || typeof newTab.closed === 'undefined') {
                                    console.log('Failed to open new tab. Check your browser popup settings.');
                                }
                            }
                            // Redirect ke URL yang diberikan setelah menutup pesan Swal.fire
                            if (res.url) {
                                window.location.href = res.url;
                            }
                        }
                    });
                } else {
                    Swal.fire({
                        icon: "error",
                        title: `${res.message}`,
                    });
                    btnsubmit.disabled = false;
                }
            },
            error: function (error) {
                Swal.close();
                Swal.fire({
                    icon: "error",
                    title: "An error occurred!",
                    text: (error.responseJSON && error.responseJSON.message) || "Something went wrong.",
                });
                btnsubmit.disabled = false;
            },
        });
    });


    // Fungsi validasi dinamis untuk berbagai form
    function validateForm(form) {
        let isValid = true;

        // Iterasi semua input dengan class 'required'
        $(form)
            .find(".required")
            .each(function () {
                const input = $(this);
                if (input.val().trim() === "") {
                    isValid = false;
                    input
                        .next(".error-text")
                        .text(`${input.attr("name")} is required!`);
                    Swal.fire({
                        icon: "error",
                        title: `${input.attr("name")} is required!`,
                    });
                    return false; // Hentikan iterasi jika ada input kosong
                } else {
                    input.next(".error-text").text(""); // Bersihkan pesan error jika valid
                }
            });

        return isValid;
    }
};


window.initApproveButton = function (buttonSelector, baseUrl) {
    $("#btn-approve").click(function () {
        let approveUrl = `${baseUrl}/approve/`;

        var Approval = [];
        $(".checktip").each(function (index, item) {
            var $checkbox = $(this); // Referensi ke elemen checkbox
            var ApprovalModel = {};

            // Ambil data-id dan id dari checkbox
            ApprovalModel.Id = $checkbox.data("id"); // Mengambil nilai data-id
            ApprovalModel.isChecked = $checkbox.is(":checked"); // Apakah checkbox dicentang
            Approval.push(ApprovalModel);
        });

        // Filter hanya item yang dicentang
        Approval = Approval.filter(item => item.isChecked);

        // Jika Approval kosong, tampilkan SweetAlert
        if (Approval.length === 0) {
            Swal.fire({
                icon: 'warning',
                title: 'No Transaction Selected',
                text: 'Silahkan pilih transaksi yang akan di-approve.',
            });
            return; // Hentikan eksekusi jika Approval kosong
        }

        Swal.fire({
            title: 'Are You Sure?',
            text: "Approve Data !!",
            icon: 'warning',
            showCancelButton: true,
            cancelButtonText: 'Cancel',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.isConfirmed) {
                // Kirim data ke server
                $.ajax({
                    url: approveUrl,
                    method: "get",
                    data: {
                        items: Approval
                    },
                    beforeSend: function () {
                        Swal.fire({
                            title: 'Please Wait ...',
                            allowOutsideClick: false,
                            confirmButtonText: "Something went wrong",
                            confirmButtonColor: "#ea0a2a",
                            didOpen: () => {
                                Swal.showLoading()
                            }
                        })
                    },
                    success: function (msg) {
                        Swal.close();

                        Swal.fire({
                            type: 'success',
                            icon: 'success',
                            title: "Approve Data Successfully",
                            showConfirmButton: false
                        });
                        window.location.reload();
                    },
                    error: function (response) {
                        Swal.close();

                        Swal.fire({
                            type: 'error',
                            icon: 'error',
                            title: "Approve Data Failed",
                            showConfirmButton: false
                        });
                    }
                });
            }
        });
    });


};
