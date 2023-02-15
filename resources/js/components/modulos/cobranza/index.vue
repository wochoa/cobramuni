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
    
                                   <table class="table table-bordered table-sm table-hover">
                                    <thead>
                                        <tr>
                                            <th>ITEM</th>
                                            <th>RECIBO CAJA</th>
                                            <th>FECHA DE EMISION</th>
                                            <th>DNI/RUC</th>
                                            <th>NOMBRE O RAZON SOCIAL</th>
                                            <th>TOTAL</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(item, index) in listacobranza" :key="item.idcobrazas">
                                            <td>{{ index+1}}</td>
                                            <td>{{ item.codigorecibo}}</td>
                                            <td>{{ item.fechaemision}}</td>
                                            <td v-if="item.ruc=='null'">{{ item.dni}}</td>
                                            <td v-else>{{ item.ruc}}</td>
                                            <td>{{ item.nom_razonsocial}}</td>
                                            <td>{{ item.montonumero}}</td>
                                            <td>
                                                <router-link :to="'/'" class="btn btn-outline-primary btn-sm"> <i class="fa fa-edit"></i> </router-link>
                                                <router-link class="btn btn-outline-danger btn-sm" :to="'/imprimecobranza/'+item.idcobrazas" target="_blank"> <i class="fa fa-print"></i> </router-link>
                                            </td>
                                        </tr>
                                    </tbody>
                                   </table>
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
            listacobranza:[],

            
        };
    },

    mounted() {
        this.cargalistacobra();
    },

    methods: {
        cargalistacobra(){
            var url='/listacobranza';
            axios.get(url)
            .then(response=>{
                this.listacobranza=response.data
            });
        }
    },
};
</script>

<style lang="scss" scoped>

</style>