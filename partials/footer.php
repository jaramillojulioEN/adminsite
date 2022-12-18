</div>
</body>


<script>

    $(document).ready(function(){
        archivo = window.location.pathname.split("/")
        pag = archivo[3].split(".")
        current = (pag[0])
        $("#"+current).addClass("active")
        document.title = "AdminSite | "+$(".active").text();
    })
</script>
</html>