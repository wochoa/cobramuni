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
            <!-- <div class="row mt-10">
                        <div class="col-lg-6 col-10">
                            <router-link :to="'/Tramites/Enproceso'" class="btn btn-info btn-sm"><i class="fa-regular fa-circle-left"></i>Volver a documentos en proceso</router-link>
                        </div>

                    </div> -->

            <div class="row mt-2">

                <div class="col-sm-4">
                    <div class="card card-primary card-outline card-revenue-budget">
                        <div class="card-header">
                            <h4> Agregar formatos</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="">Ingresar formato</label>
                                <input type="text" name="" id="" class="form-control form-control-sm">
                            </div>
                            <div class="form-gruop">
                                <button class="btn btn-sm btn-primary">Agregar</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="card card-primary card-outline card-revenue-budget">
                        <div class="card-header">
                            <h4> Listado de formatos</h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-hover table-sm">
                                <thead>
                                    <tr>
                                        <th>N°</th>
                                        <th>Concepto</th>
                                        <th>Monto concepto</th>
                                        <th>Estado</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="lis in listaconceptos">
                                        <td>{{ lis.idconceptocobranza }}</td>
                                        <td>{{ lis.text_concepto }}</td>
                                        <td>{{ lis.nomto_concepto }}</td>
                                        <td v-if="lis.estado_concepto==1" class="text-center text-success">
                                            <i class="fa-solid fa-toggle-on"></i>
                                        </td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
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
    name: 'formatos',

    data() {
        return {
            listaconceptos: [],
        };
    },

    mounted() {
        this.alllistaconceptos();
    },

    methods: {
        alllistaconceptos() {
            var url = '/conceptocobranzas';
            axios.get(url)
                .then(response => {
                    this.listaconceptos = response.data;
                });
        }

    },
};
</script>

    
<style lang="scss" scoped>

    </style>
