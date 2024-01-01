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
                    <i class="fas fa-trash"></i> Deletar Livro
                </h4>
                <div class="hidden sm:block" aria-hidden="true">
                    <div class="py-5">
                    <div class="border-t border-gray-300"></div>
                    </div>
                </div>
            </div>
            
            <div class="w-full px-3 mb-6 md:mb-0 text-center">
                <p class="my-auto">Deseja excluir o registro?</p>
                <div class="flex space-x-2 mt-4 justify-center">
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
                            @click="excluir"
                            class="flex items-center py-2 px-6 shadow-sm text-sm font-medium rounded-md text-white bg-blue-500 hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                            style="background-color: #100f5c;"
                        >
                            <i class="fas fa-trash text-1xl mr-2"></i> Excluir
                        </button>
                    </div>
                </div>
            </div>
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
        idLivro: {
        type: Number,
        required: true,
      },
    },

    components: {
    PreloaderComponente,
    },

    data() {
        return {
            isValid: true,
            modalOpen: false,
            loading: false,
        };
    },

    methods: {
        async excluir() {
            const response = await ApiLivroService.deleteLivro(this.idLivro);

            if (response === 'Error') {
                alert('Erro ao inserir o registro');
            } else {
                alert('Livro excluido com sucesso !');
                window.location.reload();
            }
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
  