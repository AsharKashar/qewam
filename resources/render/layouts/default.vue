<template>
  <v-app>
    <Navbar />
    <nuxt />
    <Footer />
  </v-app>
</template>

<script>
import Navbar from './components/navbar'
import Footer from './components/footer'
import Sidebar from './components/sidebar'
export default {
  components: {
    Navbar,
    Footer,
    Sidebar,
  },
}
</script>
