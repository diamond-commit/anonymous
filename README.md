# 🥷🏼 Inbox API – PostgreSQL Edition

A simple but scalable backend project that handles user accounts, messaging, and password reset flows — powered by PostgreSQL.

## 🔧 Tech Stack
- PHP (Vanilla)
- PostgreSQL (hosted on PXXL)
- DBeaver / pgAdmin (DB GUI tools)
- Raw SQL Queries
- JSON API Responses

## 📂 Tables
- users: Stores user accounts  
- inbox: Messages sent by users (FK: user_id)  
- reset: Password reset tokens with expiry logic  

## ⚙ Features
- Register/Login users  
- Send & fetch messages (inbox)  
- Reset passwords with token validation & expiry  
- Clean JSON responses for all endpoints  

## 🧠 Schema Highlights

### users
```sql
id SERIAL PRIMARY KEY,
name VARCHAR(255),
email VARCHAR(255) UNIQUE,
password TEXT,
created_at TIMESTAMP DEFAULT NOW()