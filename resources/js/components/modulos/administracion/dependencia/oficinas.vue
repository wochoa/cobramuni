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
              <li class="breadcrumb-item"><router-link :to="'/'">Dashboard</router-link></li>
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
               <router-link :to="'/Administracion/dependencia/'" class="btn btn-info btn-xs"><i class="fa-regular fa-circle-left"></i> Volver a dependencias</router-link>
                <router-link :to="'/Administracion/dependencia/oficinas-crear'" class="btn btn-success btn-xs"><i class="fa-solid fa-house-chimney-medical"></i> Nueva oficina</router-link>
            </div>                
        </div>
        <div class="row mt-2">
            <div class="col-md-12">
                <div class="card card-primary card-outline ">
                    <div class="card-header p-1">
                        Dependencias: <strong>{{ nombredepe }}</strong>
                    </div>
                    <div class="card-body">
                        
                        <!-- {{-- para las opciones de busqueda --}} -->
                        <div class="row  mb-2">
                            <div class="col-md-2">
                                <div class="group">
                                    <label for="" class="text-sm">Codigo oficina</label>
                                    <input type="number" class="form-control form-control-sm">
                                </div>
                            </div>
                            
                            <div class="col-md-8">
                                <div class="group">
                                    <label for="" class="text-sm">Nombre</label>
                                    <input type="text" class="form-control form-control-sm ">
                                </div>
                            </div>
                            <div class="col-md-2"><label for=""></label>
                                <button type="button"  class="btn btn-block btn-primary btn-sm mt-1" ><i data-feather="search" class="me-25"></i> Buscar</button>
                            </div>
                        </div>
                        <div class="row form-group pt-2 border-top">
                            <div class="demo-inline-spacing">
                                <ul class="pagination pagination-sm m-0 float-left">
                                    <li class="page-item" v-if="pagination.current_page > 1">
                                        <a class="page-link" href="#" @click.prevent="cambiopagina(pagination.current_page-1)">«</a>
                                    </li>

                                    <li class="page-item" v-if="pagination.current_page > 5">
                                        <a class="page-link" href="#" @click.prevent="cambiopagina(1)">1</a>
                                    </li>

                                    <!-- mostrar los puntos -->
                                    <li class="page-item" v-if="pagination.current_page > 5">
                                        <a class="page-link" >...</a>
                                    </li>

                                    <li class="page-item" v-for="page in pagesNumber" :key="page.id" :class="[page==isActived ? 'active':'']">
                                        <a class="page-link" href="#" @click.prevent="cambiopagina(page)">{{ page }}</a>
                                    </li>
                                    
                                    <!-- mostrar los puntos -->
                                    <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                        <a class="page-link" >...</a>
                                    </li>
                                    
                                    <!-- MOSTRAR LA ULTIMA PAGINA -->
                                    <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                        <a class="page-link" href="#" @click.prevent="cambiopagina(pagination.last_page)">{{ pagination.last_page }}</a>
                                    </li>

                                    <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                        <a class="page-link" href="#" @click.prevent="cambiopagina(pagination.current_page+1)">»</a>
                                    </li>
                                </ul>
                            
                            </div>
                        </div>
                        <!-- {{-- para la relacion de datos --}} -->
                        <div class="row mt-2">
                            <table  class=" table table-bordered table-condensed table-hover table-sm">
                                <thead class="bg-info  disabled color-palette pd-0">
                                    <tr  class="info">
                                        <th><small><strong>Codigo</strong></small></th> 
                                        <th><small><strong>NOMBRE OFICINA</strong></small></th> 
                                         
                                        <th><small><strong>ABREVIATURA</strong></small></th>
                                        <th><small><strong>REPRESENTANTE</strong></small></th> 
                                        <th><small><strong>DEPENDENCIA</strong></small></th>  
                                        
                                       
                                        <th><small><strong>ACCIONES</strong></small></th>
                                       
                                    </tr>
                                </thead> 
                                <tbody >
                                    <tr v-for="depe in dependencias" :key="depe.iddependencia">

                                        <td class="text-xs"><small>{{ depe.iddependencia }}</small></td>
                                        <td class="text-xs"><small>{{ depe.depe_nombre }} </small></td>
                                        <td class="text-xs"><small>{{ depe.depe_abreviado }}</small></td>
                                        <td class="text-xs"><small>{{ depe.depe_representante }}<br>CARGO: {{ depe.depe_cargo }}</small></td>
                                        
                                        <td class="text-xs"><small>{{ nombredepe }} </small></td>  
                                        
                                        <td class="text-center" nowrap>

                                            <!-- <router-link :to="{name:'Editar dependencias',params:{id:depe.iddependencia }}" class="btn btn-primary btn-xs"><i class="fa-solid fa-house-flag"></i> Editar</router-link> -->
                                            <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#modal-xl" @click.prevent="editandooficina(depe.iddependencia)">
                                              Editar oficina
                                            </button>
                                        </td>
                                        
                                    </tr> 
                                </tbody>
                            </table>

                            

                        </div>
                    </div>
                    <div class="card-footer clearfix">
                        <ul class="pagination pagination-sm m-0 float-left">
                            <li class="page-item" v-if="pagination.current_page > 1">
                                <a class="page-link" href="#" @click.prevent="cambiopagina(pagination.current_page-1)">«</a>
                            </li>

                            <li class="page-item" v-if="pagination.current_page > 5">
                                <a class="page-link" href="#" @click.prevent="cambiopagina(1)">1</a>
                            </li>

                            <!-- mostrar los puntos -->
                            <li class="page-item" v-if="pagination.current_page > 5">
                                <a class="page-link" >...</a>
                            </li>

                            <li class="page-item" v-for="page in pagesNumber" :key="page.id" :class="[page==isActived ? 'active':'']">
                                <a class="page-link" href="#" @click.prevent="cambiopagina(page)">{{ page }}</a>
                            </li>
                            
                            <!-- mostrar los puntos -->
                            <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                <a class="page-link" >...</a>
                            </li>
                            
                            <!-- MOSTRAR LA ULTIMA PAGINA -->
                            <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                <a class="page-link" href="#" @click.prevent="cambiopagina(pagination.last_page)">{{ pagination.last_page }}</a>
                            </li>

                            <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                <a class="page-link" href="#" @click.prevent="cambiopagina(pagination.current_page+1)">»</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->

    <!-- modales -->

    <div class="modal fade" id="modal-xl">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header pt-1 pb-0">
              <h5 class="modal-title">Edicion de la unidad : <strong>{{ filloficina.nombre_oficina }}</strong> </h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="form-group row">
                <div class="col-6">
                  <label for="">Nombre:</label>
                  <input type="text" name="" id="" class="form-control form-control-sm" v-model="filloficina.nombre_oficina">
                </div>
                <div class="col-3">
                  <label for="">Nombre Abreviado:</label>
                  <input type="text" name="" id="" class="form-control form-control-sm" v-model="filloficina.abreviado">
                </div>
                <div class="col-3">
                  <label for="">Siglas de Documentos:</label>
                  <input type="text" name="" id="" class="form-control form-control-sm" v-model="filloficina.siglas">
                </div>
              </div>
              <div class="form-group row">
                <div class="col-3">
                  <label for="">DNI:</label>
                  <input type="text" name="" id="" class="form-control form-control-sm" v-model="filloficina.dni">
                </div>
                <div class="col-3">
                  <label for="">Representante:</label>
                  <input type="text" name="" id="" class="form-control form-control-sm" v-model="filloficina.representante">
                </div>
                <div class="col-3">
                  <label for="">Cargo:</label>
                  <input type="text" name="" id="" class="form-control form-control-sm" v-model="filloficina.cargo">
                </div>
                <div class="col-3">
                  <label for="">Re.Tramite:</label>
                  <div class="custom-control custom-radio">
                          <template v-if="filloficina.recibetramite==1">
                            <input  type="radio" id="customRadio1"  checked >
                            <label for="customRadio1" >SI</label>
                            <input  type="radio" id="customRadio2" >
                            <label for="customRadio1" >NO</label>
                          </template>
                          <template v-else>
                            <input  type="radio" id="customRadio1" >
                            <label for="customRadio1" >SI</label>
                            <input  type="radio" id="customRadio2"  checked >
                            <label for="customRadio1" >NO</label>
                          </template>
                        </div>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-3">
                  <label for="">Es RRHH:</label>
                  <div class="custom-control custom-radio">
                          <template v-if="filloficina.rrhh==1">
                            <input  type="radio" id="customRadio1"  checked >
                            <label for="customRadio1" >SI</label>
                            <input  type="radio" id="customRadio2" >
                            <label for="customRadio1" >NO</label>
                          </template>
                          <template v-else>
                            <input  type="radio" id="customRadio1" >
                            <label for="customRadio1" >SI</label>
                            <input  type="radio" id="customRadio2"  checked >
                            <label for="customRadio1" >NO</label>
                          </template>
                        </div>
                </div>
                <div class="col-3">
                  <label for=""># Días.Máx.atención Exp:</label>
                  <input type="text" name="" id="" class="form-control form-control-sm" v-model="filloficina.diasmaxenproceso">
                </div>
                <div class="col-3">
                  <label for="">Estado:</label>
                  <select name="" id="" class="form-control form-control-sm">
                    <template v-if="filloficina.estado==1">
                      <option value="1" selected>Activo</option>
                      <option value="0" >Desactivado</option>
                    </template>
                  </select>
                </div>
                <div class="col-3">
                  <label for="">Observaciones:</label>
                  <input type="text" name="" id="" class="form-control form-control-sm" v-model="filloficina.observaciones">
                </div>
                
              </div>
            </div>
            <div class="modal-footer text-right pt-1 pb-0">
              <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
              <button type="button" class="btn btn-primary float-right">Actualizar</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- fin modale -->



 </div>
</template>

<script>
// import LaravelVuePagination from 'laravel-vue-pagination';

 export default {

   data () {
     return {
         dependencias:{},
         iddepe:this.$attrs.iddep,
         nombredepe:'',
         pagination:{
             'total':0,
            'current_page':0,
            'per_page':0,
            'last_page':0,
            'from':0,
            'to':0
         },
         offset:2,

         filloficina:{
             idoficina:'',
             nombre_oficina:'',
             abreviado:'',
             siglas:'',
             representante:'',
             cargo:'',
             dni:'',
             depe_depende:'',
             superior:'',
             tipo:'',
             proyectado:'',
             estado:'',
             observaciones:'',
             recibetramite:'',
             mesa_virtual:'',
             diasmaxenproceso:'',
             rrhh:'',
         },
         datosoficina:[]


     }
   },
   computed:{
       isActived:function(){
           return this.pagination.current_page;
       },
       pagesNumber:function(){
           if(!this.pagination.to){
               return [];
           }
           var from=this.pagination.current_page - this.offset;//TODO offset
           if(from<1){
               from=1;
           }

           var to=from+(this.offset*2);
           if(to>=this.pagination.last_page){
              to=this.pagination.last_page 
           }

           var pagesarray=[];
           while(from<=to)
           {
               pagesarray.push(from);
               from++;
           }
           return pagesarray;
       },
   },

   created () {
       this.listaroficina()
   },
   methods: {
       listaroficina(page){

           axios.get('/oficinas/'+this.$attrs.iddep+'?page='+page)// CONSULTA DE OFICINAS DE LA DEPENDENCIA 3 P.E
                .then(response=>
                {
                       this.dependencias = response.data.listadepe.data// LISTA DE OFICINA DE LA DEPENDENDENCIA 3 P.E
                       this.nombredepe=response.data.nombre_dependencia// nombredepe= SEDE CENTRAL
                       this.pagination=response.data.paginacion
                })
       },
       cambiopagina:function(page){
           this.pagination.current_page=page;
           this.listaroficina(page);
       },
       editandooficina:function(id){// id:2 SUB GERENCIA DE MODERNIZACION Y TRANSFORMACION DIGITAL
        //  alert(id);
        axios.get('/oficinas/unidad/'+id)
             .then((response)=>{
                this.datosoficina=response.data;
                this.filloficina.idoficina=id
                this.filloficina.nombre_oficina=this.datosoficina[0].depe_nombre
                this.filloficina.abreviado=this.datosoficina[0].depe_abreviado
                this.filloficina.siglas=this.datosoficina[0].depe_sigla
                this.filloficina.representante=this.datosoficina[0].depe_representante
                this.filloficina.cargo=this.datosoficina[0].depe_cargo
                this.filloficina.dni=this.datosoficina[0].depe_dni
                this.filloficina.recibetramite=this.datosoficina[0].depe_recibetramite
                this.filloficina.rrhh=this.datosoficina[0].rrhh
                this.filloficina.diasmaxenproceso=this.datosoficina[0].depe_diasmaxenproceso//
                this.filloficina.observaciones=this.datosoficina[0].depe_observaciones
                this.filloficina.estado=this.datosoficina[0].depe_estado

                //console.log(response.data)
              })
       }
       

   }
 }
</script>

<style lang="css" scoped>
    /* .pagination{
        margin-bottom: 0;
    } */
</style>
