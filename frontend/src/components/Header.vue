<template>
  <div id="nav">
    <a href="#">
      <img src="https://portaltj.tjrj.jus.br/o/theme-infanciaejuventude/images/logo.png" alt="Logo TJRJ" />
    </a>
  </div>
  <div class="mx-auto" style="width: 92%;">
    <nav class="flex items-center justify-between bg-blue-500 p-4 rounded-md" 
        style="background-color: #100f5c;"
    >
      <div class="flex-shrink-0 text-white mr-6">
        <h3 class="text-xl font-medium leading-5">API LIVROS</h3>
      </div>
      <div class="hidden sm:block">
        <div class="flex items-center space-x-4">
          <router-link to="/" class="text-white flex items-center">
            <div class="text-white p-2 rounded-full">
              <i class="fas fa-book"></i>
            </div>
            Adicionar Livro
          </router-link>
          <router-link to="/adicionarAutor" class="text-white flex items-center">
            <div class="text-white p-2 rounded-full">
              <i class="fas fa-user"></i>
            </div>
            Adicionar Autor
          </router-link>
          <router-link to="/adicionarAssunto" class="text-white flex items-center">
            <div class="text-white p-2 rounded-full">
              <i class="fas fa-tag"></i>
            </div>
            Adicionar Assunto
          </router-link>
        </div>
      </div>
    </nav>
  </div>
</template>

<script>
export default {
  methods: {
    emitirEvento() {
      this.$emit('abrirModalRelatorio');
    }
  }
}
</script>

<style scoped>
#nav {
  background-image: linear-gradient(to right, #100f5c, #ffffff, rgb(20, 5, 61));
  border-bottom: 4px solid #f0f9ff;
  padding: 5px 20px; /* Ajuste o padding conforme necessário */
  display: flex;
  justify-content: space-between;
  align-items: center;
  height: 80px;
}
#nav a {
  color: #fcba03;
  text-decoration: none;
  margin: 12px;
  transition: 0.5s;
}
#nav a:hover {
  color: #fff;
}
#nav img {
  width: 220px;
  height: auto;
}
</style>