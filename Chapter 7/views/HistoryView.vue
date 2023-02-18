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
              <span>History</span>
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
                    <th>UUID</th>
                    <th>Tanggal Transaksi</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Action</th>
                </thead>
                <tbody>                
                    <tr v-for="history in transactionHistory" :key="history.id" class="align-middle alert border-bottom" role="alert" >
                        <td>
                            <p class="m-0 fw-bold">{{ history.uuid }}</p>
                        </td>
                        <td>
                            <p class="m-0 fw-bold">{{ history.created_at }}</p>
                        </td>
                        <td>
                            <p class="m-0 fw-bold">Rp. {{ history.transaction_total | format_number }}</p>
                        </td>
                        <td>
                            <p class="m-0 fw-bold">{{ history.transaction_status }}</p>
                        </td>
                        <td>
                            <router-link v-bind:to="'/historyDetail/' + history.id">
                            <a href="#" class="btn btn-info btn-sm" @click="getTransactionId(history.id)">Detail</a>
                            </router-link>
                        </td>
                    </tr>
                </tbody>
            </table>
                <router-link v-bind:to="'/home/'">
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
    name: 'HistoryView',
      components: {
    HeaderWafa,
    FooterWafa,
    },
    filters: {
    format_number: function (value) {
      return parseInt(value).toLocaleString();
    },
  },
    data() {
    return {
        transactionHistory: [],
    }
  },
  methods: {
    getTransactionId(id) {
        localStorage.setItem("transactions_id", id)
    }
  },
    mounted() {
    axios
        .get("http://localhost:8000/api/history/"+localStorage.getItem('customer_id'))
        .then(res => (this.transactionHistory = res.data.data))
        // eslint-disable-next-line no-console
        .catch(err => console.log(err))
  }
}
</script>
<style scoped>
.pic {
    width: 250px;
    height: 250px;
    object-fit: contain;
}
</style>