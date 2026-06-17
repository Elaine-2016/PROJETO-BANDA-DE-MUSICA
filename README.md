# PROJETO BANDA DE MUSICA
Caso prático em desenvolvimento
# 🎸 Plataforma Oficial - Banda Kid Abelha (E-commerce & Bilheteira)

Sistema web *Full Stack* desenvolvido para a gestão integrada de uma banda de música. O projeto inclui uma loja de *merchandising* e um sistema de bilheteira com suporte para diferentes tipos de utilizadores (fãs registados e convidados). 

Projeto desenvolvido como Caso Prático de Bases de Dados MySQL no curso de **Full Stack Web Development** da Master D.

## 🚀 Funcionalidades Principais

* **Sistema de Bilheteira:** Compra de bilhetes para concertos específicos, com gestão de lotação e estado do bilhete (Vendido/Disponível).
* **Loja de Merchandising:** Catálogo de produtos físicos com carrinho de compras interativo.
* **Smart Checkout:** Fluxo de pagamento dinâmico que reconhece automaticamente utilizadores logados, ignorando a necessidade de preenchimento repetitivo de dados. Suporta *Guest Checkout* seguro.
* **Painel de Administração:** Consulta em tempo real do estado das vendas, bilhetes disponíveis e receitas geradas por evento.

## 🛠️ Tecnologias Utilizadas

* **Front-end:** HTML5, CSS3, Bootstrap 5.
* **Back-end:** PHP (Programação procedimental e orientada a transações).
* **Base de Dados:** MySQL (Relacional).
* **Arquitetura de Dados:** Utilização de `Foreign Keys` para integridade referencial, `Transactions` (`begin_transaction`, `commit`, `rollback`) para segurança nas vendas, e `Views` em SQL para otimização de relatórios.

## 📦 Como testar o projeto localmente

1. Clone este repositório: `git clone https://github.com/TEU_USUARIO/nome-do-repositorio.git`
2. Importe o ficheiro `projeto_banda.sql` para o seu servidor MySQL (ex: phpMyAdmin).
3. Configure as credenciais de acesso à base de dados no ficheiro `conexao.php`.
4. Aceda ao projeto através de um servidor local (Apache/XAMPP).

## 👤 Autora
**Elaine Gonçalves**

[![LinkedIn](https://img.shields.io/badge/LinkedIn-0077B5?style=flat&logo=linkedin&logoColor=white)](https://www.linkedin.com/in/elainegoncalvessantos)
[![GitHub](https://img.shields.io/badge/GitHub-181717?style=flat&logo=github&logoColor=white)](https://github.com/Elaine-2016)
