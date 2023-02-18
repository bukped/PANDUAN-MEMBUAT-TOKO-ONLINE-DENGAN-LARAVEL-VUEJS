<template>
  <div class="success">
    <div class="d-flex success-checkout align-items-center justify-content-center">
      <div class="col col-lg-4 text-center">
        <img src="img/success-buy.png" alt="" width="294" />
        <h3 class="mt-4">{{
          showPrompt? 'Pesanan Sedang Di Proses!': 'Silahkan upload bukti transaksi terlebih dahulu'
        }}</h3>
        <form class="mt-2" @submit="submitPayment" enctype="multipart/form-data" v-if="!isSubmitted">
          <div class="form-group">
            <br>
            <input type="file" class="form-control-file uploadfoto" id="uploadBukti" name="uploadBukti"
              v-on:change="onFileChange" />
          </div>
          <div class="form-group">
            <img :src="previewimage"  />
          </div>
          <button type="submit" class="btn btn-primary">
            Upload Bukti Transaksi
          </button>
        </form>
        <p v-if="isSubmitted" class="mt-2">
          Silakan tunggu update terbaru dari kami dengan mengecek riwayat transaksi Anda secara berkala.
        </p>
        <router-link v-if="isSubmitted" to="/home">
          <a href="#" class="primary-btn pd-cart mt-3">Back to Home</a>
        </router-link>
      </div>
    </div>
  </div>
</template>
<script>
import axios from "axios";
import Swal from "sweetalert2";

export default {
  name: "SuccessView",
  components: {},
  data() {
    return {
      isSubmitted: false,
      showPrompt: false,
      previewimage:null,
    };
  },
  methods: {
    onFileChange(e) {
  this.filename = e.target.files[0].name;
  this.file = e.target.files[0];
  this.previewimage = URL.createObjectURL(this.file)
},
    submitPayment(e) {
      e.preventDefault();
      if (!this.file) {
        Swal.fire({
          title: "Gagal mengirim formulir!",
          text: "Silahkan upload bukti transaksi terlebih dahulu",
          icon: "error",
        });
        return;
      }
      let currentObj = this;
      const config = {
        headers: {
          "content-type": "multipart/form-data",
        },
      };
      // form data
      let formData = new FormData();
      formData.append("file", this.file);
      formData.append("transaction_id", localStorage.getItem("transaction_id"));
      // send upload request
      axios
        .post("http://localhost:8000/api/store_file", formData, config)
        .then(function (response) {
          currentObj.success = response.data.success;
          currentObj.filename = "";
          currentObj.isSubmitted = true;
          Swal.fire({
            title: "Sukses!",
            text: "Bukti transaksi berhasil diupload dan sedang diproses.",
            icon: "success",
          }).then(() => {
            currentObj.showPrompt = true;
          });
        })
        .catch(function (error) {
          currentObj.output = error;
        });
    },
  },
};
</script>

<style scoped>
.uploadfoto {
  display: flex;
  flex-direction: column;
  align-items: center;
}
</style>