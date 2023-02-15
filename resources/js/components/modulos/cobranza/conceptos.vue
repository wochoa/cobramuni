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
                            <h4> Agregar Concepto</h4>
                        </div>
                        <div class="card-body">
                            <form @submit.prevent="guardarconcepto">
                                <div class="form-group">
                                    <label for="">Ingresar Concepto</label>
                                    <input type="text" name="" id="" class="form-control form-control-sm text-uppercase" v-model="formconcepto" required >
                                </div>
                                <div class="form-group">
                                    <label for="">Ingresar monto</label>
                                    <input type="nomber" name="" id="" class="form-control form-control-sm" v-model="monto" required>
                                </div>
                                <div class="form-gruop">
                                    <button type="submit" class="btn btn-sm btn-primary">Agregar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="card card-primary card-outline card-revenue-budget">
                        <div class="card-header">
                            <h4> Listado de Concepto</h4>
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
            listaconceptos: [],
            formconcepto: '',
            monto: 0
        };
    },

    mounted() {
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
        alllistaconceptos() {
            var url = '/conceptocobranzas';
            axios.get(url)
                .then(response => {
                    this.listaconceptos = response.data;
                });
        },
        guardarconcepto() {
            var url = '/nuevoconcepto';

            axios.post(url, {
                    'concepto': this.formconcepto,
                    'monto': this.monto
                })
                .then(response => {
                    // console.log(response.data);
                    this.toast('Fue agregado el nuevo concepto', 'success');
                    this.alllistaconceptos();
                });
        }

    },
};
</script>

<style lang="scss" scoped>

    </style>
