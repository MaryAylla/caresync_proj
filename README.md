# 💜 CareSync - Plataforma Inteligente de Gestão de Saúde Pessoal

Uma aplicação web imersiva de *e-health* (saúde digital) desenvolvida como projeto de excelência para o curso técnico em Informática. O **CareSync** funciona como um painel centralizado (Dashboard) onde o usuário pode gerenciar consultas médicas, acompanhar tratamentos contínuos de forma inteligente e monitorar hábitos diários de saúde.

Este projeto vai além de um simples sistema de agendamento, implementando **Regras de Negócio Avançadas** no backend e focando em **UX/UI (Experiência do Usuário)** para criar um "Design Emocional". O objetivo foi provar que um software de saúde não precisa ser frio e engessado, podendo ser acolhedor, responsivo e altamente inteligente.

O desenvolvimento abordou conceitos avançados de Engenharia de Software Web, incluindo:

* **Arquitetura MVC e Lógica de Domínio (Laravel & PHP):**
    * **Motor de Recorrência (Tratamentos):** Algoritmo complexo no backend (`Carbon`) que calcula automaticamente a próxima dose de um medicamento com base na frequência de horas estipulada, contabilizando o total de doses tomadas, dias restantes e finalizando o tratamento automaticamente quando a meta é atingida.
    * **Operações CRUD Relacionais:** Implementação completa de criação, leitura, atualização e exclusão de dados com proteção contra *Mass Assignment*, validação de formulários e relacionamento estruturado de banco de dados (Usuários -> Médicos, Consultas, Medicamentos, Hidratação).

* **Frontend Moderno e UX/UI "Aesthetic" (Blade, Bootstrap & CSS3):**
    * **Design Emocional (Aesthetic):** Paleta de cores cuidadosamente selecionada (roxo pastel, lilás e tons cianos) e estampas de fundo em SVG para reduzir a ansiedade comum em apps de saúde, criando um ambiente visual de calma e organização.
    * **Dashboard Dinâmico e Gamificado:** Uso de barras de progresso matemáticas (`<progress>`) que reagem em tempo real aos cliques do usuário (ex: barra de tratamento, meta diária de água) e "Hero Banner" imersivo em `100vw`.
    * **Navegação de Baixa Carga Cognitiva:** Formulários divididos logicamente (Data e Hora nativos do sistema operacional), menus suspensos para especialidades predefinidas e submissão automática via JavaScript (`onchange`) para marcação rápida de doses.

-----

## ✨ Funcionalidades Principais

* **Motor de Tratamento Contínuo:** Muito além de um lembrete. O sistema entende se o remédio é de "8 em 8 horas por 5 dias", calcula a porcentagem de progresso, exibe quantas doses/dias faltam e agenda o próximo alarme sozinho.
* **Tracker de Hidratação Gamificado:** Registro acumulativo de consumo de água com barra de progresso visual em relação à meta diária do usuário.
* **Gestão de Médicos e Especialidades:** Diretório pessoal de profissionais da saúde (CRUD completo) para facilitar e agilizar futuros agendamentos.
* **Agenda Inteligente de Consultas:** Agendamento simplificado com inputs nativos de calendário e relógio, permitindo reagendamento (Update) fluido e organizado por proximidade de data.
* **Jornada de Saúde (Check-ups):** Área dedicada a exames e eventos esporádicos, integrando perfeitamente a visão de curto e longo prazo da saúde do usuário.
* **Dicas Dinâmicas de Engajamento:** Sistema randômico no backend que exibe dicas de saúde rotativas para incentivar retornos ao Dashboard.

-----

## 🛠️ Tecnologias Utilizadas

* **Backend & Framework:** PHP 8+ com [Laravel](https://laravel.com/) (Arquitetura MVC).
* **Banco de Dados:** MySQL (via Eloquent ORM e Migrations).
* **Frontend:** Laravel Blade, HTML5 Semântico, CSS3 (Variáveis Globais, Filtros e SVG Injetado).
* **Styling Framework:** Bootstrap 5 (Extensamente customizado via CSS).
* **Ícones e Assets:** [Bootstrap Icons](https://icons.getbootstrap.com/) e assets 3D otimizados.
* **Manipulação de Tempo:** Biblioteca *Carbon* nativa do Laravel para cálculos de fuso horário, adição de horas e diferença de dias.

-----

## 🚀 Como Executar Localmente

Por ser um projeto robusto em Laravel, ele necessita de um ambiente PHP configurado (como XAMPP, Laragon ou Laravel Herd) e o Gerenciador de Dependências Composer.

1. **Clone o repositório:**
```bash
git clone https://github.com/MaryAylla/caresync_proj.git
cd caresync
```

2. **Instale as dependências do PHP:**
```bash
composer install
```

3. **Configure o ambiente:**
* Copie o arquivo `.env.example` e renomeie para `.env`.
* Configure as credenciais do seu banco de dados MySQL no arquivo `.env`.

4. **Gere a chave da aplicação e as tabelas do banco:**
```bash
php artisan key:generate
php artisan migrate
```

5. **Inicie o servidor local:**
```bash
php artisan serve
```
Acesse `http://localhost:8000` no seu navegador para ver o sistema rodando!
