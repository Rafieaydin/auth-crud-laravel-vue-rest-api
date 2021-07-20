<template>
    <div class="row">
        <div class="col-12 col-md-3">
            <div class="card card-statistic">
                <div class="card-body p-0">
                    <div class="d-flex flex-column">
                        <div class="px-3 py-3 d-flex justify-content-between">
                            <h3 class="card-title"> <i data-feather="user" style="width: 30px; height: 30px"></i> User
                            </h3>
                        </div>
                        <div class="card-right ml-3 mb-4">
                            <p>{{ data.user }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-3">
            <div class="card card-statistic">
                <div class="card-body p-0">
                    <div class="d-flex flex-column">
                        <div class="px-3 py-3 d-flex justify-content-between">
                            <h3 class="card-title"> <i data-feather="home" style="width: 30px; height: 30px"></i> Role
                            </h3>
                        </div>
                        <div class="card-right ml-3 mb-4">
                            <p>{{ data.role }} </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                data: {
                    user: '0',
                    role: '0', //default value = 0
                }
            }
        },
        methods: {
            getAllData() {
                // manggil api dashboard baut isinys
                axios.get('/api/dashboard').then((response) => {
                    this.data = {
                        user: response.data.user,
                        role: response.data.role,
                    }
                    console.log(response);
                })
            }
        },
        mounted() {
            this.getAllData(); //dptin datanya
        },
    }
</script>
