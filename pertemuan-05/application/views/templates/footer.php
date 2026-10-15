<footer class="main-footer">
    <div class="pull-right hidden-xs">
      Anything you want
    </div>
    <strong>Copyright &copy; 2016 <a href="#">Company</a>.</strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->
<script src="<?= htmlspecialchars($adminlte_url . 'bower_components/jquery/dist/jquery.min.js', ENT_QUOTES, 'UTF-8') ?>"></script>
<script src="<?= htmlspecialchars($adminlte_url . 'bower_components/bootstrap/dist/js/bootstrap.min.js', ENT_QUOTES, 'UTF-8') ?>"></script>

<!-- BARU - DataTables -->
<script src="<?= htmlspecialchars($adminlte_url . 'bower_components/datatables.net/js/jquery.dataTables.min.js', ENT_QUOTES, 'UTF-8') ?>"></script>
<script src="<?= htmlspecialchars($adminlte_url . 'bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js', ENT_QUOTES, 'UTF-8') ?>"></script>
<script src="<?= htmlspecialchars($adminlte_url . 'dist/js/adminlte.min.js', ENT_QUOTES, 'UTF-8') ?>"></script>

<!-- BARU - inisialisasi DataTables -->
<script>
  $(function() {
    $('.js-data-table').DataTable({
      'paging': true,
      'lengthChange': true,
      'searching': true,
      'ordering': true,
      'info': true,
      'autoWidth': false,
      'columnDefs': [
        { 'orderable': false, 'targets': 'no-sort' }
      ],
      'language': {
        'lengthMenu': 'Tampilkan _MENU_ data',
        'zeroRecords': 'Data tidak ditemukan',
        'info': 'Menampilkan _START_ sampai _END_ dari _TOTAL_ data',
        'infoEmpty': 'Tidak ada data',
        'search': 'Cari:',
        'paginate': {
          'first': 'Pertama',
          'last': 'Terakhir',
          'next': 'Berikutnya',
          'previous': 'Sebelumnya'
        }
      }
    });
  });
</script>
</body>
</html>