import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter);

// router pages login
import auth_login from '../pages/auth/login.vue';
import auth_register from '../pages/auth/register.vue';
// admin
import admin_main from '../components/template/main.vue';
import admin_dashboard from '../pages/admin/dashboard.vue' // dashboard
// user admin
import admin_user from '../pages/admin/User/index.vue'; // index component
import admin_user_create from '../pages/admin/User/create.vue'; // create component
import admin_user_edit from '../pages/admin/User/edit.vue'; // edit component
// role admin
import admin_role from '../pages/admin/Role/index.vue';
import admin_role_create from '../pages/admin/Role/create.vue'
import admin_role_edit from '../pages/admin/Role/edit.vue'
//user route
import user_main from '../components/template/main.vue'; // main atau template
import user_dashboard from '../pages/user/dashboard.vue'; //dashboard
import user_index from '../pages/user/index.vue'; // index



// ini route nya
const routes = [{
        // jika page kosong maka akan ke redirect ke login
        name: '*',
        path: '*',
        beforeEnter: (to, from, next) => { // sebelum enter maka ke direct ke login
                next('/login');
        }
        },
        {
            // login auth
            name: 'login',
            path: '/login',
            component: auth_login,
        },
        {
            name: 'register',
            path: '/register',
            component: auth_register,
        },
        {
        // role admin
        // role user ( kalau role harus memakai child nya kalau kalau ga nanti redirect if autenticatenya nanti gabisa )
        // parent route admin
        name: 'admin',
        path: '/admin/',
        component: admin_main,
        meta: {
            requiresAuth: true, // meta ngasih tau membutuhkan login
            isAdmin: true // meta untuk mengasih tau membutuh kan role admin ini parent nya
        },
        // beforeRouteEnter: (to, from, next) => {
        //     next('/admin/dasboard'); // sebelum enter pindain ke dashboard
        // },
        // ini cild nya jadi ngambil prefix dari parent
        // contoh /admin/dashboard
        children: [{
                name: 'admin_dashboard',
                path: '', // di kosongin biar bisa nested route ngambil url dari parent
                component: admin_dashboard
            },
            {
                name: 'admin_user',
                path: 'user',
                component: admin_user
            },
            {
                name: 'admin_user_create',
                path: 'user/create',
                component: admin_user_create
            },
            {
                name: 'admin_user_edit',
                path: 'user/:id',
                component: admin_user_edit,
                props: true,
            },
            {
                name: 'admin_role',
                path: 'role',
                component: admin_role
            },
            {
                name: 'admin_role_create',
                path: 'role/create',
                component: admin_role_create
            },
            {
                name: 'admin_role_edit',
                path: 'role/:id',
                component: admin_role_edit,
                props: true,
            },

        ],
    },
    {
        // role user ( kalau role harus memakai child nya kalau kalau ga nanti redirect if autenticatenya nanti gabisa )
        name: 'user',
        path: '/user/',
        component: user_main,
        meta: {
            requiresAuth: true,
            isUser: true
        },
        // beforeEnter: (to, from, next) => {
        //     next('/user/dashboard') // sebelum enter pindain ke dashboard
        // },
        children: [{
            name: 'user_dashboard',
            path: '',
            component: user_dashboard
        }, {
            name: 'user_index',
            path: 'index',
            component: user_index
        }],
    },

]




// configurasi
const router = new VueRouter({
    // mengahpus tanya #
    mode: 'history',
    routes: routes, // ituin route nya
});


// beforeach ini funtion sebelum di jalakanya route
router.beforeEach((to, from, next) => {
    // ngecek kalau di arraynya ada isinya atau true
    // make matched untuk mengubah ke array of object
    // some untuk mengecek isi array nya
    // contoh
    // console.log(to.matched.some(record => true));

    // contoh untuk memakai meta  requiresAuth
    // jika membuatuhkan login / requiresAuth
    if (to.matched.some(isi => isi.meta.requiresAuth)) {
        // mencari token dari local storage
        let token = localStorage.token != null;
        // jika token kosong
        if (!token) {
            // kembali ke login
            next('/login')
        } else {
            // mencari user di localstorage
            let user = JSON.parse(localStorage.user);
            // console.log(to.matched.some(isi => isi.meta.isUser));
            // mendapta kan role menggunakan map untuk mengambil isi nya mengunakan anonymous funtion
            let role = user.roles[0].nama_role;

            // cek meta jika metanya trus seperti di atas nya true
            if (to.matched.some(isi => isi.meta.isUser)) {
                // cari role
                switch (role) {
                    case 'user': // jika role user
                        next(); // lanjutkan karena user ada meta is user
                        break;
                    case 'admin': // jika role admin maka ke admin beserta child nya
                        next('/admin/'); // ke / admin/dashboard yang ada meta is adminnya
                        break;
                    // default:
                    //     next('/login');
                    //     break;

                }
            } else
                // cek meta jika metanya is admin sberarti true
                if (to.matched.some(isi => isi.meta.isAdmin)) {
                    // cari role
                    switch (role) {
                        case 'admin': // jika role admin karena ada meta is adminya
                            next(); // lanjutkan
                            break;
                        case 'user': // jika role use
                            next('/user/'); // maka di lanjutkan ke user
                            break;
                        // default:
                        //     next('/login');
                        //     break;
                    }
                }
        }
    } else {
        next();
    }

});

// balikin atau export default nya route nya
export default router
