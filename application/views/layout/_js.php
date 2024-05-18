<script src="<?= base_url('assets/quixlab/') ?>plugins/common/common.min.js"></script>
<script src="<?= base_url('assets/quixlab/') ?>js/custom.min.js"></script>
<script src="<?= base_url('assets/quixlab/') ?>js/settings.js"></script>
<script src="<?= base_url('assets/quixlab/') ?>js/gleek.js"></script>
<script src="<?= base_url('assets/quixlab/') ?>js/styleSwitcher.js"></script>

<script src="<?= base_url('assets/quixlab/') ?>plugins/sweetalert/js/sweetalert.min.js"></script>
<?php if($this->session->flashdata('alert') != null){
    echo $this->session->flashdata('alert');
} ?>
<script>
    var base_url = "<?= base_url() ?>";
    function cabang_edit_modal(row) {
        var tr = $(row);

        $('#id').val(tr.find('input.ids').val());
        $('#fasilitas').val(tr.find('.fasilitas').html());
        $('#kode_pos').val(tr.find('.kode_pos').html());
        $('#kota').val(tr.find('.kota').html());
        $('#alamat').val(tr.find('.alamat').html());

        $('.modal-edit').modal('show');
    };
    function layanan_edit_modal(row){
        var tr = $(row);

        $('#id').val(tr.find('input.ids').val());
        $('#nama').val(tr.find('.nama').html());
        $('#kapasitas').val(tr.find('.kapasitas').data('kapasitas'));
        $('#waktu').val(tr.find('.waktu').data('waktu'));
        $('#ongkir').val(tr.find('.ongkir').data('ongkir'));

        $('.modal-edit').modal('show');
    }
    function user_edit_modal(row){
        var tr = $(row);

        $('#id').val(tr.find('input.ids').val());
        $('#nama').val(tr.find('td.nama').html());
        $('#level').val(tr.find('td.level').html());
        $('#kota').val(tr.find('td.kota').html());
        $('#telp').val(tr.find('td.telp').html());

        $('.modal-edit').modal('show');
    }

    var url = '';
    var edit = false;
    var fwd = false;
    var dlv = false;
    obj = $('.edit-btn').data('obj');
    function hide_btn_menu(){
        $('.pilihan').css("display", "none");
        $(".ok-btn").css("display", "none");
        $(".batal-btn").css("display", "none");
        $(".tambah-btn").css("display", "inline-block");
        $(".cck-btn").css("display", "inline-block");
        $(".acc-btn").css("display", "inline-block");
    }
    function show_btn_menu(){
        $('.ids').prop('checked', false);
        $('.pilihan').css("display", "inline-block");
        $(".batal-btn").css("display", "inline-block");
        $(".tambah-btn").css("display", "none");
        $(".cck-btn").css("display", "none");
    }
    
    $('.hapus-btn').on("click", function () {
        url = '/hapus';
        show_btn_menu();
    });
    $('.reset-btn').on("click", function () {
        url = '/reset';
        show_btn_menu();
    });
    $('.cck-btn').on("click", function () {
        show_btn_menu();
    });
    $('.fwd-btn').on("click", function(){
        show_btn_menu();
        fwd = true;
    });
    $('.dlv-btn').on("click", function(){
        show_btn_menu();
        dlv = true;
        url = '/deliver';
    });
    $('.acc-btn').on("click", function(){
        $('.slc-acc').css("display", "inline-block");
        $(".batal-acc-btn").css("display", "inline-block");
        $(".ok-acc-btn").css("display", "inline-block");
        $(".acc-btn").css("display", "none");
        url = '/accept';
    });
    $('.edit-btn').on("click", function () {
        show_btn_menu();
        edit = true;
        $('tbody tr').each(function (i, tr) {
            $(tr).on("click", function () {
                switch (obj) {
                    case 'cabang': cabang_edit_modal(tr); break;
                    case 'layanan': layanan_edit_modal(tr); break;
                    default: user_edit_modal(tr); break;
                };
            })
        })
    });
    $('.batal-btn').on("click", function () {
        hide_btn_menu();
        edit = false;
        fwd = false;
        dlv = false;
        $('.ids').prop('checked', false);
        $('tbody tr').off("click");
    });
    $('.batal-acc-btn').on("click", function () {
        $('.slc-acc').css("display", "none");
        $(".batal-acc-btn").css("display", "none");
        $(".ok-acc-btn").css("display", "none");
        $(".acc-btn").css("display", "inline-block");
        $('.ids').prop('checked', false);
    });
    $('.ids').on('click', function () {
        if(!edit){
            $(".ok-btn").css("display", "inline-block");
            $(".checkout-btn").css("display", "inline-block");
        }
        if(fwd){
            $(".ok-btn").css("display", "none");
            $(".show-fwd-btn").css("display", "inline-block");
            var id = [];
            $('.ids').each(function(i, e){
                if($(this).is(':checked')){
                    id.push($(this).val());
                }
            });
            $('#kode_pengiriman').val(id);
        }
        if(dlv){
            var id = [];
            $('.ids').each(function(i, e){
                if($(this).is(':checked')){
                    id.push($(this).val());
                }
            });
            $('#kode_pengiriman').val(id);
        }
    })
    $('.ok-btn').on("click", function () {
        if(url = '/deliver'){
            $('#dlv-form').submit();
        }else{
            swal({
                title: "Apakah Anda Yakin?",
                text: "ingin melakukan ini?",
                type: "warning",
                showCancelButton: !0,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Lanjutkan",
                cancelButtonText: "Batal",
            }, function () {
                var id = [];
                $('.ids').each(function(i, e){
                    if($(this).is(':checked')){
                        id.push($(this).val());
                    }
                });
                $.ajax({
                    type: 'POST',
                    dataType: 'JSON',
                    url: base_url + obj + url,
                    data: {id_user: id},
                    success: function(data){
                        hide_btn_menu();
                        location.reload();
                    },
                    error: function(){
                        console.log('GAGAL!');
                        swal({
                            title: "GAGAL",
                            type: "danger",
                            text: "Terjadi kesalahan pada server",
                            timer: 2e3
                        });
                    }
                });
            });
        }
    });
    $('.ok-acc-btn').on("click", function () {
        var id = [];
        $('.kodes').each(function(i, e){
            if($(this).is(':checked')){
                id.push($(this).val());
            }
        });
        $.ajax({
            type: 'POST',
            dataType: 'JSON',
            url: base_url + obj + url,
            data: {id_user: id},
            success: function(data){
                hide_btn_menu();
                location.reload();
            },
            error: function(){
                console.log('GAGAL!');
                swal({
                    title: "GAGAL",
                    type: "danger",
                    text: "Terjadi kesalahan pada server",
                    timer: 2e3
                });
            }
        });
    });
    
    $('.checkout-btn').on('click', function () {
        $('#chot_pngrmn').submit();
    });
    $('.select-pembayaran').on('click', function(){
        if($(this).val() == 'kredit'){
            $('.div-kredit').css('display', 'block');
            $('.div-tunai').css('display', 'none');
        }else{
            $('.div-kredit').css('display', 'none');
            $('.div-tunai').css('display', 'block');
        }
    });
    $('.bayar-inp').on('keyup', function(){
        var total = $('._total').val();
        var bayar = $(this).val();
        var kembalian = parseInt(bayar) - parseInt(total);
        $('.kembalian-text').html('Rp '+kembalian.toLocaleString());
    })
</script>


