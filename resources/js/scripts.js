$(document).ready(function() {
    // Fungsi untuk menangani perubahan bidang
    $('#bidang').on('change', function() {
        var KODE_BIDANG = $(this).val();
        if (KODE_BIDANG) {
            $.ajax({
                url: '/getUnits/' + KODE_BIDANG,
                type: "GET",
                dataType: "json",
                success: function(data) {
                    console.log('Data Units:', data);
                    $('#unit').html('<option value="">--Pilih--</option>');
                    $.each(data, function(key, value) {
                        console.log('Unit:', value);
                        $('#unit').append('<option value="' + value.KODE_UNITS +
                            '">' + value.NAMA_UNITS + '</option>');
                    });
                    $('#subunit').html('<option value="">--Pilih--</option>');
                    $('#upb').html('<option value="">--Pilih--</option>');
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error('Error fetching units:', textStatus, errorThrown);
                }
            });
        } else {
            $('#unit').html('<option value="">--Pilih--</option>');
            $('#subunit').html('<option value="">--Pilih--</option>');
            $('#upb').html('<option value="">--Pilih--</option>');
        }
    });

    // Fungsi untuk menangani perubahan unit
    $('#unit').on('change', function() {
        var KODE_UNITS = $(this).val();
        if (KODE_UNITS) {
            $.ajax({
                url: '/getSubunits/' + KODE_UNITS,
                type: "GET",
                dataType: "json",
                success: function(data) {
                    console.log('Data Subunits:', data);
                    $('#subunit').html('<option value="">--Pilih--</option>');
                    $.each(data, function(key, value) {
                        console.log('Subunit:', value);
                        $('#subunit').append('<option value="' + value.KODE_SUB_UNITS +
                            '">' + value.NAMA_SUB_UNITS + '</option>');
                    });
                    $('#upb').html('<option value="">--Pilih--</option>');
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error('Error fetching subunits:', textStatus, errorThrown);
                }
            });
        } else {
            $('#subunit').html('<option value="">--Pilih--</option>');
            $('#upb').html('<option value="">--Pilih--</option>');
        }
    });

    // Fungsi untuk menangani perubahan Sub unit
    $('#subunit').on('change', function() {
        var KODE_SUB_UNITS = $(this).val();
        if (KODE_SUB_UNITS) {
            $.ajax({
                url: '/getUPB/' + KODE_SUB_UNITS,
                type: "GET",
                dataType: "json",
                success: function(data) {
                    console.log('Data UPB:', data);
                    $('#upb').html('<option value="">--Pilih--</option>');
                    $.each(data, function(key, value) {
                        console.log('UPB:', value);
                        $('#upb').append('<option value="' + value.KODE_UPB +
                            '">' + value.NAMA_UPB + '</option>');
                    });
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error('Error fetching subunits:', textStatus, errorThrown);
                }
            });
        } else {
            $('#upb').html('<option value="">--Pilih--</option>');
        }
    });

    function fetchKibaData(url) {
        $.ajax({
            url: url,
            type: "GET",
            dataType: "json",
            success: function(data) {
                console.log('Data KIBA:', data);
                var tableBody = $('#kibaData').find('tbody');
                tableBody.empty(); 
                if (data.data.length === 0) {
                    tableBody.append('<tr><td colspan="5">Data tidak ditemukan</td></tr>');
                } else {
                    $.each(data.data, function(index, kiba) {
                        var row = $('<tr>');
                        row.append($('<td>').text(index + 1)); 
                        row.append($('<td>').text(kiba.NAMA_BARANG));
                        row.append($('<td>').text(kiba.LETAK_ALAMAT));
                        row.append($('<td>').text(kiba.PENGGUNAAN));
                        var detailButton = '<td><a href="/detail/' + kiba.id + '" class="btn btn-success btn-sm text-white detail" data-id="' + kiba.ID + '" style="font-weight: 600; margin-top:0px;"><i class="bi bi-info-circle-fill"></i>&nbsp;Detail</a></td>';
                        row.append(detailButton);
                        tableBody.append(row);
                    });
                }
                $('#kibaData').show();

                $('#pagination').empty();
                if (data.last_page > 1) { 
                    if (data.prev_page_url) {
                        $('#pagination').append('<li class="page-item"><a class="page-link" href="#" data-url="' + data.prev_page_url + '">Previous</a></li>');
                    }

                    var visiblePages = 4;

                    var startPage = Math.max(1, data.current_page - Math.floor(visiblePages / 2));
                    var endPage = Math.min(data.last_page, startPage + visiblePages - 1);

                    if (startPage > 1) {
                        $('#pagination').append('<li class="page-item"><a class="page-link" href="#" data-url="' + data.path + '?page=1">1</a></li>');
                        if (startPage > 2) {
                            $('#pagination').append('<li class="page-item disabled"><span class="page-link">...</span></li>');
                        }
                    }

                    for (var i = startPage; i <= endPage; i++) {
                        var activeClass = data.current_page === i ? ' active' : '';
                        $('#pagination').append('<li class="page-item' + activeClass + '"><a class="page-link" href="#" data-url="' + data.path + '?page=' + i + '">' + i + '</a></li>');
                    }

                    if (endPage < data.last_page) {
                        if (endPage < data.last_page - 1) {
                            $('#pagination').append('<li class="page-item disabled"><span class="page-link">...</span></li>');
                        }
                        $('#pagination').append('<li class="page-item"><a class="page-link" href="#" data-url="' + data.path + '?page=' + data.last_page + '">' + data.last_page + '</a></li>');
                    }

                    if (data.next_page_url) {
                        $('#pagination').append('<li class="page-item"><a class="page-link" href="#" data-url="' + data.next_page_url + '">Next</a></li>');
                    }
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Error fetching KIBA:', textStatus, errorThrown);
            }
        });
    }
        
    $('select').select2({
        theme: 'bootstrap-5',
        width: '100%',
        placeholder: function() {
            return $(this).data('placeholder');
        }
    });
    $('#exportBtn').on('click', function() {
        var formData = $('#filterForm').serialize();
        window.location.href = '/export?' + formData;
    });

    // Fungsi untuk menangani perubahan upb
    $('#upb').on('change', function() {
        var kodeUPB = $(this).val();
        if (kodeUPB) {
            fetchKibaData('/getKibaByUPB/' + kodeUPB);
        }
    });

    function fetchKibbData(url) {
        $.ajax({
            url: url,
            type: "GET",
            dataType: "json",
            success: function(data) {
                console.log('Data KIBB:', data);
                var tableBody = $('#kibbData').find('tbody');
                tableBody.empty(); 
                if (data.data.length === 0) {
                    tableBody.append('<tr><td colspan="5">Data tidak ditemukan</td></tr>');
                } else {
                    $.each(data.data, function(index, kibb) {
                        var row = $('<tr>');
                        row.append($('<td>').text(index + 1));
                        row.append($('<td>').text(kibb.NAMA_BARANG));
                        row.append($('<td>').text(kibb.MERK_TYPE));
                        row.append($('<td>').text(kibb.NOMOR_POLISI));
                        var detailButton = '<td><a href="/detail-b/' + kibb.id + '" class="btn btn-success btn-sm text-white detail" data-id="' + kibb.ID + '" style="font-weight: 600; margin-top:0px;"><i class="bi bi-info-circle-fill"></i>&nbsp;Detail</a></td>';
                        row.append(detailButton);
                        tableBody.append(row);
                    });
                }
                $('#kibbData').show();

                $('#paginationb').empty();
                    if (data.last_page > 1) { 
                        if (data.prev_page_url) {
                            $('#paginationb').append('<li class="page-item"><a class="page-link" href="#" data-url="' + data.prev_page_url + '">Previous</a></li>');
                        }
    
                        var visiblePages = 4;
    
                        var startPage = Math.max(1, data.current_page - Math.floor(visiblePages / 2));
                        var endPage = Math.min(data.last_page, startPage + visiblePages - 1);
    
                        if (startPage > 1) {
                            $('#paginationb').append('<li class="page-item"><a class="page-link" href="#" data-url="' + data.path + '?page=1">1</a></li>');
                            if (startPage > 2) {
                                $('#paginationb').append('<li class="page-item disabled"><span class="page-link">...</span></li>');
                            }
                        }
    
                        for (var i = startPage; i <= endPage; i++) {
                            var activeClass = data.current_page === i ? ' active' : '';
                            $('#paginationb').append('<li class="page-item' + activeClass + '"><a class="page-link" href="#" data-url="' + data.path + '?page=' + i + '">' + i + '</a></li>');
                        }
    
                        if (endPage < data.last_page) {
                            if (endPage < data.last_page - 1) {
                                $('#paginationb').append('<li class="page-item disabled"><span class="page-link">...</span></li>');
                            }
                            $('#paginationb').append('<li class="page-item"><a class="page-link" href="#" data-url="' + data.path + '?page=' + data.last_page + '">' + data.last_page + '</a></li>');
                        }
    
                        if (data.next_page_url) {
                            $('#paginationb').append('<li class="page-item"><a class="page-link" href="#" data-url="' + data.next_page_url + '">Next</a></li>');
                        }
                    }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Error fetching KIBB:', textStatus, errorThrown);
            }
        });
    }

    // Fungsi untuk menangani perubahan upb
    $('#upb').on('change', function() {
        var kodeUPB = $(this).val();
        if (kodeUPB) {
            fetchKibbData('/getKibbByUPB/' + kodeUPB);
        }
    });


    // Handle pagination link clicks
    $(document).on('click', '.page-link', function(e) {
        e.preventDefault();
        var url = $(this).data('url');
        if (url) {
            fetchKibaData(url);
        }
    });

    $('#exportBtnb').on('click', function() {
        var formData = $('#filterFormb').serialize();
        window.location.href = '/exportb?' + formData;
    });


    // Handle pagination link clicks
    $(document).on('click', '.page-link', function(e) {
        e.preventDefault();
        var url = $(this).data('url');
        if (url) {
            fetchKibbData(url);
        }
    });

    function fetchKibcData(url) {
        $.ajax({
            url: url,
            type: "GET",
            dataType: "json",
            success: function(data) {
                console.log('Data KIBC:', data);
                var tableBody = $('#kibcData').find('tbody');
                tableBody.empty(); 
                if (data.data.length === 0) {
                    tableBody.append('<tr><td colspan="5">Data tidak ditemukan</td></tr>');
                } else {
                    $.each(data.data, function(index, kibc) {
                        var row = $('<tr>');
                        row.append($('<td>').text(index + 1));
                        row.append($('<td>').text(kibc.NAMA_BARANG));
                        row.append($('<td>').text(kibc.LETAK_ALAMAT));
                        row.append($('<td>').text(kibc.KETERANGAN));
                        var detailButton = '<td><a href="/detail-c/' + kibc.id + '" class="btn btn-success btn-sm text-white detail" data-id="' + kibc.ID + '" style="font-weight: 600; margin-top:0px;"><i class="bi bi-info-circle-fill"></i>&nbsp;Detail</a></td>';
                        row.append(detailButton);
                        tableBody.append(row);
                    });
                }
                $('#kibcData').show();

                  $('#paginationc').empty();
                  if (data.last_page > 1) { 
                      if (data.prev_page_url) {
                          $('#paginationc').append('<li class="page-item"><a class="page-link" href="#" data-url="' + data.prev_page_url + '">Previous</a></li>');
                      }
  
                      var visiblePages = 4; 
  
                      var startPage = Math.max(1, data.current_page - Math.floor(visiblePages / 2));
                      var endPage = Math.min(data.last_page, startPage + visiblePages - 1);
  
                      if (startPage > 1) {
                          $('#paginationc').append('<li class="page-item"><a class="page-link" href="#" data-url="' + data.path + '?page=1">1</a></li>');
                          if (startPage > 2) {
                              $('#paginationc').append('<li class="page-item disabled"><span class="page-link">...</span></li>');
                          }
                      }
  
                      for (var i = startPage; i <= endPage; i++) {
                          var activeClass = data.current_page === i ? ' active' : '';
                          $('#paginationc').append('<li class="page-item' + activeClass + '"><a class="page-link" href="#" data-url="' + data.path + '?page=' + i + '">' + i + '</a></li>');
                      }
  
                      if (endPage < data.last_page) {
                          if (endPage < data.last_page - 1) {
                              $('#paginationc').append('<li class="page-item disabled"><span class="page-link">...</span></li>');
                          }
                          $('#paginationc').append('<li class="page-item"><a class="page-link" href="#" data-url="' + data.path + '?page=' + data.last_page + '">' + data.last_page + '</a></li>');
                      }
  
                      if (data.next_page_url) {
                          $('#paginationc').append('<li class="page-item"><a class="page-link" href="#" data-url="' + data.next_page_url + '">Next</a></li>');
                      }
                  }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Error fetching KIBC:', textStatus, errorThrown);
            }
        });
    }


    // Fungsi untuk menangani perubahan upb
    $('#upb').on('change', function() {
        var kodeUPB = $(this).val();
        if (kodeUPB) {
            fetchKibcData('/getKibcByUPB/' + kodeUPB);
        }
    });
  
    // Handle pagination link clicks
    $(document).on('click', '.page-link', function(e) {
        e.preventDefault();
        var url = $(this).data('url');
        if (url) {
            fetchKibcData(url);
        }
    });
    $('#exportBtnc').on('click', function() {
        var formData = $('#filterFormc').serialize();
        window.location.href = '/exportc?' + formData;
    });


    (function($) {
        "use strict";
    
        var fullHeight = function() {
            $('.js-fullheight').css('height', $(window).height());
            $(window).resize(function(){
                $('.js-fullheight').css('height', $(window).height());
            });
        };
        fullHeight();
    
        var handleResponsive = function() {
            var windowWidth = $(window).width();
    
            if (windowWidth < 769) {
                $('#sidebar').addClass('active');
                $('#content').addClass('active');
            } else {
                $('#sidebar').removeClass('active');
                $('#content').removeClass('active');
            }
        };
    
        // Call the function when the page loads and when it's resized
        handleResponsive();
        $(window).resize(handleResponsive);
    
        $('#sidebarCollapse').on('click', function () {
            var windowWidth = $(window).width();
    
            if (windowWidth >= 769) {
                $('#sidebar').toggleClass('active');
                $('#content').toggleClass('active');
            }
        });
    
    })(jQuery);
    
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
    var NAMA_UPB = $(this).find('option:selected').text();
    localStorage.setItem('NAMA_UPB', NAMA_UPB);
});
 // Mengambil nilai dari localStorage
 $('#KODE_BIDANG').val(localStorage.getItem('KODE_BIDANG'));
 $('#KODE_UNITS').val(localStorage.getItem('KODE_UNITS'));
 $('#KODE_SUB_UNITS').val(localStorage.getItem('KODE_SUB_UNITS'));
 $('#NAMA_SUB_UNITS').val(localStorage.getItem('NAMA_SUB_UNITS'));
 $('#KODE_UPB').val(localStorage.getItem('KODE_UPB'));
 $('#NAMA_UPB').val(localStorage.getItem('NAMA_UPB'));


$('#bidang, #unit, #subunit, #upb').change(function() {
    localStorage.setItem('filter_bidang', $('#bidang').val());
    localStorage.setItem('filter_unit', $('#unit').val());
    localStorage.setItem('filter_subunit', $('#subunit').val());
    localStorage.setItem('filter_upb', $('#upb').val());
});


$('#editForm').on('submit', function(e) {
    e.preventDefault();

    var formData = new FormData(this);
    var id = window.location.pathname.split('/').pop(); 

    $.ajax({
        url: '/update/' + id,
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            if (response.success) {
                sessionStorage.setItem('editMessage', response.message);

                window.location.href = '/detail/' + id;
            } else {
                alert(response.message);
            }
        },
        error: function(xhr) {
            alert('Gagal menyimpan data');
        }
    });
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


