import { createApp } from "vue";
import App from "./App.vue";
import router from "./router";
import store from "./store";
import SimpleTypeahead from "vue3-simple-typeahead";
import "vue3-simple-typeahead/dist/vue3-simple-typeahead.css"; //Optional default CSS
import '@fortawesome/fontawesome-free/css/all.css';
import "./index.css";
import "flowbite";
import axios from "axios";
import { URL_API } from "./configs/api";
import Notifications from "@kyvg/vue3-notification";
import money from 'v-money';

axios.defaults.baseURL = URL_API;
axios.defaults.headers = {
  "Content-type": "application/json",
  "Access-Control-Allow-Origin": "*",
};

createApp(App)
  .use(store)
  .use(router)
  .use(SimpleTypeahead)
  .use(Notifications)
  .use(money)
  .mount("#app");
