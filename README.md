# Php-project

Designed and developed a full-stack e-commerce bookstore:
  * Built responsive front-end interface using HTML, CSS, and Bootstrap
  * Implemented user features including book preview and purchase functionality
  * Developed admin panel for inventory management
  * Integrated PHP backend with SQL database for data storage and retrieval

Note : Create folders under names uploaded_img file, uploaded_pdf file sql database, images in src folder

SQL Query for Creating Tables in Database: 

Table user{
  id int [pk]
  name varchar
  email varchar
  password varchar
  user_type varchar
}

Table products{
  id int [pk]
  name varchar
  price int
  image varchar
  pdf_file varchar
  category varchar
  limited_pdf varchar
}

Table cart{
  id int [pk]
  user_id int
  name varchar
  price int
  quantity int
  image varchar
  book_format varchar
}

Table orders{
  id int [pk]
  user_id int
  name varchar
  number int
  email varchar
  method varchar
  address varchar
  total_products varchar
  total_price int
  placed_on varchar
  payment_status varchar
}

Table book_ordered{
  order_id int
  user_id int
  username varchar
  product_id int
  product_name varchar
  book_format varchar
  payment_status varchar
}

Table messages{
  id int 
  user_id int
  name varchar
  email varchar
  number int
  message varchar
}

Ref: "user"."id" < "book_ordered"."user_id"

Ref: "user"."id" < "cart"."user_id"

Ref: "user"."id" < "messages"."id"

Ref: "user"."id" < "orders"."user_id"

Ref: "products"."id" < "book_ordered"."product_id"
