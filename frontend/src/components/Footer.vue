
<template>
  <footer id="footer">
    <a href="https://www.unisuam.edu.br/">
      <img src="..\assets\logofaixa_unisuam.png" alt="Logo Unisuam" />
    </a>
    <p>&copy; 2023</p>
  </footer>
</template>
<style scoped>
#footer {
  background-image: linear-gradient(to right, #100f5c, #ffffff, rgb(20, 5, 61));
  padding: 5px 30px;
  display: table;
  align-items: center;
  bottom: 0;
  text-align: center;
  width: 100%;
}
#footer a {
  color: #fcba03;
  text-decoration: none;
  margin: 12px;
  transition: 0.5s;
}
#footer a:hover {
  color: #fff;
}
#footer p {
  color: rgb(12, 12, 12);
  justify-content: center;
}
#footer img {
  justify-content: center;
  width: 220px;
  height: auto;
}
</style>