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
                    <router-link :to="'/cobranzas/index'" class="btn btn-info btn-sm"><i class="fa-regular fa-circle-left"></i>Volver a cobranza</router-link>
                </div>

            </div>

            <div class="row mt-2">

                <div class="col-12">
                    <div class="card card-primary card-outline card-revenue-budget">

                        <div class="card-body">

                            <div class="row">

                                <div class="col-md-4 border-right">

                                    <div class="form-group row">
                                        <label for="" class="col-sm-4">RECIBO CAJA N°</label>
                                        <div class="col-sm-8">
                                            <input type="text" placeholder="2022-007454" class="form-control form-control-sm" v-model="codenumeracion" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="" class="col-sm-4">FECHA DE EMISION:</label>
                                        <div class="col-sm-8">
                                            <input type="date" placeholder="2022-007454" class="form-control form-control-sm" v-model="fechacobranza" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="" class="col-sm-4">RUC/DNI:</label>
                                        <div class="col-sm-6">
                                            <input type="number" placeholder="Nro doc" class="form-control form-control-sm" v-model="nrodocumento" readonly>
                                        </div>
                                        <!-- <div class="col-sm-2">
                                                <button type="button" class="btn btn-primary btn-sm" @click.prevent="consultadoc"><i class="fa fa-search"></i></button>
                                            </div> -->
                                    </div>
                                    <div class="form-group">
                                        <label for="">NOMBRE O RAZON SOCIAL:</label>
                                        <input type="text" placeholder="Nombre o razon social" v-model="nombreorazon" class="form-control form-control-sm text-uppercase" readonly>

                                    </div>
                                </div>

                                <div class="col-md-8">

                                    <div class="form-group row pl-2">
                                        <table id="tabla" class="table table-bordered table-hover table-sm">
                                            <thead>
                                                <tr class="bg-info disabled color-palette">
                                                    <th><small>N</small></th>
                                                    <th><small>CONCEPTO</small></th>
                                                    <th><small>IMPORTE</small></th>

                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="(der, index) in datodetalle">

                                                    <td><small>{{ index+1}}</small></td>
                                                    <td><small>{{ der.concepto }}</small></td>
                                                    <td align="right"><small>{{ der.monto }}</small></td>

                                                    <td>
                                                        <!-- <button class="btn btn-default btn-sm" ><i class="fa-solid fa-trash-can"></i></button> -->
                                                        <button class="btn btn-default btn-sm" @click="actualizardetalle(der.iddetalle_cobra,der.concepto,der.monto,der.idconcep)"><i class="fa-solid fa-edit"></i></button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="2" align="right"><b>TOTAL S/.</b></td>
                                                    <td align="right"><b>{{ sumPrecios(datodetalle).toFixed(2) }}</b></td>
                                                    <td></td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                    <div class="gorup row">
                                        <div class="col-sm-12">
                                            <!-- <strong>Suma:</strong> {{ sumPrecios(array_concepto).toFixed(2) }} -->
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>

                    </div>
                </div>

            </div>
        </div>

        <!-- RESULTADO DE LA CREACION DE Documento -->
        <!-- Modal -->
        <div class="modal fade" id="detalle" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Editar detalle</h5>

                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Elejir concepto</label>
                            <el-select v-model="form_up.idconcep" filterable placeholder="Seleccione el concepto" size="small" style="width: 100%;">
                                <!-- <select class="form-control form-control-sm" v-model="idconceptos" @change="datosconceptoxitem"> -->
                                <el-option v-for="con in listaconceptos" :key="con.idconceptocobranza" v-if="con.estado_concepto==1" :label="con.text_concepto" :value="con.idconceptocobranza">
                                </el-option>
                            </el-select>

                        </div>
                        <div class="form-group">
                            <label for="">Concepto</label>
                            <input type="text" v-model="form_up.textconcepto" class="form-control form-control-sm" readonly>
                        </div>
                        <div class="form-group">
                            <label for="">Concepto</label>
                            <input type="text" v-model="form_up.importe" class="form-control form-control-sm" readonly>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" @click.prevent="guardaractualizado"><i class="fa-regular fa-file"></i> Actualizar</button>
                        <!-- <a class="btn btn-outline-danger" :href="'/imprimecobranza/'+idcobranza" target="_blank"> <i class="fa-regular fa-file-pdf fa-2x"></i><br>Imprimir</a> -->
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
</template>

<script>
import axios from 'axios';
import LaravelVuePagination from 'laravel-vue-pagination'

import Swal from 'sweetalert2';
// window.$ = window.jQuery = require('jquery')

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
    name: 'Cobranzas',

    data() {
        return {

            idcobra: this.$route.params.id, // to.params.id;
            codenumeracion: null,
            fechacobranza: null,
            nrodocumento: '',
            nombreorazon: '',
            monto_total: '',
            texto_monto: '',
            listaconceptos: [],
            form_up: {
                textconcepto: '',
                importe: '',
                iddetalle: '',
                idconcep: ''
            },

            datocobranzas: [],
            datodetalle: [],

        };
    },
    components: {
        'Pagination': LaravelVuePagination,
    },

    mounted() {

        this.fechasistema();
        this.buscarcobranza();
        this.alllistaconceptos();
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
        buscarcobranza() {
            var url = '/buscarcobranzaid/' + this.idcobra;
            axios.get(url)
                .then(response => {
                    console.log(response.data)
                    this.datocobranzas = response.data.dat_cobra[0],
                        this.codenumeracion = this.datocobranzas.codigorecibo
                    this.fechacobranza = this.datocobranzas.fechaemision
                    this.nrodocumento = this.datocobranzas.dni ? this.datocobranzas.dni : this.datocobranzas.ruc
                    this.nombreorazon = this.datocobranzas.nom_razonsocial
                    this.monto_total = this.datocobranzas.montonumero
                    this.texto_monto = this.datocobranzas.montotexto

                    this.datodetalle = response.data.det_cobra
                })
        },
        alllistaconceptos() {
            var url = '/conceptocobranzas';
            axios.get(url)
                .then(response => {
                    this.listaconceptos = response.data;
                });
        },

        sumPrecios(items) {
            return items.reduce((a, b) => {
                return a + Number(b['monto']);
            }, 0);
        },

        fechasistema() {
            const hoy = new Date();
            // const year = hoy.getFullYear();
            // const mes = hoy.getMonth();
            // const dia = hoy.getDate();

            // var mesdo = mes < 10 ? "0" + mes : mes;
            // var diado = dia < 10 ? "0" + dia : dia;
            this.anioactual = hoy.getFullYear();

            this.fechacobranza = hoy.toISOString().substring(0, 10); // year + '-' + mesdo + '-' + diado;
            //alert(this.formdocumentos.fechatramite)
        },
        actualizardetalle(iddetalle, concepto, monto, idconcepto) {
            $('#detalle').modal({
                backdrop: 'static',
                keyboard: false
            })

            this.form_up.textconcepto = concepto
            this.form_up.importe = monto
            this.form_up.iddetalle = iddetalle
            this.form_up.idconcep = idconcepto

            //this.datoconceptoid();
        },
        // datoconceptoid(idconcepto) {
        //     var url = ''
        // },
        guardaractualizado() {
            var url = '/update-detalleconcepto'
            axios.post(url, {
                    'iddetalle': this.form_up.iddetalle,
                    'idconcepto': this.form_up.idconcep
                })
                .then(response => {
                    console.log(response.data);
                    this.cerrarmodal();
                    
                   
                })
        },
        cerrarmodal()
        {
            location.reload();
            this.toast('Fue generado la cobranza exitosamente', 'success');
            //$('#detalle').modal("hide");
        }

    },
};
</script>

<style lang="scss" scoped>

</style>
