<template>
  <div id="overlay">
    <div id="spinner">
      <div></div>
      <div></div>
      <div></div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Loading',
}
</script>

<style scoped>
  #spinner > div {
    width: 40px;
    height: 40px;
    background-color: #ffcc29;
    border-radius: 100%;
    display: inline-block;
    animation: loading-wrapper 1.2s ease-in-out 0s infinite both;
  }

  #spinner > div:first-child  { animation-delay: -0.32s; }
  #spinner > div:nth-child(2) { animation-delay: -0.16s; }

  @keyframes loading-wrapper {
    0%, 80%, 100% { transform: scale(0); }
    40% { transform: scale(1); }
  }

  #overlay {
    position: fixed; /* Sit on top of the page content */
    top: 0;
    left: 0;
    width: 100%; /* Full width (cover the whole page) */
    height: 100%; /* Full height (cover the whole page) */
    background-color: rgba(0,0,0,0.5); /* Black background with opacity */
    z-index: 9999; /* Specify a stack order in case you're using a different order for other elements */
    display: flex;
    align-items: center;
    justify-content: center;
  }
</style>
