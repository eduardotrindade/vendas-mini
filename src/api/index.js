import axios from 'axios';
import { cacheAdapterEnhancer } from 'axios-extensions';
import store from '@/store';

const ApiInstance = axios.create({
  baseURL: process.env.VUE_APP_API_BASE_URL,
  headers: {
    'Content-Type': 'application/json',
    'Accept': 'application/json'
  },
  adapter: cacheAdapterEnhancer(axios.defaults.adapter, { enabledByDefault: false }),
});

ApiInstance.interceptors.request.use(requestInterceptor, errorHandler);
ApiInstance.interceptors.response.use(responseInterceptor, errorHandler);

function requestInterceptor(config) {
  startLoading();
  return config;
}

function responseInterceptor(response) {
  stopLoading();
  return response;
}

function startLoading() {
  store.dispatch('startLoading');
}

function stopLoading() {
  store.dispatch('stopLoading');
}

function errorHandler(error) {
  let rejectObject = null, errorMessage = '', extraErrors = [];
  if (error.response) {
    if (error.response.status === 401) {
      window.location = process.env.BASE_URL;
      return;
    }

    rejectObject = error.response;
    errorMessage = error.response.data.message;

    if (error.response.status === 409) {
      if (error.response.data.errors) {
        extraErrors = error.response.data.errors;
      }
    }

  } else if (error.request) {
    rejectObject = error;
    errorMessage = 'Não foi possível completar a requisição. Por favor, verifique se a sua conexão está estável ou entre em contato com suporte de TI da sua instituição.';
  }

  stopLoading();
  this.$root.$emit('alert-error', errorMessage, extraErrors);

  return Promise.reject(rejectObject);
}

export default ApiInstance;
