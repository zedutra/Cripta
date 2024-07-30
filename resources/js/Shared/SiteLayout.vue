<template>
  <div>
    <div id="dropdown" />
    <div class="md:flex md:flex-col">
      <div class="md:flex md:flex-col md:h-screen">
        <div class="md:flex md:shrink-0">
          <div class="flex items-center justify-center px-6 py-4 bg-slate-900 md:shrink-0 md:w-56">
            <Link class="mt-1 flex text-white text-2xl items-center" href="/">
              <h1 class="shadows-into-light-regular">CRIPTA</h1>
              <Icon icon="game-icons:william-tell-skull" size="large" class="ml-2"/>
            </Link>
            <dropdown class="md:hidden" placement="bottom-end">
              <template #default>
                <svg class="w-6 h-6 fill-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z" /></svg>
              </template>
              <template #dropdown>
                <div class="mt-2 px-8 py-4 bg-slate-800 rounded shadow-lg">
                  <site-menu />
                </div>
              </template>
            </dropdown>
          </div>
          <div class="md:text-md flex items-center justify-end p-4 w-full text-sm bg-white border-b md:px-12 md:py-0">
            <dropdown class="mt-1" placement="bottom-end">
              <template #default>
                <div class="group flex items-center cursor-pointer select-none">
                  <div class="mr-1 text-gray-700 group-hover:text-slate-600 focus:text-slate-600 whitespace-nowrap">
                    <span>{{ auth.user.name }}</span>
                  </div>
                  <icon class="w-5 h-5 fill-gray-700 group-hover:fill-slate-600 focus:fill-slate-600" icon="mdi:chevron-down" />
                </div>
              </template>
              <template #dropdown>
                <div class="mt-2 py-2 text-sm bg-white rounded shadow-xl">
                  <Link class="block px-6 py-2 w-full text-left hover:text-white hover:bg-slate-500" href="/logout" method="delete" as="button">Sair</Link>
                </div>
              </template>
            </dropdown>
          </div>
        </div>
        <div class="md:flex md:grow md:overflow-hidden">
          <site-menu class="hidden shrink-0 p-12 w-56 bg-slate-800 overflow-y-auto md:block" />
          <div class="px-4 py-8 md:flex-1 md:p-12 md:overflow-y-auto" scroll-region>
            <flash-messages />
            <slot />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { Link } from '@inertiajs/vue3'
import Logo from '@/Shared/Logo.vue'
import Dropdown from '@/Shared/Dropdown.vue'
import SiteMenu from '@/Shared/SiteMenu.vue'
import FlashMessages from '@/Shared/FlashMessages.vue'

export default {
  components: {
    Dropdown,
    FlashMessages,
    Link,
    Logo,
    SiteMenu,
  },
  props: {
    auth: Object,
  },
}
</script>
