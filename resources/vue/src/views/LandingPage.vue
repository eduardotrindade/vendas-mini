<template>
  <div class="landing-page-premium">

    <!-- Hero Section -->
    <section class="hero">
      <div class="hero-content container">
        <div class="highlight">💰 Portal do Vendedor</div>
        <h1>Transforme Seu Celular em Uma <br><span>Máquina de Dinheiro</span></h1>
        <p class="subtitle">Você já tem tudo o que precisa na mão. Mostramos o potencial.</p>

        <!-- Calculator -->
        <div class="calculator mx-auto">
          <h3>💵 Calcule Seu Potencial de Ganho</h3>
          <div class="calc-row">
            <label>Minisites vender/mês:</label>
            <input type="number" v-model.number="calcVendas" min="1" max="100">
          </div>
          <div class="calc-row">
            <label>Valor por venda (R$):</label>
            <input type="number" v-model.number="calcValor" min="30" max="200">
          </div>
          <div class="calc-result">
            <div class="label">Seu ganho mensal:</div>
            <div class="value">R$ {{ totalGanho.toLocaleString('pt-BR') }}</div>
          </div>
        </div>

        <a href="#register" class="btn btn-lg-premium">QUERO COMEÇAR AGORA</a>
      </div>
    </section>

    <!-- Stats Bar -->
    <section class="stats-bar">
      <div class="container d-flex justify-content-center gap-40 flex-wrap">
        <div class="stat">
          <div class="number">R$237.450</div>
          <div class="label">Já pagos aos vendedores</div>
        </div>
        <div class="stat">
          <div class="number">1.847</div>
          <div class="label">Vendedores ativos</div>
        </div>
        <div class="stat">
          <div class="number">12.450</div>
          <div class="label">Minisites vendidos</div>
        </div>
      </div>
    </section>

    <!-- Proof Section -->
    <section class="proof py-5">
      <div class="container">
        <h2 class="section-title">🔥 Quem Já Está Ganhando</h2>
        <p class="section-subtitle">Veja histórias reais de vendedores que transformaram a oportunidade em dinheiro</p>

        <div class="cards d-flex flex-wrap justify-content-center gap-30">
          <div class="card-premium">
            <div class="avatar">👨‍💼</div>
            <div class="name">João Santos</div>
            <div class="location">São Paulo, SP</div>
            <div class="earning">R$8.400 em janeiro</div>
            <div class="comment">"Comecei há 3 meses. Hoje tenho uma carteira de 45 clientes fixos. O Minisitio mudou minha vida!"</div>
          </div>
          <div class="card-premium">
            <div class="avatar">👩‍💼</div>
            <div class="name">Maria Oliveira</div>
            <div class="location">Rio de Janeiro, RJ</div>
            <div class="earning">R$5.760 em janeiro</div>
            <div class="comment">"Trabalho só 2 horas por dia. Pago minhas contas e ainda sobra. Mejor impossível!"</div>
          </div>
          <div class="card-premium">
            <div class="avatar">👨‍💻</div>
            <div class="name">Carlos Lima</div>
            <div class="location">Belo Horizonte, MG</div>
            <div class="earning">R$4.200 em janeiro</div>
            <div class="comment">"A ferramenta é muito fácil. Em 5 minutos eu crio o site do cliente. Ele fica amazed!"</div>
          </div>
        </div>
      </div>
    </section>

    <!-- Gamification -->
    <section class="gamification py-5">
      <div class="container">
        <h2 class="section-title">🏆 Sistema de Níveis</h2>
        <p class="section-subtitle">Acompanhe sua evolução e ganhe cada vez mais</p>

        <div class="level-grid">
          <div class="level active">
            <div class="tier">NÍVEL 1</div>
            <div class="icon">🥉</div>
            <div class="title">Bronze</div>
            <div class="commission">R$60/venda</div>
            <div class="req">Iniciante</div>
          </div>
          <div class="level">
            <div class="tier">NÍVEL 2</div>
            <div class="icon">🥈</div>
            <div class="title">Prata</div>
            <div class="commission">R$75/venda</div>
            <div class="req">20 vendas → +R$300/mês</div>
          </div>
          <div class="level">
            <div class="tier">NÍVEL 3</div>
            <div class="icon">🥇</div>
            <div class="title">Ouro</div>
            <div class="commission">R$90/venda</div>
            <div class="req">50 vendas → +R$1.500/mês</div>
          </div>
          <div class="level">
            <div class="tier">NÍVEL 4</div>
            <div class="icon">💎</div>
            <div class="title">Diamante</div>
            <div class="commission">R$120/venda</div>
            <div class="req">100 vendas → +R$6.000/mês</div>
          </div>
        </div>
      </div>
    </section>

    <!-- How it works -->
    <section class="how-it-works py-5">
      <div class="container">
        <h2 class="section-title">🚀 Como Funciona</h2>
        <p class="section-subtitle">Em 3 passos simples você começa a ganhar</p>

        <div class="steps d-flex flex-wrap justify-content-center gap-30">
          <div class="step">
            <div class="step-number">1</div>
            <h4>Identifique o Cliente</h4>
            <p>Aproxime empresas na sua cidade que não têm site. Pizzarias, salões, clínicas, oficinas...</p>
          </div>
          <div class="step">
            <div class="step-number">2</div>
            <h4>Crie o Minisite</h4>
            <p>Em 5 minutos você monta o site com as informações do negócio. Sem complexidade!</p>
          </div>
          <div class="step">
            <div class="step-number">3</div>
            <h4>Receba o Pagamento</h4>
            <p>Cliente aprovou, você recebe R$60 (ou mais). Simples assim!</p>
          </div>
        </div>
      </div>
    </section>

    <!-- Training -->
    <section class="training py-5">
      <div class="container">
        <h2 class="section-title">📚 Treinamento Exclusivo</h2>
        <p class="section-subtitle">Aprenda a vender como os campeões</p>

        <div class="videos d-flex flex-wrap justify-content-center gap-30">
          <div class="video-card-premium" v-for="(video, index) in videos" :key="index">
            <a :href="video.url" target="_blank">
              <div class="thumb">▶</div>
              <div class="info">
                <h4>{{ video.title }}</h4>
                <div class="duration">{{ video.description }}</div>
              </div>
            </a>
          </div>
        </div>
      </div>
    </section>

    <!-- Urgency -->
    <section class="urgency py-5 text-center">
      <div class="container">
        <h2 class="section-title">⚠️ Vagas Limitadas por Cidade</h2>
        <p class="section-subtitle">Cada cidade tem limite de vendedores para manter a qualidade</p>

        <div class="cities d-flex justify-content-center gap-50 flex-wrap my-4">
          <div class="city">
            <div class="name">São Paulo</div>
            <div class="spots">3</div>
            <div class="label">vagas restantes</div>
          </div>
          <div class="city">
            <div class="name">Rio de Janeiro</div>
            <div class="spots">5</div>
            <div class="label">vagas restantes</div>
          </div>
          <div class="city">
            <div class="name">Belo Horizonte</div>
            <div class="spots">2</div>
            <div class="label">vagas restantes</div>
          </div>
        </div>
        <a href="#register" class="btn btn-lg-premium">GARANTIR MINHA VAGA</a>
      </div>
    </section>

    <!-- Registration -->
    <section class="register py-5" id="register">
      <div class="container" v-if="!showPayment">
        <h2>🎯 Comece Agora</h2>
        <p class="text-dark mb-4">Primeiro passo: preencha seus dados</p>

        <ValidationObserver ref="$validator" tag="form" class="form-premium mx-auto" @submit.prevent="sendLead">
          <ValidationProvider rules="required" v-slot="{ classes }" name="nome" tag="div" class="mb-3">
            <input type="text" class="form-control-premium" :class="classes" placeholder="Seu nome completo" v-model="lead.name">
          </ValidationProvider>
          
          <ValidationProvider rules="required" v-slot="{ classes }" name="cidade" tag="div" class="mb-3">
            <input type="text" class="form-control-premium" :class="classes" placeholder="Cidade" v-model="lead.city">
          </ValidationProvider>

          <ValidationProvider rules="required" v-slot="{ classes }" name="whatsapp" tag="div" class="mb-3">
            <input type="tel" class="form-control-premium" :class="classes" placeholder="WhatsApp com DDD" v-model="lead.numberWhatsApp">
          </ValidationProvider>

          <ValidationProvider rules="required|email" v-slot="{ classes }" name="email" tag="div" class="mb-3">
            <input type="email" class="form-control-premium" :class="classes" placeholder="Seu email" v-model="lead.email">
          </ValidationProvider>

          <button type="submit" class="btn btn-block-premium" :disabled="loadingLead">
            {{ loadingLead ? 'ENVIANDO...' : 'CONTINUAR' }}
          </button>
        </ValidationObserver>
      </div>

      <!-- Payment Section (UI Only as requested) -->
      <div class="container text-center" v-else id="pagamento">
        <h2 class="text-gold-premium">💳 Ative Seu Acesso</h2>
        <p class="text-muted-premium my-4">Pagamento único de <strong class="text-white h3">R$120/ano</strong></p>
        <a href="/seja-nosso-representante/6WjJNfgLzwMg" class="btn btn-lg-premium">PAGAR AGORA R$120</a>
      </div>
    </section>

    <!-- Footer -->
    <footer class="py-4">
      <p>© 2026 Minisitio - Todos os direitos reservados</p>
    </footer>

    <!-- WhatsApp Floating Button -->
    <a class="floating-wa" href="https://wa.me/5561984213444" target="_blank">
      <img src="../assets/icons/whatsapp.png" alt="WhatsApp" width="30">
    </a>
  </div>
</template>

<script>
import ValidationMixin from '@/mixins/validation'
import EventBus from '@/event-bus'
import PageApi from '@/api/page'

export default {
  name: "LandingPage",
  mixins: [ValidationMixin],

  data() {
    return {
      lead: {
        name: '',
        city: '',
        numberWhatsApp: '',
        email: ''
      },
      loadingLead: false,
      showPayment: false,
      calcVendas: 10,
      calcValor: 60,
      videos: [
        { title: 'Mercado Potencial', description: 'Video • Bom dia Brasil', url: 'https://youtube.com/shorts/-7yQb4OWVxU' },
        { title: 'Como Ganhar 20 Mil Master', description: 'Video • Tutorial', url: 'https://drive.google.com/file/d/1Y-XNJxCz-W_nHhEyYGdmFP7PJ-NPggwH/view' },
        { title: 'Curso Afiliado Grátis', description: 'Video • Comece agora', url: 'https://youtu.be/KDmcqRulQQM' },
        { title: 'Minisítio no Android', description: 'Video • Passo a passo', url: 'https://drive.google.com/file/d/1nuyK0CIkdgNo88X6WAI5xoKgkn-qMXvf/view' },
        { title: 'Como Abrir Conta Minisítio', description: 'Video • Tutorial', url: 'https://youtu.be/E2H6eT_Xfzo' },
        { title: 'Como Atualizar Minisítio', description: 'Video • Tutorial', url: 'https://youtu.be/SF2FXAR4j2o' }
      ]
    }
  },

  computed: {
    totalGanho() {
      return (Number(this.calcVendas) || 0) * (Number(this.calcValor) || 0);
    }
  },

  methods: {
    sendLead() {
      return this.$refs.$validator.validate().then(isValid => {
        if (!isValid) return Promise.reject()

        this.loadingLead = true
        PageApi.sendMoreInformation(this.lead).then(() => {
          EventBus.$emit('alert-success', 'Informações enviadas com sucesso!')
          this.showPayment = true
          this.$nextTick(() => {
            document.getElementById('pagamento')?.scrollIntoView({ behavior: 'smooth' })
          })
        }).finally(() => {
          this.loadingLead = false
        })
      })
    }
  },

  mounted() {
    // Leadster script
    let script = document.createElement('script')
    script.type = 'text/javascript'
    script.innerHTML = '(function(n,r,l,d){try{var h=r.head||r.getElementsByTagName("head")[0],s=r.createElement("script");s.setAttribute("type","text/javascript");s.setAttribute("src",l);n.neuroleadId=d;h.appendChild(s);}catch(e){}})(window,document,"https://cdn.leadster.com.br/neurolead/neurolead.min.js", 21908);'
    document.querySelector('body').appendChild(script)
  }
}
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap');

.landing-page-premium {
  font-family: 'Poppins', sans-serif;
  background-color: #0a0a0a;
  color: #fff;
}

/* Ticker */
.ticker {
  background: #ffd700;
  color: #000;
  padding: 10px;
  text-align: center;
  font-weight: 600;
  overflow: hidden;
}
.ticker-content {
  animation: ticker 30s linear infinite;
  white-space: nowrap;
}
@keyframes ticker {
  0% { transform: translateX(100%); }
  100% { transform: translateX(-100%); }
}

/* Header */
.main-header {
  background: rgba(10, 10, 10, 0.95);
  padding: 15px 30px;
  display: flex;
  justify-content: space-between;
  align-items: center;
  position: sticky;
  top: 0;
  width: 100%;
  z-index: 100;
  backdrop-filter: blur(10px);
}
.logo {
  font-size: 24px;
  font-weight: 800;
  background: linear-gradient(135deg, #ffd700, #ffaa00);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
}
.btn-app {
  color: #ffd700;
  font-weight: 600;
  text-decoration: none;
  font-size: 14px;
}
.btn-sm-participar {
  background: linear-gradient(135deg, #ffd700, #ff8c00);
  padding: 8px 20px;
  border-radius: 50px;
  font-size: 14px;
  font-weight: 700;
  color: #000;
  text-decoration: none;
}

/* Hero */
.hero {
  background: linear-gradient(135deg, #0a0a0a 0%, #1a1a2e 50%, #0a0a0a 100%);
  padding: 80px 20px;
  text-align: center;
}
.hero h1 {
  font-size: clamp(2.5rem, 5vw, 4rem);
  font-weight: 800;
  margin-bottom: 20px;
}
.hero h1 span {
  background: linear-gradient(135deg, #ffd700, #ff8c00);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
}
.subtitle {
  font-size: 1.2rem;
  color: #aaa;
  margin-bottom: 40px;
}
.highlight {
  background: linear-gradient(135deg, #ffd700, #ff8c00);
  padding: 5px 20px;
  border-radius: 30px;
  display: inline-block;
  margin-bottom: 20px;
  font-weight: 600;
  color: #000;
}

/* Calculator */
.calculator {
  background: rgba(255, 255, 255, 0.05);
  border-radius: 20px;
  padding: 30px;
  margin-bottom: 40px;
  max-width: 500px;
  border: 1px solid rgba(255, 215, 0, 0.3);
}
.calculator h3 { color: #ffd700; margin-bottom: 25px; }
.calc-row { display: flex; align-items: center; justify-content: space-between; margin-bottom: 15px; }
.calc-row input {
  width: 100px;
  padding: 10px;
  border-radius: 10px;
  border: 1px solid #333;
  background: #1a1a1a;
  color: #fff;
  text-align: center;
}
.calc-result {
  background: linear-gradient(135deg, #ffd700, #ff8c00);
  padding: 20px;
  border-radius: 15px;
  margin-top: 20px;
}
.calc-result .label { color: #000; font-size: 14px; font-weight: 600; }
.calc-result .value { font-size: 2.5rem; font-weight: 800; color: #000; }

.btn-lg-premium {
  background: linear-gradient(135deg, #ffd700, #ff8c00);
  padding: 18px 40px;
  border-radius: 50px;
  font-size: 1.2rem;
  font-weight: 700;
  color: #000;
  text-decoration: none;
  transition: transform 0.3s;
}
.btn-lg-premium:hover { transform: scale(1.05); box-shadow: 0 10px 40px rgba(255,215,0,0.4); }

/* Stats */
.stats-bar { background: #111; padding: 40px 0; border-top: 1px solid #222; }
.stat { text-align: center; min-width: 200px; }
.stat .number { font-size: 2.5rem; font-weight: 800; color: #ffd700; }
.stat .label { color: #888; font-size: 14px; }
.gap-40 { gap: 40px; }

/* Sections */
.section-title { font-size: 2.5rem; font-weight: 800; text-align: center; margin-bottom: 10px; }
.section-subtitle { text-align: center; color: #888; margin-bottom: 50px; font-size: 1.1rem; }

/* Proof Cards */
.card-premium {
  background: rgba(255, 255, 255, 0.05);
  border-radius: 20px;
  padding: 30px;
  width: 320px;
  border: 1px solid rgba(255, 255, 255, 0.1);
  transition: all 0.3s;
}
.card-premium:hover { transform: translateY(-10px); border-color: #ffd700; }
.avatar { font-size: 3rem; margin-bottom: 15px; text-align: center; }
.name { font-size: 1.3rem; font-weight: 700; text-align: center; }
.location { color: #888; font-size: 0.9rem; text-align: center; margin-bottom: 15px; }
.earning { color: #ffd700; font-size: 1.5rem; font-weight: 700; text-align: center; }
.comment { color: #ccc; font-size: 0.9rem; line-height: 1.6; margin-top: 15px; }
.gap-30 { gap: 30px; }

/* Gamification */
.level-grid { display: flex; justify-content: center; gap: 20px; flex-wrap: wrap; }
.level {
  background: rgba(255, 255, 255, 0.05);
  border-radius: 20px;
  padding: 25px;
  width: 230px;
  text-align: center;
  border: 2px solid #333;
}
.level.active { border-color: #ffd700; box-shadow: 0 0 30px rgba(255,215,0,0.2); }
.level .icon { font-size: 2.5rem; margin-bottom: 10px; }
.level .commission { color: #ffd700; font-size: 1.4rem; font-weight: 700; }
.level .req { color: #666; font-size: 0.8rem; margin-top: 10px; }

/* Steps */
.step { width: 300px; text-align: center; }
.step-number {
  width: 60px; height: 60px; border-radius: 50%;
  background: linear-gradient(135deg, #ffd700, #ff8c00);
  display: flex; align-items: center; justify-content: center;
  font-size: 1.5rem; font-weight: 800; color: #000; margin: 0 auto 20px;
}
.step p { color: #888; line-height: 1.6; }

/* Training */
.video-card-premium { width: 280px; background: rgba(255, 255, 255, 0.05); border-radius: 15px; overflow: hidden; transition: 0.3s; }
.video-card-premium:hover { background: rgba(255, 215, 0, 0.1); }
.video-card-premium a { text-decoration: none; color: inherit; }
.video-card-premium .thumb { height: 160px; background: #222; display: flex; align-items: center; justify-content: center; font-size: 3rem; }
.video-card-premium .info { padding: 20px; }
.video-card-premium .duration { color: #ffd700; font-size: 0.8rem; }

/* Urgency */
.city { text-align: center; }
.city .spots { font-size: 2.5rem; font-weight: 800; color: #ff4444; }
.city .label { color: #666; font-size: 0.8rem; }
.gap-50 { gap: 50px; }

/* Register */
.register { background: linear-gradient(135deg, #ffd700, #ff8c00); color: #000; }
.register h2 { color: #000; font-weight: 800; }
.form-premium { max-width: 400px; }
.form-control-premium {
  width: 100%; padding: 15px; border-radius: 10px; border: 1px solid #ccc; font-size: 1rem;
}
.btn-block-premium {
  background: #000; color: #fff; width: 100%; padding: 15px; border-radius: 10px; border: none; font-weight: 700; font-size: 1.1rem;
}
.btn-block-premium:disabled { opacity: 0.7; }

/* Payment */
.text-gold-premium { color: #ffd700; font-weight: 800; }
.text-muted-premium { color: #888; }

/* Footer */
footer { background: #000; color: #666; text-align: center; }

/* Floating WA */
.floating-wa {
  position: fixed; bottom: 20px; right: 20px; background: #25D366;
  width: 60px; height: 60px; border-radius: 50%; display: flex;
  align-items: center; justify-content: center; z-index: 1000;
  box-shadow: 0 5px 20px rgba(0,0,0,0.3);
}

@media(max-width: 768px) {
  .hero h1 { font-size: 2rem; }
  .level { width: 100%; }
}
</style>
