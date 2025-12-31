$(document).ready(function () {

    function initSelect2(selector, placeholder = 'Choose one option') {
        $(selector).select2({
            theme: 'bootstrap-5',
            width: '100%',
            placeholder: placeholder,
            allowClear: false
        });
    }

    function resetSelect2(selector, placeholder = '--Pilih--') {
        if ($(selector).hasClass('select2-hidden-accessible')) {
            $(selector).select2('destroy');
        }

        $(selector).html(`<option value="">${placeholder}</option>`);

        $(selector).select2({
            theme: 'bootstrap-5',
            width: '100%',
            placeholder: placeholder,
            allowClear: false
        });
    }

    initSelect2('#bidang');
    initSelect2('#unit');
    initSelect2('#subunit');
    initSelect2('#upb');

    // BIDANG → UNIT
    $('#bidang').on('change', function () {
        const KODE_BIDANG = $(this).val();

        resetSelect2('#unit');
        resetSelect2('#subunit');
        resetSelect2('#upb');

        if (!KODE_BIDANG) return;

        $.getJSON('/getUnits/' + KODE_BIDANG, function (data) {
            $.each(data, function (_, value) {
                $('#unit').append(
                    `<option value="${value.KODE_UNITS}">${value.NAMA_UNITS}</option>`
                );
            });
            $('#unit').trigger('change.select2');
        });
    });

    // UNIT → SUBUNIT
    $('#unit').on('change', function () {
        const KODE_UNITS = $(this).val();

        resetSelect2('#subunit');
        resetSelect2('#upb');

        if (!KODE_UNITS) return;

        $.getJSON('/getSubunits/' + KODE_UNITS, function (data) {
            $.each(data, function (_, value) {
                $('#subunit').append(
                    `<option value="${value.KODE_SUB_UNITS}">${value.NAMA_SUB_UNITS}</option>`
                );
            });
            $('#subunit').trigger('change.select2');
        });
    });

    // SUBUNIT → UPB
    $('#subunit').on('change', function () {
        const KODE_SUB_UNITS = $(this).val();

        resetSelect2('#upb');

        if (!KODE_SUB_UNITS) return;

        $.getJSON('/getUPB/' + KODE_SUB_UNITS, function (data) {
            $.each(data, function (_, value) {
                $('#upb').append(
                    `<option value="${value.KODE_UPB}">${value.NAMA_UPB}</option>`
                );
            });
            $('#upb').trigger('change.select2');
        });
    });
  
     // KIB CONFIG & FETCH
    const kibConfig = {
        a: { table: '#kibaData', pagination: '#pagination', api: '/getKibaByUPB/', detailUrl: '/detail/', columns: ['NAMA_BARANG', 'LETAK_ALAMAT', 'PENGGUNAAN'] },
        b: { table: '#kibbData', pagination: '#paginationb', api: '/getKibbByUPB/', detailUrl: '/detail-b/', columns: ['NAMA_BARANG', 'MERK_TYPE', 'NOMOR_POLISI'] },
        c: { table: '#kibcData', pagination: '#paginationc', api: '/getKibcByUPB/', detailUrl: '/detail-c/', columns: ['NAMA_BARANG', 'LETAK_ALAMAT', 'KETERANGAN'] },
        d: { table: '#kibdData', pagination: '#paginationd', api: '/getKibdByUPB/', detailUrl: '/detail-d/', columns: ['nama_barang', 'spesifikasi_nama_barang', 'lokasi'] }
    };

    function fetchKibData(type, url) {
        const cfg = kibConfig[type];

        $.getJSON(url, function (data) {
            const tbody = $(cfg.table).find('tbody').empty();

            if (!data.data.length) {
                tbody.append('<tr><td colspan="5">Data tidak ditemukan</td></tr>');
            } else {
                $.each(data.data, function (i, item) {
                    let row = `<tr><td>${i + 1}</td>`;
                    cfg.columns.forEach(col => row += `<td>${item[col] ?? '-'}</td>`);
                    row += `
                        <td>
                            <a href="${cfg.detailUrl}${item.id}" class="btn btn-sm d-block d-md-inline-block mb-2 mb-md-0 detail">
                                <i class="bi bi-info-circle-fill"></i> Detail
                            </a>
                        </td>
                    </tr>`;
                    tbody.append(row);
                });
            }

            $(cfg.table).show();
            renderPagination(type, data);
        });
    }

    function renderPagination(type, data) {
        const pag = $(kibConfig[type].pagination).empty();

        if (data.last_page <= 1) return;

        for (let i = 1; i <= data.last_page; i++) {
            pag.append(`
                <li class="page-item ${data.current_page === i ? 'active' : ''}">
                    <a class="page-link" data-type="${type}" data-url="${data.path}?page=${i}">${i}</a>
                </li>
            `);
        }
    }

    $('#upb').on('change', function () {
        const kodeUPB = $(this).val();
        if (!kodeUPB) return;

        Object.keys(kibConfig).forEach(type => {
            fetchKibData(type, kibConfig[type].api + kodeUPB);
        });
    });

    $(document).on('click', '.page-link', function (e) {
        e.preventDefault();
        fetchKibData($(this).data('type'), $(this).data('url'));
    });

});


    // Menyimpan nilai ke localStorage setelah user memilih
$('#bidang').on('change', function() {
    var KODE_BIDANG = $(this).val();
    localStorage.setItem('KODE_BIDANG', KODE_BIDANG);
});

$('#unit').on('change', function() {
    var KODE_UNITS = $(this).val();
    localStorage.setItem('KODE_UNITS', KODE_UNITS);
});

$('#subunit').on('change', function() {
    var KODE_SUB_UNITS = $(this).val();
    localStorage.setItem('KODE_SUB_UNITS', KODE_SUB_UNITS);
    var NAMA_SUB_UNITS = $(this).find('option:selected').text();
    localStorage.setItem('NAMA_SUB_UNITS', NAMA_SUB_UNITS);
});

$('#upb').on('change', function() {
    var KODE_UPB = $(this).val();
    localStorage.setItem('KODE_UPB', KODE_UPB);
});
 // Mengambil nilai dari localStorage
 $('#KODE_BIDANG').val(localStorage.getItem('KODE_BIDANG'));
 $('#KODE_UNITS').val(localStorage.getItem('KODE_UNITS'));
 $('#KODE_SUB_UNITS').val(localStorage.getItem('KODE_SUB_UNITS'));
 $('#NAMA_SUB_UNITS').val(localStorage.getItem('NAMA_SUB_UNITS'));
 $('#KODE_UPB').val(localStorage.getItem('KODE_UPB'));

$('#bidang, #unit, #subunit, #upb').change(function() {
    localStorage.setItem('filter_bidang', $('#bidang').val());
    localStorage.setItem('filter_unit', $('#unit').val());
    localStorage.setItem('filter_subunit', $('#subunit').val());
    localStorage.setItem('filter_upb', $('#upb').val());
});

document.getElementById('DOWNLOAD').addEventListener('change', function() {
    var file = this.files[0];
    if (file.type !== 'application/pdf') {
        document.getElementById('fileError').textContent = 'Hanya file PDF yang diizinkan!';
        this.value = '';
    } else {
        document.getElementById('fileError').textContent = '';
    }
});

document.getElementById('FOTO').addEventListener('change', function() {
    var file = this.files[0];
    var allowedTypes = ['image/png', 'image/jpeg', 'image/jpg'];
    if (!allowedTypes.includes(file.type)) {
        document.getElementById('fotoError').textContent = 'Hanya file PNG/JPEG/JPG yang diizinkan!';
        this.value = '';
    } else {
        document.getElementById('fotoError').textContent = '';
    }
});




