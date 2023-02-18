<template>
  <!-- Hero Section Begin -->
 <section class="hero-section">
        <carousel class="hero-items" :items="1" :nav="false" :autoplay="true">
            <div class="single-hero-items set-bg" style="background-image: url('img/hero-1.jpg')">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-5">
                            <span>Fashion, Kecantikan</span>
                            <h1>Minggu Baru</h1>
                            <p>
                                Weekend gini enaknya jalan - jalan dengan orang terdekat eitsss tapi pakaian harus tetap berkualitas dan pastinya tidak ketinggalan zaman ayoo buruan cek promo kami!!
                            </p>
                             <router-link v-bind:to="'/main/'"><a  class="primary-btn text-white">Shop Now</a></router-link>
                        </div>
                    </div>
                </div>
            </div>
           <div class="single-hero-items set-bg" style="background-image: url('img/hero-2.jpg')">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-5">
                            <span>Tas, Anak - Anak</span>
                            <h1>Senin Pagi</h1>
                            <p>
                                Di Hari Senin ini kami mengadakan promo besar untuk kategori anak seperti tas dan barang lainnya untuk anak anak ayo buruan belii!
                            </p>
                            <router-link v-bind:to="'/main/'"><a  class="primary-btn text-white">Shop Now</a></router-link>
                        </div>
                    </div>
                </div>
            </div>
            <div class="single-hero-items set-bg" style="background-image: url('img/hero-3.jpg')">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-5">
                            <span>Hijab, Kecantikan</span>
                            <h1>Berkah Jum'at</h1>
                            <p>
                                Sebentar lagi bulan puasa nihh... udah pada beli baju lebaran belum? nahh kami sudah menyediakan berbagai hijab dari yang bagus hingga paling bagus banget buruan dicek!!
                            </p>
                            <router-link v-bind:to="'/main/'"><a  class="primary-btn text-white">Shop Now</a></router-link>
                        </div>
                    </div>
                </div>
            </div>
        </carousel>
    </section>
    <!-- Hero Section End -->
         
</template>

<script>

import carousel from 'vue-owl-carousel'

export default {
  name: 'HeroWafa',
  components: {
    carousel
  }
}
</script>

<style >
.product-item{
  margin-right: 25px;
}
</style>
