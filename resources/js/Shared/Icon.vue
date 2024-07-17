<template>
  <ion-icon :icon="name" :size="size" :style="{ color: color }"></ion-icon>
</template>

<script>
import { IonIcon } from '@ionic/vue';

export default {
  props: {
    name: String,
    size: String,
    color: String,
  },
}
</script>
