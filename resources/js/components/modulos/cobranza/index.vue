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
                    <router-link :to="'/cobranzas/nuevo'" class="btn btn-info btn-sm"><i class="fa-regular fa-file"></i> Nueva cobranza</router-link>
                </div>

            </div>

            <div class="row mt-2">

                <div class="col-12">
                    <div class="card card-primary card-outline card-revenue-budget">

                        <div class="card-body">
                            <div class="form-group row">

                                <label for="" class="col.sm-2">Código recibo</label>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control form-control-sm" v-model="codrecibo" @keypress.enter="buscar">

                                </div>
                                <div class="col-sm-2 ">
                                    <button class="btn btn-primary btn-sm" @click.prevent="buscar"><i class="fa fa-search"></i> Buscar</button>
                                </div>

                            </div>

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
                                            <th>ANULAR</th>
                                            <th></th>
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
                                            <td v-if="item.anular==0" align="right"><del>{{ item.montonumero}}</del></td>
                                            <td v-else align="right">{{ item.montonumero}}</td>
                                            <td v-if="item.anular==1" class="text-center text-success">
                                                <a href="#" @click="anularcobranza(item.idcobrazas,0)"><i class="fa-solid fa-toggle-on"></i></a>
                                            </td>
                                            <td v-else class="text-center text-danger">
                                                <a href="#" @click="anularcobranza(item.idcobrazas,1)"><i class="fa-solid fa-toggle-off"></i></a>
                                            </td>
                                            <td>
                                                <router-link :to="{name:'Editar cobranzas', params:{id: item.idcobrazas} }" class="btn btn-outline-primary btn-sm"> <i class="fa fa-edit"></i> </router-link>
                                                <router-link class="btn btn-outline-danger btn-sm" :to="'/imprimecobranza/'+item.idcobrazas" target="_blank"> <i class="fa fa-print"></i> </router-link>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="5" align="right"><b>MONTO (S/.):</b></td>
                                            <td nowrap align="right"><b>{{ sumPrecios(listobjet.data).toFixed(2) }}</b></td>
                                        </tr>
                                    </tfoot>
                                </table>
                                <pagination :data="listobjet" :limit="3" @pagination-change-page="cargalistacobra" />
                            </div>
                            <!-- <div class="row border-top pt-2">
                                <div class="col-sm-2"><b>MONTO TOTAL(S/.):</b></div>
                                <div class="col-sm-2">{{ sumPrecios(listobjet.data).toFixed(2) }}</div>
                            </div> -->

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
    name: 'Cobranzas',

    data() {
        return {

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
            codrecibo: ''

        };
    },
    components: {
        'Pagination': LaravelVuePagination,
    },

    mounted() {
        this.cargalistacobra();
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
        sumPrecios(items) {
            return items.reduce((a, b) => {
                return a + Number(b['montonumero']);
            }, 0);
        },
        buscar() {
            //this.limpiaformulario()
            var url = '/buscarcobranza'
            axios.post(url, {
                    'codrecibo': this.codrecibo,
                })
                .then(response => {
                    this.listobjet = response.data
                })
        },
        limpiaformulario() {
            listobjet = {
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
            }
        },
        anularcobranza(idcobra, anul) {
            var url = '/anular'
            axios.post(url, {
                    'idcobranza': idcobra,
                    'codanul': anul
                })
                .then(response => {
                    console.log(response.data)
                    this.toast('Fue Actualizado el nuevo concepto', 'info');
                    // this.limpiaformulario();
                    this.cargalistacobra();

                })
        }
    },
};
</script>

<style lang="scss" scoped>

</style>
