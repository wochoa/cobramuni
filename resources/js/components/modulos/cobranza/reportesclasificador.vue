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

            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-3">
                                <label for="">Recibo</label>
                                <input type="text" class="form-control form-control-sm" v-model="codigoRecibo">
                            </div>
                            <div class="col-sm-3">
                                <label for="">FECHA</label>
                                <input type="date" class="form-control form-control-sm" v-model="fechacobranza">
                            </div>
                            <div class="col-sm-3">
                                <label for="">Clasificador</label>
                                <el-select v-model="idclasificador" filterable placeholder="Seleccione el clasificador" size="small" style="width: 100%;">
                                    <!-- <select class="form-control form-control-sm" v-model="idconceptos" @change="datosconceptoxitem"> -->
                                    <el-option v-for="con in listaClasificadors" :key="con.idclasificador" :label="con.codigoclasificador+' - '+con.text_clasificador" :value="con.idclasificador" required>
                                    </el-option>

                                    <!-- <option v-for="con in listaconceptos" :value="con.idconceptocobranza">{{ con.text_concepto }} ({{ con.nomto_concepto }})</option> -->
                                </el-select>
                            </div>
                            <div class="col-sm-3">
                                <button class="btn btn-info btn-sm mt-4">Buscar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-2">

                <div class="col-sm-12">
                    <div class="card card-primary card-outline card-revenue-budget">
                        <div class="card-header">
                            <h4> Reportes</h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-sm table-hover">
                                <thead>
                                    <tr>
                                        <th>ITEM</th>
                                        <th>RECIBO CAJA</th>
                                        <th>FECHA DE EMISION</th>
                                        <th>DNI/RUC</th>
                                        <th>NOMBRE O RAZON SOCIAL</th>
                                        <th>TOTAL</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(item, index) in listobjet.data" :key="item.idcobrazas">
                                        <td>{{ item.idcobrazas}}</td>
                                        <td>{{ item.codigorecibo}}</td>
                                        <!-- <td v-if="item.idformato==1"><small class="badge badge-success"><i class="far fa-clock"></i> {{ item.nomformato}}</small> <br> {{ item.codigorecibo}}</td>
                                            <td v-else><small class="badge badge-info"><i class="far fa-clock"></i> {{ item.nomformato}}</small> <br> {{ item.codigorecibo}}</td> -->
                                        <td>{{ item.fechaemision}}</td>
                                        <td v-if="item.ruc=='null'">{{ item.dni}}</td>
                                        <td v-else>{{ item.ruc}}</td>
                                        <td>{{ item.nom_razonsocial}}</td>
                                        <td>{{ item.montonumero}}</td>
                                        
                                    </tr>
                                </tbody>
                            </table>
                            <pagination :data="listobjet" :limit="3" @pagination-change-page="cargalistacobra" />
                        </div>
                    </div>
                </div>

            </div>
        </div>



    </div>
</div>
</template>

<script>
import LaravelVuePagination from 'laravel-vue-pagination'
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
            listaClasificadors: [],
            idclasificador: '',
            fechacobranza: '',
            codigoRecibo: '',

            listobjet: {
                current_page: null,
                data: [],
                from: null,
                last_page: null,
                next_page_url: null,
                path: null,
                per_page: null,
                prev_page_url: null,
                to: null,
                total: null
            },

        };
    },

    components: {
        'Pagination': LaravelVuePagination,
    },

    mounted() {
        this.alllistaClasificadors();
        this.fechasistema();
        // this.allformatos();
        this.cargalistacobra()
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
        cargalistacobra(Page = 1) {
            var url = '/listacobranza/?page=' + Page; //?page=' + page
            axios.get(url)
                .then(response => {

                    this.listobjet = response.data
                });
        },
        alllistaClasificadors() {
            var url = '/clasificador';
            axios.get(url)
                .then(response => {
                    this.listaClasificadors = response.data;
                });
        },
        fechasistema() {
            const hoy = new Date();
            this.fechacobranza = hoy.toISOString().substring(0, 10); // year + '-' + mesdo + '-' + diado;
            //alert(this.formdocumentos.fechatramite)
        },

        zfill(number, width) {
            var numberOutput = Math.abs(number); /* Valor absoluto del n??mero */
            var length = number.toString().length; /* Largo del n??mero */
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
