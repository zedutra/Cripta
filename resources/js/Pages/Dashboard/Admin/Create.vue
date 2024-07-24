<template>
  <div>

    <Head title="Cadastrar Admin" />
    <h1 class="mb-8 text-3xl font-bold">
      <Link class="text-slate-400 hover:text-slate-600" :href="route('painel.user.index')">Admin</Link>
      <span class="text-slate-400 font-medium">/</span> Cadastrar
    </h1>
    <div class="max-w-3xl bg-white rounded-md shadow overflow-hidden">
      <form @submit.prevent="store">
        <div class="flex flex-wrap -mb-8 -mr-6 p-8">
          <text-input v-model="form.name" :error="form.errors.name" class="pb-8 pr-6 w-full" label="Nome" />
          <text-input v-model="form.email" :error="form.errors.email" class="pb-8 pr-6 w-full" label="Email" />
          <text-input v-model="form.password" :error="form.errors.password" class="pb-8 pr-6 w-full" type="password" label="Senha" />
          <text-input v-model="form.password_confirmation" :error="form.errors.password_confirmation" class="pb-8 pr-6 w-full" type="password" label="Confirmar Senha" />
        </div>
        <div class="flex items-center justify-end px-8 py-4 bg-gray-50 border-t border-gray-100">
          <loading-button :loading="form.processing" class="btn-slate" type="submit">Registrar</loading-button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import { Head, Link } from '@inertiajs/vue3'
import Layout from '@/Shared/Layout.vue'
import FileInput from '@/Shared/FileInput.vue'
import TextInput from '@/Shared/TextInput.vue'
import SelectInput from '@/Shared/SelectInput.vue'
import LoadingButton from '@/Shared/LoadingButton.vue'

export default {
  components: {
    FileInput,
    Head,
    Link,
    LoadingButton,
    SelectInput,
    TextInput,
  },
  layout: Layout,
  remember: 'form',
  data() {
    return {
      form: this.$inertia.form({
        name: '',
        email: '',
        password: '',
        password_confirmation: '',
      }),
    }
  },
  methods: {
    store() {
      this.form.post(route('painel.admin.store'))
    },
  },
}
</script>
