<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init();
    $(document).ready(function() {
        $("#logoutIcon").click(function() {
            $("#logoutCard1").toggle();
        });
    });
</script>
@stack('scripts')
</body>
</html>
