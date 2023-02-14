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

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-6 col-12">

                    <router-link :to="'/Tramites/Nuevotramite'" class="btn btn-primary btn-sm"><i class="fa-regular fa-file"></i> Crear nuevo documento</router-link>

                </div>

            </div>

            <div class="row mt-2">
                <div class="col-md-12">
                    <div class="card card-primary card-outline ">
                        <div class="card-header p-1">
                            Documentos en proceso
                        </div>
                        <div class="card-body">

                            <div class="row">
                                <div class="col-md-2">
                                    <div class="group">
                                        <label for="" class="text-sm">Registro</label>
                                        <input type="number" class="form-control form-control-sm" v-model="formData.iddocumento">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="group">
                                        <label for="" class="text-sm">Documento del usuario</label>
                                        <select v-model="formData.idadmin" class="form-control" @change="buscarDocumentos()">
                                            <option :value="null">Todos</option>
                                            <option v-for="(usuario, indexUser) in getUsuariosActivo" :key="indexUser" :value="usuario.id">
                                                {{ usuario.adm_name }} {{ usuario.adm_lastname }}
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="group">
                                        <label for="" class="text-sm">Estado documento</label>
                                        <select v-model="formData.oper_idtope" class="form-control" @change="buscarDocumentos()">
                                            <option :value="null">Todos</option>
                                            <option value="1">Pendientes</option>
                                            <option value="2">Procesados</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="group">
                                        <label for="" class="text-sm">Tipo documento</label>
                                        <select v-model="formData.docu_digital" class="form-control" @change="buscarDocumentos()">
                                            <option :value="null">Todos</option>
                                            <option value="1">Tramite Electrónico</option>
                                            <option value="0">Tramite manual</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2"><label for=""></label>
                                    <button type="button" class="btn btn-block btn-primary btn-sm mt-1" @click.prevent="buscarDocumentos()"><i class="fa-regular fa-circle"></i> Buscar</button>
                                </div>
                            </div>
                            <div class="row form-group mt-2">
                                <div class="demo-inline-spacing">
                                    <button type="button" class="btn btn-outline-primary btn-sm "><i class="far fa-edit"></i> Editar</button>
                                    <button type="button" class="btn btn-outline-primary btn-sm"><i class="fa-regular fa-paper-plane"></i> Derivar</button>
                                    <button type="button" class="btn btn-outline-primary btn-sm"><i class="fa-regular fa-folder-open"></i> Archivar</button>
                                    <button type="button" class="btn btn-danger btn-sm"><i class="fa-regular fa-trash-can"></i> Eliminar derivacion</button>
                                    <button type="button" class="btn btn-outline-primary btn-sm"><i class="fa-regular fa-square-plus"></i> Adjuntar</button>
                                    <button type="button" class="btn btn-info btn-sm"><i class="fa-regular fa-window-restore"></i> Responder</button>

                                </div>
                            </div>

                            <div class="row mt-2">
                                <table class=" table table-bordered table-condensed table-hover">
                                    <thead class="bg-lightblue disabled color-palette pd-0">
                                        <tr class="info">
                                            <th style="width:7%">REGISTRO<br />EXPEDIENTE</th>
                                            <th style="width:15%">REGISTRO</th>
                                            <th style="width:40%">DOCUMENTO</th>
                                            <th style="width:10%">DESTINO</th>
                                            <th style="width:10%">ARCHIVO</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <tr>
                                            <td v-if="documentos.data.length == 0" colspan="21" class="text-center">
                                                No hay documentos, pruebe cambiando los filtros
                                            </td>
                                        </tr>
                                        <tr v-for="(documento, index) in documentos.data" :key="index" :set="(dias = moment().diff(moment(documento.created_at), 'days'))" :class="operSelected.indexOf(documento.idoperacion) >= 0 ? 'danger': documento.depe_destino != null? 'success': 'blanco' " @click="selectArchivar(documento)">
                                            <td>
                                                <span :class="{
                                                            badge: true,
                                                            'badge-danger': dias > 20,
                                                            'badge-warning': dias > 10 && dias <= 20,
                                                            'badge-success': dias <= 10
                                                        }">{{ dias }} días</span><br />
                                                <small><strong>Reg.</strong>
                                                    <a href="#" @click.prevent.stop="buscarByDocumento({ iddocumento: documento.iddocumento, modal: true })">
                                                        {{ ' ' + ('00000000' + documento.iddocumento).slice(-8) }}</a><br />
                                                    <strong>Exp.</strong>{{ ' ' + ('00000000' + documento.docu_idexma).slice(-8) }}<br />
                                                    {{ documento.oper_idtope == 1 ? 'REGISTRADO' : 'DERIVADO' }}
                                                </small>
                                            </td>
                                            <td class="registro">
                                                <small>
                                                    <strong>Fecha:</strong>{{ documento.created_at }}<br />
                                                    <strong>Forma:</strong>{{ documento.oper_forma == 1 ? 'COPIA' : 'ORIGINAL' }}<br />
                                                    <strong>Folios:</strong>{{ documento.docu_folios }}<br />
                                                    <strong>Proveido:</strong>{{ documento.proveido }}
                                                </small>
                                            </td>
                                            <td style="white-space:nowrap;width:1%;" class="documento">
                                                <small>

                                                    <div><strong>Doc:</strong>
                                                        {{ documento.tdoc_descripcion + ' ' }}{{ ('000000' + documento.docu_numero_doc).slice(-6)
                                                    }}{{ documento.docu_origen == 1 ? '-' + documento.docu_fecha_doc.substr(0, 4) : ''
                                                    }}{{ documento.docu_siglas_doc != null ? '-' + documento.docu_siglas_doc : '' }}
                                                    </div>

                                                    <div><strong>Firma:</strong>{{ documento.docu_firma }}</div>

                                                    <div><strong>Cargo:</strong>{{ documento.docu_cargo }}</div>

                                                    <div><strong>Asunto:</strong> {{ documento.docu_asunto }}</div>

                                                    <div><strong>Dependencia: </strong> 
                                                        {{ getDependenciaNombre(documento.depe_origen) }} 
                                                    </div>
                                                </small>
                                            </td>
                                            <td>
                                                <small>
                                                    <div v-if="documento.depe_destino != null">
                                                        <div>
                                                            <strong>Destino:</strong>
                                                            {{ getDependenciaNombre(documento.depe_destino) }}
                                                            <br />
                                                        </div>
                                                        <div v-if="documento.oper_usuid_d != 0">
                                                            <strong>Para:</strong>
                                                            <!-- {{ getUsuariosActivoNombre(documento.oper_usuid_d) }} -->
                                                            {{ documento.nameuser_destino }} {{ documento.lastnameuser_destino }}

                                                            <br />
                                                        </div>
                                                        <div><strong>Acciones:</strong>{{ documento.oper_acciones }}</div>
                                                    </div>
                                                    <div v-if="documento.depe_destino == null && documento.oper_detalledestino != null">
                                                        <div>
                                                            <strong>Observacion:</strong>{{ documento.oper_detalledestino != null ?documento.oper_detalledestino : 'Ninguna' }}
                                                        </div>
                                                    </div>
                                                </small>
                                            </td>
                                            <td nowrap width="20%">
                                                <div v-if="documento.docu_archivo.length>0">
                                                    <span v-if="documento.docu_digital" class="badge badge-info glyphicon glyphicon-lock"> Tramite Electrónico</span>
                                                    <div v-for="(archivo, indexArchivo) in documento.docu_archivo.filter(d => d.file_mostrar)" :key="indexArchivo">
                                                        <div class="float-left">
                                                            <!-- <button type="button" class="btn btn-xs btn-link doc-link" @click.stop="imprimirDocumentoPdf({id:archivo.id, id_documento:archivo.id_documento, file_tipo: archivo.file_tipo, file_name: archivo.file_name,tipo:1})"> -->
                                                            <a :href="ruta+'/'+archivo.file_url" target="_blank">
                                                                <small>
                                                                    <span style="color:blue;font-size:80%">{{ getFormatBytes(archivo.file_size) }}</span>
                                                                    <span v-if="archivo.file_principal != null" :class="
                                                                                archivo.file_principal
                                                                                    ? 'badge badge-danger'
                                                                                    : 'badge badge-warning'
                                                                                ">
                                                                        {{ archivo.file_principal?'P':'A' }}
                                                                    </span>
                                                                    <span :class="
                                                                            archivo.file_tipo.indexOf('image') === 0
                                                                            ? 'glyphicon glyphicon-picture'
                                                                            : 'glyphicon glyphicon-file'
                                                                        "></span>
                                                                    {{ archivo.file_name }}
                                                                </small>
                                                            </a>
                                                            <!-- </button> -->
                                                        </div>
                                                        <div class="d-flex flex-column align-items-end pr-1">
                                                            <button v-if="archivo.file_tipo === 'application/pdf'" class="btn btn-sm btn-success" @click.stop="firmar({idfile:archivo.id, id_documento:archivo.id_documento,'ruta_archivo':archivo.file_url,'existearchivo':Existe})">
                                                                <span class="glyphicon glyphicon-pencil"></span> Firmar
                                                            </button>
                                                        </div>
                                                    </div>

                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <pagination :data="documentos" :limit="3" @pagination-change-page="buscarDocumentos" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->

    <!-- ........................... -->

    <!-- ...................... -->
    <docu-invoker ref="foo" :iframe="iframe" :route-invoker-get="routeInvokerGet" :route-invoker-post="routeInvokerPost" :ruta="ruta" @firmado="firmado" />
</div>
</template>

<script >
import Vue from 'vue'
import moment from 'moment'
import LaravelVuePagination from 'laravel-vue-pagination'


import DocuInvoker from './DocuInvoker'

window.$ = window.jQuery = require('jquery')

export default {
    props: ['ruta', 'usuario', 'routeInvokerGet', 'routeInvokerPost'],
    data() {
        return {
            formData: {
                iddocumento: null,
                idadmin: this.userId,
                oper_idtope: null,
                docu_digital: null,
                page: null
            },
            documentos: {
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
            operSelected: [],
            docIndexes: [],
            // DATOS PARA REFIRMA INVOKER
            iframe: {
                src: null,
                loaded: false,
                type: null
            },
            getUsuariosActivo: [],
            listadependencias: [],
            listausuarios:[],
            deriradoausuario: '',

            // archivo existente para firmar
            ArchivoFirma: null, // retorno del patch de pdf cargado para ser firmado
            Existe: 0, // 0:no existe el archivo para la firma, 1: existe archiv para firma => activamos el boton para firmar

        }
    },
    components: {
        'Pagination': LaravelVuePagination,
        DocuInvoker

    },
    created() {},
    mounted() {
        this.buscarDocumentos();
        this.alldependencias();
        // this.allusuarios();
        this.funcusuarios(this.usuario.depe_id);
        //alert(this.usuario.depe_id)
    },
    methods: {
        moment(a) {
            return moment(a)
        },
        buscarDocumentos(page = 1) {
            var url = '/tramite/documentoenproceso?page=' + page
            // this.$validator.validate().then(result => {
            //     if (result) {
            //         this.formData.page = page
            axios.get(url, {
                params: this.formData
            }).then(response => {
                this.documentos = response.data
                this.operSelected = []
                this.docIndexes = []
            })
            //     } else {
            //         console.log('incompleto')
            //     }
            // })
        },
        selectArchivar(documento) {
            if (this.operSelected.indexOf(documento.idoperacion) === -1 && this.docIndexes.indexOf(this.documentos.data.indexOf(documento)) === -1) {
                this.operSelected.push(documento.idoperacion)
                this.docIndexes.push(this.documentos.data.indexOf(documento))
            } else {
                this.operSelected.splice(this.operSelected.indexOf(documento.idoperacion), 1)
                this.docIndexes.splice(this.docIndexes.indexOf(this.documentos.data.indexOf(documento)), 1)
            }
        },
        funcusuarios(id) {// usuarios activos de la oficina
            var url = '/listauserdepe/' + id;
            axios.get(url)
                .then(response => {
                    this.getUsuariosActivo = response.data.usuarios;// lista de usuarios activos de la subgerencia
                })
        },
        alldependencias() {
            var url = '/alldependencia';
            axios.get(url)
                .then(response => {
                    this.listadependencias = response.data.datos;
                })
        },
        getDependenciaNombre(codedepe) {

            var resultado = this.listadependencias.filter(student => student.iddependencia === codedepe);

            var nomdepe= resultado[0].depe_nombre;
            return nomdepe;

        },
        // getUsuariosActivoNombre(id) {
            
            
        //     // let resultado = this.listausuarios.filter(student => student.id === id);
        //     // var nombres=resultado[0].adm_name+' '+resultado[0].adm_lastname;
        //     return '';

        // },
        // allusuarios(){// listado de todo los usuarios registrados
            
        //     var url='/alluser';
        //     axios.get(url)
        //     .then(response=>{
        //         this.listausuarios=response.data;
        //     });
        // },
        getFormatBytes() {

        },
        imprimirDocumentoPdf() {

        },
        firmar(documento) {

            this.$refs.foo.initInvoker('W', documento)
        },
        firmado() {
            this.buscarDocumentos();
        },

    }
}
</script>

<style lang="css" scoped>
.success {
    background-color: #dff0d8;
    color: black;
}

.danger {
    background-color: #f2dede;
    color: black;
}

.blanco {
    color: black;
    background-color: #fff;
}

.dark-mode .success {
    background-color: #94b387cc;
    color: black;
}
.dark-mode .success:hover {
    background-color: #94b387cc;
    color: black;
}

/* .table-hover {
    background-color: #007bff17 !important;
} */

.dark-mode .danger {
    background-color: #d9aaaa;
    color: black;
}
.dark-mode .danger:hover {
    background-color: #d9aaaa;
    color: black;
}

.dark-mode .blanco {
    color: black;
    background-color: #dbdbdb;
}

.dark-mode .blanco:hover {
    color: black;
    background-color: #fff;
    border-color: #6c757d;
}

/* .dark-mode .table-hover {
    background-color: #007bff45 !important;
} */

/* .registro strong {
    width: 60px;
    display: inline-block;
  }

  .documento strong {
    display: inline-block;
    float: left;
  }

  .documento strong.mobile {
    width: 100%;
  }

  .documento strong.tablet {
    width: 100%;
  }

  .documento strong.laptop {
    width: 30%;
  }

  .documento strong.desktop {
    width: 20%;
  }

  .documento div {
    float: left;
  }

  .documento div.mobile {
    width: 100%;
  }

  .documento div.tablet {
    width: 100%;
  }

  .documento div.laptop {
    width: 70%;
  }

  .documento div.desktop {
    width: 80%;
  }

  .table tbody tr td,
  .table thead tr th {
    font-size: 11px;
    font-family: Tahoma;
    vertical-align: middle;
    padding: 2px 0px;
  }

  input,
  textarea {
    text-transform: uppercase;
  }

  .doc-link {
    width: 250px;
    text-overflow: ellipsis;
    text-align: left;
    white-space: nowrap;
    overflow: hidden;
    margin-bottom: 0;
  } */
.table tbody tr td,
.table thead tr th {
    font-size: 12px;
    font-family: Tahoma;
    vertical-align: middle;
    padding: 2px 0px;
}

td {
    border: 1px solid rgba(0, 0, 0, 0.071);
}

.badge {
    font-size: 10px !important;
}

.documento strong {
    width: 70px;
    display: inline-block;
}

.registro strong {
    width: 60px;
    display: inline-block;
}
</style>
