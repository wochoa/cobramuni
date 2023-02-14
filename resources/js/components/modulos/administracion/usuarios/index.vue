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
                <router-link :to="'/Tramites/Enproceso'" class="btn btn-info btn-sm"><i class="fa-regular fa-circle-left"></i> ir a documentos en proceso</router-link>
            </div>                
        </div>
        <div class="row mt-2">
            <div class="col-md-12">
                <div class="card card-primary card-outline ">
                    <div class="card-header p-1">
                        Usuarios
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
                                <thead class="bg-lightblue  disabled color-palette pd-0">
                                    <tr  class="info">
                                        <th><small><strong>ID</strong></small></th> 
                                        <th><small><strong>NOMBRES</strong></small></th> 
                                         
                                        <th><small><strong>CARGO</strong></small></th> 
                                        <th><small><strong>DEPENDENCIA</strong></small></th>
                                        <th><small><strong>ACTIVO</strong></small></th>
                                        <th><small><strong>FECHA REGISTRO</strong></small></th>
                                        <th><small><strong>ACCIONES</strong></small></th>
                                       
                                    </tr>
                                </thead> 
                                <tbody >
                                    <tr v-for="user in users" :key="user.id">
                                        <!-- <td  colspan="21" class="text-center">
                                            No hay documentos, pruebe cambiando los filtros
                                        </td> -->
                                        <td><small>{{ user.id }}</small></td>
                                        <td><small>{{ user.adm_name }} {{ user.adm_lastname }}<br>
                                                    <strong>DNI</strong>:{{user.adm_dni }}<br>
                                                    <strong>Correo</strong>:{{user.adm_correo }}<br>
                                                    <strong>Usuario</strong>:{{user.adm_email }}</small></td>
                                        
                                        <td><small>{{ user.adm_cargo }}</small></td>
                                        <td><small>{{ user.depe_id}}</small></td>
                                        <td v-if="user.adm_estado==1" class="text-center text-success">
                                           
                                            <!-- <i class="fa-solid fa-person-circle-check"></i> -->
                                            <i class="fa-solid fa-toggle-on"></i>
                                            
                                        </td>
                                        <td v-else class="text-center text-danger">
                                            
                                            <!-- <i class="fa-solid fa-person-circle-xmark"></i> -->
                                             <i class="fa-solid fa-toggle-off"></i>
                                            
                                        </td>
                                        <td><small>{{ user.created_at}}</small></td>
                                        <td class="text-center">
                                            <!-- <button class="btn btn-primary btn-sm"><i class="fa-solid fa-user-pen"></i></button>
                                            <router-link :to="'/Administracion/usuarios/edit/{{}}'">path route</router-link> -->
                                            <router-link :to="{name:'Editar usuario',params:{id:user.id }}"><i class="fa-solid fa-user-pen"></i></router-link>
                                        </td>
                                        
                                    </tr> 
                            </tbody></table>

                            

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


 </div>
</template>

<script>
// import LaravelVuePagination from 'laravel-vue-pagination';

 export default {
    

   data () {
     return {
         users:{},
         pagination:{
             'total':0,
            'current_page':0,
            'per_page':0,
            'last_page':0,
            'from':0,
            'to':0
         },
         offset:3,
         ruta:this.$attrs.ruta


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
       this.listauser()
   },
   methods: {
       listauser(page){

           axios.get('/listauser?page='+page)
                .then(response=>
                {
                       this.users = response.data.listauser.data
                       this.pagination=response.data.paginacion
                })
       },
       cambiopagina:function(page){
           this.pagination.current_page=page;
           this.listauser(page);
       }
       

   }
 }
</script>

<style lang="css" scoped>
    /* .pagination{
        margin-bottom: 0;
    } */
</style>
