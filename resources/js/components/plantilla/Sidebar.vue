<template>
<div>
    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <router-link :to="'/'" class="brand-link text-decoration-none">
            <!-- <a href="index3.html" class="brand-link text-decoration-none"> -->
            <img :src="ruta+'/dist/img/AdminLTELogo.png'" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light ">Administrador</span>
        </router-link>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img :src="ruta+'/dist/img/user2-160x160.jpg'" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <!-- <a href="#" class="d-block text-decoration-none">{{usuario.fullname}}</a> -->
                    <router-link :to="{name:'Editar usuario',params:{id:usuario.id }}" class="d-block text-decoration-none">{{usuario.fullname}}</router-link>
                </div>
            </div>
            <!-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">

                <div class="info">

                    <a href="#" class="d-block text-decoration-none" @click="logout">

                        <i class="fas fa-sign-out-alt"></i> Cerrar session
                    </a>
                </div>
            </div> -->

            <!-- SidebarSearch Form -->
            <div class="form-inline">
                <div class="input-group" data-widget="sidebar-search">
                    <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-sidebar">
                            <i class="fas fa-search fa-fw"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                    <li class="nav-item">
                        <router-link :to="'/'" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </router-link>

                        <!-- <a href="pages/widgets.html" class="nav-link">
                            <i class="nav-icon fas fa-th"></i>
                            <p>
                                Dashboard
                                <span class="right badge badge-danger">New</span>
                            </p>
                        </a> -->
                    </li>

                    <!-- <li class="nav-header">Trámite documentario</li>
                    <li class="nav-item">
                        <router-link :to="'/Tramites/Nuevotramite'" class="nav-link">
                            <i class="fa-regular fa-file nav-icon"></i>
                            <p>Nuevo trámite</p>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link :to="'/Tramites/Enproceso'" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Despacho</p>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link :to="'/Tramites/Porrecibir'" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Recepción</p>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link :to="'/Tramites/Archivados'" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Archivados</p>
                        </router-link>
                    </li> -->

                    <li class="nav-header">Modulo Cobranzas</li>
                    <li class="nav-item">
                        <router-link :to="'/cobranzas/index'" class="nav-link">
                            <i class="fa-regular fa-file nav-icon"></i>
                            <p>Cobranzas</p>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link :to="'/cobranzas/formatos'" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Formatos</p>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link :to="'/cobranzas/conceptos'" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Conceptos</p>
                        </router-link>
                    </li>
                    
                    

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-search"></i>
                            <p>
                                Administración
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <router-link :to="'/Administracion/entidaexterna'" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Entidades externas</p>
                                </router-link>
                            </li>
                            <li class="nav-item">
                                <router-link :to="'/Administracion/unidadorganica'" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Unidades orgánicas</p>
                                </router-link>
                            </li>
                            <li class="nav-item">
                                <router-link :to="'/Administracion/unidaddependencia'" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Unidades x Dependencia</p>
                                </router-link>
                            </li>
                            <li class="nav-item">
                                <router-link :to="'/Administracion/dependencia'" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Dependencia</p>
                                </router-link>
                            </li>
                            <li class="nav-item">
                                <router-link :to="'/Administracion/docucorrelativo'" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Documento correlativo</p>
                                </router-link>
                            </li>
                            <li class="nav-item">
                                <router-link :to="'/Administracion/usuarios'" class="nav-link">
                                    <i class="fa-regular fa-circle-user nav-icon"></i>
                                    <p>Usuarios</p>
                                </router-link>
                            </li>
                        </ul>
                    </li>

                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>
</div>
</template>

<script>
import axios from 'axios'
export default {
    name: 'StdvSidebar',
    props: ['ruta', 'usuario'],

    data() {
        return {

        };
    },

    mounted() {

    },

    methods: {

    },
};
</script>

<style lang="scss" scoped>

</style>
