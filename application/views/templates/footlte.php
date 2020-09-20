<!-- import jquery js -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url() ?>assets/lte/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url() ?>assets/dist/js/adminlte.min.js"></script>
<!-- Custom Script -->
<?php
    if(isset($js)){
        echo $js;
    }
?>
</body>
</html>