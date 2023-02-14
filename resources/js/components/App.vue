<template>
<div>
    <Navbar :ruta="ruta" :usuario="usuario" />
    <Sidebar :ruta="ruta" :usuario="usuario" />
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <transition name="slide-fade" mode="out-in">
            <router-view :ruta="ruta" :usuario="usuario" :route-invoker-get="routeInvokerGet" :route-invoker-post="routeInvokerPost"> </router-view>
        </transition>

    </div>
    <!-- /.content-wrapper -->
    <Footer :ruta="ruta" />
</div>
</template>

<script>
import Navbar from './plantilla/Navbar';
import Sidebar from './plantilla/Sidebar'
import Footer from './plantilla/Footer'

export default {
    props: ['ruta', 'usuario', 'routeInvokerGet', 'routeInvokerPost'],
    components: {
        Navbar,
        Sidebar,
        Footer
    },

    data() {
        return {

        };
    },

    mounted() {

    },

    methods: {

    },
};
</script>

<style lang="scss" scoped>
/*
      Enter and leave animations can use different
      durations and timing functions.
    */
.slide-fade-enter-active {
    transition: all .6s ease
        /* -out; */
}

.slide-fade-leave-active {
    transition: all .6s cubic-bezier(.17, .67, .83, .67)
}

.slide-fade-enter,
.slide-fade-leave-to {
    transform: translatey(350px);
    opacity: 0;
}
</style>
