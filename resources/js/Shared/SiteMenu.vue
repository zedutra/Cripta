<template>
  <div>
    <div class="mb-4">
      <Link class="group flex items-center py-3" :href="route('welcome')">
        <Icon icon="mdi:house" class="mr-2 w-4 h-4" :class="isUrl(route('welcome', undefined, false)) ? 'text-white' : 'text-slate-400 group-hover:text-white'" />
        <div :class="isUrl(route('welcome', undefined, false)) ? 'text-white' : 'text-slate-300 group-hover:text-white'">Início</div>
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
