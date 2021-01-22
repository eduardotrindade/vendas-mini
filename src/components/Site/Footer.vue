<template>
  <footer class="py-3 mt-auto">
    <div class="container">
      <div class="row">
        <div class="col">
          <ul class="social-icons list-inline mb-auto">
            <li class="list-inline-item">
              <a href="https://www.facebook.com/Meucartaoweb-296426777221791/" target="_blank">
                <i class="icon icon-facebook"></i>
              </a>
            </li>
            <li class="list-inline-item">
              <a href="https://twitter.com/meucartaoweb" target="_blank">
                <i class="icon icon-twitter"></i>
              </a>
            </li>
            <li class="list-inline-item">
              <a href="https://www.youtube.com/channel/UCSd23dekVLXs8gNcgE9wvPA" target="_blank">
                <i class="icon icon-youtube"></i>
              </a>
            </li>
          </ul>
        </div>
        <div class="col py-2 text-right">
          © Copyright - My Card City - 2001-{{ (new Date()).getFullYear() }}
        </div>
      </div>
    </div>
  </footer>
</template>

<script>
export default {
  name: "Footer"
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
