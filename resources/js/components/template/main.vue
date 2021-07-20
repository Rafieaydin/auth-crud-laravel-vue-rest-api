<template>
<!-- jika rolenya damin -->
    <div v-if="user.roles[0].nama_role == 'admin'">
        <admin-sidebar></admin-sidebar>
        <div id="main">
            <admin-navbar></admin-navbar>
            <div class="main-content container-fluid">
                <div class="page-title">
                    <h3></h3>
                    <!-- <p class="text-subtitle text-muted">A good dashboard to display your statistics</p> -->
                </div>
                <!-- dashboard -->
                <!-- end dashboard -->
                <section class="section">
                    <router-view></router-view>
                </section>
            </div>
        </div>
    </div>
    <!-- jika rolenya user -->
    <div v-else>
        <user-sidebar></user-sidebar>
        <div id="main">
            <user-navbar></user-navbar>
            <div class="main-content container-fluid">
                <div class="page-title">
                    <h3></h3>
                    <!-- <p class="text-subtitle text-muted">A good dashboard to display your statistics</p> -->
                </div>
                <!-- dashboard -->
                <!-- end dashboard -->
                <section class="section">
                    <router-view></router-view>
                </section>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        console.log(JSON.parse(localStorage.user));
        return {
            data : 'Main',
            user : JSON.parse(localStorage.user), // mengubah string menjadi json
            route : this.$route.name,
        }
    },
}
</script>
