<template>
    <div>
        <header-wafa/>
         <!-- Breadcrumb Section Begin -->
    <div class="breacrumb-section text-left">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="breadcrumb-text product-more">
              <router-link to="/" href="#"
                ><i class="fa fa-home"></i> Home</router-link>
              <span v-for="details in detailHistory" :key="details.id">
                Detail <strong>{{ details.transaction.uuid }}</strong>
                </span>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Breadcrumb Section End -->
        <div class="container centered">
        <div class="card-body">
            <table class="table table-striped table-hover">
                <thead>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <th>Nama Produk</th>
                    <th>Tipe Produk</th>
                    <th>Jumlah Pembelian</th>
                    <th>Harga</th>
                </thead>
                <tbody>                
                    <tr v-for="details in detailHistory" :key="details.id" class="align-middle alert border-bottom" role="alert" >
                        <td>                
                        </td>            
                        <td class="cart-pic first-row" >
                            <img class="image-cart"  v-if="details.product.galleries.length > 0" :src="details.product.galleries[0].photo" alt="">
                        </td>
                        <td>
                            <p class="m-0 fw-bold">{{ details.product.name }}</p>
                        </td>
                        <td>
                            <p class="m-0 fw-bold">{{ details.product.categories.category_name}}</p>
                        </td>
                        <td>
                            <p class="m-0 fw-bold">{{ details.quantity }}</p>
                        </td>
                        <td>
                            <p class="m-0 fw-bold">{{ details.product.price }}</p>
                        </td>  
                    </tr>
                </tbody>
            </table>
                <router-link v-bind:to="'/history/'">
                <button class="btn btn-outline-dark">
                    Back
                </button>
                </router-link>
        </div>
    </div>
        <footer-wafa/>
    </div>
</template>
<script>
import HeaderWafa from '@/components/HeaderWafa.vue'
import FooterWafa from '@/components/FooterWafa.vue'
import axios from "axios";
export default {
    name: 'DetailView',
      components: {
    HeaderWafa,
    FooterWafa,
    },

    data() {
    return {
        detailHistory: [],
    }
  },
    mounted() {
    axios
        .get("http://localhost:8000/api/historyDetail/"+localStorage.getItem('transactions_id'))
        .then(res => (this.detailHistory = res.data.data))
        console.log(this.detailHistory)
        // eslint-disable-next-line no-console
        // .catch(err => console.log(err))   
  }
}
</script>
<style scoped>
.pic {
    width: 250px;
    height: 250px;
    object-fit: contain;
}
.image-cart{
    width: 100px;
    height: 100px;
}
</style>