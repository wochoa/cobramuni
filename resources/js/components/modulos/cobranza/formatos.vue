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
                            <form @submit.prevent="guardafromato">
                                <div class="form-group">
                                    <label for="">Ingresar formato</label>
                                    <input type="text" name="" id="" class="form-control form-control-sm" v-model="formato">
                                </div>
                                <div class="form-group">
                                    <label for="">Ingresar numeración</label>
                                    <input type="number" name="" id="" class="form-control form-control-sm" v-model="numeracion">
                                    <small>colocar como 1 ó 2 y sucesivamente</small>
                                </div>
                                <div class="form-gruop">
                                    <button class="btn btn-sm btn-primary">Agregar</button>
                                </div>
                            </form>
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
                                        <th>FORMATO</th>
                                        <th>NUMERACION</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="lis in listaformatos">
                                        <td>{{ lis.idformato }}</td>
                                        <td>{{ lis.nomformato }}</td>
                                        <td>{{ zfill(lis.numeracion,6) }}</td>
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
import Swal from 'sweetalert2';
window.$ = window.jQuery = require('jquery')

const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    onOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        //toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
});
export default {
    name: 'formatos',

    data() {
        return {
            listaformatos: [],
            formato: '',
            numeracion:''
        };
    },

    mounted() {
        this.allformatos();
    },

    methods: {
        toast(texto_anuncio, icono) {

            Toast.fire({
                // title:texto_titulo,
                title: '<small><strong>' + texto_anuncio + '</strong></small>',
                icon: icono,
                // text: texto_anuncio
            });
        },

        guardafromato() {
            var url='/nuevoformato'
            axios.post(url,{'formato':this.formato,'numeracion':this.numeracion})
            .then(response=>{
                // console.log(response.data);
                this.toast('Fue agregado el nuevo formato', 'success');
                this.allformatos();
            })
        },

        allformatos() {
            var url = '/listaformatos';
            axios.get(url)
                .then(response => {
                    this.listaformatos = response.data;
                });
        },
        zfill(number, width) {
            var numberOutput = Math.abs(number); /* Valor absoluto del número */
            var length = number.toString().length; /* Largo del número */
            var zero = "0"; /* String de cero */

            if (width <= length) {
                if (number < 0) {
                    return ("-" + numberOutput.toString());
                } else {
                    return numberOutput.toString();
                }
            } else {
                if (number < 0) {
                    return ("-" + (zero.repeat(width - length)) + numberOutput.toString());
                } else {
                    return ((zero.repeat(width - length)) + numberOutput.toString());
                }
            }
        },

    },
};
</script>

<style lang="scss" scoped>

</style>
