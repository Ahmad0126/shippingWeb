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
    obj = $('.edit-btn').data('obj');
    function hide_btn_menu(){
        $('.pilihan').css("display", "none");
        $(".ok-btn").css("display", "none");
        $(".batal-btn").css("display", "none");
        $(".tambah-btn").css("display", "inline-block");
    }
    function show_btn_menu(){
        $('.pilihan').css("display", "inline-block");
        $(".batal-btn").css("display", "inline-block");
        $(".tambah-btn").css("display", "none");
    }
    
    $('.hapus-btn').on("click", function () {
        url = '/hapus';
        edit = false;
        show_btn_menu();
    });
    $('.reset-btn').on("click", function () {
        url = '/reset';
        edit = false;
        show_btn_menu();
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
        $('.ids').prop('checked', false);
        $('tbody tr').off("click");
    });
    $('.ids').on('click', function () {
        if(!edit){
            $(".ok-btn").css("display", "inline-block");
        }
    })
    $('.ok-btn').on("click", function () {
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
    });
</script>


