
<template>
    <div id="sidebar" class='active'>
        <div class="sidebar-wrapper active">
            <div class="sidebar-header">
                <img src="/images/logo.svg" alt="" srcset="">
            </div>
            <div class="sidebar-menu">
                <ul class="menu">
                    <li class='sidebar-title'>Main Menu</li>
                    <router-link :to="{name: 'admin_dashboard'}" v-slot="{ href }" custom>
                                                    <!--  cara kedua untuk active class -->
                        <li class="sidebar-item"  :class="{ 'active': path === '/admin/'}">
                        <a :href="href" class='sidebar-link'>
                            <i data-feather="user" width="20"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    </router-link>
                    <li class='sidebar-title'>Master</li>
                    <router-link to="/admin/user" v-slot="{ href,isActive, isExactActive }"   custom>
                        <li class="sidebar-item" :class="{ 'active' : isActive , ' ' : isExactActive }">
                        <a :href="href" class='sidebar-link'>
                            <i data-feather="user" width="20"></i>
                            <span>Siswa</span>
                        </a>
                    </li>
                    </router-link>
                                                <!-- inpormai tentang link -->
                    <!--biding  ex :to="{name:'admin'}"   ; url , active, tidak -->
                    <router-link to="/admin/role"  v-slot="{ href,isActive, isExactActive }"    custom>
                                                    <!-- ini nambahin class -->
                        <li class="sidebar-item" :class="{ 'active' : isActive , ' ' : isExactActive }">
                        <a :href="href" class='sidebar-link' >
                            <i data-feather="home" width="20"></i>
                            <span>Role</span>
                        </a>
                    </li>
                    </router-link>
                </ul>
            </div>
            <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            path : this.$route.path,
        }
    },
}
</script>
