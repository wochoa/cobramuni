<template>
 <div>
   <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">{{ $route.name }} </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><router-link :to="'/'">Dashboard</router-link></li>
              <li class="breadcrumb-item"><router-link :to="'/Administracion/usuarios'">Usuarios</router-link></li>
              <li class="breadcrumb-item active">{{ $route.name }}</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">
            
                <!-- <router-link  class="btn btn-info btn-sm" @click="router.go(-1)"><i class="fa-regular fa-circle-left"></i> Volver</router-link> -->
                <button class="btn btn-info btn-sm btn-block" @click="retroceder()"><i class="fa-regular fa-circle-left"></i> Volver</button>
            

            <!-- Profile Image -->
            <div class="card card-primary card-outline mt-2">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle" :src="ruta+'/dist/img/user4-128x128.jpg'" alt="User profile picture">
                </div>

                <h4 class="profile-username text-center">{{filluser.nombre}} {{filluser.apellidos}}</h4>

                <p class="text-muted text-center">{{filluser.cargo}}</p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Correo</b> <a class="float-right">{{filluser.correo}}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Telefono</b> <a class="float-right">{{filluser.telefono}}</a>
                  </li>
                  <li class="list-group-item">
                    <b>DNI</b> <a class="float-right">{{filluser.dni}}</a>
                  </li>
                </ul>

                <a href="#" class="btn btn-primary btn-block" ><b>Actualizar avatar</b></a>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  
                  <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Linea de tiempo</a></li>
                  <li class="nav-item"><a class="nav-link active" href="#settings" data-toggle="tab">Configuración</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  
                  <div class="tab-pane" id="timeline">
                    <!-- The timeline -->
                    <div class="timeline timeline-inverse">
                      <!-- timeline time label -->
                      <div class="time-label">
                        <span class="bg-danger">
                          10 Feb. 2014
                        </span>
                      </div>
                      <!-- /.timeline-label -->
                      <!-- timeline item -->
                      <div>
                        <i class="fas fa-envelope bg-primary"></i>

                        <div class="timeline-item">
                          <span class="time"><i class="far fa-clock"></i> 12:05</span>

                          <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>

                          <div class="timeline-body">
                            Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                            weebly ning heekya handango imeem plugg dopplr jibjab, movity
                            jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                            quora plaxo ideeli hulu weebly balihoo...
                          </div>
                          <div class="timeline-footer">
                            <a href="#" class="btn btn-primary btn-sm">Read more</a>
                            <a href="#" class="btn btn-danger btn-sm">Delete</a>
                          </div>
                        </div>
                      </div>
                      <!-- END timeline item -->
                      <!-- timeline item -->
                      <div>
                        <i class="fas fa-user bg-info"></i>

                        <div class="timeline-item">
                          <span class="time"><i class="far fa-clock"></i> 5 mins ago</span>

                          <h3 class="timeline-header border-0"><a href="#">Sarah Young</a> accepted your friend request
                          </h3>
                        </div>
                      </div>
                      <!-- END timeline item -->
                      <!-- timeline item -->
                      <div>
                        <i class="fas fa-comments bg-warning"></i>

                        <div class="timeline-item">
                          <span class="time"><i class="far fa-clock"></i> 27 mins ago</span>

                          <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>

                          <div class="timeline-body">
                            Take me to your leader!
                            Switzerland is small and neutral!
                            We are more like Germany, ambitious and misunderstood!
                          </div>
                          <div class="timeline-footer">
                            <a href="#" class="btn btn-warning btn-flat btn-sm">View comment</a>
                          </div>
                        </div>
                      </div>
                      <!-- END timeline item -->
                      <!-- timeline time label -->
                      <div class="time-label">
                        <span class="bg-success">
                          3 Jan. 2014
                        </span>
                      </div>
                      <!-- /.timeline-label -->
                      <!-- timeline item -->
                      <div>
                        <i class="fas fa-camera bg-purple"></i>

                        <div class="timeline-item">
                          <span class="time"><i class="far fa-clock"></i> 2 days ago</span>

                          <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>

                          <div class="timeline-body">
                            <img src="https://placehold.jp/150x100.png" alt="...">
                            <img src="https://placehold.jp/150x100.png" alt="...">
                            <img src="https://placehold.jp/150x100.png" alt="...">
                            <img src="https://placehold.jp/150x100.png" alt="...">
                          </div>
                        </div>
                      </div>
                      <!-- END timeline item -->
                      <div>
                        <i class="far fa-clock bg-gray"></i>
                      </div>
                    </div>
                  </div>
                  <!-- /.tab-pane -->

                  <div class="active tab-pane" id="settings">
                    <form class="form-horizontal">
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Nombre</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control form-control-sm" id="inputName" placeholder="Name" v-model="filluser.nombre">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Apellidos</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control form-control-sm" id="inputName" placeholder="Apellidos" v-model="filluser.apellidos">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Iniciales nombre</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control form-control-sm" id="inputName" placeholder="Apellidos" v-model="filluser.iniciales">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control form-control-sm" id="inputEmail" placeholder="Email" v-model="filluser.correo">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label">Direccion</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control form-control-sm" id="inputName2" placeholder="Name" v-model="filluser.direccion">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label">DNI</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control form-control-sm" id="inputName2" placeholder="Name" v-model="filluser.dni">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputExperience" class="col-sm-2 col-form-label">Número celular</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control form-control-sm" id="inputName2" placeholder="Name" v-model="filluser.telefono">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputSkills" class="col-sm-2 col-form-label">Cargo</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control form-control-sm" id="inputSkills" placeholder="Skills" v-model="filluser.cargo">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputSkills" class="col-sm-2 col-form-label">Unidad orgánica</label>
                        <div class="col-sm-2">
                          <input type="text" class="form-control form-control-sm" id="inputSkills" placeholder="Codigo" v-model="filluser.iddependencia">
                        </div>
                        <div class="col-sm-8">
                          <select class="form-control form-control-sm">
                            <option value="">Sub Gerencia de Modernizacion y transformacion digital</option>
                          </select>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label">Vigencia</label>
                        <div class="col-sm-10">
                          <input type="date" class="form-control form-control-sm" id="inputName2" placeholder="Name" v-model="filluser.fechavigencia">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label">Estado</label>
                        <div class="col-sm-10">
                          <template v-if="filluser.estado==1">
                            <i class="fa-solid fa-toggle-on text-success"></i>Activado
                          </template>
                          <template v-else >
                            <i class="fa-solid fa-toggle-off text-danger"></i> Desactivado
                          </template>
                        </div>
                      </div>
                      
                      <!-- <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <div class="checkbox">
                            <label>
                              <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                            </label>
                          </div>
                        </div>
                      </div> -->
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-danger">Actualizar</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    
 </div>
</template>

<script>
 export default {
   props:['ruta'],
   name: '',
   data () {
     return {
         filluser:{
             iduser:this.$attrs.id,
             nombre:'',
             apellidos:'',
             iniciales:'',
             usuario:'',
             contrasena:'',
             estado:'',
             cargo:'',
             correo:'',
             dni:'',
             direccion:'',
             fechavigencia:'',
             telefono:'',
             avatar:'',
             iddependencia:''
         },
         datosuser:[]
         

     }
   },
   components: {

   },
   
   mounted () {
       this.getusuarios();
       
   },
   methods: {
       getusuarios(){
           var url='/listauser/'+this.$attrs.id;
           axios.get(url)
                .then((result) => {
                    this.datosuser = result.data

                    /// asignamos los datos a las variables
                  this.filluser.nombre=this.datosuser[0].adm_name;
                  this.filluser.apellidos=this.datosuser[0].adm_lastname;
                  this.filluser.iniciales=this.datosuser[0].adm_inicial;
                  this.filluser.usuario=this.datosuser[0].adm_email;
                  this.filluser.contrasena=this.datosuser[0].adm_password;
                  this.filluser.estado=this.datosuser[0].adm_estado;
                  this.filluser.cargo=this.datosuser[0].adm_cargo;
                  this.filluser.correo=this.datosuser[0].adm_correo;
                  this.filluser.dni=this.datosuser[0].adm_dni;
                  this.filluser.direccion=this.datosuser[0].adm_direccion;
                  this.filluser.fechavigencia=this.datosuser[0].adm_vigencia;
                  this.filluser.telefono=this.datosuser[0].adm_telefono;
                  this.filluser.avatar=this.datosuser[0].avatar;
                  this.filluser.iddependencia=this.datosuser[0].depe_id;
                });
       },

       retroceder(){
                      window.history.back();
                    }

   }
 }
</script>

<style lang="css" scoped>

</style>
