<nav id="sidebar" style="background-color: green">
    <div class="custom-menu">
        <button type="button" id="sidebarCollapse" class="btn btn-primary">
            <i class="fa fa-bars"></i>
            <span class="sr-only">Toggle Menu</span>
        </button>
    </div>
    <div class="p-4 pt-5">
        <h1><a href="index.html" class="logo">APIPA</a></h1>
        <ul class="list-unstyled components mb-5">
            <li class="active">
                <a href="{{ route('dashboard') }}" data-toggle="collapse" aria-expanded="false" >Tableau de bord</a>

            </li>
            <li>
                <a href="{{ route('demande_pc.index') }}">Demande PC</a>
            </li>
            <li>
                <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Audits</a>
            </li>
            <li>
                <a href="{{ route('service-envoyeur') }}">Stats envoye</a>
            </li>
            <li>
                <a href="{{ route('service-categorie') }}">Stats Categorie</a>
            </li>
        </ul>


        <div class="footer">
            <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                Copyright &copy;
                    <script>
                    document.write(new Date().getFullYear());
                </script> 
            </p>
        </div>

    </div>
</nav>
