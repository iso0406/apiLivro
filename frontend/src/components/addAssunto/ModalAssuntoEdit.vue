<template>
    <div>
      <div v-show="modal" class="modal">
        <div class="divButton">
          <div class="flex justify-between w-full mb-2">
                <div></div>
                <button type="button" class="close-btn" @click="closeModal">
                <i class="far fa-times-circle mr-2 text-3xl text-gray-200"></i>
                </button>
          </div>
          <div class="container">
            <div class="mb-2">
                <h4 class="text-2xl font-medium leading-5 text-blue-900">
                    <i class="fas fa-redo"></i> Atualizar Assunto
                </h4>
                <div class="hidden sm:block" aria-hidden="true">
                    <div class="py-5">
                    <div class="border-t border-gray-300"></div>
                    </div>
                </div>
            </div>
            <form class="w-full shadow-sm mb-2 pb-4">
                
                <div class="w-full">
                    <label for="pontovlvalor" class="block text-sm font-medium mt-3 text-gray-700">
                        Descrição
                    </label>
                    <div class="flex">
                        <input
                            type="text"
                            required
                            v-model="descricao"
                            ref="valorInputRef"
                            class="px-3 py-2 mt-2 w-full focus:outline-none focus:ring-blue-500 focus:border-blue-500 border border-gray-300 rounded-md sm:text-lg"
                        />
                    </div>
                </div>
                <div class="w-full px-3 mb-6 md:mb-0 ">
                    <div class="flex space-x-2 mt-4 justify-end">
                        <div>
                            <button
                            @click="closeModal"
                            class="flex items-center py-2 px-6 shadow-sm text-sm font-medium rounded-md text-white bg-blue-500 hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                            style="background-color: red;"
                            >
                            <i class="fas fa-times mr-2"></i> Cancelar
                            </button>
                        </div>
                        <div>
                            <button
                                type="button"
                                @click="atualizar"
                                class="flex items-center py-2 px-6 shadow-sm text-sm font-medium rounded-md text-white bg-blue-500 hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                                style="background-color: #100f5c;"
                                >
                                <i class="fas fa-save text-1xl mr-2"></i> Salvar
                            </button>
                        </div>
                    </div>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </template>
  <script>
    import PreloaderComponente from "../../components/preloader/PreloaderComponent.vue";
    import ApiLivroService from "../../services/apiLivro.service";

  export default {
    name: "Modal",
    emits: ['closeModal'],
    props: {
        modal: true,
        idAssunto: {
        type: Number,
        required: true,
      },
    },

    components: {
    PreloaderComponente,
    },

    watch: {
        modal: 'modalChanged',
    },

    data() {
        return {
            isValid: true,
            modalOpen: false,
            loading: false,
            descricao: '',
        };
    },

    methods: {
        modalChanged(newValue) {
            if (newValue) {
                this.exibirAssuntoDescricao();
            }
        },

        async atualizar() {
            const requestData = {
                descricao: this.descricao,
            };

            const response = await ApiLivroService.atualizarAssunto(requestData, this.idAssunto);

            if (response === 'Error') {
                alert('Erro ao inserir o registro');
            } else {
                alert('Assunto atualizado com sucesso !');
                window.location.reload();
            }
        },

        async exibirAssuntoDescricao() {
            const response = await ApiLivroService.showAssunto(this.idAssunto);
            this.descricao = response.data[0].descricao;
        },

        closeModal() {
          this.$emit("close-modal");
          window.location.reload();
        },
    },
  };
  </script>
  <style scoped>
  .modal {
    position: fixed;
    top: -10px;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.7);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 99;
  }
  
  .divButton {
    width: 50%;
    height: 45%;
    margin-top: -10px;
  }
  
  .container {
    background-color: aliceblue;
    width: 100%;
    height: 100%;
    border-color: 4px solid black;
    border-radius: 13px;
    padding: 10px;
  }
  </style>
  