<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<!-- <script src="<?php echo base_url('assets/template') ?>/plugins/jquery/jquery.min.js"></script> -->
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url('assets/template') ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<script src="<?php echo base_url('assets/template') ?>/plugins/select2/select2.full.min.js"></script>

<!-- AdminLTE App -->
<script src="<?php echo base_url('assets/template') ?>/dist/js/adminlte.min.js"></script>

<script src="<?php echo base_url('assets/js/notify.min.js') ?>"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script type="text/javascript">
var sweet_loader = '<div class="sweet_loader"><img src="http://bpskalsel.com/ckponline_dev/assets/ajax-loader.gif" /></div>';

</script>

</script>


<?php if ($this->session->get_flash_keys()):?>

    <script>

      $(document).ready(function(){

        <?php foreach ($this->session->get_flash_keys() as $fk):?>

        $.notify("<?php echo strip_tags($this->session->flashdata($fk));?>", "<?php echo $fk;?>");

        <?php endforeach;?>

      });

    </script>

<?php endif;?>

