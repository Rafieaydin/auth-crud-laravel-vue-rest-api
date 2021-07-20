<template>
    <div class="card">
        <div class="card-body">
            <!-- header -->
            <template>
                <v-toolbar flat>
                    <v-toolbar-title>Data User</v-toolbar-title>
                    <v-divider class="mx-4" inset vertical></v-divider>
                    <v-spacer></v-spacer>
                    <v-btn color="primary" @click.prevent="tambahRoute()" dark class="mb-2">
                        Tambah Data
                    </v-btn>
                </v-toolbar>
            </template>
            <!-- end header -->
            <!-- title / search -->
            <v-card-title>
                <v-spacer></v-spacer>
                <!-- search engine -->
                <v-text-field v-model="search" append-icon="mdi-magnify" label="Search" single-line hide-details>
                </v-text-field>
            </v-card-title>
            <!-- end title / search -->
            <!-- table -->
            <!-- :header untuk header , : items untuk data , :search untuk search dan perpage untuk pagination -->
            <v-data-table :headers="headers" :items="data" :search="search" :items-per-page="10" class="elevation-2">
                <!--  action icon di json nya -->
                <template v-slot:item.action="{ item }">
                    <!-- icon menggunaka  v icon -->
                    <v-icon @click="editItem(item)">mdi-pencil</v-icon>
                    <v-icon color="error" @click="deleteItem(item)"> mdi-delete</v-icon>
                </template>
                <!-- end -->
            </v-data-table>
            </v-data-table>
        </div>

    </div>

</template>
<script>
    export default {
        data() {
            return {
                search: '',
                headers: [{
                        text: 'username',
                        value: 'name'
                    },
                    {
                        text: 'email',
                        value: 'email'
                    },
                    {
                        text: 'role',
                        value: 'role[0].nama_role'
                    },
                    {
                        text: 'created_at',
                        value: 'created_at'
                    },
                    {
                        text: 'action',
                        value: 'action'
                    }
                ],
                data: []
            }
        },
        methods: {
            getdata() {
                axios.get('/api/user').then((response) => {
                    this.data = response.data.user; // masukin data ke this data
                    console.log(this.data);
                });
            },
            tambahRoute() {
                this.$router.push('/admin/user/create'); // ke admin user create
            },
            editItem(item) {
                this.$router.push('/admin/user/' + item.id);
            },
            deleteItem(item) {
                Swal.fire({
                    title: 'Apa anda yakin ?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Iya',
                    cancelButtonText: 'Tidak'
                }).then((result) => {
                    if (result.isConfirmed) {
                        axios.delete('/api/user/' + item.id).then((response) => {
                            console.log('berhasil');
                            // delete tanpa reload
                            const idx = this.data.indexOf(item)
                            this.data.splice(idx, 1)
                            // alert
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            )
                        });
                    }
                })
            }
        },
        mounted() {
            this.getdata();
        },
    }

</script>
