<template>
    <div class="card">
        <!-- <div class="card-header">
                            <h4 class="card-title">Basic Inputs</h4>
                        </div> -->

        <div class="card-body">
            <div class="row">

                <div class="col-md-12">
                    <form @submit.prevent="udpateFrom()" action="/api/user" method="POST">
                        <div class="form-group">
                            <label for="helpInputTop">Username</label>
                            <input type="text" class="form-control" id="helpInputTop" placeholder="Masukan Username"
                                v-model="form.name" v-bind:class="{ 'is-invalid': erorr.name }">
                            <div v-if="erorr.name" class="invalid-feedback">
                                {{ erorr.name[0]  }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="basicInput">Email</label>
                            <input type="text" class="form-control " id="basicInput" placeholder="Masukan Email"
                                v-model="form.email" v-bind:class="{ 'is-invalid': erorr.email }">
                            <div v-if="erorr.email" class="invalid-feedback">
                                {{ erorr.email[0]  }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="helperText">kelas</label>
                            <select class="form-control" v-bind:class="{ 'is-invalid': erorr.role }" name="" id=""
                                v-model="form.role">
                                <option value="">-- Pilih Role --</option>
                                <!-- loop role nya -->
                                <!-- for datas in data  -->
                                <option v-for="options in option" v-bind:value="options.id">
                                    {{ options.nama_role }}</option>
                            </select>
                            <div v-if="erorr.role" class="invalid-feedback">
                                {{ erorr.role[0]  }}
                            </div>
                            <!-- <p><small class="text-muted"></small> -->
                            </p>
                        </div>

                        <div class="form-group">
                            <label for="helperText">Password</label>
                            <input type="password" id="helperText" class="form-control" placeholder="Masukan Passwword"
                                v-model="form.password" v-bind:class="{ 'is-invalid': erorr.password }">
                            <div v-if="erorr.password" class="invalid-feedback">
                                {{ erorr.password[0]  }}
                            </div>
                            </p>
                        </div>
                        <router-link to="/admin/user" class="btn btn-danger">Kembali</router-link>
                        <button type="submit" class="btn btn-success">Submit</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</template>
<script>
    export default {
        props: ['id'], // propp untuk mendapatkan id dair url
        data() {
            return {
                form: {
                    name: '',
                    email: '',
                    password: '',
                    role: ''
                },
                erorr: [],
                option: [],
            }
        },
        methods: {
            getData() {
                // mendapatkan data dari edit
                axios.get('/api/user/'+this.id +'/edit').then((response)=>{
                    console.log(response.data.user.role[0].id);
                    // ini masukin isi value dari form
                    this.form = response.data.user; // memasukan data user
                    // ngambil dari isi role
                    this.form.role = response.data.user.role[0].id; // memasukan role
                    console.log(this.form);
                });
            },
            getRole() {
                //  mengambil value dari option dari api
                axios.get('/api/user/option').then((response) => {
                    console.log(response);
                    // set value dari option
                    this.option = response.data.option;
                });
            },
            udpateFrom(){
                console.log(this.form);
                // update data make api
                axios.put('/api/user/' + this.id, this.form).then((response) => {
                    // push ke user
                      this.$noty.success("Data berhasil di update!");
                    this.$router.push('/admin/user');
                }).catch((erorr) => {
                    // response erorr
                    // isi this.erorr = erorr.name[0] <- contohnya
                    this.erorr = erorr.response.data.errors
                });
            }
        },
        mounted() {
            //  mengambil value dari option
            this.getRole();
            // mengambil data
            this.getData();
            console.log(this.getData());
        },
    }

</script>
