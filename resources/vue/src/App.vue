<template>
  <component :is="this.$route.meta.layout || 'div'">
    <router-view />
    <loading v-show="isLoading" />
  </component>
</template>

<script>
import Loading from '@/components/Loading'
import SweetAlert2  from '@/mixins/sweetalert2'
import { mapGetters } from 'vuex'

export default {
  components: { Loading },
  mixins: [ SweetAlert2 ],
  computed: {
    ...mapGetters(['isLoading'])
  },
}
</script>

<style lang="scss">
  @import '~bootstrap/scss/bootstrap.scss';
  @import '~bootstrap-vue/src/index.scss';
</style>
