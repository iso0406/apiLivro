<template>
  <PreloaderComponente :preloader="loading"/>
  <main>
    <div class="hidden sm:block" aria-hidden="true">
      <div class="py-5">
        <div class="border-t border-gray-300"></div>
      </div>
    </div>
    <div>
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
                  <span class="mr-2">Autor</span>
              </div>
              </th>
              <th scope="col" class="border-r px-2 py-4 dark-border-neutral-500 w-1/4">
              <div class="flex items-center">
                  <span class="mr-2">Data Publicação</span>
              </div>
              </th>
          </tr>
        </thead>
        <tbody class="align-middle">
            <tr v-for="item in this.getBooks" :key="item.cod" class="border dark:border-neutral-500">
            <td class="p-4">{{ item.livro.titulo }}</td>
            <td class="p-4">{{ item.autor.nome }}</td>
            <td class="p-4">{{ item.livro.anoPublicacao }}</td>
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
import "jquery/dist/jquery.min.js";
import "datatables.net-dt/js/dataTables.dataTables";
import "datatables.net-dt/css/jquery.dataTables.min.css";
import $ from "jquery";

export default {
  components: {
    PreloaderComponente,
  },

  data() {
    return {
      userSearch: "",
      getBooks: null,
      getFollowers: [],
      items: [], 
      loading: false,
      showContent: {
              'dropdown-1': false
      },
      modalOpen: false,
      getUserModal: false,
      additionalData: false,
    };
  },

  async created() {
    this.getBooksMetodo();
  },

  methods: {
    async getBooksMetodo() {
      const response = await ApiLivroService.listBook();
      this.getBooks = response.data;

      console.log('Aqui os livros');
      console.log(this.getBooks);

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
