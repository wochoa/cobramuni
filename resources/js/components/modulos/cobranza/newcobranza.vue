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
                        <form @submit.prevent="Guardarpagos">
                            <div class="card-body">

                                <div class="row">

                                    <div class="col-md-4 border-right">
                                        <!-- <div class="form-group">
                                            <label for="">Seleccione formato</label>
                                            <select class="form-control form-control-sm" v-model="idformato" @change="numeracion()" required>
                                                <option v-for="lis in listaformatos" :value="lis.idformato">{{ lis.nomformato }}</option>
                                            </select>
                                        </div> -->
                                        <div class="form-group row">
                                            <label for="" class="col-sm-4">RECIBO CAJA N°</label>
                                            <div class="col-sm-5">
                                                <input type="text" placeholder="2022-007454" class="form-control form-control-sm" v-model="codenumeracion" :disabled="numreaciondisabled == 1">
                                            </div>
                                            <div class="col-sm-3">                                               
                                                <el-checkbox v-model="manual" @change="habilitarecibo()">Manual</el-checkbox>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="" class="col-sm-4">FECHA DE EMISION:</label>
                                            <div class="col-sm-8">
                                                <input type="date" placeholder="2022-007454" class="form-control form-control-sm" v-model="fechacobranza">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="" class="col-sm-4">RUC/DNI:</label>
                                            <div class="col-sm-6">
                                                <input type="number" placeholder="Nro doc" class="form-control form-control-sm" v-model="nrodocumento" @keyup.enter="consultadoc" required>
                                            </div>
                                            <div class="col-sm-2">
                                                <button type="button" class="btn btn-primary btn-sm" @click.prevent="consultadoc"><i class="fa fa-search"></i></button>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="">NOMBRE O RAZON SOCIAL:</label>
                                            <input type="text" placeholder="Nombre o razon social" v-model="nombreorazon" class="form-control form-control-sm text-uppercase" required>

                                        </div>
                                    </div>

                                    <div class="col-md-8">
                                        <div class="fom-group row border-bottom pb-2">
                                            <label for="" class="col-sm-3">Buscar concepto</label>
                                            <div class="col-sm-7">
                                                <el-select v-model="idconceptos" filterable placeholder="Seleccione el concepto" @change="datosconceptoxitem" size="small" style="width: 100%;">
                                                    <!-- <select class="form-control form-control-sm" v-model="idconceptos" @change="datosconceptoxitem"> -->
                                                    <el-option v-for="con in listaconceptos" :key="con.idconceptocobranza" v-if="con.estado_concepto==1" :label="con.text_concepto" :value="con.idconceptocobranza">
                                                    </el-option>

                                                    <!-- <option v-for="con in listaconceptos" :value="con.idconceptocobranza">{{ con.text_concepto }} ({{ con.nomto_concepto }})</option> -->
                                                </el-select>
                                            </div>
                                            <div class="col-sm-2">
                                                <button class="btn btn-primary btn-sm" @click.prevent="agregarlista"><i class="fa-solid fa-plus"></i> Agregar</button>
                                            </div>
                                        </div>
                                        <div class="row border-bottom pb-2" style="display: none;">
                                            <div class="col-sm-8">
                                                <div class="form-group">
                                                    <label for="">Concepto:</label>
                                                    <input type="text" class="form-control form-control-sm" v-model="concepto.text_conceptoc">
                                                </div>
                                            </div>
                                            <div class="col-sm-2">
                                                <div class="form-group">
                                                    <label for="">Monto:</label>
                                                    <input type="number" class="form-control form-control-sm" v-model="concepto.nomto_conceptoc" step="any">
                                                </div>
                                            </div>
                                            <div class="col-sm-2 mt-4">
                                                <button class="btn btn-primary btn-sm" @click.prevent="agregarlista"><i class="fa-solid fa-plus"></i> Agregar</button>
                                            </div>
                                        </div>

                                        <div class="form-group row mt-2 p-2" v-show="showtablaconcepto">
                                            <table id="tabla" class="table table-bordered table-hover table-sm">
                                                <thead>
                                                    <tr class="bg-info disabled color-palette">
                                                        <th><small>N</small></th>
                                                        <th><small>CONCEPTO</small></th>
                                                        <th><small>TOTAL</small></th>

                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr v-for="(der, index) in array_concepto">

                                                        <td><small>{{ index+1}}</small></td>
                                                        <td><small>{{ der.textconcepto }}</small></td>
                                                        <td><small>{{ der.montoconcepto }}</small></td>

                                                        <td><button class="btn btn-default btn-sm" @click.prevent="eliminaconceptolista(index)"><i class="fa-solid fa-trash-can"></i></button>
                                                            <button class="btn btn-default btn-sm" @click.prevent="editarconcepto(index,der.textconcepto,der.montoconcepto,der.idconcepto,der.idformato)"><i class="fa-solid fa-edit"></i></button>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="gorup row">
                                            <div class="col-sm-12">
                                                <strong>Suma:</strong> {{ sumPrecios(array_concepto).toFixed(2) }}
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer justify-content-right">
                                <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button> -->
                                <button type="submit" class="btn btn-warning"><i class="fa-solid fa-piggy-bank"></i> Realizar cobro</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>

        <!-- RESULTADO DE LA CREACION DE Documento -->
        <!-- Modal -->
        <div class="modal fade" id="resultadodoc" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">IMPRIMIR COBRANZA</h5>
                        <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button> -->
                    </div>
                    <div class="modal-body">
                        <div class="group row">
                            <div class="col-sm-3"><strong>DNI/RUC:</strong></div>
                            <div class="col-sm-9">{{ nrodocumento }}</div>
                        </div>
                        <div class="group row">
                            <div class="col-sm-6"><strong>NOMBRE O RAZON SOCIAL:</strong></div>
                            <div class="col-sm-6">{{ nombreorazon }}</div>
                        </div>
                        <div class="group row">
                            <!-- <div class="col-sm-3">CONCEPTO:</div> -->
                            <table id="tabla" class="table table-bordered table-hover table-sm">
                                <thead>
                                    <tr class="bg-info disabled color-palette">
                                        <th><small>N</small></th>
                                        <th><small>CONCEPTO</small></th>
                                        <th><small>TOTAL</small></th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(der, index) in array_concepto">

                                        <td><small>{{ index+1}}</small></td>
                                        <td><small>{{ der.textconcepto }}</small></td>
                                        <td><small>{{ der.montoconcepto }}</small></td>

                                        <td>
                                            <button class="btn btn-default btn-sm" @click.prevent="eliminaconceptolista(index)"><i class="fa-solid fa-trash-can"></i></button>

                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
                        <a class="btn btn-outline-primary" :href="'/cobranzas/nuevo'"><i class="fa-regular fa-file fa-2x"></i><br>Nueva cobranza</a>
                        <a class="btn btn-outline-danger" :href="'/imprimecobranza/'+idcobranza" target="_blank"> <i class="fa-regular fa-file-pdf fa-2x"></i><br>Imprimir</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- editar concepto -->
        <div class="modal fade" id="editarconceptoUP" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">EDITAR ITEM</h5>
                        <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button> -->
                    </div>
                    <div class="modal-body">

                        <div class="from-group">
                            <label for="">Concepto</label>
                            <textarea v-model="editarconceptos.concepto" cols="30" rows="4" class="form-control form-control-sm"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="">De cuantos años pagará:</label>
                            <input type="number" class="form-control form-control-sm" v-model="concepto.num_anios" step="any">

                            <div v-if="concepto.num_anios>1">
                                <label for="">Ingrese los montos</label>
                                <div v-if="concepto.num_anios==2">
                                    <input type="number" class="form-control form-control-sm mb-1" v-model="concepto.monto1" step="any" placeholder="S/.Monto1" @keyup="sumatotal">
                                    <input type="number" class="form-control form-control-sm mb-1" v-model="concepto.monto2" step="any" placeholder="S/.Monto2" @keyup="sumatotal">
                                </div>
                                <div v-if="concepto.num_anios==3">
                                    <input type="number" class="form-control form-control-sm mb-1" v-model="concepto.monto1" step="any" placeholder="S/.Monto1" @keyup="sumatotal">
                                    <input type="number" class="form-control form-control-sm mb-1" v-model="concepto.monto2" step="any" placeholder="S/.Monto2" @keyup="sumatotal">
                                    <input type="number" class="form-control form-control-sm mb-1" v-model="concepto.monto3" step="any" placeholder="S/.Monto3" @keyup="sumatotal">
                                </div>
                                <div v-if="concepto.num_anios==4">
                                    <input type="number" class="form-control form-control-sm mb-1" v-model="concepto.monto1" step="any" placeholder="S/.Monto1" @keyup="sumatotal">
                                    <input type="number" class="form-control form-control-sm mb-1" v-model="concepto.monto2" step="any" placeholder="S/.Monto2" @keyup="sumatotal">
                                    <input type="number" class="form-control form-control-sm mb-1" v-model="concepto.monto3" step="any" placeholder="S/.Monto3" @keyup="sumatotal">
                                    <input type="number" class="form-control form-control-sm mb-1" v-model="concepto.monto4" step="any" placeholder="S/.Monto4" @keyup="sumatotal">
                                </div>
                                <div v-if="concepto.num_anios==5">
                                    <input type="number" class="form-control form-control-sm mb-1" v-model="concepto.monto1" step="any" placeholder="S/.Monto1" @keyup="sumatotal">
                                    <input type="number" class="form-control form-control-sm mb-1" v-model="concepto.monto2" step="any" placeholder="S/.Monto2" @keyup="sumatotal">
                                    <input type="number" class="form-control form-control-sm mb-1" v-model="concepto.monto3" step="any" placeholder="S/.Monto3" @keyup="sumatotal">
                                    <input type="number" class="form-control form-control-sm mb-1" v-model="concepto.monto4" step="any" placeholder="S/.Monto4" @keyup="sumatotal">
                                    <input type="number" class="form-control form-control-sm mb-1" v-model="concepto.monto5" step="any" placeholder="S/.Monto5" @keyup="sumatotal">
                                </div>

                            </div>

                        </div>
                        <div class="from-group">
                            <label for="">Monto</label>
                            <input type="number" class="form-control" v-model="editarconceptos.monto">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" @click="actualizaedit"><i class="fa-regular fa-file"></i> Actualizar</button>
                        <!-- <a class="btn btn-outline-danger" :href="'/imprimecobranza/'+idcobranza" target="_blank"> <i class="fa-regular fa-file-pdf fa-2x"></i><br>Imprimir</a> -->
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
    name: 'Cobranzas',

    data() {
        return {
            listaconceptos: [],
            // listaformatos: [],
            idformato: null,
            idconceptos: null,
            fechacobranza: null,
            manual: false,
            anioactual: null,
            codenumeracion: null,
            numreaciondisabled:1,
            concepto: {
                idconceptoc: null,
                text_conceptoc: null,
                nomto_conceptoc: null,
                num_anios: 1,
                sumamontos: 0,
                monto1: 0,
                monto2: 0,
                monto3: 0,
                monto4: 0,
                monto5: 0
            },
            editarconceptos: {
                index: null,
                concepto: null,
                monto: 0
            },
            Json_concepto: [],
            array_concepto: [],
            showtablaconcepto: false,
            nrodocumento: null, //nro de DNI o NRO RUC
            nombreorazon: '',
            importetotal: 0,
            idcobranza: null

        };
    },

    mounted() {
        this.alllistaconceptos();
        // this.allformatos();
        this.fechasistema();
        this.numeracion();
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
        // allformatos() {
        //     var url = '/listaformatos';
        //     axios.get(url)
        //         .then(response => {
        //             this.listaformatos = response.data;
        //         });
        // },
        alllistaconceptos() {
            var url = '/conceptocobranzas';
            axios.get(url)
                .then(response => {
                    this.listaconceptos = response.data;
                });
        },
        agregarlista() {

            let vhtml = {
                'idconcepto': this.idconceptos,
                'idformato': this.idformato,
                'textconcepto': this.concepto.text_conceptoc,
                'montoconcepto': this.concepto.nomto_conceptoc,

            };

            let Jsonvhtml = '{"idconcepto":"' + this.idconceptos + '","idformato":"' + this.idformato + '","textconcepto":"' + this.concepto.text_conceptoc + '","montoconcepto":"' + this.concepto.nomto_conceptoc + '"}';

            if (this.idconceptos != null) {
                this.array_concepto.push(vhtml);

                this.Json_concepto.push(Jsonvhtml);
                this.showtablaconcepto = true;
            }
            this.idconceptos = null

        },
        sumatotal() {
            const num = parseFloat(this.concepto.monto1) + parseFloat(this.concepto.monto2) + parseFloat(this.concepto.monto3) + parseFloat(this.concepto.monto4) + parseFloat(this.concepto.monto5)
            this.editarconceptos.monto = num.toFixed(2);
        },
        sumPrecios(items) {
            return items.reduce((a, b) => {
                return a + Number(b['montoconcepto']);
            }, 0);
        },
        eliminaconceptolista(idder) {
            this.array_concepto.splice(idder, 1);
            this.Json_concepto.splice(idder, 1);
        },
        datosconceptoxitem() {
            var url = '/conceptocobranzas/' + this.idconceptos
            axios.get(url)
                .then(response => {
                    this.concepto.idconceptoc = response.data[0].idconceptocobranza;
                    this.concepto.text_conceptoc = response.data[0].text_concepto;
                    this.concepto.nomto_conceptoc = response.data[0].nomto_concepto;
                })
        },
        editarconcepto(indice, concepto, monto, idconcep, idofrm) {
            this.editarconceptos.index = indice
            this.editarconceptos.concepto = concepto
            this.editarconceptos.monto = monto
            this.idconceptos = idconcep
            this.idformato = idofrm

            $('#editarconceptoUP').modal({
                backdrop: 'static',
                keyboard: false
            })
        },
        actualizaedit() {
            this.array_concepto[this.editarconceptos.index].textconcepto = this.editarconceptos.concepto
            this.array_concepto[this.editarconceptos.index].montoconcepto = this.editarconceptos.monto

            this.Json_concepto[this.editarconceptos.index] = '{"idconcepto":"' + this.idconceptos + '","idformato":"' + this.idformato + '","textconcepto":"' + this.editarconceptos.concepto + '","montoconcepto":"' + this.editarconceptos.monto + '"}'; //this.editarconceptos.concepto

            //alert(this.array_concepto[ this.editarconceptos.index].textconcepto);
            $('#editarconceptoUP').modal("hide")
            this.limpiaformulario();
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
        numeracion() {
            var url = '/cobranzasid'
            axios.get(url)
                .then(response => {
                    //console.log(response.data)
                    this.codenumeracion = this.anioactual + '-' + this.zfill(response.data, 6);
                })
            //this.alllistaconceptos();
        },
        limpiaformulario() {
            this.concepto.idconceptoc = ''
            this.concepto.text_conceptoc = ''
            this.concepto.nomto_conceptoc = ''
            this.concepto.num_anios = 1

            this.concepto.monto1 = 0
            this.concepto.monto2 = 0
            this.concepto.monto3 = 0
            this.concepto.monto4 = 0
            this.concepto.monto5 = 0
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
        consultadoc() {
            if (this.nrodocumento.length <= 8) {

                if (this.nrodocumento.length == 8) {
                    this.consultadni(this.nrodocumento)
                } else {
                    alert('No corresponde a Nro. DNI')
                }
            } else {
                if (this.nrodocumento.length == 11) {
                    this.consultaruc(this.nrodocumento)
                } else {
                    alert('No corresponde a Nro. RUC')
                }
            }
        },
        consultadni(dni) {
            var url = '/reniec/' + dni
            axios.get(url)
                .then(response => {
                    this.nombreorazon = response.data.nombres + ' ' + response.data.apellidoPaterno + ' ' + response.data.apellidoMaterno
                })
        },
        consultaruc(ruc) {

            var url = '/ruc/' + ruc
            axios.get(url)
                .then(response => {
                    //this.nombreorazon = response.data.ddp_nombre
                    console.log(response.data)
                    this.nombreorazon = response.data.nombre
                })

        },

        Guardarpagos() {
            //let formData = new FormData();
            let formData = new FormData()

            // para conceptos
            for (var i = 0; i < this.Json_concepto.length; i++) {
                let concept = this.Json_concepto[i];
                formData.append('conceptos[' + i + ']', concept); // anexos del documento
                //alert(file.name);
            }

            if (this.nrodocumento.length > 8) {
                formData.append("ruc", this.nrodocumento);
                formData.append("dni", null);
            } else {
                formData.append("dni", this.nrodocumento);
                formData.append("ruc", null);
            }
            var monto = this.sumPrecios(this.array_concepto).toFixed(2);

            formData.append("idtipoformato", this.idformato); // forma de registro
            formData.append("codigorecibo", this.codenumeracion); // numeraciuon de recibo
            var tipomanual=this.manual?'-M':''
            // alert(tipomanual)
            formData.append("manual", tipomanual); // identificador manual
            formData.append("fechaemision", this.fechacobranza); // captura de tabla admin a donde pertenece el usuario

            formData.append("nom_razonsocial", this.nombreorazon); // captura de tabla admin a donde pertenece el usuario
            formData.append("montonumero", monto); // montonumero

            var url = '/generarcobranza';

            axios.post(url, formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then(response => {
                    console.log(response.data);
                    // mostramos el success de la creacion del documento
                    this.idcobranza = response.data
                    this.toast('Fue generado la cobranza exitosamente', 'success');

                    // $("#resultadodoc").modal("show");
                    $('#resultadodoc').modal({
                        backdrop: 'static',
                        keyboard: false
                    })
                    // var status = document.querySelector('#resultadodoc')
                    // status.style.display = ''

                })
                .catch(function () {
                    console.log('FAILURE!!');
                });
        },
        habilitarecibo()
        {
            
            if(this.manual==true){
                this.codenumeracion = this.codenumeracion +'-M';
                this.numreaciondisabled=0;
            }
            else{
                 this.numeracion();
                 this.numreaciondisabled=1;
            }
        }

    },
};
</script>

<style lang="scss" scoped>

</style>
