###INSTALATION

1. Install dependencies
   `composer install`

2. Compile Scafolding
   `npm install && npm run dev`

3. Setup DB

-   `CREATE TABLE IF NOT EXISTS account (
  username VARCHAR(45) NOT NULL,
  password VARCHAR(250) NOT NULL,
  name VARCHAR(45) NOT NULL,
  role VARCHAR(45) NOT NULL,
  PRIMARY KEY (username))
ENGINE = InnoDB;`
-   `CREATE TABLE IF NOT EXISTS post (
  idpost INT NOT NULL AUTO_INCREMENT,
  title TEXT NOT NULL,
  content TEXT NOT NULL,
  date DATETIME NOT NULL,
  username VARCHAR(45) NOT NULL,
  PRIMARY KEY (idpost),
  INDEX fk_post_account_idx (username ASC),
  CONSTRAINT fk_post_account
    FOREIGN KEY (username)
    REFERENCES account (username)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;`

4. Setup .env
   `cp .env.example .env`

5. Setup DB Connection in .env file
   `DB_CONNECTION=mysql`
   `DB_HOST=yourhost`
   `DB_PORT=yourport`
   `DB_DATABASE=yourdbname`
   `DB_USERNAME=yourusername`
   `DB_PASSWORD=yourpassword`

6. Run DB seeder
   `php artisan db:seed`

7. Run Server
   `php artisan serve`
