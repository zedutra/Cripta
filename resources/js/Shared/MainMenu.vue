<template>
  <div>
    <div class="mb-4">
      <Link class="group flex items-center py-3" :href="route('painel.home')">
        <Icon icon="mdi:clipboard-text-multiple" class="mr-2 w-4 h-4" :class="isUrl(route('painel.home', undefined, false)) ? 'text-white' : 'text-slate-400 group-hover:text-white'" />
        <div :class="isUrl(route('painel.home', undefined, false)) ? 'text-white' : 'text-slate-300 group-hover:text-white'">Dashboard</div>
      </Link>
    </div>
    <div class="mb-4">
      <Link class="group flex items-center py-3" :href="route('painel.admin.index')">
        <Icon icon="mdi:account-cog" class="mr-2 w-4 h-4" :class="isUrl(route('painel.admin.index', undefined, false)) ? 'text-white' : 'text-slate-400 group-hover:text-white'" />
        <div :class="isUrl(route('painel.admin.index', undefined, false)) ? 'text-white' : 'text-slate-300 group-hover:text-white'">Admin</div>
      </Link>
    </div>
    <div class="mb-4">
      <Link class="group flex items-center py-3" :href="route('painel.user.index')">
        <Icon icon="mdi:account" size="large" class="mr-2 w-4 h-4" :class="isUrl(route('painel.user.index', undefined, false)) ? 'text-white' : 'text-slate-400 group-hover:text-white'" />
        <div :class="isUrl(route('painel.user.index', undefined, false)) ? 'text-white' : 'text-slate-300 group-hover:text-white'">User</div>
      </Link>
    </div>
  </div>
</template>

<script>
import { Link } from '@inertiajs/vue3'

export default {
  components: {
    Link,
  },
  methods: {
    isUrl(url) {
      let currentUrl = this.$page.url
      return currentUrl === url
    },
  },
}
</script>
