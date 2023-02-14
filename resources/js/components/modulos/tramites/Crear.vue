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
                    <router-link :to="'/Tramites/Enproceso'" class="btn btn-info btn-sm"><i class="fa-regular fa-circle-left"></i>Volver a documentos en proceso</router-link>
                </div>

            </div>

            <div class="row mt-2">

                <div class="col-12">
                    <div class="card card-primary card-outline card-revenue-budget">

                        <div class="card-body">

                            <div class="row">

                                <div class="col-sm-6 revenue-report-wrapper border-right">
                                    <div class="form-group row">
                                        <label class="col-sm-3"><small>Expediente</small>:</label>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control form-control-sm" placeholder="N°" v-model="formdocumentos.expediente">
                                        </div>
                                        <div class="col-sm-6">
                                            <small>respuesta de expediente</small>
                                        </div>
                                    </div>
                                    <div class="form-group row border-bottom">
                                        <label class="col-sm-3"><small>Referencias:</small></label>
                                        <div class="col-sm-9">
                                            <div class="table-responsive">
                                                <table class="table table-hover table-bordered table-sm">
                                                    <tbody>
                                                        <tr>
                                                            <td width="185"><input type="number" class="form-control form-control-sm" placeholder="Reg. documento" v-model="formdocumentos.camporeferencia"></td>
                                                            <td class="text-center" @click.prevent="agregarreferenias"><i class="fa-solid fa-plus me-25"></i></td>
                                                        </tr>
                                                        <tr v-for="(find, index) in formdocumentos.array_referencias">
                                                            <td width="90%">
                                                                <input v-model="find.value" :key="index" class="form-control form-control-sm text-uppercase" placeholder="Referencia"></td>
                                                            <td>
                                                                <button class="btn btn-default btn-sm" @click.prevent="eliminarefe(index)"><i class="fa-solid fa-trash-can"></i></button>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>

                                        </div>

                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-3"><small>Forma de registro:</small></label>
                                        <div class="col-sm-9">
                                            <div class="demo-inline-spacing">
                                                <div class="form-check form-check-inline" style="margin-top: 0rem !important;">
                                                    <input type="radio" name="inlineRadioOptions" id="inlineRadio1" value="1" checked v-model="formdocumentos.frregistro" />
                                                    <label class="form-check-label" for="inlineRadio1"><small>Interno</small></label>
                                                </div>
                                                <div class="form-check form-check-inline" style="margin-top: 0rem !important;">
                                                    <input type="radio" name="inlineRadioOptions" id="inlineRadio1" value="2" v-model="formdocumentos.frregistro" />
                                                    <label class="form-check-label" for="inlineRadio2"><small>Para externo</small></label>
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3"><small>Tipo:</small></label>

                                        <div class="col-sm-6">
                                            <div class="demo-inline-spacing">

                                                <div class="form-check form-check-inline" style="margin-top: 0rem !important;">
                                                    <input type="checkbox" id="inlineCheckbox2" value="unchecked" v-model="formdocumentos.tipotramite" @change="tipostramite" />
                                                    <label class="form-check-label" for="inlineCheckbox2"><small>Documento Personal</small></label>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3"><small>Unidad Org:</small></label>
                                        <div class="col-sm-9">
                                            <small>{{ formdocumentos.codigounidad }} - {{ formdocumentos.nombre_oficina }}</small>
                                        </div>

                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3"><small>Firma:</small></label>
                                        <div class="col-sm-9">
                                            <small>{{ formdocumentos.firma }}</small>
                                        </div>

                                    </div>
                                    <div class="form-group row border-bottom">
                                        <label class="col-sm-3"><small>Cargo:</small></label>
                                        <div class="col-sm-9">
                                            <small>{{ formdocumentos.cargo}}</small>
                                        </div>

                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-3"><small>Fecha:</small></label>
                                        <div class="col-sm-6">
                                            <input type="date" class="form-control form-control-sm" placeholder="N°" v-model="formdocumentos.fechatramite" id="fechadate">
                                        </div>

                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3"><small>Tipo de Documento:</small></label>
                                        <div class="col-sm-9">

                                            <select v-model="formdocumentos.tipodocumento" :class="'form-control form-control-sm '+valida_tipodoc" placeholder="Elijir el documento" @change="nomdoc" required>
                                                <option v-for="list in listadocumento" :key="list.idtdoc" :value="list.idtdoc"><small>{{ list.tdoc_descripcion }}</small></option>
                                            </select>

                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3"><small>Número y Siglas:</small></label>
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control form-control-sm" v-model="formdocumentos.correlativodoc">
                                        </div>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control form-control-sm" readonly="readonly" v-model="formdocumentos.siglasdoucmento">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3"><small>Forma Recepción:</small></label>
                                        <div class="col-sm-3">
                                            <select class="form-control form-control-sm" v-model="formdocumentos.formarecepcion">
                                                <option value="1">DIRECTA</option>
                                                <option value="2">FAX</option>
                                                <option value="3">VIA WEB</option>
                                                <option value="5">CEN.MED. S.M.CAUTIVO</option>
                                            </select>
                                        </div>
                                        <label class="col-sm-3"><small>Prioridad:</small></label>
                                        <div class="col-sm-3">
                                            <select class="form-control form-control-sm" v-model="formdocumentos.prioridad">
                                                <option value="1">NORMAL</option>
                                                <option value="2">URGENTE</option>
                                                <option value="2">DOCU MINEDU</option>
                                                <option value="2">DOCU DRE</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3"><small>Folios:</small></label>
                                        <div class="col-sm-3">
                                            <input type="number" :class="'form-control form-control-sm  '+ valida_folios" placeholder="N°" v-model="formdocumentos.folios">
                                        </div>

                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3"><small>Asunto:</small></label>
                                        <div class="col-sm-9">
                                            <textarea :class="'form-control form-control-sm text-uppercase '+ valida_asunto" id="exampleFormControlTextarea1" rows="2" placeholder="Asunto" v-model="formdocumentos.asunto"></textarea>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-md-6 p-0">

                                    <div class="card-body">

                                        <h6><small>Derivacion de documento</small></h6>
                                        <div class="form-group row">
                                            <label class="col-sm-3"><small>Forma:</small></label>

                                            <div class="col-sm-6">
                                                <div class="demo-inline-spacing">

                                                    <div class="form-check form-check-inline" style="margin-top: 0rem !important;">
                                                        <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="unchecked" v-model="formdocumentos.formaderivacion" />
                                                        <label class="form-check-label" for="inlineCheckbox2"><small>Copia</small></label>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3"><small>U.Organica:</small></label>
                                            <div class="col-sm-2">
                                                <input type="text" class="form-control form-control-sm" placeholder="Cod." v-model="formdocumentos.cod_unidad" @keyup="capturaiddepe($event)">
                                            </div>
                                            <div class="col-sm-7">
                                                <select class="form-control form-control-sm" v-model="formdocumentos.cod_unidad" @change="capturaiddepe($event)">
                                                    <option v-for="lista in listadependencias" :key="lista.iddependencia" v-text="lista.depe_nombre" :value="lista.iddependencia"></option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3"><small>Detalle:</small></label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control form-control-sm text-uppercase" placeholder="N°" v-model="formdocumentos.detalle">
                                            </div>

                                        </div>
                                        <div class="form-group row" id="divusers" v-show="showdiv">
                                            <label class="col-sm-3"><small>Usuario:</small></label>

                                            <div class="col-sm-9">
                                                <select class="form-control form-control-sm" v-model="formdocumentos.usuario" @change="detalleuser">
                                                    <template v-for="itemuser in listadouser">
                                                        <option v-if="itemuser.id!==datosuser.user_representante.iduser" v-text="itemuser.adm_name+' '+itemuser.adm_lastname" :value="itemuser.id"></option>
                                                    </template>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">

                                            <div class="col-sm-3">
                                                <label><small>Proveido de atención:</small></label>
                                                <button type="button" class="btn btn-outline-primary btn-sm " @click.prevent="agregarderivacion"><i class="fa-regular fa-calendar-plus"></i> <small>Añadir</small></button>
                                            </div>
                                            <div class="col-sm-9">
                                                <textarea class="form-control form-control-sm text-uppercase" id="exampleFormControlTextarea1" rows="2" v-model="formdocumentos.proveido"></textarea>

                                                <!-- <button type="button" class="btn btn-outline-danger btn-sm "><i class="fa-regular fa-trash-can"></i><small>Limpiar</small></button> -->
                                            </div>

                                        </div>
                                        <div class="form-group row" v-show="showtabladerivaciones">
                                            <table id="tabla" class="table table-bordered table-hover table-sm">
                                                <thead>
                                                    <tr class="bg-info disabled color-palette">
                                                        <th><small>FORMA</small></th>
                                                        <th><small>UNIDAD ORGANICA</small></th>
                                                        <th><small>DETALLE</small></th>
                                                        <th><small>USUARIO</small></th>
                                                        <th><small>PROVEIDO DE ATENCIÓN</small></th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr v-for="(der, index) in formdocumentos.derivaciones">

                                                        <td><small>{{ der.textforma }}</small></td>
                                                        <td><small>{{ der.vnomoficina }}</small></td>
                                                        <td><small>{{ der.vdetalle }}</small></td>
                                                        <td><small>{{ der.vnombreuser }}</small></td>
                                                        <td><small>{{ der.vproveido }}</small></td>
                                                        <td><button class="btn btn-default btn-sm" @click.prevent="eliminaderivacion(index)"><i class="fa-solid fa-trash-can"></i></button></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                        <div class="form-group row mt-1 border-top pt-1">
                                            <label class="col-sm-4"><small>Archivo(principal en PDF):</small></label>
                                            <div class="col-sm-3" v-show="btn_cargarpdf">

                                                <button class="btn btn-success btn-sm">
                                                    <input type="file" name="docu_archivo" accept=".pdf" style="position: absolute; z-index: 2; top: 0px; left: 10%; opacity: 0; line-height: 2;background-color: transparent; color: transparent;max-width: 60%;max-width: 68%;" id="files" ref="files" @change="handleFilesUpload( $event )"><i class="fa-regular fa-file-pdf"></i> Cargar
                                                </button>
                                            </div>

                                            <div class="col-sm-4" v-show="btn_cargarword">
                                                <button class="btn btn-outline-primary btn-sm " @click.prevent="exporta_word">
                                                    <i class="fa-regular fa-file-word"></i> Generar
                                                </button>
                                            </div>
                                            <div class="col-sm-4" v-show="btn_sincronizar">

                                                <button class="btn btn-success btn-sm">
                                                    <input type="file" name="docu_archivo" accept=".pdf" style="position: absolute; z-index: 2; top: 0px; left: 10%; opacity: 0; line-height: 2;background-color: transparent; color: transparent;max-width: 60%;max-width: 68%;" id="files" ref="files" @change="handleFilesUpload( $event )">
                                                    <!-- <input type="file" name="docu_archivo" accept="application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document" style="position: absolute; z-index: 2; top: 0px; left: 10%; opacity: 0; line-height: 2;background-color: transparent; color: transparent;max-width: 60%;max-width: 68%;" id="files" multiple ref="files" @change="handleFilesUpload( $event )"> -->
                                                    <i class="fa-regular fa-file-word"></i> Sincronizar
                                                </button>
                                            </div>

                                        </div>

                                        <div class="form-group row mt-1" v-show="btn_anexo">
                                            <label class="col-sm-4"><small>Anexos( máx.4 archivos):</small></label>
                                            <div class="col-sm-3">
                                                <button class="btn btn-warning btn-sm">
                                                    <input type="file" name="docu_archivo" accept="application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document" style="position: absolute; z-index: 2; top: 0px; left: 10%; line-height: 2; opacity: 0; background-color: transparent; color: transparent;max-width: 68%;" id="anexos" multiple ref="anexos" @change="carganexos( $event )"><i class="fa-regular fa-file-pdf"></i> Cargar
                                                </button>
                                            </div>
                                            <div class="col-sm-5">
                                                <small>(PDF, Imágenes, Word y Excel)</small>
                                            </div>

                                        </div>

                                        <!-- mostrar los archivos cargados -->
                                        <div class="form-group  mt-1">

                                            <div v-for="(file, key) in files" class="row border-top">

                                                <div class="col-sm-7" v-if="getFileExtension3(file.name)=='pdf'">

                                                    <i class="fa-regular fa-file-pdf"></i>
                                                    <small class="text-primary">{{ file.name }} <span class="badge float-right badge-light-info badge-pill">{{tamaniofile(file.size)}}</span></small>
                                                </div>
                                                <div class="col-sm-7" v-else>

                                                    <i class="fa-regular fa-file-word"></i><small class="text-primary">{{ file.name }} <span class="badge float-right badge-light-info badge-pill">{{tamaniofile(file.size)}}</span></small>
                                                </div>
                                                <div class="col-sm-3 pt-1">
                                                    <!-- <div class="progress" style="height: 6px;"><div role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="50" class="progress-bar" style="width: 50%;"></div></div> -->

                                                    <div class="progress progress-xs">
                                                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                                            <!-- <span class="sr-only">60% Complete (warning)</span> -->
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-sm-2 ">
                                                    <span class="badge badge-primary">p</span>
                                                    <span class="badge float-right badge-light-danger badge-pill" v-on:click="removeFile( key )"><i class="fa-solid fa-trash-can"></i></span>
                                                </div>

                                            </div>
                                            <!-- para anexos -->
                                            <div v-for="(file_a, key) in anexosfiles" class="row border-top">

                                                <div class="col-sm-7" v-if="getFileExtension3(file_a.name)=='pdf'">

                                                    <i class="fa-regular fa-file-pdf"></i>
                                                    <small class="text-primary">{{ file_a.name }} <span class="badge float-right badge-light-info badge-pill">{{tamaniofile(file_a.size)}}</span></small>
                                                </div>
                                                <div class="col-sm-7" v-else>

                                                    <i class="fa-regular fa-file-word"></i><small class="text-primary">{{ file_a.name }} <span class="badge float-right badge-light-info badge-pill">{{tamaniofile(file_a.size)}}</span></small>
                                                </div>
                                                <div class="col-sm-3 pt-1">
                                                    <!-- <div class="progress" style="height: 6px;"><div role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="50" class="progress-bar" style="width: 50%;"></div></div> -->

                                                    <div class="progress progress-xs">
                                                        <div class="progress-bar progress-bar-striped bg-warning progress-bar-animated" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                                            <!-- <span class="sr-only">60% Complete (warning)</span> -->
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-sm-2 ">
                                                    <span class="badge badge-warning">A</span>
                                                    <span class="badge float-right badge-light-danger badge-pill" v-on:click="removeFileanexos( key )"><i class="fa-solid fa-trash-can"></i></span>
                                                </div>

                                            </div>

                                        </div>

                                        <div class="form-group row mt-1 p-2" style="background: #63c7d6">
                                            <div class="text-center">

                                                <button type="submit" class="btn btn-primary btn-sm" @click="generar_tramite" v-show="btngenerartramite"><i class="fa-regular fa-floppy-disk"></i> Generar trámite</button>

                                                <button type="submit" class="btn btn-danger btn-sm" @click.stop="firmadigital({idfile:idfile, id_documento:idtramdoc,'ruta_archivo':ArchivoFirma,'existearchivo':Existe})" v-show="EstadoFirma"><i class="fa fa-eyedropper"></i> Firmar digitalmente</button>
                                                <button class="btn btn-dark btn-sm" @click="generarnuevotramite" v-show="btngenerarnewtramite"> <i class="fa-regular fa-file"></i> Generar nuevo tramite</button>
                                            </div>
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

        <docu-invoker ref="foo" :iframe="iframe" :route-invoker-get="routeInvokerGet" :route-invoker-post="routeInvokerPost" :ruta="ruta" @firmado="firmado" />

    </div>
</div>
</template>

<script>
// import DocuInvoker from './DocuInvoker'
import VDragged from 'v-dragged'
import DocuInvoker from './DocuInvoker'
import Vue from 'vue'
import Swal from 'sweetalert2';
window.$ = window.jQuery = require('jquery')
Vue.use(VDragged);
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
    props: ['ruta', 'usuario', 'routeInvokerGet', 'routeInvokerPost'],
    data() {
        return {
            formdocumentos: {
                expediente: '',
                referencias: '',
                array_referencias: [], // referencias al documento
                json_referencias: [], // referencias al documento en formato json
                camporeferencia: '',
                frregistro: 1, // tramite interno 1  externo 2
                codigounidad: '', // captura de tabla admin a donde pertenece el usuario
                nombre_oficina: '',
                tipotramite: false, //o: represnetante oficina 1: tramite personal
                idusercreador: '', // iduser el id de user el que crea
                firma: '',
                cargo: '',
                firmadestino: '', //firma de destino
                cargodestino: '', // cargo destino
                fechatramite: '', // new Date().toISOString().substr(0, 10),
                tipodocumento: '', //codigo del tipo de documento
                correlativodoc: '',
                siglasdoucmento: '',
                clavedoc: '',
                formarecepcion: 1,
                prioridad: 1,
                folios: '',
                asunto: '',
                formaderivacion: false,
                cod_unidad: '', // codigo unidad a donde derviva
                unidadorganica: '', // nombre unidad a quien se deriva
                detalle: '',
                usuario: '', //codigo de usuario a quien se deriva cuando es en la misma unidad
                proveido: '', // proveido destino
                derivaciones: [], // las unidades dondde derivaran respectivas unidades
                json_derivaciones: [] //las unidades dondde derivaran respectivas unidades en formato json
            },
            listadocumento: {},
            datosuser: {},
            listadependencias: {},
            nombredocumento: '',
            nombredoc_export: '',
            listadouser: {},
            representantedestino: {},
            showdiv: false,
            mostrarpdf: true,
            mdlInvoker: true,
            mostrarposicionfrima: false,
            showtabladerivaciones: false,
            isDisabled_btngenerar: false,
            btn_sincronizar: false,
            btn_anexo: true,
            btn_cargarpdf: true,
            btn_cargarword: true,

            modal: false,
            files: [], // principal
            anexosfiles: [],
            /// validaciones /////
            valida_tipodoc: '',
            valida_folios: '',
            valida_asunto: '',
            //  deatalleuser:{}

            // DATOS PARA REFIRMA INVOKER
            iframe: {
                src: null,
                loaded: false,
                type: null
            },
            // archivo existente para firmar
            ArchivoFirma: '', // retorno del patch de pdf cargado para ser firmado
            Existe: 0, // 0:no existe el archivo para la firma, 1: existe archiv para firma => activamos el boton para firmar
            EstadoFirma: false, // habilitar boton firmar digitalmente
            btngenerartramite: true,
            btngenerarnewtramite: false,
            idfile: '',
            idtramdoc: ''

        }
    },

    components: {
        DocuInvoker
    },
    mounted() {
        this.tipostramite();
        this.listadodocumento();
        this.fechasistema();
        //this.img = this.imgs.s_load
        //         let today = new Date().toISOString().substring(0, 10);
        // document.querySelector("#fechadate").value = today;
        //this.formdocumentos.fechasistema=new Date().toISOString().substring(0, 10)

    },
    methods: {

        // toast(texto_titulo,texto_anuncio,icono)
        toast(texto_anuncio, icono) {

            Toast.fire({
                // title:texto_titulo,
                title: '<small><strong>' + texto_anuncio + '</strong></small>',
                icon: icono,
                // text: texto_anuncio
            });
        },
        verificacion() {

        },

        tipostramite() {
            var seltipodoc = this.formdocumentos.tipodocumento ? this.formdocumentos.tipodocumento : 0;
            var url = '/consulta_user/' + this.formdocumentos.tipotramite + '/' + seltipodoc + '/' + this.usuario.id;
            axios.get(url)
                .then(response => {
                    this.datosuser = response.data;

                    this.formdocumentos.firma = this.datosuser.user_representante.firma_tramite;
                    this.formdocumentos.cargo = this.datosuser.user_representante.cargo_tramite;
                    this.formdocumentos.siglasdoucmento = this.datosuser.user_representante.siglas_tramite;
                    this.formdocumentos.correlativodoc = this.datosuser.tipodoc.correlativo;
                    this.formdocumentos.codigounidad = this.datosuser.user_representante.idoficina;
                    this.formdocumentos.idusercreador = this.datosuser.user_representante.iduser;
                    this.formdocumentos.clavedoc = this.datosuser.clavedoc;
                    this.listadependencias = this.datosuser.dependencias;
                    this.formdocumentos.nombre_oficina = this.datosuser.user_representante.nombreoficina;

                    //this.nombredocumento=this.datosuser.tipodoc.nombre_doc;
                    // this.nombredoc_export=this.nombredocumento+'-'+this.formdocumentos.correlativodoc;
                    if (this.formdocumentos.correlativodoc == null) {
                        this.formdocumentos.correlativodoc = 1;

                    }
                    var idusuario = this.datosuser.user_representante.iduser;
                    var aniodoc = this.datosuser.user_representante.tram_anio;
                    this.nombredoc_export = this.nombredocumento + '-' + this.formdocumentos.correlativodoc;
                    this.nombredoc_export = idusuario + '-' + this.nombredoc_export + '-' + aniodoc;

                })

        },
        listadodocumento() {
            axios.get('/tipodocumento')
                .then(response => {
                    this.listadocumento = response.data.listadoc;
                    //this.pagination=response.data.paginacion
                })
        },
        fechasistema() {
            const hoy = new Date();
            // const year = hoy.getFullYear();
            // const mes = hoy.getMonth();
            // const dia = hoy.getDate();

            // var mesdo = mes < 10 ? "0" + mes : mes;
            // var diado = dia < 10 ? "0" + dia : dia;

            this.formdocumentos.fechatramite = hoy.toISOString().substring(0, 10); // year + '-' + mesdo + '-' + diado;
            //alert(this.formdocumentos.fechatramite)
        },

        exporta_word() {
            var url = '/exportaword';
            axios.get(url, {
                    params: {
                        fexpediente: this.formdocumentos.expediente,
                        freferencias: this.formdocumentos.array_referencias,
                        ffrregistro: this.formdocumentos.frregistro,
                        fcodigounidad: this.formdocumentos.codigounidad, // captura de tabla admin a donde pertenece el usuario
                        fnombre_oficina: this.formdocumentos.nombre_oficina,
                        ftipotramite: this.formdocumentos.tipotramite, //o: represnetante oficina 1: tramite personal
                        fidusercreador: this.formdocumentos.idusercreador, // id del usuario quien realiza el tramite
                        ffirma: this.formdocumentos.firma,
                        fcargo: this.formdocumentos.cargo,
                        ffirmadestino: this.formdocumentos.firmadestino, //firma de destino
                        fcargodestino: this.formdocumentos.cargodestino, // cargo destino
                        ffechatramite: this.formdocumentos.fechatramite,
                        ftipodocumento: this.formdocumentos.tipodocumento, //codigo del tipo de documento
                        fcorrelativodoc: this.formdocumentos.correlativodoc,
                        fsiglasdoucmento: this.formdocumentos.siglasdoucmento,
                        fclavedoc: this.formdocumentos.clavedoc,
                        fformarecepcion: this.formdocumentos.formarecepcion,
                        fprioridad: this.formdocumentos.prioridad,
                        ffolios: this.formdocumentos.folios,
                        fasunto: this.formdocumentos.asunto,
                        fformaderivacion: this.formdocumentos.formaderivacion,
                        fcod_unidad: this.formdocumentos.cod_unidad, // codigo unidad a donde derviva
                        funidadorganica: this.formdocumentos.unidadorganica, // nombre unidad a quien se deriva
                        fdetalle: this.formdocumentos.detalle,
                        fusuario: this.formdocumentos.usuario, //codigo de usuario a quien se deriva cuando es en la misma unidad
                        fproveido: this.formdocumentos.proveido, // proveido destino
                        fderivaciones: this.formdocumentos.derivaciones, // las unidades dondde derivaran respectivas unidades
                        fnombredoc_export: this.nombredoc_export,

                    },
                    responseType: 'blob'
                })
                .then(r => {
                    const url = window.URL.createObjectURL(new Blob([r.data]));
                    const link = document.createElement('a');
                    link.href = url;

                    // link.setAttribute('download', this.nombredoc_export+'.'+r.headers.ext);

                    link.setAttribute('download', this.nombredoc_export + '.docx');
                    document.body.appendChild(link);
                    link.click();

                    this.btn_sincronizar = true
                    this.btn_cargarword = false
                    this.btn_cargarpdf = false

                });

        }, // fin de exportacion a word

        ////////////////////////////////////////////////////////////////////////////////////////////
        nomdoc(e) {
            var url = '/buscatipodocumento/' + e.target.value + '/' + this.formdocumentos.tipotramite;
            axios.get(url)
                .then(response => {
                    var correlativo = response.data.correlativo;
                    //this.pagination=response.data.paginacion
                    /// al seleccionar ontenemos el correlativo que corresponde al doc.
                    this.nombredocumento = response.data.nombre_doc;

                    if (correlativo == null) {
                        this.formdocumentos.correlativodoc = 1; //
                        // this.nombredoc_export=this.nombredocumento+'-'+this.formdocumentos.correlativodoc;
                    } else {
                        this.formdocumentos.correlativodoc = correlativo
                    }
                    var idusuario = this.datosuser.user_representante.iduser;
                    var aniodoc = this.datosuser.user_representante.tram_anio;
                    this.nombredoc_export = this.nombredocumento + '-' + this.formdocumentos.correlativodoc;
                    this.nombredoc_export = idusuario + '-' + this.nombredoc_export + '-' + aniodoc;

                    this.valida_tipodoc = ''
                })

        },
        capturaiddepe(e) {
            var url = '/listauserdepe/' + e.target.value;
            axios.get(url)
                .then(response => {
                    this.listadouser = response.data.usuarios;
                    this.representantedestino = response.data.representantes;

                    this.formdocumentos.firmadestino = this.representantedestino[0].depe_representante;
                    this.formdocumentos.cargodestino = this.representantedestino[0].depe_cargo;
                    this.formdocumentos.unidadorganica = this.representantedestino[0].depe_nombre;

                });

            if (parseInt(e.target.value) == this.formdocumentos.codigounidad) { //alert('son iguales');

                this.showdiv = true;

            } else {
                //    $("#divusers").hide(); 
                this.showdiv = false;
            }

        },
        detalleuser() {
            var url = '/detalleuserderivacion/' + this.formdocumentos.usuario;
            axios.get(url)
                .then(response => {
                    this.formdocumentos.firmadestino = response.data.detalleuser[0].adm_name + ' ' + response.data.detalleuser[0].adm_lastname;
                    this.formdocumentos.cargodestino = response.data.detalleuser[0].adm_cargo;
                    // this.formdocumentos.unidadorganica=response.data.detalleuser[0].depe_id;
                });
            //alert(url);
        },
        agregarreferenias() {
            // aqui hacemos la consulta para averiguar el doc. si existe, de lo contrario permanecera como sigue.
            //camporeferencia

            var textfere = null; // 
            var cpmrefe = this.formdocumentos.camporeferencia;

            var url = '/buscaregdoc/' + cpmrefe;

            axios
                .get(url)
                .then(response => {
                    textfere = response.data.resultado;
                    cpmrefe = response.data.codigo;

                    const thtml = {
                        coddoc: cpmrefe,
                        value: textfere
                    }
                    let jsonthtml = '{"coddoc":"' + cpmrefe + '","value":"' + textfere + '"}';

                    if (cpmrefe != '0') {
                        this.formdocumentos.array_referencias.push(thtml);
                        this.formdocumentos.json_referencias.push(jsonthtml);
                    }

                }).catch(error => {
                    cpmrefe = 0;
                    textfere = null;
                    const thtml = {
                        coddoc: cpmrefe,
                        value: textfere
                    }
                    let jsonthtml = '{"coddoc":"' + cpmrefe + '","value":"' + textfere + '"}';
                    this.formdocumentos.array_referencias.push(thtml);
                    this.formdocumentos.json_referencias.push(jsonthtml);
                })

            this.formdocumentos.camporeferencia = '';
        },
        eliminarefe(valor) {

            this.formdocumentos.array_referencias.splice(valor, 1);
            this.formdocumentos.json_referencias.splice(valor, 1);
        },
        agregarderivacion() {
            const vforma = this.formdocumentos.formaderivacion;
            const vcodigoofcina = this.formdocumentos.cod_unidad;
            const vnomoficina = this.formdocumentos.unidadorganica;
            const vdetalle = this.formdocumentos.detalle;
            const vcoduser = this.formdocumentos.usuario;
            const vnombreuser = this.formdocumentos.firmadestino;
            const vproveido = this.formdocumentos.proveido;
            var vtextforma = '';
            if (vforma == false) {
                vtextforma = 'ORIGINAL';
            } else {
                vtextforma = 'COPIA';
            }

            if (vcodigoofcina && vproveido) {
                let vhtml = {
                    'forma': vforma,
                    'textforma': vtextforma,
                    'codigo': vcodigoofcina,
                    'vnomoficina': vnomoficina,
                    'vdetalle': vdetalle,
                    'vcoduser': vcoduser,
                    'vnombreuser': vnombreuser,
                    'vproveido': vproveido
                };
                let Jsonvhtml = '{"forma":"' + vforma + '","vtextforma":"' + vtextforma + '","vcodigoofcina":"' + vcodigoofcina + '","vnomoficina":"' + vnomoficina + '","vdetalle":"' + vdetalle + '","vcoduser":"' + vcoduser + '","vnombreuser":"' + vnombreuser + '","vproveido":"' + vproveido + '"}';

                this.formdocumentos.derivaciones.push(vhtml);
                this.formdocumentos.json_derivaciones.push(Jsonvhtml);
                this.showtabladerivaciones = true;
            }

            this.formdocumentos.detalle = '';
            this.formdocumentos.usuario = '';
            //this.formdocumentos.firmadestino='';
            this.formdocumentos.proveido = '';

        },
        eliminaderivacion(idder) {
            this.formdocumentos.derivaciones.splice(idder, 1);
            this.formdocumentos.json_derivaciones.splice(idder, 1);
        },
        // carga de archivos word o pdf
        handleFilesUpload(event) {
            let uploadedFiles = event.target.files;

            /*
            Adds the uploaded file to the files array
            */
            for (var i = 0; i < uploadedFiles.length; i++) {

                this.files.push(uploadedFiles[i]);
                this.btn_sincronizar = false
                this.btn_cargarpdf = false
                this.btn_cargarword = false
            }
        },

        /*
            Removes a select file the user has uploaded
        */
        removeFile(key) {
            this.files.splice(key, 1);
            this.btn_sincronizar = true
        },
        carganexos(event) {

            let uploadedFiles = event.target.files;

            /*
            Adds the uploaded file to the files array
            */
            for (var i = 0; i < uploadedFiles.length; i++) {
                // const ext=this.getFileExtension3(uploadedFiles[i].name);
                // const tam=this.tamaniofile(uploadedFiles[i].size);
                // const archivofile={'extension':ext,'nombrefile':uploadedFiles[i].name,'tamanio':uploadedFiles[i].size,'tamanio_desc':tam};
                this.anexosfiles.push(uploadedFiles[i]);
                this.btn_anexo = false
            }
        },
        removeFileanexos(key) {
            this.anexosfiles.splice(key, 1);
            this.btn_anexo = true
        },
        getFileExtension3(filename) {
            return filename.slice((filename.lastIndexOf(".") - 1 >>> 0) + 2);
        },
        tamaniofile(tamanio) {
            var sizeByte = tamanio;
            if (sizeByte >= 1024) {
                var sizekiloBytes = parseFloat(sizeByte / 1024).toFixed(2);
                if (sizekiloBytes >= 1024) {
                    var sizeMegaBytes = parseFloat(sizekiloBytes / 1024).toFixed(2);
                    var tamanio = sizeMegaBytes + 'MB'
                } else {
                    var tamanio = sizekiloBytes + 'KB'
                }
            } else {
                var tamanio = sizeByte + 'Bytes'
            }

            return tamanio;

        },

        generar_tramite() {

            //let formData = new FormData();
            let formData = new FormData()
            /*
                Iterate over any file sent over appending the files
                to the form data.
            */
            // carga el pdf principal
            for (var i = 0; i < this.files.length; i++) {
                let file = this.files[i];
                formData.append('files[' + i + ']', file, file.name); // archivo del documento principal
                //alert(file.name);
            }
            // carga el pdf anexos
            for (var i = 0; i < this.anexosfiles.length; i++) {
                let file = this.anexosfiles[i];
                formData.append('anexosfiles[' + i + ']', file, file.name); // anexos del documento
                //alert(file.name);
            }

            // para derivaciones
            for (var i = 0; i < this.formdocumentos.json_derivaciones.length; i++) {
                let deriv = this.formdocumentos.json_derivaciones[i];
                formData.append('derivaciones[' + i + ']', deriv); // anexos del documento
                //alert(file.name);
            }

            // para doucumento referencias
            for (var i = 0; i < this.formdocumentos.json_referencias.length; i++) {
                let refe = this.formdocumentos.json_referencias[i];
                formData.append('referencias[' + i + ']', refe); // anexos del documento
                //alert(file.name);
            }

            // VALORES PARA CREAR NUEVO TRAMITE
            formData.append("fexpediente", this.formdocumentos.expediente); // numero de expediente
            //formData.append("freferencias", this.formdocumentos.json_referencias); // arreglo de referencias
            formData.append("ffrregistro", this.formdocumentos.frregistro); // forma de registro
            formData.append("fcodigounidad", this.formdocumentos.codigounidad); // captura de tabla admin a donde pertenece el usuario
            formData.append("fnombre_oficina", this.formdocumentos.nombre_oficina); // nombre de la oficina de origen del documento SUB GERENCIA DE MODERNIZACION ....
            formData.append("ftipotramite", this.formdocumentos.tipotramite); //o: represnetante oficina 1: tramite personal
            formData.append("fidusercreador", this.formdocumentos.idusercreador); // id del usuario quien realiza el tramite
            formData.append("ffirma", this.formdocumentos.firma); // del quien crea el documento
            formData.append("fcargo", this.formdocumentos.cargo); // cargo del que crea el documento

            formData.append("ffirmadestino", this.formdocumentos.firmadestino); //firma de destino
            formData.append("fcargodestino", this.formdocumentos.cargodestino); // cargo destino

            formData.append("ffechatramite", this.formdocumentos.fechatramite); // fecha del tramite
            formData.append("ftipodocumento", this.formdocumentos.tipodocumento); //codigo del tipo de documento
            formData.append("fcorrelativodoc", this.formdocumentos.correlativodoc); // correlativo del numero de documento
            formData.append("fsiglasdoucmento", this.formdocumentos.siglasdoucmento); // siglas de documento 2022-GRH-GRPPAT/SGMTD
            formData.append("fclavedoc", this.formdocumentos.clavedoc); // dclave que va en word y pdf
            formData.append("fformarecepcion", this.formdocumentos.formarecepcion); //1 directa
            formData.append("fprioridad", this.formdocumentos.prioridad); //1 normal
            formData.append("ffolios", this.formdocumentos.folios); // folios de doc
            formData.append("fasunto", this.formdocumentos.asunto); // asunto del tramite
            formData.append("fformaderivacion", this.formdocumentos.formaderivacion); //false=original/ true=copia
            formData.append("fcod_unidad", this.formdocumentos.cod_unidad); // codigo unidad a donde derviva
            formData.append("funidadorganica", this.formdocumentos.unidadorganica); // nombre unidad a quien se deriva
            formData.append("fdetalle", this.formdocumentos.detalle); // 
            formData.append("fusuario", this.formdocumentos.usuario); //codigo de usuario a quien se deriva cuando es en la misma unidad
            formData.append("fproveido", this.formdocumentos.proveido); // proveido destino
            //formData.append("fderivaciones", this.formdocumentos.derivaciones); // las unidades dondde derivaran respectivas unidades
            formData.append("fnombredoc_export", this.nombredoc_export); // nombre del documento a exportar

            // FIN DE VALORES

            var url = '/generacionnuevotramite';

            this.isDisabled_btngenerar = true
            this.valida_tipodoc = this.formdocumentos.tipodocumento ? '' : 'is-invalid'; //
            this.valida_folios = this.formdocumentos.folios.length > 0 ? '' : 'is-invalid'; //
            this.valida_asunto = this.formdocumentos.asunto.length > 0 ? '' : 'is-invalid'; //

            if (!this.valida_tipodoc && !this.valida_folios && !this.valida_asunto) { // verificamos de que no haya errorres o campos vacios requeridos

                axios.post(url, formData, {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    })
                    .then(response => {
                        console.log(response.data);
                        // mostramos el success de la creacion del documento

                        this.ArchivoFirma = response.data.archivoFirma
                        this.Existe = response.data.existe
                        this.idfile = response.data.idfile
                        this.idtramdoc = response.data.idtramitedoc

                        if (this.Existe == 1) {
                            this.EstadoFirma = true
                            this.btngenerartramite = false
                            this.btngenerarnewtramite = true
                        } else {
                            this.EstadoFirma = false
                        }
                        this.toast('Fue generado su trámite exitosamente', 'success');
                        this.tipostramite();
                        //location.reload();
                    })
                    .catch(function () {
                        console.log('FAILURE!!');
                    });

                // this.toast('Tramite generado','Fue generado su trámite exitosamente','success');

                // this.$bvModal.show('resumennewdoc');

            } else {
                this.toast('Algunos campos son obligatorios', 'error');
            }

        },
        generarnuevotramite() {
            location.reload();
        },

        firmadigital(documento) {

            this.$refs.foo.initInvoker('W', documento)
        },

        firmado() {
            //this.buscarDocumentos()
        },

        verpdf() {
            this.mostrarpdf = true;
            this.mostrarposicionfrima = false;
        },
        ocultarpdf() {
            this.mostrarpdf = false;
            this.mostrarposicionfrima = true;
        },

    }
}
</script>

<style lang="css" scoped>
.form-group {
    margin-bottom: 0rem !important;
}

.el-select {
    width: 100% !important;

}

.elementsm {
    height: 30px !important;
    line-height: 30px !important;
    font-size: 0.7875rem !important;
}

.progress-xs {
    height: 7px !important;
}

.amayusculas {
    text-transform: uppercase;
}
</style>
