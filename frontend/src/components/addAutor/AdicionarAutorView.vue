<template>
    <PreloaderComponente :preloader="loading"/>
    <ModalUpdate 
      :modal="modalOpen"
      :idAutor="idAutor"
      @close-modal="modalOpen = false"
    />

    <ModalExcluir 
      :modal="modalOpenDelete"
      :idAutor="idAutor"
      @close-modal="modalOpenDelete = false"
    />
    <main>
        <h3 class="text-2xl font-medium leading-5 text-blue-900 mt-4 p-4 border-b border-gray-300">Adicionar Autor</h3>
      <div>
        <form class="w-full shadow-sm mb-10 pb-4">
          <div class="w-full px-3 mb-6 md:mb-0 flex space-x-3">
            <div class="w-1/2">
              <label for="pontovlvalor" class="block text-sm font-medium mt-3 text-gray-700">
                Nome do Autor
              </label>
              <div class="flex">
                <input
                  type="text"
                  required
                  v-model="nome"
                  class="px-3 py-2 mt-2 w-full focus:outline-none focus:ring-blue-500 focus:border-blue-500 border border-gray-300 rounded-md sm:text-lg"
                />
                <button
                  type="button"
                  @click="adicionarAutor"
                  class="flex items-center px-6 shadow-sm text-sm font-medium rounded-md text-white hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 ml-4"
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
                    <span class="mr-2">Nome do Autor</span>
                </div>
                </th>
                <th scope="col" class="border-r px-2 py-4 dark:border-neutral-500 w-40">Ações</th>
            </tr>
          </thead>
          <tbody class="align-middle">
              <tr v-for="item in this.getAutor" :key="item.cod" class="border dark:border-neutral-500">
                <td class="p-4">{{ item.nome }}</td>
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
                          <button @click="edit(item.codAu)">
                              <i class="fas fa-edit"></i> Editar
                          </button>
                          </li>
                          <li class="px-4 py-2 hover:bg-gray-100">
                          <button @click="trash(item.codAu)">
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
  import ModalUpdate from "../addAutor/ModalAutorEdit.vue";
  import ModalExcluir from "../addAutor/ModalAutorExcluir.vue";
  import "jquery/dist/jquery.min.js";
  import "datatables.net-dt/js/dataTables.dataTables";
  import "datatables.net-dt/css/jquery.dataTables.min.css";
  import $ from "jquery";
  
  export default {
    components: {
      PreloaderComponente,
      ModalUpdate,
      ModalExcluir
    },
  
    data() {
      return {
        userSearch: "",
        getAutor: null,
        items: [], 
        nome: "",
        idAutor: 0,
        loading: false,
        showContent: {
                'dropdown-1': false
        },
        modalOpen: false,
        modalOpenDelete: false,
        getUserModal: false,
        additionalData: false,
      };
    },
  
    async created() {
      this.getAutorMetodo();
    },
  
    methods: {
      async getAutorMetodo() {
        const response = await ApiLivroService.listAutor();
        this.getAutor = response.data;
  
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

      toggleMenu(item) {
        if (item) {
          item.menuOpen = !item.menuOpen;
        }
      },

      async adicionarAutor() {
        try {
            const requestData = {
                nome: this.nome
            };

        const response = await ApiLivroService.addAutor(requestData);

        if (response === 'Error') {
            alert('Erro ao inserir o registro');
        } else {
            alert('Autor salvo com sucesso !');
            window.location.reload();
        }

        } catch (error) {
              console.error('Erro ao adicionar livro:', error);
              alert('Ocorreu um erro ao adicionar o livro. Por favor, tente novamente.');
        }
      },

      edit(codAu) {
        this.idAutor = codAu;
        this.mostrarModal();
      },

      trash(codAu) {
        this.idAutor = codAu;
        this.modalOpenDelete = true;
      },

      mostrarModal() {
        this.modalOpen = true;
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
  