<template>
  <div class="shopping">
    <header-wafa />
    <!-- Breadcrumb Section Begin -->
    <div class="breacrumb-section text-left">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="breadcrumb-text product-more">
              <router-link to="/"><i class="fa fa-home"></i> Home</router-link>
              <span>Shopping Cart</span>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Breadcrumb Section Begin -->
    <!-- Shopping Cart Section Begin -->
    <section class="shopping-cart spad">
      <div class="container">
        <div class="row">
          <div class="col-lg-8">
            <div class="row">
              <div class="col-lg-12">
                <div class="cart-table">
                  <table>
                    <thead>
                      <tr>
                        <th>Image</th>
                        <th class="p-name text-center">Product Name</th>
                        <th>Qty</th>
                        <th>Price</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr
                        v-for="keranjang in keranjangUser"
                        :key="keranjang.id"
                      >
                        <td class="cart-pic first-row">
                          <img class="image-cart" :src="keranjang.photo" />
                        </td>
                        <td class="cart-title first-row text-center">
                          <h5>{{ keranjang.name }}</h5>
                        </td>
                        <td>
                          <input
                            type="number"
                            v-model="keranjang.quantity"
                            class="form-control"
                            id="qty"
                            style="width: 60px"
                          />
                        </td>
                        <td class="p-price first-row">
                          Rp. {{ keranjang.price | format_number }}
                        </td>
                        <td
                          @click="removeItem(keranjangUser.index)"
                          class="delete-item"
                        >
                          <a href="#"><i class="material-icons"> close </i></a>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="col-lg-8">
                <h4 class="mb-4 text-left">
                  Penerima lain (Opsional):
                  </h4>
                <div class="user-checkout text-left">
                  <form>
                    <div class="form-group">
                      <input
                        type="hidden"
                        class="form-control"
                        id="namaLengkap"
                        aria-describedby="namaHelp"
                        placeholder="Masukan Nama"
                        v-model="customerInfo.customer_name"
                      />
                    </div>

                    <div class="form-group">
                      <label for="namaLengkap">Nama Penerima</label>
                      <input
                        type="text"
                        class="form-control"
                        id="namaLengkap"
                        value=""
                        aria-describedby="namaHelp"
                        placeholder="Masukan Nama"
                        v-model="name_optional"
                      />
                    </div>

                    <div class="form-group">
                      <label for="email">Email Penerima</label>
                      <input
                        type="email"
                        class="form-control"
                        id="email"
                        value=""
                        aria-describedby="emailHelp"
                        placeholder="Masukan Email"
                        v-model="customerInfo.email"
                      />
                    </div>

                    <div class="form-group">
                      <label for="namaLengkap">No. HP</label>
                      <input
                        type="text"
                        class="form-control"
                        id="noHP"
                        value=""
                        aria-describedby="noHPHelp"
                        placeholder="Masukan No. HP"
                        v-model="number"
                      />
                    </div>
                    <div class="form-group">
                      <label for="alamatLengkap">Alamat Lengkap</label>
                      <textarea
                        class="form-control"
                        id="alamatLengkap"
                        value=""
                        rows="3"
                        v-model="address"
                      >
                      </textarea>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="row">
              <div class="col-lg-12">
                <div class="proceed-checkout text-left">
                  <ul>
                    <!-- <li class="subtotal">ID Transaction <span>#SH12000</span></li> -->
                    <li class="subtotal">
                      Subtotal <span>Rp. {{ totalHarga | format_number }}</span>
                    </li>
                    <li class="subtotal mt-3">
                      Pajak
                      <span>10% = Rp. {{ ditambahPajak | format_number }}</span>
                    </li>
                    <li class="subtotal mt-3">
                      Total Biaya
                      <span>Rp. {{ totalBiaya | format_number }}</span>
                    </li>
                    <li class="subtotal mt-3">
                      Bank Transfer <span>Mandiri</span>
                    </li>
                    <li class="subtotal mt-3">
                      No. Rekening <span>2208 1996 1403</span>
                    </li>
                    <li class="subtotal mt-3">
                      Nama Penerima <span>Fadil</span>
                    </li>
                  </ul>
                  <!-- <router-link to="/success"> -->
                  <a @click="checkout()" href="#" class="proceed-btn"
                    >Ajukan Pemesanan</a
                  >
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Shopping Cart Section End -->
  </div>
</template>
<script>
import HeaderWafa from "@/components/HeaderWafa.vue";
import axios from "axios";
import Swal from "sweetalert2";
export default {
  name: "ShoppingCartView",
  components: {
    HeaderWafa,
  },
  filters: {
    format_number: function (value) {
      return parseInt(value).toLocaleString();
    },
  },
  data() {
    return {
      filename: '',
      file: '',
      success: '',
      keranjangUser: [],
      customerInfo: {
        customer_id: localStorage.getItem("customer_id"),
        customer_name: localStorage.getItem("customer_name"),
        email: localStorage.getItem("email"),
        number: localStorage.getItem("number"),
        address: localStorage.getItem("address"),
      },
      name: localStorage.getItem("customer_name"),
      name_optional: null,
      email: localStorage.getItem("email"),
      password: '',
      password_confirm: '',
      address: localStorage.getItem("address"),
      number: localStorage.getItem("number"),
    };
  },
  methods: {
    updatePenerima() {
      let updateData = {
        'customer_name': this.name,
        'customer_optional': this.name_optional,
        'email': this.email,
        'password': this.password,
        'password_confirmation': this.password_confirm,
        'address': this.address,
        'number': this.number,
      };
      axios.post(
        "http://localhost:8000/api/updateProfile/" +
          localStorage.getItem("customer_id"),
        updateData
      );
      Swal.fire({
        title: "Success",
        text: "Berhasil melakukan update penerima!",
        icon: "success",
        timer: 5000,
      });
    },
    removeItem(idx) {
      // cari tahu id yang akan dihapus
      let keranjangUserStorage = JSON.parse(
        localStorage.getItem("keranjangUser")
      );
      let itemKeranjangUserStorage = keranjangUserStorage.map(
        (itemKeranjangUserStorage) => itemKeranjangUserStorage.id
      );
      // cocokan idx dengan id yang ada di storage
      let index = itemKeranjangUserStorage.findIndex((id) => id == idx);
      Swal.fire({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover this item!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "Cancel",
        dangerMode: true,
      }).then((willDelete) => {
        if (willDelete.value) {
          this.keranjangUser.splice(index, 1);
          const parsed = JSON.stringify(this.keranjangUser);
          localStorage.setItem("keranjangUser", parsed);
          this.$router.push("/shopping");
        } else {
          Swal.fire({
            title: "Cancelled",
            text: "Your item is safe!",
            icon: "error",
            timer: 1500,
          });
          this.$router.push("/shopping");
        }
      });
    },
    checkout() {
      const self = this;
      if (!localStorage.getItem("access_token")) {
        Swal.fire({
          title: "Anda harus login terlebih dahulu",
          icon: "error",
        });
        return;
      }
      let nama = "";
      let alamat = "";
      if (this.nama_pelanggan) {
        nama = this.nama_pelanggan;
      } else {
        nama = localStorage.getItem("customer_name");
      }
      if (this.alamat_pelanggan) {
        alamat = this.alamat_pelanggan;
      } else {
        alamat = localStorage.getItem("address");
      }
      Swal.fire({
        title: "Apakah anda yakin untuk melakukan pemesanan?",
        text: "Anda tidak akan bisa membatalkan setelah melakukan pemesanan!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Ya, pesan sekarang!",
        cancelButtonText: "Batal",
      }).then((result) => {
        if (result.value) {
          this.updatePenerima();
          let productIds = self.keranjangUser.map(function (product) {
            return product.id;
          });
          let quantities = self.keranjangUser.map(function (product) {
            return product.quantity;
          });
          let checkoutData = {
            customer_id: localStorage.getItem("customer_id"),
            nama_pelanggan: nama,
            alamat_pelanggan: alamat,
            transaction_total: self.totalBiaya,
            transaction_status: "PENDING",
            transaction_details: productIds,
            quantities: quantities,
          };
          axios
            .post("http://localhost:8000/api/checkout", checkoutData)
            .then((res) => {
              console.log(res)
              localStorage.setItem("transaction_id", res.data.data.transaction_id)
              self.$router.push("success")  
            })
            .catch((err) => console.log(err));
        }
      });
    },
    onFileChange(e) {
      this.filename = "File yang dipilih: " + e.target.files[0].name;
      this.file = e.target.files[0];
    },
    submitPayment(e) {
      e.preventDefault();
        let currentObj = this;
        const config = {
            headers: {
                'content-type': 'multipart/form-data',
            }
        }
        // form data
        let formData = new FormData();
        formData.append('file', this.file);
        formData.append('transaction_id', localStorage.getItem('transaction_id'))
        // send upload request
        axios.post('http://localhost:8000/api/store_file', formData, config)
            .then(function (response) {
                currentObj.success = response.data.success;
                currentObj.filename = "";
            })
            .catch(function (error) {
                currentObj.output = error;
            });
    }
  },
  mounted() {
    if (localStorage.getItem("keranjangUser")) {
      try {
        this.keranjangUser = JSON.parse(localStorage.getItem("keranjangUser"));
      } catch (e) {
        localStorage.removeItem("keranjangUser");
      }
    }
  },
  computed: {
    totalHarga() {
      return this.keranjangUser.reduce((items, data) => {
        return items + data.price * parseInt(data.quantity);
      }, 0);
    },
    ditambahPajak() {
      return (this.totalHarga * 10) / 100;
    },
    totalBiaya() {
      return this.totalHarga + this.ditambahPajak;
    },
  },
};
</script>
<style scoped>
.image-cart {
  width: 80px;
  height: 80px;
}
#qty {
  width: 50px;
  margin: 0 auto;
  text-align: center;
}
</style>
