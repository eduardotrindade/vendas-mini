<template>
  <div class="header-wrapper">
    <!-- Ticker -->
    <div class="ticker">
      <div class="ticker-content">
        🎉 R$237.450 já pagos aos vendedores! • João Santos (SP) ganhou R$8.400 em janeiro! • Maria Oliveira (RJ) chegou ao nível DIAMANTE! • Restam apenas 12 vagas para este mês!
      </div>
    </div>
    <header class="main-header">
    <div class="container d-flex justify-content-between align-items-center">
      <router-link :to="{ name: 'landing-page' }" class="logo">
        <img src="../../assets/logo.png" alt="MINISITIO" height="40">
      </router-link>
      
      <div class="header-right d-flex align-items-center">
        <nav class="d-none d-md-block mr-4">
          <ul class="nav">
            <li class="nav-item">
              <router-link class="nav-link" :to="{ name: 'registration-people' }">Seja nosso representante</router-link>
            </li>
            <li class="nav-item">
              <router-link class="nav-link" :to="{ name: 'buy-space' }">Compra de espaços</router-link>
            </li>
          </ul>
        </nav>
        
        <a href="https://play.google.com/store/apps/details?id=net.mycardcity" target="_blank" class="btn-app d-none d-sm-block mr-3">
          BAIXE O APP
        </a>
        <router-link :to="{ name: 'buy-space' }" class="btn-participar">QUERO PARTICIPAR</router-link>
      </div>
    </div>
    </header>
  </div>
</template>

<script>
export default {
  name: 'HeaderSite'
}
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap');

.main-header {
  background: rgba(10, 10, 10, 0.95);
  padding: 15px 0;
  position: sticky;
  top: 0;
  width: 100%;
  z-index: 1000;
  backdrop-filter: blur(10px);
  border-bottom: 1px solid rgba(255, 215, 0, 0.1);
  font-family: 'Poppins', sans-serif;
}

/* Ticker */
.ticker {
  background: #ffd700;
  color: #000;
  padding: 6px 0;
  text-align: center;
  font-weight: 700;
  overflow: hidden;
  font-size: 12px;
  text-transform: uppercase;
}
.ticker-content {
  display: inline-block;
  animation: ticker 30s linear infinite;
  white-space: nowrap;
  padding-left: 100%;
}
@keyframes ticker {
  0% { transform: translateX(0); }
  100% { transform: translateX(-100%); }
}

.logo {
  font-size: 24px;
  font-weight: 800;
  background: linear-gradient(135deg, #ffd700, #ffaa00);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  text-decoration: none;
}

.logo span {
  color: #ffd700;
}

.nav-link {
  color: #aaa;
  font-weight: 600;
  font-size: 14px;
  transition: color 0.3s;
  text-transform: uppercase;
}

.nav-link:hover, .router-link-active {
  color: #ffd700;
}

.btn-app {
  color: #ffd700;
  font-weight: 600;
  text-decoration: none;
  font-size: 13px;
  border: 1px solid rgba(255, 215, 0, 0.3);
  padding: 5px 15px;
  border-radius: 5px;
  transition: all 0.3s;
}

.btn-app:hover {
  background: rgba(255, 215, 0, 0.1);
}

.btn-participar {
  background: linear-gradient(135deg, #ffd700, #ff8c00);
  padding: 8px 20px;
  border-radius: 50px;
  font-size: 13px;
  font-weight: 700;
  color: #000;
  text-decoration: none;
  transition: transform 0.3s;
}

.btn-participar:hover {
  transform: scale(1.05);
  box-shadow: 0 5px 15px rgba(255, 215, 0, 0.3);
}

/* Botão piscando */
.btn-participar {
  animation: pulse-orange 2s infinite;
}
@keyframes pulse-orange {
  0%, 100% { box-shadow: 0 0 0 0 rgba(255, 140, 0, 0.7); }
  50% { box-shadow: 0 0 0 10px rgba(255, 140, 0, 0); }
}

@media (max-width: 768px) {
  .logo { font-size: 20px; }
  .btn-participar { padding: 6px 15px; font-size: 12px; }
}
</style>
