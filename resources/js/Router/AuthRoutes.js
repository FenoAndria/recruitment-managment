import Login from './../Views/Auth/Login.vue'
import Register from './../Views/Auth/Register.vue'

const AuthRoutes =
    [
        {
            path: '/register',
            name: 'Register',
            component: Register,
            meta: {
                middleware: 'guest',
                title: 'Register'
            },
        },
        {
            path: '/login',
            name: 'Login',
            component: Login,
            meta: {
                middleware: 'guest',
                title: 'Login'
            }
        }
    ]
export default AuthRoutes