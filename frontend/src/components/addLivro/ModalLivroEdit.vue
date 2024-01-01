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
                    <i class="fas fa-redo"></i> Atualizar Livro
                </h4>
                <div class="hidden sm:block" aria-hidden="true">
                    <div class="py-5">
                    <div class="border-t border-gray-300"></div>
                    </div>
                </div>
            </div>
            <form class="w-full shadow-sm mb-10 pb-4">
                <div class="w-full px-3 mb-6 md:mb-0 ">
                    <div class="flex space-x-3 ">
                    <div class="w-full">
                        <label for="pontovlvalor" class="block text-sm font-medium mt-3 text-gray-700">
                        Título
                        </label>
                        <input
                        type="text"
                        v-model="titulo"
                        ref="valorInputRef"
                        class="px-3 py-2 mt-2 w-full focus:outline-none focus:ring-blue-500 focus:border-blue-500 border border-gray-300 rounded-md sm:text-lg"
                        />               
                    </div>
                    <div>
                        <label for="valor" class="block text-sm font-medium mt-3 text-gray-700">
                        Editora
                        </label>
                        <input
                        type="text"
                        v-model="editora"
                        ref="dataInputRef"
                        class="px-3 py-2 mt-2 w-64 text-gray-500 focus:outline-none focus:ring-blue-500 focus:border-blue-500 border border-gray-300 rounded-md sm:text-lg"
                        >
                    </div>
                    <div class="w-64 ml-4">
                        <label for="decreto" class="block text-sm font-medium mt-3 text-gray-700">
                        Edição
                        </label>
                        <input
                        v-model="edicao"
                        @input="validarEdicao(edicao)"
                        ref="decretoInputRef"
                        class="px-3 py-2 mt-2 w-64 focus:outline-none focus:ring-blue-500 focus:border-blue-500 border border-gray-300 rounded-md sm:text-lg"
                        />
                    </div>
                    </div>
                </div>
                <div class="w-full px-3 mb-6 md:mb-0 ">
                    <div class="flex space-x-4">
                    <div class="w-1/2">
                        <label for="decreto" class="block text-sm font-medium mt-3 text-gray-700">
                        Ano de publicação
                        </label>
                        <input
                        @input="validarAnoPublicacao()"
                        v-model="anoPublicacao"
                        maxlength="4"
                        ref="decretoInputRef"
                        class="px-3 py-2 mt-2 w-full focus:outline-none focus:ring-blue-500 focus:border-blue-500 border border-gray-300 rounded-md sm:text-lg"
                        />
                    </div>
                    <div class="w-full ml-4">
                        <label for="decreto" class="block text-sm font-medium mt-3 text-gray-700">
                        Assunto
                        </label>
                        <select name="select"
                            v-model="assunto"
                            class="px-3 py-2 mt-2 w-full focus:outline-none focus:ring-blue-500 focus:border-blue-500 border border-gray-300 rounded-md sm:text-lg"
                        >
                            <option v-for="item in getAssuntos" :value="item.codAs">{{ item.descricao }}</option>
                        </select>
                    </div>
                    <div class="w-full ml-4">
                        <label for="decreto" class="block text-sm font-medium mt-3 text-gray-700">
                        Autor
                        </label>
                        <select name="select"
                            v-model="autor"
                            class="px-3 py-2 mt-2 w-full focus:outline-none focus:ring-blue-500 focus:border-blue-500 border border-gray-300 rounded-md sm:text-lg"
                        >
                            <option v-for="item in getAutores" :value="item.codAu">{{ item.nome }}</option>
                        </select>
                    </div>
                    </div>
                    <div class="flex space-x-2 mt-4 justify-end">
                    <div>
                        <button
                        type="button"
                        @click="atualizar()"
                        class="flex items-center py-2 px-6 shadow-sm text-sm font-medium rounded-md text-white hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                        style="background-color: #100f5c;"
                        >
                        <i class="fas fa-save text-1xl mr-2"></i> Atualizar
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
        idLivro: {
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
            nome: '',
            getAutores: [],
            getAssuntos: [],
            titulo: '',
            editora: '',
            edicao: '',
            anoPublicacao: '',
            assunto: '',
            autor: '',
        };
    },

    methods: {
        modalChanged(newValue) {
            if (newValue) {
                this.exibirLivro();
                this.getAutor();
                this.getAssunto();
            }
        },

        async atualizar() {
            const requestData = {
                titulo: this.titulo,
                anoPublicacao: this.anoPublicacao,
                edicao: parseInt(this.edicao, 10),
                editora: this.editora,
                autor: parseInt(this.autor, 10),
                assunto: parseInt(this.assunto, 10),
            };

            const response = await ApiLivroService.atualizarLivro(requestData, this.idLivro);

            if (response === 'Error') {
                alert('Erro ao inserir o registro');
            } else {
                alert('Livro atualizado com sucesso !');
                window.location.reload();
            }
        },

        async exibirLivro() {
            const response = await ApiLivroService.showLivro(this.idLivro);
            this.anoPublicacao = response.data[0].anoPublicacao;
            this.edicao = response.data[0].edicao;
            this.editora = response.data[0].editora;
            this.titulo = response.data[0].titulo;
        },

        async getAutor() {
            const response = await ApiLivroService.listAutor();
            this.getAutores = response.data;
        },

        async getAssunto() {
            const response = await ApiLivroService.listAssunto();
            this.getAssuntos = response.data;
        },

        validarEdicao() {
            this.edicao = this.edicao.replace(/[^0-9,]/g, '');
        },

        validarAnoPublicacao() {
            this.anoPublicacao = this.anoPublicacao.replace(/[^0-9,]/g, '');
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
    width: 70%;
    height: 45%;
    margin-top: -130px;
  }
  
  .container {
    background-color: aliceblue;
    width: 950px;
    height: 350px;
    margin: auto;
    border-radius: 13px;
    padding: 10px;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}
  </style>
  