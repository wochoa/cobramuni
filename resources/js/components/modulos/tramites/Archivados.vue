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
                <div class="col-lg-6 col-10">
                    <router-link :to="'/Tramites/Enproceso'" class="btn btn-info btn-sm"><i class="fa-regular fa-circle-left"></i> ir a documentos en proceso</router-link>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-12">
                    <div class="card card-primary card-outline ">
                        <div class="card-header p-1">
                            Documentos en proceso
                        </div>
                        <div class="card-body">

                            <!-- {{-- para las opciones de busqueda --}} -->
                            <div class="row  mb-2">
                                <div class="col-md-2">
                                    <div class="group">
                                        <label for="" class="text-sm">Registro</label>
                                        <input type="number" class="form-control form-control-sm">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="group">
                                        <label for="" class="text-sm">Documento del usuario</label>
                                        <select class="form-control form-control-sm">
                                            <option value="1">WILMER OCHOA ALVARADO</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="group">
                                        <label for="" class="text-sm">Estado documento</label>
                                        <select class="form-control form-control-sm">
                                            <option value="1">Todos</option>
                                            <option value="1">Pendiente</option>
                                            <option value="1">procesado</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="group">
                                        <label for="" class="text-sm">Tipo documento</label>
                                        <select class="form-control form-control-sm">
                                            <option value="1">Todos</option>
                                            <option value="1">Electronico</option>
                                            <option value="1">Manual</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2"><label for=""></label>
                                    <button type="button" class="btn btn-block btn-primary btn-sm mt-1"><i data-feather="search" class="me-25"></i> Buscar</button>
                                </div>
                            </div>
                            <div class="row form-group pt-2 border-top">
                                <div class="demo-inline-spacing">
                                    <button type="button" class="btn btn-outline-primary btn-sm "><i data-feather="corner-up-left" class="me-25"></i>Devolver a procesos</button>

                                </div>
                            </div>
                            <!-- {{-- para la relacion de datos --}} -->
                            <div class="row mt-2">
                                <table class=" table table-bordered table-condensed table-hover table-sm">
                                    <thead class="bg-lightblue  disabled color-palette pd-0">
                                        <tr class="info">
                                            <th style="width:7%">Registro</th>
                                            <th style="width:7%">Adjuntado al</th>
                                            <th style="width:16%">Archivador</th>
                                            <th style="width:40%">Documento</th>
                                            <th style="width:20%">Detalles</th>
                                            <th style="width:10%">Archivos</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td v-if="archivados.data.length == 0" colspan="21" class="text-center">
                                                No hay documentos, pruebe cambiando los filtros
                                            </td>
                                        </tr>
                                        <tr v-for="(documento, index) in archivados.data" :key="index" :class="docDevolveProceso.indexOf(documento.idoperacion) >= 0 ? 'danger' : null" @click="selectDevolverProceso(documento)">
                                            <td class="registro">
                                                <strong>Reg.</strong>
                                                <a href="#" @click.prevent.stop="buscarByDocumento({ iddocumento: documento.iddocumento, modal: true })">{{ ' ' + ('00000000' + documento.iddocumento).slice(-8) }}</a>
                                            </td>
                                            <td v-if="documento.oper_iddocumento_adj != null" class="registro">
                                                <strong>Reg.</strong>{{ ('00000000' + documento.oper_iddocumento_adj).slice(-8) }}
                                            </td>
                                            <td v-else class="registro">&nbsp;</td>
                                            <td v-if="documento.arch_nombre != null" class="registro">
                                                {{ documento.arch_periodo + ' / ' }}{{ documento.arch_nombre }}
                                            </td>
                                            <td v-else class="registro">&nbsp;</td>
                                            <td class="documento">
                                                <strong :class="$mq">Doc:</strong>
                                                <div v-if="documento.tdoc_descripcion != null" :class="$mq">
                                                    {{ documento.tdoc_descripcion + ' ' }}{{ ('000000' + documento.docu_numero_doc).slice(-6)
                  }}{{ documento.docu_origen == 1 ? '-' + documento.docu_fecha_doc.substr(0, 4) : ''
                  }}{{ documento.docu_siglas_doc != null ? '-' + documento.docu_siglas_doc : null }}
                                                </div>
                                                <div v-else :class="$mq">&nbsp;</div>
                                                <strong :class="$mq">Firma:</strong>
                                                <div :class="$mq">{{ documento.docu_firma }}</div>
                                                <strong :class="$mq">Cargo:</strong>
                                                <div :class="$mq">{{ documento.docu_cargo }}</div>
                                                <strong :class="$mq">Asunto:</strong>
                                                <div :class="$mq">{{ documento.docu_asunto }}</div>
                                                <strong :class="$mq">Dependencia:</strong>
                                                <div :class="$mq">{{ documento.depe_nombre }}</div>
                                            </td>
                                            <td>
                                                <strong :class="$mq">Detalle:</strong>{{ documento.oper_acciones }}<br />
                                                <strong :class="$mq">Fecha:</strong>{{ documento.fecha_archivado }}<br />
                                                <strong :class="$mq">Usuario:</strong>{{ documento.adm_name + ' ' }}{{ documento.adm_lastname }}
                                            </td>
                                            <td>
                                                <div v-if="documento.docu_archivo.length > 0">
                                                    <table>
                                                        <tbody>
                                                            <tr>
                                                                <td>
                                                                    <span v-if="documento.docu_digital" class="badge badge-info">Documento ingresado MPV</span>
                                                                    <span v-else class="badge badge-warning">Documento registrado internamente</span>
                                                                </td>
                                                            </tr>
                                                            <tr v-for="(archivo, indexArchivo) in documento.docu_archivo.filter(d => d.file_mostrar)" :key="indexArchivo">
                                                                <td>
                                                                    <button type="button" class="btn btn-xs btn-link doc-link" @click.stop="imprimirDocumentoPdf({id:archivo.id, id_documento:archivo.id_documento, file_tipo: archivo.file_tipo, file_name: archivo.file_name, tipo:1})">
                                                                        <span style="color:blue;font-size:80%">{{ getFormatBytes(archivo.file_size) }}</span>
                                                                        <span v-if="archivo.file_principal != null" :class="archivo.file_principal? 'badge badge-danger': 'badge badge-warning'">
                                                                            {{ archivo.file_principal?'P':'A' }}
                                                                        </span>
                                                                        <span :class=" archivo.file_tipo.indexOf('image') === 0? 'glyphicon glyphicon-picture': 'glyphicon glyphicon-file'"></span>
                                                                        {{ archivo.file_name }}
                                                                    </button>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->

</div>
</template>

<script>
export default {
    name: '',
    data() {
        return {
            puedeDevolver: true,
            formData: {
                oper_idusuario: this.usuario,
                idarch: null,
                iddocumento: null,
                oper_tarchi_id: null,
                page: null
            },
            archivados: {
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
            docDevolveProceso: [],
            mostrarDocumentos: true
        }
    },
    props: [],
    components: {

    },
    created() {},
    mounted() {},
    methods: {

    }
}
</script>

<style lang="css" scoped>

</style>
