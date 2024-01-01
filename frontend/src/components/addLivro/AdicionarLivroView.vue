<template>
    <PreloaderComponente :preloader="loading"/>
    <ModalUpdate 
      :modal="modalOpen"
      :idLivro="idLivro"
      @close-modal="modalOpen = false"
    />

    <ModalExcluir 
      :modal="modalOpenDelete"
      :idLivro="idLivro"
      @close-modal="modalOpenDelete = false"
    />

    <ModalRelatorio
      :modalRelatorio="modalRelatorio"
      @close-modal="modalRelatorio = false"
    />
    <main>
        <h3 class="text-2xl font-medium leading-5 text-blue-900 mt-4 p-4 border-b border-gray-300">Adicionar Livro</h3>
        <button
          type="button"
          @click="mostrarModalRelatorio()"
          class="flex items-center py-2 px-6 shadow-sm text-sm font-medium rounded-md text-white bg-green-500 hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 mt-4"
          >
          <i class="fas fa-save text-1xl mr-2"></i> Gerar Relatório
        </button>
      <div>
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
                    @click="addLivro()"
                    class="flex items-center py-2 px-6 shadow-sm text-sm font-medium rounded-md text-white hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                    style="background-color: #100f5c;"
                    >
                    <i class="fas fa-save text-1xl mr-2"></i> Salvar
                    </button>
                </div>
                </div>
            </div>
        </form>
        <table class="min-w-full border text-center text-sm font-light dark:border-neutral-500 shadow-md display hover mt-4" 
            id="datatable" 
            style="width: 100%"
        >
          <thead class="border-b font-medium dark:border-neutral-500">
            <tr>
                <th scope="col" class="border-r px-2 py-4 dark:border-neutral-500 w-1/2">
                <div class="flex items-center">
                    <span class="mr-2">Nome do Livro</span>
                </div>
                </th>
                <th scope="col" class="border-r px-2 py-4 dark:border-neutral-500 w-1/4">
                  <div class="flex items-center">
                      <span class="mr-2">Assunto</span>
                  </div>
                </th>
                <th scope="col" class="border-r px-2 py-4 dark-border-neutral-500 w-1/4">
                  <div class="flex items-center">
                      <span class="mr-2">Autor</span>
                  </div>
                </th>
                <th scope="col" class="border-r px-2 py-4 dark:border-neutral-500 w-1/4">
                  <div class="flex items-center">
                      <span class="mr-2">Data Publicação</span>
                  </div>
                </th>
                <th scope="col" class="border-r px-2 py-4 dark:border-neutral-500 w-40">Ações</th>
            </tr>
          </thead>
          <tbody class="align-middle">
              <tr v-for="item in this.getBooks" :key="item.cod" class="border dark:border-neutral-500">
                <td class="p-4">{{ item && item.titulo !== null ? item.titulo : '----' }}</td>
                <td class="p-4">
                  {{ item.livro_assunto && item.livro_assunto.length > 0 && item.livro_assunto[0].assunto && item.livro_assunto[0].assunto.descricao !== null ? item.livro_assunto[0].assunto.descricao : '----' }}
                </td>
                <td class="p-4">{{ item.autor && item.autor.autor.nome !== null ? item.autor.autor.nome : '----' }}</td>   
                <td class="p-4">{{ item && item.anoPublicacao !== null ? item.anoPublicacao : '----' }}</td> 
                <td class="p-2 w-1/7 items-center justify-center">
                    <button
                    type="button"
                    class="flex w-8 h-8 items-center justify-center ml-2 shadow-sm text-sm font-medium rounded-full text-white bg-blue-500 hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                    @click="toggleMenu(item)"
                    >
                    <i class="fa-solid fa-ellipsis-vertical"></i>
                    </button>
                    <div v-show="item.menuOpen" class="absolute z-10 mt-2 bg-white border border-gray-300 rounded-md shadow-lg w-220px toggleMenu">
                    <ul class="py-2">
                        <li class="px-4 py-2 hover:bg-gray-100">
                        <button @click="edit(item.livro.cod)">
                            <i class="fas fa-edit"></i> Editar
                        </button>
                        </li>
                        <li class="px-4 py-2 hover:bg-gray-100">
                        <button @click="trash(item.livro.cod)">
                            <i class="fas fa-trash"></i> Excluir
                        </button>
                        </li>
                    </ul>
                    </div> 
                </td>
              </tr>
          </tbody>
        </table>
      </div>
      <div class="hidden sm:block" aria-hidden="true">
        <div class="py-5">
          <div class="border-t border-gray-300"></div>
        </div>
      </div>
    </main>
  </template>
  
  <script>
  import ApiLivroService from "../../services/apiLivro.service";
  import PreloaderComponente from "../../components/preloader/PreloaderComponent.vue";
  import ModalUpdate from "../addLivro/ModalLivroEdit.vue";
  import ModalExcluir from "../addLivro/ModalLivroExcluir.vue";
  import ModalRelatorio from "../modalRelatorio/Modal.vue";
  import "jquery/dist/jquery.min.js";
  import "datatables.net-dt/js/dataTables.dataTables";
  import "datatables.net-dt/css/jquery.dataTables.min.css";
  import $ from "jquery";
  
  export default {
    components: {
      PreloaderComponente,
      ModalUpdate,
      ModalExcluir,
      ModalRelatorio,
    },
  
    data() {
      return {
        userSearch: "",
        getBooks: [],
        getAutores: [],
        getAssuntos: [],
        getFollowers: [],
        items: [], 
        titulo: '',
        editora: '',
        edicao: '',
        anoPublicacao: '',
        assunto: '',
        autor: '',
        idLivro: 0,
        loading: false,
        modalOpen: false,
        modalOpenDelete: false,
        modalRelatorio: false,
        getUserModal: false,
        additionalData: false,
      };
    },
  
    async created() {
      this.getBooksMetodo();
      this.getAutor();
      this.getAssunto();
    },
  
    methods: {
      async getBooksMetodo() {
        const response = await ApiLivroService.listBook();
        this.getBooks = response.data;
  
        setTimeout(() => {
              $("#datatable").DataTable({
                language: {
                  url: "https://cdn.datatables.net/plug-ins/1.11.4/i18n/pt_br.json",
                },
                lengthMenu: [
                  [5, 10, 25, 50, -1],
                  [5, 10, 25, 50, "Todos"],
                ],
                pageLength: 5,
                responsive: true,
              });
        });

        //Esconder toggleMenu
        $(document).mouseup(function(){
            $('.toggleMenu').hide();
        });

      },

      async getAutor() {
        const response = await ApiLivroService.listAutor();
        this.getAutores = response.data;
      },

      async getAssunto() {
        const response = await ApiLivroService.listAssunto();
        this.getAssuntos = response.data;
      },

    toggleMenu(item) {
      if (item) {
        item.menuOpen = !item.menuOpen;
      }
    },

    async addLivro() {
        try {
            const requestData = {
                titulo: this.titulo,
                editora: this.editora,
                edicao: parseInt(this.edicao, 10),
                anoPublicacao: this.anoPublicacao,
                autor: this.autor,
                assunto: this.assunto,
            };

        const response = await ApiLivroService.addLivro(requestData);

        if (response === 'Error') {
            alert('Erro ao inserir o registro');
        } else {
            alert('Livro salvo com sucesso !');
            window.location.reload();
        }
     
        } catch (error) {
            console.error('Erro ao adicionar livro:', error);
            alert('Ocorreu um erro ao adicionar o livro. Por favor, tente novamente.');
        }
    },

    validarEdicao() {
      this.edicao = this.edicao.replace(/[^0-9,]/g, '');
    },

    validarAnoPublicacao() {
      this.anoPublicacao = this.anoPublicacao.replace(/[^0-9,]/g, '');
    },

    edit(cod) {
        this.idLivro = cod;
        this.mostrarModal();
      },

      trash(cod) {
        this.idLivro = cod;
        this.modalOpenDelete = true;
      },

      mostrarModal() {
        this.modalOpen = true;
      },

      mostrarModalRelatorio() {
        this.modalRelatorio = true;
      },

      fecharModal() {
        this.modalOpen = false;
      },

      reloadPage() {
        window.location.reload();
      },
    },
  };
  
  </script>
  
  <style scoped>
  
  </style>
  