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
    $(".hapus-user").on("click", function () {
        var loc = "<?= base_url('user/hapus/') ?>"+ $(this).data('id');
        swal({
            title: "Are you sure to delete ?",
            type: "warning",
            showCancelButton: !0,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Hapus",
            cancelButtonText: "Batal",
            closeOnConfirm: !1
        }, function () {
            window.location.href = loc;
        })
    });
    $(".reset-user").on("click", function () {
        var id = ""+ $(this).data('id');
        swal({
            title: "Are you sure to reset ?",
            type: "warning",
            showCancelButton: !0,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Reset",
            cancelButtonText: "Batal",
            closeOnConfirm: !1
        }, function (data) {
            $.ajax({
                type: 'POST',
                dataType: 'JSON',
                url: "<?= base_url('user/reset/') ?>",
                data: {id_user: id},
                success: function(){
                }
            });
            swal({
                title: "OK",
                type: "success",
                text: "Berhasil mereset password",
                timer: 2e3
            });
        })
    });
    $(".hapus-cabang").on("click", function () {
        var loc = "<?= base_url('cabang/hapus/') ?>"+ $(this).data('id');
        swal({
            title: "Are you sure to delete ?",
            type: "warning",
            showCancelButton: !0,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Hapus",
            cancelButtonText: "Batal",
            closeOnConfirm: !1
        }, function () {
            window.location.href = loc;
        })
    });
    $(".edit-cabang").on("click", function () {
        var button = $(this);

        $('#id').val(button.data('id'));
        $('#fasilitas').val(button.data('fasilitas'));
        $('#kode_pos').val(button.data('kode_pos'));
        $('#kota').val(button.data('kota'));
        $('#alamat').val(button.data('alamat'));

        $('.modal-edit').modal('show');
    });
    $(".edit-user").on("click", function () {
        var button = $(this);

        $('#id').val(button.data('id'));
        $('#nama').val(button.data('nama'));
        $('#level').val(button.data('level'));
        $('#kota').val(button.data('kota'));
        $('#telp').val(button.data('telp'));

        $('.modal-edit').modal('show');
    });
</script>
<!-- Chartjs -->
<script src="<?= base_url('assets/quixlab/') ?>plugins/chart.js/Chart.bundle.min.js"></script>
<!-- Circle progress -->
<script src="<?= base_url('assets/quixlab/') ?>plugins/circle-progress/circle-progress.min.js"></script>
<!-- Datamap -->
<script src="<?= base_url('assets/quixlab/') ?>plugins/d3v3/index.js"></script>
<script src="<?= base_url('assets/quixlab/') ?>plugins/topojson/topojson.min.js"></script>
<script src="<?= base_url('assets/quixlab/') ?>plugins/datamaps/datamaps.world.min.js"></script>
<!-- Morrisjs -->
<script src="<?= base_url('assets/quixlab/') ?>plugins/raphael/raphael.min.js"></script>
<script src="<?= base_url('assets/quixlab/') ?>plugins/morris/morris.min.js"></script>
<!-- Pignose Calender -->
<script src="<?= base_url('assets/quixlab/') ?>plugins/moment/moment.min.js"></script>
<script src="<?= base_url('assets/quixlab/') ?>plugins/pg-calendar/js/pignose.calendar.min.js"></script>
<!-- ChartistJS -->
<script src="<?= base_url('assets/quixlab/') ?>plugins/chartist/js/chartist.min.js"></script>
<script src="<?= base_url('assets/quixlab/') ?>plugins/chartist-plugin-tooltips/js/chartist-plugin-tooltip.min.js"></script>


