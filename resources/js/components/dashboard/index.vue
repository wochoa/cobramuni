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
            <!-- Info boxes -->
            <div class="row">
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-info elevation-1"><i class="fa-solid fa-sack-dollar"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">TOTAL DE COBRANZAS</span>
                            <span class="info-box-number">
                                <small>S/. </small>{{ formatomoneda(resumen.totalcobranzas) }}
                                <!-- <small>%</small> -->
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-danger elevation-1"><i class="fa-solid fa-sack-xmark"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">TOTAL COBRANZAS ANULADAS</span>
                            <span class="info-box-number">{{ formatomoneda(resumen.anuladas) }}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->

                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-warning elevation-1"><i class="fa-solid fa-receipt"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">TOTAL CONCEPTOS</span>
                            <span class="info-box-number">{{ resumen.totalconcepto }}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->

                <!-- fix for small devices only -->
                <div class="clearfix hidden-md-up"></div>

                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-success elevation-1"><i class="fa-solid fa-list"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">TOTAL DE CLASIFICADORES</span>
                            <span class="info-box-number">{{ resumen.totalclasificadores }}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <!-- <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">TOTAL DE USUARIOS</span>
                            <span class="info-box-number">{{ resumen.totalusuarios }}</span>
                        </div>
                       
                    </div>
                    
                </div> -->
                
            </div>

            <div class="row">
                <div class="col-sm-9">
                    <div class="card pt-3 pb-3">
                        <div class="row ">

                            <div class="col-md-4" align="center">

                                <!-- <router-link :to="'/'" class="text-decoration-none"> -->
                                <h5>Cobranzas formato 8</h5>
                                <radial-progress-bar :diameter="180" :completed-steps="resumen.totalformato8s" :total-steps="resumen.totalcobranzas == 0 ? 1 : resumen.totalcobranzas" startColor="#20c997" stopColor="#20c997" innerStrokeColor="#d3d3d3" stroke-linecap="round">

                                    <p><strong>Total S/. </strong> <br>{{ formatomoneda(resumen.totalcobranzas) }}</p>
                                    <p><strong>Formato 8 S/. </strong><br>{{ formatomoneda(resumen.totalformato8s) }}</p>

                                    <!-- <strong>Pendientes: </strong>{{ getInicio.usuarioProceso - getInicio.usuarioDerivadosProceso }} -->

                                </radial-progress-bar>
                                <!-- </router-link> -->

                            </div>

                            <div class="col-md-4" align="center">

                                <!-- <router-link :to="'/'" class="text-decoration-none"> -->
                                <h5>Cobranzas formato 9</h5>
                                <radial-progress-bar :diameter="180" :completed-steps="resumen.totalformato9s" :total-steps="resumen.totalcobranzas == 0 ? 1 : resumen.totalcobranzas" startColor="#6f42c1" stopColor="#6f42c1" innerStrokeColor="#d3d3d3">
                                    <p><strong>Total S/. </strong> <br>{{ formatomoneda(resumen.totalcobranzas) }}</p>
                                    <p><strong>Formato 9 S/. </strong><br>{{ formatomoneda(resumen.totalformato9s) }}</p>
                                </radial-progress-bar>
                                <!-- </router-link> -->

                            </div>
                            <div class="col-md-4" align="center">

                                <!-- <router-link :to="'/'" class="text-decoration-none"> -->
                                <h5>Cobranzas anuladas</h5>
                                <radial-progress-bar :diameter="180" :completed-steps="resumen.anuladas" :total-steps="resumen.totalcobranzas == 0 ? 1 : resumen.totalcobranzas" startColor="#dc3545" stopColor="#dc3545" innerStrokeColor="#d3d3d3">
                                    <p><strong>Total S/. </strong> <br>{{ formatomoneda(resumen.totalcobranzas) }}</p>
                                    <p><strong>Anuladas S/. </strong><br>{{ formatomoneda(resumen.anuladas) }}</p>
                                </radial-progress-bar>
                                <!-- </router-link> -->

                            </div>

                        </div>
                    </div>
                </div>
                <!-- <div class="col-sm-6">
                    <div class="card">
                        <apexchart type="line" height="350" :options="chartOptions" :series="series"></apexchart>
                    </div>
                </div> -->
            </div>

            <!-- <div class="row">
                <div class="col-md-3">
                    <small class="bg-info pl-2 pr-2 rounded">Total Documento ingresado MPV: {{ getInicio.totalMpv }}</small><br>
                    <small class="bg-warning pl-2 pr-2 rounded">Documento ingresado MPV para el Usuario: {{ getInicio.usuariosMpv }}</small>
                </div>
            </div> -->
        </div>
    </div>
    <!-- /.content -->

</div>
</template>

<script>
import RadialProgressBar from 'vue-radial-progress'

import apexchart from 'vue-apexcharts'

export default {
    name: 'StdvIndex',

    data() {
        return {
            completedSteps: 5,
            totalSteps: 10,
            gradientAnimation: 10,

            resumen: {
                totalcobranzas: 0,
                totalconcepto: 0,
                totalformatos: 0,
                totalclasificadores: 0,
                totalusuarios: 0,
                totalformato8s: 0,
                totalformato9s: 0,
                // min_monto:0,
                // max_monto:0,
                anuladas: 0
            },
            ///
            series: [{
                    name: "Fomrato 8",
                    data: [28, 29, 33, 36, 32, 32, 33]
                },
                {
                    name: "Formato 9",
                    data: [12, 11, 14, 18, 17, 13, 13]
                }
            ],
            chartOptions: {
                chart: {
                    height: 350,
                    type: 'line',
                    dropShadow: {
                        enabled: true,
                        color: '#000',
                        top: 18,
                        left: 7,
                        blur: 10,
                        opacity: 0.2
                    },
                    toolbar: {
                        show: false
                    }
                },
                colors: ['#77B6EA', '#545454'],
                dataLabels: {
                    enabled: true,
                },
                stroke: {
                    curve: 'smooth'
                },
                title: {
                    text: 'Avance de cobranzas',
                    align: 'left'
                },
                grid: {
                    borderColor: '#e7e7e7',
                    row: {
                        colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                        opacity: 0.5
                    },
                },
                markers: {
                    size: 1
                },
                xaxis: {
                    categories: ['Mar', 'Apr', 'May', 'Jun', 'Jul', 'Ago', 'Set', 'Oct', 'Nov', 'Dic'],
                    title: {
                        text: 'Month'
                    }
                },
                yaxis: {
                    title: {
                        text: 'Cobranzas'
                    },
                    min: 5,
                    max: 40
                },
                legend: {
                    position: 'top',
                    horizontalAlign: 'right',
                    floating: true,
                    offsetY: -25,
                    offsetX: -5
                }
            },

        };
    },

    components: {
        RadialProgressBar,
        apexchart
    },

    mounted() {
        // this.datosparagrafico();
        this.cargaresumen();

    },

    methods: {

        cargaresumen() {
            var url = '/resumen';
            axios.get(url)
                .then(response => {
                    var datos = response.data.datos;
                    console.log(response.data.totalcobranza)
                    this.resumen.totalcobranzas = parseFloat(response.data.totalcobranza);
                    this.resumen.totalconcepto = response.data.totalconceptos;
                    this.resumen.totalformatos = response.data.totalformato;
                    this.resumen.totalclasificadores = response.data.totalclasificador;
                    this.resumen.totalusuarios = response.data.totalusuarios;
                    this.resumen.totalformato8s = parseFloat(response.data.totalformato8);
                    this.resumen.totalformato9s = parseFloat(response.data.totalformato9);
                    // this.resumen.min_monto=parseFloat(response.data.minimo_monto);
                    // this.resumen.max_monto=parseFloat(response.data.maximo_monto);
                    this.resumen.anuladas = parseFloat(response.data.anulada);
                });
        },
        formatomoneda(num) {
            const v = new Intl.NumberFormat('es-PE').format(num);
            return v;
        }

    },
};
</script>

<style lang="scss" scoped>
.col-centered {
    float: none;
    margin: 0 auto;
}
</style>
