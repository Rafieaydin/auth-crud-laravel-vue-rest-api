<template>
    <div class="card">
        <!-- <div class="card-header">
                            <h4 class="card-title">Basic Inputs</h4>
                        </div> -->

        <div class="card-body">
            <div class="row">

                <div class="col-md-12">
                    <form @submit.prevent="StoreForm()" action="/api/user" method="POST">
                        <div class="form-group">
                            <label for="helpInputTop">Nama role</label>
                            <input type="text" class="form-control" id="helpInputTop" placeholder="Masukan Username"
                                v-model="form.nama_role" v-bind:class="{ 'is-invalid': erorr.nama_role }">
                            <div v-if="erorr.nama_role" class="invalid-feedback">
                                {{ erorr.nama_role[0]  }}
                            </div>
                        </div>
                        <router-link to="/admin/role" class="btn btn-danger">Kembali</router-link>
                        <button type="submit" class="btn btn-success">Submit</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                form: {
                    nama_role : '',
                },
                erorr: [],
                option: [],
            }
        },
        methods: {
            StoreForm(){
                // post data make api user
                axios.post('/api/role', this.form).then((response) => {
                    // console.log(response.data.pesan);
                    // redirect('/admin/user')
                    this.$noty.success("Data berhasil di tambahkan!");
                    this.$router.push('/admin/role');
                }).catch((erorr) => {
                    // response erorr
                    // isi this.erorr = erorr.name[0] <- contohnya
                    this.erorr = erorr.response.data.errors
                });
            }
        },
        mounted() {

        },
    }

</script>
