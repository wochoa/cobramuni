<template>
<div>
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light dropdown-legacy text-sm">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <router-link :to="'/'" class="nav-link">Inicio</router-link>
            </li>
            <!-- <li class="nav-item d-none d-sm-inline-block">
                <router-link :to="'/'" class="nav-link">Buscar Documento</router-link>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <router-link :to="'/'" class="nav-link">Reportes</router-link>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <router-link :to="'/'" class="nav-link">Archivadores</router-link>
            </li> -->
            
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <!-- Navbar Search -->
            <!-- <li class="nav-item">
                <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                    <i class="fas fa-search"></i>
                </a>
                <div class="navbar-search-block">
                    <form class="form-inline">
                        <div class="input-group input-group-sm row">
                            <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                            <div class="input-group-append">
                                <button class="btn btn-navbar" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </li> -->

            
            <!-- Notifications Dropdown Menu -->
            <!-- <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#" >
                    <i class="far fa-bell"></i>
                    <span class="badge badge-warning navbar-badge">15</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" >
                    <span class="dropdown-item dropdown-header">15 Notifications</span>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-envelope mr-2"></i> 4 new messages
                        <span class="float-right text-muted text-sm">3 mins</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-users mr-2"></i> 8 friend requests
                        <span class="float-right text-muted text-sm">12 hours</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-file mr-2"></i> 3 new reports
                        <span class="float-right text-muted text-sm">2 days</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                </div>
            </li> -->
            <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                    <i class="fas fa-expand-arrows-alt"></i>
                </a>
            </li>
            <li class="nav-item" v-if="mode==0">
                <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button" @click="cambiomodooscuro">
                    <i class="fa-regular fa-moon"></i>
                </a>
            </li>
            <li class="nav-item" v-else>
                <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button" @click="cambiomodoclaro">
                    <i class="fa-solid fa-moon"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link"  href="#" role="button" @click.prevent="cerrar">
                    <i class="fas fa-sign-out-alt"></i>
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->
</div>
</template>

<script>
    import $ from 'jquery';
    import swal from 'sweetalert2';
window.Swal = swal;

export default {
    name: 'StdvNavbar',
    props: ['ruta', 'usuario'],

    data() {
        return {
            mode: 0, // 0 modo light 1:modo moon
            capturadato: null,
        }
    },
    methods: {
        cambiomodooscuro() {
            this.mode = 1;
            document.body.classList.add('dark-mode'); //bg-gray
            //document.nav.classList.add('bg-gray');
            $(".main-header").addClass("bg-gray");
        },
        cambiomodoclaro() {
            this.mode = 0;
            document.body.classList.remove('dark-mode'); //bg-gray
            //document.nav.classList.add('bg-gray');
            $(".main-header").removeClass("bg-gray");
        },
        cerrar()
        {
            // Swal.fire('Test!', 'Hello test message','success');
            Swal.fire({
                    title: "Está a punto de cerrar sesión?",
                    text: "Si cierras la sesión, no podrás continuar el la plataforma",
                    type: "danger",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Cerrar sesión",
                    closeOnConfirm: false
                    })
                    .then((result) => {
                                            if (result.isConfirmed) {
                                            Swal.fire('Sesión finalizado', 'Usted está saliendo de la plataforma', 'success')
                                                var url = '/logout';
                                                axios.post(url).then(response => {
                                                    location.reload();
                                                });

                                            } else {
                                            Swal.fire('Sesión cancelado', 'Usted continúa en la plataforma', 'error')
                                            }
                                        });
        }
    }
};
</script>

<style lang="scss" scoped>

</style>
