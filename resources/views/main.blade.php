@include('layouts.header')

@include('layouts.sidebar')


<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    @include('layouts.content')


    @include('layouts.footer')

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Bootstrap core JavaScript-->
<script src="{{ asset('temp') }}/vendor/jquery/jquery.min.js"></script>
<script src="{{ asset('temp') }}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="{{ asset('temp') }}/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="{{ asset('temp') }}/js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="{{ asset('temp') }}/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="{{ asset('temp') }}/vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="{{ asset('temp') }}/js/demo/datatables-demo.js"></script>

<script>
    document.getElementById('role').addEventListener('change', function() {
        if (this.value === 'client') {
            document.getElementById('unit').disabled = false;
        } else {
            document.getElementById('unit').disabled = true;
        }
    })
</script>

<script>
    function onFormSubmit() {
        document.getElementById('formLabel').innerHTML = "New";

        setTimeout(function() {
            document.getElementById('formLabel').innerHTML = "";
        }, 1440000);
    }
</script>

</body>

</html>
