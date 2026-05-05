<template>
  <div class="font-sans text-gray-800 landing-master-page">
    <!-- Injeção temporária do Tailwind para visualização rápida -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    
    <!-- Header -->
    <header class="bg-slate-900 text-white sticky top-0 z-50 shadow-lg" style="background-color: #0f172a;">
      <div class="max-w-7xl mx-auto flex justify-between items-center px-6 py-4">
        <div class="text-2xl font-bold">Minisitio Masters</div>
        <nav class="hidden md:flex gap-6 text-sm">
          <a href="#beneficios" class="hover:text-orange-400">Benefícios</a>
          <a href="#modelo" class="hover:text-orange-400">Modelo</a>
          <a href="#ganhos" class="hover:text-orange-400">Ganhos</a>
          <a href="http://localhost:8003/seja-nosso-representante" class="hover:text-orange-400">Contato</a>
        </nav>
        </div>
    </header>

    <!-- Hero -->
    <section class="bg-gradient-to-r from-slate-900 to-blue-700 text-white py-24" style="background: linear-gradient(to right, #0f172a, #1d4ed8);">
      <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-2 gap-12 items-center">
        <div>
          <h1 class="text-5xl md:text-6xl font-extrabold leading-tight mb-6">
            Construa sua operação digital e lucre vendendo Minisitios.
          </h1>
          <p class="text-xl mb-8 text-gray-200">
            Torne-se Master regional, venda soluções digitais para milhões de pequenos negócios e gere receita recorrente com um modelo escalável.
          </p>
          <div class="flex flex-wrap gap-4">
            <a href="#modelo" class="border border-white px-8 py-4 rounded-2xl font-semibold hover:bg-white hover:text-slate-900">
              Ver Modelo
            </a>
          </div>
        </div>
        <div class="bg-white/10 backdrop-blur-md rounded-3xl p-8 shadow-2xl" style="background-color: rgba(255,255,255,0.1); backdrop-filter: blur(12px);">
          <h3 class="text-2xl font-bold mb-4">Potencial de Receita</h3>
          <ul class="space-y-4 text-lg">
            <li>500 clientes = R$ 30 mil/ano</li>
            <li>5.000 clientes = R$ 300 mil/ano</li>
            <li>Upsells + clube = receita ampliada</li>
            <li>Modelo recorrente e escalável</li>
          </ul>
        </div>
      </div>
    </section>

    <!-- Benefícios -->
    <section id="beneficios" class="py-20 bg-gray-50">
      <div class="max-w-7xl mx-auto px-6">
        <h2 class="text-4xl font-bold text-center mb-14 text-gray-900">Por que ser um Master Minisitio?</h2>
        <div class="grid md:grid-cols-3 gap-8">
          <div v-for="benefit in benefits" :key="benefit.title" class="bg-white rounded-3xl shadow-lg p-8">
            <h3 class="text-2xl font-bold mb-4 text-gray-900">{{ benefit.title }}</h3>
            <p class="text-gray-600">{{ benefit.description }}</p>
          </div>
        </div>
      </div>
    </section>

    <!-- Modelo -->
    <section id="modelo" class="py-20 bg-white">
      <div class="max-w-7xl mx-auto px-6">
        <h2 class="text-4xl font-bold text-center mb-14 text-gray-900">Modelo de Negócio</h2>
        <div class="grid md:grid-cols-4 gap-8">
          <div v-for="step in modelSteps" :key="step.title" class="text-center p-6">
            <div class="text-4xl font-extrabold text-orange-500 mb-4" style="color: #f97316;">{{ step.number }}</div>
            <h3 class="text-xl font-bold mb-3 text-gray-900">{{ step.title }}</h3>
            <p class="text-gray-600">{{ step.description }}</p>
          </div>
        </div>
      </div>
    </section>

    <!-- Ganhos -->
    <section id="ganhos" class="py-20 bg-slate-900 text-white" style="background-color: #0f172a;">
      <div class="max-w-7xl mx-auto px-6 text-center">
        <h2 class="text-4xl font-bold mb-12">Múltiplas Fontes de Receita</h2>
        <div class="grid md:grid-cols-4 gap-8">
          <div class="bg-slate-800 rounded-3xl p-8" style="background-color: #1e293b;">
            <h3 class="text-2xl font-bold mb-3">Vendas Anuais</h3>
            <p>Receita recorrente por assinatura.</p>
          </div>
          <div class="bg-slate-800 rounded-3xl p-8" style="background-color: #1e293b;">
            <h3 class="text-2xl font-bold mb-3">Upsells Premium</h3>
            <p>SEO, destaque, marketing e Google.</p>
          </div>
          <div class="bg-slate-800 rounded-3xl p-8" style="background-color: #1e293b;">
            <h3 class="text-2xl font-bold mb-3">Clube de Vantagens</h3>
            <p>Monetização adicional contínua.</p>
          </div>
          <div class="bg-slate-800 rounded-3xl p-8" style="background-color: #1e293b;">
            <h3 class="text-2xl font-bold mb-3">Publicidade Local</h3>
            <p>Venda mídia regional e classificados.</p>
          </div>
        </div>
      </div>
    </section>

    <!-- CTA -->
    <section id="contato" class="py-24 bg-orange-500 text-white text-center" style="background-color: #f97316;">
      <div class="max-w-4xl mx-auto px-6">
        <h2 class="text-5xl font-extrabold mb-6">Comece sua operação agora.</h2>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-slate-950 text-gray-400 py-8 text-center" style="background-color: #020617;">
      <p>© 2026 Minisitio.com.br — Sua operação digital começa aqui.</p>
    </footer>
  </div>
</template>

<script>
import PageApi from '@/api/page'
import EventBus from '@/event-bus'

export default {
  name: "LandingPage",
  data() {
    return {
      lead: {
        name: '',
        email: '',
        numberWhatsApp: ''
      },
      loadingLead: false,
      benefits: [
        {
          title: 'Mercado Bilionário',
          description: 'Milhões de MEIs e pequenos negócios precisam de presença digital e geração de clientes.'
        },
        {
          title: 'Receita Recorrente',
          description: 'Ganhe com vendas, renovações anuais, upsells e serviços premium.'
        },
        {
          title: 'Escalabilidade Regional',
          description: 'Atue localmente ou expanda sua operação com equipe própria e afiliados.'
        }
      ],
      modelSteps: [
        {
          number: '1',
          title: 'Torne-se Master',
          description: 'Receba estrutura, treinamento e operação comercial.'
        },
        {
          number: '2',
          title: 'Venda na Sua Região',
          description: 'Ative pequenos negócios com alta demanda digital.'
        },
        {
          number: '3',
          title: 'Construa Carteira',
          description: 'Gere receita recorrente com assinaturas e upgrades.'
        },
        {
          number: '4',
          title: 'Escale',
          description: 'Expanda com afiliados, mídia paga e operação própria.'
        }
      ]
    }
  },
  methods: {
    sendLead() {
      if (!this.lead.name || !this.lead.email || !this.lead.numberWhatsApp) {
        alert('Por favor, preencha todos os campos.')
        return
      }
      this.loadingLead = true
      PageApi.sendMoreInformation(this.lead).then(() => {
        EventBus.$emit('alert-success', 'Informações enviadas com sucesso!')
        this.lead = { name: '', email: '', numberWhatsApp: '' }
      }).finally(() => {
        this.loadingLead = false
      })
    }
  }
}
</script>

<style scoped>
/* Reset de estilos que podem vir do Bootstrap global */
.landing-master-page h1, .landing-master-page h2, .landing-master-page h3, .landing-master-page h4 {
  margin: 0;
  padding: 0;
}
.landing-master-page a {
  text-decoration: none;
}
</style>
