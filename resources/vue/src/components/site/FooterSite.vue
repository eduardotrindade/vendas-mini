<template>
  <footer class="py-3 mt-auto">
    <div class="container">
      <div class="row">
        <div class="col-md-6 col-sm-12">
          <ul class="social-icons list-inline mb-auto">
            <li class="list-inline-item">
              <a href="https://www.facebook.com/Meucartaoweb-296426777221791/" title="Facebook" target="_blank">
                <i class="icon icon-facebook"></i>
              </a>
            </li>
            <li class="list-inline-item">
              <a href="https://twitter.com/meucartaoweb" title="Twitter" target="_blank">
                <i class="icon icon-twitter"></i>
              </a>
            </li>
            <li class="list-inline-item">
              <a href="https://youtu.be/TPlPukQTUS4" title="YouTube" target="_blank">
                <i class="icon icon-youtube"></i>
              </a>
            </li>
            <li class="list-inline-item">
              <a href="https://br.minisitio.net/resources/files/ebook.pdf" title="E-book" target="_blank">
                <i class="icon icon-ebook"></i>
              </a>
            </li>
            <li class="list-inline-item">
              <a href="https://br.minisitio.net/resources/files/formulario.pdf" title="Formulário" target="_blank">
                <i class="icon icon-form"></i>
              </a>
            </li>
          </ul>
        </div>
        <div class="col-md-6 col-sm-12 py-2 text-md-right">
          © Copyright - My Card City - 2001-{{ (new Date()).getFullYear() }}
        </div>
      </div>
    </div>
  </footer>
</template>

<script>
export default {
  name: 'FooterSite'
}
</script>

<style scoped>
  footer {
    background-color: #edecec;
  }
  .social-icons {
    margin-top: 8px;
  }
</style>
