# Dossiê Técnico & Documentação Completa — Portal ADE SAMPA 2025

Este documento consolida e documenta formalmente todo o ciclo de desenvolvimento, arquitetura, decisões técnicas, componentes, responsividade, integrações e histórico de alterações do tema proprietário **tema-ade-sampa** para a **Agência São Paulo de Desenvolvimento (ADE SAMPA)**.

---

## 1. Visão Geral do Projeto

* **Nome do Tema:** Tema ADE SAMPA 2025 (`tema-ade-sampa`)
* **Versão Atual:** `2.0.8`
* **Ambiente de Produção:** [oranilom.com.br](http://oranilom.com.br/)
* **Repositório GitHub:** [github.com/brunnomolinaro/tema-ade-sampa](https://github.com/brunnomolinaro/tema-ade-sampa)
* **Design de Referência (Figma):**
  * Mockup Geral Home: [Figma Node 1-1996](https://www.figma.com/design/k20buFTwJUlvktFOEKVFj8/Site---Teste-TI--c%C3%B3pia-?node-id=1-1996)
  * Mockup Mega Menu Programas: [Figma Node 10-971](https://www.figma.com/design/qPYz45WkZcdqR1H0Wuy18e/Site---Teste-TI--c%C3%B3pia-?node-id=10-971)

---

## 2. Stack Tecnológica & Restrições Arquiteturais

O projeto foi construído rigorosamente sob a premissa de **Zero Dependências Pesadas**, garantindo máxima performance, conformidade com os padrões Web Vitals do Google e total controle de manutenção:

| Camada | Tecnologia | Detalhes & Propósito |
| :--- | :--- | :--- |
| **Backend / CMS** | **WordPress 6.7+ / PHP 8.x** | Hierarquia nativa de templates WordPress, CPTs, sanitização de inputs e metadados. |
| **Estrutura** | **HTML5 Semântico & Acessibilidade** | Tags semânticas (`<header>`, `<nav>`, `<main>`, `<section>`, `<article>`, `<footer>`), suporte a ARIA (`aria-expanded`, `aria-controls`, `aria-label`). |
| **Estilização** | **Vanilla CSS3 Moderno** | Design Tokens (:root), CSS Grid e Flexbox puros. **Zero Bootstrap, Zero Tailwind**. |
| **Interatividade** | **Vanilla JavaScript (ES6+)** | Manipulação direta do DOM, delegação de eventos, touch swipe nativo e debounce. **Zero jQuery, Zero React/Vue**. |
| **Page Builder** | **Suporte a Elementor** | Compatibilidade com o template "Elementor Largura Total" sem interferência nos estilos globais. |
| **Deploy & CI/CD** | **Webhook PHP + Git** | Sincronização automática em 2 segundos para o servidor da KingHost via chamada segura autenticada. |

---

## 3. Estrutura de Diretórios e Arquivos

```text
tema-ade-sampa/
├── assets/
│   ├── images/              # Ativos gráficos, brasão oficial, fotos otimizadas e mini logos das verticais
│   │   ├── logo-mini-sampa-empreende.png
│   │   ├── logo-mini-sampa-tech.png
│   │   ├── logo-mini-sampa-games.png
│   │   ├── logo-mini-sampa-verde.png
│   │   ├── logo-mini-sampa-criativa.png
│   │   └── ...
│   └── js/
│       └── main.js          # Scripts interativos (Menu, Mega Menu, Drawer Mobile, Carrosséis e Abas)
├── inc/
│   └── svg-logos.php        # Funções helper com logotipos matemáticos em SVG nativo
├── archive.php              # Template de arquivo para listagens
├── deploy.php               # Script de sincronização de deploy automático no servidor KingHost
├── DOCUMENTACAO.md          # Este documento consolidado
├── footer.php               # Rodapé institucional fiel ao Figma
├── front-page.php           # Template principal da Página Inicial (Home)
├── functions.php            # Registro de menus, enqueues com cache-busting dinâmico e setups
├── header.php               # Cabeçalho com Mega Menu "Programas", navegação ativa e drawer mobile
├── index.php                # Template de fallback / blog
├── page-sobre.php           # Template dedicado para a página institucional "Sobre"
├── page.php                 # Template padrão de páginas internas WordPress
├── pagina-home.html         # Versão estática completa e independente para testes em tempo real
├── README.md                # Resumo institucional do tema
├── screenshot.png           # Thumbnail oficial do tema no painel WordPress
├── single.php               # Template para posts individuais
├── style.css                # Folha de estilos completa com tokens CSS, grids e media queries
└── tema-ade-sampa.zip       # Pacote instalável do tema pronto para upload
```

---

## 4. Componentes e Funcionalidades Desenvolvidas

### 4.1. Cabeçalho & Mega Menu Programas (`header.php` & `style.css`)
* **Barra Indicadora Azul Dinâmica:** O sublinhado inferior (`box-shadow: inset 0 -3px 0 var(--ade-blue-primary)`) é atribuído dinamicamente via PHP (`is_front_page()`, `is_page('sobre')`) e atualizado via JavaScript no clique/navegação.
* **Mega Menu Programas (Figma Node 10-971):**
  * **Painel Esquerdo (Verticais de Atuação):** Grid de 5 colunas (*Sampa Empreende*, *Sampa Tech*, *Sampa Games*, *Sampa Verde*, *Sampa Criativa*) com mini logotipos oficiais e quebras de linha fiéis (ex.: *Hub de inovação em* / *inteligência artificial* em exatamente duas linhas).
  * **Painel Direito (Plataformas e Espaços):** Listagem de equipamentos e serviços (*Teia*, *Produtos Digitais*, *Praça Victor Civita*).
  * **Hover Intent com Buffer:** Implementação de debounce (280ms) e pseudo-elemento ponte invisível (`.mega-menu-dropdown::before`), eliminando o bug de fechamento acidental quando o usuário desce o mouse em direção às opções.

### 4.2. Menu Mobile e Tablet (Responsividade)
* **Ícone Hambúrguer ("3 risquinhos"):**
  * Ativação fluida de gaveta (`.site-header.mobile-menu-open .main-navigation`).
  * Tratamento universal no DOM para navegadores touch (`pointer-events: none` nos spans internos e remoção de seletores combinadores problemáticos).
  * Submenus expansíveis em acordeão em telas menores que 1024px.
  * Fechamento automático ao clicar fora ou ao selecionar links internos.

### 4.3. Seções da Home (`front-page.php`)
* **Hero Section:** Chamada principal com tipografia *Barlow Condensed* e *Fira Sans*, botões de ação e visual limpo.
* **Verticais de Atuação (Cards):** Cards temáticos com paleta de cores correspondente a cada programa e suporte a rolagem horizontal suave no mobile via touch.
* **Destaques e Oportunidades:** Carrossel nativo em JavaScript ES6+ com navegação por setas, paginação por pontos (*dots*) e suporte a deslizamento por toque (*Touch Swipe*).
* **Teia & Espaços:** Estrutura split com informações dos espaços físicos de coworking e estúdios.
* **Praça Victor Civita:** Destaque para o espaço público e galeria de fotos.
* **Rodapé Institucional (`footer.php`):** Colunas institucionais de navegação, transparência, endereço e brasão oficial da Prefeitura de São Paulo.

---

## 5. Histórico de Versões & Changelog

* **v2.0.8 (Versão Atual):**
  * **Fix Responsividade Mobile/Tablet:** Correção do travamento de script no mobile (`DOMException: '> a' is not a valid selector`), permitindo abertura instantânea do menu hambúrguer nos celulares e tablets.
  * Otimização de clique/toque no ícone hambúrguer (`pointer-events: none` nos elementos `span`).
  * Refinamento visual da barra de seleção ativa no menu vertical mobile.
* **v2.0.7:**
  * **Fix Quebras de Linha no Mega Menu:** Ajuste da 2ª coluna do grid para `1.18fr` e quebra semântica no item *Hub de inovação em inteligência artificial* para bater 100% com o Figma.
  * **Fix Barra Azul Ativa Dinâmica:** Indicador ativo sincronizado para todas as abas e páginas.
  * **Fix Hover Transit:** Correção do fechamento precoce do Mega Menu ao mover o cursor para baixo através de ponte de hover CSS e timeout de 280ms.
* **v2.0.6:**
  * Integração do Mega Menu "Programas" conforme protótipo Figma Node `10-971`.
  * Extração e incorporação dos 5 mini logos vetoriais das verticais.
* **v2.0.5:**
  * Sincronização do arquivo estático `pagina-home.html` para testes locais e edições isoladas.
* **v2.0.4:**
  * Ajustes de responsividade em tablets (1024px e 768px) e celulares (480px e 360px).
* **v2.0.2 / v2.0.3:**
  * Alinhamento de cores, tipografia (*Barlow Condensed* / *Fira Sans*) e assets dos cards coloridos da Home conforme nova versão visual do Figma.
* **v2.0.1:**
  * Suporte e compatibilidade estrutural com o Elementor Page Builder no modo "Largura Total".
* **v2.0.0:**
  * Reestruturação completa do tema baseada no novo design do Figma 2025.
  * Implementação da pipeline de deploy automático via Webhook KingHost (`deploy.php`).

---

## 6. Procedimento de Deploy e Atualização

### Deploy em Produção (KingHost)
O tema utiliza um webhook seguro em PHP localizado em `http://oranilom.com.br/deploy.php`.
Para empacotar e publicar qualquer atualização futura em segundos, basta executar:

```powershell
$sourceDir = "c:\Users\brunn\OneDrive\Documentos\Projetos Antigravity\Teste Site Ade"
$deployZip = Join-Path $env:TEMP "deploy_theme.zip"
if (Test-Path $deployZip) { Remove-Item -Force $deployZip }

Push-Location $sourceDir
tar.exe -a -c -f $deployZip --exclude=".git" --exclude=".github" --exclude="tema-ade-sampa.zip" --exclude="README.md" *
Pop-Location

curl.exe -s -X POST "http://oranilom.com.br/deploy.php" -F "key=ade_sampa_super_secret_2025" -F "theme_zip=@$deployZip"
```

### Controle de Versão (GitHub)
Repositório oficial: `https://github.com/brunnomolinaro/tema-ade-sampa.git`
Branch principal: `main`

---

## 7. Sistema de Recuperação de Desastre (Disaster Recovery)

Caso pastas do site (como `wp-admin`, `wp-includes` ou `wp-content`) sejam apagadas acidentalmente via FTP (FileZilla) ou corrompidas, existem 3 formas automatizadas de recuperação:

### Método 1: Via Navegador (Qualquer Celular ou Computador)
Acesse a URL protegida com a chave mestre:
```text
http://oranilom.com.br/wp-content/themes/tema-ade-sampa/restaurar-site.php?key=ade_sampa_super_secret_2025
```
O servidor KingHost executa em segundo plano:
1. Baixa o pacote oficial do WordPress (pt_BR) e restaura `wp-admin/`, `wp-includes/` e arquivos raiz.
2. Restaura a estrutura de pastas de `wp-content/`.
3. Baixa a versão oficial do tema diretamente da branch `main` do GitHub.
4. Baixa e instala o plugin Elementor oficial.
5. Preserva as credenciais do banco de dados em `wp-config.php`.

### Método 2: Via Script PowerShell no seu Computador (`recuperar-site.ps1`)
Abra o PowerShell na pasta do projeto e execute:
```powershell
.\recuperar-site.ps1
```

### Método 3: Via GitHub Actions (1 Clique na Web)
1. Acesse o seu repositório no GitHub: [github.com/brunnomolinaro/tema-ade-sampa](https://github.com/brunnomolinaro/tema-ade-sampa).
2. Vá na aba **Actions**.
3. Selecione o fluxo **Recuperação de Desastre (Disaster Recovery)**.
4. Clique em **Run workflow**.

---

## 8. Sistema de Backup Completo (Tema, Banco de Dados e Configurações)

O projeto conta com ferramentas automatizadas para geração de cópias de segurança instantâneas tanto locais quanto do servidor KingHost em produção.

### O que está incluso em cada backup:
1. **Dump do Banco de Dados MySQL (`database_backup_*.sql`)**:
   - Todas as 13 tabelas WordPress (`wp_posts`, `wp_postmeta`, `wp_options`, `wp_users`, etc.).
   - 100% dos dados, páginas, opções do tema, menus e configurações.
2. **Arquivo de Configurações (`wp-config.php`)**:
   - Credenciais do MySQL, chaves de segurança e prefixos de tabela.
3. **Manifesto do Sistema (`backup_info.json`)**:
   - Data, versão do tema (`2.1.3`), contagem de registros e tabelas exportadas.
4. **Pacote do Tema WordPress (`tema-ade-sampa-v2.1.3.zip`)**:
   - Código PHP, estilos CSS, scripts JS e todos os ativos e logotipos vetoriais do Figma.

### Método 1: Via Script PowerShell no Computador (`fazer-backup.ps1`)
Abra o PowerShell na pasta do projeto e execute:
```powershell
.\fazer-backup.ps1
```
O script empacota o tema local e faz o download direto do dump MySQL do servidor para a pasta `backups/`.

### Método 2: Via Navegador (Download Direto do Servidor)
Acesse a URL protegida com a chave mestre:
```text
http://oranilom.com.br/backup-site.php?key=ade_sampa_super_secret_2025
```
Você verá o painel com as estatísticas do backup e um botão para download imediato do arquivo `.zip`.

Para download direto sem interface HTML:
```text
http://oranilom.com.br/backup-site.php?key=ade_sampa_super_secret_2025&download=1
```

### Localização dos Backups:
- **Local no seu Computador**: pasta `backups/` dentro do projeto.
- **No Servidor KingHost**: pasta permanente `/home/oranilom/www/wp-content/uploads/backups/`.
- **No GitHub**: snapshot registrado na tag de release `backup-v2.1.3-20261027` e branch `backup/site-atual-v2.1.3`.

