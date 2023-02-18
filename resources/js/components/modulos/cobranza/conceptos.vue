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
                                    <el-select v-model="id_clasificador" filterable placeholder="Seleccione el clasificador" size="small" style="width: 100%;">
                                        <!-- <select class="form-control form-control-sm" v-model="idconceptos" @change="datosconceptoxitem"> -->
                                        <el-option v-for="con in listaclasificador" :key="con.idclasificador" :label="con.codigoclasificador+' - '+con.text_clasificador" :value="con.idclasificador" required>
                                        </el-option>

                                        <!-- <option v-for="con in listaconceptos" :value="con.idconceptocobranza">{{ con.text_concepto }} ({{ con.nomto_concepto }})</option> -->
                                    </el-select>
                                </div>
                                <div class="form-group">
                                    <label for="">Ingresar Concepto</label>
                                    <input type="text" name="" id="" class="form-control form-control-sm text-uppercase" v-model="formconcepto" required>
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
                                        <th>Clasificador</th>
                                        <th>Concepto</th>
                                        <th>Monto concepto</th>
                                        <th>Estado</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="lis in listaconceptos">
                                        <td>{{ lis.idconceptocobranza }}</td>
                                        <td>{{ lis.codigoclasificador }} - {{ lis.text_clasificador }}</td>
                                        <td>{{ lis.text_concepto }}</td>
                                        <td>{{ lis.nomto_concepto }}</td>
                                        <td v-if="lis.estado_concepto==1" class="text-center text-success">
                                            <i class="fa-solid fa-toggle-on"></i>
                                        </td>
                                        <td v-else class="text-center text-danger"><i class="fa-solid fa-toggle-off"></i></td>
                                        <td>
                                            <button class="btn btn-primary btn-sm" @click.prevent="abrir(lis.idconceptocobranza,lis.codclasificador,lis.text_concepto,lis.nomto_concepto)"> <i class="fa fa-edit"></i> </button>
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
    <!-- Modal -->
    <div class="modal fade" id="editconcepto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar concepto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form @submit.prevent="guardarUPconcepto">
                    <div class="modal-body">

                        <div class="form-group">
                            <el-select v-model="formupdate.idclasificador" filterable placeholder="Seleccione el clasificador" size="small" style="width: 100%;">
                                <!-- <select class="form-control form-control-sm" v-model="idconceptos" @change="datosconceptoxitem"> -->
                                <el-option v-for="con in listaclasificador" :key="con.idclasificador" :label="con.codigoclasificador+' - '+con.text_clasificador" :value="con.idclasificador" required>
                                </el-option>

                                <!-- <option v-for="con in listaconceptos" :value="con.idconceptocobranza">{{ con.text_concepto }} ({{ con.nomto_concepto }})</option> -->
                            </el-select>
                        </div>
                        <div class="form-group">
                            <label for="">Ingresar Concepto</label>
                            <input type="text" name="" id="" class="form-control form-control-sm text-uppercase" v-model="formupdate.textconcepto" required>
                        </div>
                        <div class="form-group">
                            <label for="">Ingresar monto</label>
                            <input type="nomber" name="" id="" class="form-control form-control-sm" v-model="formupdate.montoup" required>
                        </div>
                        
                    </div>
                    <div class="modal-footer">

                        <button type="submit" class="btn btn-sm btn-primary">Actualizar</button>
                    </div>
                </form>
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
            listaclasificador: [],
            formconcepto: '',
            monto: 0,
            id_clasificador: '',
            formupdate: {
                idclasificador: '',
                idconcepto: '',
                textconcepto: '',
                montoup: 0,
            }
        };
    },

    mounted() {
        this.alllistaconceptos();
        this.alllistaClasificadors();
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
        alllistaClasificadors() {
            var url = '/clasificador';
            axios.get(url)
                .then(response => {
                    this.listaclasificador = response.data;
                });
        },
        guardarconcepto() {
            var url = '/nuevoconcepto';

            if (this.id_clasificador != '') {
                axios.post(url, {
                        'concepto': this.formconcepto,
                        'clasificador': this.id_clasificador,
                        'monto': this.monto
                    })
                    .then(response => {
                        console.log(response.data);
                        this.toast('Fue agregado el nuevo concepto', 'success');
                        this.alllistaconceptos();
                    });
            } else {
                alert('Faltó seleccionar el clasificador')
                this.toast('No Fue agregado el nuevo concepto', 'error');
            }
        },
        abrir(idconcep, idclasi, texcon, mont) {
            $('#editconcepto').modal({
                backdrop: 'static',
                keyboard: false
            });
            this.formupdate.idconcepto = idconcep
            this.formupdate.idclasificador = idclasi
            this.formupdate.textconcepto = texcon
            this.formupdate.montoup = mont
        },
        guardarUPconcepto(){
            var url='/updateconcepto'
            var up={
                'idconcepto':this.formupdate.idconcepto,
                'idclasificador':this.formupdate.idclasificador,
                'textconcepto':this.formupdate.textconcepto,
                'montoup':this.formupdate.montoup
            }
            axios.post(url,up)
            .then(response=>{
                this.toast('Fue Actualizado el nuevo concepto', 'info');
                        this.alllistaconceptos();
            })
        }

    },
};
</script>

<style lang="scss" scoped>

    </style>
