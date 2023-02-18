<template>
    <div>
        <header-wafa />
        <div class="container rounded bg-white mt-5 mb-5">
            <div class="row">
                <div class="col-md-3 border-right">
                    <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                        <img class="rounded-circle mt-5" width="150px"
                            src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg" /><span
                            class="font-weight-bold">{{
                                dataProfile.customer_name
                            }}</span><span class="text-black-50">{{ dataProfile.email }}</span><span> </span>
                    </div>
                </div>
                <div class="col-md-8 border-right">
                    <div class="p-3 py-5">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="text-right">Profile Settings</h4>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <label class="labels">Nama</label>
                                <input type="text" class="form-control" placeholder="Nama Lengkap..." value=""
                                    v-model="name" />
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <label class="labels">Email</label>
                                <input type="text" class="form-control" placeholder="example@wafa.com" value=""
                                    v-model="email" />
                            </div>
                            <div class="col-md-12">
                                <label class="labels">Password</label>
                                <input type="password" class="form-control" placeholder="Password..." value=""
                                    v-model="password" />
                            </div>
                            <div class="col-md-12">
                                <label class="labels">Konfirmasi Password</label>
                                <input type="password" name="password_confirmation" class="form-control"
                                    placeholder="Ketik ulang Password..." value="" v-model="password_confirm" />
                            </div>
                            <div class="col-md-12">
                                <label class="labels">Alamat</label>
                                <textarea type="text" class="form-control" placeholder="Alamat..." value=""
                                    v-model="address"></textarea>
                            </div>
                            <div class="col-md-12">
                                <label class="labels">Nomor Hp</label>
                                <input type="number" class="form-control" placeholder="Konfirmasi Password" value=""
                                    v-model="number" />
                            </div>
                        </div>
                        <div class="mt-5 text-center">
                            <button @click="updateProfile()" class="btn btn-primary profile-button" type="submit">
                                Save Profile
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer-wafa />
    </div>
</template>
<script>
import HeaderWafa from "@/components/HeaderWafa.vue";
import FooterWafa from "@/components/FooterWafa.vue";
import axios from "axios";
import Swal from "sweetalert2";
export default {
    name: "ProfileView",
    components: {
        HeaderWafa,
        FooterWafa,
    },
    data() {
        return {
            dataProfile: [],
            name: "",
            email: "",
            password: "",
            password_confirm: "",
            address: "",
            number: "",
            error: "",
        };
    },
    methods: {
        updateProfile() {
            let updateData = {
                customer_name: this.name,
                email: this.email,
                password: this.password,
                password_confirmation: this.password_confirm,
                address: this.address,
                number: this.number,
            };
            axios.post(
                "http://localhost:8000/api/updateProfile/" +
                localStorage.getItem("customer_id"),
                updateData
            );
            Swal.fire({
                title: "Success",
                text: "Berhasil melakukan update profile!, silahkan refresh halamannya!",
                icon: "success",
                timer: 5000,
            });
        },
    },
    mounted() {
        axios
            .get(
                "http://localhost:8000/api/getProfileById/" +
                localStorage.getItem("customer_id")
            )
            .then((res) => {
                this.dataProfile = res.data;
                this.name = this.dataProfile.customer_name;
                this.email = this.dataProfile.email;
                this.address = this.dataProfile.address;
                this.number = this.dataProfile.number;
            })
            // eslint-disable-next-line no-console
            .catch((err) => console.log(err));
    },
};
</script>
