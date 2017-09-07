
<!-- jQuery -->
<script src="<?php echo e(url('admin/vendors/jquery/dist/jquery.min.js')); ?> "></script>

<!-- Bootstrap -->
<script src="<?php echo e(url('admin/vendors/bootstrap/dist/js/bootstrap.min.js')); ?> "></script>

<!-- FastClick -->
<script src="<?php echo e(url('admin/vendors/fastclick/lib/fastclick.js')); ?> "></script>
<!-- NProgress -->
<script src="<?php echo e(url('admin/vendors/nprogress/nprogress.js')); ?> "></script>
<!-- Chart.js -->
<script src="<?php echo e(url('admin/vendors/Chart.js/dist/Chart.min.js')); ?> "></script>
<!-- gauge.js -->
<script src="<?php echo e(url('admin/vendors/gauge.js/dist/gauge.min.js')); ?> "></script>
<!-- bootstrap-progressbar -->
<script src="<?php echo e(url('admin/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js')); ?> "></script>
<!-- iCheck -->
<script src="<?php echo e(url('admin/vendors/iCheck/icheck.min.js')); ?> "></script>
<!-- Skycons -->
<script src="<?php echo e(url('admin/vendors/skycons/skycons.js')); ?> "></script>
<!-- Flot -->
<script src="<?php echo e(url('admin/vendors/Flot/jquery.flot.js')); ?> "></script>
<script src="<?php echo e(url('admin/vendors/Flot/jquery.flot.pie.js')); ?> "></script>
<script src="<?php echo e(url('admin/vendors/Flot/jquery.flot.time.js')); ?> "></script>
<script src="<?php echo e(url('admin/vendors/Flot/jquery.flot.stack.js')); ?> "></script>
<script src="<?php echo e(url('admin/vendors/Flot/jquery.flot.resize.js')); ?> "></script>
<!-- Flot plugins -->
<script src="<?php echo e(url('admin/vendors/flot.orderbars/js/jquery.flot.orderBars.js')); ?> "></script>
<script src="<?php echo e(url('admin/vendors/flot-spline/js/jquery.flot.spline.min.js')); ?> "></script>
<script src="<?php echo e(url('admin/vendors/flot.curvedlines/curvedLines.js')); ?> "></script>
<!-- DateJS -->
<script src="<?php echo e(url('admin/vendors/DateJS/build/date.js')); ?> "></script>
<!-- JQVMap -->
<script src="<?php echo e(url('admin/vendors/jqvmap/dist/jquery.vmap.js')); ?> "></script>
<script src="<?php echo e(url('admin/vendors/jqvmap/dist/maps/jquery.vmap.world.js')); ?> "></script>
<script src="<?php echo e(url('admin/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js')); ?> "></script>
<script src="<?php echo e(url('admin/vendors/bootstrap-daterangepicker/daterangepicker.js')); ?> "></script>
<!-- bootstrap-daterangepicker -->
<script src="<?php echo e(url('admin/vendors/moment/min/moment.min.js')); ?> "></script>

<!-- Datatables -->
<script src="<?php echo e(url('admin/vendors/datatables.net/js/jquery.dataTables.min.js')); ?> "></script>

<script src="<?php echo e(url('admin/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js')); ?> "></script>
<script src="<?php echo e(url('admin/vendors/datatables.net-buttons/js/dataTables.buttons.min.js')); ?> "></script>
<script src="<?php echo e(url('admin/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js')); ?> "></script>
<script src="<?php echo e(url('admin/vendors/datatables.net-buttons/js/buttons.flash.min.js')); ?> "></script>
<script src="<?php echo e(url('admin/vendors/datatables.net-buttons/js/buttons.html5.min.js')); ?> "></script>
<script src="<?php echo e(url('admin/vendors/datatables.net-buttons/js/buttons.print.min.js')); ?> "></script>
<script src="<?php echo e(url('admin/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js')); ?> "></script>
<script src="<?php echo e(url('admin/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js')); ?> "></script>
<script src="<?php echo e(url('admin/vendors/datatables.net-responsive/js/dataTables.responsive.min.js')); ?> "></script>
<script src="<?php echo e(url('admin/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js')); ?> "></script>

<script src="<?php echo e(url('admin/vendors/jszip/dist/jszip.min.js')); ?> "></script>
<script src="<?php echo e(url('admin/vendors/pdfmake/build/pdfmake.min.js')); ?> "></script>
<script src="<?php echo e(url('admin/vendors/pdfmake/build/vfs_fonts.js')); ?> "></script>

<!-- Custom Theme Scripts -->
<script src="<?php echo e(url('admin/build/js/custom.min.js')); ?> "></script>

<script src="<?php echo e(url('js/sweetalert2.js')); ?>"></script>

<!-- Include this after the sweet alert js file -->
<script>
    $(document).ready(function () {
        var hasSuccessMessage = '<?php echo e(\Session::has('Success Message') ? 1 : 0); ?>';
        var hasErrorMessage = '<?php echo e(\Session::has('Error Message') ? 1 : 0); ?>';
            if(hasSuccessMessage == 1){
                swal({
                    title: 'Success!',
                    text: '<?php echo e(\Session::get('Success Message')); ?>',
                    type: 'success',
                    timer: 2000
                }).then(
                        function () {},
                        // handling the promise rejection
                        function (dismiss) {
                            if (dismiss === 'timer') {
                                console.log('I was closed by the timer')
                            }
                        }
                )
            }else if(hasErrorMessage == 1){
                swal({
                    title: 'Error!',
                    text: '<?php echo e(\Session::get('Error Message')); ?>',
                    type: 'error',
                    timer: 2000
                }).then(
                        function () {},
                        // handling the promise rejection
                        function (dismiss) {
                            if (dismiss === 'timer') {
                                console.log('I was closed by the timer')
                            }
                        }
                )
            }
    });
    $('a.delete').on('click', function(){
      var confirm = false;
      var url = $(this).attr('href');
      swal({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then(function() {
        window.location.replace(url);
      });
      return confirm;
    });
</script>
