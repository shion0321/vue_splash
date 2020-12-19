<template>
    <div>
        <header>
            <Navbar></Navbar>
        </header>
        <main>
            <div class="container">
                <router-view></router-view>
            </div>
        </main>
        <Footer></Footer>
    </div>
</template>

<script>
import Navbar from './components/Navbar.vue'
import Footer from './components/Footer.vue'

export default {
    components:{
        Navbar,
        Footer,
    }
}
</script>