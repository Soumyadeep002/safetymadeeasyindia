

</div>
<!-- Main container end -->

</div>
<!-- Page content end -->

</div>
<!-- Page wrapper end -->

<!--**************************
**************************
**************************
        Required JavaScript Files
**************************
**************************
**************************-->
<!-- Required jQuery first, then Bootstrap Bundle JS -->
<script src="{{url('admin_assets/js/jquery.min.js')}}"></script>
<script src="{{url('admin_assets/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{url('admin_assets/js/moment.js')}}"></script>


<!-- *************
************ Vendor Js Files *************
************* -->
<!-- Slimscroll JS -->
<script src="{{url('admin_assets/vendor/slimscroll/slimscroll.min.js')}}"></script>
<script src="{{url('admin_assets/vendor/slimscroll/custom-scrollbar.js')}}"></script>



		<!-- Summernote JS -->
		<script src="{{url('admin_assets/vendor/summernote/summernote-bs4.js')}}"></script>
		<script>
			$(document).ready(function () {
				$('.summernote').summernote({
					height: '250px',
					tabsize: 2
				});
			});
		</script>


		<!-- Data Tables -->
		<script src="{{url('admin_assets/vendor/datatables/dataTables.min.js')}}"></script>
		<script src="{{url('admin_assets/vendor/datatables/dataTables.bootstrap.min.js')}}"></script>

		<!-- Custom Data tables -->
		<script src="{{url('admin_assets/vendor/datatables/custom/custom-datatables.js')}}"></script>
		<script src="{{url('admin_assets/vendor/datatables/custom/fixedHeader.js')}}"></script>

		<!-- Download / CSV / Copy / Print -->
		<script src="{{url('admin_assets/vendor/datatables/buttons.min.js')}}"></script>
		<script src="{{url('admin_assets/vendor/datatables/jszip.min.js')}}"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
		<script src="{{url('admin_assets/vendor/datatables/vfs_fonts.js')}}"></script>
		<script src="{{url('admin_assets/vendor/datatables/html5.min.js')}}"></script>
		<script src="{{url('admin_assets/vendor/datatables/buttons.print.min.js')}}"></script>


<!-- Main JS -->
<script src="{{url('admin_assets/js/main.js')}}"></script>

</body>

</html>
