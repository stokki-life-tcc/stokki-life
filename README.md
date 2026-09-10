# Stokki Life — Gestão de Estoque para microempreendedores

> Software para microempreendimentos com produtos em pó (shakes e chás) controlarem estoque, validade e reposição, com dados em tempo real.

## Visão geral

**O problema:** De que maneira o software pode auxiliar microempreendedores que trabalham com produtos em pó (como shakes e chás) a gerenciar seu estoque e suas vendas, garantindo mais praticidade, economia e eficiência?

**A oportunidade:** Melhora microempreendimentos, reduz perdas, otimiza reposições e oferece dados em tempo real, impulsionando a sustentabilidade e o crescimento dos negócios.

## Solução: Stokki Life

No estudo de caso em questão, analisamos a microempreendedora Alessandra Campos, que possui um espaço de vida saudável, onde oferece shakes e chás preparados a partir de produtos em pó. A principal dificuldade encontrada está no controle de estoque, tanto em relação ao prazo de validade dos produtos quanto à reposição de itens de maior saída.

## Hipótese

A implementação do Stokki Life em microempreendimentos visa tornar a gestão de estoque e vendas mais eficiente, reduzindo perdas por vencimento e descontrole, otimizando a reposição de produtos e oferecendo acesso em tempo real a dados comerciais. Essa melhoria operacional e informacional é vista como essencial para a sustentabilidade econômica, permitindo uma alocação mais inteligente do capital de giro e foco no crescimento dos negócios.

## Tecnologias utilizadas

![Laravel](https://img.shields.io/badge/Laravel-red?style=for-the-badge&logo=laravel&logoColor=white)
![MySQL](https://img.shields.io/badge/mysql-00758f?style=for-the-badge&logo=mysql&logoColor=white)
![TailwindCSS](https://img.shields.io/badge/TailwindCSS-020617?style=for-the-badge&logo=tailwindcss&logoColor=white)
![Git](https://img.shields.io/badge/Git-black?style=for-the-badge&logo=git&logoColor=red)
![Github](https://img.shields.io/badge/github-black?style=for-the-badge&logo=github&logoColor=white)
![Composer](https://img.shields.io/badge/composer-white?style=for-the-badge&logo=composer&logoColor=black)
![Xampp](https://img.shields.io/badge/xampp-orange?style=for-the-badge&logo=xampp&logoColor=white)

## Instalação

O projeto utiliza **Laravel** e requer **XAMPP** (ou outro ambiente PHP/MySQL) e **Composer** para gerenciamento de dependências.

### Pré-requisitos

Certifique-se de que os seguintes programas estão instalados em seu computador:

- **XAMPP** (ou um ambiente equivalente como MAMP, WAMP ou Docker) para hospedar o servidor web (Apache) e o banco de dados (MySQL).
- **Composer**: gerenciador de dependências para PHP.
- **Node.js e npm (ou Yarn)**: para gerenciar e compilar os assets de front-end.
- **Git**: para clonar o repositório.

### 1) Clonagem do repositório

Abra seu terminal ou prompt de comando, navegue até o diretório onde deseja armazenar seus projetos e execute:

```bash
git clone [Link do Repositório]
```

### 2) Configuração no ambiente local

Após a clonagem, mova a pasta do projeto para o diretório de documentos raiz do seu servidor local (**`htdocs`**, se estiver usando XAMPP, geralmente em `C:\xampp\htdocs` ou `\Applications\XAMPP\htdocs`).

Em seguida, navegue até a pasta do projeto no terminal e instale as dependências:

```bash
composer install
```

```bash
npm install
npm run build
```

> O comando `npm run build` compila os assets CSS/JS para produção/uso.

### 3) Configuração do Laravel e segurança

Gere a chave de criptografia do aplicativo:

```bash
php artisan key:generate
```

> **OBSERVAÇÃO DE SEGURANÇA:** este comando gera uma chave na variável `APP_KEY` do arquivo `.env`. Para sua segurança, **é crucial que você apague esta chave** (deixando o campo vazio, ou a linha excluída) **antes de subir o projeto para um repositório público (GitHub, etc.)**. A chave deve ser gerada individualmente em cada ambiente de instalação.

### 4) Configurar e executar o banco de dados

Execute as migrações para criar as tabelas no MySQL. Certifique-se de que **Apache** e **MySQL** do seu XAMPP estejam **ativos** antes de rodar este comando:

```bash
php artisan migrate
```

> Este comando executa todos os arquivos na pasta `database/migrations`, configurando a estrutura do banco de dados.

### 5) Inicializar o servidor local

Com todas as dependências instaladas e o banco de dados configurado, você pode iniciar o servidor de desenvolvimento do Laravel:

```bash
# Opção 1: comando padrão do Laravel
php artisan serve

# Opção 2: ou usando o script de desenvolvimento do Composer (se configurado)
composer run dev
```

O projeto estará acessível através do link:

```text
http://127.0.0.1:8000
```

## Contribuidores do projeto

<table>
  <tr>
    <td align="center">
      <a href="#" title="Airton Mamani">
        <img src="https://avatars.githubusercontent.com/u/217499816?v=4" width="100px;" alt="Perfil de Airton Ronaldo Jimenez Mamani"/><br>
        <sub>
          <b>Airton Mamani</b>
        </sub>
      </a>
    </td>
    <td align="center">
      <a href="#" title="Anna Beatriz">
        <img src="https://avatars.githubusercontent.com/u/177367073?v=4" width="100px;" alt="Perfil de Anna Beatriz Campos Jeronimo"/><br>
        <sub>
          <b>Anna Beatriz</b>
        </sub>
      </a>
    </td>
    <td align="center">
      <a href="#" title="Lucas Chambi">
        <img src="https://avatars.githubusercontent.com/u/216255686?v=4" width="100px;" alt="Perfil de Lucas Bruno Calle Chambi"/><br>
        <sub>
          <b>Lucas Chambi</b>
        </sub>
      </a>
    </td>
    <td align="center">
      <a href="#" title="Vinicius Ambrosio">
        <img src="https://avatars.githubusercontent.com/u/177367072?v=4" width="100px;" alt="Perfil de Vinicius Brandão Ambrosio"/><br>
        <sub>
          <b>Vinícius Brandão</b>
        </sub>
      </a>
    </td>
  </tr>
</table>

