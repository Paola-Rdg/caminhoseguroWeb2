</div>

<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Caminho Seguro Web &copy; 2026 &mdash; IF Baiano Campus Guanambi</span>
        </div>
    </div>
</footer>
</div>
</div>

<script src="/caminhoseguroWeb2/public/vendor/jquery/jquery.min.js"></script>
<script src="/caminhoseguroWeb2/public/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/caminhoseguroWeb2/public/vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="/caminhoseguroWeb2/public/js/sb-admin-2.min.js"></script>
<script>
    if (localStorage.getItem('altoContraste') === 'true') {
        document.body.classList.add('alto-contraste');
    }

    function alternarContraste() {
        document.body.classList.toggle('alto-contraste');
        localStorage.setItem('altoContraste', document.body.classList.contains('alto-contraste'));
    }
</script>
</body>

</html>