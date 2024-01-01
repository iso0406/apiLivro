<template>
  <link 
      rel="stylesheet" 
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" 
  />
  <div v-if="modalRelatorio" class="w-full fixed inset-0 z-50 flex items-center justify-center">
    <div class="modal-overlay fixed inset-0 bg-black opacity-50"></div>
      <div class="modal-container bg-white w-1/2 rounded-lg shadow-lg z-50 rounded-md custom-border-radius">
          <div class="modal-header">
            <button type="button" class="close close-btn" @click="closeModal">
                <i class="far fa-times-circle mr-2 text-3xl"></i>
            </button>
          </div>
          <div class="modal-body">
              <p class="p-1 font-bold">Escolha a opção desejada.</p>
          </div>
          <div class="modal-footer flex justify-center">
            <div class="m-2">
                <button
                    type="button"
                    @click="imprimirPagina"
                    class="flex items-center py-2 px-6 shadow-sm text-sm font-medium rounded-md text-white bg-green-500 hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500"
                >
                <i class="fas fa-print mr-2"></i>  Imprimir
                </button>
            </div>
            <div class="m-2">
                <button
                  type="button"
                  @click="exportarPDF()"
                  class="flex items-center py-2 px-6 shadow-sm text-sm font-medium rounded-md text-white bg-green-500 hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500"
                >
                <i class="fas fa-file-pdf mr-2"></i> PDF
                </button>
            </div>
            <div class="m-2">
                <button
                  type="button"
                  @click="exportarEXCELL()"
                  class="flex items-center py-2 px-6 shadow-sm text-sm font-medium rounded-md text-white bg-green-500 hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500"
                >
                <i class="fas fa-file-excel mr-2"></i> EXCELL
                </button>
            </div>

            <div class="m-2">
                <button
                  type="button"
                  @click="exportarCSV()"
                  class="flex items-center py-2 px-6 shadow-sm text-sm font-medium rounded-md text-white bg-green-500 hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500"
                >
                <i class="fas fa-file-alt mr-2"></i> CSV 
                </button>
            </div>
          </div>
      </div>
  </div>
</template>

<script>
export default {
  emits: ['closeModal'],
  name: "modalRelatorio",
  props: {
    modalRelatorio: Boolean,
  },

  methods: {
    closeModal() {
      this.$emit("close-modal");
    },

    imprimirPagina() {
      this.$emit("close-modal");

      setTimeout(() => {
        window.print();
      }, 100);
    },

    exportarPDF() {
      try {
        this.loading = true;

        const url = `${process.env.VUE_APP_BACKEND_URL}gerarRelatorio`;
        window.location.href = url;

        this.loading = false;
      } catch (error) {
        console.log(error);
      }
    },

    exportarEXCELL() {
      return;
    },

    exportarCSV() {
      return;
    },
  },
};
</script>

<style scoped>
.modal-overlay {
  background-color: rgba(0, 0, 0, 0.5);
}

.modal-container {
  max-height: 80%;
  border: 1px solid #ccc;
  border-radius: 30px;
}

.modal-header {
  background-color: #f4f4f4;
  padding: 4px;
}

.modal-title {
  font-size: 1.125rem;
}

.modal-body {
  background-color: #f4f4f4;
  text-align: center;
}

.modal-footer {
  background-color: #f4f4f4;
}

/* Estilo para o botão de fechar */
.close-btn {
  cursor: pointer;
  padding: 0.5rem;
}
</style>