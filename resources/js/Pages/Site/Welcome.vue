<template>
  <div>

    <Head title="Bem Vindo!" />
    <vue-final-modal v-model="showModal" classes="flex justify-center items-center"
      content-class="justify-center items-center relative flex flex-col max-h-full mx-4 p-4 rounded bg-slate-900 text-white w-8/12">
      <div class="mt-1 flex text-white text-2xl items-center">
        <h1 class="shadows-into-light-regular">BEM VINDO A CRIPTA</h1>
        <Icon icon="game-icons:william-tell-skull" size="large" class="ml-2" />
      </div>
      <hr class="my-3 border w-1/3">
      <textarea-input rows="100" v-model="publicKey" class="w-full placeholder:bg-red-100 focus:outline-none" readonly/>
      <div class="flex items-end justify-end w-full pt-3">
        <loading-button v-if="!publicKey && !privateKey" class="btn-slate" @click="handleGenerate">
          Gerar Chaves
          <Icon v-if="loading" icon="line-md:loading-loop" class="ml-2 w-4 h-4"/>
        </loading-button>
        <loading-button v-if="publicKey && privateKey && !keyDownloaded" class="btn-slate" @click="downloadPrivateKey">
          Baixar Chave Privada
          <Icon icon="mdi:download" class="ml-2 w-4 h-4"/>
        </loading-button>
        <loading-button v-if="publicKey && privateKey && keyDownloaded" class="btn-slate">
          Salvar
        </loading-button>
      </div>
    </vue-final-modal>
    <button @click="showModal = true">Open Modal</button>
    <div class="flex items-center justify-end px-8 py-4 bg-gray-50 border-t border-gray-100">
      <loading-button class="btn-slate" @click="showModal = true">Open</loading-button>
    </div>
  </div>
</template>

<script>
import { Head, Link } from '@inertiajs/vue3'
import SiteLayout from '@/Shared/SiteLayout.vue'
import LoadingButton from '@/Shared/LoadingButton.vue'
import TextareaInput from '@/Shared/TextareaInput.vue'
import forge from 'node-forge';

export default {
  components: {
    Head,
    Link,
    TextareaInput,
    LoadingButton,
  },
  layout: SiteLayout,
  data() {
    return {
      showModal: false,
      loading: false,
      keyDownloaded: false,
      publicKey: '',
      privateKey: '',
    }
  },
  methods: {
    generateKeys() {
      // Generate RSA key pair
      const { privateKey, publicKey } = forge.pki.rsa.generateKeyPair(2048);

      // Convert the keys to PEM format
      this.publicKey = forge.pki.publicKeyToPem(publicKey);
      this.privateKey = forge.pki.privateKeyToPem(privateKey);
      console.log(this.privateKey);
    },
    async handleGenerate() {
      this.loading = true;
      await new Promise(resolve => setTimeout(resolve, 0));
      this.generateKeys();
      this.loading = false;
    },
    downloadPrivateKey() {
      // Cria um Blob com o conteúdo da chave privada
      const blob = new Blob([this.privateKey], { type: 'text/plain' });
      
      // Cria uma URL para o Blob
      const url = URL.createObjectURL(blob);
      
      // Cria um link temporário
      const a = document.createElement('a');
      a.href = url;
      a.download = 'cripta_pk.pem';  // Nome do arquivo a ser baixado
      
      // Aciona o download
      document.body.appendChild(a);
      a.click();
      this.keyDownloaded = true;
      
      // Limpa a URL e remove o link temporário
      URL.revokeObjectURL(url);
      document.body.removeChild(a);
    },
  },
}
</script>
