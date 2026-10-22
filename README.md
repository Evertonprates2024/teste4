# Tema WordPress — ADE SAMPA 2025 (`tema-ade-sampa`)

Tema institucional WordPress desenvolvido fielmente a partir do protótipo oficial **Site ADE SAMPA 2025** no Figma para a **Agência São Paulo de Desenvolvimento (ADE SAMPA)**.

---

## Principais Funcionalidades e Seções Implementadas

1. **Cabeçalho Fixo com Glassmorphism (`header.php`)**:
   - Navegação principal (`Home`, `Sobre`, `Notícias`, `Agenda` e menu suspenso `Transparência` com os 9 itens oficiais: *Acesso à informação*, *Participação social*, *Quadro de serviços*, *Editais*, *Observatório MEI*, *Comunicados*, *Política de privacidade*, *LGPD* e *Estágios*).
   - Logotipo central **ADE SAMPA — Agência São Paulo de Desenvolvimento**.
   - Botões de ação à direita (`Cadastre-se` e `Entrar`) + menu responsivo para dispositivos móveis.

2. **Página Inicial Completa (`front-page.php`)**:
   - **Hero Banner**: Imagem oficial do centro de São Paulo com sobreposição institucional, elementos gráficos decorativos (`+` em ciano e matriz de pontos azuis), título principal e CTAs.
   - **Atendimento ao Empreendedor**: Mosaico 2x2 de fotos das unidades, chamada para as mais de 40 unidades em todas as regiões de São Paulo e destaque para os programas **Contrata SP** e **Descomplica SP**.
   - **Espaços de Trabalho & HUB's de Inovação**:
     - Sistema de **abas interativas** sem recarregamento de página para **Teia**, **Sampa Cast**, **Sampa Audio** e **Sampa Estúdio**, alternando galerias de fotos, logotipos e descrições.
     - Bloco em destaque ciano **HUB's de inovação** com os cartões **Hub Green Sampa** e **Hub Sampa Games**.
   - **Banner Panorâmico de São Paulo**: Divisória visual em largura total.
   - **Produtos Financeiros & Nossos Parceiros**:
     - Destaque para o **Cred Sampa**, imagem central e cartões **Parcerias** e **Academia de Finanças**.
     - Faixa azul-marinho **Nossos parceiros** com os logotipos de *Banco do Brasil*, *CAIXA*, *Banco do Povo*, *Sicredi*, *Meu Bolso em Dia (Febraban Educação)*, *Parceiro Ton*, *Estímulo*, *Justa* e *Planejar*.
   - **Sistema de Gestão para o seu Negócio**: Destaque visual com selo `ERP gratuito` e cartão translúcido sobreposto do **Gestão Sampa**.
   - **Capacitações**: Cartões com borda inferior ciano para **Fábrica de Negócios** e **ADE SAMPA Ensina**.
   - **Editais**:
     - Filtros interativos por categoria (`GERAL`, `TECNOLOGIA`, `GAMES`, `AUDIOVISUAL`, `ECONOMIA VERDE`, `RURAL`, `TÊXTIL`, `HACKATONS`).
     - Carrossel horizontal de 12 cards (**Aceleração Vai Tec**, **Sampa Games**, **Amplifica Cine**, **Green Sampa**, **Sampa Rural**, **Moda Sampa**, **Hackathon ADE SAMPA**, entre outros) com navegação `<` `>` e contador dinâmico `1 ─── 12`.
   - **CTA Pré-Rodapé**: Chamada para cadastro nos programas e serviços da ADE SAMPA.

3. **Página Institucional "Sobre" (`page-sobre.php`)**:
   - Banner Hero com fotografia da equipe e tipografia em destaque (*"Apoiando o empreendedorismo da cidade de São Paulo"*).
   - Seções institucionais em duas colunas separadas por linhas pontilhadas azuis: **A ADE SAMPA**, **Missão**, **Visão** e **Valores**.

4. **Rodapé Institucional (`footer.php`)**:
   - Endereço oficial (`Rua Líbero Badaró, 425 - Centro Histórico - São Paulo - SP`), menus `SITE` e `TRANSPARÊNCIA`, ícones de redes sociais (`Instagram`, `Facebook`, `TikTok`, `YouTube`, `LinkedIn`), direitos autorais e Brasão oficial da **Prefeitura de São Paulo**.

---

## Estrutura de Arquivos do Tema

```text
tema-ade-sampa/
├── assets/
│   ├── images/          # Fotografias, brasão e logotipos extraídos do protótipo Figma
│   └── js/
│       └── main.js      # Lógica de abas, carrossel/filtros de Editais e dropdown Transparência
├── inc/
│   └── svg-logos.php    # Componentes SVG vetoriais dos programas da ADE SAMPA
├── archive.php          # Template de arquivo de posts/editais/agenda
├── footer.php           # Rodapé institucional
├── front-page.php       # Template da Página Inicial (Home)
├── functions.php        # Configuração do tema, CPTs (Editais/Agenda) e criação automática de páginas
├── header.php           # Cabeçalho fixo com menu e dropdown Transparência
├── index.php            # Template principal / listagem de Notícias
├── page-sobre.php       # Template dedicado da página "Sobre"
├── page.php             # Template padrão de páginas internas
├── screenshot.png       # Miniatura oficial do tema no painel do WordPress
├── single.php           # Template de leitura de post/edital individual
└── style.css            # Folha de estilos principal com cabeçalho oficial do WordPress
```

---

## Como Instalar no WordPress

1. Copie a pasta do tema (`tema-ade-sampa`) ou faça o download do arquivo `.zip` para o diretório `wp-content/themes/` da sua instalação WordPress.
2. No painel administrativo do WordPress (**Aparência > Temas**), localize o tema **ADE SAMPA 2025** e clique em **Ativar**.
3. Ao ativar o tema, as páginas **Sobre** (`/sobre`), **Notícias** (`/noticias`) e **Agenda** (`/agenda`) são criadas automaticamente.
