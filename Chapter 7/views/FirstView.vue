<template>
  <div :style="{ 'background-image': 'url(img/bg-login.jpg)' }">
    <div class="section">
      <div class="container">
        <div class="row full-height justify-content-center">
          <div class="col-12 text-center align-self-center py-5">
            <img
              src="img/wafa-logos_black.png"
              class="rounded float-center mb-4"
              width="300px"
            />
            <div class="section pb-5 pt-5 pt-sm-2 text-center">
              <div class="container">
                <p class="mb-0 pb-3">
                <span>Temukan gayamu bersama Wafa Fashion - Belanja mudah, pilihan bergaya.</span>
              </p>
              </div>
              
              <h4 class="mb-0 pb-3">
                <span>Log In </span> - <span>Sign Up</span>
              </h4>

              <input
                class="checkbox"
                type="checkbox"
                id="reg-log"
                name="reg-log"
              />
              <label for="reg-log"></label>

              <div class="card-3d-wrap mx-auto">
                <div class="card-3d-wrapper">
                  <div class="card-front">
                    <div class="center-wrap">
                      <div class="section text-center">
                        <h4 class="mb-4 pb-3">Log In</h4>

                        <form @submit.prevent="login">
                          <div class="form-group">
                            <input
                              type="email"
                              name="email"
                              class="form-style"
                              placeholder="Your Email"
                              id="email"
                              autocomplete="off"
                              v-model="email"
                              required
                            />
                            <i class="input-icon uil uil-at"></i>
                          </div>
                          <div class="form-group mt-2">
                            <input
                              type="password"
                              name="password"
                              class="form-style"
                              placeholder="Your Password"
                              id="password"
                              autocomplete="off"
                              v-model="password"
                              required
                            />
                            <i class="input-icon uil uil-lock-alt"></i>
                          </div>
                          <button
                            @click="login()"
                            type="submit"
                            class="btn mt-4"
                          >
                            log in
                          </button>
                        </form>

                        <p class="mb-0 mt-4 text-center">
                          <a href="#0" class="link">Forgot your password?</a>
                        </p>
                      </div>
                    </div>
                  </div>

                  <div class="card-back">
                    <div class="center-wrap">
                      <div class="section text-center">
                        <h4 class="mb-4 pb-3">Sign Up</h4>

                        <div class="form-group">
                          <input
                            type="text"
                            name="name"
                            class="form-style"
                            placeholder="Your Full Name"
                            id="name"
                            autocomplete="off"
                            v-model="name"
                          />

                          <i class="input-icon uil uil-user"></i>
                        </div>
                        <div class="form-group mt-2">
                          <input
                            type="email"
                            name="email"
                            class="form-style"
                            placeholder="Your Email"
                            id="email"
                            autocomplete="off"
                            v-model="email"
                          />

                          <i class="input-icon uil uil-at"></i>
                        </div>
                        <div class="form-group mt-2">
                          <input
                            type="password"
                            name="password"
                            class="form-style"
                            placeholder="Your Password"
                            id="password"
                            autocomplete="off"
                            v-model="password"
                          />

                          <i class="input-icon uil uil-lock-alt"></i>
                        </div>

                        <div class="form-group mt-2">
                          <input
                            type="text"
                            name="address"
                            class="form-style"
                            placeholder="Your address"
                            id="address"
                            autocomplete="off"
                            v-model="address"
                          />

                          <i class="input-icon uil uil-lock-alt"></i>
                        </div>

                        <div class="form-group mt-2">
                          <input
                            type="number"
                            name="number"
                            class="form-style"
                            placeholder="Your Phone Number"
                            id="number"
                            autocomplete="off"
                            v-model="number"
                          />

                          <i class="input-icon uil uil-lock-alt"></i>
                        </div>
                        <a @click="register()" class="btn mt-4">register</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import Swal from "sweetalert2";

export default {
  name: "FirstView",
  data() {
    return {
      name: "",
      email: "",
      password: "",
      address: "",
      number: "",
      error: "",
    };
  },
  methods: {
    async login() {
      if (!this.email || !this.password) {
        Swal.fire({
          title: "Error",
          text: "Email atau password harus diisi!",
          icon: "error",
        });
        return;
      }
      try {
        const response = await axios.post("http://localhost:8000/api/login", {
          email: this.email,
          password: this.password,
        });
        localStorage.setItem("access_token", response.data.access_token);
        localStorage.setItem("customer_id", response.data.customer_id);
        localStorage.setItem("customer_name", response.data.customer_name);
        localStorage.setItem('email', response.data.email)
        localStorage.setItem("address", response.data.address);
        localStorage.setItem("number", response.data.number);
        if (this.$route.path === "/home") {
          return;
        }
        this.$router.push("/home");
      } catch (error) {
        console.log(error.response.data);
        this.error = error.response.data.error;
        Swal.fire({
          icon: "error",
          title: "Oops...",
          text: this.error,
        });
      }
    },

  async register() {
    if (!this.name || !this.email || !this.password || !this.address || !this.number) {
      Swal.fire({
        title: "Error",
        text: "Harap isi semua data diperlukan!",
        icon: "error"
      });
      return;
    }
    try {
      // console.log(this.name, this.email, this.password, this.address, this.number)
        const response = await axios.post('http://localhost:8000/api/register', {
          customer_name: this.name,
          email: this.email,
          password: this.password,
          address: this.address,
          number: this.number
        })
        localStorage.setItem('access_token', response.data.access_token)
        localStorage.setItem('customer_id', response.data.customer_id)
        localStorage.setItem('customer_name', response.data.customer_name)
        localStorage.setItem('email', response.data.email)
        localStorage.setItem('address', response.data.address)
        localStorage.setItem('number', response.data.number)
        // window.location.reload();
      } catch (error) {
        console.log(error.response.data.error.email)
        // this.error = error.response.data.error
      }
      try {
        const response = await axios.post(
          "http://localhost:8000/api/register",
          {
            customer_name: this.name,
            email: this.email,
            password: this.password,
            address: this.address,
            number: this.number,
          }
        );
        localStorage.setItem("access_token", response.data.access_token);
        localStorage.setItem("customer_id", response.data.customer_id);
        localStorage.setItem("customer_name", response.data.customer_name);
        localStorage.setItem('email', response.data.email)
        localStorage.setItem("address", response.data.address);
        localStorage.setItem("number", response.data.number);
        // window.location.reload();
        Swal.fire({
          title: "Success",
          text: "Berhasil melakukan registrasi, silahkan menuju halaman login",
          icon: "success",
          timer: 5000
        });
      } catch (error) {
        if (error.response.data.error.email) {
          Swal.fire({
          title: "Success",
          text: "Berhasil melakukan registrasi, silahkan menuju halaman login",
          icon: "success",
          timer: 5000
          });
        }
      }
    },
  },
};
</script>

<style scoped>
body {
  font-family: "Poppins", sans-serif;
  font-weight: 300;
  font-size: 15px;
  line-height: 1.7;
  color: #c4c3ca;
  background-color: #1f2029;
  overflow-x: hidden;
}
a {
  cursor: pointer;
  transition: all 200ms linear;
}
a:hover {
  text-decoration: none;
}
.link {
  color: #c4c3ca;
}
.link:hover {
  color: #ffeba7;
}
p {
  font-weight: 500;
  font-size: 14px;
  line-height: 1.7;
}
h4 {
  font-weight: 600;
}
h6 span {
  padding: 0 20px;
  text-transform: uppercase;
  font-weight: 700;
}
.section {
  position: relative;
  width: 100%;
  display: block;
}
.full-height {
  min-height: 100vh;
}
[type="checkbox"]:checked,
[type="checkbox"]:not(:checked) {
  position: absolute;
  left: -9999px;
}
.checkbox:checked + label,
.checkbox:not(:checked) + label {
  position: relative;
  display: block;
  text-align: center;
  width: 60px;
  height: 16px;
  border-radius: 8px;
  padding: 0;
  margin: 10px auto;
  cursor: pointer;
  background-color: #ffeba7;
}
.checkbox:checked + label:before,
.checkbox:not(:checked) + label:before {
  position: absolute;
  display: block;
  width: 36px;
  height: 36px;
  border-radius: 50%;
  color: #ffeba7;
  background-color: #102770;
  font-family: "unicons";
  content: "\eb4f";
  z-index: 20;
  top: -10px;
  left: -10px;
  line-height: 36px;
  text-align: center;
  font-size: 24px;
  transition: all 0.5s ease;
}
.checkbox:checked + label:before {
  transform: translateX(44px) rotate(-270deg);
}

.card-3d-wrap {
  position: relative;
  width: 470px;
  max-width: 100%;
  height: 470px;
  -webkit-transform-style: preserve-3d;
  transform-style: preserve-3d;
  perspective: 800px;
  margin-top: 30px;
}
.card-3d-wrapper {
  width: 100%;
  height: 100%;
  position: absolute;
  top: 0;
  left: 0;
  -webkit-transform-style: preserve-3d;
  transform-style: preserve-3d;
  transition: all 600ms ease-out;
}
.card-front,
.card-back {
  width: 100%;
  height: 100%;
  background-color: #2a2b38;
  background-image: url("https://s3-us-west-2.amazonaws.com/s.cdpn.io/1462889/pat.svg");
  background-position: bottom center;
  background-repeat: no-repeat;
  background-size: 300%;
  position: absolute;
  border-radius: 6px;
  left: 0;
  top: 0;
  -webkit-transform-style: preserve-3d;
  transform-style: preserve-3d;
  -webkit-backface-visibility: hidden;
  -moz-backface-visibility: hidden;
  -o-backface-visibility: hidden;
  backface-visibility: hidden;
}
.card-back {
  transform: rotateY(180deg);
}
.checkbox:checked ~ .card-3d-wrap .card-3d-wrapper {
  transform: rotateY(180deg);
}
.center-wrap {
  position: absolute;
  width: 100%;
  padding: 0 35px;
  top: 50%;
  left: 0;
  transform: translate3d(0, -50%, 35px) perspective(100px);
  z-index: 20;
  display: block;
}

.form-group {
  position: relative;
  display: block;
  margin: 0;
  padding: 0;
}
.form-style {
  padding: 13px 20px;
  padding-left: 55px;
  height: 48px;
  width: 100%;
  font-weight: 500;
  border-radius: 4px;
  font-size: 14px;
  line-height: 22px;
  letter-spacing: 0.5px;
  outline: none;
  color: #c4c3ca;
  background-color: #1f2029;
  border: none;
  -webkit-transition: all 200ms linear;
  transition: all 200ms linear;
  box-shadow: 0 4px 8px 0 rgba(21, 21, 21, 0.2);
}
.form-style:focus,
.form-style:active {
  border: none;
  outline: none;
  box-shadow: 0 4px 8px 0 rgba(21, 21, 21, 0.2);
}
.input-icon {
  position: absolute;
  top: 0;
  left: 18px;
  height: 48px;
  font-size: 24px;
  line-height: 48px;
  text-align: left;
  color: #ffeba7;
  -webkit-transition: all 200ms linear;
  transition: all 200ms linear;
}

.form-group input:-ms-input-placeholder {
  color: #c4c3ca;
  opacity: 0.7;
  -webkit-transition: all 200ms linear;
  transition: all 200ms linear;
}
.form-group input::-moz-placeholder {
  color: #c4c3ca;
  opacity: 0.7;
  -webkit-transition: all 200ms linear;
  transition: all 200ms linear;
}
.form-group input:-moz-placeholder {
  color: #c4c3ca;
  opacity: 0.7;
  -webkit-transition: all 200ms linear;
  transition: all 200ms linear;
}
.form-group input::-webkit-input-placeholder {
  color: #c4c3ca;
  opacity: 0.7;
  -webkit-transition: all 200ms linear;
  transition: all 200ms linear;
}
.form-group input:focus:-ms-input-placeholder {
  opacity: 0;
  -webkit-transition: all 200ms linear;
  transition: all 200ms linear;
}
.form-group input:focus::-moz-placeholder {
  opacity: 0;
  -webkit-transition: all 200ms linear;
  transition: all 200ms linear;
}
.form-group input:focus:-moz-placeholder {
  opacity: 0;
  -webkit-transition: all 200ms linear;
  transition: all 200ms linear;
}
.form-group input:focus::-webkit-input-placeholder {
  opacity: 0;
  -webkit-transition: all 200ms linear;
  transition: all 200ms linear;
}

.btn {
  border-radius: 4px;
  height: 44px;
  font-size: 13px;
  font-weight: 600;
  text-transform: uppercase;
  -webkit-transition: all 200ms linear;
  transition: all 200ms linear;
  padding: 0 30px;
  letter-spacing: 1px;
  display: -webkit-inline-flex;
  display: -ms-inline-flexbox;
  display: inline-flex;
  -webkit-align-items: center;
  -moz-align-items: center;
  -ms-align-items: center;
  align-items: center;
  -webkit-justify-content: center;
  -moz-justify-content: center;
  -ms-justify-content: center;
  justify-content: center;
  -ms-flex-pack: center;
  text-align: center;
  border: none;
  background-color: #ffeba7;
  color: #102770;
  box-shadow: 0 8px 24px 0 rgba(255, 235, 167, 0.2);
}
.btn:active,
.btn:focus {
  background-color: #102770;
  color: #ffeba7;
  box-shadow: 0 8px 24px 0 rgba(16, 39, 112, 0.2);
}
.btn:hover {
  background-color: #102770;
  color: #ffeba7;
  box-shadow: 0 8px 24px 0 rgba(16, 39, 112, 0.2);
}

.logo {
  position: absolute;
  top: 30px;
  right: 30px;
  display: block;
  z-index: 100;
  transition: all 250ms linear;
}
.logo img {
  height: 26px;
  width: auto;
  display: block;
}
</style>
