# Senior Project - Terra AI

<div align="center" >
  <img src="https://readme-typing-svg.herokuapp.com?font=Fira+Code&pause=1000&center=true&vCenter=true&width=435&lines=Terra+AI;Agriculture+Artificial+Intelligence;" alt="Typing SVG" />
</div>
<div align="center" >
  <img src="./public/logo-bg.png">
</div>

## 📚 Description

Welcome to our university's Senior Project repository! This project is a web application built with Laravel and Vue.js.

## 📋 Prerequisites

Before you begin, ensure you have met the following requirements:

- **MySQL**: You will need MySQL for the database. You can download it from [here](https://dev.mysql.com/downloads/).
- **PHP**: This project uses PHP. Ensure you have version 7.3 or later. You can check your version with `php -v` and download PHP from [here](https://www.php.net/downloads.php) if needed.
- **Composer**: Dependency Management for PHP, version 2.0 or later is required. You can check your version with `composer --version` and download Composer from [here](https://getcomposer.org/download/) if needed.
- **Node.js & npm**: This project uses Node.js and npm. Ensure you have Node.js version 14.0 or later and npm version 6.0 or later. You can check your versions with `node -v` and `npm -v`. Download Node.js and npm from [here](https://nodejs.org/en/download/) if needed.

## 🚀 Installation

1. Clone the repository

   ```bash
   git clone git@github.com:ChristianDaher/senior-project.git
   ```

2. Navigate to the cloned repository

   ```bash
   cd senior-project
   ```

3. Install PHP and JavaScript dependencies:

   ```bash
   composer install
   npm install
   ```

4. Copy the example environment file and generate an application key:

   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. Update the database credentials in your .env file to match your local environment.

6. Run the local development server and compile your assets:
   ```bash
   php artisan serve
   npm run dev
   ```

You should now be able to access the application at [localhost:8000](http://localhost:8000).

## 📝 Todo List

### Completed Tasks
- [x] All login flow done
- [x] Edit/Delete your profile
- [x] Render posts in form
- [x] Basic welcome page
- [x] Way to create a post
- [x] Way to delete your post
- [x] ADMIN - Delete any post they want
- [x] Integrate with Google gemini (free API)
- [x] Integrate with terra ai flask API (paid API)
- [x] Make basic admin page with different statistics
- [x] FAQ page
- [x] Way to check all your starred posts

### Pending Tasks
- [ ] ADMIN - Create/Update/Delete Users 
- [ ] ADMIN - View all Prompts grouped by user 
- [ ] ADMIN - Create/Update/Delete Tags 
- [ ] ADMIN - Create/Update/Delete FAQs
- [ ] Fix Prompt page design 
- [ ] Paginate posts in form and starred
- [ ] Add Search by tag in form
- [ ] Add who and when a user published a post
- [ ] Lazy load comments in a post
- [ ] Design welcome page
- [x] Rename Dashboard to Forum
- [ ] Add animations to the welcome page

### Low Priority Tasks
- [ ] ADMIN - Edit Posts and show that it was edited
- [ ] Fix email template designs
- [ ] Users that sign in with google have a default password of "password"
