<template>
  <div>
    <div class="container">
      <div class="breacrumb-section text-left">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <div class="breadcrumb-text product-more">
                <router-link to="/"
                  ><i class="fa fa-home"></i> Home</router-link
                >
                <span>Produk</span>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row mt-3">
        <div class="col">
          <select
            class="form-control"
            v-model="selectedCategory"
            @input="filterProducts"
          >
            <option value="all">All Categories</option>
            <option
              v-for="itemProduct in products"
              :value="itemProduct.categories.category_name"
              v-bind:key="itemProduct.id"
            >
              {{ itemProduct.categories.category_name }}
            </option>
          </select>
        </div>
        <div class="col-5"></div>
        <div class="col">
          <div class="input-group mb-3">
            <input
              type="text"
              v-model="searchTerm"
              class="form-control"
              placeholder="Search . . ."
              @input="filterProducts"
              aria-label="Search"
              aria-describedby="basic-addon1"
            />
            <div class="input-group-prepend">
              <span class="input-group-text" id="basic-addon1">
                <i class="fa fa-search"></i>
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row justify-content-center">
      <div
        class="card ml-4 mt-4"
        style="width: 18rem"
        v-for="product in filteredProducts"
        :key="product.id"
      >
        <img
          v-bind:src="product.galleries[0].photo"
          class="card-img-top"
          alt="..."
        />
        <div class="card-body">
          <h5 class="card-title">{{ product.name }}</h5>

          <p
            v-if="!readMoreActivated"
            class="card-text"
            v-html="product.description.slice(0, 50)"
          ></p>
          <a
            class=""
            v-if="!readMoreActivated"
            @click="activateReadMore"
            href="#"
          >
            Lihat selengkapnya
          </a>
          <p
            v-if="readMoreActivated"
            class="card-text"
            v-html="product.description"
          ></p>
        </div>
        <ul class="list-group list-group-flush">
          <li class="list-group-item">
            <p class="badge badge-pill badge-secondary mb-8">
              {{ product.categories.category_name }}
            </p>
          </li>
          <li v-if="product.quantity" class="list-group-item">
            <p class="badge badge-pill badge-info">
              Stock : {{ product.quantity }}
            </p>
          </li>
          <li v-else class="list-group-item">
            <p class="badge badge-pill bg-danger">Stok Habis</p>
          </li>
          <li class="list-group-item">
            <p class="badge badge-pill badge-warning">
              Rp. {{ product.price | format_number }}
            </p>
          </li>
        </ul>
        <div class="card-body">
          <button
            @click="
              saveKeranjang(
                product.id,
                product.name,
                product.price,
                product.galleries[0].photo
              )
            "
            class="btn btn-secondary mr-3"
          >
            <i class="fa fa-cart-plus"></i>
          </button>
          <router-link v-bind:to="'/product/' + product.id"
            ><button class="btn btn-dark">
              <i class="fa fa-shopping-bag"></i></button
          ></router-link>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "MainWafa",

  data() {
    return {
      searchTerm: "",
      selectedCategory: "all",
      products: [],
      limit: 25,
      keranjangUser: [],

      readMoreActivated: false,
    };
  },

  filters: {
    format_number: function (value) {
      return parseInt(value).toLocaleString();
    },
  },

  computed: {
    filteredProducts() {
      let filtered = this.products;
      if (this.selectedCategory !== "all") {
        filtered = filtered.filter(
          (product) =>
            product.categories.category_name === this.selectedCategory
        );
      }
      if (this.searchTerm) {
        filtered = filtered.filter((product) =>
          product.name.toLowerCase().includes(this.searchTerm.toLowerCase())
        );
      }
      return filtered;
    },
  },
  methods: {
    saveKeranjang(idProduct, nameProduct, priceProduct, photoProduct) {
      var productStored = {
        id: idProduct,
        name: nameProduct,
        price: priceProduct,
        photo: photoProduct,
      };

      this.keranjangUser.push(productStored);
      const parsed = JSON.stringify(this.keranjangUser);
      localStorage.setItem("keranjangUser", parsed);

      window.location.reload();
    },

    filterProducts() {
      // this method doesn't need any implementation
      // the computed property filteredProducts will
      // automatically update when the searchTerm
      //or selectedCategory changes
    },
    activateReadMore() {
      this.readMoreActivated = true;
    },
  },
  mounted() {
    axios
      .get("http://localhost:8000/api/products")
      .then((res) => (this.products = res.data.data.data))
      .then((res) => (this.categories = res.data.data.data))
      // eslint-disable-next-line no-console
      .catch((err) => console.log(err));

    if (localStorage.getItem("keranjangUser")) {
      try {
        this.keranjangUser = JSON.parse(localStorage.getItem("keranjangUser"));
      } catch (e) {
        localStorage.removeItem("keranjangUser");
      }
    }
  },
};
</script>

<style scoped>
.card-img-top {
  width: 100%;
  height: 15vw;
  object-fit: cover;
}
</style>
