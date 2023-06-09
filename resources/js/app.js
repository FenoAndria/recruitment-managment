import Alpine from 'alpinejs'

window.Alpine = Alpine

Alpine.start()

import { createApp } from 'vue'
import App from './App.vue'
import Router from './Router/index'
import Store from './Stores'

import dayjs from 'dayjs'

const app = createApp(App)
app.config.globalProperties.$dayjs = dayjs

app.use(Router).use(Store).mount('#app')