<template>
  <!-- Header Section Begin -->
  <header class="header-section">
    <div class="header-top">
      <div class="container">
        <div class="ht-left">
          <div class="mail-service">
            <i class="fa fa-envelope"></i> hello.wafa@gmail.com
          </div>
          <div class="phone-service">
            <i class="fa fa-phone"></i> +628 22081996
          </div>
        </div>
      </div>
    </div>

    <div class="container">
      <div class="inner-header">
        <div class="row">
          <div class="col-lg-2 col-md-2">
            <div class="logo">
              <router-link v-bind:to="'/home/'">
                <a href="./index.html">
                  <img src="img/wafa-logos_black.png" alt="" />
                </a>
              </router-link>
            </div>
          </div>
          <div class="col-lg-7 col-md-7"></div>
          <div class="col-lg-3 text-right col-md-3">
            <div class="user-area dropdown float-right"></div>
            <ul class="nav-right">
              <li class="cart-icon">
                Keranjang Belanja &nbsp;
                <a href="#">
                  <i class="icon_bag_alt"></i>
                  <span>{{ keranjangUser.length }}</span>
                </a>
                <div class="cart-hover">
                  <div class="select-items">
                    <table>
                      <tbody v-if="keranjangUser.length > 0">
                        <tr
                          v-for="keranjang in keranjangUser"
                          :key="keranjang.id"
                        >
                          <td class="si-pic">
                            <img
                              class="photo-item"
                              :src="keranjang.photo"
                              alt=""
                            />
                          </td>
                          <td class="si-text">
                            <div class="product-selected">
                              <p>
                                Rp. {{ keranjang.price | format_number }} x{{
                                  keranjang.quantity
                                }}
                              </p>
                              <h6>{{ keranjang.name }}</h6>
                            </div>
                          </td>
                          <td
                            @click="removeItem(keranjang.id)"
                            class="si-close"
                          >
                            <i class="ti-close"></i>
                          </td>
                        </tr>
                      </tbody>
                      <tbody v-else>
                        <tr>
                          <td>Keranjang kosong</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <div class="select-total">
                    <span>total:</span>
                    <h5>Rp. {{ totalHarga | format_number }}</h5>
                  </div>
                  <div class="select-button">
                    <a href="#" class="primary-btn view-card"
                      ><router-link style="color: #fff" to="/shopping"
                        >VIEW CARD</router-link
                      ></a
                    >

                    <a href="#" class="primary-btn checkout-btn">CHECK OUT</a>
                  </div>
                </div>
              </li>

              <li class="cart-icon">
                <a href="#">
                  <i class="fa fa-user-circle"></i>
                </a>
                <div class="cart-hover">
                  <div class="select-items">
                    <div class="select-items">
                      <div class="select-button">
                        <ul class="list-group list-group-flush">
                          <template v-if="loggedIn">
                            <p>
                              Selamat datang kembali,
                              <strong>{{ customer_name }}</strong>
                            </p>

                            <li class="list-group-item">
                              <i class="fa fa-user-o"> </i>
                              <router-link v-bind:to="'/profile/'">
                                <a
                                  @click="
                                    getCustomerId(this.dataProfile.customer_id)
                                  "
                                  href="#"
                                >
                                  <h5>Profile</h5>
                                </a>
                              </router-link>
                            </li>

                            <li class="list-group-item">
                              <i class="fa fa-history"></i>
                              <router-link v-bind:to="'/history/'"
                                ><a href="#">
                                  <h5>Riwayat Transaksi</h5>
                                </a></router-link
                              >
                            </li>

                            <li class="list-group-item">
                              <i class="fa fa-power-off"></i>
                              <a @click="logout()" href="#">
                                <h5>Log out</h5>
                              </a>
                            </li>
                          </template>

                          <template v-else>
                            <li class="list-group-item">
                              <i class="fa fa-sign-in"> </i>
                              <router-link v-bind:to="'/auth/'">
                                <a href="#"> <h5>Login</h5> </a>
                              </router-link>
                            </li>
                          </template>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <hr />
  </header>
  <!-- Header End -->
</template>

<script>
import axios from "axios";
import Swal from "sweetalert2";

export default {
  name: "HeaderWafa",

  filters: {
    format_number: function (value) {
      return parseInt(value).toLocaleString();
    },
  },

  data() {
    return {
      loggedIn: !!localStorage.getItem("access_token"), // cek apakah sudah ada access token di local storage
      dataProfile: [],
      keranjangUser: [],
      customer_name: localStorage.getItem("customer_name"),
    };
  },

  methods: {
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
      this.keranjangUser.splice(index, 1);

      this.keranjangUser.splice(index, 1);
      const parsed = JSON.stringify(this.keranjangUser);
      localStorage.setItem("keranjangUser", parsed);

      window.location.reload();
    },

    getCustomerId(id) {
      localStorage.setItem("customer_id", id);
    },

    logout() {
      // Tampilkan konfirmasi logout menggunakan SweetAlert
      Swal.fire({
        title: "Apakah Anda yakin ingin logout?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes",
        cancelButtonText: "No",
      }).then((result) => {
        if (result.value) {
          // Jika user memilih Yes, hapus data access_token dari localStorage
          localStorage.removeItem("access_token");
          this.loggedIn = false;
          this.$router.push("/");

          Swal.fire({
            title: "Berhasil Logout",
            icon: "success",
          });
        }
      });
    },
  },

  mounted() {
    if (localStorage.getItem("keranjangUser")) {
      try {
        this.keranjangUser = JSON.parse(localStorage.getItem("keranjangUser"));
      } catch (e) {
        localStorage.removeItem("keranjangUser");
      }
    }

    axios
      .get(
        "http://localhost:8000/api/getProfileById/" +
          localStorage.getItem("customer_id")
      )
      .then((res) => (this.dataProfile = res.data))
      // eslint-disable-next-line no-console
      .catch((err) => console.log(err));
  },

  computed: {
    totalHarga() {
      return this.keranjangUser.reduce(function (items, data) {
        return items + data.price;
      }, 0);
    },
  },
};
</script>

<style scoped>
.photo-item {
  width: 80px;
  height: 80px;
}
</style>
