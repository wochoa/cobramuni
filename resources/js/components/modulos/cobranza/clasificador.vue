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
                            <h4> Agregar Clasificador</h4>
                        </div>
                        <div class="card-body">
                            <form @submit.prevent="guardarClasificador">
                                <el-select v-model="id_formato" filterable placeholder="Seleccione el Formato" size="small" style="width: 100%;">
                                    <!-- <select class="form-control form-control-sm" v-model="idconceptos" @change="datosconceptoxitem"> -->
                                    <el-option v-for="con in listaformatos" :key="con.idformato" :label="con.nomformato" :value="con.idformato" required>
                                    </el-option>

                                    <!-- <option v-for="con in listaconceptos" :value="con.idconceptocobranza">{{ con.text_concepto }} ({{ con.nomto_concepto }})</option> -->
                                </el-select>

                                <div class="form-group">
                                    <label for="">Ingresar código</label>
                                    <input type="nomber" name="" id="" class="form-control form-control-sm" v-model="codigo" required autofocus>
                                </div>
                                <div class="form-group">
                                    <label for="">Ingresar Clasificador</label>
                                    <input type="text" name="" id="" class="form-control form-control-sm text-uppercase" v-model="formClasificador" required>
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
                            <h4> Listado de Clasificador</h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-hover table-sm">
                                <thead>
                                    <tr>
                                        <th>N°</th>
                                        <th>Código Clasificador</th>
                                        <th>Clasificador</th>
                                        <th>Estado</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="lis in listaClasificadors">
                                        <td>{{ lis.idclasificador }}</td>
                                        <td>{{ lis.codigoclasificador }}</td>
                                        <td>{{ lis.text_clasificador }}</td>
                                        <td v-if="lis.estado_cla==1" class="text-center text-success">
                                            <a @click="cambiaestado(lis.idclasificador,0)"><i class="fa-solid fa-toggle-on"></i></a>
                                        </td>
                                        <td v-else class="text-center text-danger">
                                            <a @click="cambiaestado(lis.idclasificador,1)"><i class="fa-solid fa-toggle-off"></i></a>
                                        </td>
                                        <td>
                                            <button class="btn btn-primary btn-sm" @click.prevent="abrir(lis.idclasificador,lis.text_clasificador,lis.codigoclasificador)"> <i class="fa fa-edit"></i> </button>
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
    <div class="modal fade" id="editclasificador" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar clasificador</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form @submit.prevent="guardarUPclasificador">
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="">código</label>
                            <input type="text" class="form-control form-control-sm text-uppercase" v-model="formupdate.codigo" required>
                        </div>
                        <div class="form-group">
                            <label for="">Nombre Clasificador</label>
                            <input type="text" class="form-control form-control-sm" v-model="formupdate.textclasificador" required>
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
            listaClasificadors: [],
            id_formato:'',
            listaformatos: [],
            idformatos:'',
            formClasificador: '',
            codigo: '',
            formupdate: {
                idcla: '',
                textclasificador: '',
                codigo: ''
            }
        };
    },

    mounted() {
        this.alllistaClasificadors();
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
        alllistaClasificadors() {
            var url = '/clasificador';
            axios.get(url)
                .then(response => {
                    this.listaClasificadors = response.data;
                });
        },
        allformatos() {
            var url = '/listaformatos';
            axios.get(url)
                .then(response => {
                    this.listaformatos = response.data;
                });
        },
        guardarClasificador() {
            var url = '/nuevoclasificador';

            axios.post(url, {
                    'Clasificador': this.formClasificador,
                    'codigo': this.codigo
                })
                .then(response => {
                    // console.log(response.data);
                    this.toast('Fue agregado el nuevo Clasificador', 'success');
                    this.alllistaClasificadors();
                    this.formClasificador = ''
                    this.codigo = ''
                });
        },
        abrir(idclasi, texcla, cod) {
            $('#editclasificador').modal({
                backdrop: 'static',
                keyboard: false
            });
            this.formupdate.idcla = idclasi
            this.formupdate.textclasificador = texcla
            this.formupdate.codigo = cod
        },
        guardarUPclasificador() {
            var url = '/updateclasificador'
            var up = {
                'idcla': this.formupdate.idcla,
                'idformato':this.id_formato,
                'textclasificador': this.formupdate.textclasificador,
                'codigo': this.formupdate.codigo
            }
            axios.post(url, up)
                .then(response => {
                    this.toast('Fue Actualizado el clasificador', 'info');
                    this.alllistaClasificadors();
                })
        },
        cambiaestado(idco, estado) {
            var url = '/updateclasificador-estado';
            axios.post(url, {
                    'idcon': idco,
                    'estado': estado
                })
                .then(response => {
                    this.toast('Se actualizó el estado del xlasificador', 'info');
                    this.alllistaClasificadors();
                });
        }

    },
};
</script>

<style lang="scss" scoped>

    </style>
