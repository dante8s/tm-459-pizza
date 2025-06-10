        </main>
        <?php include 'partials/sidebar.php'; ?>
    </div>
    <script src="../../js/jquery.js"></script>
    <script src="../../js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.toggle-sidebar').click(function() {
                $('.admin-wrapper').toggleClass('sidebar-collapsed');
            });
        });
    </script>
</body>
</html>