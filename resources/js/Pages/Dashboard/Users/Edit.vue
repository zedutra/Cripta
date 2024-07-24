<template>
  <div>
    <Head :title="`${form.name}`" />
    <div class="flex justify-start mb-8 max-w-3xl">
      <h1 class="text-3xl font-bold">
        <Link class="text-slate-400 hover:text-slate-600" :href="route('painel.user.index')">Users</Link>
        <span class="text-slate-400 font-medium">/</span>
        {{ form.name }}
      </h1>
    </div>
    <trashed-message v-if="user.deleted_at" class="mb-6" @restore="restore"> Esse usuário foi excluído. </trashed-message>
    <div class="max-w-3xl bg-white rounded-md shadow overflow-hidden">
      <form @submit.prevent="update">
        <div class="flex flex-wrap -mb-8 -mr-6 p-8">
          <text-input v-model="form.name" :error="form.errors.name" class="pb-8 pr-6 w-full" label="Nome" />
          <text-input v-model="form.email" :error="form.errors.email" class="pb-8 pr-6 w-full" label="Email" />
          <text-input v-model="form.password" :error="form.errors.password" class="pb-8 pr-6 w-full" type="password" label="Senha" />
          <text-input v-model="form.password_confirmation" :error="form.errors.password_confirmation" class="pb-8 pr-6 w-full" type="password" label="Confirmar Senha" />
        </div>
        <div class="flex items-center px-8 py-4 bg-gray-50 border-t border-gray-100">
          <button v-if="!user.deleted_at" class="text-red-600 hover:underline" tabindex="-1" type="button" @click="destroy">Excluir</button>
          <loading-button :loading="form.processing" class="btn-slate ml-auto" type="submit">Atualizar</loading-button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import { Head, Link } from '@inertiajs/vue3'
import Layout from '@/Shared/Layout.vue'
import TextInput from '@/Shared/TextInput.vue'
import FileInput from '@/Shared/FileInput.vue'
import SelectInput from '@/Shared/SelectInput.vue'
import LoadingButton from '@/Shared/LoadingButton.vue'
import TrashedMessage from '@/Shared/TrashedMessage.vue'

export default {
  components: {
    FileInput,
    Head,
    Link,
    LoadingButton,
    SelectInput,
    TextInput,
    TrashedMessage,
  },
  layout: Layout,
  props: {
    user: Object,
  },
  remember: 'form',
  data() {
    return {
      form: this.$inertia.form({
        _method: 'put',
        name: this.user.name,
        email: this.user.email,
        password: '',
        password_confirmation: '',
      }),
    }
  },
  methods: {
    update() {
      this.form.post(route('painel.user.update', this.user.id))
    },
    destroy() {
      if (confirm('Tem certeza de que deseja excluir este usuário?')) {
        this.$inertia.delete(route('painel.user.destroy', this.user.id))
      }
    },
    restore() {
      if (confirm('Tem certeza de que deseja restaurar este usuário?')) {
        this.$inertia.put(route('painel.user.restore', this.user.id))
      }
    },
  },
}
</script>
