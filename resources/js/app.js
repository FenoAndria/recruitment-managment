import Alpine from 'alpinejs'

window.Alpine = Alpine

Alpine.start()

import { createApp } from 'vue'
import App from './App.vue'
import Router from './Router/index'

createApp(App).use(Router).mount('#app')