1. create your database in your server.
2. rename env.example.txt to env.txt and write your database server configuration on it
3. migrate the database tables using these commands 
     * php hammam make-migrate productstype
     * php hammam make-migrate products
4. you need set the productstype table data as the following sequence:
    * dvd with id = 1
    * furniture with id = 2
    * book with id = 3