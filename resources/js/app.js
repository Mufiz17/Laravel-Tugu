import './bootstrap';
import { createApp } from 'vue';
import { createPinia } from 'pinia'
// import { useAuthStore } from './stores/auth'
import router from './router'
import App from './App.vue'
import '../css/app.css';

const app = createApp(App)
app.use(createPinia())
app.use(router)

// const auth = useAuthStore()
// await auth.init()

app.mount('#app')