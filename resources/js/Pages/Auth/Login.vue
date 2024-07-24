<template>
  <Head title="Login" />
  <div class="flex items-center justify-center p-6 min-h-screen bg-slate-800">
    <div class="w-full max-w-md">
      
      <form class="mt-8 bg-white rounded-lg shadow-xl overflow-hidden" @submit.prevent="login">
        <div class="px-10 py-12">
          <div class="block mx-auto w-full max-w-xs fill-white flex text-center items-center justify-center text-5xl text-gray-700">
            <h1 class="shadows-into-light-regular">CRIPTA</h1>
            <Icon icon="game-icons:william-tell-skull" size="large" class="ml-2"/>
          </div>
          <div class="mt-6 mx-auto w-24 border-b-2 border-gray-700" />
          <text-input v-model="form.email" :error="form.errors.email" class="mt-10" label="E-mail" type="email" autofocus autocapitalize="off" />
          <text-input v-model="form.password" :error="form.errors.password" class="mt-6" label="Senha" type="password" />
          <label class="flex items-center mt-6 select-none" for="remember">
            <input id="remember" v-model="form.remember" class="mr-1" type="checkbox" />
            <span class="text-sm">Lembrar</span>
          </label>
          <div class="mt-4 text-gray-700 hover:text-zinc-400 underline">
              <Link :href="route('register')">
              Não tem uma conta? Registre-se aqui.
              </Link>
          </div>
        </div>
        <div class="flex px-10 py-4 bg-gray-100 border-t border-gray-100">
          <loading-button :loading="form.processing" class="btn-slate ml-auto" type="submit">Login</loading-button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import { Head, Link } from '@inertiajs/vue3'
import Logo from '@/Shared/Logo.vue'
import TextInput from '@/Shared/TextInput.vue'
import LoadingButton from '@/Shared/LoadingButton.vue'

export default {
  components: {
    Head,
    Link,
    LoadingButton,
    Logo,
    TextInput,
  },
  data() {
    return {
      form: this.$inertia.form({
        email: 'johndoe@example.com',
        password: 'secret',
        remember: false,
      }),
    }
  },
  methods: {
    login() {
      this.form.post('/login')
    },
  },
}
</script>
