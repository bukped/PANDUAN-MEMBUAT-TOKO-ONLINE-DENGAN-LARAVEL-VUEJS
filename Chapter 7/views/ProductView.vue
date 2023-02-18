<template>
  <div class="product">
    <header-wafa/>
    <product-wafa/>
    <!-- <related-wafa/> -->
    <footer-wafa/>
  </div>
</template>

<script>
// @ is an alias to /src
import HeaderWafa from '@/components/HeaderWafa.vue'
import FooterWafa from '@/components/FooterWafa.vue'
import ProductWafa from '@/components/ProductWafa.vue'
// import RelatedWafa from '@/components/RelatedWafa.vue'
// import carousel from 'vue-owl-carousel'

export default {
  name: 'ProductView',
  components: {
    // HelloWorld
    HeaderWafa,
    FooterWafa,
    ProductWafa,
    // RelatedWafa,
    // carousel
    },
}
</script>

