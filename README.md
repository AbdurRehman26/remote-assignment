# How to run 


## Backend

Note : Application uses docker sail

- git clone https://github.com/AbdurRehman26/remote-assignment.
- cp .env.example .env
- Stop already running nginx, mysql.
- sail up.
- Create database assignment.
- sail artisan storage:link
    
## Frontend

- npm install
- npm run watch
