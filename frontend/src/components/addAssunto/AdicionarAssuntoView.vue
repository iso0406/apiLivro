<template>
    <PreloaderComponente :preloader="loading"/>
    <ModalUpdate 
      :modal="modalOpen"
      :idAssunto="idAssunto"
      @close-modal="modalOpen = false"
    />

    <ModalExcluir 
      :modal="modalOpenDelete"
      :idAssunto="idAssunto"
      @close-modal="modalOpenDelete = false"
    />
    <main>
        <h3 class="text-2xl font-medium leading-5 text-blue-900 mt-4 p-4 border-b border-gray-300">Adicionar Assunto</h3>
      <div>
        <form class="w-full shadow-sm mb-10 pb-4">
          <div class="w-full px-3 mb-6 md:mb-0 flex space-x-3">
            <div class="w-1/2">
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
                <button
                  type="button"
                  @click="adicionarAssunto"
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
                    <span class="mr-2">Assunto</span>
                </div>
                </th>
                <th scope="col" class="border-r px-2 py-4 dark:border-neutral-500 w-40">Ações</th>
            </tr>
          </thead>
          <tbody class="align-middle">
              <tr v-for="item in this.getAssunto" :key="item.codAs" class="border dark:border-neutral-500">
                <td class="p-4">{{ item.descricao}}</td>
                <td class="p-2 items-center justify-center">
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
                          <button @click="edit(item.codAs)">
                              <i class="fas fa-edit"></i> Editar
                          </button>
                          </li>
                          <li class="px-4 py-2 hover:bg-gray-100">
                          <button @click="trash(item.codAs)">
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
  import ModalUpdate from "../addAssunto/ModalAssuntoEdit.vue";
  import ModalExcluir from "../addAssunto/ModalAssuntoExcluir.vue";
  import "jquery/dist/jquery.min.js";
  import "datatables.net-dt/js/dataTables.dataTables";
  import "datatables.net-dt/css/jquery.dataTables.min.css";
  import $ from "jquery";
  
  export default {
    components: {
      PreloaderComponente,
      ModalUpdate,
      ModalExcluir,
    },
  
    data() {
      return {
        userSearch: "",
        getAssunto: null,
        getFollowers: [],
        descricao: "",
        items: [], 
        loading: false,
        idAssunto: 0,
        idAssuntoUpdate: "",
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
      this.getAssuntoMetodo();
    },
  
    methods: {
      async getAssuntoMetodo() {
        const response = await ApiLivroService.listAssunto();
        this.getAssunto = response.data;
  
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
      },

      toggleMenu(item) {
        if (item) {
          item.menuOpen = !item.menuOpen;
        }
      },

      async adicionarAssunto() {
        try {
            const requestData = {
              descricao: this.descricao
            };

        const response = await ApiLivroService.addAssunto(requestData);

        if (response === 'Error') {
            alert('Erro ao inserir o registro');
        } else {
            alert('Assunto salvo com sucesso !');
            window.location.reload();
        }

        } catch (error) {
              console.error('Erro ao adicionar livro:', error);
              alert('Ocorreu um erro ao adicionar o livro. Por favor, tente novamente.');
        }
      },

      edit(cod) {
        this.idAssunto = cod;
        this.mostrarModal();
      },

      trash(cod) {
        this.idAssunto = cod;
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
  