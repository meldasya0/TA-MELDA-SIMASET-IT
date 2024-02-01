<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; by Melda Syafitri 2023</span>
        </div>
    </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Keluar</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body text-center my-3">Apakah Anda Yakin Ingin Keluar</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                <a class="btn btn-primary" href="<?= base_url("login/Logout") ?>">Keluar</a>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<!-- Bootstrap core JavaScript-->
<script src="<?php echo base_url('files/'); ?>vendor/jquery/jquery.min.js"></script>
<script src="<?php echo base_url('files/'); ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?php echo base_url('files/'); ?>vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?php echo base_url('files/'); ?>js/sb-admin-2.min.js"></script>


<!-- Page level plugins -->
<script src="<?php echo base_url('files/'); ?>vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url('files/'); ?>vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="<?php echo base_url('files/'); ?>js/demo/datatables-demo.js"></script>

<script>
    $(document).ready(function () {
        $(document).on('input', '.number-separator', function (e) {
            if (/^[0-9.,]+$/.test($(this).val())) {
                $(this).val(
                    parseFloat($(this).val().replace(/,/g, '')).toLocaleString('en')
                );
            } else {
                $(this).val(
                    $(this)
                        .val()
                        .substring(0, $(this).val().length - 1)
                );
            }
        });
    });
</script>
</body>

</html>