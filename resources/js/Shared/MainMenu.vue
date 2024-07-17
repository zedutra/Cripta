<template>
  <div>
    <div class="mb-4">
      <Link class="group flex items-center py-3" :href="route('painel.home')">
        <Icon name="clipboard" color="white" class="mr-2 w-4 h-4" :class="isUrl('') ? 'fill-white' : 'fill-indigo-400 group-hover:fill-white'" />
        <div :class="isUrl('') ? 'text-white' : 'text-indigo-300 group-hover:text-white'">Dashboard</div>
      </Link>
    </div>
    <div class="mb-4">
      <Link class="group flex items-center py-3" :href="route('painel.admin.index')">
        <Icon name="person" class="mr-2 w-4 h-4" :class="isUrl(route('painel.admin.index')) ? 'fill-white' : 'fill-indigo-400 group-hover:fill-white'" />
        <div :class="isUrl(route('painel.admin.index')) ? 'text-white' : 'text-indigo-300 group-hover:text-white'">Admin</div>
      </Link>
    </div>
    <div class="mb-4">
      <Link class="group flex items-center py-3" :href="route('painel.user.index')">
        <Icon name="people" size="large" class="mr-2 w-4 h-4" :class="isUrl(route('painel.user.index')) ? 'fill-white' : 'fill-indigo-400 group-hover:fill-white'" />
        <div :class="isUrl(route('painel.user.index')) ? 'text-white' : 'text-indigo-300 group-hover:text-white'">User</div>
      </Link>
    </div>
  </div>
</template>

<script>
import { Link } from '@inertiajs/vue3'
import Icon from '@/Shared/Icon.vue'

export default {
  components: {
    Icon,
    Link,
  },
  methods: {
    isUrl(...urls) {
      let currentUrl = this.$page.url.substr(1)
      if (urls[0] === '') {
        return currentUrl === ''
      }
      return urls.filter((url) => currentUrl.startsWith(url)).length
    },
  },
}
</script>
