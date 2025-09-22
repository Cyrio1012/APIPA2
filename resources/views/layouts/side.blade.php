<!-- app.blade.php -->
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Sidebar Vue</title>
    <script src="https://unpkg.com/vue@3"></script>
    <script src="https://unpkg.com/vue-router@4"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css"
        integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
     --}}
    {{-- <link rel="stylesheet" href="https://colorlib.com/etc/bootstrap-sidebar/sidebar-03/css/style.css"> --}}

<!-- Bootstrap Table CSS -->
<link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.21.1/dist/bootstrap-table.min.css">
    <style>
        .sidebar ul li {
            list-style: none;
            margin: 0.5rem 0;
        }

        .sidebar ul li.active a {
            font-weight: bold;
            color: #007bff;
        }
    </style>


</head>

<body>
    <div id="app">
        <sidebar></sidebar>
        <div id="main-content"></div>
    </div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Bootstrap Table JS -->
    <script src="https://unpkg.com/bootstrap-table@1.21.1/dist/bootstrap-table.min.js"></script>
    <script>
        const Sidebar = {
            data() {
                return {
                    currentRoute: window.location.pathname
                }
            },
            methods: {
                navigateTo(route) {
                    this.currentRoute = route
                    history.pushState(null, '', route)
                    fetch(route)
                        .then(res => res.text())
                        .then(html => {
                            const parser = new DOMParser()
                            const doc = parser.parseFromString(html, 'text/html')
                            document.querySelector('#main-content').innerHTML = doc.body.innerHTML
                        })
                },
                isActive(route) {
                    return this.currentRoute === route ? 'active' : ''
                }
            },
            template: `
    <nav id="sidebar" style="background-color: green">
      <div class="custom-menu">
        <button type="button" id="sidebarCollapse" class="btn btn-primary">
          <i class="fa fa-bars"></i>
          <span class="sr-only">Toggle Menu</span>
        </button>
      </div>
      <div class="p-4 pt-5">
        <h1><a href="/" class="logo">APIPA</a></h1>
        <ul class="list-unstyled components mb-5">
          <li :class="isActive('/')">
            <a href="#" @click.prevent="navigateTo('/')">Tableau de bord</a>
          </li>
          <li :class="isActive('/demande_pc')">
            <a href="#" @click.prevent="navigateTo('/demande_pc')">Demande PC</a>
          </li>
          <li :class="isActive('/actions')">
            <a href="#" @click.prevent="navigateTo('/actions')">Actions</a>
          </li>
          <li>
            <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Audits</a>
          </li>
          <li :class="isActive('/service-envoyeur')">
            <a href="#" @click.prevent="navigateTo('/service-envoyeur')">Stats envoye</a>
          </li>
          <li :class="isActive('/service-categorie')">
            <a href="#" @click.prevent="navigateTo('/service-categorie')">Stats Categorie</a>
          </li>
        </ul>
        <div class="footer">
          <p>
            Copyright &copy;
            <script>document.write(new Date().getFullYear());
          </p>
        </div>
      </div>
    </nav>
  `
        }
    </script>

    <script>
        const app = Vue.createApp({})
        app.component('sidebar', Sidebar)
        app.mount('#app')
    </script>

</body>

</html>
