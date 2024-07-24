<template>
  <div>
    <Head title="Admin" />
    <h1 class="mb-8 text-3xl font-bold">Admin</h1>
    <div class="flex items-center justify-between mb-6">
      <search-filter v-model="form.search" class="mr-4 w-full max-w-md" @reset="reset">
        <label class="block text-gray-700">Excluídos:</label>
        <select v-model="form.trashed" class="form-select mt-1 w-full">
          <option :value="null" />
          <option value="with">incluir Excluídos</option>
          <option value="only">apenas Excluídos</option>
        </select>
      </search-filter>
      <Link class="btn-slate" :href="route('painel.admin.create')">
        <span>Adicionar</span>
        <span class="hidden md:inline">&nbsp;Admin</span>
      </Link>
    </div>
    <div class="bg-white rounded-md shadow overflow-x-auto">
      <table class="w-full whitespace-nowrap">
        <thead>
          <tr class="text-left font-bold">
            <th class="pb-4 pt-6 px-6">Nome</th>
            <th class="pb-4 pt-6 px-6">Email</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="admin in admins.data" :key="admin.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
            <td class="border-t">
              <Link class="flex items-center px-6 py-4 focus:text-slate-500" :href="route('painel.admin.edit', { id: admin.id })">
                {{ admin.name }}
                <Icon v-if="admin.deleted_at" icon="mdi:delete" class="shrink-0 ml-2 w-3 h-3 fill-gray-400" />
              </Link>
            </td>
            <td class="border-t">
              <Link class="flex items-center px-6 py-4" :href="route('painel.admin.edit', { id: admin.id })" tabindex="-1">
                {{ admin.email }}
              </Link>
            </td>
            <td class="w-px border-t">
              <Link class="flex items-center px-4" :href="route('painel.admin.edit', { id: admin.id })" tabindex="-1">
                <Icon icon="mdi:chevron-right" class="block w-6 h-6 fill-gray-400" />
              </Link>
            </td>
          </tr>
          <tr v-if="admins.data.length === 0">
            <td class="px-6 py-4 border-t" colspan="4">Nenhum admin encontrado.</td>
          </tr>
        </tbody>
      </table>
    </div>
    <pagination class="mt-6" :links="admins.links" />
  </div>
</template>

<script>
import { Head, Link } from '@inertiajs/vue3'
import pickBy from 'lodash/pickBy'
import Layout from '@/Shared/Layout.vue'
import throttle from 'lodash/throttle'
import mapValues from 'lodash/mapValues'
import Pagination from '@/Shared/Pagination.vue'
import SearchFilter from '@/Shared/SearchFilter.vue'

export default {
  components: {
    Head,
    Link,
    Pagination,
    SearchFilter,
  },
  layout: Layout,
  props: {
    filters: Object,
    admins: Object,
  },
  data() {
    return {
      form: {
        search: this.filters.search,
        trashed: this.filters.trashed,
      },
    }
  },
  watch: {
    form: {
      deep: true,
      handler: throttle(function () {
        this.$inertia.get(route('painel.admin.index'), pickBy(this.form), { preserveState: true })
      }, 150),
    },
  },
  methods: {
    reset() {
      this.form = mapValues(this.form, () => null)
    },
  },
}
</script>
