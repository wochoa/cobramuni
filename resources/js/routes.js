import Vue from 'vue';
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
import Router from 'vue-router';

Vue.use(Router);
// Import Bootstrap and BootstrapVue CSS files (order is important)
// import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

// Make BootstrapVue available throughout your project
Vue.use(BootstrapVue)
// Optionally install the BootstrapVue icon components plugin
Vue.use(IconsPlugin)


import Inicio  from './components/dashboard/index.vue';
// tramites
// import Tramites  from './components/modulos/tramites/index'// por defecto se va mostrar en proceso
// import Nuevotramite  from './components/modulos/tramites/Crear'// nuevo tramite
// import Porrecibir  from './components/modulos/tramites/porrecibir'// documentos por recepcionar
// import Archivados  from './components/modulos/tramites/Archivados'// documentos por recepcionar

// cobranzas
import cobranzas  from './components/modulos/cobranza/index'
import formatos  from './components/modulos/cobranza/formatos'
import conceptos  from './components/modulos/cobranza/conceptos'
import nuevocobranza  from './components/modulos/cobranza/newcobranza'
import clasificador  from './components/modulos/cobranza/clasificador'
// Administracion
//dependencias
import Dependencia  from './components/modulos/administracion/dependencia/index'// listar
import Creardependencia  from './components/modulos/administracion/dependencia/crear'// crear
import Editardependencia  from './components/modulos/administracion/dependencia/editar'// editar
import Veroficinas  from './components/modulos/administracion/dependencia/oficinas'// Veroficinas  
import Crearoficina  from './components/modulos/administracion/dependencia/crearoficina'// Veroficinas
import ReportesFormato  from './components/modulos/cobranza/reportesformato'// 
import ReportesClasificador  from './components/modulos/cobranza/reportesclasificador'//
import Reportesrucdni  from './components/modulos/cobranza/reportesrucdni'//
import ReportesFechas  from './components/modulos/cobranza/reportesfechas'//
// usuarios
import Usuarios  from './components/modulos/administracion/usuarios/index'// documentos por recepcionar
import Editar  from './components/modulos/administracion/usuarios/editar'// documentos por recepcionar

export default new Router({
    mode: 'history',
    routes:[
        // {    
        //     path:'/login',
        //     name:'login',
        //     component:Login 
        // },
        {   path:'/',
            name:'Dashboard',
            component:Inicio 
        },
        // {    
        //     path:'/Tramites/Enproceso',
        //     name:'Trámites en proceso',
        //     component:Tramites 
        // },
        // {   
        //     path:'/Tramites/Nuevotramite',
        //     name:'Nuevo trámite',
        //     component:Nuevotramite 
        // },
        // {   
        //     path:'/Tramites/Porrecibir',
        //     name:'Trámites por recibir',
        //     component:Porrecibir 
        // },
        // {   
        //     path:'/Tramites/Archivados',
        //     name:'Trámites archivados',
        //     component:Archivados 
        // },
        {
            path:'/cobranzas/index',
            name:'Area de cobranzas',
            component:cobranzas 
        },
        {
            path:'/cobranzas/formatos',
            name:'Formatos de cobranzas',
            component:formatos 
        },
        {
            path:'/cobranzas/conceptos',
            name:'Conceptos de cobranzas',
            component:conceptos 
        },
        {
            path:'/cobranzas/nuevo',
            name:'Nueva cobranza',
            component:nuevocobranza 
        },
        {
            path:'/cobranzas/clasificador',
            name:'Clasificador',
            component:clasificador 
        },
        {
            path:'/reportes/formatos',
            name:'Reportes por formatos',
            component:ReportesFormato 
        },
        {
            path:'/reportes/clasificador',
            name:'Reportes por clasificador',
            component:ReportesClasificador
        },
        {
            path:'/reportes/dniruc',
            name:'Reportes por DNI/RUC',
            component:Reportesrucdni
        },
        {
            path:'/reportes/fechas',
            name:'Reportes por fechas',
            component:ReportesFechas
        },
        //
        // administracion
         // Dependencia->listar
         {   
            path:'/Administracion/dependencia',
            name:'Gestión de dependencias',
            component:Dependencia 
        },
        // Dependencia->crear
        {   
            path:'/Administracion/dependencia/crear',
            name:'Creacion de dependencias',
            component:Creardependencia 
        },
        // Dependencia->editar
        {   
            path:'/Administracion/dependencia/edit/:iddepe',
            name:'Editar dependencias',
            component:Editardependencia,
            props:true 
        },
         // Dependencia->ver oficina
         {   
            path:'/Administracion/dependencia/oficinas/:iddep',
            name:'Listado oficinas',
            component:Veroficinas,
            props:true 
        },
        // Dependencia->crear oficina
        {   
            path:'/Administracion/dependencia/oficinas-crear',
            name:'Crear oficinas',
            component:Crearoficina
        },
        // usuarios
        {   
            path:'/Administracion/usuarios',
            name:'Gestión de usuarios',
            component:Usuarios 
        },
        {   
            path:'/Administracion/usuarios/edit/:id',
            name:'Editar usuario',
            component:Editar,
            props:true
        },


    ],
    linkActiveClass:'active'
})