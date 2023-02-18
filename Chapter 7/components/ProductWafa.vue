<template>
  <div>
    <!-- Breadcrumb Section Begin -->
    <div class="breacrumb-section text-left">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="breadcrumb-text product-more">
              <router-link to="/" href="#"
                ><i class="fa fa-home"></i> Home</router-link
              >
              <span>Detail</span>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Breadcrumb Section End -->

    <!-- Product Shop Section Begin -->
    <section class="product-shop spad page-details">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="row">
              <div class="col-lg-6">
                <div class="product-pic-zoom">
                  <img class="product-big-img" :src="gambar_default" alt="" />
                </div>
                <div
                  class="product-thumbs"
                  v-if="productDetails.galleries.length > 0"
                >
                  <carousel
                    :dots="false"
                    :nav="false"
                    :autoplay="true"
                    class="product-thumbs-track ps-slider"
                  >
                    <div
                      v-for="ss in productDetails.galleries"
                      :key="ss.id"
                      class="pt"
                      @click="changeImage(ss.photo)"
                      :class="ss.photo == gambar_default ? 'active' : ''"
                    >
                      <img :src="ss.photo" alt="" />
                    </div>
                  </carousel>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="product-details text-left">
                  <div class="pd-title">
                    <span>{{ productDetails.categories.category_name }}</span>
                    <h3>{{ productDetails.name }}</h3>
                  </div>
                  <div class="pd-desc">
                    <p v-html="productDetails.description"></p>

                    <h4>Rp. {{ productDetails.price | format_number }}</h4>
                  </div>
                  <label>Masukkan Jumlah Produk :</label>
                  <div class="quantity">
                    <form @submit.prevent="submitForm">
                      <input
                        class="form-control"
                        type="number"
                        v-model="newCart.quantity"
                        required
                      />
                      <button type="submit" class="btn mt-3">
                        <a
                          @click="
                            saveKeranjang(
                              productDetails.id,
                              productDetails.name,
                              productDetails.price,
                              productDetails.galleries[0].photo,
                              newCart.quantity
                            )
                          "
                          class="primary-btn pd-cart"
                          >Add To Cart</a
                        >
                      </button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Product Shop Section End -->
  </div>
</template>

<script>
import carousel from "vue-owl-carousel";

import axios from "axios";
import Swal from "sweetalert2";

export default {
  name: "ProductView",
  components: {
    carousel,
  },

  filters: {
    format_number: function (value) {
      return parseInt(value).toLocaleString();
    },
  },

  data() {
    return {
      gambar_default: "",
      productDetails: [],
      keranjangUser: [],
      newCart: [],
    };
  },

  methods: {
    changeImage(urlImage) {
      this.gambar_default = urlImage;
    },
    setDataPicture(data) {
      // replace object product detail dengan data dari API
      this.productDetails = data;
      // replace value gambar default dengan data dari API (galleries)
      this.gambar_default = data.galleries[0].photo;
    },

    saveKeranjang(
      idProduct,
      nameProduct,
      priceProduct,
      photoProduct,
      quantityProduct
    ) {
      if (quantityProduct == 0) {
        return;
      }
      var productStored = {
        id: idProduct,
        name: nameProduct,
        price: priceProduct,
        photo: photoProduct,
        quantity: quantityProduct,
      };

      if (quantityProduct > this.productDetails.quantity) {
        Swal.fire({
          title: "Stok tidak mencukupi",
          text: `Stok yang tersedia hanya ${this.productDetails.quantity}`,
        });
        return;
      }

      var isExist = false;
      for (var i = 0; i < this.keranjangUser.length; i++) {
        if (this.keranjangUser[i].id == idProduct) {
          if (quantityProduct > 0) {
            this.keranjangUser[i].quantity = +quantityProduct;
          }
          isExist = true;
          break;
        }
      }

      if (!isExist) {
        this.keranjangUser.push(productStored);
      }

      const parsed = JSON.stringify(this.keranjangUser);
      localStorage.setItem("keranjangUser", parsed);
    },

    submitForm() {
      if (this.newCart.quantity <= 0) {
        Swal.fire({
          title: "Quantity tidak valid",
          text: "Quantity harus lebih besar dari 0",
          icon: "error",
        });
      } else if (this.newCart.quantity > this.productDetails.quantity) {
        Swal.fire({
          title: "Stok tidak mencukupi",
          text: `Stok yang tersedia hanya ${this.productDetails.quantity}`,
          icon: "error",
        });
      } else if (
        this.newCart.quantity > 0 &&
        this.newCart.quantity <= this.productDetails.quantity
      ) {
        this.saveKeranjang(
          this.productDetails.id,
          this.productDetails.name,
          this.productDetails.price,
          this.productDetails.galleries[0].photo,
          this.newCart.quantity
        );
        Swal.fire({
          title: "Berhasil ditambahkan ke keranjang",
          icon: "success",
        });
        this.newCart.quantity = 0;
        this.$router.push("/shopping");
      }
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
      .get("http://localhost:8000/api/products", {
        params: {
          id: this.$route.params.id,
        },
      })
      .then((res) => this.setDataPicture(res.data.data))
      // eslint-disable-next-line no-console
      .catch((err) => console.log(err));
  },
};
</script>

<style scoped>
.product-thumbs .pt {
  margin-left: 10px;
}
</style>
