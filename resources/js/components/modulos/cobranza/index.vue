<template>
    <div>
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{ $route.name }}</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <router-link :to="'/'">Dashboard</router-link>
                            </li>
                            <li class="breadcrumb-item active">{{ $route.name }}</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <div class="content">
            <div class="container-fluid">
                <div class="row mt-10">
                    <div class="col-lg-6 col-10">
                        <router-link :to="'/cobranzas/nuevo'" class="btn btn-primary btn-sm"><i class="fa-regular fa-file"></i> Nueva cobranza</router-link>
                    </div>
    
                </div>
    
                <div class="row mt-2">
    
                    <div class="col-12">
                        <div class="card card-primary card-outline card-revenue-budget">
    
                            <div class="card-body">
    
                                <div class="row">
    
                                   ....
                                </div>
    
                            </div>
    
                        </div>
                    </div>
    
                </div>
            </div>
    
            <!-- RESULTADO DE LA CREACION DE Documento -->
            <div id="resultadodoc" class="modal-dialog" style="max-width:350px !important; display: none">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="modal-title">
                            <i class="glyphicon glyphicon-menu-right"></i>&#160;&#160; ReFirma Invoker
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="row" style="display: inherit;">
                            <div class="col-sm-12 text-center">
                                <br />
    
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 text-center">
                                <br />
                                <div id="status">ss</div>
                                <br />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    
            <!-- <docu-invoker ref="foo" :iframe="iframe" :route-invoker-get="routeInvokerGet" :route-invoker-post="routeInvokerPost" :ruta="ruta" @firmado="firmado" /> -->
    
        </div>
    </div>
    </template>

<script>
export default {
    name: 'Cobranzas',

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