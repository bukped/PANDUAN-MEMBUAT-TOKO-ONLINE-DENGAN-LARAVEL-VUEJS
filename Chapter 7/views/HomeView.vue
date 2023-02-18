<template>
  <div class="home">
    <header-wafa/>
    <hero-wafa/>
    <women-wafa/>
    <insta-wafa/>
    <logo-wafa/>
    <footer-wafa/>
  </div>
</template>

<script>
// @ is an alias to /src
import HeaderWafa from '@/components/HeaderWafa.vue'
import HeroWafa from '@/components/HeroWafa.vue'
import WomenWafa from '@/components/WomenWafa.vue'
import InstaWafa from '@/components/InstaWafa.vue'
import LogoWafa from '@/components/LogoWafa.vue'
import FooterWafa from '@/components/FooterWafa.vue'
// import carousel from 'vue-owl-carousel'

export default {
  name: 'HomeView',
  components: {
    // HelloWorld
    HeaderWafa,
    HeroWafa,
    WomenWafa,
    InstaWafa,
    LogoWafa,
    FooterWafa,
    // carousel
  }
}
</script>



